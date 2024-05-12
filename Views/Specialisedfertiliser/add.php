<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.specialised_fertiliser');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-specialised_fertiliser');
	echo form_open(site_url('fmis/specialised-fertiliser'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-6' > 

          <label class='control-label' for='specialised_fertiliser_description'><?= lang('Fmis.specialised_fertiliser_description') ?></label>
          <input type='text' class='form-control ' name='specialised_fertiliser_description' id='specialised_fertiliser_description' required />
        </div> 

	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/specialised-fertiliser') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new_specialised_fertiliser' id='new_specialised_fertiliser'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>