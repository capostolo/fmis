<html>
<head>
<style>
body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 75%;
}

table, th, td {
  border: 1px solid;
  border-collapse: collapse;
}

th, td {
  text-align: center;
}
</style>
</head>
<body>
    <div class='container-fluid'>
    <div class="text-custom-anthrax text-center">
        <h2><?= lang('Fmis.farm_input_output');?></h2>
    </div>
    <div class="row mt-4">
        <div class="col-12 mt-2">
			<table width="100%">
				<tr>
					<td colspan="4">Στοιχεία γεωργού</td>
				</tr>
				<tr>
					<td width="25%">ΑΦΜ:</td>
					<td width="25%"><?= session()->get('farmer_afm')?></td>
					<td width="25%">Ονοματεπώνυμο γεωργού / νόμιμου εκπροσώπου νομικού προσώπου:</td>
					<td width="25%"><?= session()->get('farmer_name')?></td>
				</tr>
				<tr>
					<td>Τύπος προσώπου (Φυσικό ή Νομικό Πρόσωπο):</td>
					<td>Φυσικό πρόσωπο</td>
					<td>Πατρώνυμο:</td>
					<td><?= session()->get('farmer_fathername')?></td>
				</tr>
				<tr>
					<td>Επωνυμία (στην περίπτωση νομικού προσώπου):</td>
					<td colspan="3"></td>
				</tr>
			</table>
		</div>
		<br/>
		<div class="col-12 mt-2">
			<table width="100%">
				<tr>
					<td colspan="2">Στοιχεία έδρας εκμετάλλευσης</td>
				</tr>
				<tr>
					<td width="50%">Περιφέρεια έδρας εκμετάλλευσης:</td>
					<td width="50%"><?= session()->get('farmer_reg')?></td>
				</tr>
				<tr>
					<td>Περιφερειακή ενότητα έδρας εκμετάλλευσης:</td>
					<td><?= session()->get('farmer_pen')?></td>
				</tr>
				<tr>
					<td>Δημοτική – Τοπική Κοινότητα έδρας εκμετάλλευσης:</td>
					<td><?= session()->get('farmer_location')?></td>
				</tr>
			</table>
		</div>
    </div>
    <div class="row mt-4">
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
</body>
</html> 