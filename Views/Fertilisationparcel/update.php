<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.fertilisation_parcel');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/fertilisation-parcel'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-3' > 

          <label class='control-label' for='fertilisation_date'><?= lang('Fmis.fertilisation_date') ?></label>
          <input type='text' class='form-control datepicker' name='fertilisation_date' id='fertilisation_date' value='<?= set_value('fertilisation_date', ($row->fertilisation_date)? $row->fertilisation_date->toLocalizedString('d/M/Y') : $row->fertilisation_date) ?>' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='fertiliser_id'><?= lang('Fmis.fertiliser_id') ?></label>
          <select class='form-control' name='fertiliser_id' id='fertiliser_id' required>
            <option value=''><?= lang('Fmis.fertiliser_id') ?></option>
            <?php foreach($fertiliser As $r) { 
            $fertiliser_value = $row->fertiliser_id ?? $directive->fertiliser_id;
            ?>
            <option value='<?= $r->id ?>' <?= set_select('fertiliser_id', $r->id, $r->id == $fertiliser_value) ?>> <?= $r->fertiliser_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='quantity_description'><?= lang('Fmis.quantity_description') ?></label>
          <input type='text' class='form-control ' name='quantity_description' id='quantity_description' value='<?= set_value('quantity_description', $row->quantity_description ?? $directive->quantity) ?>' required />
        </div> 
<div class='form-group col-3' > 

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
<div class='form-group col-3' > 

          <label class='control-label' for='fertiliser_application_id'><?= lang('Fmis.fertiliser_application_id') ?></label>
          <select class='form-control' name='fertiliser_application_id' id='fertiliser_application_id' required>
            <option value=''><?= lang('Fmis.fertiliser_application_id') ?></option>
            <?php foreach($fertiliser_application As $r) { 
            $fertiliser_application_value = $row->fertiliser_application_id ?? $directive->fertiliser_application_id;
            ?>
            <option value='<?= $r->id ?>' <?= set_select('fertiliser_application_id', $r->id, $r->id == $fertiliser_application_value) ?>> <?= $r->fertiliser_application_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-3' > 

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
<div class='form-group col-3' > 

          <label class='control-label' for='fertilise_equipment_id'><?= lang('Fmis.fertilise_equipment_id') ?></label>
          <select class='form-control' name='fertilise_equipment_id' id='fertilise_equipment_id' required>
            <option value=''><?= lang('Fmis.fertilise_equipment_id') ?></option>
            <?php foreach($fertilise_equipment As $r) { 
            $fertilise_equipment_value = $row->fertilise_equipment_id ?? $directive->fertilise_equipment_id;
            ?>
            <option value='<?= $r->id ?>' <?= set_select('fertilise_equipment_id', $r->id, $r->id == $fertilise_equipment_value) ?>> <?= $r->fertilise_equipment_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='specialised_fertiliser_id'><?= lang('Fmis.specialised_fertiliser_id') ?></label>
          <select class='form-control' name='specialised_fertiliser_id' id='specialised_fertiliser_id' required>
            <option value=''><?= lang('Fmis.specialised_fertiliser_id') ?></option>
            <?php foreach($specialised_fertiliser As $r) { 
            $specialised_fertiliser_value = $row->specialised_fertiliser_id ?? $directive->specialised_fertiliser_id;
            ?>
            <option value='<?= $r->id ?>' <?= set_select('specialised_fertiliser_id', $r->id, $r->id == $specialised_fertiliser_value) ?>> <?= $r->specialised_fertiliser_description ?> </option>
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
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/parcel/'.session()->get('parcel_id')) ?>"><?= lang('Fmis.go_back');?></a>
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