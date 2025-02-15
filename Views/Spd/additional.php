<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
	<div class="text-custom-anthrax text-center">
		<h2>Πρόσθετες πληροφορίες για τη δράση 31.6-Ζ </h2>
		<p class="lead"></p>
		<p class=""></p>
	</div>
	<form method="post" action="<?= site_url('fmis/spd') ?>">
	<div class='row'>
		  <input type="hidden" class="form-control" name="iacs_year" id="iacs_year" value="<?= $iacs_year ?>" >
		  <input type="hidden" class="form-control" name="advisor_id" id="advisor_id" value="<?= $advisor_id ?>" >
          <div class="form-group col-4">
            <label for="beck_type" class="control-label"><?= lang('Fmis.beck_type');?> </label>
            <input type="text" class="form-control" name="beck_type" id="beck_type" required>
          </div>
          <div class="form-group col-4">
            <label for="beck_num" class="control-label"><?= lang('Fmis.beck_num');?> </label>
            <input type="text" class="form-control" name="beck_num" id="beck_num" required>
          </div>
          <div class="form-group col-4">
            <label for="equip_year" class="control-label"><?= lang('Fmis.equip_year');?> </label>
            <input type="text" class="form-control" name="equip_year" id="equip_year" required>
          </div>
	</div>
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?= site_url('fmis/spd') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-custom-green form-control' name='save' id='save'><?= lang('Fmis.save');?></button>
		</div>
      </div>
    </div>
	</form>	
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
$('#equip_year').change(function(){
	var cur_year = new Date().getFullYear();
	if ($('#equip_year').val() < cur_year - 3){
		window.alert("Προσοχή, ο εξοπλισμός είναι παλαιότερος των 3 ετών!");
	}
});
</script>

<?= $this->endSection() ?>