<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.spray_parcel');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-spray_parcel');
	echo form_open(site_url('fmis/spray-parcel'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-4' > 
      <label class='control-label' for='spray_date'><?= lang('Fmis.spray_date') ?></label>
      <input type='text' class='form-control datepicker' name='spray_date' id='spray_date' required />
    </div> 
    <div class='form-group col-4' > 
      <label class='control-label' for='protective_product_id'><?= lang('Fmis.protective_product_id') ?></label>
      <select class='form-control selectpicker' name='protective_product_id' id='protective_product_id' data-live-search='true' data-style='' data-style-base='form-control' data-virtual-scroll='200' required>
        <option value=''><?= lang('Fmis.protective_product_id') ?></option>
        <?php foreach($protective_product As $r) { ?>
        <option value='<?= $r->id ?>' > <?= $r->protective_product_description ?> </option>
        <?php } ?>
      </select>
    </div> 
    <div class='form-group col-4' > 
      <label class='control-label' for='parcel_quantity'><?= lang('Fmis.parcel_quantity') ?></label>
      <input type='text' class='form-control ' name='parcel_quantity' id='parcel_quantity' required />
    </div> 
    <div class='form-group col-4' > 
      <label class='control-label' for='spray_equipment_id'><?= lang('Fmis.spray_equipment_id') ?></label>
      <select class='form-control' name='spray_equipment_id' id='spray_equipment_id' required>
        <option value=''><?= lang('Fmis.spray_equipment_id') ?></option>
        <?php foreach($spray_equipment As $r) { ?>
        <option value='<?= $r->id ?>' > <?= $r->spray_equipment_description ?> </option>
        <?php } ?>
      </select>
    </div> 
    <div class='form-group col-4' > 
      <label class='control-label' for='dose'><?= lang('Fmis.dose') ?></label>
      <input type='text' class='form-control ' name='dose' id='dose' required />
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
      <label class='control-label' for='farming_stage_id'><?= lang('Fmis.farming_stage_id') ?></label>
      <select class='form-control' name='farming_stage_id' id='farming_stage_id' required>
        <option value=''><?= lang('Fmis.farming_stage_id') ?></option>
        <?php foreach($farming_stage As $r) { ?>
        <option value='<?= $r->id ?>' > <?= $r->farming_stage_description ?> </option>
        <?php } ?>
      </select>
    </div> 
    <div class='form-group col-4' > 
      <label class='control-label' for='days_before_harvest'><?= lang('Fmis.days_before_harvest') ?></label>
      <input type='text' class='form-control ' name='days_before_harvest' id='days_before_harvest' required />
    </div> 
    <div class='form-group col-4' > 
      <label class='control-label' for='carbon_footprint'><?= lang('Fmis.carbon_footprint') ?></label>
      <input type='text' class='form-control ' name='carbon_footprint' id='carbon_footprint' required />
    </div> 
    <div class='form-group col-6'> 
      <label class='control-label' for='target'><?= lang('Fmis.target') ?></label>
      <textarea class='form-control' name='target' id='target' required ></textarea>
    </div> 
    <div class='form-group col-6'> 
      <label class='control-label' for='conditions'><?= lang('Fmis.conditions') ?></label>
      <textarea class='form-control' name='conditions' id='conditions' required ></textarea>
    </div> 
	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/parcel/'. session()->get('parcel_id')) ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-custom-green form-control' name='new_spray_parcel' id='new_spray_parcel'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>