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
function timeAgo($time_ago)  {
    $time_ago =  strtotime($time_ago) ? strtotime($time_ago) : $time_ago;
    $time  = time() - $time_ago;
    switch($time):
        // seconds
        case $time <= 60;
        return 'Just Now';
        // minutes
        case $time >= 60 && $time < 3600;
        return (round($time/60) == 1) ? 'a minute' : round($time/60).' minutes ago';
        // hours
        case $time >= 3600 && $time < 86400;
        return (round($time/3600) == 1) ? 'a hour ago' : round($time/3600).' hours ago';
        // days
        case $time >= 86400 && $time < 604800;
        return (round($time/86400) == 1) ? 'a day ago' : round($time/86400).' days ago';
        // weeks
        case $time >= 604800 && $time < 2600640;
        return (round($time/604800) == 1) ? 'a week ago' : round($time/604800).' weeks ago';
        // months
        case $time >= 2600640 && $time < 31207680;
        return (round($time/2600640) == 1) ? 'a month ago' : round($time/2600640).' months ago';
        // years
        case $time >= 31207680;
        return (round($time/31207680) == 1) ? 'a year ago' : round($time/31207680).' years ago' ;

    endswitch;
}
?>
<style>
    .zero {color: #ddd !important;}
    .active { color: #ff9415 !important;}
</style>
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="assets/img/page-title/page-title-2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                <h3 class="page__title">Reviews</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url()?>home">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reviews</li>
                    </ol>
                </nav>
                </div>
            </div>
        </div>
    </div>
</section>
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
        <div class="row">
            <?php $this->load->view('leftbar_dash'); ?>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold text-uppercase">Reviews</h2>
                        <hr>
                        <div class="table-responsive">
                            <table class="rbt-table table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Feedback</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(!empty($reviews)) {
                                    foreach ($reviews as $key => $value) {
                                        if (@$value->image && file_exists('./assets/images/courses/' . @$value->image)) {
                                            $image = base_url('assets/images/courses/' . @$value->image);
                                        } else {
                                            $image = base_url('./images/noimage.jpg');
                                        }
                                        $rating = $value->rating;
                                    ?>
                                    <tr style="color: #000">
                                        <td style="width: 200px;">
                                            <div class="b3">
                                                <a href="javascript:void(0)">
                                                    <?php
                                                    $getCourse = $this->db->query("SELECT * FROM courses WHERE id = '".$value->course_id."'")->row();
                                                    echo @$getCourse->title; ?>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="b3"><a href="javascript:void(0)"><?php echo @$value->review_message; ?></a></span>
                                            <div class="rbt-review d-flex">
                                                <div class="rating me-2" style="width: 200px;">
                                                <?php
                                                $rating = $this->db->query("SELECT * FROM course_reviews WHERE course_id = '".$value->course_id."'")->result_array();
                                                $totalrate = $this->db->query("SELECT SUM(rating) as total FROM course_reviews WHERE course_id = '".$value->course_id."'")->row();
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
                                                <div class="b2 text-light mb-0" style="color: #000 !important">Good</div>
                                                <div class="rating-count" style=" width: 100%; text-align: end; "><?php echo timeAgo($value->review_date); ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-end">
                                                <!-- <a class="btn btn-outline-primary btn-sm" href="#" title="Edit"><i class="far fa-edit"></i></a> -->
                                                <a class="btn btn-outline-danger btn-sm" href="javascript:void(0)" title="Delete" onclick="deleteReview(<?= $value->review_id?>)"><i class="far fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } else  { ?>
                                        <td class='text-danger' style='text-align: center; color: #fff !important;' colspan='2'>No review found!</td>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>