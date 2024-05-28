<main>
    <section class="pt-200 pb-120 instbanner" style="background-image: url(<?= base_url()?>assets/img/makutano-institute-header.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="p-5 bg-white">
                        <h6 class="text-danger h5 fw-bold">FOUNDATION</h6>
                        <h1>VALUES IN ACTION.</h1>
                        <p>Launched in 2018, the Makutano Foundation provides technical and financial support to high-value projects. Recipients are rigorously selected by a committee assembled for this singular goal.</p>
                        <p>The Makutano Foundation is particularly interested in matters relating to education and female leadership. To this end, the foundation has been involved in constructing a science and technology laboratory at the Kivu International School in Goma, while also focusing on awarding scientific scholarships to women, in partnership with Investing in People ASBL.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="po-rel-z1 pt-50 pb-50">
        <div class="container">
            <h3 class="mb-50">NEWS FROM THE FOUNDATION</h3>
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
<style>
.pt-200 {
    padding-top: 250px !important;
}
</style>