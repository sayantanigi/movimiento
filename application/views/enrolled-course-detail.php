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
$data = array(
    'ctn_enrolment' => @$ctn_enrolment,
    'courseArray' => count($courseArray)
);
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
                                <?= $userDetails->fname ?>
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
                            <h2 class="h5 fw-bold text-uppercase">
                            <?php if (@$courses->title) {
                                echo @$courses->title;
                            } else {
                                echo "&#8212;";
                            } ?> 
                            </h2>
                            <hr>
                            <div class="row g-3">
                                <div class="col-lg-12 col-md-12 col-sm-6 col-12">
                                    <div class="rbt-counterup" style="padding: 10px 20px;">
                                        <div class="inner">
                                            <h4 style="text-align: justify; font-size: 18px;"><?=@$courses->heading_1?></h4>
                                            <div class="cstm_crs_cls" style="margin-top: 28px;"><?=@$courses->description?></div>
                                        </div>
                                        <ul class="course-doclist" style="margin-top: 30px !important;">
                                            <?php
                                            //Get The course Module
                                            $getModuleSql = "SELECT * FROM `course_modules` WHERE `course_id` = '" . @$courses->course_id . "' ORDER BY `position_order` ASC";
                                            $module = $this->db->query($getModuleSql)->result();
                                            $moduleArray = array();
                                            if(!empty($module)) {
                                                foreach ($module as $key => $value) {
                                                    $totalMaterialSql = "SELECT * FROM `course_materials` WHERE `course_id` = '" . @$courses->course_id . "' AND `module` = '" . @$value->id . "'";
                                                    $totalmaterial = $this->db->query($totalMaterialSql)->num_rows();
                                                    $getAttemptModuleSql = "SELECT COUNT(*) as attemptModule FROM `course_enrollment_status` where `course_id` = '" . @$courses->course_id . "' and `module` = '".$value->id."' and `enrollment_id` = '".@$courses->enrollment_id."'";
                                                    $attemptModuleRow = $this->db->query($getAttemptModuleSql)->row();
                                                    $totalComModule = 0;
                                                    if(@$totalmaterial==@$attemptModuleRow->attemptModule && @$totalmaterial!='0') {
                                                        $totalComModule++;
                                                        $moduleArray[] = $value->id;
                                                    }
                                                    // echo "<br> Module = ".$value->id." Tot Mat ".$totalmaterial." attempt module = ".@$attemptModuleRow->attemptModule." Completed = ".$totalComModule;
                                            ?>
                                            <li style="background: #015ba4; padding: 10px; margin-bottom: 10px;"> 
                                                <a href="<?=base_url('users/courseMaterial/'.@$courses->enrollment_id."/".@$value->id)?>">
                                                <div class="d-flex justify-content-between align-items-center">
                                                        <div class="flex-fill">
                                                            <?php echo @$value->name; ?>
                                                        </div>
                                                        <span class="downloadModule"><i class="fa fa-arrow-right"></i></span>
                                                        <?php if (in_array(@$value->id, $moduleArray)) { ?>
                                                            <span class="downloadModule mr-3 bg-success"><i class="fa fa-check"></i></span>
                                                        <?php } ?>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php } } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<style>
.cstm_crs_cls *{color: #fff; text-align: justify; font-size: 13px; line-height: 16px;}
.bg-success{padding: 7px 10px 0px 10px;border-radius: 50px; height: 35px; margin-left: 10px;}
</style>