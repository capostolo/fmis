<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.protective_product');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-protective_product');
	echo form_open(site_url('fmis/protective-product'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-6' > 
			<label class='control-label' for='protective_product_description'><?= lang('Fmis.protective_product_description') ?></label>
			<input type='text' class='form-control ' name='protective_product_description' id='protective_product_description' required />
		</div> 
		<div class='form-group col-6' > 
			<label class='control-label' for='ecoscheme_id'><?= lang('Fmis.ecoscheme_id') ?></label>
			<select class='form-control' name='ecoscheme_id' id='ecoscheme_id' >
			<option value=''><?= lang('Fmis.ecoscheme_id') ?></option>
			<?php foreach($ecoscheme As $r) { ?>
			<option value='<?= $r->id ?>' > <?= $r->code.' - '.$r->name ?> </option>
			<?php } ?>
			</select>
		</div>   
	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/protective-product') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new_protective_product' id='new_protective_product'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>