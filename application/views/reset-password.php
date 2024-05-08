<div class="main-content">
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url() ?>user_assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title">Register</h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url() ?>">Home</a>
                </li>
                <li>Forgot Password</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumbs End -->

    <section class="register-section pt-100 pb-100 loaded">
        <div class="container">
            <div class="register-box">

                <div class="sec-title text-center mb-30">
                    <h2 class="title mb-10">Reset password</h2>
                </div>

                <!-- Login Form -->
                <div class="styled-form">
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
                    <div id="form-messages"></div>
                    <form name="form1" id="quickFormValidation" method="post" action="<?= base_url('home/resetPwdCust') ?>">
                        <input type="hidden" name="user_id" value="<?php echo @$user_id; ?>">
                        <input type="hidden" name="otp" value="<?php echo @$otp; ?>">
                        <div class="row clearfix">

                            <!-- Form Group -->
                            <div class="form-group col-lg-12 mb-4">
                                <label for="">New Password</label>
                                <input type="password" id="password" name="password" value="" placeholder="******" required="">
                                <div class="eyepanel"><i class="fa fa-eye-slash" id="eye"></i></div>
                            </div>
                            <!-- Form Group -->
                            <div class="form-group col-lg-12">
                                <label>Confirm Password</label>
                                <input type="password"  name="confirm_password" id="confirm_password" value="" placeholder="******" required="">
                                <div class="eyepanel"><i class="fa fa-eye-slash" id="eye2"></i></div>
                            </div>


                            <div class="form-group col-lg-12 col-md-12 col-sm-12 text-center">
                                <button type="submit" class="readon register-btn" <?php if (@$otp == "") { ?>disabled<?php } ?>><span class="txt">Reset</span></button>
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <div class="users">Already have an account? <a href="<?php echo base_url('login') ?>">Sign In</a></div>
                            </div>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>
</div>

<style>
    .eyepanel {
        top: 52px !important;
    }
</style>