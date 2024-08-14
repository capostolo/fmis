<!DOCTYPE html>
<html lang="el">
  <head>
      <title>Agrenaos</title>
      <meta charset='utf-8' />
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
      <meta http-equiv="Pragma" content="no-cache" />
      <meta http-equiv="Expires" content="0" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
      <link rel="stylesheet" href="<?= base_url() ?>/assets/css/my_bootstrap4v2.css" />
      <link rel="stylesheet" href="<?= base_url() ?>/assets/css/jquery-ui.min.css" />
      <link rel="stylesheet" href="<?= base_url() ?>/assets/css/wizard.css" />
      <link rel="stylesheet" href="<?= base_url() ?>/assets/css/custom.css" />
      <link rel="stylesheet" href="<?= base_url() ?>/assets/css/agrenaos.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
      <link rel="stylesheet" href="<?= base_url() ?>/assets/css/sm_home.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v7.4.0/ol.css" type="text/css">

  </head>
  <body  class="pt-5">
    <?= view('Fmis\Views\navbar') ?>

    <main role="main" class="pt-4">
      <?= view('Fmis\Views\_message_block') ?>
      <?= view('Fmis\Views\_breadcrumbs') ?>
      <?= $this->renderSection('main') ?>
    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?= base_url() ?>/assets/js/jquery.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.ui.datepicker-el.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.validate.min.js"></script>
    <script charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/messages_el.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.steps.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/sorting/datetime-moment.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/custom_v4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/ol@v7.4.0/dist/ol.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/proj4@2.9.0/dist/proj4.min.js"></script>

    <?= $this->renderSection('pageScripts') ?>
  </body>
</html>

