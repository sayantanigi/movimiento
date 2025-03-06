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
                <li>Register</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumbs End -->

    <section class="register-section pt-100 pb-100 loaded">
        <div class="container">
            <div class="register-box">
                <div class="sec-title text-center mb-30">
                    <h2 class="title mb-10">Create New Account</h2>
                </div>
                <!-- Login Form -->
                <div class="styled-form">
                    <div id="form-messages"></div>
                    <?php if ($this->session->flashdata('success')) { ?>
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
                    if ($err) { ?>
                        <div class="alert alert-warning alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $err; ?>
                        </div>
                    <?php } ?>
                    <form autocomplete="off" name="form1" id="quickFormValidation" method="post" action="<?= base_url('home/studentRegistration') ?>">
                        <div class="row clearfix">
                            <div class="form-group col-lg-12">
                                <input type="text" id="Name" name="first_name" value="" placeholder="First Name" required="">
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="text" id="last" name="last_name" value="" placeholder="Last Name">
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="email" id="email" name="email" value="" placeholder="Email address" required="">
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="text" id="phone" name="phone" value="" placeholder="Phone Number" required="">
                                <input type="hidden" name="phone_full" id="phone_full" value="">
                                <input type="hidden" name="phone_code" id="phone_code" value="">
                                <input type="hidden" name="phone_country" id="phone_country" value="">
                                <input type="hidden" name="phone_st_country" id="phone_st_country" value="">
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="password" id="password" name="password" value="" placeholder="******" required="">
                                <div class="eyepanel"><i class="fa fa-eye-slash" id="eye"></i></div>
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="password" name="confirm_password" id="confirm_password" value="" placeholder="******" required="">
                                <div class="eyepanel"><i class="fa fa-eye-slash" id="eye2"></i></div>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 text-center-opt">
                                    <span class="user-tab cstm_text1 select" user_type="1" onclick="get_value(1)">Student</span>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 text-center-opt">
                                    <span class="user-tab cstm_text2" user_type="2" onclick="get_value(2)">Instructor</span>
                                </div>
                                <input type="hidden" name="user_type" id="user_type">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 text-center">
                                <button type="submit" class="readon register-btn"><span class="txt">Sign Up</span></button>
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
.cstm_text1 {display: inline-block; float: left; border: 1px solid #fdf0f0; padding: 10px 28px; background: #dadee5; color: #828482; border-radius: 6px; cursor: pointer; width: 100%;}
.cstm_text2 {display: inline-block; float: left; border: 1px solid #fdf0f0; padding: 10px 28px; background: #dadee5; color: #828482; border-radius: 6px; cursor: pointer; width: 100%;}
.select {border: 1px solid #fdf0f0; padding: 10px 28px; background: #0089ff; color: #fff; border-radius: 6px; cursor: pointer;}
.text-center-opt {text-align: center !important; display: inline-block; float: left; padding: 0;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#user_type').val(1);
})
function get_value(id) {
    $('#user_type').val(id);
    if(id == 1) {
        $('.cstm_text1').addClass('select');
        $('.cstm_text2').removeClass('select');
    } else { 
        $('.cstm_text2').addClass('select');
        $('.cstm_text1').removeClass('select');
    }
}
</script>