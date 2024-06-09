<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.harvesting');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/harvesting'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-4' > 

          <label class='control-label' for='dir_date'><?= lang('Fmis.dir_date') ?></label>
          <input type='text' class='form-control datepicker' name='dir_date' id='dir_date' value='<?= set_value('dir_date', $row->dir_date->toLocalizedString('d/M/Y')) ?>' required />
        </div> 
<div class='form-group col-8' > 

          <label class='control-label' for='harvest_equipment_id'><?= lang('Fmis.harvest_equipment_id') ?></label>
          <select class='form-control selectpicker' name='harvest_equipment_id[]' id='harvest_equipment_id' multiple required>
            <option value=''><?= lang('Fmis.harvest_equipment_id') ?></option>
            <?php foreach($harvest_equipment As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('harvest_equipment_id', $r->id, in_array($r->id, $selected_equipment)) ?>> <?= $r->harvest_equipment_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-12'> 

          <label class='control-label' for='stage_of_ripening'><?= lang('Fmis.stage_of_ripening') ?></label>
          <textarea class='form-control' name='stage_of_ripening' id='stage_of_ripening' required > <?= set_value('stage_of_ripening', $row->stage_of_ripening) ?></textarea>
        </div> 

	</div>
      <div class="row mt-3">
      <h4 class="mx-auto">
         Αγροτεμάχια που αφορά η οδηγία
      </h4>
      <div class="col-12">
      <table class="table table-striped dstable text-custom-anthrax">
        <thead>
          <tr>
            <th><a href='#'><i class="far fa-square" aria-hidden="true" id="selectAll"></i></a></th>
            <th>Κωδικός αγροτεμαχίου</th>
            <th>Τοποθεσία</th>
            <th>Περιγραφή</th>
            <th class="text-right">Επιλέξιμη έκταση (ha)</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
         <?php foreach($crops As $f){?>
           <tr>
            <td>
              <input type='checkbox' class="selectMe" name='fi_selected[]' value="<?= $f->parcel_id ?>" <?= ($f->harvest_parcel_id) ? 'checked' : '' ?>/>
            </td>
            <td><a href="<?= site_url('crop/'.$f->id) ?>"><?= $f->code ?></a></td>
            <td class="text-right"><?= $f->location ?></td>
            <td><?= $f->poiDescription?></td>
            <td class="text-right"><?= $f->total_area ?></td>
            <td></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      </div>
    </div>

	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?= site_url('fmis/farmer/'.session()->get('farmer_id')) ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-custom-green form-control' name='new' id='newfeedform'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>