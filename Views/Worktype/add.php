<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.work_type');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-work_type');
	echo form_open(site_url('fmis/work-type'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-6' > 

          <label class='control-label' for='work_type_description'><?= lang('Fmis.work_type_description') ?></label>
          <input type='text' class='form-control ' name='work_type_description' id='work_type_description' required />
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
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/work-type') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new_work_type' id='new_work_type'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>