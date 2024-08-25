<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
	<h2 class='text-center'><?= lang('Fmis.farmer_pending');?></h2>
	<div class='row'>
		<?php if(count($rows) > 0){?>
		<div class='col-9'>
		</div>
		<div class='col-3 mb-3'>
			<div class="dropdown text-right">
			  <button class="btn btn-custom-green dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?= lang('Fmis.new_item');?>
			  </button>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="<?= site_url('fmis/fertilisation-bulk-new') ?>"><?= lang('Fmis.fparcel');?></a>
				<a class="dropdown-item" href="<?= site_url('fmis/pruning-bulk-new') ?>"><?= lang('Fmis.pparcel');?></a>
				<a class="dropdown-item" href="<?= site_url('fmis/soil-management-bulk-new') ?>"><?= lang('Fmis.smparcel');?></a>
				<a class="dropdown-item" href="<?= site_url('fmis/mass-trapping-bulk-new') ?>"><?= lang('Fmis.mparcel');?></a>
				<a class="dropdown-item" href="<?= site_url('fmis/irrigation-bulk-new') ?>"><?= lang('Fmis.iparcel');?></a>
				<a class="dropdown-item" href="<?= site_url('fmis/spray-bulk-new') ?>"><?= lang('Fmis.sparcel');?></a>
			  </div>
			</div>        
		</div>
	</div>
	<div class='row mt-3'>
		<div class='col-12'>
			<table class='table table-hover table-striped dtable'>
				<thead>
					<tr>
						<th>Οδηγία</th>
						<th>Ημερομηνία</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($rows As $r) { ?>
						<tr>
							<td><a href="<?= site_url('fmis/'.$r->farm_practice_en.'-bulk/'.$r->practice_id) ?>" > <?= $r->farm_practice ?> </a></td>
							<td data-sort="'<?= $r->dir_date?>'"><?= $r->dir_date->toLocalizedString('d/M/Y') ?></td>
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