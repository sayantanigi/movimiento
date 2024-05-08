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
                            <h2 class="h5 fw-bold text-uppercase">Upcoming Event</h2>
                                <hr>
                                <div class="row g-3">
                                    <?php 
                                    if(!empty($event)) { 
                                    foreach ($event as $data) { 
                                    $now_date = strtotime(date("Y-m-d"));
                                    $event_date = date("Y-m-d", strtotime($data->event_dt));
                                    $eventDate = strtotime($event_date);
                                    if($eventDate >= $now_date) { ?>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                        <div class="course__item white-bg mb-30 fix">
                                            <div class="course__thumb w-img p-relative fix">
                                                <a href="<?= base_url()?>event/<?= $data->event_slug ?>">
                                                    <?php if(!empty($data->event_img)) { ?>
                                                    <img src="<?= base_url()?>uploads/event/<?= $data->event_img?>" alt="" style="height:197px;">
                                                    <?php } else{ ?>
                                                    <img src="<?= base_url()?>images/no_image.png" alt="" />
                                                    <?php } ?>
                                                </a>
                                            </div>
                                            <div class="course__content p-3">
                                                <h3 class="course__title"><a href="<?= base_url()?>event/<?= $data->event_slug ?>"><?= $data->event_name ?></a></h3>
                                                <?php if(!empty($value->user_id)) { 
                                                $user_details = $this->db->query("SELECT id, fname, image FROM users WHERE id = '".$data->user_id."' AND email_verified = '1' AND status = '1'")->row();?>
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
                                                    <a href="<?= base_url()?>event/<?= $data->event_slug ?>" class="link-btn text-white">
                                                    More Details
                                                    <i class="far fa-arrow-right"></i>
                                                    <i class="far fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="col-xxl-12" style=" width: 100%; text-align: center; margin-bottom: 30px; ">No data found</div>
                                    <?php } } } ?>
                                </div>
                                <h2 class="h5 fw-bold text-uppercase">Completed Event</h2>
                                <hr>
                                <div class="row g-3">
                                    <?php 
                                    //echo "<pre>"; print_r($event); die(); 
                                    if(!empty($event)) { 
                                    foreach ($event as $data) { 
                                    $now_date = strtotime(date("Y-m-d"));
                                    $event_date = date("Y-m-d", strtotime($data->event_dt));
                                    $eventDate = strtotime($event_date);
                                    if($eventDate <= $now_date) { ?>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                        <div class="course__item white-bg mb-30 fix">
                                            <div class="course__thumb w-img p-relative fix">
                                                <a href="<?= base_url()?>event/<?= $data->event_slug ?>">
                                                    <?php if(!empty($data->event_img)) { ?>
                                                    <img src="<?= base_url()?>uploads/event/<?= $data->event_img?>" alt="" style="height:197px;">
                                                    <?php } else{ ?>
                                                    <img src="<?= base_url()?>images/no_image.png" alt="" />
                                                    <?php } ?>
                                                </a>
                                            </div>
                                            <div class="course__content p-3">
                                                <h3 class="course__title"><a href="<?= base_url()?>event/<?= $data->event_slug ?>"><?= $data->event_name ?></a></h3>
                                                <?php if(!empty($value->user_id)) { 
                                                $user_details = $this->db->query("SELECT id, fname, image FROM users WHERE id = '".$data->user_id."' AND email_verified = '1' AND status = '1'")->row();?>
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
                                                    <a href="<?= base_url()?>event/<?= $data->event_slug ?>" class="link-btn text-white">
                                                    More Details
                                                    <i class="far fa-arrow-right"></i>
                                                    <i class="far fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="col-xxl-12" style=" width: 100%; text-align: center; margin-bottom: 30px; ">No data found</div>
                                    <?php } } } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>