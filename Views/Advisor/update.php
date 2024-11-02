<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.advisor') ?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
	$attributes = array('class' => 'form', 'id' => 'add-advisor');
	echo form_open(site_url('fmis/advisor'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-6' > 
          <label class='control-label' for='advisor_firstname'><?= lang('Fmis.advisor_firstname') ?></label>
          <input type='text' class='form-control' name='advisor_firstname' id='advisor_firstname' value='<?= set_value('advisor_firstname', $row->advisor_firstname) ?>' required />
        </div> 
		<div class='form-group col-6' > 
          <label class='control-label' for='advisor_lastname'><?= lang('Fmis.advisor_lastname') ?></label>
          <input type='text' class='form-control' name='advisor_lastname' id='advisor_lastname' value='<?= set_value('advisor_lastname', $row->advisor_lastname) ?>' required />
        </div> 
		<div class='form-group col-4' > 
          <label class='control-label' for='advisor_afm'><?= lang('Fmis.advisor_afm') ?></label>
          <input type='text' class='form-control ' name='advisor_afm' id='advisor_afm' value='<?= set_value('advisor_afm', $row->advisor_afm) ?>' required />
    	</div> 
		<div class='form-group col-4' > 
          <label class='control-label' for='advisor_geotee'><?= lang('Fmis.advisor_geotee') ?></label>
          <input type='text' class='form-control' name='advisor_geotee' id='advisor_geotee' value='<?= set_value('advisor_geotee', $row->advisor_geotee) ?>' required />
        </div> 
		<div class='form-group col-4' > 
          <label class='control-label' for='advisor_employment'><?= lang('Fmis.advisor_employment') ?></label>
          <select class='form-control' name='advisor_employment' id='advisor_employment' required>
            <option value=''><?= lang('Fmis.advisor_employment') ?></option>
            <option value='1' <?= set_select('advisor_employment', $row->advisor_employment, $row->advisor_employment == 1) ?>> Μισθωτός </option>
            <option value='2' <?= set_select('advisor_employment', $row->advisor_employment, $row->advisor_employment == 2) ?>> Μέτοχος </option>
            <option value='3' <?= set_select('advisor_employment', $row->advisor_employment, $row->advisor_employment == 3) ?>> Με δελτίο παροχής υπηρεσιών </option>
            <option value='4' <?= set_select('advisor_employment', $row->advisor_employment, $row->advisor_employment == 4) ?>> Άλλο </option>
          </select>
        </div> 
	</div>
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?php echo site_url('fmis/advisor') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new_farm_inputs' id='new_farm_inputs'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>