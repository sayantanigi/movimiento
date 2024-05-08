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
                                        <tr>
                                            <th>
                                                <span class="b3"><a href="javascript:void(0)"><?php echo @$value->review_message; ?></a></span>
                                            </th>
                                            <td>
                                                <div class="rbt-review d-flex">
                                                    <div class="rating me-2">
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
                                                    <span class="rating-count"><?php echo timeAgo($value->review_date); ?></span>
                                                </div>
                                                <p class="b2 text-light mb-0">Good</p>
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