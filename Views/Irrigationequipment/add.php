<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.irrigation_equipment');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-irrigation_equipment');
	echo form_open(site_url('fmis/irrigation-equipment'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-3' > 

          <label class='control-label' for='irrigation_equipment_description'><?= lang('Fmis.irrigation_equipment_description') ?></label>
          <input type='text' class='form-control ' name='irrigation_equipment_description' id='irrigation_equipment_description' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='model_description'><?= lang('Fmis.model_description') ?></label>
          <input type='text' class='form-control ' name='model_description' id='model_description' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='hp'><?= lang('Fmis.hp') ?></label>
          <input type='text' class='form-control ' name='hp' id='hp' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='volumetric_flow_rate'><?= lang('Fmis.volumetric_flow_rate') ?></label>
          <input type='text' class='form-control ' name='volumetric_flow_rate' id='volumetric_flow_rate' required />
        </div> 

	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/irrigation-equipment') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new_irrigation_equipment' id='new_irrigation_equipment'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>