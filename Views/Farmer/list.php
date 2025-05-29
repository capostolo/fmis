<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
	<h2 class='text-center'><?= lang('Fmis.farmer');?></h2>
	<div class='row'>
		<?php if(count($rows) > 0){?>
    <div class='col-3'>
		<div class="dropdown text-right">
			<button class="btn btn-custom-green dropdown-toggle form-control" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="bi bi-list-check"></i> Μαζική καταγραφή
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="<?= site_url('fmis/fertilisation-global-new') ?>"><?= lang('Fmis.fparcel');?></a>
				<a class="dropdown-item" href="<?= site_url('fmis/pruning-global-new') ?>"><?= lang('Fmis.pparcel');?></a>
				<a class="dropdown-item" href="<?= site_url('fmis/soil-management-global-new') ?>"><?= lang('Fmis.smparcel');?></a>
				<a class="dropdown-item" href="<?= site_url('fmis/mass-trapping-global-new') ?>"><?= lang('Fmis.mparcel');?></a>
				<a class="dropdown-item" href="<?= site_url('fmis/irrigation-global-new') ?>"><?= lang('Fmis.iparcel');?></a>
				<a class="dropdown-item" href="<?= site_url('fmis/spray-global-new') ?>"><?= lang('Fmis.sparcel');?></a>
			</div>
		</div>        
    </div>
    <div class='col-3'>
    </div>
    <div class='col-3'>
	<?php if ($admin || in_groups(['advisor'])): ?>
      <a class='btn btn-custom-green form-control' href='<?= site_url('fmis/farmer/add-from-json') ?>'><?= lang('Fmis.new_json_item');?></a>
	  <?php endif; ?>
	</div>
    <div class='col-3'>
      <a class='btn btn-custom-green form-control' href='<?= site_url('fmis/openid-connect') ?>'><?= lang('Fmis.new_item');?></a>
    </div>
	</div>
	<hr>
	<div class='row mt-3'>
		<h4 class="mx-auto">
			Κατάλογος παραγωγών
		</h4>
		<div class='col-12'>
			<table class='table table-hover table-striped dtable'>
				<thead>
					<tr>
						<?php if ($admin){?><th>Σύμβουλος</th><?php }?>
						<th>ΑΦΜ</th>
						<th>Ονοματεπώνυμο</th>
						<th>Έδρα</th>
						<th>Τηλέφωνο</th>
						<th>email</th>
						<th>ΟΠ</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($rows As $r) { ?>
						<tr>
							<?php if ($admin){?><td><?= $r->company_name?></td><?php }?>
							<td><a href="<?= site_url('fmis/farmer/'.$r->id) ?>" > <?= $r->farmer_afm ?> </a></td>
							<td><?= $r->farmer_firstname.' '.$r->farmer_lastname?></td>
							<td><?= $r->farmer_location?></td>
							<td><?= $r->farmer_mobile?></td>
							<td><?= $r->farmer_email?></td>
							<td><?= $r->po_name ?></td>
							<td><?php if ($admin) { ?><a role="button" href="#" class="delete-item text-danger" data-name="<?= $r->farmer_firstname.' '.$r->farmer_lastname ?>" data-id="<?= $r->id ?>"><i class="bi bi-trash"></i></a><?php } ?></td>
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
          <a class='btn btn-custom-green' href='<?= site_url('fmis/openid-connect') ?>'><?= lang('Fmis.new_item');?></a>
        </p>
      </div>
			<?php } ?>
		</div>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<?php if($admin){ ?>
<script>
  $('.delete-item').click(function(e){
    e.preventDefault();
	var thename = $(this).data('name');
	var theid = $(this).data('id');
    if(confirm('Είστε σίγουροι ότι θέλετε να διαγράψετε τα δεδομένα για τον παραγωγό ' + thename + '; Δεν θα έχετε τη δυνατότητα αναίρεσης.')){
      var theurl = "<?= site_url('fmis/farmer/delete') ?>";
      $.ajax({
        url: theurl,
        type: 'POST',
        data: {item_id: theid},
        success: function(response){
          location.reload();
          alert(response.message);
        }
      });
    }
  });
</script>
<?php } ?>
<?= $this->endSection() ?>