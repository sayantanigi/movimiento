<?php
    if (@$user->image && file_exists('./uploads/profile_pictures/'.@$user->image)) {
        $profileImage = base_url('uploads/profile_pictures/'.@$user->image);
    } else {
        $profileImage = base_url('images/defualt-image.jpg');
    }
?>
<div class="student-user d-flex align-items-center mb-3">
    <img src="<?php echo @$profileImage; ?>">
    <h3 class="m-0 h5 font-weight-bold"><?php echo @$user->fname; ?> <?php echo @$user->lname; ?></h3>
</div>
<ul class="sidebar-list">
    <li class=" <?= (!empty($page) && $page == 'dashboard')? 'active' : ''; ?>"><a href="<?= base_url('student-dashboard') ?>"><i class="fa fa-home"></i> Dashboard</a></li>
    <li class=" <?= (!empty($page) && $page == 'profile')? 'active' : ''; ?>"><a href="<?php echo base_url('profile') ?>"><i class="fa fa-user"></i> My Profile</a></li>
    <li class=" <?= (!empty($page) && $page == 'enrolled')? 'active' : ''; ?>"><a href="<?php echo base_url('enrolled-courses') ?>"><i class="fa fa-book"></i> Enrolled Courses</a></li>
    <li class=" <?= (!empty($page) && $page == 'purchase')? 'active' : ''; ?>"><a href="<?php echo base_url('purchase-list') ?>"><i class="fa fa-briefcase"></i> Purchase History</a></li>
    <li class=" <?= (!empty($page) && $page == 'reviews')? 'active' : ''; ?>"><a href="<?php echo base_url('reviews') ?>"><i class="fa fa-star"></i> Reviews</a></li>
    <li><a href="<?php echo base_url('logout') ?>"><i class="fa fa-power-off"></i> Logout</a></li>
</ul>