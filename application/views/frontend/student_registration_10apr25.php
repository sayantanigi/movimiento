<?php
$getCourse = $this->db->query("SELECT * FROM courses WHERE id = '".$course_id."'")->row();
?>
<section class="enrollPnl">
    <div class="container">
        <div class="row g-5">
            <?php if(!empty($course_id)) { ?>
            <div class="col-lg-8">
            <?php } else { ?>
            <div class="col-lg-12">
            <?php } ?>
                <div class="text-success-msg f-20">
                    <?php if ($this->session->flashdata('message')) {
                        echo '<p style="text-align: center; font-size: 18px; padding: 10px; background: green; border-radius: 20px; margin-bottom: 30px; color: #fff;">'.$this->session->flashdata('message').'</p>';
                        unset($_SESSION['message']);
                    } ?>
                    <?php if ($this->session->flashdata('error')) {
                        echo '<p style="text-align: center; font-size: 18px; padding: 10px; background: red; border-radius: 20px; margin-bottom: 30px; color: #fff;">'.$this->session->flashdata('error').'</p>';
                        unset($_SESSION['error']);
                    } ?>
                </div>
                <h3 class="h3 fw-bold mb-2  wow fadeInUp">Registration</h3>
                <p>Complete your registration to begin your learning journey with us.</p>
                <?php if(!empty($course_id)) { ?>
                <form action="<?= base_url()?>registration_process?ctitle=<?= base64_encode($getCourse->course_name)?>" method="post" id="registrationForm">
                <?php } else { ?>
                <form action="<?= base_url()?>registration_process" method="post" id="registrationForm">
                <?php } ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-3 user_type">
                            <label class="mb-2">Registration Type<span class="text-danger">*</span></label>
                            <select class="form-control" name="user_type" id="user_type">
                                <option value="">Select User Type</option>
                                <option value="1">Student</option>
                                <!-- <option value="2">Trainer</option> -->
                            </select>
                            <div id="vld_user_type"></div>
                        </div>
                        <div class="col-lg-12">
                            <h2 class="subtitle wow fadeInUp mt-4">Users Information</h2>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter your first name" name="first_name" id="first_name"/>
                            <div id="vld_first_name"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter your last name" name="last_name" id="last_name"/>
                            <div id="vld_last_name"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2">Phone No <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter your phone number" name="phone" id="phone"/>
                            <div id="vld_phone"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" placeholder="Enter your email" name="email" id="email"/>
                            <div id="vld_email"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="mb-2">Student Date of Birth  <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="dob" id="dob"/>
                            <div id="vld_dob"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <label class="mb-2">Gender <span class="text-danger">*</span></label>
                            <select class="form-control form-select" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            <div id="vld_gender"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3 permit">
                            <label class="mb-2">Permit/DL# <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Permit/DL#" name="permit" id="permit"/>
                            <div id="vld_permit"></div>
                        </div>
                        <div class="col-lg-12">
                            <h2 class="subtitle  wow fadeInUp mt-4">Contact Information</h2>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2">Parents First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Parents First Name" name="pfirst_name" id="pfirst_name"/>
                            <div id="vld_pfirst_name"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2">Parents Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Parents Last Name" name="plast_name" id="plast_name"/>
                            <div id="vld_plast_name"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2">Parents Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" placeholder="Parents Email" name="pemail" id="pemail"/>
                            <div id="vld_pemail"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2">Parents Phone Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Parents Phone Number" name="pphone" id="pphone"/>
                            <div id="vld_pphone"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2">Street Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Street Address" name="address" id="address"/>
                            <div id="vld_address"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2">Country <span class="text-danger">*</span> </label>
                            <select class="form-control form-select" id="country" name="country">
                                <option value="">Select Country</option>
                                <?php
                                if($country_list){
                                foreach ($country_list as $country) { ?>
                                <option value="<?= $country->id?>"><?= $country->name?></option>
                                <?php } } ?>
                            </select>
                            <div id="vld_country"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="mb-2">State <span class="text-danger">*</span> </label>
                            <select class="form-control form-select" name="state" id="state">
                                <option value="">Select State</option>
                            </select>
                            <div id="vld_state"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="mb-2">City <span class="text-danger">*</span> </label>
                            <select class="form-control form-select" name="city" id="city">
                                <option value="">Select City</option>
                            </select>
                            <div id="vld_city"></div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="mb-2">Zip Code<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter Zip Code" name="zipcode" id="zipcode"/>
                            <div id="vld_zipcode"></div>
                        </div>
                        <div class="col-lg-12">
                            <h2 class="subtitle wow fadeInUp mt-3">Create Account</h2>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label class="mb-2">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter your username" name="username" id="username"/>
                            <div id="vld_username"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" placeholder="Enter your password" name="password" id="password"/>
                            <div id="vld_password"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" placeholder="Enter your confirm password" name="conpassword" id="conpassword"/>
                            <div id="vld_conpassword"></div>
                        </div>
                        <div class="col-lg-12 mb-4 d-lg-flex gap-5 mb-3">
                            <div class="form-check form-switch form-check-success">
                                <input class="form-check-input" type="checkbox" role="switch" name="disclaimer" id="disclaimer">
                                <label class="form-check-label">You have read and agree to the <a href="#" class="text-primary">Terms of Service</a> </label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <?php if(!empty($course_id)) { ?>
                            <button class="enrollbtn" type="submit" id="enrollbtn">Next</button>
                            <?php } else { ?>
                            <button class="enrollbtn" type="submit" id="enrollbtn">Submit</button>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
            <?php if(!empty($course_id)) { ?>
            <div class="col-lg-4">
                <h3 class="h4 fw-bold mb-4 wow fadeInUp">Order Summary</h3>
                <div class="p-4 bg-light pb-2 border rounded">
                    <table class="table paytable">
                        <tbody>
                            <tr>
                                <td style="width: 260px;"><?= $course_title; ?></td>
                                <td class="text-end">$ <?= $offer_price; ?></td>
                            </tr>
                            <tr>
                                <td class="border-top fw-semibold">You Pay	:</td>
                                <td class="border-top text-end h6 text-primary fw-semibold">$ <?= $offer_price; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<style>
#main-form{border: 1px solid #eee; box-shadow: 0 0 10px #014599; border-radius: 12px; padding: 15px 0px 0px; margin-top: 20px;}
#billing-address-fields{border: 1px solid rgb(238, 238, 238); box-shadow: rgb(1, 69, 153) 0px 0px 10px; border-radius: 12px; padding: 15px 0px 0px; margin-top: 20px;}
</style>
<script>
$(document).ready(function() {
    $('.permit').hide();
    $('.custom-cursor__cursor').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
    });

    $('#country').on('change', function() {
        var country_id = this.value;
        $.ajax({
            url: "<?php echo base_url()?>home/states_by_country",
            type: "POST",
            data: {country_id: country_id},
            cache: false,
            success: function(result){
                $("#state").html(result);
                $('#city').html('<option value="">Select State First</option>');
            }
        });
    });

    $('#state').on('change', function() {
        var state_id = this.value;
        $.ajax({
            url: "<?php echo base_url()?>home/cities_by_state",
            type: "POST",
            data: {state_id: state_id},
            cache: false,
            success: function(result){
                $("#city").html(result);
            }
        });
    });

    $('#username').on('keyup', function(e) {
        var username = $('#username').val();
        if(username === ''){
            $('#vld_username').text('This field is required').css('color', 'red').show();
            $('#username').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_username").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_username").hide();
            $('#username').focus().css('border', '1px solid green');
            $.ajax({
                type: "POST",
                url: "<?= base_url('Home/checkusername')?>",
                data: {username: username},
                dataType:'json',
                beforeSend : function() {},
                success:function(returndata) {
                    if(returndata.result === 'success') {
                        $('#vld_username').fadeIn().html(returndata.data).css({'color':'green','margin-bottom':'5px'});
                        $("#enrollbtn").prop("disabled", false);
                    } else {
                        $('#err_username').fadeIn().html(returndata.data).css({'color':'red','margin-bottom':'5px'});
                        setTimeout(function(){$("#vld_username").html("");},3000);
                        $("#username").focus();
                        $("#enrollbtn").prop("disabled", true);
                        return false;
                    }
                }
            });
        }
    });
});

$("#registrationForm").submit(function (e) {
    var emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if ($('#user_type').val() === '') {
        $('#vld_user_type').text('This field is required').css('color', 'red').show();
        $('#user_type').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_user_type").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#user_type').focus().css('border', '1px solid green');
    }

    if ($('#first_name').val() === '') {
        $('#vld_first_name').text('This field is required').css('color', 'red').show();
        $('#first_name').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_first_name").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#first_name').focus().css('border', '1px solid green');
    }

    if ($('#last_name').val() === '') {
        $('#vld_last_name').text('This field is required').css('color', 'red').show();
        $('#last_name').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_last_name").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#last_name').focus().css('border', '1px solid green');
    }

    if ($('#phone').val() === '') {
        $('#vld_phone').text('This field is required').css('color', 'red').show();
        $('#phone').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_phone").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#phone').focus().css('border', '1px solid green');
    }

    if ($('#email').val() === '') {
        $('#vld_email').text('This field is required').css('color', 'red').show();
        $('#email').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_email").hide(); }, 2000);
        e.preventDefault();
    } else {
        if(!emailRegex.test($('#email').val())) {
            $('#vld_email').text('Please enter a valid email').css('color', 'red').show();
            $('#email').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_email").hide(); }, 2000);
            e.preventDefault();
        } else {
            $('#email').focus().css('border', '1px solid green');
        }
    }

    if ($('#dob').val() === '') {
        $('#vld_dob').text('This field is required').css('color', 'red').show();
        $('#dob').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_dob").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#dob').focus().css('border', '1px solid green');
    }

    if ($('#user_type').val() === '2') {
        if ($('#permit').val() === '') {
            $('#vld_permit').text('This field is required').css('color', 'red').show();
            $('#permit').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_permit").hide(); }, 2000);
            e.preventDefault();
        } else {
            $('#permit').focus().css('border', '1px solid green');
        }
    }

    if ($('#gender').val() === '') {
        $('#vld_gender').text('This field is required').css('color', 'red').show();
        $('#gender').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_gender").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#gender').focus().css('border', '1px solid green');
    }

    if ($('#pfirst_name').val() === '') {
        $('#vld_pfirst_name').text('This field is required').css('color', 'red').show();
        $('#pfirst_name').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_pfirst_name").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#pfirst_name').focus().css('border', '1px solid green');
    }

    if ($('#plast_name').val() === '') {
        $('#vld_plast_name').text('This field is required').css('color', 'red').show();
        $('#plast_name').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_plast_name").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#plast_name').focus().css('border', '1px solid green');
    }

    if ($('#pemail').val() === '') {
        $('#vld_pemail').text('This field is required').css('color', 'red').show();
        $('#pemail').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_pemail").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#pemail').focus().css('border', '1px solid green');
    }

    if ($('#pphone').val() === '') {
        $('#vld_pphone').text('This field is required').css('color', 'red').show();
        $('#pphone').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_pphone").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#pphone').focus().css('border', '1px solid green');
    }

    if ($('#address').val() === '') {
        $('#vld_address').text('This field is required').css('color', 'red').show();
        $('#address').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_address").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#address').focus().css('border', '1px solid green');
    }

    if ($('#country').val() === '') {
        $('#vld_country').text('This field is required').css('color', 'red').show();
        $('#country').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_country").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#country').focus().css('border', '1px solid green');
    }

    if ($('#state').val() === '') {
        $('#vld_state').text('This field is required').css('color', 'red').show();
        $('#state').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_state").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#state').focus().css('border', '1px solid green');
    }

    if ($('#city').val() === '') {
        $('#vld_city').text('This field is required').css('color', 'red').show();
        $('#city').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_city").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#city').focus().css('border', '1px solid green');
    }

    if ($('#zipcode').val() === '') {
        $('#vld_zipcode').text('This field is required').css('color', 'red').show();
        $('#zipcode').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_zipcode").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#zipcode').focus().css('border', '1px solid green');
    }

    if ($('#username').val() === '') {
        $('#vld_username').text('This field is required').css('color', 'red').show();
        $('#username').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_username").hide(); }, 2000);
        e.preventDefault();
    } else {
        $('#username').focus().css('border', '1px solid green');
    }

    if ($('#password').val() === '') {
        $('#vld_password').text('This field is required').css('color', 'red').show();
        $('#password').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_password").hide(); }, 2000);
        e.preventDefault();
    } else {
        if ($('#password').val().length < 8) {
            $('#vld_password').text('Password should be at least 8 characters long').css('color', 'red').show();
            $('#password').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_password").hide(); }, 2000);
            e.preventDefault();
        }
    }

    if ($('#conpassword').val() === '') {
        $('#vld_conpassword').text('This field is required').css('color', 'red').show();
        $('#conpassword').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_conpassword").hide(); }, 2000);
        e.preventDefault();
    } else {
        if ($('#conpassword').val().length < 8) {
            $('#vld_conpassword').text('Confirm Password should be at least 8 characters long').css('color', 'red').show();
            $('#conpassword').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_conpassword").hide(); }, 2000);
            e.preventDefault();
        }
    }

    if ($('#password').val() !== $('#conpassword').val()) {
        $('#vld_conpassword').text('Password Mismatch').css('color', 'red').show();
        $('#conpassword').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_conpassword").hide(); }, 2000);
        e.preventDefault();
    }
});

$('#user_type').change(function() {
    if($('#user_type').val() != '2'){
        $('.permit').hide();
    } else {
        $('.permit').show();
    }
})
</script>