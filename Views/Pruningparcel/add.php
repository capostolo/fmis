<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.pruning_parcel');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-pruning_parcel');
	echo form_open(site_url('fmis/pruning-parcel'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-3' > 

          <label class='control-label' for='pruning_date'><?= lang('Fmis.pruning_date') ?></label>
          <input type='text' class='form-control datepicker' name='pruning_date' id='pruning_date' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='pruning_type_id'><?= lang('Fmis.pruning_type_id') ?></label>
          <select class='form-control' name='pruning_type_id' id='pruning_type_id' required>
            <option value=''><?= lang('Fmis.pruning_type_id') ?></option>
            <?php foreach($pruning_type As $r) { ?>
            <option value='<?= $r->id ?>' > <?= $r->pruning_type_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='pruning_equipment_id'><?= lang('Fmis.pruning_equipment_id') ?></label>
          <select class='form-control' name='pruning_equipment_id' id='pruning_equipment_id' required>
            <option value=''><?= lang('Fmis.pruning_equipment_id') ?></option>
            <?php foreach($pruning_equipment As $r) { ?>
            <option value='<?= $r->id ?>' > <?= $r->pruning_equipment_description ?> </option>
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
			<button class='btn btn-custom-green form-control' name='new_pruning_parcel' id='new_pruning_parcel'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>