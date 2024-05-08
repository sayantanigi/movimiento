<div class="main-content">
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url() ?>user_assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title"><?php echo $title; ?></h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url() ?>">Home</a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumbs End -->
    <!-- About Section Start -->
    <div id="rs-about" class="rs-about style1 pt-100 pb-10 md-pt-70 md-pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-last padding-0 md-pl-15 md-pr-15 md-mb-30">
                    <div class="img-part">
                        <?php if(!empty($aboutData[0]['image'])) { ?>
                        <img class="" src="<?= base_url() ?>uploads/cms/<?php echo $aboutData[0]['image'];?>" alt="About Image">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-6 pr-70 md-pr-15">
                    <div class="sec-title">
                        <div class="sub-title orange"><?php echo $aboutData[0]['title']?></div>
                        <h2 class="title mb-17"><?php echo $aboutData[0]['title']?></h2>
                        <div class="bold-text mb-22">
                            <div class="desc">
                                <?php echo $aboutData[0]['description'];?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="rs-counter" class="rs-counter style2-about pt-50 pb-80">
            <div class="container">
                <div class="row couter-area">
                    <div class="col-md-4 sm-mb-30">
                        <div class="counter-item text-center">
                            <div class="counter-bg">
                                <img src="<?= base_url() ?>user_assets/images/counter/bg1.png" alt="Counter Image">
                            </div>
                            <div class="counter-text">
                                <h2 class="rs-count kplus">2</h2>
                                <h4 class="title mb-0">Students</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 sm-mb-30">
                        <div class="counter-item text-center">
                            <div class="counter-bg">
                                <img src="<?= base_url() ?>user_assets/images/counter/bg2.png" alt="Counter Image">
                            </div>
                            <div class="counter-text">
                                <h2 class="rs-count plus">1000</h2>
                                <h4 class="title mb-0">Teaching Hours</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="counter-item text-center">
                            <div class="counter-bg">
                                <img src="<?= base_url() ?>user_assets/images/counter/bg3.png" alt="Counter Image">
                            </div>
                            <div class="counter-text">
                                <h2 class="rs-count percent">82</h2>
                                <h4 class="title mb-0">Job Placement</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rs-testimonial home14-style pt-50 pb-80 md-pt-70 md-pb-70">
        <div class="container">
            <div class="sec-title6 text-center mb-50 md-mb-30">
                <h2 class="title title2">
                    <span>Student Reviews</span>
                </h2>
            </div>
            <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="true"
                data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false"
                data-nav="true" data-nav-speed="false" data-center-mode="false" data-mobile-device="1"
                data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="2"
                data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="1"
                data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="3"
                data-md-device-nav="false" data-md-device-dots="false" center-mode="false">
                <?php if(!empty($student_review)) {
                foreach ($student_review as $row) { ?>
                <div class="testi-item">
                    <div class="item-content">
                        <?php if(strlen($row->review_message)>200) {
                            $review_message = substr($row->review_message,0,200).'...';
                        } else {
                            $review_message = $row->review_message;
                        } ?>
                        <p><?php echo $review_message?></p>
                    </div>
                    <div class="image-wrap">
                    <?php if(!empty($row->image)) { ?>
                        <img src="<?= base_url() ?>/uploads/profile_pictures/<?php echo $row->image?>" alt="Image">
                    <?php } else { ?>
                        <img src="<?= base_url() ?>/images/profile-image-2.png" alt="Image">
                    <?php } ?>
                    </div>
                    <div class="testi-content">
                        <div class="testi-name"><?php echo $row->fname.' '.$row->lname?></div>
                    </div>
                    <div class="Box-Bar"></div>
                </div>
                <?php } } ?>
            </div>
        </div>
    </div>
</div>