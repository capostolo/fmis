<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.active_substance');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-product_active');
	echo form_open(site_url('fmis/product-active'), $attributes);
	?>
	<div class='row'>
    <div class='form-group col-6' > 
      <label class='control-label' for='active_substance_id'><?= lang('Fmis.active_substance_id') ?></label>
      <select class='form-control' name='active_substance_id' id='active_substance_id' required>
        <option value=''><?= lang('Fmis.active_substance_id') ?></option>
        <?php foreach($activesubstance As $r) { ?>
        <option value='<?= $r->id ?>' > <?= $r->description ?> </option>
        <?php } ?>
      </select>
    </div> 
    <div class='form-group col-6' > 
      <label class='control-label' for='concentration'><?= lang('Fmis.concentration') ?></label>
      <input type='text' class='form-control ' name='concentration' id='concentration' required />
    </div> 
	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/protective-product/'.session()->get('protective_product_id')) ?>"><?= lang('Fmis.go_back');?></a>
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