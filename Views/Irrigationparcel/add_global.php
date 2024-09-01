<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.irrigation_bulk');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-irrigation-by-cultivation');
	echo form_open(site_url('fmis/irrigation-global-new'), $attributes);
	?>
  <div class="row">
    <div class="col-6">
      <div class='form-group' > 
        <label class='control-label' for='cultivation_code'><?= lang('Fmis.cultivation_code') ?></label>
        <select class='form-control selectpicker' name='cultivation_code' id='cultivation_code' data-live-search='true' required>
          <option value=''><?= lang('Fmis.cultivation_code') ?></option>
          <?php foreach($cultivation_codes As $code) { ?>
          <option value='<?= $code->poiCategory ?>' > <?= $code->poiCategoryName ?> </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-6">
      <div class='form-group' > 
        <label class='control-label' for='cultivar_code'><?= lang('Fmis.cultivar_code') ?></label>
        <select class='form-control selectpicker' name='cultivar_code' id='cultivar_code' data-live-search='true'>
          <option value=''><?= lang('Fmis.select_cultivar_code') ?></option>
        </select>
      </div>
    </div>
  </div>
	<div class='row mt-3'>
        <div class='form-group col-6' > 
          <label class='control-label' for='quantity'><?= lang('Fmis.quantity') ?></label>
          <input type='text' class='form-control ' name='quantity_description' id='quantity_description' required />
        </div> 
        <div class='form-group col-6' > 
          <label class='control-label' for='unit_measurement_id'><?= lang('Fmis.unit_measurement_id') ?></label>
          <select class='form-control' name='unit_measurement_id' id='unit_measurement_id' required>
            <option value=''><?= lang('Fmis.unit_measurement_id') ?></option>
            <?php foreach($unit_measurement As $r) { ?>
            <option value='<?= $r->id ?>' > <?= $r->unit_measurement_description ?> </option>
            <?php } ?>
          </select>
        </div> 
		<div class="form-group col-6">
			<label for="start_date" class="control-label"><?= lang('Fmis.practice_start_date');?> </label>
			<input type="text" class="form-control datepicker" name="start_date" id="start_date" required>
		</div>
		<div class="form-group col-6">
			<label for="end_date" class="control-label"><?= lang('Fmis.practice_end_date');?> </label>
			<input type="text" class="form-control datepicker" name="end_date" id="end_date" required>
		</div>
        <div class='form-group col-6' > 
          <label class='control-label' for='farming_stage_id'><?= lang('Fmis.farming_stage_id') ?></label>
          <select class='form-control' name='farming_stage_id' id='farming_stage_id' required>
            <option value=''><?= lang('Fmis.farming_stage_id') ?></option>
            <?php foreach($farming_stage As $r) { ?>
            <option value='<?= $r->id ?>' > <?= $r->farming_stage_description ?> </option>
            <?php } ?>
          </select>
        </div> 
        <div class='form-group col-6' > 
          <label class='control-label' for='irrigation_equipment_id'><?= lang('Fmis.irrigation_equipment_id') ?></label>
          <select class='form-control' name='irrigation_equipment_id' id='irrigation_equipment_id' required>
            <option value=''><?= lang('Fmis.irrigation_equipment_id') ?></option>
            <?php foreach($irrigation_equipment As $r) { ?>
            <option value='<?= $r->id ?>' > <?= $r->irrigation_equipment_description ?> </option>
            <?php } ?>
          </select>
        </div> 
	</div>

	<div class='row mt-3'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/farmer/'.session()->get('farmer_id')) ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-custom-green form-control' name='new_irrigation' id='new_irrigation'><?= lang('Fmis.apply');?></button>
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
$('#add-irrigation-by-cultivation').submit(function(event) {
    var confirmed = confirm("Είστε σίγουροι για την μαζική καταγραφή; Παρακαλώ, ελέγξτε τα στοιχεία που θα εισαχθούν. Δεν υπάρχει δυνατότητα αυτόματης αναίρεσης.");
    if (!confirmed) {
        event.preventDefault();
    }
});
</script>
<?= $this->endSection() ?>