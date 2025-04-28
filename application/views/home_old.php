<!-- Main content Start -->
<div class="main-content">
    <!-- Slider Section Start -->
    <div class="rs-slider style1">
        <div class="rs-carousel owl-carousel" data-loop="true" data-items="1" data-margin="0" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="1" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="true" data-ipad-device-dots2="false" data-md-device="1" data-md-device-nav="true" data-md-device-dots="false">
            <?php if(!empty($banners)) {
            $i=1;
            foreach ($banners as $key => $banner) {
            if (@$banner->banner_image && file_exists('./uploads/banners/' . @$banner->banner_image)) {
                $bImage = base_url('uploads/banners/' . @$banner->banner_image);
            } else {
                $bImage = base_url('uploads/banners/h2-1.jpg');
            } ?>
            <div class="slider-content slide<?php echo @$i; ?>" style="background-image: url(<?php echo @$bImage; ?>);">
                <div class="container">
                    <div class="sl-sub-title white-color wow bounceInLeft" data-wow-delay="300ms" data-wow-duration="2000ms"><?= $banner->heading ?></div>
                    <h1 class="sl-title white-color wow fadeInRight" data-wow-delay="600ms" data-wow-duration="2000ms"><?= html_entity_decode($banner->sub_heading) ?></h1>
                    <div class="sl-btn wow fadeInUp" data-wow-delay="900ms" data-wow-duration="2000ms">
                        <a class="readon2 banner-style" target="__blank" href="<?php if(@$banner->banner_url) {echo @$banner->banner_url; } else { echo"javascript:void(0);"; } ?>">Discover More</a>
                    </div>
                </div>
            </div>
            <?php $i++; } } ?>
        </div>
    </div>
    <!-- Slider Section End -->

    <div id="rs-features" class="rs-features main-home">
        <div class="container">
            <div class="row">
            <?php if(!empty($home_list->result_array())) {
                foreach ($home_list->result_array() as $row) { ?>
                <div class="col-lg-4 col-md-12 md-mb-30">
                    <div class="features-wrap">
                        <?php if(!empty($row['course_url'])) {
                            $url = $row['course_url'];
                        } else {
                            $url = 'javascript:void(0)';
                        } ?>
                        <a href="<?= $url?>" target="__blank">
                        <div class="row">
                            <div class="col-lg-3 align-items-center d-flex justify-content-center">
                                <div class="icon-part">
                                    <img src="<?= base_url('uploads/homecourse/' . @$row['course_icon']) ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="content-part">
                                    <h4 class="title truncate">
                                        <span class="watermark">
                                        <?php if (@$row['heading']) {
                                            echo @$row['heading'];
                                        } else {
                                            echo "&#8212;";
                                        } ?>
                                        </span>
                                    </h4>
                                    <p class="dese">
                                        <?php if(@$row['sub_heading']) { echo strip_tags(@$row['sub_heading']); } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            <?php } } ?>
            </div>
        </div>
    </div>

    <div id="rs-services" class="rs-popular-courses style3 pt-50 pb-100 md-pt-70 md-pb-70">
        <div class="container">
            <div class="sec-title4 text-center mb-50">
                <h2 class="title title2">
                    <span>Popular Courses</span>
                </h2>
            </div>
            <div class="row">
            <?php 
            if(!empty($list)) {
                foreach ($list as $key => $value) {
                    if (@$value->image && file_exists('./assets/images/courses/' . @$value->image)) {
                        $image = base_url('assets/images/courses/' . @$value->image);
                    } else {
                        $image = base_url('./images/noimage.jpg');
                    }
                    // Get Average Rating.
                    $getAverageRatingSql = "SELECT ROUND(AVG(rating),1) as averageRating FROM `course_reviews` where `course_id` = '" . @$value->id . "'";
                    $ratingRow = $this->db->query($getAverageRatingSql)->row();
                    $averageRating = @$ratingRow->averageRating;
                    $rating = @$ratingRow->averageRating;
                    // Total user enroll
                    $totalEnrolledSql = "SELECT * FROM `course_enrollment` WHERE `course_id` = '" . @$value->id . "' AND `payment_status` = 'COMPLETED'";
                    $totalEnrolledUsr = $this->db->query($totalEnrolledSql)->num_rows();
            ?>
            <div class="col-lg-4 col-md-6 col-sm-6 mb-40">
                <div class="courses-item">
                    <div class="img-part">
                        <img src="<?php echo @$image; ?>" alt="Course Image...">
                    </div>
                    <div class="content-part">
                        <h3 class="title truncate2 m-0"><a href="<?=base_url('course-detail/'.@$value->id)?>"><?php if(@$value->title) { echo strip_tags($value->title); } ?></a></h3>
                        <ul class="meta-part m-0">
                            <li class="user">
                                <img src="<?php echo base_url('user_assets/images/C2C_Home/Tag_Blue.png');?>">
                            </li>
                            <li><span class="price">
                                <?php if(@$value->course_type == 'free') {
                                    echo "Free";
                                } else {
                                    echo '$'.number_format($value->price, 2);
                                }
                                ?></span></li>
                        </ul>
                        <div class="bottom-part">
                            <div class="info-meta">
                                <ul>
                                    <li class="ratings">
                                    <?php
                                    echo "<span class='stars'>";
                                    for ( $i = 1; $i <= 5; $i++ ) {
                                        if ( round( $rating - .25 ) >= $i ) {
                                            echo "<i class='fa fa-star'></i>"; //fas fa-star for v5
                                        } elseif ( round( $rating + .25 ) >= $i ) {
                                            echo "<i class='fa fa-star-half-o'></i>"; //fas fa-star-half-alt for v5
                                        } else {
                                            echo "<i class='fa fa-star-o'></i>"; //far fa-star for v5
                                        }
                                    }
                                    echo '</span>';
                                    ?>
                                    (<?php echo @$averageRating; ?>)
                                    </li>
                                </ul>
                            </div>
                            <div class="btn-part">
                                <a href="<?=base_url('course-detail/'.@$value->id)?>">
                                    <span>
                                        View Details
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } } ?>
            <div class="col-lg-12 col-md-12 col-sm-12 Courses-Btn text-center">
                <a href="<?php echo base_url('course-list') ?>" class="btn btn-info border-0">VIEW ALL</a>
            </div>
            </div>
        </div>
    </div>

    <div class="rs-counter home13-style" style="background-image: url(./user_assets/images/C2C_Home/Count_Banner.png);">
        <div class="container">
            <div class="row couter-area">
                <div class="col-lg-3 col-md-6 md-mb-30">
                    <div class="counter-item text-center">
                        <h2 class="rs-count pr-0">40</h2>
                        <h4 class="title mb-0">MODULES</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 md-mb-30">
                    <div class="counter-item text-center">
                        <h2 class="number rs-count plus">126</h2>
                        <h4 class="title mb-0">HRS OF LEARNING</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 md-mb-30">
                    <div class="counter-item text-center">
                        <h2 class="rs-count plus">450</h2>
                        <h4 class="title mb-0">FAQs</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 md-mb-30">
                    <div class="counter-item text-center">
                        <h2 class="rs-count plus">150</h2>
                        <h4 class="title mb-0">MOCK INTERVIEW FAQS</h4>
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
            <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="true" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="3" data-md-device-nav="false" data-md-device-dots="false" center-mode="false">
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
<!-- Main content End -->