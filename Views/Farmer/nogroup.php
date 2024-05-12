<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
	<h2 class='text-center'><?= lang('Fmis.no_group');?></h2>
  <div class='row mt-4'>
    <div class='col-2'> 
    </div> 
    <div class='col-8'> 
      <p>
        Δεν σας έχουν αποδοθεί δικαιώματα ακόμη.
      </p>
      <p>
        Έχει ενημερωθεί ο διαχειριστής χρηστών και πολύ σύντομα θα σας αποδοθούν τα κατάλληλα δικαιώματα, ανάλογα με τα στοιχεία εγγραφής σας.
      </p>
      <p>
        Όταν ολοκληρωθεί η διαδικασία, θα ενημερωθείτε με μήνυμα στη διεύθυνση email που καταχωρίσατε.
      </p>
    </div> 
    <div class='col-2'>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>