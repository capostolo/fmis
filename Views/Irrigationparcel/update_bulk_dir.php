<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.irrigation');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/irrigation-bulk'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-4' > 

          <label class='control-label' for='dir_date'><?= lang('Fmis.dir_date') ?></label>
          <input type='text' class='form-control datepicker' name='dir_date' id='dir_date' value='<?= set_value('dir_date', $row->dir_date->toLocalizedString('d/M/Y')) ?>' required  <?= $disabled ?>/>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='water_quantity_description'><?= lang('Fmis.water_quantity_description') ?></label>
          <input type='text' class='form-control ' name='water_quantity_description' id='water_quantity_description' value='<?= set_value('water_quantity_description', $row->water_quantity_description) ?>' required <?= $disabled ?>/>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='unit_measurement_id'><?= lang('Fmis.unit_measurement_id') ?></label>
          <select class='form-control' name='unit_measurement_id' id='unit_measurement_id' required <?= $disabled ?>>
            <option value=''><?= lang('Fmis.unit_measurement_id') ?></option>
            <?php foreach($unit_measurement As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('unit_measurement_id', $r->id, $r->id == $row->unit_measurement_id) ?>> <?= $r->unit_measurement_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='suppling_hours'><?= lang('Fmis.suppling_hours') ?></label>
          <input type='text' class='form-control ' name='suppling_hours' id='suppling_hours' value='<?= set_value('suppling_hours', $row->suppling_hours) ?>' required <?= $disabled ?>/>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='farming_stage_id'><?= lang('Fmis.farming_stage_id') ?></label>
          <select class='form-control' name='farming_stage_id' id='farming_stage_id' required <?= $disabled ?>>
            <option value=''><?= lang('Fmis.farming_stage_id') ?></option>
            <?php foreach($farming_stage As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('farming_stage_id', $r->id, $r->id == $row->farming_stage_id) ?>> <?= $r->farming_stage_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='irrigation_equipment_id'><?= lang('Fmis.irrigation_equipment_id') ?></label>
          <select class='form-control' name='irrigation_equipment_id' id='irrigation_equipment_id' required <?= $disabled ?>>
            <option value=''><?= lang('Fmis.irrigation_equipment_id') ?></option>
            <?php foreach($irrigation_equipment As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('irrigation_equipment_id', $r->id, $r->id == $row->irrigation_equipment_id) ?>> <?= $r->irrigation_equipment_description ?> </option>
            <?php } ?>
          </select>
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
              <input type='checkbox' class="selectMe" name='fi_selected[]' value="<?= $f->parcel_id ?>" <?= ($f->irrigation_parcel_id) ? 'checked' : '' ?> <?= $disabled ?>/>
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
	<div class='row mt-3'>
		<div class="col-12 text-center">
			<h4>
				Πρόσθετες πληροφορίες εφαρμογής
			</h4>
		</div>
		<div class="form-group col-6">
			<label for="start_date" class="control-label"><?= lang('Fmis.practice_start_date');?> </label>
			<input type="text" class="form-control datepicker" name="start_date" id="start_date" required>
		</div>
		<div class="form-group col-6">
			<label for="end_date" class="control-label"><?= lang('Fmis.practice_end_date');?> </label>
			<input type="text" class="form-control datepicker" name="end_date" id="end_date" required>
		</div>
	</div>
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?= site_url('fmis/farmer'.session()->get('farmer_id')) ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-custom-green form-control' name='new' id='newfeedform'><?= lang('Fmis.apply');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>