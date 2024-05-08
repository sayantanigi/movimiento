<?php
$user_id = $this->session->userdata('user_id');
$userDetails = $this->Commonmodel->fetch_row('users', array('id' => $user_id));
//print_r($userDetails); die();
$completedCourse = 0;
$courseArray = array();

if (!empty($enrolments)) {
    foreach ($enrolments as $key => $value) {
        $totalModuleSql = "SELECT * FROM `course_modules` WHERE `course_id` = '" . @$value->course_id . "'";
        $totalmodule = $this->db->query($totalModuleSql)->num_rows();
        $moduleData = $this->db->query($totalModuleSql)->result();
        $moduleArray = array();
        if (!empty($moduleData)) {
            foreach ($moduleData as $keyn => $item) {
                $totalMaterialSql = "SELECT * FROM `course_materials` WHERE `course_id` = '" . @$value->course_id . "' AND `module` = '" . @$item->id . "'";
                $totalmaterial = $this->db->query($totalMaterialSql)->num_rows();
                $getAttemptModuleSql = "SELECT COUNT(*) as attemptModule FROM `course_enrollment_status` where `course_id` = '" . @$value->course_id . "' and `module` = '" . $item->id . "' and `enrollment_id` = '" . @$value->enrollment_id . "'";
                $attemptModuleRow = $this->db->query($getAttemptModuleSql)->row();
                $totalComModule = 0;
                if (@$totalmaterial == @$attemptModuleRow->attemptModule && @$totalmaterial != '0') {
                    $totalComModule++;
                    $moduleArray[] = $item->id;
                }
                // echo "<br> Course Id = ".@$value->course_id." Total Module ".$totalmodule." ModuleId = ".$item->id." Material ".$totalmaterial." attempt = ".@$attemptModuleRow->attemptModule." Completed = ".$totalComModule;
            }
        }
        if (@$totalmodule == count($moduleArray)) {
            $courseArray[] = $value->course_id;

        }
    }
}
$condition = "";
if (!empty($courseArray)) {
    $courseIds = implode("', '", $courseArray);
    $condition = " AND course_id NOT IN('$courseIds')";
}
$getEnrolmentSql = "SELECT COUNT(DISTINCT `enrollment_id`) AS activeCourse FROM `course_enrollment_status` WHERE `user_id` = '" . $user_id . "' $condition";
$active_data = $this->db->query($getEnrolmentSql)->row();
$activeCourse = 0;
if (!empty($active_data)) {
    $activeCourse = $active_data->activeCourse;
}
?>
<main>
<section class="pt-100 pb-145">
        <div class="container">
            <div class="rbt-dashboard-content-wrapper">
                <div class="rbt-tutor-information">
                    <div class="rbt-tutor-information-left d-flex align-items-center">
                        <div class="thumbnail rbt-avatars size-lg">
                            <?php if (!empty($userDetails->image)) { ?>
                                <img src="<?= base_url() ?>/uploads/profile_pictures/<?= $userDetails->image ?>" alt="">
                            <?php } else { ?>
                                <img src="images/no-user.png" alt="">
                            <?php } ?>
                        </div>
                        <div class="tutor-content">
                            <h5 class="title h4 fw-bold">
                                <?= $userDetails->fname." ".$userDetails->lname; ?>
                            </h5>
                            <ul class="listRbt mt--5">
                                <li><i class="far fa-book-alt"></i>
                                    <?php echo @$ctn_enrolment; ?> Courses Enroled
                                </li>
                                <li><i class="far fa-file-certificate"></i>
                                    <?php echo count($courseArray); ?> Certificate
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php $this->load->view('leftbar_dash'); ?>
                <div class="col-lg-8">
                    <div class="card bg-dark shadow">
                        <div class="card-body p-4">
                            <h2 class="h5 fw-bold text-uppercase">Enrolled Courses</h2>
                            <hr>
                            <div class="row g-3">
                            <?php 
                                if(!empty($courses)) {
                                    $score = 0;
                                    foreach ($courses as $key => $value) {
                                        if (@$value->image && file_exists('./assets/images/courses/' . @$value->image)) {
                                            $image = base_url('assets/images/courses/' . @$value->image);
                                        } else {
                                            $image = base_url('./images/noimage.jpg');
                                        }
                                        $totalModuleSql = "SELECT * FROM `course_modules` WHERE `course_id` = '" . @$value->course_id . "'";
                                        $totalmodule = $this->db->query($totalModuleSql)->num_rows();
                                        $moduleData = $this->db->query($totalModuleSql)->result();
                                        $moduleArray = array();
                                        if(!empty($moduleData)) {
                                            foreach ($moduleData as $keyn => $item) {
                                                $totalMaterialSql = "SELECT * FROM `course_materials` WHERE `course_id` = '" . @$value->course_id . "' AND `module` = '" . @$item->id . "'";
                                                $totalmaterial = $this->db->query($totalMaterialSql)->num_rows();
                                                $getAttemptModuleSql = "SELECT COUNT(*) as attemptModule FROM `course_enrollment_status` where `course_id` = '" . @$value->course_id . "' and `module` = '".$item->id."' and `enrollment_id` = '".@$value->enrollment_id."'";
                                                $attemptModuleRow = $this->db->query($getAttemptModuleSql)->row();
                                                $totalComModule = 0;
                                                if(@$totalmaterial==@$attemptModuleRow->attemptModule && @$totalmaterial!='0') {
                                                    $totalComModule++;
                                                    $moduleArray[] = $item->id;
                                                }
                                            }
                                        }
                                        // Get total Course completed module.
                                        if(!empty($totalmodule)){
                                            $score = ((count($moduleArray)/$totalmodule)*100);
                                        } else {
                                            $score = 0;
                                        }
                                        // Get Average Rating.
                                        $getAverageRatingSql = "SELECT ROUND(AVG(rating),1) as averageRating FROM `course_reviews` where `course_id` = '" . @$value->course_id . "'";
                                        $ratingRow = $this->db->query($getAverageRatingSql)->row();
                                        $averageRating = @$ratingRow->averageRating;
                                        $rating = @$ratingRow->averageRating;
                                ?>
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="course__item white-bg mb-30 fix">
                                        <div class="course__thumb w-img p-relative fix">
                                            <a href="<?=base_url('users/courseModule/'.@$value->enrollment_id);?>">
                                                <img src="<?php echo @$image; ?>" alt="" style="height: 154px;">
                                            </a>
                                            <div class="course__tag">
                                                <a href="javascript:void(0)">
                                                    <?php 
                                                    $catname = $this->db->query("SELECT * FROM sm_category WHERE id = '".$value->cat_id."'")->row();
                                                    echo $catname->category_name
                                                    ?></a>
                                            </div>
                                        </div>
                                        <div class="course__content p-3">
                                            <div class="course__meta d-flex align-items-center justify-content-between">
                                                <div class="course__lesson">
                                                    <span><i class="far fa-book-alt"></i><?php echo @$totalmodule; ?> Lesson</span>
                                                </div>
                                                <div class="course__rating">
                                                <?php
                                                    echo "<span class='stars'>";
                                                    for ( $i = 1; $i <= 5; $i++ ) {
                                                        if ( round( $rating - .25 ) >= $i ) {
                                                            echo "<i class='icon_star'></i>"; //fas fa-star for v5
                                                        } elseif ( round( $rating + .25 ) >= $i ) {
                                                            echo "<i class='icon_star'></i>"; //fas fa-star-half-alt for v5
                                                        } else {
                                                            echo "<i class='icon_star'></i>"; //far fa-star for v5
                                                        }
                                                    }
                                                    echo '</span>';
                                                ?>
                                                </div>
                                            </div>
                                            <h3 class="course__title" style="font-size: 18px !important; margin-bottom: 5px !important;">
                                                <a href="<?=base_url('users/courseModule/'.@$value->enrollment_id);?>">
                                                <?php if (@$value->title) {
                                                    echo @$value->title;
                                                } else {
                                                    echo "&#8212;";
                                                } ?> 
                                                </a>
                                            </h3>
                                            <?php if(!empty($value->user_id)) { 
                                            $user_details = $this->db->query("SELECT id, fname, image FROM users WHERE id = '".$value->user_id."' AND email_verified = '1' AND status = '1'")->row();?>
                                            <div class="course__teacher d-flex align-items-center">
                                                <div class="course__teacher-thumb mr-15">
                                                    <?php if(!empty($user_details->image)) { ?>
                                                    <img src="<?= base_url() ?>uploads/users/<?= $user_details->image?>" alt="">
                                                    <?php } else { ?>
                                                    <img src="<?= base_url() ?>images/no-user.png" alt="">
                                                    <?php } ?>
                                                </div>
                                                <h6><a href="javascript:void(0)"><?= $user_details->fname?></a></h6>
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
                                        <div class="course__more d-flex justify-content-between align-items-center p-3">
                                            <div class="course__btn btn btn-primary">
                                                <a href="<?=base_url('users/courseModule/'.@$value->enrollment_id);?>" class="link-btn text-white">
                                                    Start Learning
                                                    <i class="far fa-arrow-right"></i>
                                                    <i class="far fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } } else { ?>
                                <div class="dashboard-course-item mb-3" style="text-align: center">No enrolled courses</div>
                                <?php }  ?>
                            </div>
                            <!-- <h2 class="h5 fw-bold text-uppercase">Completed Courses</h2>
                            <hr>
                            <div class="row g-3">
                            <?php 
                                if(!empty($courses)) {
                                    $score = 0;
                                    foreach ($courses as $key => $value) {
                                        if (@$value->image && file_exists('./assets/images/courses/' . @$value->image)) {
                                            $image = base_url('assets/images/courses/' . @$value->image);
                                        } else {
                                            $image = base_url('./images/noimage.jpg');
                                        }
                                        $totalModuleSql = "SELECT * FROM `course_modules` WHERE `course_id` = '" . @$value->course_id . "'";
                                        $totalmodule = $this->db->query($totalModuleSql)->num_rows();
                                        $moduleData = $this->db->query($totalModuleSql)->result();
                                        $moduleArray = array();
                                        if(!empty($moduleData)) {
                                            foreach ($moduleData as $keyn => $item) {
                                                $totalMaterialSql = "SELECT * FROM `course_materials` WHERE `course_id` = '" . @$value->course_id . "' AND `module` = '" . @$item->id . "'";
                                                $totalmaterial = $this->db->query($totalMaterialSql)->num_rows();
                                                $getAttemptModuleSql = "SELECT COUNT(*) as attemptModule FROM `course_enrollment_status` where `course_id` = '" . @$value->course_id . "' and `module` = '".$item->id."' and `enrollment_id` = '".@$value->enrollment_id."'";
                                                $attemptModuleRow = $this->db->query($getAttemptModuleSql)->row();
                                                $totalComModule = 0;
                                                if(@$totalmaterial==@$attemptModuleRow->attemptModule && @$totalmaterial!='0') {
                                                    $totalComModule++;
                                                    $moduleArray[] = $item->id;
                                                }
                                            }
                                        }
                                        // Get total Course completed module.
                                        if(!empty($totalmodule)){
                                            $score = ((count($moduleArray)/$totalmodule)*100);
                                        } else {
                                            $score = 0;
                                        }
                                        // Get Average Rating.
                                        $getAverageRatingSql = "SELECT ROUND(AVG(rating),1) as averageRating FROM `course_reviews` where `course_id` = '" . @$value->course_id . "'";
                                        $ratingRow = $this->db->query($getAverageRatingSql)->row();
                                        $averageRating = @$ratingRow->averageRating;
                                        $rating = @$ratingRow->averageRating;
                                ?>
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="course__item white-bg mb-30 fix">
                                        <div class="course__thumb w-img p-relative fix">
                                            <a href="course-details.html">
                                                <img src="assets/img/course/course-1.jpg" alt="">
                                            </a>
                                            <div class="course__tag">
                                                <a href="#">Art & Design</a>
                                            </div>
                                        </div>
                                        <div class="course__content p-3">
                                            <div class="course__meta d-flex align-items-center justify-content-between">
                                                <div class="course__lesson">
                                                    <span><i class="far fa-book-alt"></i>43 Lesson</span>
                                                </div>
                                                <div class="course__rating">
                                                    <span><i class="icon_star"></i>4.5 (44)</span>
                                                </div>
                                            </div>
                                            <h3 class="course__title"><a href="course-details.html">Become a product
                                                    Manager learn the skills & job.</a></h3>
                                            <div class="course__teacher d-flex align-items-center">
                                                <div class="course__teacher-thumb mr-15">
                                                    <img src="assets/img/course/teacher/teacher-1.jpg" alt="">
                                                </div>
                                                <h6><a href="instructor-details.html">Jim Séchen</a></h6>
                                            </div>
                                        </div>
                                        <div class="course__more d-flex justify-content-between align-items-center p-3">
                                            <div class="course__btn btn btn-primary">
                                                <a href="course-details.html" class="link-btn text-white">
                                                    Download Certificate
                                                    <i class="far fa-arrow-right"></i>
                                                    <i class="far fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } } else { ?>
                                <div class="dashboard-course-item mb-3" style="text-align: center">No completed courses</div>
                                <?php }  ?>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>