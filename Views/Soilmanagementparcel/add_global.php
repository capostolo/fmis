<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.soil_management_bulk');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-soil-management-global');
	echo form_open(site_url('fmis/soil-management-global-new'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-6'> 
			<label class='control-label' for='cultivation_code'><?= lang('Fmis.cultivation_code') ?></label>
			<select class='form-control selectpicker' name='cultivation_code' id='cultivation_code' data-live-search='true' required>
				<option value=''><?= lang('Fmis.cultivation_code') ?></option>
				<?php foreach($cultivation_codes As $code) { ?>
				<option value='<?= $code->poiCategory ?>' > <?= $code->poiCategoryName ?> </option>
				<?php } ?>
			</select>
		</div>
		<div class='form-group col-6'> 
			<label class='control-label' for='cultivar_code'><?= lang('Fmis.cultivar_code') ?></label>
			<select class='form-control selectpicker' name='cultivar_code' id='cultivar_code' data-live-search='true'>
				<option value=''><?= lang('Fmis.select_cultivar_code') ?></option>
			</select>
		</div>
		<div class="form-group col-3">
			<label for="start_date" class="control-label"><?= lang('Fmis.practice_start_date');?> </label>
			<input type="text" class="form-control datepicker" name="start_date" id="start_date" required>
		</div>
		<div class="form-group col-3">
			<label for="end_date" class="control-label"><?= lang('Fmis.practice_end_date');?> </label>
			<input type="text" class="form-control datepicker" name="end_date" id="end_date" required>
		</div>
		<div class='form-group col-3'> 
			<label class='control-label' for='work_type_id'><?= lang('Fmis.work_type_id') ?></label>
			<select class='form-control selectpicker' name='work_type_id' id='work_type_id' data-live-search='true' required>
				<option value=''><?= lang('Fmis.work_type_id') ?></option>
				<?php foreach($work_type As $r) { ?>
				<option value='<?= $r->id ?>' > <?= $r->work_type_description ?><?= !empty($r->code) ? " ($r->code)" : "" ?> </option>
				<?php } ?>
			</select>
		</div> 
		<div class='form-group col-3'> 
			<label class='control-label' for='farming_stage_id'><?= lang('Fmis.farming_stage_id') ?></label>
			<select class='form-control selectpicker' name='farming_stage_id' id='farming_stage_id' data-live-search='true' required>
				<option value=''><?= lang('Fmis.farming_stage_id') ?></option>
				<?php foreach($farming_stage As $r) { ?>
				<option value='<?= $r->id ?>' > <?= $r->farming_stage_description ?> </option>
				<?php } ?>
			</select>
		</div> 
		<div class='form-group col-12'> 
			<label class='control-label' for='purpose_description'><?= lang('Fmis.purpose_description') ?></label>
			<textarea class='form-control' name='purpose_description' id='purpose_description' required ></textarea>
		</div> 
		<div class='form-group col-6'> 
			<label class='control-label' for='plough_equipment_id'><?= lang('Fmis.plough_equipment_id') ?></label>
			<select class='form-control selectpicker' name='plough_equipment_id' id='plough_equipment_id' data-live-search='true' required>
				<option value=''><?= lang('Fmis.plough_equipment_id') ?></option>
				<?php foreach($plough_equipment As $r) { ?>
				<option value='<?= $r->id ?>' > <?= $r->plough_equipment_description ?> </option>
				<?php } ?>
			</select>
		</div> 
		<div class='form-group col-6'> 
			<label class='control-label' for='biodiversity_zone'><?= lang('Fmis.biodiversity_zone') ?></label>
			<select class='form-control selectpicker' name='biodiversity_zone' id='biodiversity_zone' data-live-search='true' required>
				<option value=''><?= lang('Fmis.biodiversity_zone') ?></option>
				<option value='ΝΑΙ'>ΝΑΙ</option>
				<option value='ΟΧΙ'>ΟΧΙ</option>
			</select>
		</div> 
		<div class='form-group col-3'> 
			<label class='control-label' for='plant_species_sow_id'><?= lang('Fmis.plant_species_sow_id') ?></label>
			<select class='form-control selectpicker' name='plant_species_sow_id' id='plant_species_sow_id' data-live-search='true'>
				<option value=''><?= lang('Fmis.plant_species_sow_id') ?></option>
				<?php foreach($plant_species_sow As $r) { ?>
				<option value='<?= $r->id ?>' > <?= $r->plant_species_sow_description ?> </option>
				<?php } ?>
			</select>
		</div> 
		<div class='form-group col-3'> 
			<label class='control-label' for='seed_needed'><?= lang('Fmis.seed_needed') ?></label>
			<input type='text' class='form-control' name='seed_needed' id='seed_needed' />
		</div> 
		<div class='form-group col-3'> 
			<label class='control-label' for='cover_crop_species_id'><?= lang('Fmis.cover_crop_species_id') ?></label>
			<select class='form-control selectpicker' name='cover_crop_species_id' id='cover_crop_species_id' data-live-search='true'>
				<option value=''><?= lang('Fmis.cover_crop_species_id') ?></option>
				<?php foreach($cover_crop_species As $r) { ?>
				<option value='<?= $r->id ?>' > <?= $r->cover_crop_species_description ?> </option>
				<?php } ?>
			</select>
		</div> 
		<div class='form-group col-3'> 
			<label class='control-label' for='cover_crop_seed'><?= lang('Fmis.cover_crop_seed') ?></label>
			<input type='text' class='form-control' name='cover_crop_seed' id='cover_crop_seed' />
		</div> 
	</div>
	<div class='row mt-3'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/farmer/'.session()->get('farmer_id')) ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-custom-green form-control' name='new_soil_management' id='new_soil_management'><?= lang('Fmis.apply');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
// New script for updating cultivar_code options
$('#cultivation_code').change(function() {
    var selectedCultivationCode = $(this).val();
    var cultivarSelect = $('#cultivar_code');

    // Clear current options
    cultivarSelect.empty();
    cultivarSelect.append('<option value=""><?= lang('Fmis.cultivar_code') ?></option>');

    if (selectedCultivationCode) {
        // AJAX call to get matching cultivar codes
        $.ajax({
            url: '<?= site_url('fmis/get-cultivar-codes') ?>',
            method: 'POST',
            data: { cultivation_code: selectedCultivationCode },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $.each(response.cultivar_codes, function(index, code) {
                        cultivarSelect.append($('<option>', {
                            value: code.poiKodikos,
                            text: code.poiDescription
                        }));
                    });
                }
                // Refresh the selectpicker
                cultivarSelect.selectpicker('refresh');
            },
            error: function() {
                console.error('Failed to fetch cultivar codes');
            }
        });
    } else {
        // Refresh the selectpicker
        cultivarSelect.selectpicker('refresh');
    }
});

$('#add-soil-management-global').submit(function(event) {
    var confirmed = confirm("Είστε σίγουροι για την μαζική καταγραφή; Παρακαλώ, ελέγξτε τα στοιχεία που θα εισαχθούν. Δεν υπάρχει δυνατότητα αυτόματης αναίρεσης.");
    if (!confirmed) {
        event.preventDefault();
    }
});
</script>
<?= $this->endSection() ?>