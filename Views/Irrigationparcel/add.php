<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.irrigation_parcel');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-irrigation_parcel');
	echo form_open(site_url('fmis/irrigation-parcel'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-4' > 

          <label class='control-label' for='irrigation_date'><?= lang('Fmis.irrigation_date') ?></label>
          <input type='text' class='form-control datepicker' name='irrigation_date' id='irrigation_date' required />
        </div> 
		<div class='form-group col-4' > 

          <label class='control-label' for='water_quantity_description'><?= lang('Fmis.water_quantity_description') ?></label>
          <input type='text' class='form-control ' name='water_quantity_description' id='water_quantity_description' required />
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='unit_measurement_id'><?= lang('Fmis.unit_measurement_id') ?></label>
          <select class='form-control' name='unit_measurement_id' id='unit_measurement_id' required>
            <option value=''><?= lang('Fmis.unit_measurement_id') ?></option>
            <?php foreach($unit_measurement As $r) { ?>
            <option value='<?= $r->id ?>' > <?= $r->unit_measurement_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='suppling_hours'><?= lang('Fmis.suppling_hours') ?></label>
          <input type='text' class='form-control ' name='suppling_hours' id='suppling_hours' required />
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='farming_stage_id'><?= lang('Fmis.farming_stage_id') ?></label>
          <select class='form-control' name='farming_stage_id' id='farming_stage_id' required>
            <option value=''><?= lang('Fmis.farming_stage_id') ?></option>
            <?php foreach($farming_stage As $r) { ?>
            <option value='<?= $r->id ?>' > <?= $r->farming_stage_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='irrigation_equipment_id'><?= lang('Fmis.irrigation_equipment_id') ?></label>
          <select class='form-control' name='irrigation_equipment_id' id='irrigation_equipment_id' required>
            <option value=''><?= lang('Fmis.irrigation_equipment_id') ?></option>
            <?php foreach($irrigation_equipment As $r) { ?>
            <option value='<?= $r->id ?>' > <?= $r->irrigation_equipment_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='carbon_footprint'><?= lang('Fmis.carbon_footprint') ?></label>
          <input type='text' class='form-control ' name='carbon_footprint' id='carbon_footprint' />
        </div> 

	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/parcel/'.session()->get('parcel_id')) ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-custom-green form-control' name='new_irrigation_parcel' id='new_irrigation_parcel'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>