<main>
    <section class="pt-200 pb-120 instbanner" style="background-image: url(<?= base_url()?>assets/img/telechargement.jpeg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="p-5 bg-white">
                        <h6 class="text-danger h5 fw-bold">NETWORK</h6>
                        <h1>LEADERSHIP & SYNERGIE.</h1>
                        <p>The Makutano Club is a business network bringing together over 600 active members from civil society and the public and private sectors. It connects the leaders of the DRC and its neighbours through robust networks and ad hoc meetings, including : breakfast and lunch debates, thematic sectoral conferences and workshops and exclusive dinner events with local, regional and international experts. In addition, The Makutano Club provides exclusive content to members and targeted audiences through webinars, podcasts, white paper, masterclasses to nurture collective economic intelligence.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="po-rel-z1 pt-50 pb-50">
        <div class="container">
            <h3 class="mb-50">LES CONFÉRENCES DE L'INSTITUT MAKUTANO.</h3>
            <div class="row g-4">
                <?php if(!empty($network)) { 
                foreach ($network as $value) { ?>
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