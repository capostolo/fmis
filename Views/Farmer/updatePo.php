<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
	<h2 class='text-center'><?= lang('Fmis.po_id');?></h2>
    <?php
    $attributes = array('class' => 'form', 'id' => 'add-farmer');
    echo form_open(site_url('fmis/farmer/add-po'), $attributes);
    ?>
    <div class='row mt-4'>
    <div class='form-group col-9' > 
        <select class='form-control' name='farmer_po_id' id='farmer_po_id' required>
        <option value=''><?= lang('Fmis.po_name') ?></option>
        <?php foreach($po As $r) { ?>
        <option value='<?= $r->id ?>' <?= set_select('farmer_po_id', $r->id, $r->id == $farmer_po_id) ?> > <?= $r->po_name ?> </option>
        <?php } ?>
        </select>
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