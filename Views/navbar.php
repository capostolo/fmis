<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-custom-anthrax">
  <a class="navbar-brand text-white" style="padding-top: 0px; !important" href="http://www.agrenaos.gr">Agrenaos</a>
  <div class="navbar-brand" style="padding-top: 0px; !important">
    <img src="<?= site_url('assets/css/images/logo_sm.png') ?>" alt="">
  </div>
  <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <?php if(auth()->loggedIn()){
        if (auth()->user()->inGroup('admin')) { ?>
      <div class="nav-item ">
        <a class="nav-link text-white" href="<?= site_url('fmis/farmer')  ?>" id="navbarHome">
        <i class="bi bi-house-door-fill"></i>
        </a>
      </div>
      <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuParams" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Παράμετροι
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuParams">
          <a class="dropdown-item" href="<?= site_url('fmis/fertiliser') ?>"><?= lang('Fmis.fertiliser') ?></a><a class="dropdown-item" href="<?= site_url('fmis/unit-measurement') ?>"><?= lang('Fmis.unit_measurement') ?></a><a class="dropdown-item" href="<?= site_url('fmis/fertiliser-application') ?>"><?= lang('Fmis.fertiliser_application') ?></a><a class="dropdown-item" href="<?= site_url('fmis/farming-stage') ?>"><?= lang('Fmis.farming_stage') ?></a><a class="dropdown-item" href="<?= site_url('fmis/fertilise-equipment') ?>"><?= lang('Fmis.fertilise_equipment') ?></a><a class="dropdown-item" href="<?= site_url('fmis/specialised-fertiliser') ?>"><?= lang('Fmis.specialised_fertiliser') ?></a><a class="dropdown-item" href="<?= site_url('fmis/trap') ?>"><?= lang('Fmis.trap') ?></a><a class="dropdown-item" href="<?= site_url('fmis/protective-product') ?>"><?= lang('Fmis.protective_product') ?></a><a class="dropdown-item" href="<?= site_url('fmis/spray-equipment') ?>"><?= lang('Fmis.spray_equipment') ?></a><a class="dropdown-item" href="<?= site_url('fmis/pruning-type') ?>"><?= lang('Fmis.pruning_type') ?></a><a class="dropdown-item" href="<?= site_url('fmis/pruning-equipment') ?>"><?= lang('Fmis.pruning_equipment') ?></a><a class="dropdown-item" href="<?= site_url('fmis/work-type') ?>"><?= lang('Fmis.work_type') ?></a><a class="dropdown-item" href="<?= site_url('fmis/plant-species-sow') ?>"><?= lang('Fmis.plant_species_sow') ?></a><a class="dropdown-item" href="<?= site_url('fmis/cover-crop-species') ?>"><?= lang('Fmis.cover_crop_species') ?></a><a class="dropdown-item" href="<?= site_url('fmis/plough-equipment') ?>"><?= lang('Fmis.plough_equipment') ?></a><a class="dropdown-item" href="<?= site_url('fmis/irrigation-equipment') ?>"><?= lang('Fmis.irrigation_equipment') ?></a><a class="dropdown-item" href="<?= site_url('fmis/harvest-equipment') ?>"><?= lang('Fmis.harvest_equipment') ?></a>
        </div>
      </div>
      <?php } 
      if (!auth()->user()->inGroup('nogroup')) { ?>
      <div class="nav-item ">
        <a class="nav-link text-white" href="<?= site_url('helpdesk/ticket-list')  ?>" id="navbarHelpdesk">
          Επικοινωνία
        </a>
      </div>
      <?php } }
	  else { ?>
      <div class="nav-item ">
        <a class="nav-link text-white" href="<?= site_url()  ?>" id="navbarHome">
        <i class="bi bi-house-door-fill"></i>
        </a>
      </div>
      <div class="nav-item ">
        <a class="nav-link text-white" href="#manual" id="navbarManual">
          Εγχειρίδιο χρήσης
        </a>
      </div>
      <div class="nav-item ">
        <a class="nav-link text-white" href="#contact" id="navbarContact">
          Επικοινωνία
        </a>
      </div>
	  
	  <?php } ?>
    </div>
    <div class="navbar-nav ml-auto navbar-right-top">
      <?php if(auth()->loggedIn()){ 
        $user = auth()->user();
      ?>
      <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="bi bi-person"></i>  <?= $user->firstname.' '.$user->lastname ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?= site_url('logout') ?>">Αποσύνδεση</a>
          <a class="dropdown-item" href="<?= site_url('add-logo') ?>">Το logo σας</a>
        </div>
      </div>
      <?php } 
      else { ?>
      <a class="nav-item nav-link text-white" href="<?= site_url('register') ?>">Εγγραφή <span class="sr-only">(register)</span></a>
      <a class="nav-item nav-link border text-white" href="<?= site_url('fmis/farmer') ?>">Σύνδεση <span class="sr-only">(login)</span></a>
      <?php } ?>
    </div>
  </div>
</nav>