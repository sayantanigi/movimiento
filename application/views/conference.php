<main>
    <section class="signup__area po-rel-z1 pt-50 pb-50 conferencebg mt-100">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 mt-50">
                    <div class="section__title-wrapper text-center pb-20 mb-30">
                        <p class="text-danger text-uppercase fw-bold pt-1">Institute</p>
                        <h2 class="section__title">LES CONFÉRENCES DE L'INSTITUT MAKUTANO.</h2>
                        <nav>
                            <ol class="breadcrumbnav mb-lg-0">
                                <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url()?>institute">Institute</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= $title?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="po-rel-z1 pt-50 pb-50">
        <div class="container">
            <h3 class="mb-50">LES CONFÉRENCES DE L'INSTITUT MAKUTANO.</h3>
            <div class="row g-4">
                <?php if(!empty($conferences)) { 
                foreach ($conferences as $value) { ?>
                <div class="col-lg-4 col-md-6">
                    <div class="blog__wrapper">
                        <div class="blog__item white-bg mb-30 transition-3 fix">
                            <div class="blog__thumb w-img fix">
                                <a href="<?= base_url()?>conference/<?= $value['slug']?>">
                                    <img src="<?= base_url()?>uploads/conference/<?= $value['image']?>" style="height: 215px;">
                                </a>
                            </div>
                            <div class="blog__content">
                                <h3 class="blog__title mb-3"><a href="<?= base_url()?>conference/<?= $value['slug']?>" class="text-primary"><?= $value['title']?></a></h3>
                                <p class="text-danger fw-bold"><?= date('j M Y', strtotime($value['date']))?></p>
                                <p>
                                    <?php
                                    $string = strip_tags($value['description']);
                                    if (strlen($string) > 500) {
                                        // truncate string
                                        $stringCut = substr($string, 0, 250);
                                        $endPoint = strrpos($stringCut, ' ');
                                        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string .= '';
                                    }
                                    echo $string;
                                    ?>
                                </p>
                                <div class="course__btn">
                                    <a href="<?= base_url()?>conference/<?= $value['slug']?>" class="link-btn">
                                        Read More
                                        <i class="far fa-arrow-right"></i>
                                        <i class="far fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } } else { ?>
                <p style="text-align:center; color: #fff;">No Conference Yet</p>
                <?php } ?>
            </div>
        </div>
    </section>
</main>