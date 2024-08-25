<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
  <div class="text-custom-anthrax text-center">
    <h1 class="">Στοιχεία αγροτεμαχίου</h1>
    <p class="lead"></p>
    <p class=""></p>
  </div>
  <div class="container text-custom-anthrax">
  <form method="post" id="fytaForm" name="fytaForm" class="" action="<?= route_to('bio/new-crop') ?>">
    <div class="row">
      <div class="col-sm-7">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label class="label" for="code">Κωδικός αγροτεμαχίου</label>
              <input type="text" class="form-control" name="code" id="code" placeholder="Κωδικός αγροτεμαχίου" value="<?= set_value('code', $row->code) ?>" readonly >
            </div>
          </div>
          <div class="col-12">
            <div class="form-group ">
              <input type="hidden" class="form-control" name="cultivation_code" id="cultivation_code" value="<?= set_value('cultivation_code', $row->cultivation_code) ?>">
              <label class="label" for="poiCategoryName">Κατηγορία καλλιέργειας</label>
              <input type="text" class="form-control" name="poiCategoryName" id="poiCategoryName" placeholder="Κατηγορία Καλλιέργειας" value="<?= set_value('poiCategoryName', $row->poiCategoryName) ?>" readonly>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group ">
              <input type="hidden" class="form-control" name="cultivar_code" id="cultivar_code" value="<?= set_value('cultivar_code', $row->cultivar_code) ?>">
              <label class="label" for="app_fi_poiDescription">Καλλιέργεια</label>
              <input type="text" class="form-control" name="poiDescription" id="poiDescription" placeholder="Καλλιέργεια" value="<?= set_value('poiDescription', $row->poiDescription) ?>" autocomplete="off" readonly >
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label class="label" for="total_area">Επιλέξιμη έκταση (ha)</label>
              <input type="text" class="form-control decimalnumber" name="total_area" id="total_area" placeholder="Επιλέξιμη έκταση (ha)" value="<?= set_value('total_area', number_format($row->total_area, 2, ',', '.')) ?>" readonly >
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label class="label" for="co_ownership_percent">% Συνιδιοκτησίας</label>
              <input type="text" class="form-control" name="co_ownership_percent" id="co_ownership_percent" placeholder="% Συνιδιοκτησίας" value="<?= set_value('co_ownership_percent', number_format($row->co_ownership_percent, 2, ',', '.')) ?>" readonly >
            </div>
          </div>
        </div>
		<?php if ($row->cultivation_code == '15' ||
				  $row->cultivation_code == '19' ||
				  $row->cultivation_code == '21' ||
				  $row->cultivation_code == '37' ||
				  $row->cultivation_code == '45.2' ||
				  $row->cultivation_code == '49' ||
				  $row->cultivation_code == '66' ||
				  $row->cultivation_code == '67') { ?>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label class="label" for="trees_number_ge4_years">Αρ. δένδρων ≥ 4 ετων </label>
              <input type="text" class="form-control" name="trees_number_ge4_years" id="trees_number_ge4_years" placeholder="Αρ. δένδρων ≥ 4 ετών" value="<?= set_value('trees_number_ge4_years', $row->trees_number_ge4_years) ?>" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label class="label" for="trees_number_l4_years">Αρ. δένδρων < 4 ετων </label>
              <input type="text" class="form-control" name="trees_number_l4_years" id="trees_number_l4_years" placeholder="Αρ. δένδρων < 4 ετών" value="<?= set_value('trees_number_l4_years', $row->trees_number_l4_years) ?>" readonly>
            </div>
          </div>
        </div>
		<?php } 
		 if ($row->cultivation_code == '28.1' ||
			$row->cultivation_code == '36.2' ||
			$row->cultivation_code == '36.3' ) { ?>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label class="label" for="vineyards_l4_years">Αμπελώνας ≥ 3 ετών </label>
              <input type="text" class="form-control" name="vineyards_ge3_years" id="vineyards_ge3_years" placeholder="Αμπελώνας ≥ 3 ετών" value="<?= set_value('vineyards_ge3_years', ($row->vineyards_ge3_years == 1)? 'Ναι': 'Όχι') ?>" readonly>
            </div>
          </div>
        </div>
		<?php } ?>
        <div class="row">
          <div class="col-4">
            <div class="form-group">
              <label class="label" for="is_irrigated">Αρδευόμενο</label>
              <input type="text" class="form-control" name="is_irrigated" id="is_irrigated" placeholder="Αρδευόμενο" value="<?= set_value('is_irrigated', ($row->is_irrigated == 1)? 'Ναι': 'Όχι') ?>" readonly >
            </div>
          </div>
          <div class="col-8">
            <div class="form-group">
              <label class="label" for="irrigation_method_code">Μέθοδος άρδευσης</label>
              <input type="text" class="form-control" name="irrigation_method_code" id="irrigation_method_code" placeholder="Μέθοδος άρδευσης" value="<?= set_value('irrigation_method_code', $row->irrigation_method_code) ?>" readonly >
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
          <h5>Ισοζύγιο θρεπτικών</h5>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label class="label" for="balance_n">Αζωτο (N, kg)</label>
              <input type="text" class="form-control" name="balance_n" id="balance_n" placeholder="Άζωτο (N)" value="<?= set_value('balance_n', number_format($nutrients['nitrogen'] * $row->total_area, 2, ',', '.') ) ?>" readonly>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label class="label" for="balance_p">Φωσφορος (P, kg)</label>
              <input type="text" class="form-control" name="balance_p" id="balance_p" placeholder="Φώσφορος (P)" value="<?= set_value('balance_p', number_format($nutrients['phosphorus'] * $row->total_area, 2, ',', '.')) ?>" readonly>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label class="label" for="balance_k">Καλιο (K, kg)</label>
              <input type="text" class="form-control" name="balance_k" id="balance_k" placeholder="Κάλιο (K)" value="<?= set_value('balance_k', number_format($nutrients['potassium'] * $row->total_area, 2, ',', '.')) ?>" readonly>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-5">
        <div id="map" style="height: 100%; width: 100%;"></div>
      </div>
    </div>
    <div class="text-custom-anthrax mt-3 bg-light">
      <ul class="nav nav-pills justify-content-start" id="nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link text-center mx-auto d-flex align-items-center active" id="work-tab" data-toggle="tab" href="#work" role="tab" aria-controls="work" aria-selected="true">Ημερολόγιο εργασιών</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-center mx-auto d-flex align-items-center" id="analysis-tab" data-toggle="tab" href="#analysis" role="tab" aria-controls="analysis" aria-selected="true">Ημερολόγιο αναλύσεων</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-center mx-auto d-flex align-items-center" id="actives-tab" data-toggle="tab" href="#actives" role="tab" aria-controls="actives" aria-selected="true">Ποσότητες δραστικών ουσιών</a>
        </li>
      </ul>
    </div>
    <div class="tab-content">
      <div class="tab-pane active" id="work" role="tabpanel" aria-labelledby="work-tab">
        <div class="row mt-4">
          <?php if(count($calendar) > 0){?>
          <div class='col-9'>
          </div>
          <div class='col-3 mb-3'>
            <div class="dropdown text-right">
              <button class="btn btn-custom-green dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= lang('Fmis.new_item');?>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?= site_url('fmis/fertilisation-parcel/new') ?>"><?= lang('Fmis.fparcel');?></a>
                <a class="dropdown-item" href="<?= site_url('fmis/pruning-parcel/new') ?>"><?= lang('Fmis.pparcel');?></a>
                <a class="dropdown-item" href="<?= site_url('fmis/soil-management-parcel/new') ?>"><?= lang('Fmis.smparcel');?></a>
                <a class="dropdown-item" href="<?= site_url('fmis/mass-trapping-parcel/new') ?>"><?= lang('Fmis.mparcel');?></a>
                <a class="dropdown-item" href="<?= site_url('fmis/irrigation-parcel/new') ?>"><?= lang('Fmis.iparcel');?></a>
                <a class="dropdown-item" href="<?= site_url('fmis/spray-parcel/new') ?>"><?= lang('Fmis.sparcel');?></a>
                <a class="dropdown-item" href="<?= site_url('fmis/harvest-parcel/new') ?>"><?= lang('Fmis.hparcel');?></a>
              </div>
            </div>        
          </div>
          <div class="col-sm-12">
            <table class='table table-hover table-striped dtable'>
              <thead>
                <tr>
                  <th>Εργασία</th>
                  <th><?= lang('Fmis.dir_date');?></th>
                  <th><?= lang('Fmis.application_date');?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($calendar As $r) { 
                  switch ($r->farm_practice) {
                      case 'Λίπανση': 
                        $practice = 'fertilisation';
                        break;
                      case 'Κλάδεμα': 
                        $practice = 'pruning';
                        break;
                      case 'Άρδευση': 
                        $practice = 'irrigation';
                        break;
                      case 'Μαζική παγίδευση': 
                        $practice = 'mass-trapping';
                        break;
                      case 'Διαχείριση εδάφους': 
                        $practice = 'soil-management';
                        break;
                      case 'Φυτοπροστασία': 
                        $practice = 'spray';
                        break;
                      case 'Συγκομιδή': 
                        $practice = 'harvest';
                        break;
                  }
                ?>
                  <tr class="<?= ($r->dir_date && !$r->application_date)? 'text-danger' : '' ?>">
                    <td><a href="<?= site_url('fmis/'.$practice.'-parcel/'.$r->practice_parcel_id) ?>" > <?= $r->farm_practice ?> </a> <a href='<?= site_url('fmis/'.$practice.'-parcel') ?>'><i class="bi bi-search"></i></a></td>
                    <td data-sort="'<?= $r->dir_date?>'"><?= ($r->dir_date)? $r->dir_date->toLocalizedString('d/M/Y') : 'Χωρίς συμβουλή' ?></td>
                    <td data-sort="'<?= $r->application_date?>'">
                      <?= ($r->dir_date && !$r->application_date)? 'Εκκρεμής' : $r->application_date->toLocalizedString('d/M/Y') ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <?php }
          else {?>
          <div class='col-12'>
            <p class='lead text-center'>
              <?= lang('Fmis.no_data');?>
            </p>
          </div>
          <div class='col-12 text-center'>
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?= lang('Fmis.new_item');?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="<?= site_url('fmis/fertilisation-parcel/new') ?>"><?= lang('Fmis.fparcel');?></a>
              <a class="dropdown-item" href="<?= site_url('fmis/pruning-parcel/new') ?>"><?= lang('Fmis.pparcel');?></a>
              <a class="dropdown-item" href="<?= site_url('fmis/soil-management-parcel/new') ?>"><?= lang('Fmis.smparcel');?></a>
              <a class="dropdown-item" href="<?= site_url('fmis/mass-trapping-parcel/new') ?>"><?= lang('Fmis.mparcel');?></a>
              <a class="dropdown-item" href="<?= site_url('fmis/irrigation-parcel/new') ?>"><?= lang('Fmis.iparcel');?></a>
              <a class="dropdown-item" href="<?= site_url('fmis/spray-parcel/new') ?>"><?= lang('Fmis.sparcel');?></a>
            </div>
          </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="tab-pane" id="analysis" role="tabpanel" aria-labelledby="analysis-tab">
        <div class="row mt-4">
          <?php if(count($calendaranalysis) > 0){?>
          <div class='col-9'>
          </div>
          <div class='col-3 mb-3'>
            <div class="dropdown text-right">
              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= lang('Fmis.new_item');?>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?= site_url('fmis/parcel-soil/new') ?>"><?= lang('Fmis.parcel_soil');?></a>
                <a class="dropdown-item" href="<?= site_url('fmis/parcel-leaf/new') ?>"><?= lang('Fmis.parcel_leaf');?></a>
              </div>
            </div>        
          </div>
          <div class="col-sm-12">
            <table class='table table-hover table-striped dtable'>
              <thead>
                <tr>
                  <th><?= lang('Fmis.date_analysis');?></th>
                  <th>Ανάλυση</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($calendaranalysis As $r) {?>
                  <tr>
                    <td data-sort="'<?= $r->date_analysis?>'">
                      <a href="<?= site_url('fmis/parcel-'.$r->type.'/'.$r->analysis_id) ?>" > <?= $r->date_analysis->toLocalizedString('d/M/Y') ?> </a> 
                    </td>
                    <td><?= $r->analysis_type ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <?php }
          else {?>
          <div class='col-12'>
            <p class='lead text-center'>
              <?= lang('Fmis.no_data');?>
            </p>
          </div>
          <div class='col-12 text-center'>
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?= lang('Fmis.new_item');?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?= site_url('fmis/parcel-soil/new') ?>"><?= lang('Fmis.parcel_soil');?></a>
                <a class="dropdown-item" href="<?= site_url('fmis/parcel-leaf/new') ?>"><?= lang('Fmis.parcel_leaf');?></a>
            </div>
          </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="tab-pane" id="actives" role="tabpanel" aria-labelledby="actives-tab">
        <div class="row mt-4">
          <?php if(count($actives) > 0){?>
          <div class='col-9'>
          </div>
          <div class='col-3 mb-3'>
          </div>
          <div class="col-sm-12">
            <table class='table table-hover table-striped dtable'>
              <thead>
                <tr>
                  <th><?= lang('Fmis.active_substance_description');?></th>
                  <th class = "text-right">Ποσότητα (γραμμάρια, g)</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($actives As $r) {?>
                  <tr>
                    <td><?= $r->description ?> </a> 
                    </td>
                    <td class = "text-right"><?= number_format($r->active_quantity, 2, ',', '.') ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <?php }
          else {?>
          <div class='col-12'>
            <p class='lead text-center'>
              <?= lang('Fmis.no_data');?>
            </p>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>      
    <div class="row mt-4">
      <div class="col-md-12 d-flex justify-content-end">
        <div class="form-group mr-2">
          <a class="btn btn-default" href="<?= site_url('fmis/farmer/'.session()->get('farmer_id')) ?>">Επιστροφή</a>
        </div>
      </div>
    </div>
  </form>
  </div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
    
  <script>
  const wkt ='<?= $row->geom ?>';
  proj4.defs("EPSG:2100","+proj=tmerc +lat_0=0 +lon_0=24 +k=0.9996 +x_0=500000 +y_0=0 +ellps=GRS80 +towgs84=-199.87,74.79,246.62,0,0,0,0 +units=m +no_defs");
  ol.proj.proj4.register(proj4);
  const greekProjection = ol.proj.get('EPSG:2100');  
  var format = new ol.format.WKT();
  var feature = format.readFeature(wkt, {
    dataProjection: 'EPSG:2100',
    featureProjection: 'EPSG:2100',
  });
  var base = new ol.layer.Tile({
    source: new ol.source.OSM()
  });
  var vector = new ol.layer.Vector({
    source: new ol.source.Vector({
      features: [feature],
    }),
  });
  
  var map = new ol.Map({
    target: 'map',
    layers: [
      base,
      vector,
    ],
    view: new ol.View({
      projection: greekProjection,
      center: [0, 0],
		  zoom: 7.1
    })
  });
  var viewextent = base.getSource().getProjection();
  var extent = vector.getSource().getExtent();
  map.getView().fit(extent,  {size: map.getSize(), padding: [200, 100, 200, 100]});  

  </script>
<?= $this->endSection() ?>