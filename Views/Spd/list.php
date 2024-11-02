<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
	<div class="text-custom-anthrax text-center">
		<h2><?= lang('Fmis.spd');?></h2>
		<p class="lead"></p>
		<p class=""></p>
	</div>
	<form method="post" action="<?= site_url('fmis/spd') ?>">
	<div class='row'>
		<div class='form-group col-6' > 
          <label class='control-label' for='iacs_year'><?= lang('Fmis.iacs_year') ?></label>
          <select class='form-control' name='iacs_year' id='iacs_year' required>
            <option value=''><?= lang('Fmis.iacs_year') ?></option>
            <?php foreach($rows As $r) { ?>
            <option value='<?= $r->iacs_year ?>' > <?= $r->iacs_year ?> </option>
            <?php } ?>
          </select>
        </div>
		<div class='form-group col-6' > 
          <label class='control-label' for='advisor_id'><?= lang('Fmis.advisor_id') ?></label>
          <select class='form-control' name='advisor_id' id='advisor_id' >
            <option value=''><?= lang('Fmis.advisor_id') ?></option>
            <?php foreach($advisors As $r) { ?>
            <option value='<?= $r->id ?>' > <?= $r->advisor_firstname.' '.$r->advisor_lastname ?> </option>
            <?php } ?>
          </select>
        </div>
	</div>
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?= site_url('fmis/farmer') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-custom-green form-control' name='save' id='save'><?= lang('Fmis.issue');?></button>
		</div>
      </div>
    </div>
	</form>	
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>