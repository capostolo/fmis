<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.farm_outputs');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/farm-outputs'), $attributes);
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

          <label class='control-label' for='buyer_id'><?= lang('Fmis.buyer_id') ?></label>
          <select class='form-control' name='buyer_id' id='buyer_id' required>
            <option value=''><?= lang('Fmis.buyer_id') ?></option>
            <?php foreach($buyer As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('buyer_id', $r->id, $r->id == $row->buyer_id) ?>> <?= $r->buyer_name ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='output_type'><?= lang('Fmis.output_type') ?></label>
          <input type='text' class='form-control ' name='output_type' id='output_type' value='<?= set_value('output_type', $row->output_type) ?>' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='output_name'><?= lang('Fmis.output_name') ?></label>
          <input type='text' class='form-control ' name='output_name' id='output_name' value='<?= set_value('output_name', $row->output_name) ?>' required />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='output_quantity'><?= lang('Fmis.output_quantity') ?></label>
          <input type='text' class='form-control ' name='output_quantity' id='output_quantity' value='<?= set_value('output_quantity', $row->output_quantity) ?>' required />
        </div> 
<div class='form-group col-3' > 

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
			<a class='btn btn-default form-control' href="<?= site_url('fmis/farm-outputs') ?>"><?= lang('Fmis.go_back');?></a>
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