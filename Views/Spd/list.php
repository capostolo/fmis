<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
	<div class="text-custom-anthrax text-center">
		<h2><?= lang('Fmis.spd');?></h2>
		<p class="lead">Registrations for year <?= $year ?></p>
	</div>
	
	<?php if(count($rows) > 0): ?>
	<div class='row mt-3'>
		<div class='col-12'>
			<div class="table-responsive">
				<table class='table table-hover table-striped dmtable'>
					<thead>
						<tr>
							<th>Code</th>
							<th>Description</th>
							<th>Location</th>
							<th>Area</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($rows As $r) { ?>
							<tr>
								<td><?= esc($r->code) ?></td>
								<td><?= esc($r->poiDescription) ?></td>
								<td><?= esc($r->location) ?></td>
								<td><?= number_format($r->total_area, 2) ?></td>
								<td>
									<a href="<?= site_url('fmis/parcel/'.$r->id) ?>" class="btn btn-sm btn-primary">View Details</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			
			<!-- Pagination -->
			<div class="d-flex justify-content-center mt-4">
				<?= $pager->links() ?>
			</div>
		</div>
	</div>
	<?php else: ?>
	<div class='row mt-3'>
		<div class='col-12'>
			<p class='lead text-center'>
				No registrations found for the selected year
			</p>
		</div>
	</div>
	<?php endif; ?>
	
	<div class='row mt-3'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?= site_url('fmis/set-year') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<?= $this->endSection() ?>