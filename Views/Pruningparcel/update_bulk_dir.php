<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.pruning');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/pruning-bulk'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-3' > 

          <label class='control-label' for='dir_date'><?= lang('Fmis.dir_date') ?></label>
          <input type='text' class='form-control datepicker' name='dir_date' id='dir_date' value='<?= set_value('dir_date', $row->dir_date->toLocalizedString('d/M/Y')) ?>' required <?= $disabled ?> />
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='pruning_type_id'><?= lang('Fmis.pruning_type_id') ?></label>
          <select class='form-control' name='pruning_type_id' id='pruning_type_id' required <?= $disabled ?>>
            <option value=''><?= lang('Fmis.pruning_type_id') ?></option>
            <?php foreach($pruning_type As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('pruning_type_id', $r->id, $r->id == $row->pruning_type_id) ?>> <?= $r->pruning_type_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-3' > 

          <label class='control-label' for='pruning_equipment_id'><?= lang('Fmis.pruning_equipment_id') ?></label>
          <select class='form-control' name='pruning_equipment_id' id='pruning_equipment_id' required <?= $disabled ?>>
            <option value=''><?= lang('Fmis.pruning_equipment_id') ?></option>
            <?php foreach($pruning_equipment As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('pruning_equipment_id', $r->id, $r->id == $row->pruning_equipment_id) ?>> <?= $r->pruning_equipment_description ?> </option>
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
              <input type='checkbox' class="selectMe" name='fi_selected[]' value="<?= $f->parcel_id ?>" <?= ($f->pruning_parcel_id) ? 'checked' : '' ?> <?= $disabled ?>/>
            </td>
            <td><a href="<?= site_url('crop/'.$f->id) ?>"><?= $f->code ?></a></td>
            <td class="text-right"><?= $f->location ?></td>
            <td><?= $f->poiDescription?></td>
            <td class="text-right"><?= $f->total_area ?></td>
            <td></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      </div>
    </div>
	<div class='row mt-3'>
		<div class="col-12 text-center">
			<h4>
				Πρόσθετες πληροφορίες εφαρμογής
			</h4>
		</div>
		<div class="form-group col-6">
			<label for="start_date" class="control-label"><?= lang('Fmis.practice_start_date');?> </label>
			<input type="text" class="form-control datepicker" name="start_date" id="start_date" required>
		</div>
		<div class="form-group col-6">
			<label for="end_date" class="control-label"><?= lang('Fmis.practice_end_date');?> </label>
			<input type="text" class="form-control datepicker" name="end_date" id="end_date" required>
		</div>
	</div>

	<div class='row mt-3'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?= site_url('fmis/farmer/'.session()->get('farmer_id')) ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-custom-green form-control' name='new' id='newfeedform'><?= lang('Fmis.apply');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>