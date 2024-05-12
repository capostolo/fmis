<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
	<h2 class='text-center'><?= lang('Fmis.farmer');?></h2>
  <?php
  $attributes = array('class' => 'form', 'id' => 'add-farmer');
  echo form_open(site_url(), $attributes);
  ?>
  <div class='row mt-4'>
    <div class="col-12 text-danger mb-3">
      <table>
        <tr>
          <td class="text-center" width="10%"><i class="bi bi-exclamation-triangle" style="font-size: 2rem;"></i></td>
          <td>Η λειτουργία θα είναι διαθέσιμη εφόσον ο ΟΠΕΚΕΠΕ ολοκληρώσει τις διαδικασίες για την παροχή εξουσιοδοτημένης πρόσβασης στα δεδομένα του συστήματος Ενιαίας Αίτησης Ενίσχυσης.</td>
        </tr>
      </table>
      
    </div>
    <div class='col-9'> 
      <input type='text' class='form-control ' name='farmer_afm' id='farmer_afm' placeholder="ΑΦΜ παραγωγού" required />
    </div> 
    <div class='col-3'>
      <button class='btn btn-custom-green form-control' type="submit" disabled><?= lang('Fmis.new_item');?></button>
    </div>
  </div>
  <?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>