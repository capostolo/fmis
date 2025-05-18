<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.active_substance');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
	<div class='row'>
		<?php if(count($rows) > 0){?>
    <div class='col-9'>
    </div>
    <div class='col-3'>
      <a class='btn btn-custom-green form-control' href='<?= site_url('fmis/active-substance/new') ?>'><?= lang('Fmis.new_item');?></a>
    </div>
 </div>
	<div class='row mt-3'>
		<div class='col-12'>
			<table class='table table-hover table-striped dtable'>
				<thead>
					<tr>
            			<th><?= lang('Fmis.active_substance');?></th>
						<th><?= lang('Fmis.actions');?></th>
				</thead>
				<tbody>
					<?php foreach ($rows As $r) { ?>
						<tr>
							<td><a href="<?= site_url('fmis/active-substance/'.$r->id) ?>" > <?= $r->description ?> </a></td>
							<td>
								<a class="btn btn-default btn-sm delItem" data-controller="fertiliser" data-id="<?= $r->id ?>">
									<i class="bi bi-trash"></i>
								</a>
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
          <a class='btn btn-custom-green' href='<?= site_url('fmis/active-substance/new') ?>'><?= lang('Fmis.new_item');?></a>
        </p>
      </div>
			<?php } ?>
		</div>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>