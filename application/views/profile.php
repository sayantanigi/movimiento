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
                            <h2 class="h5 fw-bold text-uppercase">My Profile</h2>
                            <hr>
                            <div class="rbt-profile-row row row--15 mt-3">
                                <div class="col-lg-4 col-md-4">
                                    <div class="fw-bold">Registration Date:</div>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="rbt-profile-content b2">
                                        <?php echo date("F jS, Y H:i", strtotime(@$user->created_at)); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="rbt-profile-row row row--15 mt-3">
                                <div class="col-lg-4 col-md-4">
                                    <div class="fw-bold">Full Name:</div>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="rbt-profile-content b2">
                                        <?php echo @$user->fname; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="rbt-profile-row row row--15 mt-3">
                                <div class="col-lg-4 col-md-4">
                                    <div class="fw-bold">Email:</div>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="rbt-profile-content b2">
                                        <?php echo @$user->email; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="rbt-profile-row row row--15 mt-3">
                                <div class="col-lg-4 col-md-4">
                                    <div class="fw-bold">Phone Number:</div>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="rbt-profile-content b2">
                                        <?php echo @$user->phone; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="rbt-profile-row row row--15 mt-3">
                                <div class="col-lg-4 col-md-4">
                                    <div class="fw-bold">Skill/Occupation:</div>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="rbt-profile-content b2"><?php echo @$user->skills; ?></div>
                                </div>
                            </div>
                            <div class="rbt-profile-row row row--15 mt-3">
                                <div class="col-lg-4 col-md-4">
                                    <div class="fw-bold">Biography:</div>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="rbt-profile-content b2">
                                        <?php echo @$user->user_bio; ?>
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