<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.buyer');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-buyer');
	echo form_open(site_url('fmis/buyer'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-6' > 

          <label class='control-label' for='buyer_name'><?= lang('Fmis.buyer_name') ?></label>
          <input type='text' class='form-control ' name='buyer_name' id='buyer_name' required />
        </div> 
<div class='form-group col-6' > 

          <label class='control-label' for='buyer_afm'><?= lang('Fmis.buyer_afm') ?></label>
          <input type='text' class='form-control ' name='buyer_afm' id='buyer_afm' required />
        </div> 

	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/buyer') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new_buyer' id='new_buyer'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>