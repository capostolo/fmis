<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <h2 class='text-center'></h2>
  <div class="row d-flex flex-column mb-3">
    <h1 class="text-center">
      <?= $row->farmer_firstname.' '.$row->farmer_lastname ?>
      <small><small>  (ΑΦΜ: <?= $row->farmer_afm ?>)</small></small>
    </h1>
	<?php if(! $farmer) { ?>
    <div class="text-center">
      <button class="btn btn-custom-green dropdown-toggle" data-toggle="collapse" data-target="#practices">Οδηγίες διαχείρισης</button>
    </div>
	<?php } ?>
  </div>
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
  <div class='row mt-3'>
    <div class="col-12">
     <table class="table table-striped text-custom-anthrax dtable">
      <thead>
        <tr>
          <th>Κωδικός αγροτεμαχίου</th>
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
              <span class="<?= $color ?>"><i class="bi bi-bullseye" title="Διαχείριση εδάφους"></i><?= $f->soil_management_num ?></span>
            <?php } ?>
            <?php if($f->pruning_num) {
              $color = 'text-success';
              if($f->pruning_done_num == null || $f->pruning_done_num == 0 || $f->pruning_num > $f->pruning_done_num) {
                $color = 'text-danger';
              }
            ?>
              <span class="<?= $color ?>"><i class="bi bi-scissors"  title="Κλάδεμα"></i><?= $f->pruning_num ?></span>
            <?php } ?>
            <?php if($f->irrigation_num) {
              $color = 'text-success';
              if($f->irrigation_done_num == null || $f->irrigation_done_num == 0 || $f->irrigation_num > $f->irrigation_done_num) {
                $color = 'text-danger';
              }
            ?>
              <span class="<?= $color ?>"><i class="bi bi-droplet"  title="Άρδευση"></i><?= $f->irrigation_num ?></span>
            <?php } ?>
            <?php if($f->fertilisation_num) {
              $color = 'text-success';
              if($f->fertilisation_done_num == null || $f->fertilisation_done_num == 0 || $f->fertilisation_num > $f->fertilisation_done_num) {
                $color = 'text-danger';
              }
            ?>
            <span class="<?= $color ?>"><i class="bi bi-capsule"  title="Λίπανση"></i><?= $f->fertilisation_num ?></span>
            <?php } ?>
            <?php if($f->spray_num) {
              $color = 'text-success';
              if($f->spray_done_num == null || $f->spray_done_num == 0 || $f->spray_num > $f->spray_done_num) {
                $color = 'text-danger';
              }
            ?>
              <span class="<?= $color ?>"><i class="bi bi-bug"  title="Φυτοπροστασία"></i><?= $f->spray_num ?></span>
            <?php } ?>
            <?php if($f->mass_trapping_num) {
              $color = 'text-success';
              if($f->mass_trapping_done_num == null || $f->mass_trapping_done_num == 0 || $f->mass_trapping_num > $f->mass_trapping_done_num) {
                $color = 'text-danger';
              }
            ?>
              <span class="<?= $color ?>"><i class="bi bi-bag"  title="Μαζική παγίδευση"></i><?= $f->mass_trapping_num ?></span>
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

<?= $this->endSection() ?>