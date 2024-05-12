<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.cover_crop_species');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/cover-crop-species'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-6' > 

          <label class='control-label' for='cover_crop_species_description'><?= lang('Fmis.cover_crop_species_description') ?></label>
          <input type='text' class='form-control ' name='cover_crop_species_description' id='cover_crop_species_description' value='<?= set_value('cover_crop_species_description', $row->cover_crop_species_description) ?>' required />
        </div> 

	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?= site_url('fmis/cover-crop-species') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new' id='newfeedform'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>