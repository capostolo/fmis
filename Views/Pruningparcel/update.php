<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.pruning_parcel');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/pruning-parcel'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-3' > 

          <label class='control-label' for='pruning_date'><?= lang('Fmis.pruning_date') ?></label>
          <input type='text' class='form-control datepicker' name='pruning_date' id='pruning_date' value='<?= set_value('pruning_date', ($row->pruning_date)? $row->pruning_date->toLocalizedString('d/M/Y') : $row->pruning_date) ?>' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='pruning_type_id'><?= lang('Fmis.pruning_type_id') ?></label>
          <select class='form-control' name='pruning_type_id' id='pruning_type_id' required>
            <option value=''><?= lang('Fmis.pruning_type_id') ?></option>
            <?php foreach($pruning_type As $r) { 
            $pruning_type_value = $row->pruning_type_id ?? $directive->pruning_type_id;
            ?>
            <option value='<?= $r->id ?>' <?= set_select('pruning_type_id', $r->id, $r->id == $pruning_type_value) ?>> <?= $r->pruning_type_description ?><?= !empty($r->code) ? " ($r->code)" : "" ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='pruning_equipment_id'><?= lang('Fmis.pruning_equipment_id') ?></label>
          <select class='form-control' name='pruning_equipment_id' id='pruning_equipment_id' required>
            <option value=''><?= lang('Fmis.pruning_equipment_id') ?></option>
            <?php foreach($pruning_equipment As $r) { 
            $pruning_equipment_value = $row->pruning_equipment_id ?? $directive->pruning_equipment_id;
            ?>
            <option value='<?= $r->id ?>' <?= set_select('pruning_equipment_id', $r->id, $r->id == $pruning_equipment_value) ?>> <?= $r->pruning_equipment_description ?> </option>
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