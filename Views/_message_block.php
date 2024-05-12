<?php if (session()->has('message')) : ?>
	<div class="alert alert-success">
		<?= session('message') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
	</div>
<?php 
  unset($_SESSION['message']);
  endif ?>

<?php if (session()->has('error')) : ?>
	<div class="alert alert-danger">
		<?= session('error') ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
	</div>
<?php 
  unset($_SESSION['error']);
  endif ?>

<?php if (session()->has('errors')) : ?>
	<ul class="alert alert-danger">
	<?php foreach (session('errors') as $error) : ?>
		<li><?= $error ?></li>
	<?php endforeach ?>
	</ul>
<?php 
  unset($_SESSION['errors']);
  endif ?>
