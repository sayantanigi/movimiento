<div class="main-content">
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url() ?>user_assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title">Login</h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url() ?>">Home</a>
                </li>
                <li>Login</li>
            </ul>
        </div>
    </div>

    <section class="register-section pt-100 pb-100 loaded">
        <div class="container">
            <div class="register-box">
                <div class="sec-title text-center mb-30">
                    <h2 class="title mb-10">Login</h2>
                </div>
                <div class="styled-form">
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
                    <div id="form-messages"></div>
                    <form name="form1" id="quickFormValidation" autocomplete="off" method="post" action="<?= base_url('home/studentLoginCheck') ?>">
                        <input type="hidden" name="course_id" value="<?php echo @$course_id; ?>" >
                        <div class="row clearfix">
                            <div class="form-group col-lg-12 mb-25">
                                <input type="email" name="email" placeholder="Enter Email" autofocus required="" autocomplete="off">
                            </div>
                            <div class="form-group col-lg-12 mb-25">
                                <input type="password" name="password" placeholder="******" required="" autocomplete="off">
                            </div>
                            <div class="form-group col-lg-12 mb-25">
                                <div class="checkboxes float-left">
                                    <!-- <label class="container_check"> Remember me
                                        <input type="checkbox" />
                                        <span class="checkmark"></span>
                                    </label> -->
                                </div>
                                <div class="float-right"><a id="forgot" href="<?php echo base_url('forgot-password') ?>">Forgot Password?</a></div>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 text-center">
                                <button type="submit" class="readon register-btn"><span class="txt">Sign In</span></button>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <div class="users">Don't have an account? <a href="<?php echo base_url('register') ?>">Sign Up</a></div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>