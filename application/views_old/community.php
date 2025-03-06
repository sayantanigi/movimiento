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
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="<?= base_url('assets/img/page-title/page-title-2.jpg')?>">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                    <h3 class="page__title">Community</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>home">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Community</li>
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
                            <img src="<?= base_url() ?>images/no-user.png" alt="">
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
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold text-uppercase">Community</h2>
                        <hr>
                        <div class="container">
                            <?php if (!empty($community)) { ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php foreach ($community as $community_val) {
                                        $string = strip_tags($community_val['description']);
                                        if (strlen($string) > 400) {
                                            $stringCut = substr($string, 0, 400);
                                            $endPoint = strrpos($stringCut, ' ');
                                            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $string .= '    ....';
                                        }
                                        ?>
                                        <div class="communityList d-flex shadow p-3 mb-4">
                                            <?php
                                            if (!empty($community_val['uploaded_by'])) {
                                                $userdetails = $this->db->query("SELECT * FROM users WHERE id = '" . $community_val['uploaded_by'] . "'")->row();
                                                $name = $userdetails->full_name;
                                            } else {
                                                $name = "Admin";
                                            }
                                            ?>
                                            <div class="userIcon-com me-3">
                                                <a href="javascript:void(0)">
                                                    <?php if (!empty($userdetails->image)) { ?>
                                                        <img src="<?= base_url() ?>uploads/profile_pictures/<?= $userdetails->image ?>" />
                                                    <?php } else { ?>
                                                        <img src="<?= base_url() ?>images/no-user.png" />
                                                    <?php } ?>
                                                </a>
                                            </div>
                                            <div class="userComInfo">
                                                <h6 class="fw-semibold mb-0"><a href="javascript:void(0)"><?= $name ?></a></h6>
                                                <span class="post-meta mb-2 d-block text-secondary">
                                                    <small><?= date('M j, Y', strtotime($community_val['created_at'])) ?></small></span>
                                                <h2 class="h4 fw-bold communitytitle"><a href="<?= base_url() ?>community/<?= $community_val['slug'] ?>"><?= $community_val['title'] ?></a></h2>
                                                <p><?= $string ?></p>
                                                <p><a href="<?= base_url() ?>community/<?= $community_val['slug'] ?>" class="btn-community">View Details <i class="fas fa-arrow-right"></i></a></p>
                                                <ul class="d-flex align-items-center mt-3">
                                                    <?php $countchechis_like = $this->db->query("SELECT COUNT(id) as count FROM community_like WHERE community_id = '".$community_val['id']."' AND is_liked = 1")->row();?>
                                                    <li class="me-4"><a href="javascript:void(0)"><i class="fas fa-thumbs-up text-secondary"></i> <sup style="top: -2px;"><?= $countchechis_like->count;?></sup></a></li>
                                                    <?php $commentCount = $this->db->query("SELECT count(id) as count FROM community_comment WHERE community_id = '".$community_val['id']."'")->row(); ?>
                                                    <li><a href="javascript:void(0)"><i class="fas fa-comment text-secondary"></i> <sup style="top: -2px;"><?= $commentCount->count;?> </sup></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } else { ?>
                                <div> No community added yet</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>