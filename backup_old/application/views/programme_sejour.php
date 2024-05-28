<main>
    <section class="signup__area po-rel-z1 pt-100 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 mt-50">
                    <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">PROGRAMME SÉJOUR #MAKUTANO9 </h2>
                        <nav>
                            <ol class="breadcrumbnav mb-lg-0">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Programme Séjour</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="po-rel-z1 pb-50">
        <div class="container">
            <div class="bg-white text-dark mb-4">
                <?php if(!empty($programme_sejour)) { 
                foreach ($programme_sejour as $value) { ?>
                <div>
                    <div class="d-lg-flex justify-content-between bg-success align-items-center py-2 px-3">
                        <div><h3 class="text-white my-1 h5 fw-bold"><?= $value['title']?></h3></div>
                        <?php if(!empty($value['dress_code'])) { ?>
                        <div><h4 class="mb-0"><span class="badge bg-warning text-dark">Dress code : <?= $value['dress_code']?></span></h4></div>
                        <?php } else { ?>
                        <div><h4 class="mb-0"><span class="badge bg-warning text-dark"></span></h4></div>
                        <?php } ?>
                    </div>
                    <div class="p-3">
                        <div class="mb-1">
                            <?= $value['description']?>
                        </div>
                    </div>
                </div>
                <?php } } ?>
            </div>
            <!-- <div class="text-center">
                <a href="#" class="e-btn">Télécharger le programme SÉJOUR</a>
            </div> -->
        </div>
    </section>
</main>