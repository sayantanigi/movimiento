<style>
.alert-dismissible {padding-right: 0;}
</style>
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="<?= base_url()?>assets/img/page-title/page-title-2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                    <h3 class="page__title">Reset Password</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url()?>home">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
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
                        <form name="form1" id="quickFormValidation" autocomplete="off" method="post" action="<?= base_url('home/studentPasswordReset') ?>">
                            <div class="sign__input-wrapper mb-25">
                                <h5>Email Address</h5>
                                <div class="sign__input">
                                    <input type="email" placeholder="E-mail address" name="email" required="">
                                    <i class="fal fa-envelope"></i>
                                </div>
                            </div>
                            <button class="e-btn w-100 text-capitalize"> <span></span>Send</button>
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