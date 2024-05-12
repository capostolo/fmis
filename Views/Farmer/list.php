<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
	<h2 class='text-center'><?= lang('Fmis.farmer');?></h2>
	<div class='row'>
		<?php if(count($rows) > 0){?>
    <div class='col-9'>
    </div>
    <div class='col-3'>
      <a class='btn btn-custom-green form-control' href='<?= site_url('fmis/farmer/new') ?>'><?= lang('Fmis.new_item');?></a>
    </div>
 </div>
	<div class='row mt-3'>
		<div class='col-12'>
			<table class='table table-hover table-striped dtable'>
				<thead>
					<tr>
						<th>ΑΦΜ</th>
						<th>Ονοματεπώνυμο</th>
						<th>Έδρα</th>
						<th>Τηλέφωνο</th>
						<th>email</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($rows As $r) { ?>
						<tr>
							<td><a href="<?= site_url('fmis/farmer/'.$r->id) ?>" > <?= $r->farmer_afm ?> </a></td>
							<td><?= $r->farmer_firstname.' '.$r->farmer_lastname?></td>
							<td></td>
							<td><?= $r->farmer_mobile?></td>
							<td><?= $r->farmer_email?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php }
			else {?>
      <div class='col-12'>
        <p class='lead text-center'>
          <?= lang('Fmis.no_data');?>
        </p>
      </div>
      <div class='col-12'>
        <p class='text-center'>
          <a class='btn btn-custom-green' href='<?= site_url('fmis/farming-stage/new') ?>'><?= lang('Fmis.new_item');?></a>
        </p>
      </div>
			<?php } ?>
		</div>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>