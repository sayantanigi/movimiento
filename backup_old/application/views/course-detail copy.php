<?php
    $user_id = $this->session->userdata('user_id');
    $isLoggedIn = $this->session->userdata('isLoggedIn');
?>
<!-- Main content Start -->
<div class="main-content">
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url('assets/images/breadcrumbs/2.jpg') ?>" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title"><?=@$detail->title?></h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url() ?>">Home</a>
                </li>
                <li><?=@$detail->title?></li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumbs End -->
    <section class="intro-section gray-bg pt-94 pb-100 md-pt-64 md-pb-70">
        <div class="container">
            <div class="row clearfix">
                <!-- Content Column -->
                <div class="col-lg-8 md-mb-50">
                    <div class="content white-bg pt-30 mb-3">
                        <div class="course-overview">
                            <div class="inner-box">
                                <h4 class="font-weight-bold"><?=@$detail->heading_1?></h4>
                                <p><?=@$detail->heading_2?></p>
                                <p><?=@$detail->description?></p>
                            </div>
                            <div class="rs-services style2 px-4">
                                <div class="row">
                                    <?php
                                        //Get The course Module
                                        $getModuleSql = "SELECT * FROM `course_modules` WHERE `course_id` = '" . @$detail->id . "' ORDER BY `position_order` ASC";
                                        $module = $this->db->query($getModuleSql)->result();
                                        // $isEmail = $this->db->query($getUserSql)->num_rows();

                                        if(!empty($module)) {
                                            foreach ($module as $key => $value) {
                                                if (@$value->module_image && file_exists('./uploads/modules/' . @$value->module_image)) {
                                                    $moduleImg = base_url('./uploads/modules/' . @$value->module_image);
                                                } else {
                                                    $moduleImg = base_url('assets/images/no-image.png');
                                                }

                                                $totalMaterialSql = "SELECT * FROM `course_materials` WHERE `course_id` = '" . @$detail->id . "' AND `module` = '" . @$value->id . "'";
                                                $totalmaterial = $this->db->query($totalMaterialSql)->num_rows();

                                                $totalVideoMaterialSql = "SELECT * FROM `course_materials` WHERE `course_id` = '" . @$detail->id . "' AND `module` = '" . @$value->id . "' AND `material_type` = 'video'";
                                                $totalvideomaterial = $this->db->query($totalVideoMaterialSql)->num_rows();

                                                $totalQuizSql = "SELECT * FROM `course_materials` WHERE `course_id` = '" . @$detail->id . "' AND `module` = '" . @$value->id . "' AND `material_type` = 'quiz'";
                                                $totalquiz = $this->db->query($totalQuizSql)->num_rows();
                                    ?>
                                    <div class="col-lg-6 md-mb-30 mb-4">
                                        <div class="service-item">
                                            <div class="content-part">
                                                <span class="icon-part"><img src="<?php echo @$moduleImg; ?>" alt="Breadcrumbs Image"></span>
                                                <h4 class="title"><a href="javascript:void(0);"><?php echo @$value->name; ?></a></h4>
                                                <p class="desc"><?php echo @$value->module_descriptions; ?></p>
                                                <ul class="list-subinfo">
                                                    <li><?php echo @$totalmaterial; ?> Material</li>
                                                    <li><?php echo @$totalvideomaterial; ?> Videos</li>
                                                    <li><?php echo @$totalquiz; ?> Quizzes</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="video-column col-lg-4">
                    <div class="inner-column">
                        <!-- Video Box -->
                        <?php
                            if (@$detail->image && file_exists('./assets/images/courses/' . @$detail->image)) {
                                $image = base_url('assets/images/courses/' . @$detail->image);
                            } else {
                                $image = base_url('./images/noimage.jpg');
                            }
                            ?>
                        <div class="intro-video media-icon orange-color2">
                            <img class="video-img" src="<?=$image?>" alt="Video Image">
                        </div>
                        <!-- End Video Box -->
                        <div class="course-features-info">
                            <ul>
                                <?php
                                    $totalCourseQuizSql = "SELECT * FROM `course_materials` WHERE `course_id` = '" . @$detail->id . "' AND `material_type` = 'quiz'";
                                    $totalcoursequiz = $this->db->query($totalCourseQuizSql)->num_rows();
                                    $totalUserEnrolledSql = "SELECT * FROM `course_enrollment` WHERE `course_id` = '" . @$detail->id . "'";
                                    $totalenrollment = $this->db->query($totalUserEnrolledSql)->num_rows();
                                ?>
                                <li class="quizzes-feature">
                                    <i class="fa fa-puzzle-piece"></i>
                                    <span class="label">Quizzes</span>
                                    <span class="value"><?php echo @$totalcoursequiz; ?></span>
                                </li>
                                <li class="duration-feature">
                                    <i class="fa fa-clock-o"></i>
                                    <span class="label">Duration</span>
                                    <span class="value"><?=@$detail->duration?> </span>
                                </li>
                                <li class="students-feature">
                                    <i class="fa fa-users"></i>
                                    <span class="label">Students</span>
                                    <span class="value"><?php echo @$totalenrollment; ?></span>
                                </li>
                            </ul>
                        </div>
                        <?php if(!empty($isLoggedIn)) { 
                            $checkUserEnrolledSql = "SELECT `courses`.`id`, `course_enrollment`.`enrollment_id`, `course_enrollment`.`course_id`, `course_enrollment`.`user_id`,`course_enrollment`.`payment_status` FROM `course_enrollment` JOIN `courses` ON `courses`.`id` = `course_enrollment`.`course_id` WHERE `courses`.`id` = '" . @$detail->id . "' AND `course_enrollment`.`payment_status` = 'COMPLETED' and `course_enrollment`.`user_id` = '".@$user_id."'";
                            $checkUserenrollment = $this->db->query($checkUserEnrolledSql)->result_array();
                            //print_r($checkUserenrollment);
                            if(@$checkUserenrollment[0]['user_id'] == @$user_id) {    
                            ?>
                            <div class="btn-part">
                                <ul class="sidebar-list">
                                    <li class=" active"><a href="<?php echo base_url()?>enrolled-courses"style="text-align: center;">Go to Dashboard</a></li>
                                </ul>
                            </div>
                            <?php } else { 
                            if (@$detail->course_type != 'free') { ?>
                            <form action="<?= base_url('checkout') ?>" method="post" id="form_validation33" enctype="multipart/form-data">
                                <div class="btn-part">
                                    <button type="submit" name="enrollment" value="<?php echo @$detail->price_key; ?>" class="btn readon2 orange-transparent">$<?php echo number_format(@$detail->price,2); ?></button>
                                    <input type="hidden" id="course_id" name ="course_id" value="<?php echo @$detail->id?>">
                                    <input type="hidden" id="user_id" name ="user_id" value="<?php echo @$user_id?>">
                                    <button type="submit" name="enrollment" value="<?php echo @$detail->price_key; ?>" class="btn readon2 orange-transparent">Buy Now</button>
                                </div>
                            </form>
                            <?php } else { ?>
                                <div class="btn-part">
                                    <button type="submit" name="enrollment" value="<?php echo @$detail->course_type; ?>" class="btn readon2 orange-transparent"><?php echo ucwords(@$detail->course_type); ?></button>
                                    <input type="hidden" id="course_id" name ="course_id" value="<?php echo @$detail->id?>">
                                    <input type="hidden" id="user_id" name ="user_id" value="<?php echo @$user_id?>">
                                    <p name="enrollment" id="course_activation" class="btn readon2 orange-transparent">Activate</p>
                                </div>
                            <?php } } } else {
                            if (@$detail->course_type != 'free') { ?>
                                <form action="<?= base_url('login/') ?>" method="post" id="form_validation33" enctype="multipart/form-data">
                                    <div class="btn-part">
                                        <button type="submit" name="enrollment" value="<?php echo @$detail->price_key; ?>" class="btn readon2 orange-transparent">$<?php echo number_format(@$detail->price,2); ?></button>
                                        <button type="submit" name="enrollment" value="<?php echo @$detail->price_key; ?>" class="btn readon2 orange-transparent">Buy Now</button>
                                    </div>
                                </form>
                                <?php } else { ?>
                                    <div class="btn-part">
                                        <button type="submit" name="enrollment" value="<?php echo @$detail->course_type; ?>" class="btn readon2 orange-transparent"><?php echo ucwords(@$detail->course_type); ?></button>
                                        <a href="<?= base_url('login/') ?>" name="enrollment" id="course_activation1" class="btn readon2 orange-transparent">Activate</a>
                                    </div>
                                <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-12">
                    <!-- Intro Info Tabs-->
                    <div class="intro-info-tabs">
                        <ul class="nav nav-tabs intro-tabs tabs-box" id="myTab" role="tablist">
                            <li class="nav-item tab-btns">
                                <a class="nav-link tab-btn active" id="prod-overview-tab" data-toggle="tab" href="#prod-overview" role="tab" aria-controls="prod-overview" aria-selected="true">PROGRAM OVERVIEW</a>
                            </li>
                            <li class="nav-item tab-btns">
                                <a class="nav-link tab-btn" id="prod-objective-tab" data-toggle="tab" href="#prod-objective" role="tab" aria-controls="prod-objective" aria-selected="true">OBJECTIVES</a>
                            </li>
                            <li class="nav-item tab-btns">
                                <a class="nav-link tab-btn" id="prod-curriculm-tab" data-toggle="tab" href="#prod-curriculm" role="tab" aria-controls="prod-curriculm" aria-selected="true">CURRICULAM</a>
                            </li>
                            <li class="nav-item tab-btns">
                                <a class="nav-link tab-btn" id="prod-career-tab" data-toggle="tab" href="#prod-career" role="tab" aria-controls="prod-career" aria-selected="true">CAREER PATHS</a>
                            </li>
                            <li class="nav-item tab-btns">
                                <a class="nav-link tab-btn" id="prod-reviews-tab" data-toggle="tab" href="#prod-reviews" role="tab" aria-controls="prod-reviews" aria-selected="false">REVIEWS</a>
                            </li>
                        </ul>
                        <div class="tab-content tabs-content" id="myTabContent">
                            <div class="tab-pane tab fade show active" id="prod-overview" role="tabpanel" aria-labelledby="prod-overview-tab">
                                <div class="content white-bg pt-30">
                                    <!-- Cource Overview -->
                                    <div class="course-overview">
                                        <div class="inner-box">
                                            <?=@$detail->program_overview?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="prod-objective" role="tabpanel" aria-labelledby="prod-objective-tab">
                                <div class="content white-bg pt-30">
                                    <!-- Cource Overview -->
                                    <div class="course-overview">
                                        <div class="inner-box">
                                            <?=@$detail->objectives?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="prod-curriculm" role="tabpanel" aria-labelledby="prod-curriculm-tab">
                                <div class="content white-bg pt-30">
                                    <!-- Cource Overview -->
                                    <div class="course-overview">
                                        <div class="inner-box">
                                            <?=@$detail->curriculam?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="prod-career" role="tabpanel" aria-labelledby="prod-career-tab">
                                <div class="content white-bg pt-30">
                                    <!-- Cource Overview -->
                                    <div class="course-overview">
                                        <div class="inner-box">
                                            <?=@$detail->career_paths?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="prod-reviews" role="tabpanel" aria-labelledby="prod-reviews-tab">
                                <div class="content pt-30 pb-30 white-bg">
                                    <div class="add-review cource-review-box mb-30">
                                        <?php
                                            $getAllReviewSql = "SELECT rev.*, usr.fname, usr.lname from `course_reviews` as rev
                                            LEFT JOIN `users` as usr ON usr.id = rev.user_id
                                            WHERE `course_id` = '".$course_id."' ORDER BY `review_date` DESC";
                                            $reviewList = $this->db->query($getAllReviewSql)->result();
                                            $count = $this->db->query($getAllReviewSql)->num_rows();
                                        ?>
                                        <h4>Reviews(<span id="rvCtn"><?php echo @$count; ?></span>)</h4>
                                        <?php if(!empty($isLoggedIn)) { ?>
                                            <form>
                                                <div>
                                                    <div id="error" class="error invalid-feedback"></div>
                                                    <div id="review-txt" class="text-success" style="display: none;"></div>
                                                    <label class="fw-bold">Rate</label>
                                                    <fieldset class="rating">
                                                        <input type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                                                        <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                        <input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                                        <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                        <input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label>
                                                        <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                        <input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                                        <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                        <input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                                        <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                        <input type="radio" class="reset-option" name="rating" value="reset" />
                                                    </fieldset>
                                                </div>
                                                <div class="mb-2">
                                                    <label>Message</label>
                                                    <textarea class="form-control" name="review_msg" id="review_msg"></textarea>
                                                </div>
                                                <div>
                                                    <button class="btn btn-primary readon2 " type="button" name="review" id="reviewButton">Submit</button>
                                                </div>
                                            </form>
                                        <?php } ?>
                                    </div>
                                    <hr />
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo @$course_id; ?>">
                                    <div id="reviewHTML">
                                        <?php
                                            if(!empty($reviewList)) {
                                                foreach ($reviewList as $key => $value) {
                                                    $rating = $value->rating;
                                        ?>
                                                <div class="cource-review-box mb-30">
                                                <h4 style="font-size: 18px;"><?php echo $value->fname. " ".$value->lname; ?></h4>
                                                <div class="rating333">
                                                    <span class="total-rating" style="color: #0e151a;"><?php echo @$value->rating; ?></span> 
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

                                                    <!-- <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star-half-o"></span> -->
                                                </div>
                                                <div class="text"><?php echo $value->review_message; ?></div>
                                        </div>
                                        <?php } } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Video Column -->
            </div>
        </div>
    </section>
</div>
<!-- <script src="https://js.stripe.com/v3/"></script> -->
<style>
/* .cource-review-box .rating .fa {
    color: #FFD700;
} */
.stars {color: #ff7501; font-size: 1.2em;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$('#course_activation').click(function() {
    var user_id = $('#user_id').val();
    var course_id = $('#course_id').val();
    var baseUrl = "<?= base_url(); ?>";
    $.ajax({
        url: baseUrl + 'Home/purchaseCourse',
        type: 'POST',
        data: {user_id: user_id, course_id: course_id,},
        success: function(data) {
            if(data == 1) {
                location.reload();
            }
        }
    });
})
</script>