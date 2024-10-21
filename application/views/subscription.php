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
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center"
    data-background="assets/img/page-title/page-title-2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                    <h3 class="page__title">Subscription</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>home">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Subscription</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pb-145">
    <div class="rbt-dashboard-content-wrapper">
        <div class="container">
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
                        <h5 class="title h4 fw-bold text-white"><?= ucwords($userDetails->full_name) ?></h5>
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
    </div>

    <div class="container">
        <div class="row">
            <?php $this->load->view('leftbar_dash'); ?>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold text-uppercase">Dashboard</h2>
                        <hr>
                        <div class="row g-3">
                            <?php if(!empty($subscription_list)) {
                                foreach ($subscription_list as $subscription) { ?>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="rbt-counterup blue-bg-4">
                                        <div class="inner" style="display: flex; flex-direction: column;">
                                            <div class="rbt-round-icon bg-primary-opacity cstm_class">
                                                <p class="counter without-icon text-white"><?php echo @$subscription['subscription_name']; ?></p>
                                                <div class="counter without-icon text-white"><?php echo @$subscription['subscription_description']; ?></div>
                                                <p class="counter without-icon text-white"><?php echo @$subscription['subscription_duration']; ?></p>
                                                <a href="<?= base_url('stripe/'.base64_encode($subscription['price_key']))?>" class="rbt-title-style-2 d-block">Subscribe</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
.rbt-counterup {height: 350px ;}
.cstm_class {width: 100% !important; display: flex; flex-direction: column;}
.cstm_class p {width: 100% !important; font-size: 18px !important;}
.rbt-title-style-2{line-height: 0;background: #83d893;padding: 20px;width: 100%;}
</style>