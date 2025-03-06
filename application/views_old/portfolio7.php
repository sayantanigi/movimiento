<main>
        <section class="signup__area po-rel-z1 pt-100 pb-145">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12 col-lg-12 mt-50 text-center mb-50">
                        <div class="section__title-wrapper ">
                            <h2 class="section__title">portfolio makutano7</h2>
                            <nav>
                                <ol class="breadcrumbnav mb-lg-0">
                                <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Portfolio Makutano7</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row g-2">
                    <?php if(!empty($portfolio7)) { 
                    foreach ($portfolio7 as $value) { ?>
                    <div class="col-lg-4 col-6">
                        <a href="<?= base_url()?>uploads/portfolio/<?php echo $value['image']?>" data-fancybox="group" class="galleryBox">
                            <img src="<?= base_url()?>uploads/portfolio/<?php echo $value['image'] ?>" />
                        </a>
                    </div>
                    <?php } } else { ?>
                    <div class="col-lg-4 col-6">No data found</div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </main>