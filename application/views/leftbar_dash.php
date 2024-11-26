<?php $userDetails = $this->Commonmodel->fetch_row('users', array('id' => $this->session->userdata('user_id'))); ?>
<div class="col-lg-3 mb-4">
    <div class="rbt-default-sidebar">
        <div class="wrappsidebar">
            <h2 class="h6 mb-4 text-white">Welcome, <?= $userDetails->full_name ?></h2>
            <nav class="mainmenu-nav">
                <ul class="dashboard-mainmenu rbt-default-sidebar-list">
                    <li>
                        <?php  ?>
                        <a href="
                        <?php if($userDetails->subscription_type == '1') {
                            echo base_url('student-dashboard');
                        } else if($userDetails->subscription_type == '2') {
                            $checksubscription = $this->db->query("SELECT * FROM user_subscription WHERE employer_id = '".$this->session->userdata('user_id')."' AND status = '1'")->result_array();
                            if(!empty($checksubscription)) {
                                echo base_url('student-dashboard');
                            } else {
                                echo base_url('subscription');
                            }
                        } else {
                            echo 'javascript:void(0)" onclick="show_err_msg()';
                        } ?>"
                        class="">
                            <i class="far fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="
                        <?php if($userDetails->subscription_type == '1') {
                            echo base_url('enrolled-courses');
                        } else if($userDetails->subscription_type == '2') {
                            $checksubscription = $this->db->query("SELECT * FROM user_subscription WHERE employer_id = '".$this->session->userdata('user_id')."' AND status = '1'")->result_array();
                            if(!empty($checksubscription)) {
                                echo base_url('enrolled-courses');
                            } else {
                                echo base_url('subscription');
                            }
                        } else {
                            $checkUserEnrolledSql = "SELECT `courses`.`id`, `course_enrollment`.`enrollment_id`, `course_enrollment`.`course_id`, `course_enrollment`.`user_id`,`course_enrollment`.`payment_status` FROM `course_enrollment` JOIN `courses` ON `courses`.`id` = `course_enrollment`.`course_id` WHERE `courses`.`id` = '" . @$detail->id . "' AND `course_enrollment`.`payment_status` = 'COMPLETED' and `course_enrollment`.`user_id` = '".@$this->session->userdata('user_id')."'";
                            $checkUserenrollment = $this->db->query($checkUserEnrolledSql)->result_array();
                            if(@$checkUserenrollment[0]['user_id'] == @$user_id) {
                                echo base_url('enrolled-courses');
                            } else {
                                echo 'javascript:void(0)" onclick="show_err_msg()';
                            }
                        } ?>">
                            <i class="far fa-book-open"></i>
                            <span>Enrolled Courses</span>
                        </a>
                    </li>
                    <li>
                        <a href="
                        <?php if($userDetails->subscription_type == '1') {
                            echo base_url('community');
                        } else if($userDetails->subscription_type == '2') {
                            $checksubscription = $this->db->query("SELECT * FROM user_subscription WHERE employer_id = '".$this->session->userdata('user_id')."' AND status = '1'")->result_array();
                            if(!empty($checksubscription)) {
                                echo base_url('community');
                            } else {
                                echo base_url('subscription');
                            }
                        } else {
                            echo 'javascript:void(0)" onclick="show_err_msg()';
                        } ?>">
                            <i class="fa fa-circle"></i>
                            <span>Community</span>
                        </a>
                    </li>
                    <li>
                        <a href="
                        <?php if($userDetails->subscription_type == '1') {
                            echo base_url('event-booked');
                        } else if($userDetails->subscription_type == '2') {
                            $checksubscription = $this->db->query("SELECT * FROM user_subscription WHERE employer_id = '".$this->session->userdata('user_id')."' AND status = '1'")->result_array();
                            if(!empty($checksubscription)) {
                                echo base_url('event-booked');
                            } else {
                                echo base_url('subscription');
                            }
                        } else {
                            echo 'javascript:void(0)" onclick="show_err_msg()';
                        } ?>">
                            <i class="fa fa-calendar"></i>
                            <span>Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="
                        <?php if($userDetails->subscription_type == '1') {
                            echo base_url('reviews');
                        } else if($userDetails->subscription_type == '2') {
                            $checksubscription = $this->db->query("SELECT * FROM user_subscription WHERE employer_id = '".$this->session->userdata('user_id')."' AND status = '1'")->result_array();
                            if(!empty($checksubscription)) {
                                echo base_url('reviews');
                            } else {
                                echo base_url('subscription');
                            }
                        } else {
                            echo 'javascript:void(0)" onclick="show_err_msg()';
                        } ?>">
                            <i class="far fa-star"></i>
                            <span>Reviews</span>
                        </a>
                    </li>
                    <li>
                        <a href="
                        <?php if($userDetails->subscription_type == '1') {
                            echo base_url('purchase-list');
                        } else if($userDetails->subscription_type == '2') {
                            $checksubscription = $this->db->query("SELECT * FROM user_subscription WHERE employer_id = '".$this->session->userdata('user_id')."' AND status = '1'")->result_array();
                            if(!empty($checksubscription)) {
                                echo base_url('purchase-list');
                            } else {
                                echo base_url('subscription');
                            }
                        } else {
                            echo 'javascript:void(0)" onclick="show_err_msg()';
                        } ?>">
                            <i class="far fa-shopping-bag"></i>
                            <span>Order History</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="
                        <?php if($userDetails->subscription_type == '1') {
                            echo base_url('product-order-list');
                        } else if($userDetails->subscription_type == '2') {
                            $checksubscription = $this->db->query("SELECT * FROM user_subscription WHERE employer_id = '".$this->session->userdata('user_id')."' AND status = '1'")->result_array();
                            if(!empty($checksubscription)) {
                                echo base_url('product-order-list');
                            } else {
                                echo base_url('subscription');
                            }
                        } else {
                            echo 'javascript:void(0)" onclick="show_err_msg()';
                        } ?>">
                            <i class="far fa-shopping-bag"></i>
                            <span>Product Order History</span>
                        </a>
                    </li>
                    <li>
                        <a href="
                        <?php if($userDetails->subscription_type == '1') {
                            echo base_url('profile');
                        } else if($userDetails->subscription_type == '2') {
                            $checksubscription = $this->db->query("SELECT * FROM user_subscription WHERE employer_id = '".$this->session->userdata('user_id')."' AND status = '1'")->result_array();
                            if(!empty($checksubscription)) {
                                echo base_url('profile');
                            } else {
                                echo base_url('subscription');
                            }
                        } else {
                            echo 'javascript:void(0)" onclick="show_err_msg()';
                        } ?>">
                            <i class="far fa-user-alt"></i>
                            <span>My Profile</span>
                        </a>
                    </li> -->
                </ul>
            </nav>
            <h4 class="h6 mb-4 text-light mt-4">User</h4>
            <nav class="mainmenu-nav">
                <ul class="dashboard-mainmenu rbt-default-sidebar-list">
                    <li>
                        <a href="<?= base_url('edit-profile') ?>">
                            <!-- <i class="fas fa-cog"></i> -->
                            <i class="far fa-user-alt"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('logout') ?>">
                            <i class="far fa-power-off"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<style>
.formdesign .form-control {min-height: 39px;}
#output_image {width: 100%; height: 70px; object-fit: cover; border: 1px solid #ccc; padding: 2px; border-radius: 5px; margin-top: -4px;}
</style>
<script>
function show_err_msg() {
    $('#error_msg').show();
    setTimeout(() => {
        $('#error_msg').hide();
    }, 3000);
}
</script>