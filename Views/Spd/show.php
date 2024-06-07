<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
<div class='container-fluid'>
	<div class="text-custom-anthrax text-center">
		<h2><?= lang('Fmis.spd');?></h2>
		<p class="lead"></p>
		<p class=""></p>
	</div>
	<div class='row'>
		<h5>ΠΙΝΑΚΑΣ 1 - ΣΤΟΙΧΕΙΑ ΑΓΡΟΤΕΜΑΧΙΩΝ ΑΝΑ ΠΑΡΕΜΒΑΣΗ</h5>
		<div class="col-12">
			<table>
				<thead>
					<tr>
						<th rowspan="3">Τοποθεσία</th>
						<th rowspan="3">Κωδικός Χαρτογραφικού Υποβάθρου</th>
						<th rowspan="3">Επιλέξιμη έκταση ΕΑΕ (ha)</th>
						<th rowspan="3">Καλλιέργεια</th>
						<th rowspan="3">Εφαρμογή</th>
						<th colspan="12">Περιβαλλοντική στόχευση</th>
					</tr>
					<tr>
						<th colspan="4">Χρήση εναλλακτικών μεθόδων καταπολέμισης εχθρών</th>
						<th colspan="2">Ορθές γεωργικές πρακτικές για τη μείωση εισροών</th>
						<th colspan="3">Χρήση εξοπλισμού και αυτοματισμών για τη μείωση της ρύπανσης και την εφαρμογή φυτοπροστατευτικών προϊόντων</th>
						<th colspan="3">Βελτίωση της διαχείρισης θρεπτικών συστατικών</th>
					</tr>
					<tr>
						<th>31.6-Β</th>
						<th>31.6-Γ</th>
						<th>31.6-Δ</th>
						<th>31.6-ΙΓ</th>
						<th>31.6-Ε</th>
						<th>31.6-ΣΤ</th>
						<th>31.6-Ζ</th>
						<th>31.6-Η</th>
						<th>31.6-Θ</th>
						<th>31.6-Ι</th>
						<th>31.6-ΙΑ</th>
						<th>31.6-ΙΒ</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($table1 as $t) {?>
					<tr>
						<td><?= $t->location ?></td>
						<td><?= $t->code ?></td>
						<td><?= $t->total_area ?></td>
						<td><?= $t->poiCategoryName.' - '.$t->poiDescription ?></td>
						<td>Schemis</td>
						<td><?= ($t->ecoB == 1)? '<i class="bi bi-check"></i>' : ''?></td>
						<td><?= ($t->ecoC == 1)? '<i class="bi bi-check"></i>' : '' ?></td>
						<td><?= ($t->ecoD == 1)? '<i class="bi bi-check"></i>' : '' ?></td>
						<td><?= ($t->ecoIC == 1)? '<i class="bi bi-check"></i>' : '' ?></td>
						<td><?= ($t->ecoE == 1)? '<i class="bi bi-check"></i>' : '' ?></td>
						<td><?= ($t->ecoST == 1)? '<i class="bi bi-check"></i>' : '' ?></td>
						<td><?= ($t->ecoZ == 1)? '<i class="bi bi-check"></i>' : '' ?></td>
						<td><?= ($t->ecoH == 1)? '<i class="bi bi-check"></i>' : '' ?></td>
						<td><?= ($t->ecoU == 1)? '<i class="bi bi-check"></i>' : '' ?></td>
						<td><?= ($t->ecoI == 1)? '<i class="bi bi-check"></i>' : '' ?></td>
						<td><?= ($t->ecoIA == 1)? '<i class="bi bi-check"></i>' : '' ?></td>
						<td><?= ($t->ecoIB == 1)? '<i class="bi bi-check"></i>' : '' ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class='row mt-5'>
		<h5>ΠΙΝΑΚΑΣ 2 - ΧΡΗΣΗ ΕΝΑΛΛΑΚΤΙΚΩΝ ΜΕΘΟΔΩΝ ΚΑΤΑΠΟΛΕΜΗΣΗΣ ΕΧΘΡΩΝ (31.6-Β, 31.6-Γ, 31.6-Δ, 31.6-ΙΓ)</h5>
		<div class="col-12">
			<table>
				<thead>
					<tr>
						<th>Δράση</th>
						<th>Συνολική έκταση αγροτεμαχίων (ha)</th>
						<th>Εχθρός</th>
						<th>Εμπορική Ονομασία</th>
						<th>Αριθμός ΑΑΔΑ / Απόφαση εγγραφή ΕΚΣΦΜ σκευάσματος</th>
						<th>Συνιστώμενη ποσότητα</th>
						<th>Εύρος ημερομηνιών εφαρμογής / εξαπόλυσης</th>
						<th>Εφαρμοσθείσα ποσότητα</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($table2 as $t) {?>
					<tr>
						<td><?= $t->action ?></td>
						<td><?= $t->total_area ?></td>
						<td><?= $t->targets ?></td>
						<td><?= $t->product?></td>
						<td><?= $t->aada?></td>
						<td><?= $t->recommended_dose.' '.$t->unit?></td>
						<td><?= $t->min_date->toLocalizedString('d/M/Y').' έως '.$t->max_date->toLocalizedString('d/M/Y')?></td>
						<td><?= $t->applied_dose.' '.$t->unit?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class='row mt-5'>
		<h5>ΠΙΝΑΚΑΣ 3 - ΟΡΘΕΣ ΓΕΩΡΓΙΚΕΣ ΠΡΑΚΤΙΚΕΣ ΓΙΑ ΤΗ ΜΕΙΩΣΗ ΕΙΣΡΟΩΝ (31.6-Ε,-ΣΤ)</h5>
		<div class="col-12">
			<table>
				<thead>
					<tr>
						<th>Δράση</th>
						<th>Συνολική έκταση αγροτεμαχίων (ha)</th>
						<th>Τύπος εξοπλισμού (31.6-Ε)</th>
						<th>Τύπος φυτικού υλικού εδαφοκάλυψης (31.6-Ε)</th>
						<th>Αριθμός καλοκαιρινών κλαδεμάτων (31.6-ΣΤ)</th>
						<th>Διαστήματα εφαρμογής</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($table3b as $t) {?>
					<tr>
						<td><?= $t->action ?></td>
						<td><?= $t->total_area ?></td>
						<td><?= $t->equipment_type ?></td>
						<td><?= $t->cover_crop ?></td>
						<td></td>
						<td><?= $t->min_date->toLocalizedString('d/M/Y').' έως '.$t->max_date->toLocalizedString('d/M/Y')?></td>
					</tr>
				<?php } ?>
				<?php foreach ($table3a as $t) {?>
					<tr>
						<td><?= $t->action ?></td>
						<td><?= $t->total_area ?></td>
						<td></td>
						<td></td>
						<td><?= $t->num_pruning ?></td>
						<td><?= $t->min_date->toLocalizedString('d/M/Y').' έως '.$t->max_date->toLocalizedString('d/M/Y')?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class='row mt-5'>
		<h5>ΠΙΝΑΚΑΣ 4 - ΧΡΗΣΗ ΕΞΟΠΛΙΣΜΟΥ & ΑΥΤΟΜΑΤΙΣΜΩΝ ΓΙΑ ΤΗ ΜΕΙΩΣΗ ΤΗΣ ΡΥΠΑΝΣΗΣ ΚΑΙ ΤΗΝ ΕΦΑΡΜΟΓΗ ΦΥΤΟΠΡΟΣΤΑΤΕΥΤΙΚΩΝ ΠΡΟΪΟΝΤΩΝ (31.6-Ζ,-Η, -Θ)</h5>
		<div class="col-12">
			<table>
				<thead>
					<tr>
						<th>Δράση</th>
						<th>Συνολική έκταση αγροτεμαχίων (ha)</th>
						<th>Τύπος ακροφυσίων (31.6-Ζ)</th>
						<th>Αριθμός ακροφυσίων (31.6-Ζ)</th>
						<th>Έτος αγοράς εξοπλισμού (31.6-Ζ, -Θ)</th>
						<th>Τύπος εξοπλισμού φυτοπροστασίας (31.6-Ζ)</th>
						<th>Τύπος εξοπλισμού γεωργίας ακριβείας (31.6-Θ)</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($table4 as $t) {?>
					<tr>
						<td><?= $t->action ?></td>
						<td><?= $t->total_area ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td><?= ($t->action == '31.6-Ζ')? $t->equipment_type: ''?></td>
						<td><?= ($t->action == '31.6-Θ')? $t->equipment_type: ''?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class='row mt-5'>
		<h5>ΠΙΝΑΚΑΣ 5 - ΒΕΛΤΙΩΣΗ ΤΗΣ ΔΙΑΧΕΙΡΙΣΗΣ ΤΩΝ ΘΡΕΠΤΙΚΩΝ ΣΥΣΤΑΤΙΚΩΝ (31.6-Ι, -ΙΑ, -ΙΒ)</h5>
		<div class="col-12">
			<table>
				<thead>
					<tr>
						<th>Δράση</th>
						<th>Συνολική έκταση αγροτεμαχίων (ha)</th>
						<th>Τύπος λιπάσματος</th>
						<th>Εμπορική ονομασία</th>
						<th>Κατηγορία προϊόντος λίπανσης</th>
						<th>Εφαρμοσθείσα ποσότητα</th>
						<th>Διαστήματα εφαρμογής</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($table5 as $t) {?>
					<tr>
						<td><?= $t->action ?></td>
						<td><?= $t->total_area ?></td>
						<td><?= $t->type ?></td>
						<td><?= $t->name ?></td>
						<td><?= $t->category ?></td>
						<td><?= $t->total_quantity.' '.$t->unit?></td>
						<td><?= $t->min_date->toLocalizedString('d/M/Y').' έως '.$t->max_date->toLocalizedString('d/M/Y')?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>