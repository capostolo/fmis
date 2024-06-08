<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.spray');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/spray'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-4' > 
      <label class='control-label' for='dir_date'><?= lang('Fmis.dir_date') ?></label>
      <input type='text' class='form-control datepicker' name='dir_date' id='dir_date' value='<?= set_value('dir_date', $row->dir_date->toLocalizedString('d/M/Y')) ?>' required />
    </div> 
    <div class='form-group col-4' > 
      <label class='control-label' for='farming_stage_id'><?= lang('Fmis.farming_stage_id') ?></label>
      <select class='form-control' name='farming_stage_id' id='farming_stage_id' required>
        <option value=''><?= lang('Fmis.farming_stage_id') ?></option>
        <?php foreach($farming_stage As $r) { ?>
        <option value='<?= $r->id ?>' <?= set_select('farming_stage_id', $r->id, $r->id == $row->farming_stage_id) ?>> <?= $r->farming_stage_description ?> </option>
        <?php } ?>
      </select>
    </div> 
    <div class='form-group col-4' > 
      <label class='control-label' for='days_before_harvest'><?= lang('Fmis.days_before_harvest') ?></label>
      <input type='text' class='form-control ' name='days_before_harvest' id='days_before_harvest' value='<?= set_value('days_before_harvest', $row->days_before_harvest) ?>' required />
    </div> 
    <div class='form-group col-3' > 
      <label class='control-label' for='protective_product_id'><?= lang('Fmis.protective_product_id') ?></label>
      <select class='form-control selectpicker' name='protective_product_id' id='protective_product_id' data-live-search='true' data-style='' data-style-base='form-control' data-virtual-scroll='200' required>
        <option value=''><?= lang('Fmis.protective_product_id') ?></option>
        <?php foreach($protective_product As $r) { ?>
        <option value='<?= $r->id ?>' <?= set_select('protective_product_id', $r->id, $r->id == $row->protective_product_id) ?>> <?= $r->protective_product_description ?> </option>
        <?php } ?>
      </select>
    </div> 
    <div class='form-group col-3' > 
      <label class='control-label' for='spray_equipment_id'><?= lang('Fmis.spray_equipment_id') ?></label>
      <select class='form-control' name='spray_equipment_id' id='spray_equipment_id' required>
        <option value=''><?= lang('Fmis.spray_equipment_id') ?></option>
        <?php foreach($spray_equipment As $r) { ?>
        <option value='<?= $r->id ?>' <?= set_select('spray_equipment_id', $r->id, $r->id == $row->spray_equipment_id) ?>> <?= $r->spray_equipment_description ?> </option>
        <?php } ?>
      </select>
    </div> 
    <div class='form-group col-3' > 
      <label class='control-label' for='dose'><?= lang('Fmis.dose') ?></label>
      <input type='text' class='form-control ' name='dose' id='dose' value='<?= set_value('dose', $row->dose) ?>' required />
    </div> 
    <div class='form-group col-3' > 
      <label class='control-label' for='unit_measurement_id'><?= lang('Fmis.unit_measurement_id') ?></label>
      <select class='form-control' name='unit_measurement_id' id='unit_measurement_id' required>
        <option value=''><?= lang('Fmis.unit_measurement_id') ?></option>
        <?php foreach($unit_measurement As $r) { ?>
        <option value='<?= $r->id ?>' <?= set_select('unit_measurement_id', $r->id, $r->id == $row->unit_measurement_id) ?>> <?= $r->unit_measurement_description ?> </option>
        <?php } ?>
      </select>
    </div> 
    <div class='form-group col-6'> 
      <label class='control-label' for='target'><?= lang('Fmis.target') ?></label>
      <textarea class='form-control' name='target' id='target' required > <?= set_value('target', $row->target) ?></textarea>
    </div> 
    <div class='form-group col-6'> 
      <label class='control-label' for='conditions'><?= lang('Fmis.conditions') ?></label>
      <textarea class='form-control' name='conditions' id='conditions' required > <?= set_value('conditions', $row->conditions) ?></textarea>
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
              <input type='checkbox' class="selectMe" name='fi_selected[]' value="<?= $f->parcel_id ?>" <?= ($f->spray_parcel_id) ? 'checked' : '' ?>/>
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