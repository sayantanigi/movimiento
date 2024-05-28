<main>
    <section class="signup__area po-rel-z1 pt-50 pb-50 bg-primary mt-100">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 mt-50">
                    <div class="section__title-wrapper text-center pb-20 mb-30">
                        <?php if($tab == 'partenaires_08') { ?>
                        <h2 class="section__title">PARTENAIRES #MAKUTANO8</h2>
                        <?php } else { ?>
                        <h2 class="section__title">PARTENAIRES #MAKUTANO7</h2>
                        <?php } ?>
                        <h4 class="h3 fw-bold">INFINITELY TERRITORIES</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="po-rel-z1 pt-50 pb-50 text-white">
        <div class="container">
            <h2 class="fw-bold text-center h1 mb-40 text-danger">Thank you !</h2>
            <?php if($tab == 'partenaires_08') { ?>
            <img src="assets/img/sponsors-makutano-8-OK.webp" class="img-fluid rounded"/>
            <?php } else { ?>
                <img src="assets/img/sponsors-makutano-7-OK.webp" class="img-fluid rounded"/>
            <?php } ?>
        </div>
    </section>
</main>