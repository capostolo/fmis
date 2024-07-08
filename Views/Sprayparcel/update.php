<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.spray_parcel');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/spray-parcel'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-4' > 
      <label class='control-label' for='spray_date'><?= lang('Fmis.spray_date') ?></label>
      <input type='text' class='form-control datepicker' name='spray_date' id='spray_date' value='<?= set_value('spray_date', ($row->spray_date)? $row->spray_date->toLocalizedString('d/M/Y') : $row->spray_date) ?>' required />
    </div> 
    <div class='form-group col-4' > 
      <label class='control-label' for='protective_product_id'><?= lang('Fmis.protective_product_id') ?></label>
      <select class='form-control selectpicker' name='protective_product_id' id='protective_product_id' data-live-search='true' data-style='' data-style-base='form-control' data-virtual-scroll='200' required>
        <option value=''><?= lang('Fmis.protective_product_id') ?></option>
        <?php foreach($protective_product As $r) { 
        $protective_product_value = $row->protective_product_id ?? $directive->protective_product_id;
        ?>
        <option value='<?= $r->id ?>' <?= set_select('protective_product_id', $r->id, $r->id == $protective_product_value) ?> data-scheme = '<?= $r->ecoscheme_id ?>' > <?= $r->protective_product_description ?> </option>
        <?php } ?>
      </select>
    </div> 
    <div class='form-group col-4' > 
      <label class='control-label' for='parcel_quantity'><?= lang('Fmis.parcel_quantity') ?></label>
      <input type='text' class='form-control ' name='parcel_quantity' id='parcel_quantity' value='<?= set_value('parcel_quantity', $row->parcel_quantity) ?>'required />
    </div> 
    <div class='form-group col-4' > 
      <label class='control-label' for='spray_equipment_id'><?= lang('Fmis.spray_equipment_id') ?></label>
      <select class='form-control' name='spray_equipment_id' id='spray_equipment_id' required>
        <option value=''><?= lang('Fmis.spray_equipment_id') ?></option>
        <?php foreach($spray_equipment As $r) { 
        $spray_equipment_value = $row->spray_equipment_id ?? $directive->spray_equipment_id;
        ?>
        <option value='<?= $r->id ?>' <?= set_select('spray_equipment_id', $r->id, $r->id == $spray_equipment_value) ?>> <?= $r->spray_equipment_description ?> </option>
        <?php } ?>
      </select>
    </div> 
    <div class='form-group col-4' > 
      <label class='control-label' for='dose'><?= lang('Fmis.dose') ?></label>
      <input type='text' class='form-control ' name='dose' id='dose' value='<?= set_value('dose', $row->dose ?? $directive->dose) ?>' required />
    </div> 
    <div class='form-group col-4' > 
      <label class='control-label' for='unit_measurement_id'><?= lang('Fmis.unit_measurement_id') ?></label>
      <select class='form-control' name='unit_measurement_id' id='unit_measurement_id' required>
        <option value=''><?= lang('Fmis.unit_measurement_id') ?></option>
        <?php foreach($unit_measurement As $r) { 
        $unit_measurement_value = $row->unit_measurement_id ?? $directive->unit_measurement_id;
        ?>
        <option value='<?= $r->id ?>' <?= set_select('unit_measurement_id', $r->id, $r->id == $unit_measurement_value) ?>> <?= $r->unit_measurement_description ?> </option>
        <?php } ?>
      </select>
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
      <label class='control-label' for='days_before_harvest'><?= lang('Fmis.days_before_harvest') ?></label>
      <input type='text' class='form-control ' name='days_before_harvest' id='days_before_harvest' value='<?= set_value('days_before_harvest', $row->days_before_harvest ?? $directive->days_before_harvest) ?>' required />
    </div> 
    <div class='form-group col-4' > 
      <label class='control-label' for='carbon_footprint'><?= lang('Fmis.carbon_footprint') ?></label>
      <input type='text' class='form-control ' name='carbon_footprint' id='carbon_footprint' value='<?= set_value('carbon_footprint', $row->carbon_footprint) ?>' required />
    </div> 
    <div class='form-group col-6'> 
      <label class='control-label' for='target'><?= lang('Fmis.target') ?></label>
      <textarea class='form-control' name='target' id='target' required > <?= set_value('target', $row->target ?? $directive->target) ?></textarea>
    </div> 
    <div class='form-group col-6'> 
      <label class='control-label' for='conditions'><?= lang('Fmis.conditions') ?></label>
      <textarea class='form-control' name='conditions' id='conditions' required > <?= set_value('conditions', $row->conditions ?? $directive->conditions) ?></textarea>
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
<script>
$( document ).ready(function() {
    updateDose();
});
$('#protective_product_id').change(function (){
	updateDose();
});

function updateDose(){
	var scheme =  $('#protective_product_id option:selected').data('scheme');
	if(scheme == ''){
		$("label[for = 'dose']").text('<?= lang('Fmis.dose_spray');?>')
		$('#parcel_quantity').prop('disabled', false);
		var sel = $("#unit_measurement_id").val();
		$('#unit_measurement_id option:gt(0)').remove();
		if(sel == "9"){
			$("#unit_measurement_id").append($('<option/>', { value: "9", text: "κυβ. εκατοστά (ml)", selected: "selected"}));
		}
		else {
			$("#unit_measurement_id").append($('<option/>', { value: "9", text: "κυβ. εκατοστά (ml)"}));
		}
		if(sel == "10"){
			$("#unit_measurement_id").append($('<option/>', { value: "10", text: "γραμμάρια (gr)", selected: "selected"}));
		}
		else {
			$("#unit_measurement_id").append($('<option/>', { value: "10", text: "γραμμάρια (gr)"}));
		}
	}
	else if(scheme == '2'){
		$('#parcel_quantity').prop('disabled', true);
		$("label[for = 'dose']").text('<?= lang('Fmis.dose_attract');?>')
		$('#unit_measurement_id option:gt(0)').remove();
		$("#unit_measurement_id").append($('<option/>', { value: "15", text: "αριθμός/στρέμμα", selected: "selected" }));
	}
	else {
		$('#parcel_quantity').prop('disabled', true);
		var sel = $("#unit_measurement_id").val();
		$("label[for = 'dose']").text('<?= lang('Fmis.dose_other');?>')
		$('#unit_measurement_id option:gt(0)').remove();
		if(sel == "12"){
			$("#unit_measurement_id").append($('<option/>', { value: "12", text: "άτομα/στρέμμα", selected: "selected"}));
		}
		else{
			$("#unit_measurement_id").append($('<option/>', { value: "12", text: "άτομα/στρέμμα"}));
		}
		if(sel == "13"){
			$("#unit_measurement_id").append($('<option/>', { value: "13", text: "άτομα/m2", selected: "selected"}));
		}
		else{
			$("#unit_measurement_id").append($('<option/>', { value: "13", text: "άτομα/m2"}));
		}
		if(sel == "14"){
			$("#unit_measurement_id").append($('<option/>', { value: "14", text: "άτομα/δένδρο", selected: "selected"}));
		}
		else{
			$("#unit_measurement_id").append($('<option/>', { value: "14", text: "άτομα/δένδρο"}));
		}
	}
}
</script>
<?= $this->endSection() ?>