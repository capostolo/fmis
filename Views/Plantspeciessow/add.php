<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.plant_species_sow');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-plant_species_sow');
	echo form_open(site_url('fmis/plant-species-sow'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-6' > 

          <label class='control-label' for='plant_species_sow_description'><?= lang('Fmis.plant_species_sow_description') ?></label>
          <input type='text' class='form-control ' name='plant_species_sow_description' id='plant_species_sow_description' required />
        </div> 

	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/plant-species-sow') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new_plant_species_sow' id='new_plant_species_sow'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>