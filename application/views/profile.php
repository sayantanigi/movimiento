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
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="assets/img/page-title/page-title-2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                <h3 class="page__title">Student Profile</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url()?>home">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Student Profile</li>
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
                        <h5 class="title h4 fw-bold text-white">
                            <?= ucwords($userDetails->full_name) ?>
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
    </div>
    <div class="container">
        <div class="row">
            <?php $this->load->view('leftbar_dash'); ?>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold text-uppercase">My Profile</h2>
                        <hr>
                        <div class="rbt-profile-row row row--15 mt-3">
                            <div class="col-lg-6">
                                <label class="Heading">Registration Date</label>
                                <div class="rbt-profile-content b2 form-control">
                                    <?php echo date("F jS, Y H:i", strtotime(@$user->created_at)); ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="Heading">Full Name</label>
                                <div class="rbt-profile-content b2 form-control">
                                    <?php echo @$user->full_name; ?>
                                </div>
                            </div>
                            <div class="col-lg-6 DataHead">
                                <label class="Heading">Email</label>
                                <div class="rbt-profile-content b2 form-control">
                                    <?php echo @$user->email; ?>
                                </div>
                            </div>
                            <div class="col-lg-6 DataHead">
                                <label class="Heading">Phone Number</label>
                                <div class="rbt-profile-content b2 form-control">
                                <?php echo @$user->phone; ?>
                                </div>
                            </div>
                            <div class="col-lg-12 DataHead">
                                <label class="Heading">Skill/Occupation</label>
                                <div class="rbt-profile-content b2 form-control">
                                <?php echo @$user->skills; ?>
                                </div>
                            </div>
                            <div class="col-lg-12 DataHead">
                                <label class="Heading">Biography</label>
                                <div class="rbt-profile-content b2 form-control">
                                <?php echo @$user->user_bio; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>