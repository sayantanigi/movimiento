<main>
    <section class="signup__area po-rel-z1 pt-50 pb-50 conferencebg mt-100">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 mt-50">
                    <div class="section__title-wrapper text-center pb-20 mb-30">
                        <h2 class="section__title">LA GMAK, NEWSLETTER MAKUTANO</h2>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="po-rel-z1 pt-50 pb-50 text-white">
        <div class="container">
            <div class="mb-40">
                <h3 class="text-uppercase fw-bold mb-4">LA BUSINESS NEWSLETTER DU MAKUTANO : NOUVEL OUTIL D’INFORMATION BUSINESS DU RÉSEAU EST ENFIN LÀ !</h3>
                <p>La <strong> Gmak newsletter Makutano</strong> compilation hebdomadaire de l’information <strong>business nationale, continentale et internationale </strong> est disponible. Ce bulletin d’infos business qui recense autant les changements de direction que les grands contrats ou les projets d’investissement est le dernier service offert par <strong>le réseau Makutano.</strong></p>
            </div>
            <div>
                <h3 class="text-uppercase fw-bold mb-4">NOS DERNIÈRES NEWSLETTERS</h3>
                <div class="row g-2">
                    <?php if(!empty($newsletter)) { 
                    foreach ($newsletter as $val) { ?>
                    <div class="col-lg-6">
                        <a href="<?= base_url()?>uploads/newsletter/<?= $val['image']?>" class="d-flex blocknewsletter">
                            <div class="newslIcon"><i class="fas fa-file-pdf"></i></div>
                            <div><?= $val['title']?></div>
                        </a>
                    </div>
                    <?php } } else { ?>
                    <div class=""col-lg-12>No data found</div>
                    <?php } ?>
                </div>
                <div class="text-center mt-30">
                    <a href="https://api.whatsapp.com/message/IPGZEJUIQRX5G1" class="e-btn mx-1 bg-success">Whatsapp <i class="fab fa-whatsapp"></i></a>
                    <a href="https://makutano.ck.page" class="e-btn mx-1">Lien d’inscription <i class="far fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>
</main>