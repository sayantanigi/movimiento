<div class="main-content">
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url() ?>user_assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title">My Profile</h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url('student-dashboard') ?>">Home</a>
                </li>
                <li>My Profile</li>
            </ul>
        </div>
    </div>
</div>

<section class="intro-section py-5 loaded">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-3">
                <div class="sidebar shadow-sm">
                    <?php include("usr-menu.php"); ?>
                </div>
            </div>
            <div class="col-lg-9">
                <div>
                    <div>
                        <div class="d-flex justify-content-between">
                            <h3>My Profile</h3>
                            <div><a href="<?= base_url('edit-profile') ?>" class="btn btn-primary rounded-pill">
                                    <i class="fa fa-pencil"></i> Edit Profile</a>
                            </div>
                        </div>

                        <div class="dashboard-profile">
                            <div class="dashboard-profile__item">
                                <div class="dashboard-profile__heading">Registration Date</div>
                                <div class="dashboard-profile__content">
                                    <p><?php echo date("F jS, Y H:i", strtotime(@$user->created_at)); ?></p>
                                </div>
                            </div>
                            <div class="dashboard-profile__item">
                                <div class="dashboard-profile__heading">First Name</div>
                                <div class="dashboard-profile__content">
                                    <p><?php echo @$user->fname; ?></p>
                                </div>
                            </div>
                            <div class="dashboard-profile__item">
                                <div class="dashboard-profile__heading">Last Name</div>
                                <div class="dashboard-profile__content">
                                    <p><?php echo @$user->lname; ?></p>
                                </div>
                            </div>
                            <div class="dashboard-profile__item">
                                <div class="dashboard-profile__heading">Email</div>
                                <div class="dashboard-profile__content">
                                    <p><?php echo @$user->email; ?></p>
                                </div>
                            </div>
                            <div class="dashboard-profile__item">
                                <div class="dashboard-profile__heading">Phone Number</div>
                                <div class="dashboard-profile__content">
                                    <p><?php echo @$user->phone; ?></p>
                                </div>
                            </div>
                            <div class="dashboard-profile__item">
                                <div class="dashboard-profile__heading">Bio</div>
                                <div class="dashboard-profile__content">
                                    <p><?php echo @$user->user_bio; ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>