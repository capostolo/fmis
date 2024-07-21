<?= $this->extend('Fmis\Views\base_view') ?>
<?= $this->section('main') ?>
  <header class="masthead home">
      <div class="container h-100">
          <div class="row align-items-center justify-content-center text-center">
              <div class="col-10 align-self-end">
                  <h2 class=" mt-3 mb-3">
			<span class="text-custom-anthrax">Πλατφόρμα</span>
			<span class="text-custom-green">Ηλεκτρονικών Καταγραφών Εργασιών</span>
			<span class="text-custom-anthrax">και</span>
			<span class="text-custom-green">Παρακολούθησης Περιβαλλοντικών Παραμέτρων</span>
			<span class="text-custom-anthrax">σε γεωργικές εκμεταλλεύσεις</span>
		  </h2>
                  <div class="col-10 mt-5">
                  	<img class="img-fluid" src="<?= base_url() ?>/assets/images/schemis.jpg" />
                  </div>
                  <hr class="divider my-4" />
                  <div class="text-center">
                    <a class="btn btn-custom-green btn-xl" href="<?= site_url('register') ?>">Κάνε τώρα εγγραφή</a>
					<p> ή </p>
                    <a class="btn btn-custom-green btn-xl js-scroll-trigger" href="#about">Μάθε περισσότερα</a>
                  </div>
              </div>
          </div>
      </div>
  </header>
    <!-- About-->
    <section class="page-section bg-custom-anthrax" id="about">
        <div class="container h-100">
            <div class="row justify-content-center">
                <div class="col-8 text-center">
                    <h2 class="text-white mt-0">Τι είναι το Schemis;</h2>
                    <hr class="divider light my-4" />
                    <p class="text-white-50 text-justify">To Schemis είναι μια εύχρηστη πλατφόρμα, πιστοποιημένη από τον ΟΠΕΚΕΠΕ με αριθμό άδειας καταλληλότητας 15704/20-03-2024, που έχει σχεδιαστεί για να καλύψει τις απαιτήσεις των οικολογικών προγραμμάτων.</p> 
		    <p class="text-white-50 text-justify">Επιπλέον, περιλαμβάνει ένα αναλυτικό ημερολόγιο εργασιών που καταγράφει και συνδέει με απλό τρόπο όλες τις καλλιεργητικές εργασίες που απαιτούνται στη βιολογική γεωργία και την ολοκληρωμένη διαχείριση σε ένα ολοκληρωμένο σχέδιο διαχείρισης.</p>
                </div>
            </div>
		<div class="text-center mt-3">
			<a class="btn btn-custom-green btn-xl js-scroll-trigger" href="#services">Δείτε τι παρέχει το Schemis</a>
		</div>
        </div>
    </section>
    <!-- Services-->
    <section class="page-section" id="services">
        <div class="container">
            <h2 class="text-center text-custom-anthrax mt-0">Τι παρέχει το Schemis;</h2>
            <hr class="divider my-4" />
            <div class="row">
                <div class="col-md-5 text-center text-custom-green py-5 order-md-12">
                </div>
                <div class="col-md-7 text-custom-anthrax">
                    <ul class="list-group text-left">
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="bi bi-check"></i></span>Διαχείριση οικολογικών προγραμμάτων</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="bi bi-check"></i></span>Ημερολόγιο εργασιών για την παρακολούθηση πρακτικών διαχείρισης</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="bi bi-check"></i></span>Αυτόματη εισαγωγή δεδομένων για τις γεωργικές εκμεταλλεύσεις</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="bi bi-check"></i></span>Υποστήριξη για την τήρηση δεσμεύσεων στη βιολογική γεωργία και ολοκληρωμένη διαχείριση</li>
                    </ul>
                    <div class="text-center">
                    </div>
                </div>
            </div>
            <hr class="divider my-4" />
            <div class="row">
                <div class="col-md-5 text-center text-custom-green py-5">
                    <h3 class="">Ποιές εργασίες καταγράφονται;</h3>
                </div>
                <div class="col-md-7 text-custom-anthrax">
                    <ul class="list-group text-left">
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="fas fa-check"></i></span>Διαχείριση εδάφους</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="fas fa-check"></i></span>Ορθή εφαρμογή των κλαδεμάτων</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="fas fa-check"></i></span>Εφαρμογή αρδεύσεων</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="fas fa-check"></i></span>Λίπανση καλλιέργειας</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="fas fa-check"></i></span>Εφαρμογή ψεκασμών στην εκμετάλλευση</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="fas fa-check"></i></span>Διαχείριση συγκομιδής</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="fas fa-check"></i></span>Ανάρτηση παγίδων μαζικής σύλληψης</li>
                    </ul>
                    <div class="text-center">
                    </div>
                </div>
            </div>
            <hr class="divider my-4" />
            <div class="row">
                <div class="col-md-5 text-center text-custom-green py-5 order-md-12">
                    <h3 class="">Τι παράγεται από το Schemis;</h3>
                </div>
                <div class="col-md-7 text-custom-anthrax">
                    <ul class="list-group text-left">
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="bi bi-check"></i></span>Οδηγίες εργασιών που παρέχονται από γεωργικούς συμβούλους.</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="bi bi-check"></i></span>Σχέδιο Περιβαλλοντικής Διαχείρισης (ΣΠΔ) για το οικολογικό πρόγραμμα Π1-31.6.</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="bi bi-check"></i></span>Ημερολόγιο εργασιών βάσει των καταγραφών</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="bi bi-check"></i></span>Πλήρες ισοζύγιο θρεπτικών ουσιών</li>
                    </ul>
                    <div class="text-center">
                    </div>
                </div>
            </div>
            <hr class="divider my-4" />
            <div class="row">
                <div class="col-md-5 text-center text-custom-green py-5">
                    <h3 class="">Ποιοι χρησιμοποιούν το Schemis;</h3>
                </div>
                <div class="col-md-7 text-custom-anthrax">
                    <ul class="list-group text-left">
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="bi bi-check"></i></span>Αγρότες για την καταγραφή των εργασιών τους στο πλαίσιο της τήρησης των οικολογικών τους 
προγραμμάτων.</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="bi bi-check"></i></span>Ομάδες παραγωγών για την καταγραφή εργασιών που απαιτούνται στην ολοκληρωμένη διαχείριση.</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="bi bi-check"></i></span>Βιολογικοί παραγωγοί για την τήρηση του ημερολογίου εργασιών τους.</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="bi bi-check"></i></span>Γεωργικοί Σύμβουλοι για την έκδοση οδηγιών και συμβουλών</li>
                        <li class="list-group-item border-0 ml-1"><span class="fa-li ml-4"><i class="bi bi-check"></i></span>Συνεταιρισμοί και Ερευνητικά ιδρύματα για την παρακολούθηση πιλοτικών και επιδεικτικών έργων</li>
                    </ul>
                </div>
            </div>
			<div class="text-center mt-3">
				<a class="btn btn-custom-anthrax btn-xl js-scroll-trigger" href="#contact">Επικοινωνήστε  μαζί μας</a>
			</div>
        </div>
    </section>
    <section class="page-section" id="contact">
        <div class="container">
            <h2 class="text-center text-custom-anthrax mt-0">Επικοινωνήστε μαζί μας</h2>
            <hr class="divider my-4" />
            <div class="row">
                <div class="col-12 d-flex align-items-stretch">
                    <div class="info-wrap bg-custom-anthrax text-white w-100 p-md-5 p-4">
						<div class="col-10 mt-5">
							<img class="img-fluid" src="<?= base_url() ?>/assets/images/schemis.jpg" />
						</div>
						<p class="mb-4"></p>
						<div class="dbox w-100 d-flex align-items-start">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="bi bi-geo-alt"></span>
							</div>
							<div class="text pl-3">
								<p><span>Διεύθυνση: </span><span><small>Φαέθοντος 14, 11363,
											Αθήνα</small></span> </p>
							</div>
						</div>
						<div class="dbox w-100 d-flex align-items-center">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="bi bi-phone"></span>
							</div>
							<div class="text pl-3">
								<p><span>Τηλέφωνο: </span> <a class="text-white" href="tel://+30 211 4185092"><small>+30 2114185092</small></a></p>
							</div>
						</div>
						<div class="dbox w-100 d-flex align-items-center">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="bi bi-send"></span>
							</div>
							<div class="text pl-3">
								<p><span>Email: </span><span><small>schemis [at]                                            agrenaos.gr</small></span></p>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<?= $this->endSection() ?>