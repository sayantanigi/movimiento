<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="assets/img/page-title/page-title-2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                    <h3 class="page__title">Sign Up</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
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
                    <h2 class="section__title">Create an Account</h2>
                    <p>Sign Up in Seconds</p>
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
                            <div class="sign__input-wrapper mb-25">
                                <h5>Full Name</h5>
                                <div class="sign__input">
                                    <input type="text" placeholder="Full name" id="full_name" name="full_name" value="" required="">
                                    <i class="fal fa-user"></i>
                                </div>
                            </div>
                            <div class="sign__input-wrapper mb-25">
                                <h5>Email Address</h5>
                                <div class="sign__input">
                                    <input type="email" placeholder="E-mail address" id="email" name="email" value="" required="">
                                    <i class="fal fa-envelope"></i>
                                </div>
                            </div>
                            <div class="sign__input-wrapper mb-25">
                                <h5>Password</h5>
                                <div class="sign__input">
                                    <input type="password" placeholder="Password" id="password" name="password" value="" required="">
                                    <i class="fal fa-lock"></i>
                                </div>
                            </div>
                            <div class="sign__input-wrapper mb-10">
                                <h5>Re-Password</h5>
                                <div class="sign__input">
                                    <input type="password" placeholder="Re-Password" id="confirm_password" name="confirm_password" value="" required="">
                                    <i class="fal fa-lock"></i>
                                </div>
                            </div>
                            <div class="p_check mb-10" style="color:red">Password and Confirm Password does not match</div>
                            <!-- <div class="sign__input-wrapper mb-10">
                                <h5>Subscription Type</h5>
                                <div class="sign__input">
                                    <select name="subscription_type" id="subscription_type" class="form-control" style="width: 100%;" required="">
                                        <option value="">Select option</option>
                                        <option value="1">Apply free subscription</option>
                                        <option value="2">Apply paid subscription</option>
                                    </select>
                                </div>
                                <p style="color: red; margin-top: 10px" class="free_sub"><b>Note:</b> Each course need to purchase for free subscribers.</>
                                <p style="color: red; margin-top: 10px" class="paid_sub"><b>Note:</b> One time payment, No need to purchase each course for paid subscribers.</p>
                            </div> -->
                            <div class="sign__input-wrapper mb-10">
                                <div class="e-btn w-50 reg_cstm_scls" onclick="get_value(1)">
                                    <span class="user-tab cstm_text1" user_type="1">Student</span>
                                </div>
                                <div class="e-btn w-50 reg_cstm_icls" onclick="get_value(2)">
                                    <span class="user-tab cstm_text2" user_type="2">Instructor</span>
                                </div>
                                <input type="hidden" name="user_type" id="user_type" required>
                            </div>
                            <div class="sign__action d-flex justify-content-between mb-10">
                                <div class="sign__agree d-flex align-items-center">
                                    <input class="m-check-input" type="checkbox" id="m-agree">
                                    <label class="m-check-label" for="m-agree">I agree to the <a href="javascript:void(0)" id="exampleModal">Terms & Conditions</a></label>
                                </div>
                            </div>
                            <div class="tc_check mb-10" style="color:red">Please check the checkbox</div>
                            <button class="e-btn w-100 text-capitalize"> <span></span> Register Now</button>
                            <div class="sign__new text-center mt-20">
                                <p>Already in Registered ? <a href="<?= base_url()?>login"> Log In</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <?php $about_data = $this->db->query("SELECT * FROM `cms` WHERE `id` = 12")->row();?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?= $about_data->title?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #000;height: 0px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?= $about_data->description; ?>
            </div>
        </div>
    </div>
</div>
<style>
.reg_cstm_scls {width: 47% !important; float: left; margin-right: 20px; background: #343434; color: #fff;}
.reg_cstm_icls {width: 47% !important; background: #343434; color: #fff;}
.select {background: #83d893; color: #fff; cursor: pointer;}
.select:hover{color: #fff !important;}
.reg_cstm_scls:hover{color: #fff;}
.reg_cstm_icls:hover{color: #fff;}
.p_check {display: none;}
.tc_check {display: none;}
.show{opacity: 1;display: block;background: #0000009e;transition: all 0.3s ease-out 0s;}
.modal-header{align-items: normal !important;}
.modal-title{color: #000;}
.modal-body {height: 250px; overflow: overlay;}
.modal-body *{color: #000; font-size: 10px;line-height: normal;margin: 0;padding: 0;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#user_type').val(1);
    $('.reg_cstm_scls').addClass('select');
})
function get_value(id) {
    $('#user_type').val(id);
    if(id == 1) {
        $('.reg_cstm_scls').addClass('select');
        $('.reg_cstm_icls').removeClass('select');
    } else {
        $('.reg_cstm_icls').addClass('select');
        $('.reg_cstm_scls').removeClass('select');
    }
}
$('#quickFormValidation').submit(function() {
    var pass = $('#password').val();
    var conPass = $('#confirm_password').val();
    if(pass != conPass) {
        $("#confirm_password").fadeIn().html("Required").css("border","2px solid red");
        $(".p_check").show()
        setTimeout(function() {
            $("#confirm_password").removeAttr("style");
            $(".p_check").hide()
        },2000);
        $("#confirm_password").focus();
        return false;
    }
    if (!$('#m-agree')[0].checked){
        $("#m-agree").fadeIn().html("Required").css("border","2px solid red");
        $(".tc_check").show()
        setTimeout(function() {
            $("#m-agree").removeAttr("style");
            $(".tc_check").hide()
        },2000);
        $("#m-agree").focus();
        return false;
    }
})
$('#exampleModal').click(function(){
    $('#exampleModalCenter').addClass('show');
})
$('.close').click(function(){
    $('#exampleModalCenter').removeClass('show');
})
</script>