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
                            <h2 class="h5 fw-bold text-uppercase">Update Profile</h2>
                            <?php
                            if (@$user->image && file_exists('./uploads/profile_pictures/' . @$user->image)) {
                                $profileImage = base_url('uploads/profile_pictures/' . @$user->image);
                            } else {
                                $profileImage = base_url('images/defualt-image.jpg');
                            }
                            if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                                <?php $this->session->unset_userdata('success');
                            }
                            if ($this->session->flashdata('error')) { ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                                <?php $this->session->unset_userdata('error');
                            }
                            $err = validation_errors();
                            if ($err) {
                                ?>
                                <div class="alert alert-warning alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $err; ?>
                                </div>
                            <?php } ?>
                            <hr>
                            <div class="formdesign">
                                <form autocomplete="off" name="form1" enctype="multipart/form-data"
                                    id="quickFormValidation" method="post"
                                    action="<?= base_url('users/profileUpdate') ?>">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo @$user->fname; ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Email Id</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo @$user->email; ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Phone Number</label>
                                            <input type="text" id="phone" class="form-control" name="phone" placeholder="Phone Number" required="" value="<?php echo @$user->phone; ?>" maxlength="10">
                                            <input type="hidden" name="phone_full" id="phone_full" value="<?php echo @$user->phone_full; ?>">
                                            <input type="hidden" name="phone_code" id="phone_code" value="<?php echo @$user->phone_code; ?>">
                                            <input type="hidden" name="phone_country" id="phone_country" value="<?php echo @$user->phone_country; ?>">
                                            <input type="hidden" name="phone_st_country" id="phone_st_country" value="<?php echo @$user->phone_st_country; ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Skill/Occupation</label>
                                            <input type="text" class="form-control" name="skills" placeholder="Skill/Occupation" value="<?php echo @$user->skills; ?>">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Update Profile Image</label>
                                            <input type="file" accept="image/*" class="form-control" name="profile_image" id="customFile" onchange="preview_image(event)">
                                            <input type="hidden" name="old_image" value="<?php echo @$user->image; ?>">
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <img id="output_image" src="<?= $profileImage ?>" />
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Bio</label>
                                            <textarea class="form-control" name="user_bio"><?php echo @$user->user_bio; ?></textarea>
                                        </div>
                                        <div class="col-lg-12">
                                            <button class="btn e-btn">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="card bg-dark shadow mt-4">
                        <div class="card-body p-4">
                            <h2 class="h5 fw-bold text-uppercase">Change Password</h2>
                            <hr>
                            <div class="formdesign">
                                <form>
                                    <div class="row g-4">

                                        <div class="col-lg-8">
                                            <label>Current Password</label>
                                            <input type="password" class="form-control" placeholder="Current Password">
                                        </div>
                                        <div class="col-lg-8">
                                            <label>New Password</label>
                                            <input type="password" class="form-control" placeholder="New Password">
                                        </div>
                                        <div class="col-lg-8">
                                            <label>Re-Type New Password</label>
                                            <input type="password" class="form-control"
                                                placeholder="Re-Type New Password">
                                        </div>
                                        <div class="col-lg-12">
                                            <button class="btn e-btn">Update Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
<script>
function preview_image(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('output_image');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>