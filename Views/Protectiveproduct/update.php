<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
  <div class="text-custom-anthrax text-center">
    <h2><?= lang('Fmis.protective_product');?></h2>
    <p class="lead"></p>
    <p class=""></p>
  </div>
<?php
  $attributes = array('class' => 'form', 'id' => 'update-item');
	echo form_open(site_url('fmis/protective-product'), $attributes);
	?>
	<div class='row'>
		<div class='form-group col-12' > 
      <label class='control-label' for='protective_product_description'><?= lang('Fmis.protective_product_description') ?></label>
      <input type='text' class='form-control ' name='protective_product_description' id='protective_product_description' value='<?= set_value('protective_product_description', $row->protective_product_description) ?>' required />
    </div> 
  </div>
  <div class='row mt-3'>
    <div class='col-9'>
      <h4 class='text-center'><?= lang('Fmis.active_substance');?></h4>
    </div>
    <div class='col-3'>
      <a class='btn btn-primary form-control' href="<?= site_url('fmis/product-active/new') ?>"><?= lang('Fmis.new_item') ?></a>
    </div>
  </div>
  <div class='row mt-3'>
    <div class='col-12' > 
      <table class='table table-hover table-striped'>
        <thead>
          <th><?= lang('Fmis.active_substance_id') ?></th>
          <th><?= lang('Fmis.concentration') ?></th>
          <th></th>
        </thead>
        <tbody>
          <?php foreach ($activesubstance as $r) { ?>
          <tr>
            <td><a href="<?= site_url('fmis/product-active/'.$r->id) ?>" ><?= $r->description ?></a></td>
            <td><?= $r->concentration ?></td>
            <td><a class='del-item' href='#' data-target='<?= $r->id ?>' data-title='<?= $r->description ?>'><i class='bi bi-trash'></i></a></td>
          </tr>  
          <?php } ?>
        </tbody>
      </table>
    </div> 
	</div>
  
	<div class='row'>
		<div class='form-group col'>
			<a class='btn btn-default form-control' href="<?= site_url('fmis/protective-product') ?>"><?= lang('Fmis.go_back');?></a>
		</div>
		<div class='form-group col'>
			<button class='btn btn-primary form-control' name='new' id='newfeedform'><?= lang('Fmis.save');?></button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
  $(".del-item").click(function(){
    var thetitle = this.dataset.title;
    var theid = this.dataset.target;
    var theurl = "<?= site_url('fmis/protective-product/delete-active') ?>";
    var theconfirm = "Θέλετε να διαγράψετε τη δραστική ουσία " + thetitle + ";";
    if(confirm(theconfirm)){
      $.ajax({
        url: theurl,
        type: 'post',
        data: {id: theid},
        success: function(response){
        if(response == 1){
          location.reload();
        }
       }
      });
    }
  });
</script>

<?= $this->endSection() ?>