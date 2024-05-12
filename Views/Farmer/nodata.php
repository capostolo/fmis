<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
	<h2 class='text-center'><?= lang('Fmis.farmer');?></h2>
  <div class='row mt-4'>
    <div class='col-2'> 
    </div> 
    <div class='col-8'> 
      <p>
        Δεν υπάρχουν στην εφαρμογή καταχωρισμένα δεδομένα σχετικά με την εκμετάλλευσή σας.
      </p>
      <p>
        Η καταχώριση των δεδομένων πραγματοποιείται αποκλειστικά με μεταφορά τους από το σύστημα Ενιαίας Αίτησης Ενίσχυσης του ΟΠΕΚΕΠΕ.
      </p>
      <p>
        Για την καταχώριση των δεδομένων της εκμετάλλευσή σας ακολουθήστε τον παρακάτω σύνδεσμο ή επικοινωνήστε με το γεωργικό σας σύμβουλο.
      </p>
      <p class="text-center">
        <a class="btn btn-custom-green" href="<?= site_url('fmis/farmer/new') ?>">Προσθήκη νέας εκμετάλλευσης</a>
      </p>
    </div> 
    <div class='col-2'>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>