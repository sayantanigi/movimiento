<style>
.alert-dismissible {padding-right: 0;}
</style>
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="<?= base_url()?>assets/img/page-title/page-title-2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                    <h3 class="page__title">Search Data</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url()?>home">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Search Data</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="signup__area po-rel-z1 pt-100 pb-100">
    <div class="sign__shape">
        <img class="circle" src="assets/img/icon/sign/circle.png" alt="">
        <img class="zigzag" src="assets/img/icon/sign/zigzag.png" alt="">
        <img class="dot" src="assets/img/icon/sign/dot.png" alt="">
        <img class="bg" src="assets/img/icon/sign/sign-up.png" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                <div class="section__title-wrapper text-center mb-55">
                    <h2 class="section__title">Reset password</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                <div class="sign__wrapper white-bg">
                    <div class="sign__form">
                        <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                        <?php $this->session->unset_userdata('success'); }
                        if ($this->session->flashdata('error')) { ?>
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
                        <form name="form1" id="resetFormValidation" autocomplete="off" method="post" action="<?= base_url('home/resetPwdCust') ?>">
                            <div class="sign__input-wrapper mb-25">
                                <h5>New Password</h5>
                                <div class="sign__input">
                                    <input type="password" placeholder="New Password" name="password" id="password" required="">
                                    <div class="eyepanel"><i class="fa fa-eye-slash" id="eye"></i></div>
                                    <i class="fal fa-envelope"></i>
                                </div>
                            </div>
                            <div class="sign__input-wrapper mb-25">
                                <h5>Confirm Password</h5>
                                <div class="sign__input">
                                    <input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required="">
                                    <div class="eyepanel"><i class="fa fa-eye-slash" id="eye2"></i></div>
                                    <i class="fal fa-envelope"></i>
                                </div>
                            </div>
                            <?php
                            $link = $_SERVER['REQUEST_URI'];
                            $filter = explode('/', $link);
                            $otp = end($filter);
                            ?>
                            <div class="p_check mb-10" style="color:red">Password and Confirm Password does not match</div>
                            <button class="e-btn w-100 text-capitalize reset_pass" id="reset_pass"> <span></span>Reset</button>
                            <input type="hidden" id="otp" name="otp" value="<?= base64_decode($otp);?>">
                            <input type="hidden" id="user_id" name="user_id" value="<?= @$user_id;?>">
                            <div class="sign__new text-center mt-20">
                                <p>Do not have account? <a href="<?php echo base_url('register') ?>"> Sign Up</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
.eyepanel {display: inline-block; width: 100%; top: 30px !important; position: absolute; margin-left: -55px;}
.p_check {display: none;}
</style>