<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.buyer');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
	<div class='row'>
		<?php if(count($rows) > 0){?>
    <div class='col-9'>
    </div>
    <div class='col-3'>
      <a class='btn btn-primary form-control' href='<?= site_url('fmis/buyer/new') ?>'><?= lang('Fmis.new_item');?></a>
    </div>
 </div>
	<div class='row mt-3'>
		<div class='col-12'>
			<table class='table table-hover table-striped dtable'>
				<thead>
					<tr>
						<th><?= lang('Fmis.buyer_name');?></th>
						<th><?= lang('Fmis.buyer_afm');?></th>
						<th><?= lang('Fmis.buyer_address');?></th>
						<th class="text-right"><?= lang('Fmis.actions');?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($rows As $r) { ?>
						<tr>
							<td><a href="<?= site_url('fmis/buyer/'.$r->id) ?>" > <?= $r->buyer_name ?> </a></td>
							<td><?= $r->buyer_afm ?></td>
							<td><?= $r->buyer_address ?></td>
							<td class="text-right">
								<button class="btn btn-default btn-sm delItem" data-controller="buyer" data-item-id="<?= $r->id ?>">
									<i class="bi bi-trash"></i>
								</button>
							</td>
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
          <a class='btn btn-primary' href='<?= site_url('fmis/buyer/new') ?>'><?= lang('Fmis.new_item');?></a>
        </p>
      </div>
			<?php } ?>
		</div>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('js/delete.js') ?>"></script>
<?= $this->endSection() ?>