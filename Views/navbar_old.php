<nav class="navbar fixed-top navbar-expand-lg bg-custom-anthrax">
  <a class="navbar-brand text-white" href="http://www.agrenaos.gr">Agrenaos</a>
  <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuCalendar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ημερολόγιο
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuCalendar">
          <a class="dropdown-item" href="<?= site_url('fmis/fertilisation') ?>"><?= lang('Fmis.fertilisation') ?></a><a class="dropdown-item" href="<?= site_url('fmis/fertilisation-parcel') ?>"><?= lang('Fmis.fertilisation_parcel') ?></a><a class="dropdown-item" href="<?= site_url('fmis/mass-trapping') ?>"><?= lang('Fmis.mass_trapping') ?></a><a class="dropdown-item" href="<?= site_url('fmis/mass-trapping-parcel') ?>"><?= lang('Fmis.mass_trapping_parcel') ?></a><a class="dropdown-item" href="<?= site_url('fmis/spray') ?>"><?= lang('Fmis.spray') ?></a><a class="dropdown-item" href="<?= site_url('fmis/spray-parcel') ?>"><?= lang('Fmis.spray_parcel') ?></a><a class="dropdown-item" href="<?= site_url('fmis/pruning') ?>"><?= lang('Fmis.pruning') ?></a><a class="dropdown-item" href="<?= site_url('fmis/pruning-parcel') ?>"><?= lang('Fmis.pruning_parcel') ?></a><a class="dropdown-item" href="<?= site_url('fmis/soil-management') ?>"><?= lang('Fmis.soil_management') ?></a><a class="dropdown-item" href="<?= site_url('fmis/soil-management-parcel') ?>"><?= lang('Fmis.soil_management_parcel') ?></a><a class="dropdown-item" href="<?= site_url('fmis/irrigation') ?>"><?= lang('Fmis.irrigation') ?></a><a class="dropdown-item" href="<?= site_url('fmis/irrigation-parcel') ?>"><?= lang('Fmis.irrigation_parcel') ?></a><a class="dropdown-item" href="<?= site_url('fmis/harvesting') ?>"><?= lang('Fmis.harvesting') ?></a><a class="dropdown-item" href="<?= site_url('fmis/harvest-parcel') ?>"><?= lang('Fmis.harvest_parcel') ?></a>
        </div>
      </div>
      <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuParams" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Παράμετροι
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuParams">
          <a class="dropdown-item" href="<?= site_url('fmis/fertiliser') ?>"><?= lang('Fmis.fertiliser') ?></a><a class="dropdown-item" href="<?= site_url('fmis/unit-measurement') ?>"><?= lang('Fmis.unit_measurement') ?></a><a class="dropdown-item" href="<?= site_url('fmis/fertiliser-application') ?>"><?= lang('Fmis.fertiliser_application') ?></a><a class="dropdown-item" href="<?= site_url('fmis/farming-stage') ?>"><?= lang('Fmis.farming_stage') ?></a><a class="dropdown-item" href="<?= site_url('fmis/fertilise-equipment') ?>"><?= lang('Fmis.fertilise_equipment') ?></a><a class="dropdown-item" href="<?= site_url('fmis/specialised-fertiliser') ?>"><?= lang('Fmis.specialised_fertiliser') ?></a><a class="dropdown-item" href="<?= site_url('fmis/trap') ?>"><?= lang('Fmis.trap') ?></a><a class="dropdown-item" href="<?= site_url('fmis/protective-product') ?>"><?= lang('Fmis.protective_product') ?></a><a class="dropdown-item" href="<?= site_url('fmis/spray-equipment') ?>"><?= lang('Fmis.spray_equipment') ?></a><a class="dropdown-item" href="<?= site_url('fmis/pruning-type') ?>"><?= lang('Fmis.pruning_type') ?></a><a class="dropdown-item" href="<?= site_url('fmis/pruning-equipment') ?>"><?= lang('Fmis.pruning_equipment') ?></a><a class="dropdown-item" href="<?= site_url('fmis/work-type') ?>"><?= lang('Fmis.work_type') ?></a><a class="dropdown-item" href="<?= site_url('fmis/plant-species-sow') ?>"><?= lang('Fmis.plant_species_sow') ?></a><a class="dropdown-item" href="<?= site_url('fmis/cover-crop-species') ?>"><?= lang('Fmis.cover_crop_species') ?></a><a class="dropdown-item" href="<?= site_url('fmis/plough-equipment') ?>"><?= lang('Fmis.plough_equipment') ?></a><a class="dropdown-item" href="<?= site_url('fmis/irrigation-equipment') ?>"><?= lang('Fmis.irrigation_equipment') ?></a><a class="dropdown-item" href="<?= site_url('fmis/harvest-equipment') ?>"><?= lang('Fmis.harvest_equipment') ?></a>
        </div>
      </div>
    </div>
    <div class="navbar-nav ml-auto navbar-right-top">
  </div>
</nav>