<?php $userDetails = $this->Commonmodel->fetch_row('users', array('id' => $this->session->userdata('user_id'))); ?>
<div class="col-lg-4 mb-4">
    <div class="rbt-default-sidebar">
        <div class="wrappsidebar">
            <h2 class="h6 mb-4 text-dark-emphasis">Welcome,
                <?= $userDetails->fname ?>
            </h2>
            <nav class="mainmenu-nav">
                <ul class="dashboard-mainmenu rbt-default-sidebar-list">
                    <li>
                        <a href="<?= base_url('student-dashboard') ?>" class="active">
                            <i class="far fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('profile') ?>">
                            <i class="far fa-user-alt"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('enrolled-courses') ?>">
                            <i class="far fa-book-open"></i>
                            <span>Enrolled Courses</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('event-booked') ?>">
                            <i class="fa fa-calendar"></i>
                            <span>Event Booked</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('reviews') ?>">
                            <i class="far fa-star"></i>
                            <span>Reviews</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('purchase-list')?>">
                            <i class="far fa-shopping-bag"></i>
                            <span>Order History</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('product-order-list')?>">
                            <i class="far fa-shopping-bag"></i>
                            <span>Product Order History</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <h4 class="h6 mb-4 text-light mt-4">User</h4>
            <nav class="mainmenu-nav">
                <ul class="dashboard-mainmenu rbt-default-sidebar-list">
                    <li><a href="<?= base_url('edit-profile') ?>"><i class="fas fa-cog"></i><span>Settings</span></a></li>
                    <li><a href="<?= base_url('logout') ?>"><i class="far fa-power-off"></i><span>Logout</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<style>
.formdesign .form-control {min-height: 39px;}
#output_image {width: 100%; height: 70px; object-fit: cover; border: 1px solid #ccc; padding: 2px; border-radius: 5px; margin-top: -4px;}
</style>