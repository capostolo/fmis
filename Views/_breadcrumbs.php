<?php if (session()->has('farmer_id')) : ?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url('fmis/farmer/') ?>"> Αρχική </a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('fmis/farmer/'.session()->get('farmer_id')) ?>"> <?= session()->get('farmer_name') ?></a></li>
  </ol>
</nav>
<?php endif ?>
