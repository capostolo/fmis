<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= $caption;?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
	<div class='row'>
		<?php if(count($rows) > 0){?>
    <div class='col-9'>
    </div>
    <div class='col-3'>
      <a class='btn btn-primary form-control' href='<?= site_url('fmis/farm-inputs/new') ?>'><?= lang('Fmis.new_item');?></a>
    </div>
 </div>
	<div class='row mt-3'>
		<div class='col-12'>
			<table class='table table-hover table-striped dmtable'>
				<thead>
					<tr>
						<th><?= lang('Fmis.input_id');?></th>
						<th><?= lang('Fmis.invoice_date');?></th>
						<th><?= lang('Fmis.farm_inputs_quantity');?></th>
						<th><?= lang('Fmis.farm_inputs_remaining');?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($rows As $r) { ?>
						<tr>
							<td><a href="<?= site_url('fmis/farm-inputs/'.$r->id) ?>" > <?= $r->description ?> </a></td>
							<td><?= $r->invoice_date->toLocalizedString('d/M/Y') ?></td>
							<td><?= $r->quantity.' '.$r->unit ?></td>
							<td><?= $r->remaining_quantity.' '.$r->unit ?></td>
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
          <a class='btn btn-primary' href='<?= site_url('fmis/farm-inputs/new') ?>'><?= lang('Fmis.new_item');?></a>
        </p>
      </div>
			<?php } ?>
		</div>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>