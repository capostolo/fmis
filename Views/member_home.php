<?= $this->extend('Fmis\Views\basehome_view') ?>
<?= $this->section('main') ?>
    <div class="main-wrapper container-fluid pt-5">
        <div class="outer-container row d-flex justify-content-center">
            <div class="outer-title col-xl-6 col-lg-8 col-12">
                <h1 class="mt-4 main-title text-center">Πλατφόρμα <span>Ηλεκτρονικών Καταγραφών Εργασιών</span> και
                    <span>Παρακολούθησης Περιβαλλοντικών Παραμέτρων</span>
                </h1>
            </div>

            <div class="outer-logo col-12 bg-white py-5 d-flex justify-content-center mt-5">
                <img src="assets/css/images/logo.png" class="img-fluid" alt="Schemis Logo">
            </div>
        </div>
    </div>
	<section id="Home">
    <div class="brochure-wrapper container-fluid pt-5 pb-5">
        <div class="main-container mt-5 mb-5 pb-5">
            <h1>Καλώς ήρθατε στο Schemis!</h1>
            <h4>Επιλέξτε έτος αναφοράς για να ξεκινήσετε.</h4>
            <?php
                $attributes = array('class' => 'form', 'id' => 'update-item');
	            echo form_open(site_url('fmis/set-year'), $attributes);
	        ?>
            <div class="row">
                <div class="form-group col">
                    <label class='control-label' for='iacs_year'><?= lang('Fmis.iacs_year') ?></label>
                    <select class='form-control' name='iacs_year' id='iacs_year' required>
                        <option value=''><?= lang('Fmis.iacs_year') ?></option>
                        <?php for ($i = 2024; $i <= date("Y"); $i++) { ?>
                        <option value='<?= $i ?>' > <?= $i ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class='row'>
                <div class='form-group col'>
                    <button class='btn btn-custom-green form-control' name='new' id='newfeedform'><?= lang('Fmis.save');?></button>
                </div>
            </div>
	        <?php echo form_close() ?>

        </div>
    </div>
    </section>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>