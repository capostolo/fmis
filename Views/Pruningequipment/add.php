<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.pruning_equipment');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-pruning_equipment');
	echo form_open(site_url('fmis/pruning-equipment'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-12' > 

          <label class='control-label' for='pruning_equipment_description'><?= lang('Fmis.pruning_equipment_description') ?></label>
          <input type='text' class='form-control ' name='pruning_equipment_description' id='pruning_equipment_description' required />
        </div> 

	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/pruning-equipment') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new_pruning_equipment' id='new_pruning_equipment'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>