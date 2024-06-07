<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
  <header class="masthead home">
      <div class="container h-100">
          <div class="row align-items-center justify-content-center text-center">
              <div class="col-lg-10 mt-5">
                  <img class="img-fluid" src="<?= base_url() ?>/assets/images/schemis.jpg" />
              </div>
              <div class="col-lg-10 align-self-end">
                  <h3 class="text-custom-anthrax home-main-title mt-3 mb-3"><small>Διαχείριση γεωργικών εκμεταλλεύσεων</small></h3>
                  <hr class="divider my-4" />
                  <div class="text-center">
                    <a class="btn btn-custom-green" href="<?= site_url('login') ?>">Συνδεθείτε</a> 
                  </div>
              </div>
          </div>
      </div>
  </header>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>