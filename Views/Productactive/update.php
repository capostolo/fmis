<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.protective_product');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/product-active'), $attributes);
	?>
	<div class='row'>
    <div class='form-group col-6' > 
      <label class='control-label' for='active_substance_id'><?= lang('Fmis.active_substance_id') ?></label>
      <select class='form-control' name='active_substance_id' id='active_substance_id' required>
        <option value=''><?= lang('Fmis.active_substance_id') ?></option>
        <?php foreach($activesubstance As $r) { ?>
        <option value='<?= $r->id ?>' <?= set_select('active_substance_id', $r->id, $r->id == $row->active_substance_id) ?>> <?= $r->description ?> </option>
        <?php } ?>
      </select>
    </div> 
    <div class='form-group col-6' > 
      <label class='control-label' for='concentration'><?= lang('Fmis.concentration') ?></label>
      <input type='text' class='form-control ' name='concentration' id='concentration' value='<?= set_value('concentration', $row->concentration) ?>' required />
    </div> 
	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?= site_url('fmis/protective-product') ?>"><?= lang('Fmis.go_back');?></a>
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