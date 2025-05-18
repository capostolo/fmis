<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.spray_equipment');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-spray_equipment');
	echo form_open(site_url('fmis/spray-equipment'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-3' > 

          <label class='control-label' for='spray_equipment_description'><?= lang('Fmis.spray_equipment_description') ?></label>
          <input type='text' class='form-control ' name='spray_equipment_description' id='spray_equipment_description' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='model_description'><?= lang('Fmis.model_description') ?></label>
          <input type='text' class='form-control ' name='model_description' id='model_description' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='hp'><?= lang('Fmis.hp') ?></label>
          <input type='text' class='form-control ' name='hp' id='hp' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='capacity'><?= lang('Fmis.capacity') ?></label>
          <input type='text' class='form-control ' name='capacity' id='capacity' required />
        </div> 
        <div class='form-group col-12' > 
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
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/spray-equipment') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new_spray_equipment' id='new_spray_equipment'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>