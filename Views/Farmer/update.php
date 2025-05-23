<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <h2 class='text-center'></h2>
  <div class="row d-flex flex-row justify-content-around mb-3">
    <h1 class="text-center">
      <?= $row->farmer_firstname.' '.$row->farmer_lastname ?>
      <small><small>  (ΑΦΜ: <?= $row->farmer_afm ?>)</small></small>
    </h1>
  </div>
  <div class="row d-flex flex-row justify-content-around mb-3">
    <h3 class="text-center">
      <?php
        if($row->po_name){ 
      ?>
          <small>Οργάνωση Παραγωγών: <?= $row->po_name ?> 
          <a class="btn btn-small btn-custom-green" title="Ενημέρωση ΟΠ" href="<?= site_url('fmis/farmer/show-po')?>"><i class="bi bi-pencil "></i></a>
          <a class="btn btn-small btn-danger" id="remove-po" data-item="<?= $row->id ?>" title="Αφαίρεση ΟΠ" href="#"><i class="bi bi-x-lg "></i></a></small>
      <?php
        } 
        else{ ?>
          <small>Οργάνωση Παραγωγών: <a class="btn btn-custom-green" href="<?= site_url('fmis/farmer/add-po')?>"><?= lang('Fmis.new_item');?></a></small>
      <?php    
        }
      ?>
    </h3>
  </div>
  <div class="row d-flex flex-row justify-content-around mb-3">
	<?php if(! $farmer) { ?>
	<div class="d-flex align-items-center text-custom-green setprop" data-toggle="collapse" data-target="#practices">
	  <div class="display-4">
		<i class="bi bi-signpost"></i>
	  </div>
	  <div>
		<div class="h6">Οδηγίες</div>
		<div class="h6">διαχείρισης</div>
	  </div>
	</div>
	<div class="d-flex align-items-center text-custom-green">
	  <div class="display-4">
		<i class="bi bi-list-check"></i>
	  </div>
	<a href="<?= site_url('fmis/farmer/pending')?>" style="display: flex; text-decoration: none; color: inherit;">
	  <div>
		<div class="h6">Μαζική</div>
		<div class="h6">καταγραφή</div>
	  </div>
	</a>
	</div>
	<div class="d-flex align-items-center text-custom-green setprop" data-toggle="collapse" data-target="#inputoutput">
	  <div class="display-4">
		<i class="bi bi-arrow-left-right"></i>
	  </div>
	  <div>
		<div class="h6">Εισροές</div>
		<div class="h6">εκροές</div>
	  </div>
	</div>
	<div class="d-flex align-items-center text-custom-green">
	<a href="<?= site_url('fmis/spd')?>" style="display: flex; text-decoration: none; color: inherit;">
	  <div class="display-4">
		<i class="bi bi-journal-richtext"></i>
	  </div>
	  <div>
		<div class="h6">Σχέδιο</div>
		<div class="h6">Περιβαλλοντικής</div>
		<div class="h6">Διαχείρισης</div>
	  </div>
	</a>
	</div>
	<?php } ?>
  </div>
	<hr>
  <div class='row mt-3 align-items-center justify-content-center pb-0 collapse' id='practices'>
    <div class="col-lg-3 col-md-4 col-sm-12 route-card">
      <div class="route-card-container-small px-4 pt-4 pb-4 my-2">
        <div class="route-card-small-front">
          <div class="mt-md-0 mt-4">
            <h2>Διαχείριση εδάφους</h2>
            <h3>Οδηγίες διαχείρισης εδάφους</h3>
            <p>Δημιουργήστε οδηγίες διαχείρισης εδάφους και διαχειριστείτε την εφαρμογή τους</p>
          </div>
        </div>
        <div class="route-card-small-back">
          <div class="d-flex flex-column align-items-start">
            <h3 class="mt-2 mb-2">Οδηγίες διαχείρισης εδάφους</h3>
            <p>Δημιουργήστε οδηγίες διαχείρισης εδάφους και διαχειριστείτε την εφαρμογή τους</p>
          </div>
        </div>
        <a class="overlay-link" href="<?= site_url('fmis/soil-management')?>"></a>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 route-card">
      <div class="route-card-container-small px-4 pt-4 pb-4 my-2">
        <div class="route-card-small-front">
          <div class="mt-md-0 mt-4">
            <h2>Κλάδεμα</h2>
            <h3>Διαχείριση κλαδεμάτων</h3>
            <p>Δημιουργήστε οδηγίες κλαδέματος και διαχειριστείτε την εφαρμογή τους</p>
          </div>
        </div>
        <div class="route-card-small-back">
          <div class="d-flex flex-column align-items-start">
            <h3 class="mt-2 mb-2">Διαχείριση κλαδεμάτων</h3>
            <p>Δημιουργήστε οδηγίες κλαδέματος και διαχειριστείτε την εφαρμογή τους</p>
          </div>
        </div>
        <a class="overlay-link" href="<?= site_url('fmis/pruning')?>"></a>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 route-card">
      <div class="route-card-container-small px-4 pt-4 pb-4 my-2">
        <div class="route-card-small-front">
          <div class="mt-md-0 mt-4">
            <h2>Άρδευση</h2>
            <h3>Διαχείριση αρδεύσεων</h3>
            <p>Δημιουργήστε οδηγίες άρδευσης και διαχειριστείτε την εφαρμογή τους</p>
          </div>
        </div>
        <div class="route-card-small-back">
          <div class="d-flex flex-column align-items-start">
            <h3 class="mt-2 mb-2">Διαχείριση αρδεύσεων</h3>
            <p>Δημιουργήστε οδηγίες άρδευσης και διαχειριστείτε την εφαρμογή τους</p>
          </div>
        </div>
        <a class="overlay-link" href="<?= site_url('fmis/irrigation')?>"></a>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 route-card">
      <div class="route-card-container-small px-4 pt-4 pb-4 my-2">
        <div class="route-card-small-front">
          <div class="mt-md-0 mt-4">
            <h2>Λίπανση</h2>
            <h3>Διαχείριση λιπάνσεων</h3>
            <p>Δημιουργήστε οδηγίες λίπανσης και διαχειριστείτε την εφαρμογή τους</p>
          </div>
        </div>
        <div class="route-card-small-back">
          <div class="d-flex flex-column align-items-start">
            <h3 class="mt-2 mb-2">Διαχείριση λιπάνσεων</h3>
            <p>Δημιουργήστε οδηγίες λίπανσης και διαχειριστείτε την εφαρμογή τους</p>
          </div>
        </div>
        <a class="overlay-link" href="<?= site_url('fmis/fertilisation')?>"></a>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 route-card">
      <div class="route-card-container-small px-4 pt-4 pb-4 my-2">
        <div class="route-card-small-front">
          <div class="mt-md-0 mt-4">
            <h2>Φυτοπροστασία</h2>
            <h3>Διαχείριση φυτοπροστατευτικών</h3>
            <p>Δημιουργήστε οδηγίες φυτοπροστατευτικών και διαχειριστείτε την εφαρμογή τους</p>
          </div>
        </div>
        <div class="route-card-small-back">
          <div class="d-flex flex-column align-items-start">
            <h3 class="mt-2 mb-2">Διαχείριση φυτοπροστατευτικών</h3>
            <p>Δημιουργήστε οδηγίες φυτοπροστατευτικών και διαχειριστείτε την εφαρμογή τους</p>
          </div>
        </div>
        <a class="overlay-link" href="<?= site_url('fmis/spray')?>"></a>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 route-card">
      <div class="route-card-container-small px-4 pt-4 pb-4 my-2">
        <div class="route-card-small-front">
          <div class="mt-md-0 mt-4">
            <h2>Μαζική παγίδευση</h2>
            <h3>Διαχείριση μαζικής παγίδευσης</h3>
            <p>Δημιουργήστε οδηγίες μαζικής παγίδευσης και διαχειριστείτε την εφαρμογή τους</p>
          </div>
        </div>
        <div class="route-card-small-back">
          <div class="d-flex flex-column align-items-start">
            <h3 class="mt-2 mb-2">Διαχείριση μαζικής παγίδευσης</h3>
            <p>Δημιουργήστε οδηγίες μαζικής παγίδευσης και διαχειριστείτε την εφαρμογή τους</p>
          </div>
        </div>
        <a class="overlay-link" href="<?= site_url('fmis/mass-trapping')?>"></a>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 route-card">
      <div class="route-card-container-small px-4 pt-4 pb-4 my-2">
        <div class="route-card-small-front">
          <div class="mt-md-0 mt-4">
            <h2>Συγκομιδή</h2>
            <h3>Διαχείριση συγκομιδής</h3>
            <p>Δημιουργήστε οδηγίες συγκομιδής και διαχειριστείτε την εφαρμογή τους</p>
          </div>
        </div>
        <div class="route-card-small-back">
          <div class="d-flex flex-column align-items-start">
            <h3 class="mt-2 mb-2">Διαχείριση συγκομιδής</h3>
            <p>Δημιουργήστε οδηγίες συγκομιδής και διαχειριστείτε την εφαρμογή τους</p>
          </div>
        </div>
        <a class="overlay-link" href="<?= site_url('fmis/harvesting')?>"></a>
      </div>
    </div>
  </div>
  <div class='row mt-3 align-items-center justify-content-center pb-0 collapse' id='inputoutput'>
    <div class="col-lg-3 col-md-4 col-sm-12 route-card">
      <div class="route-card-container-small px-4 pt-4 pb-4 my-2">
        <div class="route-card-small-front">
          <div class="mt-md-0 mt-4">
            <h2>Εισροές</h2>
            <h3>Διαχείριση εισροών</h3>
            <p>Διαχειριστείτε τις προμήθειες εισροών στην εκμετάλλευση</p>
          </div>
        </div>
        <div class="route-card-small-back">
          <div class="d-flex flex-column align-items-start">
            <h3 class="mt-2 mb-2">Διαχείριση εισροών</h3>
            <p>Διαχειριστείτε τις προμήθειες εισροών στην εκμετάλλευση</p>
          </div>
        </div>
        <a class="overlay-link" href="<?= site_url('fmis/farm-inputs')?>"></a>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 route-card">
      <div class="route-card-container-small px-4 pt-4 pb-4 my-2">
        <div class="route-card-small-front">
          <div class="mt-md-0 mt-4">
            <h2>Εκροές</h2>
            <h3>Διαχείριση εκροών</h3>
            <p>Διαχειριστείτε τις πωλήσεις προϊόντων από την εκμετάλλευση</p>
          </div>
        </div>
        <div class="route-card-small-back">
          <div class="d-flex flex-column align-items-start">
            <h3 class="mt-2 mb-2">Διαχείριση εκροών</h3>
            <p>Διαχειριστείτε τις πωλήσεις προϊόντων από την εκμετάλλευση</p>
          </div>
        </div>
        <a class="overlay-link" href="<?= site_url('fmis/farm-outputs')?>"></a>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 route-card">
      <div class="route-card-container-small px-4 pt-4 pb-4 my-2">
        <div class="route-card-small-front">
          <div class="mt-md-0 mt-4">
            <h2>Μητρώο</h2>
            <h3>Προβολή και εκτύπωση μητρώου</h3>
            <p>Προβάλετε και εκτυπώστε το μητρώο εισροών - εκροών της εκμετάλλευσης</p>
          </div>
        </div>
        <div class="route-card-small-back">
          <div class="d-flex flex-column align-items-start">
            <h3 class="mt-2 mb-2">Προβολή και εκτύπωση μητρώου</h3>
            <p>Προβάλετε και εκτυπώστε το μητρώο εισροών - εκροών της εκμετάλλευσης</p>
          </div>
        </div>
        <a class="overlay-link" href="<?= site_url('fmis/farm-input-output')?>"></a>
      </div>
    </div>
  </div>
  <div class='row mt-3'>
    <h4 class="mx-auto">
        Αγροτεμάχια στην εκμετάλλευση για το έτος <?= session()->get('iacs_year') ?>
    </h4>
    <div class="col-12">
     <table class="table table-striped text-custom-anthrax dtable">
      <thead>
        <tr>
          <th>Κωδικός αγροτεμαχίου</th>
          <th>A/A</th>
          <th>Περιγραφή</th>
          <th class="">Τοποθεσία</th>
          <th class="">Οικοσχήματα</th>
          <th class="text-right">Έκταση (ha)</th>
          <th>Συμβουλές</th>
        </tr>
      </thead>
      <tbody>
       <?php foreach($crops As $f){?>
         <tr>
          <td><a href="<?= site_url('fmis/parcel/'.$f->id) ?>"><?= $f->code ?></a></td>
          <td><?= $f->aa?></td>
          <td><?= $f->poiDescription?></td>
          <td class="text-right"><?= $f->location ?></td>
          <td class="text-right"><?= $f->ecoschemes ?></td>
          <td class="text-right"><?= $f->total_area ?></td>
          <td class="text-center">
            <?php if($f->soil_management_num) {
              $color = 'text-success';
              if($f->soil_management_done_num == null || $f->soil_management_done_num == 0 || $f->soil_management_num > $f->soil_management_done_num) {
                $color = 'text-danger';
              }
            ?>
              <span class="<?= $color ?>"><i class="icon-soil-mgt" title="Διαχείριση εδάφους"></i><?= $f->soil_management_num ?></span>
            <?php } ?>
            <?php if($f->pruning_num) {
              $color = 'text-success';
              if($f->pruning_done_num == null || $f->pruning_done_num == 0 || $f->pruning_num > $f->pruning_done_num) {
                $color = 'text-danger';
              }
            ?>
              <span class="<?= $color ?>"><i class="icon-pruning"  title="Κλάδεμα"></i><?= $f->pruning_num ?></span>
            <?php } ?>
            <?php if($f->irrigation_num) {
              $color = 'text-success';
              if($f->irrigation_done_num == null || $f->irrigation_done_num == 0 || $f->irrigation_num > $f->irrigation_done_num) {
                $color = 'text-danger';
              }
            ?>
              <span class="<?= $color ?>"><i class="icon-irrigation"  title="Άρδευση"></i><?= $f->irrigation_num ?></span>
            <?php } ?>
            <?php if($f->fertilisation_num) {
              $color = 'text-success';
              if($f->fertilisation_done_num == null || $f->fertilisation_done_num == 0 || $f->fertilisation_num > $f->fertilisation_done_num) {
                $color = 'text-danger';
              }
            ?>
            <span class="<?= $color ?>"><i class="icon-fertilisation"  title="Λίπανση"></i><?= $f->fertilisation_num ?></span>
            <?php } ?>
            <?php if($f->spray_num) {
              $color = 'text-success';
              if($f->spray_done_num == null || $f->spray_done_num == 0 || $f->spray_num > $f->spray_done_num) {
                $color = 'text-danger';
              }
            ?>
              <span class="<?= $color ?>"><i class="icon-ppp"  title="Φυτοπροστασία"></i><?= $f->spray_num ?></span>
            <?php } ?>
            <?php if($f->mass_trapping_num) {
              $color = 'text-success';
              if($f->mass_trapping_done_num == null || $f->mass_trapping_done_num == 0 || $f->mass_trapping_num > $f->mass_trapping_done_num) {
                $color = 'text-danger';
              }
            ?>
              <span class="<?= $color ?>"><i class="icon-trapping"  title="Μαζική παγίδευση"></i><?= $f->mass_trapping_num ?></span>
            <?php } ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
     </table>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
  $('#remove-po').click(function(e){
    e.preventDefault();
    if(confirm('Είστε σίγουροι ότι θέλετε να αφαιρέσετε την ΟΠ;')){
      var item_id = $(this).data('item'); 
      var theurl = "<?= site_url('fmis/farmer/remove-po') ?>";
      $.ajax({
        url: theurl,
        type: 'POST',
        data: {item_id: item_id},
        success: function(response){
          location.reload();
          alert(response.message);
        }
      });
    }
  });
</script>
<?= $this->endSection() ?>