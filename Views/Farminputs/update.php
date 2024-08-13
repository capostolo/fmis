<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= $caption;?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/farm-inputs'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-4' > 

          <label class='control-label' for='invoice_num'><?= lang('Fmis.invoice_num') ?></label>
          <input type='text' class='form-control ' name='invoice_num' id='invoice_num' value='<?= set_value('invoice_num', $row->invoice_num) ?>' required />
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='invoice_date'><?= lang('Fmis.invoice_date') ?></label>
          <input type='text' class='form-control datepicker' name='invoice_date' id='invoice_date' value='<?= set_value('invoice_date', $row->invoice_date->toLocalizedString('d/M/Y')) ?>' required />
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='supplier_id'><?= lang('Fmis.supplier_id') ?></label>
          <select class='form-control' name='supplier_id' id='supplier_id' required>
            <option value=''><?= lang('Fmis.supplier_id') ?></option>
            <?php foreach($supplier As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('supplier_id', $r->id, $r->id == $row->supplier_id) ?>> <?= $r->supplier_name ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-12' > 

          <label class='control-label' for='input_id'><?= lang('Fmis.input_id') ?></label>
          <select class='form-control' name='input_id' id='input_id' required>
            <option value=''><?= lang('Fmis.input_id') ?></option>
            <?php foreach($input As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('input_id', $r->id, $r->id == $row->input_id) ?>> <?= $r->description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='packages'><?= lang('Fmis.packages') ?></label>
          <input type='text' class='form-control ' name='packages' id='packages' value='<?= set_value('packages', $row->packages) ?>' required />
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='unit_quantity'><?= lang('Fmis.unit_quantity') ?></label>
          <input type='text' class='form-control ' name='unit_quantity' id='unit_quantity' value='<?= set_value('unit_quantity', $row->unit_quantity) ?>' required />
        </div> 
<div class='form-group col-4' > 

          <label class='control-label' for='unit_measurement_id'><?= lang('Fmis.unit_measurement_id') ?></label>
          <select class='form-control' name='unit_measurement_id' id='unit_measurement_id' required>
            <option value=''><?= lang('Fmis.unit_measurement_id') ?></option>
            <?php foreach($unit_measurement As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('unit_measurement_id', $r->id, $r->id == $row->unit_measurement_id) ?>> <?= $r->unit_measurement_description ?> </option>
            <?php } ?>
          </select>
        </div> 

	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?= site_url('fmis/farm-inputs') ?>"><?= lang('Fmis.go_back');?></a>
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