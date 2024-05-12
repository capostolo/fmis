<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.mass_trapping_parcel');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/mass-trapping-parcel'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-4' > 

          <label class='control-label' for='mass_trapping_date'><?= lang('Fmis.mass_trapping_date') ?></label>
          <input type='text' class='form-control datepicker' name='mass_trapping_date' id='mass_trapping_date' value='<?= set_value('mass_trapping_date', ($row->mass_trapping_date)? $row->mass_trapping_date->toLocalizedString('d/M/Y') : $row->mass_trapping_date) ?>' required />
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='trap_id'><?= lang('Fmis.trap_id') ?></label>
          <select class='form-control' name='trap_id' id='trap_id' required>
            <option value=''><?= lang('Fmis.trap_id') ?></option>
            <?php foreach($trap As $r) { 
            $trap_value = $row->trap_id ?? $directive->trap_id;
            ?>
            <option value='<?= $r->id ?>' <?= set_select('trap_id', $r->id, $r->id == $trap_value) ?>> <?= $r->trap_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='traps_hectare'><?= lang('Fmis.traps_hectare') ?></label>
          <input type='text' class='form-control ' name='traps_hectare' id='traps_hectare' value='<?= set_value('traps_hectare', $row->traps_hectare ?? $directive->traps_hectare) ?>' required />
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