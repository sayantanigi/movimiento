<?php
    $user_id = $this->session->userdata('user_id');
?>
<div class="main-content">
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url() ?>user_assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title">Dashboard</h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url('student-dashboard') ?>">Home</a>
                </li>
                <li>Dashboard</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumbs End -->

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
                                <h3>Dashboard</h3>

                                <?php
                                    if ($this->session->flashdata('success')) {
                                ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <?php echo $this->session->flashdata('success'); ?>
                                    </div>
                                <?php $this->session->unset_userdata('success'); }
                                    if ($this->session->flashdata('error')) {
                                ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <?php echo $this->session->flashdata('error'); ?>
                                    </div>
                                <?php $this->session->unset_userdata('error'); }
                                    $err = validation_errors();
                                    if ($err) {
                                ?>
                                    <div class="alert alert-warning alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <?php echo $err; ?>
                                    </div>
                                <?php } ?>
                                <div class="row gy-2 gy-sm-6">
                                    <div class="col-md-4 col-sm-6">
                                        <!-- Dashboard Info Card Start -->
                                        <div class="dashboard-info__card">
                                            <a class="dashboard-info__card-box" href="<?= base_url('enrolled-courses') ?>">
                                                <div class="dashboard-info__card-icon icon-color-01">
                                                    <i class="fa fa-book"></i>
                                                </div>
                                                <div class="dashboard-info__card-content">
                                                    <div class="dashboard-info__card-value"><?php echo @$ctn_enrolment; ?></div>
                                                    <div class="dashboard-info__card-heading">Enrolled Courses</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="dashboard-info__card">
                                            <a class="dashboard-info__card-box" href="<?= base_url('enrolled-courses') ?>">
                                                <div class="dashboard-info__card-icon icon-color-02">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </div>
                                                <div class="dashboard-info__card-content">
                                                    <div class="dashboard-info__card-value">
                                                        <?php 
                                                            $completedCourse = 0;
                                                            $courseArray = array();

                                                            if(!empty($enrolments)) {
                                                                foreach ($enrolments as $key => $value) {
                                                                    $totalModuleSql = "SELECT * FROM `course_modules` WHERE `course_id` = '" . @$value->course_id . "'";
                                                                    $totalmodule = $this->db->query($totalModuleSql)->num_rows();
                                                                    $moduleData = $this->db->query($totalModuleSql)->result();
                                                                    $moduleArray = array();

                                                                    if(!empty($moduleData)) {
                                                                        foreach ($moduleData as $keyn => $item) {
                                                                            
                                                                            $totalMaterialSql = "SELECT * FROM `course_materials` WHERE `course_id` = '" . @$value->course_id . "' AND `module` = '" . @$item->id . "'";
                                                                            $totalmaterial = $this->db->query($totalMaterialSql)->num_rows();

                                                                            $getAttemptModuleSql = "SELECT 
                                                                                    COUNT(*) as attemptModule
                                                                                FROM
                                                                                    `course_enrollment_status`
                                                                                where `course_id` = '" . @$value->course_id . "' and `module` = '".$item->id."' and `enrollment_id` = '".@$value->enrollment_id."'";
                                                                            $attemptModuleRow = $this->db->query($getAttemptModuleSql)->row();

                                                                            $totalComModule = 0;

                                                                            if(@$totalmaterial==@$attemptModuleRow->attemptModule && @$totalmaterial!='0') {
                                                                                $totalComModule++;
                                                                                $moduleArray[] = $item->id;

                                                                            }

                                                                            // echo "<br> Course Id = ".@$value->course_id." Total Module ".$totalmodule." ModuleId = ".$item->id." Material ".$totalmaterial." attempt = ".@$attemptModuleRow->attemptModule." Completed = ".$totalComModule;
                                                                        }
                                                                    }

                                                                    if(@$totalmodule==count($moduleArray)) {
                                                                        $courseArray[] = $value->course_id;

                                                                    }
                                                                }
                                                            }

                                                            $condition = "";

                                                            if(!empty($courseArray)) {
                                                                $courseIds = implode("', '", $courseArray);
                                                                $condition = " AND course_id NOT IN('$courseIds')";
                                                            }

                                                            $getEnrolmentSql = "SELECT COUNT(DISTINCT `enrollment_id`) AS activeCourse FROM `course_enrollment_status` WHERE `user_id` = '" . $user_id . "' $condition";
                                                            $active_data = $this->db->query($getEnrolmentSql)->row();

                                                            $activeCourse = 0;
                                                            if(!empty($active_data)) {
                                                                $activeCourse = $active_data->activeCourse;
                                                            }

                                                            echo @$activeCourse;
                                                        ?>
                                                    </div>
                                                    <div class="dashboard-info__card-heading">Active Courses</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-6">
                                        <div class="dashboard-info__card">
                                            <a class="dashboard-info__card-box" href="<?= base_url('enrolled-courses') ?>">
                                                <div class="dashboard-info__card-icon icon-color-03">
                                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                </div>
                                                <div class="dashboard-info__card-content">
                                                    <div class="dashboard-info__card-value">
                                                        <?php
                                                            echo count($courseArray);
                                                        ?>
                                                    </div>
                                                    <div class="dashboard-info__card-heading">Completed Courses</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>