<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.parcel_soil');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-parcel_soil');
	echo form_open(site_url('fmis/parcel-soil'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-3' > 

          <label class='control-label' for='date_analysis'><?= lang('Fmis.date_analysis') ?></label>
          <input type='text' class='form-control datepicker' name='date_analysis' id='date_analysis' required />
        </div> 
		<div class='form-group col-3' > 

          <label class='control-label' for='sand'><?= lang('Fmis.sand') ?></label>
          <input type='text' class='form-control ' name='sand' id='sand' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='clay'><?= lang('Fmis.clay') ?></label>
          <input type='text' class='form-control ' name='clay' id='clay' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='loam'><?= lang('Fmis.loam') ?></label>
          <input type='text' class='form-control ' name='loam' id='loam' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='nitrogen'><?= lang('Fmis.nitrogen') ?></label>
          <input type='text' class='form-control ' name='nitrogen' id='nitrogen' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='phosphorus'><?= lang('Fmis.phosphorus') ?></label>
          <input type='text' class='form-control ' name='phosphorus' id='phosphorus' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='potassium'><?= lang('Fmis.potassium') ?></label>
          <input type='text' class='form-control ' name='potassium' id='potassium' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='calcium'><?= lang('Fmis.calcium') ?></label>
          <input type='text' class='form-control ' name='calcium' id='calcium' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='magnesium'><?= lang('Fmis.magnesium') ?></label>
          <input type='text' class='form-control ' name='magnesium' id='magnesium' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='borium'><?= lang('Fmis.borium') ?></label>
          <input type='text' class='form-control ' name='borium' id='borium' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='pH'><?= lang('Fmis.pH') ?></label>
          <input type='text' class='form-control ' name='pH' id='pH' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='organic_compound'><?= lang('Fmis.organic_compound') ?></label>
          <input type='text' class='form-control ' name='organic_compound' id='organic_compound' required />
        </div> 

	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/parcel/'.session()->get('parcel_id')) ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new_parcel_soil' id='new_parcel_soil'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>