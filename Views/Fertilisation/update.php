<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
	<div class="text-custom-anthrax text-center">
		<h2><?= lang('Fmis.fertilisation');?></h2>
		<p class="lead"></p>
		<p class=""></p>
	</div>
	<?php
	$attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/fertilisation'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-3' > 
          <label class='control-label' for='dir_date'><?= lang('Fmis.dir_date') ?></label>
          <input type='text' class='form-control datepicker' name='dir_date' id='dir_date' value='<?= set_value('dir_date', $row->dir_date->toLocalizedString('d/M/Y')) ?>' required <?= $disabled ?>/>
        </div> 
		<div class='form-group col-3' > 
          <label class='control-label' for='fertiliser_id'><?= lang('Fmis.fertiliser_id') ?></label>
          <select class='form-control selectpicker' name='fertiliser_id' id='fertiliser_id' data-live-search='true' data-style='' data-style-base='form-control' data-virtual-scroll='200' required <?= $disabled ?>>
            <option value=''><?= lang('Fmis.fertiliser_id') ?></option>
            <?php foreach($fertiliser As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('fertiliser_id', $r->id, $r->id == $row->fertiliser_id) ?>> <?= $r->fertiliser_description ?><?= !empty($r->code) ? " ($r->code)" : "" ?> </option>
            <?php } ?>
          </select>
        </div> 
		<div class='form-group col-3' > 
          <label class='control-label' for='quantity'><?= lang('Fmis.quantity') ?></label>
          <input type='text' class='form-control ' name='quantity' id='quantity' value='<?= set_value('quantity', $row->quantity) ?>' required <?= $disabled ?>/>
        </div> 
		<div class='form-group col-3' > 
          <label class='control-label' for='unit_measurement_id'><?= lang('Fmis.unit_measurement_id') ?></label>
          <select class='form-control' name='unit_measurement_id' id='unit_measurement_id' required <?= $disabled ?>>
            <option value=''><?= lang('Fmis.unit_measurement_id') ?></option>
            <?php foreach($unit_measurement As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('unit_measurement_id', $r->id, $r->id == $row->unit_measurement_id) ?>> <?= $r->unit_measurement_description ?> </option>
            <?php } ?>
          </select>
        </div> 
		<div class='form-group col-3' > 
          <label class='control-label' for='fertiliser_application_id'><?= lang('Fmis.fertiliser_application_id') ?></label>
          <select class='form-control' name='fertiliser_application_id' id='fertiliser_application_id' required <?= $disabled ?>>
            <option value=''><?= lang('Fmis.fertiliser_application_id') ?></option>
            <?php foreach($fertiliser_application As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('fertiliser_application_id', $r->id, $r->id == $row->fertiliser_application_id) ?>> <?= $r->fertiliser_application_description ?> </option>
            <?php } ?>
          </select>
        </div> 
		<div class='form-group col-3' > 
          <label class='control-label' for='farming_stage_id'><?= lang('Fmis.farming_stage_id') ?></label>
          <select class='form-control' name='farming_stage_id' id='farming_stage_id' required <?= $disabled ?>>
            <option value=''><?= lang('Fmis.farming_stage_id') ?></option>
            <?php foreach($farming_stage As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('farming_stage_id', $r->id, $r->id == $row->farming_stage_id) ?>> <?= $r->farming_stage_description ?> </option>
            <?php } ?>
          </select>
        </div> 
		<div class='form-group col-3' > 
          <label class='control-label' for='fertilise_equipment_id'><?= lang('Fmis.fertilise_equipment_id') ?></label>
          <select class='form-control' name='fertilise_equipment_id' id='fertilise_equipment_id' required <?= $disabled ?>>
            <option value=''><?= lang('Fmis.fertilise_equipment_id') ?></option>
            <?php foreach($fertilise_equipment As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('fertilise_equipment_id', $r->id, $r->id == $row->fertilise_equipment_id) ?>> <?= $r->fertilise_equipment_description ?> </option>
            <?php } ?>
          </select>
        </div> 
		<div class='form-group col-3' > 
          <label class='control-label' for='specialised_fertiliser_id'><?= lang('Fmis.specialised_fertiliser_id') ?></label>
          <select class='form-control' name='specialised_fertiliser_id' id='specialised_fertiliser_id' required <?= $disabled ?>>
            <option value=''><?= lang('Fmis.specialised_fertiliser_id') ?></option>
            <?php foreach($specialised_fertiliser As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('specialised_fertiliser_id', $r->id, $r->id == $row->specialised_fertiliser_id) ?>> <?= $r->specialised_fertiliser_description ?> </option>
            <?php } ?>
          </select>
        </div> 

	</div>
	<div class="row mt-3">
		<h4 class="mx-auto">
			Αγροτεμάχια που αφορά η οδηγία
		</h4>
		<div class="col-12">
		<table class="table table-striped dstable text-custom-anthrax">
			<thead>
				<tr>
					<th><a href='#'><i class="far fa-square" aria-hidden="true" id="selectAll"></i></a></th>
					<th>Κωδικός αγροτεμαχίου</th>
					<th>Τοποθεσία</th>
					<th>Περιγραφή</th>
					<th class="text-right">Επιλέξιμη έκταση (ha)</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($crops As $f){?>
				<tr>
					<td>
						<input type='checkbox' class="selectMe" name='fi_selected[]' value="<?= $f->id ?>" <?= ($f->fertilisation_parcel_id) ? 'checked' : '' ?> <?= $disabled ?>/>
					</td>
					<td><a href="<?= site_url('fmis/parcel/'.$f->id) ?>"><?= $f->code ?></a></td>
					<td><?= $f->location ?></td>
					<td><?= $f->poiDescription?></td>
					<td class="text-right"><?= $f->total_area ?></td>
					<td></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
      </div>
    </div>

	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?= site_url('fmis/farmer/'.session()->get('farmer_id')) ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-custom-green form-control' name='new' id='newfeedform'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>