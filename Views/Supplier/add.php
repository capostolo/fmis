<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.supplier');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-supplier');
	echo form_open(site_url('fmis/supplier'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-6' > 

          <label class='control-label' for='supplier_name'><?= lang('Fmis.supplier_name') ?></label>
          <input type='text' class='form-control ' name='supplier_name' id='supplier_name' required />
        </div> 
<div class='form-group col-6' > 

          <label class='control-label' for='supplier_afm'><?= lang('Fmis.supplier_afm') ?></label>
          <input type='text' class='form-control ' name='supplier_afm' id='supplier_afm' required />
        </div> 

	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/supplier') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new_supplier' id='new_supplier'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>