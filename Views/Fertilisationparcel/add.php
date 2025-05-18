<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.fertilisation_parcel');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-fertilisation_parcel');
	echo form_open(site_url('fmis/fertilisation-parcel'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-3' > 

          <label class='control-label' for='fertilisation_date'><?= lang('Fmis.fertilisation_date') ?></label>
          <input type='text' class='form-control datepicker' name='fertilisation_date' id='fertilisation_date' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='fertiliser_id'><?= lang('Fmis.fertiliser_id') ?></label>
          <select class='form-control selectpicker' name='fertiliser_id' id='fertiliser_id' data-live-search='true' data-style='' data-style-base='form-control' data-virtual-scroll='200' required>
            <option value=''><?= lang('Fmis.fertiliser_id') ?></option>
            <?php foreach($fertiliser As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('fertiliser_id', $r->id) ?>> <?= $r->fertiliser_description ?><?= !empty($r->code) ? " ($r->code)" : "" ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='quantity_description'><?= lang('Fmis.quantity_description') ?></label>
          <input type='text' class='form-control ' name='quantity_description' id='quantity_description' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='unit_measurement_id'><?= lang('Fmis.unit_measurement_id') ?></label>
          <select class='form-control' name='unit_measurement_id' id='unit_measurement_id' required>
            <option value=''><?= lang('Fmis.unit_measurement_id') ?></option>
            <?php foreach($unit_measurement As $r) { ?>
            <option value='<?= $r->id ?>' > <?= $r->unit_measurement_description ?> </option>
            <?php } ?>
          </select>
        </div> 
    <div class='form-group col-3' > 
      <label class='control-label' for='parcel_quantity'><?= lang('Fmis.parcel_quantity') ?></label>
      <input type='text' class='form-control ' name='parcel_quantity' id='parcel_quantity' />
    </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='fertiliser_application_id'><?= lang('Fmis.fertiliser_application_id') ?></label>
          <select class='form-control' name='fertiliser_application_id' id='fertiliser_application_id' required>
            <option value=''><?= lang('Fmis.fertiliser_application_id') ?></option>
            <?php foreach($fertiliser_application As $r) { ?>
            <option value='<?= $r->id ?>' > <?= $r->fertiliser_application_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='farming_stage_id'><?= lang('Fmis.farming_stage_id') ?></label>
          <select class='form-control' name='farming_stage_id' id='farming_stage_id' required>
            <option value=''><?= lang('Fmis.farming_stage_id') ?></option>
            <?php foreach($farming_stage As $r) { ?>
            <option value='<?= $r->id ?>' > <?= $r->farming_stage_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='fertilise_equipment_id'><?= lang('Fmis.fertilise_equipment_id') ?></label>
          <select class='form-control' name='fertilise_equipment_id' id='fertilise_equipment_id' required>
            <option value=''><?= lang('Fmis.fertilise_equipment_id') ?></option>
            <?php foreach($fertilise_equipment As $r) { ?>
            <option value='<?= $r->id ?>' > <?= $r->fertilise_equipment_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='specialised_fertiliser_id'><?= lang('Fmis.specialised_fertiliser_id') ?></label>
          <select class='form-control' name='specialised_fertiliser_id' id='specialised_fertiliser_id' required>
            <option value=''><?= lang('Fmis.specialised_fertiliser_id') ?></option>
            <?php foreach($specialised_fertiliser As $r) { ?>
            <option value='<?= $r->id ?>' > <?= $r->specialised_fertiliser_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='carbon_footprint'><?= lang('Fmis.carbon_footprint') ?></label>
          <input type='text' class='form-control ' name='carbon_footprint' id='carbon_footprint' required />
        </div> 

	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/parcel/'.session()->get('parcel_id')) ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-custom-green form-control' name='new_fertilisation_parcel' id='new_fertilisation_parcel'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
$('#unit_measurement_id').change(function (){
	var unit_id =  $('#unit_measurement_id').val();
	if(unit_id == '4'){
		$('#parcel_quantity').prop('disabled', false);
		$('#parcel_quantity').prop('required', true);
	}
	else {
		$('#parcel_quantity').prop('disabled', true);
		$('#parcel_quantity').prop('required', false);
	}
});
</script>

<?= $this->endSection() ?>