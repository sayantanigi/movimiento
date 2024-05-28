<main>
    <section class="signup__area po-rel-z1 pt-50 pb-50 bg-primary mt-100">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 mt-50">
                    <div class="section__title-wrapper text-center pb-20 mb-30">
                        <h2 class="section__title">INTERVENANTS #MAKUTANO8</h2>
                        <h4 class="h3 fw-bold">INFINITELY TERRITORIES</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="po-rel-z1 pt-50 pb-50 text-white">
        <div class="container">
            <h2 class="fw-bold text-center h4 mb-40">ILS ONT CONFIRMÉ LEUR PARTICIPATION AU #MAKUTANO8</h2>
            <div class="row g-4">
                <?php if(!empty($intervenants)) { 
                foreach($intervenants as $value) { ?>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="inverBox bg-primary text-center">
                        <div class="inverImg"><img src="<?= base_url()?>uploads/intervenants/<?= $value['profilePics']?>"/></div>
                        <div class="invername"><?= $value['name']?></div>
                        <div class="inverinfo"><?= $value['designation']?></div>
                    </div>
                </div>
                <?php } } else { ?>
                <div class="col-lg-3 col-md-4 col-6">No data found</div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>