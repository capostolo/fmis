<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.fertiliser');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-fertiliser');
	echo form_open(site_url('fmis/fertiliser'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-3' > 

          <label class='control-label' for='fertiliser_description'><?= lang('Fmis.fertiliser_description') ?></label>
          <input type='text' class='form-control ' name='fertiliser_description' id='fertiliser_description' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='nutrient_content'><?= lang('Fmis.nutrient_content') ?></label>
          <input type='text' class='form-control ' name='nutrient_content' id='nutrient_content'  />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='mineral_content'><?= lang('Fmis.mineral_content') ?></label>
          <input type='text' class='form-control ' name='mineral_content' id='mineral_content'  />
        </div> 

<div class='form-group col-3' > 

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
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/fertiliser') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new_fertiliser' id='new_fertiliser'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>