<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
	<h2 class='text-center'><?= lang('Fmis.user_farmer_match') ?></h2>
	
	<?= $this->include('Fmis\Views\_message_block') ?>
	
	
	<!-- Matchable Farmers Section -->
	<?php if (count($matchableFarmers) > 0) : ?>
		<div class='card mb-4'>
			<div class='card-body'>
				<table class='table table-hover table-striped dtable'>
					<thead>
						<tr>
							<th><?= lang('Fmis.farmer_afm') ?></th>
							<th><?= lang('Fmis.farmer_firstname') ?></th>
							<th><?= lang('Fmis.farmer_lastname') ?></th>
							<th><?= lang('Fmis.user_firstname') ?></th>
							<th><?= lang('Fmis.user_lastname') ?></th>
							<th><?= lang('Fmis.user_afm') ?></th>
							<th>Ενέργειες</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($matchableFarmers as $m) { ?>
							<tr>
								<td><?= $m->farmer_afm ?></td>
								<td><?= $m->farmer_firstname ?></td>
								<td><?= $m->farmer_lastname ?></td>
								<td><?= $m->user_firstname ?? '-' ?></td>
								<td><?= $m->user_lastname ?? '-' ?></td>
								<td><?= $m->company_afm ?? '-' ?></td>
								<td>
									<a href="#" class="btn btn-sm btn-success link-user" 
										data-farmerid="<?= $m->farmer_id ?>" 
										data-userid="<?= $m->user_id ?>">
										<i class="bi bi-link"></i>
									</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	<?php else: ?>
		<div class="alert alert-info">
			Δεν υπάρχουν διαθέσιμοι παραγωγοί για σύνδεση με χρήστες.
		</div>
	<?php endif; ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
$(document).ready(function() {
	// Handle link user clicks
	$('.link-user').click(function(e) {
		e.preventDefault();
		
		var farmerId = $(this).data('farmerid');
		var userId = $(this).data('userid');
		
		if (confirm('Είστε σίγουροι ότι θέλετε να συνδέσετε αυτόν τον χρήστη με τον παραγωγό;')) {
			$.ajax({
				url: '<?= site_url('fmis/farmer-user/link') ?>',
				type: 'POST',
				data: {
					'farmer_id': farmerId,
					'user_id': userId,
				},
				dataType: 'json',
				success: function(response) {
					if (response.status === 'success') {
						alert(response.message);
						location.reload();
					} else {
						alert(response.message || 'Σφάλμα κατά τη σύνδεση.');
					}
				},
				error: function(response) {
					alert('Σφάλμα επικοινωνίας με τον διακομιστή.');
				}
			});
		}
	});
});
</script>
<?= $this->endSection() ?>