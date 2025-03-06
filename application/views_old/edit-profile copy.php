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
                            <h3>Edit Profile</h3>
                            
                        </div>

                        <?php
                            if (@$user->image && file_exists('./uploads/profile_pictures/'.@$user->image)) {
                                $profileImage = base_url('uploads/profile_pictures/'.@$user->image);
                            } else {
                                $profileImage = base_url('images/defualt-image.jpg');
                            }
                        ?>

                        <?php
                            if ($this->session->flashdata('success')) {
                        ?>
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $this->session->flashdata('success'); ?>
                            </div>
                        <?php $this->session->unset_userdata('success'); }
                            if ($this->session->flashdata('error')) {
                        ?>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php $this->session->unset_userdata('error'); }
                            $err = validation_errors();
                            if ($err) {
                        ?>
                            <div class="alert alert-warning alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $err; ?>
                            </div>
                        <?php } ?>

                        <div class="dashboard-profile profileform">
                             <form autocomplete="off" name="form1" enctype="multipart/form-data" id="quickFormValidation" method="post" action="<?= base_url('users/profileUpdate') ?>">
                                <div class="row">
                                    <div class="form-group col-lg-6 mb-3">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo @$user->fname; ?>">
                                    </div>
                                    <div class="form-group col-lg-6 mb-3">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="last_name" placeholder="Last Name"value="<?php echo @$user->lname; ?>">
                                    </div>
                                    <div class="form-group col-lg-6 mb-3">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email"value="<?php echo @$user->email; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Password <span style="color: #ff0000; font-size: 11px;">(Enter only when you want to change the password)</span></label>
                                        <input type="password" class="form-control" name="password_edit" id="password" placeholder="Password" autocomplete="off">
                                    </div>
                                    <div class="form-group col-lg-6 mb-3">
                                        <label>Phone Number</label>
                                        <input type="text" id="phone" class="form-control" name="phone" placeholder="Phone Number" required="" value="<?php echo @$user->phone_full; ?>">
                                        <input type="hidden" name="phone_full" id="phone_full"  value="<?php echo @$user->phone_full; ?>">
                                        <input type="hidden" name="phone_code" id="phone_code"  value="<?php echo @$user->phone_code; ?>">
                                        <input type="hidden" name="phone_country" id="phone_country"  value="<?php echo @$user->phone_country; ?>">
                                        <input type="hidden" name="phone_st_country" id="phone_st_country"  value="<?php echo @$user->phone_st_country; ?>">
                                    </div>
                                    <div class="form-group col-lg-4 mb-3">
                                        <label>Update Profile Image</label>
                                        <input type="file" accept="image/*" class="form-control" name="profile_image" id="customFile" onchange="preview_image(event)">
                                        <input type="hidden"  name="old_image" value="<?php echo @$user->image; ?>">
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <label></label>
                                        <img id="output_image" src="<?= $profileImage ?>" />
                                    </div>
                                    <div class="form-group col-lg-12 mb-3">
                                        <label>Bio</label>
                                        <textarea class="form-control" name="user_bio"><?php echo @$user->user_bio; ?></textarea>
                                    </div>
                                    <div class="form-group col-lg-12 mb-3">
                                        <button class="btn btn-primary" name="submit" value="update">Update Profile</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #output_image {
            width:70px;
            height: 70px;
            object-fit:cover;
            border: 1px solid #ccc;
            padding: 2px;
            border-radius: 5px;
            margin-top: 16px;
        }
    </style>
</section>