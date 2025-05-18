<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
	<h2 class='text-center'><?= lang('Fmis.farmer');?></h2>
  <?php
  $attributes = array('class' => 'form', 'id' => 'add-farmer');
  echo form_open_multipart(site_url('fmis/farmer/add-from-json'), $attributes);
  ?>
  <div class='row mt-4'>
  <div class="col-9 form-group">
        <input type="file" class="form-control" name="jsonFile" accept="application/json">
    </div>
    <div class='col-3'>
      <button class='btn btn-custom-green form-control' type="submit" ><?= lang('Fmis.new_item');?></button>
    </div>
  </div>
  <?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>