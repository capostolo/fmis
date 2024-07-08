<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
	<div class="text-custom-anthrax text-center">
		<h2><?= lang('Fmis.spd');?></h2>
		<p class="lead"></p>
		<p class=""></p>
	</div>
	<div class='row'>
	<?php if(count($rows) > 0){?>
		<div class='col-9'>
		</div>
		<div class='col-3'>
		</div>
	</div>
	<div class='row mt-3'>
		<div class='col-12'>
			<table class='table table-hover table-striped dmtable'>
				<thead>
					<tr>
						<th><?= lang('Fmis.iacs_year');?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($rows As $r) { ?>
						<tr>
							<td><a href="<?= site_url('fmis/spd/'.$r->iacs_year) ?>" target="_blank"> <?= $r->iacs_year ?> </a><i class="ag-irrigation ag-small ag-default"></i></td>
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
			</p>
		</div>
	<?php } ?>
		</div>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>