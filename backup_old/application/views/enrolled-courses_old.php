<div class="main-content">
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url() ?>user_assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title"> Enrolled Courses</h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url('student-dashboard') ?>">Home</a>
                </li>
                <li> Enrolled Courses</li>
            </ul>
        </div>
    </div>
</div>

<section class="intro-section py-5 loaded">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-3">
                <div class="sidebar shadow-sm">
                    <?php include("usr-menu.php"); ?>
                </div>
            </div>
            <div class="col-lg-9">
                <div>
                    <div>
                        <div class="d-flex justify-content-between">
                            <h3> Enrolled Courses</h3>
                            <!-- <div><a href="javascript:void(0);" class="btn btn-primary rounded-pill">
                                    <i class="fa fa-pencil"></i> Add New Course</a>
                            </div> -->
                        </div>
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
                        <div class="dashboard-course-item mb-3">
                            <a class="dashboard-course-item__link" href="<?=base_url('users/courseModule/'.@$value->enrollment_id);?>">
                                <div class="dashboard-course-item__thumbnail">
                                    <img src="<?php echo @$image; ?>" alt="Courses">
                                </div>
                                <div class="dashboard-course-item__content">
                                    <div class="courserate">
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
                                    </div>
                                    <div class="dashboard-course-item__rating">
                                        <div class="rating-star">
                                            <div class="rating-label" style="width: 80%;"></div>
                                        </div>
                                    </div>
                                    <h3 class="dashboard-course-item__title">
                                    <?php if (@$value->title) {
                                        echo @$value->title;
                                    } else {
                                        echo "&#8212;";
                                    } ?> 
                                    </h3>
                                    <div class="dashboard-course-item__meta">
                                        <ul class="dashboard-course-item__meta-list">
                                            <li>
                                                <span class="meta-label">Total Module:</span>
                                                <span class="meta-value"><?php echo @$totalmodule; ?></span>
                                            </li>
                                            <li>
                                                <span class="meta-label">Completed Module:</span>
                                                <span class="meta-value"><?php echo @count($moduleArray); ?>/<?php echo @$totalmodule; ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dashboard-course-item__progress-bar-wrap">
                                        <div class="row align-items-center">
                                            <div class="col-lg-8">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$score; ?>%"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="dashboard-course-item__progress-bar-text "><?php echo @$score; ?>% Complete</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php } } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .stars {
        color: #ff7501;
        font-size: 1.2em;
    }
    .courserate span i {
        color: coral;
    }
</style>