<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.harvest_parcel');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/harvest-parcel'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-4' > 

          <label class='control-label' for='harvest_date'><?= lang('Fmis.harvest_date') ?></label>
          <input type='text' class='form-control datepicker' name='harvest_date' id='harvest_date' value='<?= set_value('harvest_date', ($row->harvest_date)? $row->harvest_date->toLocalizedString('d/M/Y') : $row->harvest_date) ?>' required />
        </div> 
<div class='form-group col-8' > 

          <label class='control-label' for='harvest_equipment_id'><?= lang('Fmis.harvest_equipment_id') ?></label>
          <select class='form-control selectpicker' name='harvest_equipment_id[]' id='harvest_equipment_id' title="<?= lang('Fmis.harvest_equipment_id') ?>" multiple required>
            <?php foreach($harvest_equipment As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('harvest_equipment_id', $r->id, in_array($r->id, $selected_equipment))?> > <?= $r->harvest_equipment_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='olive_fruit_weight'><?= lang('Fmis.olive_fruit_weight') ?></label>
          <input type='text' class='form-control ' name='olive_fruit_weight' id='olive_fruit_weight' value='<?= set_value('olive_fruit_weight', $row->olive_fruit_weight ?? $directive->olive_fruit_weight) ?>' required />
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='olive_oil_weight'><?= lang('Fmis.olive_oil_weight') ?></label>
          <input type='text' class='form-control ' name='olive_oil_weight' id='olive_oil_weight' value='<?= set_value('olive_oil_weight', $row->olive_oil_weight ?? $directive->olive_oil_weight) ?>' required />
        </div> 
<div class='form-group col-2' > 

          <label class='control-label' for='acidity'><?= lang('Fmis.acidity') ?></label>
          <input type='text' class='form-control ' name='acidity' id='acidity' value='<?= set_value('acidity', $row->acidity ?? $directive->acidity) ?>' required />
        </div> 
<div class='form-group col-2' > 

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