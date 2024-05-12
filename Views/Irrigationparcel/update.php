<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.irrigation_parcel');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/irrigation-parcel'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-4' > 

          <label class='control-label' for='irrigation_date'><?= lang('Fmis.irrigation_date') ?></label>
          <input type='text' class='form-control datepicker' name='irrigation_date' id='irrigation_date' value='<?= set_value('irrigation_date', ($row->irrigation_date)? $row->irrigation_date->toLocalizedString('d/M/Y') : $row->fertilisation_date) ?>' required />
        </div> 
		<div class='form-group col-4' > 

          <label class='control-label' for='water_quantity_description'><?= lang('Fmis.water_quantity_description') ?></label>
          <input type='text' class='form-control ' name='water_quantity_description' id='water_quantity_description' value='<?= set_value('water_quantity_description', $row->water_quantity_description) ?>' required />
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='unit_measurement_id'><?= lang('Fmis.unit_measurement_id') ?></label>
          <select class='form-control' name='unit_measurement_id' id='unit_measurement_id' required>
            <option value=''><?= lang('Fmis.unit_measurement_id') ?></option>
            <?php foreach($unit_measurement As $r) { 
            $unit_measurement_value = $row->unit_measurement_id ?? $directive->unit_measurement_id;
            ?>
            <option value='<?= $r->id ?>' <?= set_select('unit_measurement_id', $r->id, $r->id == $unit_measurement_value ) ?>> <?= $r->unit_measurement_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='suppling_hours'><?= lang('Fmis.suppling_hours') ?></label>
          <input type='text' class='form-control ' name='suppling_hours' id='suppling_hours' value='<?= set_value('suppling_hours', $row->suppling_hours ?? $directive->suppling_hours) ?>' required />
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='farming_stage_id'><?= lang('Fmis.farming_stage_id') ?></label>
          <select class='form-control' name='farming_stage_id' id='farming_stage_id' required>
            <option value=''><?= lang('Fmis.farming_stage_id') ?></option>
            <?php foreach($farming_stage As $r) { 
            $farming_stage_value = $row->farming_stage_id ?? $directive->farming_stage_id;
            ?>
            <option value='<?= $r->id ?>' <?= set_select('farming_stage_id', $r->id, $r->id == $farming_stage_value) ?>> <?= $r->farming_stage_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='irrigation_equipment_id'><?= lang('Fmis.irrigation_equipment_id') ?></label>
          <select class='form-control' name='irrigation_equipment_id' id='irrigation_equipment_id' required>
            <option value=''><?= lang('Fmis.irrigation_equipment_id') ?></option>
            <?php foreach($irrigation_equipment As $r) { 
            $irrigation_equipment_value = $row->irrigation_equipment_id ?? $directive->irrigation_equipment_id;
            ?>
            <option value='<?= $r->id ?>' <?= set_select('irrigation_equipment_id', $r->id, $r->id == $irrigation_equipment_value) ?>> <?= $r->irrigation_equipment_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='carbon_footprint'><?= lang('Fmis.carbon_footprint') ?></label>
          <input type='text' class='form-control ' name='carbon_footprint' id='carbon_footprint' value='<?= set_value('carbon_footprint', $row->carbon_footprint) ?>' required />
        </div> 

	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?= site_url('fmis/parcel/'.session()->get('parcel_id')) ?>"><?= lang('Fmis.go_back');?></a>
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