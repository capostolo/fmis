<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.pruning_parcel');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
	<div class='row'>
		<?php if(count($rows) > 0){?>
    <div class='col-9'>
    </div>
    <div class='col-3'>
      <a class='btn btn-custom-green form-control' href='<?= site_url('fmis/pruning-parcel/new') ?>'><?= lang('Fmis.new_item');?></a>
    </div>
 </div>
	<div class='row mt-3'>
		<div class='col-12'>
			<table class='table table-hover table-striped'>
				<thead>
					<tr>
            <th>Εργασία</th>
            <th><?= lang('Fmis.dir_date');?></th>
            <th><?= lang('Fmis.application_date');?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($rows As $r) { ?>
						<tr>
							<td><a href="<?= site_url('fmis/pruning-parcel/'.$r->pruning_parcel_id) ?>" > <?= lang('Fmis.pparcel') ?> </a></td>
							<td><?= ($r->dir_date)? $r->dir_date->toLocalizedString('d/M/Y') : 'Χωρίς συμβουλή' ?></td>
							<td><?= ($r->dir_date && !$r->application_date)? 'Εκκρεμής' : $r->application_date->toLocalizedString('d/M/Y') ?> </a></td>
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
          <a class='btn btn-custom-green' href='<?= site_url('fmis/pruning-parcel/new') ?>'><?= lang('Fmis.new_item');?></a>
        </p>
      </div>
			<?php } ?>
		</div>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>