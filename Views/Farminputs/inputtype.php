<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.farm_inputs');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
	<div class='row mt-3 align-items-center justify-content-center pb-0' id='practices'>
		<div class="col-lg-3 col-md-4 col-sm-12 route-card">
		  <div class="route-card-container px-4 pt-4 pb-4 my-2">
			<div class="route-card-front">
			  <img src="<?= base_url() ?>assets/css/images/Path 27.png">
			  <div class="mt-md-0 mt-4">
				<h2>Θρεπτικά</h2>
				<h3>Εισροές θρέψης</h3>
				<p>Διαχειριστείτε εισροές θρεπτικών</p>
			  </div>
			</div>
			<div class="route-card-back">
			  <div class="d-flex flex-column align-items-start">
				<h3 class="mt-2 mb-2">Εισροές θρεπτικών</h3>
				<p>Καταχωρήστε και διαχειριστείτε ποσότητες λιπασμάτων που αποκτήσατε</p>
			  </div>
			</div>
			<a class="overlay-link" href="<?= site_url('fmis/farm-inputs/fertilisers')?>"></a>
		  </div>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-12 route-card">
		  <div class="route-card-container px-4 pt-4 pb-4 my-2">
			<div class="route-card-front">
			  <img src="<?= base_url() ?>assets/css/images/Group 7.png">
			  <div class="mt-md-0 mt-4">
				<h2>Φυτοπροστατευτικά</h2>
				<h3>Εισροές φυτοπροστασίας</h3>
				<p>Διαχειριστείτε εισροές φυτοπροστατευτικών προϊόντων</p>
			  </div>
			</div>
			<div class="route-card-back">
			  <div class="d-flex flex-column align-items-start">
				<h3 class="mt-2 mb-2">Εισροές φυτοπροστασίας</h3>
				<p>Καταχωρήστε και διαχειριστείτε ποσότητες φυτοπροστατευτικών προϊόντων που αποκτήσατε</p>
			  </div>
			</div>
			<a class="overlay-link" href="<?= site_url('fmis/farm-inputs/ppp')?>"></a>
		  </div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>