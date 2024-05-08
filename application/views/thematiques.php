<main>
    <section class="signup__area po-rel-z1 pt-50 pb-50 bg-primary mt-100 conferencebg  bgbanner" style="background-image: url(./assets/img/bnner-bg1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 mt-50">
                    <div class="section__title-wrapper text-center pt-20 pb-20 mb-30">
                        <h2 class="section__title">THÉMATIQUES 2021</h2>
                        <h4 class="h3 fw-bold">INTERNATIONAL BUSINESS FORUM</h4>
                        <h4 class="h3 fw-bold"><i class="far fa-angle-double-left"></i> OUT OF THE BOX ! <i class="far fa-angle-double-right"></i></h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="po-rel-z1 pt-50 pb-50 text-white">
        <div class="container">
            <div><?= $thematiques_desc->description?></div>
            <div class="mt-50">
                <h3 class="fw-bold text-center">DÉCOUVREZ NOS THÉMATIQUES</h3>
                <div class="row g-2">
                    <?php if(!empty($thematiques)) { 
                    foreach ($thematiques as $val) { ?>
                    <div class="col-lg-6">
                        <a href="<?= base_url()?>uploads/thematiques/<?= $val['image']?>" class="d-flex blocknewsletter">
                            <div class="newslIcon"><i class="fas fa-file-pdf"></i></div>
                            <div><?= $val['title']?></div>
                        </a>
                    </div>
                    <?php } } else { ?>
                    <div class=""col-lg-12>No data found</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</main>