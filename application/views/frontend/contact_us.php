<?php $site_setting = $this->db->query("select * from  settings")->row(); ?>
<section class="innerBanner" style="background-image: url(<?= base_url() ?>/assets/images/bg-cover-01.jpg);">
    <div class="container">
        <h2 class="text-center title text-white">Contact Us</h2>
    </div>
</section>
<section class="contactPnl enrollPnl ">
    <div class="container">
        <h3 class="maintitle wow fadeInUp ">Get In Touch With <span class="d-block text-primary"><?= $site_setting->title ?></span></h3>
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <p class="text-muted mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                    Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                <form id="contact_form">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-4">
                            <label class="mb-2">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="first_name" placeholder="Enter your first name"/>
                            <span id="errfirst_name"></span>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-4">
                            <label class="mb-2">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="last_name" placeholder="Enter your last name"/>
                            <span id="errlast_name"></span>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-4">
                            <label class="mb-2">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your Email"/>
                            <span id="erremail"></span>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-4">
                            <label class="mb-2">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" placeholder="Enter your phone number"/>
                            <span id="errphone"></span>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-4">
                            <label class="mb-2">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" placeholder="Enter your Message"></textarea>
                            <span id="errmessage"></span>
                        </div>
                        <div class="col-lg-12">
                            <button type="button" class="enrollbtn" id="enrollbtn" onclick="btn_register()" style="display: inline-block;float: left;">Send</button>
                            <div id="contact-messages"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 mt-50">
                <div class="d-flex contactInfobox align-items-center">
                    <div class="boxIconcontact bg-gradient">
                        <img src="<?= base_url() ?>assets/images/icon-01.svg">
                    </div>
                    <div>
                        <a href="#"><?= $site_setting->phone ?></a>
                    </div>
                </div>
                <div class="d-flex contactInfobox align-items-center">
                    <div class="boxIconcontact bg-gradient">
                        <img src="<?= base_url() ?>assets/images/icon-02.svg">
                    </div>
                    <div>
                        <a href="#"><?= $site_setting->email ?></a>
                    </div>
                </div>
                <!-- <div class="d-flex contactInfobox align-items-center">
                    <div class="boxIconcontact bg-gradient">
                        <img src="<?= base_url() ?>assets/images/icon-03.svg">
                    </div>
                    <div>
                        <a href="#"><?= $site_setting->address ?></a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>
<section class="yelpreview  wow fadeInUp">
    <div class="container">
        <div class="yelpBox">
            <div class="row g-5 justify-content-between align-items-center">
                <div class="col-lg-8">
                    <h2 class="h5 mb-3">Why Take California Driver Ed With Us?</h2>
                    <p>We help teens and families navigate through their first-time driver experience to ensure
                        that it is stress, worry and speedbump free. Our courses can be completed on any mobile
                        device and will automatically save your progress each time you log out. Join thousands
                        of teens who chose First Time Driver for their online driver education and get ready to
                        earn
                        your California Learner’s Permit. Join thousands of teens who chose First Time Driver
                        for
                        their online driver education and get ready to earn your California Learner’s Permit.
                        Find
                        our course now.</p>
                    <div class="mt-3">
                        <a href="#" class="enrollbtn">Course FAQ</a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <img src="assets/images/yelp.png" class="yelplogo" />
                </div>
            </div>
        </div>
    </div>
</section>
<style>
#contact-messages {margin: 5px 0px 0px 10px; text-align: center; width: 350px; border: 0; display: inline-block;}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
function btn_register() {
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var email = $('#email').val().trim();
    var emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    var phone = $('#phone').val();
    var phoneRegex = /^\d{10}$/;
    var message = $('#message').val();

    if (first_name == '') {
        $('#errfirst_name').text('Please Enter First Name').css('color', 'red');
        $('#first_name').css({'color': 'red', 'border': '1px solid red'});
        $("#first_name").focus();
        return false;
    } else {
        $('#first_name').css({'color': 'black', 'border': '1px solid green'});
        $('#errfirst_name').text('');
    }
    if (last_name == '') {
        $('#errlast_name').text('Please Enter Last Name').css('color', 'red');
        $('#last_name').css({'color': 'red', 'border': '1px solid red'});
        $("#last_name").focus();
        return false;
    } else {
        $('#last_name').css({'color': 'black', 'border': '1px solid green'});
        $('#errlast_name').text('');
    }
    if (email == '') {
        $('#email').prop('placeholder', 'Enter valid email address');
        $('#email').css({'color': 'red', 'border': '1px solid red'});
        $("#email").focus();
        return false;
    } else {
        if (!emailRegex.test(email)) {
            $("#erremail").fadeIn().html("Please enter a valid email").css({'color': 'red', 'margin-bottom': '5px'});
            $('#email').css({'color': 'red', 'border': '1px solid red'});
            setTimeout(function () {
                $("#erremail").html("");
            }, 5000)
            $("#erremail").focus();
            return false;
        } else {
            $('#email').css({'color': 'black', 'border': '1px solid green'});
            $('#erremail').text('');
        }
    }
    if (phone == '') {
        $('#phone').prop('placeholder', 'Enter valid email address');
        $('#phone').css({'color': 'red', 'border': '1px solid red'});
        $("#phone").focus();
        return false;
    } else {
        if (!phoneRegex.test(phone)) {
            $("#errphone").fadeIn().html("Please enter a valid phone number").css({'color': 'red', 'margin-bottom': '5px'});
            $('#phone').css({'color': 'red', 'border': '1px solid red'});
            setTimeout(function () {
                $("#errphone").html("");
            }, 5000)
            $("#errphone").focus();
            return false;
        } else {
            $('#phone').css({'color': 'black', 'border': '1px solid green'});
            $('#errphone').text('');
        }
    }
    $.ajax({
        url:  "<?= base_url('contact_store')?>",
        type: 'POST',
        data: {first_name: first_name, last_name: last_name, email: email, phone: phone, message: message},
        dataType: 'json',
        beforeSend: function () {
            $("#enrollbtn").text("Please Wait...");
            $("#enrollbtn").prop("disable", "true");
        },
        success: function (returndata) {
            $("#enrollbtn").text("Submit");
            if (returndata.result == 'success') {
                $('#contact-messages').text(returndata.data).css('color', 'green');;
                $("#contact_form")[0].reset();
                setTimeout(function () {
                    $('#contact-messages').hide();
                }, 5000);
                setTimeout(function () {
                    location.reload();
                }, 7000);

            } else {
                $('#contact-messages').text(returndata.data).css('color', 'red');
                setTimeout(function () {
                    $('#contact-messages').hide();
                },5000);
                $("#enrollbtn").text("Resend");
            }
        }
    });
}
</script>
