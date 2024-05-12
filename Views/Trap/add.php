<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.trap');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-trap');
	echo form_open(site_url('fmis/trap'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-4' > 

          <label class='control-label' for='trap_description'><?= lang('Fmis.trap_description') ?></label>
          <input type='text' class='form-control ' name='trap_description' id='trap_description' required />
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='active_substance'><?= lang('Fmis.active_substance') ?></label>
          <input type='text' class='form-control ' name='active_substance' id='active_substance' required />
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='traps_hectare'><?= lang('Fmis.traps_hectare') ?></label>
          <input type='text' class='form-control ' name='traps_hectare' id='traps_hectare' required />
        </div> 

	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/trap') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new_trap' id='new_trap'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>