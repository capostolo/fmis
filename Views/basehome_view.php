<!DOCTYPE html>
<html lang="el">
  <head>
      <title>Schemis by Agrenaos</title>
      <meta charset='utf-8' />
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
      <meta http-equiv="Pragma" content="no-cache" />
      <meta http-equiv="Expires" content="0" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
      <link rel="stylesheet" href="<?= base_url() ?>/assets/css/my_bootstrap4v2.css" />
      <link rel="stylesheet" href="<?= base_url() ?>/assets/css/home.css" />

  </head>
  <body  class="">
    <?= view('Fmis\Views\navbar') ?>

    <main role="main">
      <?= $this->renderSection('main') ?>
    </main><!-- /.container -->


    <?= $this->renderSection('pageScripts') ?>
  </body>
</html>

