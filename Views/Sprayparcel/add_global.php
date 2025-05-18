<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.spray_bulk');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-spray-global');
	echo form_open(site_url('fmis/spray-global-new'), $attributes);
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
			<label class='control-label' for='farming_stage_id'><?= lang('Fmis.farming_stage_id') ?></label>
			<select class='form-control selectpicker' name='farming_stage_id' id='farming_stage_id' data-live-search='true' required>
				<option value=''><?= lang('Fmis.farming_stage_id') ?></option>
				<?php foreach($farming_stage As $r) { ?>
				<option value='<?= $r->id ?>' > <?= $r->farming_stage_description ?> </option>
				<?php } ?>
			</select>
		</div> 
		<div class='form-group col-3'> 
			<label class='control-label' for='days_before_harvest'><?= lang('Fmis.days_before_harvest') ?></label>
			<input type='text' class='form-control' name='days_before_harvest' id='days_before_harvest' required />
		</div> 
		<div class='form-group col-3'> 
			<label class='control-label' for='protective_product_id'><?= lang('Fmis.protective_product_id') ?></label>
			<select class='form-control selectpicker' name='protective_product_id' id='protective_product_id' data-live-search='true' data-style='' data-style-base='form-control' data-virtual-scroll='200' required>
				<option value=''><?= lang('Fmis.protective_product_id') ?></option>
				<?php foreach($protective_product As $r) { ?>
				<option value='<?= $r->id ?>' data-scheme='<?= $r->ecoscheme_id ?>' > <?= $r->protective_product_description ?><?= !empty($r->code) ? " ($r->code)" : "" ?> </option>
				<?php } ?>
			</select>
		</div> 
		<div class='form-group col-3'> 
			<label class='control-label' for='dose'><?= lang('Fmis.dose') ?></label>
			<input type='text' class='form-control' name='dose' id='dose' required />
		</div> 
		<div class='form-group col-3'> 
			<label class='control-label' for='unit_measurement_id'><?= lang('Fmis.unit_measurement_id') ?></label>
			<select class='form-control selectpicker' name='unit_measurement_id' id='unit_measurement_id' data-live-search='true' required>
				<option value=''><?= lang('Fmis.unit_measurement_id') ?></option>
				<?php foreach($unit_measurement As $r) { ?>
				<option value='<?= $r->id ?>' > <?= $r->unit_measurement_description ?> </option>
				<?php } ?>
			</select>
		</div> 
		<div class='form-group col-3'> 
			<label class='control-label' for='spray_equipment_id'><?= lang('Fmis.spray_equipment_id') ?></label>
			<select class='form-control selectpicker' name='spray_equipment_id' id='spray_equipment_id' data-live-search='true' required>
				<option value=''><?= lang('Fmis.spray_equipment_id') ?></option>
				<?php foreach($spray_equipment As $r) { ?>
				<option value='<?= $r->id ?>' > <?= $r->spray_equipment_description ?><?= !empty($r->code) ? " ($r->code)" : "" ?> </option>
				<?php } ?>
			</select>
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
	<div class='row mt-3'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/farmer/'.session()->get('farmer_id')) ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-custom-green form-control' name='new_spray' id='new_spray'><?= lang('Fmis.apply');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
// New script for updating unit_measurement_id options based on protective_product_id
$('#protective_product_id').change(function (){
	var scheme =  $('#protective_product_id option:selected').data('scheme');
	if(scheme == ''){
		$("label[for='dose']").text('<?= lang('Fmis.dose_spray');?>');
		$('#unit_measurement_id option:gt(0)').remove();
		$("#unit_measurement_id").append($('<option/>', { value: "9", text: "κυβ. εκατοστά (ml)"}));
		$("#unit_measurement_id").append($('<option/>', { value: "10", text: "γραμμάρια (gr)"}));
	}
	else if(scheme == '2'){
		$("label[for='dose']").text('<?= lang('Fmis.dose_attract');?>');
		$('#unit_measurement_id option:gt(0)').remove();
		$("#unit_measurement_id").append($('<option/>', { value: "15", text: "αριθμός/στρέμμα", selected: "selected" }));
	}
	else {
		$("label[for='dose']").text('<?= lang('Fmis.dose_other');?>');
		$('#unit_measurement_id option:gt(0)').remove();
		$("#unit_measurement_id").append($('<option/>', { value: "12", text: "άτομα/στρέμμα"}));
		$("#unit_measurement_id").append($('<option/>', { value: "13", text: "άτομα/m2"}));
		$("#unit_measurement_id").append($('<option/>', { value: "14", text: "άτομα/δένδρο"}));
	}
});

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

$('#add-spray-global').submit(function(event) {
    var confirmed = confirm("Είστε σίγουροι για την μαζική καταγραφή; Παρακαλώ, ελέγξτε τα στοιχεία που θα εισαχθούν. Δεν υπάρχει δυνατότητα αυτόματης αναίρεσης.");
    if (!confirmed) {
        event.preventDefault();
    }
});
</script>
<?= $this->endSection() ?>