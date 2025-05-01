<section class="innerBanner" style="background-image: url(./assets/images/innerbanner.jpg);">
    <div class="container">
        <h2 class="text-center title">FAQ</h2>
    </div>
</section>
<section class="faqpnl">
    <div class="container">
        <h3 class="text-center mb-5 fw-semibold h2">Frequently Asked Questions</h3>
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <?php if(!empty($faq_list)) {
            $i = 1;
            foreach ($faq_list as $faq) { ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $i?>" aria-expanded="false" aria-controls="flush-collapse<?= $i?>">
                        <?= @$faq->question; ?>
                    </button>
                </h2>
                <div id="flush-collapse<?= $i?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body"><?= @$faq->answer; ?></div>
                </div>
            </div>
            <?php $i++; } } else { ?>
            <div id="flush-collapse" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">No FAQ Available</div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<section class="yelpreview  wow fadeInUp">
    <div class="container">
        <div class="yelpBox">
            <div class="row g-5 justify-content-between align-items-center">
                <div class="col-lg-8">
                    <h2 class="h5 mb-3">Why Take California Driver Ed With Us?</h2>
                    <p>We help teens and families navigate through their first-time driver experience to ensure
                        that it is stress, worry and speedbump free. Our courses can be completed on any mobile
                        device and will automatically save your progress each time you log out. Join thousands
                        of teens who chose First Time Driver for their online driver education and get ready to
                        earn
                        your California Learner’s Permit. Join thousands of teens who chose First Time Driver
                        for
                        their online driver education and get ready to earn your California Learner’s Permit.
                        Find
                        our course now.</p>
                    <div class="mt-3">
                        <a href="#" class="enrollbtn">Course FAQ</a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <img src="assets/images/yelp.png" class="yelplogo" />
                </div>
            </div>
        </div>
    </div>
</section>