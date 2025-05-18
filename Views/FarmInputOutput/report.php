<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container'>
    <div class="text-custom-anthrax text-center">
        <h2><?= lang('Fmis.farm_input_output');?></h2>
    </div>

    <div class="row mt-4">
        <div class="col-12 text-right mb-3">
            <a href="<?= site_url('fmis/farm-input-output/download') ?>" class="btn btn-custom-green">
                <i class="fas fa-download"></i> <?= lang('Fmis.download_pdf');?>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h4><?= lang('Fmis.farm_inputs');?></h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><?= lang('Fmis.list_number');?></th>
                        <th><?= lang('Fmis.invoice_num');?></th>
                        <th><?= lang('Fmis.invoice_date');?></th>
                        <th><?= lang('Fmis.supplier_name');?></th>
                        <th><?= lang('Fmis.supplier_address');?></th>
                        <th><?= lang('Fmis.input_type');?></th>
                        <th><?= lang('Fmis.input_name');?></th>
                        <th><?= lang('Fmis.npk_content');?></th>
                        <th><?= lang('Fmis.package_count');?></th>
                        <th><?= lang('Fmis.total_quantity');?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($inputs as $index => $input): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $input->invoice_num ?></td>
                        <td><?= $input->invoice_date->toLocalizedString('d/M/Y') ?></td>
                        <td><?= $input->supplier_name ?></td>
                        <td><?= $input->supplier_address ?></td>
                        <td><?= $input->input_type ?></td>
                        <td><?= $input->input_name ?></td>
                        <td><?= $input->npk_content ?></td>
                        <td><?= $input->package_count ?></td>
                        <td><?= $input->total_quantity.' '.$input->unit  ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h4><?= lang('Fmis.farm_outputs');?></h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><?= lang('Fmis.list_number');?></th>
                        <th><?= lang('Fmis.invoice_num');?></th>
                        <th><?= lang('Fmis.invoice_date');?></th>
                        <th><?= lang('Fmis.buyer_name');?></th>
                        <th><?= lang('Fmis.buyer_address');?></th>
                        <th><?= lang('Fmis.output_type');?></th>
                        <th><?= lang('Fmis.output_name');?></th>
                        <th><?= lang('Fmis.total_quantity');?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($outputs as $index => $output): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $output->invoice_num ?></td>
                        <td><?= $output->invoice_date->toLocalizedString('d/M/Y') ?></td>
                        <td><?= $output->buyer_name ?></td>
                        <td><?= $output->buyer_address ?></td>
                        <td><?= $output->output_type ?></td>
                        <td><?= $output->output_name ?></td>
                        <td><?= $output->output_quantity.' '.$output->unit ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 