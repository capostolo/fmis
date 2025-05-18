<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.pruning');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-pruning');
	echo form_open(site_url('fmis/pruning'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-3' > 
          <label class='control-label' for='dir_date'><?= lang('Fmis.dir_date') ?> <span class="text-danger">*</span></label>
          <input type='text' class='form-control datepicker' name='dir_date' id='dir_date' value='<?= set_value('dir_date', $row->dir_date->toLocalizedString('d/M/Y')) ?>' required />
          <small class="text-muted">Μορφή: ΗΗ/ΜΜ/ΕΕΕΕ</small>
        </div> 
<div class='form-group col-3' > 
          <label class='control-label' for='pruning_type_id'><?= lang('Fmis.pruning_type_id') ?> <span class="text-danger">*</span></label>
          <select class='form-control' name='pruning_type_id' id='pruning_type_id' required>
            <option value=''><?= lang('Fmis.pruning_type_id') ?></option>
            <?php foreach($pruning_type As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('pruning_type_id', $r->id, $r->id == $row->pruning_type_id) ?>> <?= $r->pruning_type_description ?><?= !empty($r->code) ? " ($r->code)" : "" ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-3' > 
          <label class='control-label' for='pruning_equipment_id'><?= lang('Fmis.pruning_equipment_id') ?> <span class="text-danger">*</span></label>
          <select class='form-control' name='pruning_equipment_id' id='pruning_equipment_id' required>
            <option value=''><?= lang('Fmis.pruning_equipment_id') ?></option>
            <?php foreach($pruning_equipment As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('pruning_equipment_id', $r->id, $r->id == $row->pruning_equipment_id) ?>> <?= $r->pruning_equipment_description ?> </option>
            <?php } ?>
          </select>
        </div> 
<div class='form-group col-3' > 
          <label class='control-label' for='farming_stage_id'><?= lang('Fmis.farming_stage_id') ?> <span class="text-danger">*</span></label>
          <select class='form-control' name='farming_stage_id' id='farming_stage_id' required>
            <option value=''><?= lang('Fmis.farming_stage_id') ?></option>
            <?php foreach($farming_stage As $r) { ?>
            <option value='<?= $r->id ?>' <?= set_select('farming_stage_id', $r->id, $r->id == $row->farming_stage_id) ?>> <?= $r->farming_stage_description ?> </option>
            <?php } ?>
          </select>
        </div> 

	</div>
      <div class="row mt-3">
      <h4 class="mx-auto">
         Αγροτεμάχια που αφορά η οδηγία <span class="text-danger">*</span>
      </h4>
      <div class="col-12">
      <table class="table table-striped dstable text-custom-anthrax">
        <thead>
          <tr>
            <th><a href='#'><i class="bi bi-square" aria-hidden="true" id="selectAll"></i></a></th>
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
              <input type='checkbox' class="selectMe" name='fi_selected[]' value="<?= $f->id ?>" <?= ($f->pruning_parcel_id) ? 'checked' : '' ?>/>
            </td>
            <td><a href="<?= site_url('crop/'.$f->id) ?>"><?= $f->code ?></a></td>
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
			<button class='btn btn-custom-green form-control' name='new_pruning' id='new_pruning'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
$(document).ready(function() {
  // Check if we have any checkboxes selected initially
  const initialSelectedCount = $('.selectMe:checked').length;
  const selectAllIcon = $('#selectAll');
  
  // Set the correct icon for the "Select All" button based on initial state
  if (initialSelectedCount > 0 && initialSelectedCount === $('.selectMe').length) {
    selectAllIcon.removeClass('fa-square').addClass('fa-check-square');
  }

  // Select all checkboxes functionality
  selectAllIcon.on('click', function(e) {
    e.preventDefault();
    const isSelected = $(this).hasClass('fa-check-square');
    
    $('.selectMe').prop('checked', !isSelected);
    
    if (isSelected) {
      $(this).removeClass('fa-check-square').addClass('fa-square');
    } else {
      $(this).removeClass('fa-square').addClass('fa-check-square');
    }
  });

  // Form validation
  $('#update-pruning').on('submit', function(e) {
    let isValid = true;
    let errorMessage = '';
    
    // Check date
    const dirDate = $('#dir_date');
    if (!dirDate.val()) {
      isValid = false;
      errorMessage += 'Η ημερομηνία εφαρμογής είναι υποχρεωτική.\n';
      dirDate.addClass('is-invalid');
    } else {
      // Simple date format validation (dd/mm/yyyy)
      const dateRegex = /^\d{2}\/\d{2}\/\d{4}$/;
      if (!dateRegex.test(dirDate.val())) {
        isValid = false;
        errorMessage += 'Η ημερομηνία πρέπει να είναι της μορφής ΗΗ/ΜΜ/ΕΕΕΕ.\n';
        dirDate.addClass('is-invalid');
      } else {
        dirDate.removeClass('is-invalid');
      }
    }
    
    // Check dropdowns
    const requiredSelects = [
      { id: 'pruning_type_id', message: 'Ο τύπος κλαδέματος είναι υποχρεωτικός.' },
      { id: 'pruning_equipment_id', message: 'Ο εξοπλισμός κλαδέματος είναι υποχρεωτικός.' },
      { id: 'farming_stage_id', message: 'Το στάδιο καλλιέργειας είναι υποχρεωτικό.' }
    ];
    
    $.each(requiredSelects, function(index, item) {
      const select = $('#' + item.id);
      if (!select.val()) {
        isValid = false;
        errorMessage += item.message + '\n';
        select.addClass('is-invalid');
      } else {
        select.removeClass('is-invalid');
      }
    });
    
    // Check if at least one parcel is selected
    if ($('.selectMe:checked').length === 0) {
      isValid = false;
      errorMessage += 'Πρέπει να επιλέξετε τουλάχιστον ένα αγροτεμάχιο.\n';
      
      // Add visual indication that parcels need to be selected
      $('.dstable').addClass('table-danger');
      setTimeout(function() {
        $('.dstable').removeClass('table-danger');
      }, 2000);
    }
    
    if (!isValid) {
      e.preventDefault();
      alert('Παρακαλώ διορθώστε τα ακόλουθα λάθη:\n\n' + errorMessage);
    }
  });
  
  // Add visual feedback to form elements
  $('input, select').on('focus', function() {
    $(this).addClass('border-primary');
  }).on('blur', function() {
    $(this).removeClass('border-primary');
    
    // Validate on blur
    if ($(this).prop('required') && !$(this).val()) {
      $(this).addClass('is-invalid');
    } else {
      $(this).removeClass('is-invalid');
    }
  });
});
</script>
<?= $this->endSection() ?>