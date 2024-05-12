<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.parcel_soil');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/parcel-soil'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-3' > 

          <label class='control-label' for='date_analysis'><?= lang('Fmis.date_analysis') ?></label>
          <input type='text' class='form-control datepicker' name='date_analysis' id='date_analysis' value='<?= set_value('date_analysis', $row->date_analysis->toLocalizedString('d/M/Y')) ?>' required />
        </div> 
		<div class='form-group col-3' > 

          <label class='control-label' for='sand'><?= lang('Fmis.sand') ?></label>
          <input type='text' class='form-control ' name='sand' id='sand' value='<?= set_value('sand', $row->sand) ?>' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='clay'><?= lang('Fmis.clay') ?></label>
          <input type='text' class='form-control ' name='clay' id='clay' value='<?= set_value('clay', $row->clay) ?>' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='loam'><?= lang('Fmis.loam') ?></label>
          <input type='text' class='form-control ' name='loam' id='loam' value='<?= set_value('loam', $row->loam) ?>' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='nitrogen'><?= lang('Fmis.nitrogen') ?></label>
          <input type='text' class='form-control ' name='nitrogen' id='nitrogen' value='<?= set_value('nitrogen', $row->nitrogen) ?>' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='phosphorus'><?= lang('Fmis.phosphorus') ?></label>
          <input type='text' class='form-control ' name='phosphorus' id='phosphorus' value='<?= set_value('phosphorus', $row->phosphorus) ?>' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='potassium'><?= lang('Fmis.potassium') ?></label>
          <input type='text' class='form-control ' name='potassium' id='potassium' value='<?= set_value('potassium', $row->potassium) ?>' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='calcium'><?= lang('Fmis.calcium') ?></label>
          <input type='text' class='form-control ' name='calcium' id='calcium' value='<?= set_value('calcium', $row->calcium) ?>' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='magnesium'><?= lang('Fmis.magnesium') ?></label>
          <input type='text' class='form-control ' name='magnesium' id='magnesium' value='<?= set_value('magnesium', $row->magnesium) ?>' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='borium'><?= lang('Fmis.borium') ?></label>
          <input type='text' class='form-control ' name='borium' id='borium' value='<?= set_value('borium', $row->borium) ?>' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='pH'><?= lang('Fmis.pH') ?></label>
          <input type='text' class='form-control ' name='pH' id='pH' value='<?= set_value('pH', $row->pH) ?>' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='organic_compound'><?= lang('Fmis.organic_compound') ?></label>
          <input type='text' class='form-control ' name='organic_compound' id='organic_compound' value='<?= set_value('organic_compound', $row->organic_compound) ?>' required />
        </div> 

	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?= site_url('fmis/parcel/'.session()->get('parcel_id')) ?>"><?= lang('Fmis.go_back');?></a>
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