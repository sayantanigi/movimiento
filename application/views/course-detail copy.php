<?php
    $user_id = $this->session->userdata('user_id');
    $getUserDetails = $this->db->query("SELECT * FROM users where id = '".$user_id."' AND email_verified = '1' AND status = '1'")->row();
    //echo "<pre>"; print_r($getUserDetails); die();
    $isLoggedIn = $this->session->userdata('isLoggedIn');
    $catname = $this->db->query("SELECT * FROM sm_category WHERE id = '".$detail->cat_id."'")->row();
?>
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="<?= base_url()?>assets/img/page-title/page-title-2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                <h3 class="page__title">Courses</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Courses</li>
                    </ol>
                </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pt-15 pb-145">
    <div class="container">
        <div class="row align-items-center mt-50">
            <div class="col-lg-12">
                <div class="section__title-wrapper ">
                    <span class="page__title-pre"><?= $catname->category_name?></span>
                    <h2 class="section__title text-capitalize"><?=@$detail->title?></h2>
                    <nav>
                        <ol class="breadcrumbnav mb-lg-0">
                            <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('course_list')?>">Courses</a></li>
                            <li class="breadcrumb-item active">
                                <a href="<?= base_url('course-detail/'.@$detail->id)?>"><?=@$detail->title?></a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="course__meta-2 d-sm-flex mb-10 mt-20">
                    <?php if(!empty($detail->user_id)) {
                    $user_details = $this->db->query("SELECT id, full_name, image FROM users WHERE id = '".$detail->user_id."' AND email_verified = '1' AND status = '1'")->row();?>
                    <div class="course__teacher-3 d-flex align-items-center mr-70 mb-30">
                        <div class="course__teacher-thumb-3 mr-15">
                            <?php if(!empty($user_details->image)) { ?>
                            <img src="<?= base_url() ?>uploads/users/<?= $user_details->image?>" alt="">
                            <?php } else { ?>
                            <img src="<?= base_url() ?>images/no-user.png" alt="">
                            <?php } ?>
                        </div>
                        <div class="course__teacher-info-3 text-white">
                            <h5>Posted By</h5>
                            <p><a href="javascript:void(0)"><?= $user_details->full_name?></a></p>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="course__teacher-3 d-flex align-items-center mr-70 mb-30">
                        <div class="course__teacher-thumb-3 mr-15">
                            <img src="<?= base_url() ?>assets/img/favicon.png" alt="">
                        </div>
                        <div class="course__teacher-info-3 text-white">
                            <h5>Posted By</h5>
                            <p><a href="javascript:void(0)">Admin</a></p>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="course__update mr-80 mb-30 text-white">
                        <h5>Last Update:</h5>
                        <p><?= date('jS M Y', strtotime(@$detail->created_at))?></p>
                    </div>
                    <div class="course__rating-2 mb-30 ">
                        <h5 class="text-white">Review:</h5>
                        <div class="course__rating-inner d-flex align-items-center productListRate">
                            <?php
                            $rating = $this->db->query("SELECT * FROM course_reviews WHERE course_id = '".$detail->id."'")->result_array();
                            $totalrate = $this->db->query("SELECT SUM(rating) as total FROM course_reviews WHERE course_id = '".$detail->id."'")->row();
                            if(!empty($rating)) {
                                $rate = round($totalrate->total/count($rating), 0);
                                foreach (range(1,5) as $i) {
                                    if($rate > 0) {
                                        echo '<span class="active"><i class="fas fa-star"></i></span>';
                                    } else {
                                        echo '<span><i class="fas fa-star zero"></i></span>';
                                    }  $rate--;
                                }
                                echo "(".round($totalrate->total/count($rating), 0).")";
                            } else {
                                echo '<span><i class="fas fa-star zero"></i></span>';
                                echo '<span><i class="fas fa-star zero"></i></span>';
                                echo '<span><i class="fas fa-star zero"></i></span>';
                                echo '<span><i class="fas fa-star zero"></i></span>';
                                echo '<span><i class="fas fa-star zero"></i></span>';
                                echo "(0)";
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-8 col-xl-8 col-lg-8">
                <div class="course__img w-img mb-30">
                    <?php if (@$detail->image && file_exists('./assets/images/courses/' . @$detail->image)) {
                        $image = base_url('assets/images/courses/' . @$detail->image);
                    } else {
                        $image = base_url('./images/noimage.jpg');
                    }?>
                    <img src="<?php echo @$image; ?>" alt="" style="height: 454px;">
                </div>
                <div class="course__tab-2 mb-45">
                    <ul class="nav nav-tabs" id="courseTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">
                                <i class="icon_ribbon_alt"></i>
                                <span>Description</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="curriculum" aria-selected="false">
                                <i class="icon_book_alt"></i>
                                <span>Curriculum</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">
                                <i class="icon_star_alt"></i>
                                <span>Reviews</span>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="course__tab-content mb-95">
                    <div class="tab-content" id="courseTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel"
                            aria-labelledby="description-tab">
                            <div class="course__description text-white1" style="color: #53545b !important;">
                                <div style="overflow-y: scroll; height: 450px;">
                                    <h3>Description</h3>
                                    <?= $detail->description; ?>
                                    <h3>Program Overview</h3>
                                    <?= $detail->program_overview; ?>
                                    <h3>Objectives</h3>
                                    <?= $detail->objectives; ?>
                                    <h3>Curriculam</h3>
                                    <?= $detail->curriculam; ?>
                                    <h3>Career Paths</h3>
                                    <?= $detail->career_paths; ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                            <div class="course__curriculum">
                                <?php
                                $module = $this->db->query("SELECT * FROM course_modules WHERE course_id = '".$detail->id."'")->result_array();
                                if(!empty($module)) {
                                $i= 1;
                                foreach ($module as $key => $mod) { ?>
                                <div class="accordion" id="course__accordion">
                                    <div class="accordion-item mb-50">
                                        <h2 class="accordion-header" id="week-0<?= $i?>">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#week-0<?= $i?>-content" aria-expanded="true" aria-controls="week-0<?= $i?>-content"> <?= $mod['name']?> </button>
                                        </h2>
                                        <div id="week-0<?= $i?>-content" class="accordion-collapse collapse show"
                                            aria-labelledby="week-01" data-bs-parent="#course__accordion">
                                            <div class="accordion-body">
                                                <?php
                                                $resource = $this->db->query("SELECT COUNT(*) as count FROM course_materials WHERE module = '".$mod['id']."' AND material_type = 'resource'")->row();
                                                if($resource->count > 0) { ?>
                                                <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                    <div class="course__curriculum-info">
                                                        <svg class="document" viewBox="0 0 24 24">
                                                            <path class="st0" d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z" />
                                                            <polyline class="st0" points="14,2 14,8 20,8 " />
                                                            <line class="st0" x1="16" y1="13" x2="8" y2="13" />
                                                            <line class="st0" x1="16" y1="17" x2="8" y2="17" />
                                                            <polyline class="st0" points="10,9 9,9 8,9 " />
                                                        </svg>
                                                        <h3> <span>Resource</span></h3>
                                                    </div>
                                                    <div class="course__curriculum-meta">
                                                        <span class="question">Count <?= $resource->count?></span>
                                                    </div>
                                                </div>
                                                <?php }
                                                $video = $this->db->query("SELECT COUNT(*) as count FROM course_materials WHERE module = '".$mod['id']."' AND material_type = 'video'")->row();
                                                if($video->count > 0) { ?>
                                                <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                    <div class="course__curriculum-info">
                                                        <svg viewBox="0 0 24 24">
                                                            <polygon class="st0" points="23,7 16,12 23,17 " />
                                                            <path class="st0" d="M3,5h11c1.1,0,2,0.9,2,2v10c0,1.1-0.9,2-2,2H3c-1.1,0-2-0.9-2-2V7C1,5.9,1.9,5,3,5z" />
                                                        </svg>
                                                        <h3> <span>Video</span></h3>
                                                    </div>
                                                    <div class="course__curriculum-meta">
                                                        <span class="question">Count <?= $video->count?></span>
                                                    </div>
                                                </div>
                                                <?php }
                                                $quiz = $this->db->query("SELECT COUNT(*) as count FROM course_materials WHERE module = '".$mod['id']."' AND material_type = 'quiz'")->row();
                                                if($quiz->count > 0) {
                                                $quiz_id = $this->db->query("SELECT id FROM course_materials WHERE module = '".$mod['id']."' AND material_type = 'quiz'")->row();
                                                $quiz_count = $this->db->query("SELECT COUNT(*) as quiz_count FROM course_quiz WHERE material_id = '".$quiz_id->id."' AND status = '1'")->row();
                                                ?>
                                                <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                    <div class="course__curriculum-info">
                                                        <svg class="document" viewBox="0 0 24 24">
                                                            <path class="st0" d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z" />
                                                            <polyline class="st0" points="14,2 14,8 20,8 " />
                                                            <line class="st0" x1="16" y1="13" x2="8" y2="13" />
                                                            <line class="st0" x1="16" y1="17" x2="8" y2="17" />
                                                            <polyline class="st0" points="10,9 9,9 8,9 " />
                                                        </svg>
                                                        <h3> <span>Quiz </span></h3>
                                                    </div>
                                                    <div class="course__curriculum-meta">
                                                        <span class="question">Count <?= $quiz_count->quiz_count?></span>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; } } ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                            <div class="course__review">
                                <?php
                                $getAllReviewSql = "SELECT rev.*, usr.full_name from `course_reviews` as rev LEFT JOIN `users` as usr ON usr.id = rev.user_id WHERE `course_id` = '".$detail->id."' ORDER BY `review_date` DESC";
                                $reviewList = $this->db->query($getAllReviewSql)->result();
                                $count = $this->db->query($getAllReviewSql)->num_rows();
                                ?>
                                <h3>Reviews</h3>
                                <div class="course__review-rating mb-50">
                                    <div class="row g-0">
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <div class="course__review-rating-info grey-bg text-center productListRate">
                                                <h5 class="text-dark">
                                                <?php if(@$count > 0 ) {
                                                    echo $rate = round($totalrate->total/count($rating), 0);
                                                } else {
                                                    echo "0";
                                                } ?>
                                                </h5>
                                                <?php if(!empty($rating)) {
                                                $rate = round($totalrate->total/count($rating), 0);
                                                foreach (range(1,5) as $i) {
                                                if($rate > 0) { ?>
                                                <span class="active"><i class="fas fa-star"></i></span>
                                                <?php } else { ?>
                                                <span><i class="fas fa-star"></i></span>
                                                <?php } $rate--; } ?>
                                                <?php } else { ?>
                                                <span><i class="fas fa-star"></i></span>
                                                <span><i class="fas fa-star"></i></span>
                                                <span><i class="fas fa-star"></i></span>
                                                <span><i class="fas fa-star"></i></span>
                                                <span><i class="fas fa-star"></i></span>
                                                <?php }
                                                ?>
                                                <p><?php echo @$count; ?> Ratings</p>
                                            </div>
                                        </div>
                                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8">
                                            <div class="course__review-details grey-bg">
                                                <h5>Detailed Rating</h5>
                                                <div class="course__review-content mb-20">
                                                    <div class="course__review-item d-flex align-items-center justify-content-between">
                                                        <div class="course__review-text">
                                                            <span>5 stars</span>
                                                        </div>
                                                        <?php
                                                        $sumofRating = $this->db->query("SELECT COUNT(rating) as sum FROM course_reviews WHERE course_id = '".$detail->id."' AND rating = '5'")->row();
                                                        $countofadence = $this->db->query("SELECT COUNT(review_id) as total FROM course_reviews WHERE course_id = '".$detail->id."'")->row();
                                                        if(empty($countofadence->total)) {
                                                            $val5 = "0";
                                                        } else {
                                                            $val5 = ($sumofRating->sum/$countofadence->total)*100;
                                                        } ?>
                                                        <div class="course__review-progress">
                                                            <div class="single-progress" data-width="<?php echo $val5 ?>%"></div>
                                                        </div>
                                                        <div class="course__review-percent">
                                                            <h5><?php echo round($val5, 0) ?>%</h5>
                                                        </div>
                                                    </div>
                                                    <div class="course__review-item d-flex align-items-center justify-content-between">
                                                        <div class="course__review-text">
                                                            <span>4 stars</span>
                                                        </div>
                                                        <?php
                                                        $sumofRating = $this->db->query("SELECT COUNT(rating) as sum FROM course_reviews WHERE course_id = '".$detail->id."' AND rating = '4'")->row();
                                                        $countofadence = $this->db->query("SELECT COUNT(review_id) as total FROM course_reviews WHERE course_id = '".$detail->id."'")->row();
                                                        if(empty($countofadence->total)) {
                                                            $val4 = "0";
                                                        } else {
                                                            $val4 = ($sumofRating->sum/$countofadence->total)*100;
                                                        } ?>
                                                        <div class="course__review-progress">
                                                            <div class="single-progress" data-width="<?php echo $val4 ?>%"></div>
                                                        </div>
                                                        <div class="course__review-percent">
                                                            <h5><?php echo round($val4, 0) ?>%</h5>
                                                        </div>
                                                    </div>
                                                    <div class="course__review-item d-flex align-items-center justify-content-between">
                                                        <div class="course__review-text">
                                                            <span>3 stars</span>
                                                        </div>
                                                        <?php
                                                        $sumofRating = $this->db->query("SELECT COUNT(rating) as sum FROM course_reviews WHERE course_id = '".$detail->id."' AND rating = '3'")->row();
                                                        $countofadence = $this->db->query("SELECT COUNT(review_id) as total FROM course_reviews WHERE course_id = '".$detail->id."'")->row();
                                                        if(empty($countofadence->total)) {
                                                            $val3 = "0";
                                                        } else {
                                                            $val3 = ($sumofRating->sum/$countofadence->total)*100;
                                                        } ?>
                                                        <div class="course__review-progress">
                                                            <div class="single-progress" data-width="<?php echo $val3 ?>%"></div>
                                                        </div>
                                                        <div class="course__review-percent">
                                                            <h5><?php echo round($val3, 0) ?>%</h5>
                                                        </div>
                                                    </div>
                                                    <div class="course__review-item d-flex align-items-center justify-content-between">
                                                        <div class="course__review-text">
                                                            <span>2 stars</span>
                                                        </div>
                                                        <?php
                                                        $sumofRating = $this->db->query("SELECT COUNT(rating) as sum FROM course_reviews WHERE course_id = '".$detail->id."' AND rating = '2'")->row();
                                                        $countofadence = $this->db->query("SELECT COUNT(review_id) as total FROM course_reviews WHERE course_id = '".$detail->id."'")->row();
                                                        if(empty($countofadence->total)) {
                                                            $val2 = "0";
                                                        } else {
                                                            $val2 = ($sumofRating->sum/$countofadence->total)*100;
                                                        } ?>
                                                        <div class="course__review-progress">
                                                            <div class="single-progress" data-width="<?php echo $val2 ?>%"></div>
                                                        </div>
                                                        <div class="course__review-percent">
                                                            <h5><?php echo round($val2, 0) ?>%</h5>
                                                        </div>
                                                    </div>
                                                    <div class="course__review-item d-flex align-items-center justify-content-between">
                                                        <div class="course__review-text">
                                                            <span>1 stars</span>
                                                        </div>
                                                        <?php
                                                        $sumofRating = $this->db->query("SELECT COUNT(rating) as sum FROM course_reviews WHERE course_id = '".$detail->id."' AND rating = '1'")->row();
                                                        $countofadence = $this->db->query("SELECT COUNT(review_id) as total FROM course_reviews WHERE course_id = '".$detail->id."'")->row();
                                                        if(empty($countofadence->total)) {
                                                            $val = "0";
                                                        } else {
                                                            $val = ($sumofRating->sum/$countofadence->total)*100;
                                                        } ?>
                                                        <div class="course__review-progress">
                                                            <div class="single-progress" data-width="<?php echo $val ?>%"></div>
                                                        </div>
                                                        <div class="course__review-percent">
                                                            <h5><?php echo round($val, 0) ?>%</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="course__comment mb-75">
                                    <h3><?php echo @$count; ?> Comments</h3>
                                    <?php if(count($reviewList) > 2) { ?>
                                    <ul style="overflow-x: auto; height: 350px;">
                                    <?php } else { ?>
                                    <ul>
                                    <?php } ?>
                                        <?php
                                        if(!empty($reviewList)) {
                                        foreach ($reviewList as $key => $value) {
                                        $rating = $value->rating;
                                        ?>
                                        <li>
                                            <div class="course__comment-box ">
                                                <div class="course__comment-thumb float-start">
                                                <?php if(!empty($value->image)) { ?>
                                                <img src="<?= base_url() ?>uploads/users/<?= $value->image?>" alt="">
                                                <?php } else { ?>
                                                <img src="<?= base_url() ?>images/no-user.png" alt="">
                                                <?php } ?>
                                                </div>
                                                <div class="course__comment-content">
                                                    <div class="course__comment-wrapper ml-70 fix">
                                                        <div class="course__comment-info float-start">
                                                            <h4 class="text-dark"><?php echo $value->full_name; ?></h4>
                                                            <span class="text-dark"><?= date('M j, Y', strtotime(@$value->review_date))?></span>
                                                        </div>
                                                        <div class="course__comment-rating float-start float-sm-end productListRate">
                                                            <?php
                                                            foreach (range(1,5) as $i) {
                                                            if($rating > 0) { ?>
                                                            <span class="active"><i class="fas fa-star"></i></span>
                                                            <?php } else { ?>
                                                            <span><i class="fas fa-star"></i></span>
                                                            <?php } $rating--; } ?>
                                                            <span class="total-rating" style="color: #0e151a;">(<?php echo @$value->rating; ?> <?php if(@$value->rating > 1) {echo "Stars"; } else {echo "Star"; }?>)</span>
                                                        </div>
                                                    </div>
                                                    <div class="course__comment-text ml-70">
                                                        <p><?php echo $value->review_message; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php } } ?>
                                    </ul>
                                </div>
                                <?php if(!empty($isLoggedIn)) { ?>
                                <div class="course__form">
                                    <h3>Write a Review</h3>
                                    <div class="course__form-inner">
                                        <div id="error" class="error invalid-feedback"></div>
                                        <div id="review-txt" class="text-success" style="display: none;"></div>
                                        <form >
                                            <div class="row">
                                                <div class="col-xxl-12 col-lg-12">
                                                    <div class="course__form-input">
                                                        <div class="course__form-input">
                                                            <select name="star_option" id="star_option" class="form-control" style="margin-bottom: 20px">
                                                                <option>Select Stars</option>
                                                                <option value="5">5 Stars</option>
                                                                <option value="4">4 Stars</option>
                                                                <option value="3">3 Stars</option>
                                                                <option value="2">2 Stars</option>
                                                                <option value="1">1 Star</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-12 col-lg-12">
                                                    <div class="course__form-input">
                                                        <textarea class="form-control" name="review_msg" id="review_msg"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xxl-12">
                                                    <div class="course__form-btn mt-10 mb-55">
                                                        <button type="button" class="e-btn" id="reviewButton">Submit Review</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php } ?>
                                <input type="hidden" name="course_id" id="course_id" value="<?php echo @$detail->id; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4">
                <div class="course__sidebar pl-70 p-relative">
                    <div class="course__shape">
                        <img class="course-dot" src="<?php echo base_url()?>assets/img/course/course-dot.png" alt="">
                    </div>
                    <div class="course__sidebar-widget-2 white-bg mb-20">
                        <div class="course__video">
                            <div class="course__video-thumb w-img mb-25">
                                <img src="<?php echo @$image; ?>" alt="" style="height: 156px;">
                            </div>
                            <div class="course__video-meta mb-25 d-flex align-items-center justify-content-between">
                                <div class="course__video-price ">
                                    <?php if($detail->course_fees == "free") { ?>
                                    <h5 class="text-dark">$0.<span>00</span></h5>
                                    <?php } else {
                                    $price = explode('.', $detail->price);
                                    ?>
                                    <h5 class="text-dark">$<?= $price[0]?>.<span><?php if(!empty($price[1])) {echo $price[1]; } else { echo "00";} ?></span> </h5>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="course__video-content mb-35">
                                <ul>
                                    <li class="d-flex align-items-center">
                                        <div class="course__video-icon">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                                <path class="st0" d="M2,6l6-4.7L14,6v7.3c0,0.7-0.6,1.3-1.3,1.3H3.3c-0.7,0-1.3-0.6-1.3-1.3V6z" />
                                                <polyline class="st0" points="6,14.7 6,8 10,8 10,14.7 " />
                                            </svg>
                                        </div>
                                        <div class="course__video-info">
                                            <h5><span>Instructor :</span>
                                            <?php
                                            if(empty($detail->assigned_instrustor)) {
                                                if(empty($detail->user_id)) {
                                                    echo "Not assigned yet";
                                                } else {
                                                    $user_details1 = $this->db->query("SELECT id, full_name FROM users WHERE id = '".$detail->user_id."' AND email_verified = '1' AND status = '1'")->row();
                                                    echo $user_details1->full_name;
                                                }
                                            } else {
                                                $user_details = $this->db->query("SELECT id, full_name FROM users WHERE id = '".$detail->assigned_instrustor."' AND email_verified = '1' AND status = '1'")->row();
                                                echo $user_details->full_name;
                                            }
                                            ?>
                                            </h5>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <div class="course__video-icon">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                                                <path class="st0" d="M4,19.5C4,18.1,5.1,17,6.5,17H20" />
                                                <path class="st0" d="M6.5,2H20v20H6.5C5.1,22,4,20.9,4,19.5v-15C4,3.1,5.1,2,6.5,2z" />
                                            </svg>
                                        </div>
                                        <div class="course__video-info">
                                            <h5>
                                                <span>Lectures :</span>
                                                <?php
                                                $module = $this->db->query("SELECT count(id) as total_module FROM course_modules WHERE course_id = '".$detail->id."'")->row();
                                                if(!empty($module)) {
                                                    $count = $module->total_module;
                                                } else {
                                                    $count = '0';
                                                }
                                                echo $count;
                                                ?>
                                            </h5>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <div class="course__video-icon">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                                <circle class="st0" cx="8" cy="8" r="6.7" />
                                                <polyline class="st0" points="8,4 8,8 10.7,9.3 " />
                                            </svg>
                                        </div>
                                        <div class="course__video-info">
                                            <h5><span>Duration :</span><?= $detail->duration?></h5>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <div class="course__video-icon">
                                            <svg>
                                                <path class="st0" d="M13.3,14v-1.3c0-1.5-1.2-2.7-2.7-2.7H5.3c-1.5,0-2.7,1.2-2.7,2.7V14" />
                                                <circle class="st0" cx="8" cy="4.7" r="2.7" />
                                            </svg>
                                        </div>
                                        <div class="course__video-info">
                                            <?php $getTotalenrld = $this->db->query("SELECT COUNT(enrollment_id) as count FROM course_enrollment WHERE course_id = '".@$detail->id."'")->row();?>
                                            <h5><span>Enrolled :</span>
                                            <?php if($getTotalenrld->count == '0') { ?>
                                                No student enrolled yet.
                                            <?php } else if($getTotalenrld->count == '1') {
                                                echo $getTotalenrld->count." student";
                                            } else {
                                            echo $getTotalenrld->count." students";
                                            } ?>
                                            </h5>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="course__payment mb-35">
                                <h3 class="text-dark">Payment:</h3>
                                <a href="#">
                                    <img src="<?php echo base_url()?>assets/img/course/payment/payment-1.png" alt="">
                                </a>
                            </div>
                            <?php
                            $getSubscriptionPlan = $this->db->query("SELECT * FROM subscription WHERE subscription_user_type = '1' AND status = '1'")->row();
                            ?>
                            <div class="course__enroll-btn">
                                <?php
                                if($this->session->userdata('userType') == '1') {
                                    if(!empty($isLoggedIn)) {
                                        $checksubscriptiontype = $this->db->query("SELECT * FROM users WHERE id = '".@$user_id."'")->row();
                                        if(empty($checksubscriptiontype->subscription_type) || $checksubscriptiontype->subscription_type == '1') {
                                            $checkUserEnrolledSql = "SELECT `courses`.`id`, `course_enrollment`.`enrollment_id`, `course_enrollment`.`course_id`, `course_enrollment`.`user_id`,`course_enrollment`.`payment_status` FROM `course_enrollment` JOIN `courses` ON `courses`.`id` = `course_enrollment`.`course_id` WHERE `courses`.`id` = '" . @$detail->id . "' AND `course_enrollment`.`payment_status` = 'COMPLETED' and `course_enrollment`.`user_id` = '".@$user_id."'";
                                            $checkUserenrollment = $this->db->query($checkUserEnrolledSql)->result_array();
                                            //print_r($checkUserenrollment);
                                            if(@$checkUserenrollment[0]['user_id'] == @$user_id) { ?>
                                                <a href="<?php echo base_url()?>enrolled-courses" class="e-btn e-btn-7 w-100">Go to Dashboard <i class="far fa-arrow-right"></i></a>
                                            <?php } else {
                                                if (@$detail->course_fees != 'free') { ?>
                                                    <form action="<?= base_url('checkout') ?>" method="post" id="form_validation33" enctype="multipart/form-data">
                                                        <div class="btn-part">
                                                            <input type="hidden" id="course_id" name ="course_id" value="<?php echo @$detail->id?>">
                                                            <input type="hidden" id="user_id" name ="user_id" value="<?php echo @$user_id?>">
                                                            <button type="submit" name="enrollment" value="<?php echo @$detail->price_key; ?>" class="e-btn e-btn-7 w-100">Buy Now</button>
                                                        </div>
                                                    </form>
                                                    <div class="ud-text-xs dark-bg-text purchase-section-separator purchase-section-container--separator--G5qKO">or</div>
                                                    <a href="<?= base_url('stripe/'.base64_encode(@$getSubscriptionPlan->price_key))?>" class="e-btn e-btn-7 w-100">Subscribe</a>
                                                    <div class="subscription-cta-module--subtitle--WmzhN dark-bg-text">
                                                        <div>
                                                            <div class="plan-period-module--plan-period-multiline--R2iLQ">
                                                                <span>Starting at <span class="">$<?= $getSubscriptionPlan->subscription_amount; ?></span> per month</span>
                                                            </div>
                                                            <div class="plan-period-module--cancel-anytime-multiline--JbaRs">Cancel anytime</div>
                                                        </div>
                                                    </div>
                                            <?php } else { ?>
                                                <div class="btn-part">
                                                    <input type="hidden" id="course_id" name ="course_id" value="<?php echo @$detail->id?>">
                                                    <input type="hidden" id="user_id" name ="user_id" value="<?php echo @$user_id?>">
                                                    <p name="enrollment" id="course_activation"  class="e-btn e-btn-7 w-100">Activate</p>
                                                </div>
                                            <?php }
                                            }
                                        } else {
                                            $checksubscription = $this->db->query("SELECT * FROM user_subscription WHERE employer_id = '".$this->session->userdata('user_id')."' AND status = '1'")->result_array();
                                            if(!empty($checksubscription)) {
                                                $checkUserEnrolledSql = "SELECT `courses`.`id`, `course_enrollment`.`enrollment_id`, `course_enrollment`.`course_id`, `course_enrollment`.`user_id`,`course_enrollment`.`payment_status` FROM `course_enrollment` JOIN `courses` ON `courses`.`id` = `course_enrollment`.`course_id` WHERE `courses`.`id` = '" . @$detail->id . "' AND `course_enrollment`.`payment_status` = 'COMPLETED' and `course_enrollment`.`user_id` = '".@$user_id."'";
                                                $checkUserenrollment = $this->db->query($checkUserEnrolledSql)->result_array();
                                                //print_r($checkUserenrollment);
                                                if(@$checkUserenrollment[0]['user_id'] == @$user_id) { ?>
                                                    <a href="<?php echo base_url()?>enrolled-courses" class="e-btn e-btn-7 w-100">Go to Dashboard <i class="far fa-arrow-right"></i></a>
                                                <?php } else { ?>
                                                    <div class="btn-part">
                                                        <input type="hidden" id="course_id" name ="course_id" value="<?php echo @$detail->id?>">
                                                        <input type="hidden" id="user_id" name ="user_id" value="<?php echo @$user_id?>">
                                                        <p name="enrollment" id="course_activation"  class="e-btn e-btn-7 w-100">Activate</p>
                                                    </div>
                                                <?php }
                                            } else {
                                                if (@$detail->course_fees != 'free') { ?>
                                                <form action="<?= base_url('checkout') ?>" method="post" id="form_validation33" enctype="multipart/form-data">
                                                    <div class="btn-part">
                                                        <input type="hidden" id="course_id" name ="course_id" value="<?php echo @$detail->id?>">
                                                        <input type="hidden" id="user_id" name ="user_id" value="<?php echo @$user_id?>">
                                                        <button type="submit" name="enrollment" value="<?php echo @$detail->price_key; ?>"  class="e-btn e-btn-7 w-100">Buy Now</button>
                                                    </div>
                                                </form>
                                                <div class="ud-text-xs dark-bg-text purchase-section-separator purchase-section-container--separator--G5qKO">or</div>
                                                <a href="<?= base_url('stripe/'.base64_encode(@$getSubscriptionPlan->price_key))?>" class="e-btn e-btn-7 w-100">Subscribe</a>
                                                <div class="subscription-cta-module--subtitle--WmzhN dark-bg-text">
                                                    <div>
                                                        <div class="plan-period-module--plan-period-multiline--R2iLQ">
                                                            <span>Starting at <span class="">$<?= $getSubscriptionPlan->subscription_amount; ?></span> per month</span>
                                                        </div>
                                                        <div class="plan-period-module--cancel-anytime-multiline--JbaRs">Cancel anytime</div>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="btn-part">
                                                    <input type="hidden" id="course_id" name ="course_id" value="<?php echo @$detail->id?>">
                                                    <input type="hidden" id="user_id" name ="user_id" value="<?php echo @$user_id?>">
                                                    <p name="enrollment" id="course_activation"  class="e-btn e-btn-7 w-100">Activate</p>
                                                </div>
                                            <?php }
                                            }
                                        }
                                    } else {
                                        if (@$detail->course_fees != 'free') { ?>
                                            <form action="<?= base_url('login/') ?>" method="post" id="form_validation33" enctype="multipart/form-data">
                                                <div class="btn-part">
                                                    <button type="submit" name="enrollment" value="<?php echo @$detail->price_key; ?>" class="btn readon2 orange-transparent">$<?php echo number_format(@$detail->price,2); ?></button>
                                                    <button type="submit" name="enrollment" value="<?php echo @$detail->price_key; ?>" class="btn readon2 orange-transparent">Buy Now</button>
                                                </div>
                                            </form>
                                            <div class="ud-text-xs dark-bg-text purchase-section-separator purchase-section-container--separator--G5qKO">or</div>
                                            <a href="<?= base_url('stripe/'.base64_encode(@$getSubscriptionPlan->price_key))?>" class="e-btn e-btn-7 w-100">Subscribe</a>
                                            <div class="subscription-cta-module--subtitle--WmzhN dark-bg-text">
                                            <div>
                                                <div class="plan-period-module--plan-period-multiline--R2iLQ">
                                                    <span>Starting at <span class="">$<?= $getSubscriptionPlan->subscription_amount; ?></span> per month</span>
                                                </div>
                                                <div class="plan-period-module--cancel-anytime-multiline--JbaRs">Cancel anytime</div>
                                            </div>
                                        </div>
                                        <?php } else { ?>
                                            <div class="btn-part">
                                                <button type="submit" name="enrollment" value="<?php echo @$detail->course_type; ?>" class="btn readon2 orange-transparent"><?php echo ucwords(@$detail->course_type); ?></button>
                                                <a href="<?= base_url('login/') ?>" name="enrollment" id="course_activation1" class="btn readon2 orange-transparent">Activate</a>
                                            </div>
                                        <?php }
                                    }
                                } else if(empty($this->session->userdata('userType'))) { ?>
                                    <form action="<?= base_url('checkout') ?>" method="post" id="form_validation33" enctype="multipart/form-data">
                                        <div class="btn-part">
                                            <input type="hidden" id="course_id" name ="course_id" value="<?php echo @$detail->id?>">
                                            <input type="hidden" id="user_id" name ="user_id" value="<?php echo @$user_id?>">
                                            <button type="submit" name="enrollment" value="<?php echo @$detail->price_key; ?>"  class="e-btn e-btn-7 w-100">Buy Now</button>
                                        </div>
                                    </form>
                                    <div class="ud-text-xs dark-bg-text purchase-section-separator purchase-section-container--separator--G5qKO">or</div>
                                    <a href="<?= base_url('stripe/'.base64_encode(@$getSubscriptionPlan->price_key))?>" class="e-btn e-btn-7 w-100">Subscribe</a>
                                    <div class="subscription-cta-module--subtitle--WmzhN dark-bg-text">
                                        <div>
                                            <div class="plan-period-module--plan-period-multiline--R2iLQ">
                                                <span>Starting at <span class="">$<?= $getSubscriptionPlan->subscription_amount; ?></span> per month</span>
                                            </div>
                                            <div class="plan-period-module--cancel-anytime-multiline--JbaRs">Cancel anytime</div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty(@$detail->cat_id)) {
            $getCourse = $this->db->query("SELECT * FROM courses WHERE cat_id = '".$detail->cat_id."' AND id NOT IN ('".$detail->id."')")->result_array();
            if(!empty($getCourse)) { ?>
            <div class="col-lg-12">
                <div class="course__related">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="section__title-wrapper mb-40">
                                <h2 class="section__title">Related Course</h2>
                                <p>You don't have to struggle alone, you've got our assistance and help.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="course__slider swiper-container pb-60">
                                <div class="swiper-wrapper">
                                    <?php
                                    foreach ($getCourse as $key => $value) {
                                        $catname = $this->db->query("SELECT * FROM sm_category WHERE id = '".$value['cat_id']."'")->row();
                                        if (@$value['image'] && file_exists('./assets/images/courses/' . @$value['image'])) {
                                            $image = base_url('assets/images/courses/' . @$value['image']);
                                        } else {
                                            $image = base_url('assets/images/no-image.png');
                                        }
                                    ?>
                                    <div class="course__item course__item-3 swiper-slide white-bg mb-30 fix">
                                        <div class="course__thumb w-img p-relative fix">
                                            <a href="<?=base_url('course-detail/'.@$value['id'])?>">
                                                <img src="<?= $image ?>" alt="">
                                            </a>
                                            <div class="course__tag">
                                                <a href="#"><?= $catname->category_name?></a>
                                            </div>
                                        </div>
                                        <div class="course__content">
                                            <div
                                                class="course__meta d-flex align-items-center justify-content-between">
                                                <div class="course__lesson">
                                                    <?php
                                                    $module = $this->db->query("SELECT count(id) as total_module FROM course_modules WHERE course_id = '".$value['id']."'")->row();
                                                    if(!empty($module)) {
                                                        $count = $module->total_module;
                                                    } else {
                                                        $count = '0';
                                                    }
                                                    ?>
                                                    <span><i class="far fa-book-alt"></i><?= $count;?> Lesson</span>
                                                </div>
                                                <div class="course__rating">
                                                <?php
                                                $rating = $this->db->query("SELECT * FROM course_reviews WHERE course_id = '".$value['id']."'")->result_array();
                                                $totalrate = $this->db->query("SELECT SUM(rating) as total FROM course_reviews WHERE course_id = '".$value['id']."'")->row();
                                                if(!empty($rating)) {
                                                    $rate = round($totalrate->total/count($rating), 0);
                                                    foreach (range(1,5) as $i) {
                                                        if($rate > 0) {
                                                            echo '<span class="active"><i class="fas fa-star"></i></span>';
                                                        } else {
                                                            echo '<span><i class="fas fa-star zero"></i></span>';
                                                        }  $rate--;
                                                    }
                                                    echo "(".round($totalrate->total/count($rating), 0).")";
                                                } else {
                                                    echo '<span><i class="fas fa-star zero"></i></span>';
                                                    echo '<span><i class="fas fa-star zero"></i></span>';
                                                    echo '<span><i class="fas fa-star zero"></i></span>';
                                                    echo '<span><i class="fas fa-star zero"></i></span>';
                                                    echo '<span><i class="fas fa-star zero"></i></span>';
                                                    echo "(0)";
                                                } ?>
                                                </div>
                                            </div>
                                            <h3 class="course__title" style="font-size: 18px">
                                                <a href="<?=base_url('course-detail/'.@$value['id'])?>"><?php if(@$value['title']) { echo strip_tags($value['title']); } ?></a>
                                            </h3>
                                            <?php if(!empty($value['user_id'])) {
                                            $user_details = $this->db->query("SELECT id, full_name, image FROM users WHERE id = '".$value['user_id']."' AND email_verified = '1' AND status = '1'")->row();?>
                                            <div class="course__teacher d-flex align-items-center">
                                                <div class="course__teacher-thumb mr-15">
                                                    <?php if(!empty($user_details->image)) { ?>
                                                    <img src="<?= base_url() ?>uploads/users/<?= $user_details->image?>" alt="">
                                                    <?php } else { ?>
                                                    <img src="<?= base_url() ?>images/no-user.png" alt="">
                                                    <?php } ?>
                                                </div>
                                                <h6><a href="javascript:void(0)"><?= $user_details->full_name?></a></h6>
                                            </div>
                                            <?php } else { ?>
                                            <div class="course__teacher d-flex align-items-center">
                                                <div class="course__teacher-thumb mr-15">
                                                    <img src="<?= base_url() ?>assets/img/favicon.png" alt="">
                                                </div>
                                                <h6><a href="javascript:void(0)">Admin</a></h6>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="course__more d-flex justify-content-between align-items-center">
                                            <div class="course__btn">
                                                <a href="<?= base_url('course-detail/'.@$value['id'])?>" class="link-btn">
                                                    Know Details
                                                    <i class="far fa-arrow-right"></i>
                                                    <i class="far fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    </div>
</section>
<style>
.blockUI h1 {font-size: 30px;font-weight: 600;color: #fff;margin: 0;}
.course__teacher-info-3 p a {color: #0e1133 !important;}
.productListRate span {font-size: 15px !important; color: #ddd;}
.productListRate .active {color: #ff9415 !important;}
.zero {color: #ddd !important;}
.course__description * {color: #53545b !important;}
.course__description ::-webkit-scrollbar {width: 6px;}
.course__description ::-webkit-scrollbar-track {box-shadow: inset 0 0 5px grey; border-radius: 10px;}
.course__description ::-webkit-scrollbar-thumb {background: #db3636; border-radius: 10px;}
.course__description ::-webkit-scrollbar-thumb:hover {background: #b30000;}
.course__comment ::-webkit-scrollbar {width: 6px;}
.course__comment ::-webkit-scrollbar-track {box-shadow: inset 0 0 5px grey; border-radius: 10px;}
.course__comment ::-webkit-scrollbar-thumb {background: #db3636; border-radius: 10px;}
.course__comment ::-webkit-scrollbar-thumb:hover {background: #b30000;}
.purchase-section-container--separator--G5qKO:not(:empty)::before {margin-right: 0.8rem;}
.purchase-section-container--separator--G5qKO::before, .purchase-section-container--separator--G5qKO::after {content: ''; flex: 1; border-bottom: 1px solid #d1d2e0;}
.purchase-section-container--separator--G5qKO {display: flex; align-items: center; text-align: center; color: #595c73; margin: 10px 0 10px 0;}
.purchase-section-container--separator--G5qKO:not(:empty)::after {margin-left: 0.8rem;}
.purchase-section-container--separator--G5qKO::before, .purchase-section-container--separator--G5qKO::after {content: ''; flex: 1; border-bottom: 1px solid #d1d2e0;}
.subscription-cta-module--subtitle--WmzhN {
    font-size: 12px;
    color: #595c73;
    margin-top: 10px;
    text-align: center;
}
.plan-period-module--plan-period-multiline--R2iLQ {
    margin-bottom: 0;
}
.plan-period-module--cancel-anytime-multiline--JbaRs {
    margin-bottom: 0;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
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
$(document).ready(function(){
    $('#reviewButton').click(function() {
        var course_id = $('#course_id').val();
        var message = $('#review_msg').val().trim();
        //var ratingValue = $("input[name='rating']:checked").val();
        var ratingValue = $('#star_option').val();
        if (typeof ratingValue == 'undefined' && message == "") {
            $('#error').show();
            $('#error').text("Rating/Message is not empty!");
        } else if (course_id != '') {
            var baseUrl = "<?= base_url(); ?>";
            $.ajax({
                url: baseUrl + 'home/reviewSave',
                type: 'POST',
                data: {
                    course_id: course_id,
                    rating: ratingValue,
                    message: message
                },
                beforeSend: function() {
                    $('#error').hide();
                    $("#review-txt").hide();
                    $("#review-txt").text("");
                    $("#star_option").val("");
                    setTimeout($.unblockUI, 2000);
                },
                success: function(revdata) {
                    if (revdata == "0") {
                        $('#error').show();
                        $('#error').text("Sorry! Not allowed to posting again!");
                    } else {
                        $("#review-txt").show();
                        $("#review-txt").text("Your review is posted successfully!");
                        $('#review_msg').val("");
                        $("#star_option").val("");
                        $('#rvCtn').text(revdata);
                        location.reload();
                    }
                }
            });
        }
    });

    var url = window.location.href;
    var splitURL=url.toString().split("/");
    var splitURL = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    var txn = splitURL[1].split('=');
    var txnR = txn[1];
    var course_id = "<?= $detail->id?>";
    var user_id = "<?= $this->session->userdata('user_id')?>";
    var price = "<?= $detail->price?>";
    if(window.location.href.indexOf("status=success") > -1) {
        var baseUrl = "<?= base_url(); ?>";
        $.ajax({
            url: baseUrl + 'Home/purchaseMCourse',
            type: 'POST',
            data: {txnR: txnR, course_id: course_id, user_id: user_id, price: price},
            success: function(data) {
                if(data == 1) {
                    window.location.href = "<?= base_url()?>enrolled-courses";
                }
            }
        });
    }
})
</script>