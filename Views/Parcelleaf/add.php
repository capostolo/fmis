<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.parcel_leaf');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-parcel_leaf');
	echo form_open(site_url('fmis/parcel-leaf'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-3' > 

          <label class='control-label' for='date_analysis'><?= lang('Fmis.date_analysis') ?></label>
          <input type='text' class='form-control datepicker' name='date_analysis' id='date_analysis' required />
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

          <label class='control-label' for='ferrum'><?= lang('Fmis.ferrum') ?></label>
          <input type='text' class='form-control ' name='ferrum' id='ferrum' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='zincum'><?= lang('Fmis.zincum') ?></label>
          <input type='text' class='form-control ' name='zincum' id='zincum' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='cuprum'><?= lang('Fmis.cuprum') ?></label>
          <input type='text' class='form-control ' name='cuprum' id='cuprum' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='manganese'><?= lang('Fmis.manganese') ?></label>
          <input type='text' class='form-control ' name='manganese' id='manganese' required />
        </div> 

	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/parcel/'.session()->get('parcel_id')) ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new_parcel_leaf' id='new_parcel_leaf'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>