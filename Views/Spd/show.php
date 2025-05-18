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
	<div class='row' style="font-size: 100%;">
		<div class="text-custom-anthrax text-center">
			<h2 style="text-align: center;">Σχέδιο Περιβαλλοντικής Διαχείρισης (ΣΠΔ) στο πλαίσιο των Οικολογικών Προγραμμάτων (ecoschemes) του ΣΣ ΚΑΠ</h2>
			<h3 style="text-align: center;">Παρέμβαση Π1-31.6 Ενίσχυση παραγωγών για την παραγωγή φιλικών για το περιβάλλον πρακτικών διαχείρισης, με τη χρήση ψηφιακής εφαρμογής διαχείρισης εισροών και περιβαλλοντικών παραμέτρων</h3>
			<h4 style="text-align: center;">Δράση 31.6-Α Χρήση της ψηφιακής εφαρμογής και σύνταξη Σχεδίου Περιβαλλοντικής Διαχείρισης (ΣΠΔ)</h4>
		</div>
		<div class="col-12">
			<table width="100%">
				<tr>
					<td width="25%">Έτος ΕΑΕ:</td>
					<td width="25%"><?= $iacs_year?></td>
					<td width="25%">Ημερομηνία κατάρτισης:</td>
					<td width="25%"><?= $spd_date ?> </td>
				</tr>
			</table>
		</div>
		<br/>
		<div class="col-12 mt-2">
			<table width="100%">
				<tr>
					<td colspan="4">Στοιχεία αιτούντα γεωργού</td>
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
					<td></td>
					<td></td>
					<td></td>
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
		<br/>
		<div class="col-12 mt-2">
			<table width="100%">
				<tr>
					<td colspan="4">Στοιχεία τεχνικού συμβούλου (Γεωπόνος (ΠΕ))</td>
				</tr>
				<tr>
					<td width="25%">ΑΦΜ επιβλέποντα τεχνικού συμβούλου:</td>
					<td width="25%"><?= $advisor->advisor_afm ?? '' ?></td>
					<td colspan="2">Σε περίπτωση απασχόλησης του τεχνικού συμβούλου σε νομικό πρόσωπο, συμπληρώστε τα στοιχεία του νομικού προσώπου: </td>
				</tr>
				<tr>
					<td>Αριθμός Μητρώου ΓΕΩΤΕΕ::</td>
					<td><?= $advisor->advisor_geotee ?? '' ?></td>
					<td width="25%">ΑΦΜ νομικού προσώπου: </td>
					<td width="25%"><?= $user->company_afm ?></td>
				</tr>
				<tr>
					<td>Επώνυμο:</td>
					<td><?= $advisor->advisor_lastname ?? '' ?></td>
					<td>Επωνυμία νομικού προσώπου:</td>
					<td><?= $user->company_name ?></td>
				</tr>
				<tr>
					<td>Όνομα:</td>
					<td><?= $advisor->advisor_firstname ?? '' ?></td>
					<td colspan="2">Σχέση εργασίας τεχνικού συμβούλου με το νομικό πρόσωπο (τσεκάρετε με «Χ» κατά περίπτωση: </td>
				</tr>
				<tr>
					<td rowspan="4" colspan="2"></td>
					<td>Μισθωτός</td>
					<td><?= ($advisor && $advisor->advisor_employment == 1)?'X':'' ?></td>
				</tr>
				<tr>
					<td>Μέτοχος</td>
					<td><?= ($advisor && $advisor->advisor_employment == 2)?'X':'' ?></td>
				</tr>
				<tr>
					<td>Με δελτίο παροχής υπηρεσιών </td>
					<td><?= ($advisor && $advisor->advisor_employment == 3)?'X':'' ?></td>
				</tr>
				<tr>
					<td style="height: 50px; vertical-align: top;">Άλλο (συνοπτική περιγραφή)</td>
					<td></td>
				</tr>
			</table>
		<br/>
		<div class="col-12 mt-2">
			<table width="100%"  style="border: 0px; border-collapse:collapse;">
				<tr>
					<td rowspan="3" width="50%" style="border-style: hidden!important;"></td>
					<td width="50%">Ο συντάκτης - Τεχνικός σύμβουλος</td>
				</tr>
				<tr>
					<td style="height: 100px; vertical-align: bottom;">(Υπογραφή- σφραγίδα)</td>
				</tr>
				<tr>
					<td style="height: 50px; vertical-align: bottom;">(Ημερομηνία)</td>
				</tr>
			</table>
		</div>
		</div>
	</div>
	<pagebreak orientation="L">
	<div class='row' style="font-size: 75%;">
		<h3>ΠΙΝΑΚΑΣ 1 - ΣΤΟΙΧΕΙΑ ΑΓΡΟΤΕΜΑΧΙΩΝ ΑΝΑ ΠΑΡΕΜΒΑΣΗ</h3>
		<div class="col-12">
			<table>
				<thead>
					<tr>
						<th rowspan="3">α/α αγροτεμαχίου (ΕΑΕ)</th>
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
				<?php foreach ($table1 as $t) {
					$eco = $t->ecoB + $t->ecoC + $t->ecoD + $t->ecoE + $t->ecoST + $t->ecoZ + $t->ecoH + $t->ecoU + $t->ecoI + $t->ecoIA + $t->ecoIB + $t->ecoIC;
					if ($eco > 0) {?>
					<tr>
						<td><?= $t->aa ?></td>
						<td><?= $t->location ?></td>
						<td><?= $t->code ?></td>
						<td><?= $t->total_area ?></td>
						<td><?= $t->poiCategoryName.' - '.$t->poiDescription ?></td>
						<td>Schemis</td>
						<td><?= ($t->ecoB == 1)? 'Ναι' : ''?></td>
						<td><?= ($t->ecoC == 1)? 'Ναι' : '' ?></td>
						<td><?= ($t->ecoD == 1)? 'Ναι' : '' ?></td>
						<td><?= ($t->ecoIC == 1)? 'Ναι' : '' ?></td>
						<td><?= ($t->ecoE == 1)? 'Ναι' : ''?></td>
						<td><?= ($t->ecoST == 1)? 'Ναι' : '' ?></td>
						<td><?= ($t->ecoZ == 1)? 'Ναι' : '' ?></td>
						<td><?= ($t->ecoH == 1)? 'Ναι' : '' ?></td>
						<td><?= ($t->ecoU == 1)? 'Ναι' : '' ?></td>
						<td><?= ($t->ecoI == 1)? 'Ναι' : '' ?></td>
						<td><?= ($t->ecoIA == 1)? 'Ναι' : '' ?></td>
						<td><?= ($t->ecoIB == 1)? 'Ναι' : '' ?></td>
					</tr>
				<?php } } ?>
				</tbody>
			</table>
		</div>
	</div>
	</pagebreak>
	<pagebreak orientation="L">
	<div class='row mt-5' style="font-size: 75%;">
		<h3>ΠΙΝΑΚΑΣ 2 - ΧΡΗΣΗ ΕΝΑΛΛΑΚΤΙΚΩΝ ΜΕΘΟΔΩΝ ΚΑΤΑΠΟΛΕΜΗΣΗΣ ΕΧΘΡΩΝ (31.6-Β, 31.6-Γ, 31.6-Δ, 31.6-ΙΓ)</h3>
		<div class="col-12">
			<table>
				<thead>
					<tr>
						<th>Ημνία</th>
						<th>α/α αγροτεμαχίου (ΕΑΕ)</th>
						<th>Δράση</th>
						<th>Επιλέξιμη έκταση ΕΑΕ  (ha)</th>
						<th>Καλλιέργεια</th>
						<th>Εμπορική Ονομασία</th>
						<th>Αριθμός ΑΑΔΑ / Απόφαση εγγραφή ΕΚΣΦΜ σκευάσματος</th>
						<th>Εχθρός</th>
						<th>Συνιστώμενη ποσότητα</th>
						<th>Συνιστώμενο διάστημα εφαρμογής / εξαπόλυσης</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($table2 as $t) {?>
					<tr>
						<td><?= $t->dir_date->toLocalizedString('d/M/Y') ?></td>
						<td><?= $t->aa ?></td>
						<td><?= $t->action ?></td>
						<td><?= $t->total_area ?></td>
						<td><?= $t->poiCategoryName.' - '.$t->poiDescription ?></td>
						<td><?= $t->product?></td>
						<td><?= $t->aada?></td>
						<td><?= $t->targets ?></td>
						<td><?= $t->recommended_dose.' '.$t->unit?></td>
						<td><?= $t->dir_dates?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	</pagebreak>
	<pagebreak orientation="L">
	<div class='row mt-5' style="font-size: 75%;">
		<h3>ΠΙΝΑΚΑΣ 3 - ΟΡΘΕΣ ΓΕΩΡΓΙΚΕΣ ΠΡΑΚΤΙΚΕΣ ΓΙΑ ΤΗ ΜΕΙΩΣΗ ΕΙΣΡΟΩΝ (31.6-Ε,-ΣΤ)</h3>
		<div class="col-12">
			<table>
				<thead>
					<tr>
						<th>Ημνία</th>
						<th>α/α αγροτεμαχίου (ΕΑΕ)</th>
						<th>Δράση</th>
						<th>Επιλέξιμη έκταση ΕΑΕ  (ha)</th>
						<th>Καλλιέργεια</th>
						<th>Τύπος εξοπλισμού (31.6-Ε)</th>
						<th>Τύπος φυτικού υλικού εδαφοκάλυψης (31.6-Ε)</th>
						<th>Αριθμός καλοκαιρινών κλαδεμάτων (31.6-ΣΤ)</th>
						<th>Διαστήματα εφαρμογής</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($table3b as $t) {?>
					<tr>
						<td><?= $t->dir_date->toLocalizedString('d/M/Y') ?></td>
						<td><?= $t->aa ?></td>
						<td><?= $t->action ?></td>
						<td><?= $t->total_area ?></td>
						<td><?= $t->poiCategoryName.' - '.$t->poiDescription ?></td>
						<td><?= $t->equipment_type ?></td>
						<td><?= $t->cover_crop ?></td>
						<td></td>
						<td><?= $t->dir_dates?></td>
					</tr>
				<?php } ?>
				<?php foreach ($table3a as $t) {?>
					<tr>
						<td><?= $t->dir_date->toLocalizedString('d/M/Y') ?></td>
						<td><?= $t->aa ?></td>
						<td><?= $t->action ?></td>
						<td><?= $t->total_area ?></td>
						<td><?= $t->poiCategoryName.' - '.$t->poiDescription ?></td>
						<td></td>
						<td></td>
						<td><?= $t->num_pruning ?></td>
						<td><?= $t->dir_dates?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	</pagebreak>
	<pagebreak orientation="L">
	<div class='row mt-5' style="font-size: 75%;">
		<h3>ΠΙΝΑΚΑΣ 4 - ΧΡΗΣΗ ΕΞΟΠΛΙΣΜΟΥ & ΑΥΤΟΜΑΤΙΣΜΩΝ ΓΙΑ ΤΗ ΜΕΙΩΣΗ ΤΗΣ ΡΥΠΑΝΣΗΣ ΚΑΙ ΤΗΝ ΕΦΑΡΜΟΓΗ ΦΥΤΟΠΡΟΣΤΑΤΕΥΤΙΚΩΝ ΠΡΟΪΟΝΤΩΝ (31.6-Ζ,-Η, -Θ)</h3>
		<div class="col-12">
			<table>
				<thead>
					<tr>
						<th>Ημνία</th>
						<th>α/α αγροτεμαχίου (ΕΑΕ)</th>
						<th>Δράση</th>
						<th>Επιλέξιμη έκταση ΕΑΕ  (ha)</th>
						<th>Καλλιέργεια</th>
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
						<td><?= $t->dir_date->toLocalizedString('d/M/Y') ?></td>
						<td><?= $t->aa ?></td>
						<td><?= $t->action ?></td>
						<td><?= $t->total_area ?></td>
						<td><?= $t->poiCategoryName.' - '.$t->poiDescription ?></td>
						<td><?= $beck_type ?></td>
						<td><?= $beck_num ?></td>
						<td><?= $equip_year ?></td>
						<td><?= ($t->action == '31.6-Ζ')? $t->equipment_type: ''?></td>
						<td><?= ($t->action == '31.6-Θ')? $t->equipment_type: ''?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	</pagebreak>
	<pagebreak orientation="L">
	<div class='row mt-5' style="font-size: 75%;">
		<h3>ΠΙΝΑΚΑΣ 5 - ΒΕΛΤΙΩΣΗ ΤΗΣ ΔΙΑΧΕΙΡΙΣΗΣ ΤΩΝ ΘΡΕΠΤΙΚΩΝ ΣΥΣΤΑΤΙΚΩΝ (31.6-Ι, -ΙΑ, -ΙΒ)</h3>
		<div class="col-12">
			<table>
				<thead>
					<tr>
					<th>Ημνία</th>
						<th>α/α αγροτεμαχίου (ΕΑΕ)</th>
						<th>Δράση</th>
						<th>Επιλέξιμη έκταση ΕΑΕ  (ha)</th>
						<th>Καλλιέργεια</th>
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
						<td><?= $t->dir_date->toLocalizedString('d/M/Y') ?></td>
						<td><?= $t->aa ?></td>
						<td><?= $t->action ?></td>
						<td><?= $t->total_area ?></td>
						<td><?= $t->poiCategoryName.' - '.$t->poiDescription ?></td>
						<td><?= $t->type ?></td>
						<td><?= $t->name ?></td>
						<td><?= $t->category ?></td>
						<td><?= $t->total_quantity.' '.$t->unit?></td>
						<td><?= $t->dir_dates?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	</pagebreak>
	<pagebreak orientation="L">
	<div class='row mt-5' style="font-size: 75%;">
		<h3>ΠΙΝΑΚΑΣ 6 - ΨΗΦΙΑΚΗ ΕΦΑΡΜΟΓΗ ΔΙΑΧΕΙΡΙΣΗΣ ΕΙΣΡΟΩΝ & ΠΑΡΑΚΟΛΟΥΘΗΣΗΣ ΠΕΡΙΒΑΛΛΟΝΤΙΚΩΝ ΠΑΡΑΜΕΤΡΩΝ (31.6-Α)</h3>
		<h3>Ονομασία πιστοποιημένης ψηφιακής εφαρμογής: SCHEMIS</h3>
		<h3>Τομείς που καλύπτει η εφαρμογή: Άρδευση, Διαχείριση εδάφους, Κλάδεμα, Λίπανση, Μαζική παγίδευση, Συγκομιδή, 
		Φυτοπροστασία</h3>
		<div class="col-12">
			<table width="100%">
				<thead>
					<tr>
						<th>Περιγραφή συμβουλής που αντλήθηκε από την ψηφιακή εφαρμογή</th>
						<th>Περιγραφή του τρόπου υιοθέτησης της συμβουλής από το γεωργό</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($table6 as $t) {?>
					<tr>
						<td>
							<?php
								if ($t->dir_date == null) {
									echo $t->farm_practice. ' (A/A EAE: '. $t->aa. ', '. $t->location. ', '. $t->application_date->toLocalizedString('d/M/Y'). ')'; 
								}
								else {
									echo $t->farm_practice. ' (A/A EAE: '. $t->aa. ', '. $t->location. ', '. $t->dir_date->toLocalizedString('d/M/Y'). ')' ;
								}
							?>
						</td>
						<td>
							<?php
								$nonadoption = "";
								$adoption = array();
								if ($t->dir_date == null) {
									echo "Χωρίς συμβουλή";
								}
								else {
									if ($t->application_date == null) {
										$nonadoption = "Η συμβουλή δεν υλοποιήθηκε.";
									}
									else {
										if ($t->product_check == 0) {
											$adoption[] = "στο προϊόν";
										}
										if ($t->quantity_check == 0) {
											$adoption[] = "στην ποσότητα";
										}
										if ($t->application_check == 0) {
											$adoption[] = "στον τρόπο εφαρμογής";
										}
										if ($t->stage_check == 0) {
											$adoption[] = "στο στάδιο καλλιέργειας";
										}
									}
									if ($nonadoption != "") {
										echo $nonadoption;
									}
									else if(count($adoption) > 0) {
										echo "Η συμβουλή υιοθετήθηκε στις ".$t->application_date->toLocalizedString('d/M/Y'). " με διαφορά ".implode(', ', $adoption);
									}
									else {
										echo "Η συμβουλή υιοθετήθηκε πλήρως στις ".$t->application_date->toLocalizedString('d/M/Y');
									}
								}
							?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html>