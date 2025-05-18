<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.soil_management_parcel');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/soil-management-parcel'), $attributes);
?>
	<div class='row'>
		<div class='form-group col-4' > 

          <label class='control-label' for='soil_management_date'><?= lang('Fmis.soil_management_date') ?></label>
          <input type='text' class='form-control datepicker' name='soil_management_date' id='soil_management_date' value='<?= set_value('dir_date', ($row->soil_management_date)? $row->soil_management_date->toLocalizedString('d/M/Y') : $row->soil_management_date) ?>' required />
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='work_type_id'><?= lang('Fmis.work_type_id') ?></label>
          <select class='form-control' name='work_type_id' id='work_type_id' required>
            <option value=''><?= lang('Fmis.work_type_id') ?></option>
            <?php foreach($work_type As $r) { 
            $work_type_value = $row->work_type_id ?? $directive->work_type_id;
            ?>
            <option value='<?= $r->id ?>' <?= set_select('work_type_id', $r->id, $r->id == $work_type_value) ?>> <?= $r->work_type_description ?><?= !empty($r->code) ? " ($r->code)" : "" ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='plough_equipment_id'><?= lang('Fmis.plough_equipment_id') ?></label>
          <select class='form-control' name='plough_equipment_id' id='plough_equipment_id' required>
            <option value=''><?= lang('Fmis.plough_equipment_id') ?></option>
            <?php foreach($plough_equipment As $r) { 
            $plough_equipment_value = $row->plough_equipment_id ?? $directive->plough_equipment_id;
            ?>
            <option value='<?= $r->id ?>' <?= set_select('plough_equipment_id', $r->id, $r->id == $plough_equipment_value) ?>> <?= $r->plough_equipment_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-12'> 

          <label class='control-label' for='purpose_description'><?= lang('Fmis.purpose_description') ?></label>
          <textarea class='form-control' name='purpose_description' id='purpose_description' required > <?= set_value('purpose_description', $row->purpose_description ?? $directive->purpose_description) ?></textarea>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='biodiversity_zone'><?= lang('Fmis.biodiversity_zone') ?></label>
          <select class='form-control' name='biodiversity_zone' id='biodiversity_zone' required>
            <option value=''><?= lang('Fmis.biodiversity_zone') ?></option>
            <option value='ΝΑΙ' <?= set_select('biodiversity_zone', 'ΝΑΙ', $r->biodiversity_zone == 'ΝΑΙ') ?>>ΝΑΙ</option>
            <option value='ΟΧΙ' <?= set_select('biodiversity_zone', 'ΟΧΙ', $r->biodiversity_zone == 'ΟΧΙ') ?>>ΟΧΙ</option>
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

          <label class='control-label' for='carbon_footprint'><?= lang('Fmis.carbon_footprint') ?></label>
          <input type='text' class='form-control ' name='carbon_footprint' id='carbon_footprint' value='<?= set_value('carbon_footprint', $row->carbon_footprint) ?>' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='plant_species_sow_id'><?= lang('Fmis.plant_species_sow_id') ?></label>
          <select class='form-control' name='plant_species_sow_id' id='plant_species_sow_id' >
            <option value=''><?= lang('Fmis.plant_species_sow_id') ?></option>
            <?php foreach($plant_species_sow As $r) { 
            $plant_species_sow_value = $row->plant_species_sow_id ?? $directive->plant_species_sow_id;
            ?>
            <option value='<?= $r->id ?>' <?= set_select('plant_species_sow_id', $r->id, $r->id == $plant_species_sow_value) ?>> <?= $r->plant_species_sow_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='seed_needed'><?= lang('Fmis.seed_needed') ?></label>
          <input type='text' class='form-control ' name='seed_needed' id='seed_needed' value='<?= set_value('seed_needed', $row->seed_needed ?? $directive->seed_needed) ?>'  />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='cover_crop_species_id'><?= lang('Fmis.cover_crop_species_id') ?></label>
          <select class='form-control' name='cover_crop_species_id' id='cover_crop_species_id' >
            <option value=''><?= lang('Fmis.cover_crop_species_id') ?></option>
            <?php foreach($cover_crop_species As $r) { 
            $cover_crop_species_value = $row->cover_crop_species_id ?? $directive->cover_crop_species_id;
            ?>
            <option value='<?= $r->id ?>' <?= set_select('cover_crop_species_id', $r->id, $r->id == $cover_crop_species_value) ?>> <?= $r->cover_crop_species_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='cover_crop_seed'><?= lang('Fmis.cover_crop_seed') ?></label>
          <input type='text' class='form-control ' name='cover_crop_seed' id='cover_crop_seed' value='<?= set_value('cover_crop_seed', $row->cover_crop_seed ?? $directive->cover_crop_seed) ?>'  />
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