<section class="enrollPnl">
    <div class="container">
        <h2 class="subtitle  wow fadeInUp">Student Information</h2>
        <form action="<?= base_url()?>student_data_store" method="post" id="registrationForm">
            <div class="row" id="main-form">
                <h3 class="maintitle mb-3 wow fadeInUp">Enter your information</h3>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Course Name <span class="text-danger">*</span> </label>
                    <select class="form-control form-select" id="course_name" name="course_name">
                        <option value="">Select Course</option>
                        <?php 
                        if(!empty($course_list)){
                        foreach($course_list as $course){ ?>
                        <option value="<?= $course->id; ?>" <?php if($course->id === $course_id){echo "selected";}?>><?= $course->course_name; ?></option>
                        <?php } } ?>
                    </select>
                    <div id="vld_coursename"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter your first name" id="first_name" name="first_name"/>
                    <div id="vld_first_name"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Middle Name </label>
                    <input type="text" class="form-control" placeholder="Enter your middle name" id="middle_name" name="middle_name"/>
                    <div id="vld_middle_name"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter your last name" id="last_name" name="last_name"/>
                    <div id="vld_last_name"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter your username" id="username" name="username"/>
                    <div id="vld_username"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" placeholder="Enter your email" id="email_adrs" name="email_adrs"/>
                    <div id="vld_email_adrs"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Gender <span class="text-danger">*</span></label>
                    <select class="form-control form-select" id="gender" name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <div id="vld_gender"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Date of Birth  <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="dob" name="dob"/>
                    <div id="vld_dob"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Phone No <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter your phone number" id="phone_no" name="phone_no" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                    <div id="vld_phone_no"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Address  <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter your address" id="address" name="address"/>
                    <div id="vld_address"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
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
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">State <span class="text-danger">*</span> </label>
                    <select class="form-control form-select" id="state" name="state">
                        <option value="">Select State</option>
                    </select>
                    <div id="vld_state"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">City <span class="text-danger">*</span> </label>
                    <select class="form-control form-select" id="city" name="city">
                        <option value="">Select City</option>
                    </select>
                    <div id="vld_city"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Zip Code  <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Zip Code" id="zip_code" name="zip_code" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                    <div id="vld_zip_code"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" placeholder="Enter your password" id="password" name="password"/>
                    <div id="vld_password"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" placeholder="Enter your confirm password" id="con_password" name="con_password"/>
                    <div id="vld_con_password"></div>
                </div>
                <div class="col-lg-12 mb-4 d-lg-flex gap-5 mb-4">
                    <div class="form-check form-switch form-check-success">
                        <input class="form-check-input" type="checkbox" role="switch" id="disclaimer">
                        <label class="form-check-label" for="disclaimer">Accept Disclaimer</label>
                    </div>
                    <div class="form-check form-switch form-check-success">
                        <input class="form-check-input" type="checkbox" role="switch" id="address-toggle">
                        <input type="hidden" id="address_toggle" name="address_toggle" value="0">
                        <label class="form-check-label" for="address">Billing address is the same as the mailing address</label>
                    </div>
                </div>
            </div>
            <div class="row" id="billing-address-fields">
                <h3 class="maintitle mb-3 wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">Enter billing information</h3>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter your first name" id="bfirst_name" name="bfirst_name"/>
                    <div id="vld_bfirst_name"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Middle Name</label>
                    <input type="text" class="form-control" placeholder="Enter middle name" id="bmiddle_name" name="bmiddle_name"/>
                    <div id="vld_bmiddle_name"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter last name" id="blast_name" name="blast_name"/>
                    <div id="vld_blast_name"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Phone No <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter phone number" id="bphone_no" name="bphone_no" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                    <div id="vld_bphone_no"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter address" id="baddress" name="baddress"/>
                    <div id="vld_baddress"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Country <span class="text-danger">*</span></label>
                    <select class="form-control form-select" id="bcountry" name="bcountry">
                        <option value="">Select Country</option>
                        <?php if($country_list) {
                            foreach ($country_list as $country) { ?>
                            <option value="<?= $country->id ?>"><?= $country->name ?></option>
                        <?php } } ?>
                    </select>
                    <div id="vld_bcountry"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">State <span class="text-danger">*</span></label>
                    <select class="form-control form-select" id="bstate" name="bstate">
                        <option value="">Select State</option>
                    </select>
                    <div id="vld_bstate"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">City <span class="text-danger">*</span></label>
                    <select class="form-control form-select" id="bcity" name="bcity">
                        <option value="">Select City</option>
                    </select>
                    <div id="vld_bcity"></div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <label class="mb-2">Zip Code <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Zip Code" id="bzip_code" name="bzip_code" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                    <div id="vld_bzip_code"></div>
                </div>
            </div>
            <div class="col-lg-12 mb-4 mt-4">
                <p><small>Bay Hill Driving School is not affiliated with the DMV (Department of Motor Vehicles), and the department shall not be responsible for distributed materials, advertisements, etc. <a href="#" class="text-primary"> Click here to read the DMV (Department of Motor Vehicles) Disclaimer</a></small></p>
            </div>
            <div class="col-lg-12 mb-4 text-center">
                <button class="enrollbtn" type="submit" id="enrollbtn">Submit</button>
            </div>
        </form>
    </div>
</section>
<style>
#main-form{border: 1px solid #eee; box-shadow: 0 0 10px #014599; border-radius: 12px; padding: 15px 0px 0px; margin-top: 20px;}
#billing-address-fields{border: 1px solid rgb(238, 238, 238); box-shadow: rgb(1, 69, 153) 0px 0px 10px; border-radius: 12px; padding: 15px 0px 0px; margin-top: 20px;}
</style>
<script>
$(document).ready(function() {
    if($('#address_toggle').val() === '0'){
        $('#billing-address-fields').hide();
        $('#address-toggle').prop('checked', true);
    } else {
        $('#billing-address-fields').show();
        $('#billing-address-fields h3').css({'visibility':'visible','animation-name':'fadeInUp'});
    }
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
    $('#course_name').on('change', function(e) {
        var course_name = $('#course_name').val();
        if(course_name === ''){
            $('#vld_coursename').text('This field is required').css('color', 'red').show();
            $('#course_name').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_coursename").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_coursename").hide();
            $('#course_name').focus().css('border', '1px solid green');
        }
    });
    $('#first_name').on('keyup', function(e) {
        var first_name = $('#first_name').val();
        if(first_name === ''){
            $('#vld_first_name').text('This field is required').css('color', 'red').show();
            $('#first_name').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_first_name").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_first_name").hide();
            $('#first_name').focus().css('border', '1px solid green');
        }
    });
    $('#last_name').on('keyup', function(e) {
        var last_name = $('#last_name').val();
        if(last_name === ''){
            $('#vld_last_name').text('This field is required').css('color', 'red').show();
            $('#last_name').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_last_name").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_last_name").hide();
            $('#last_name').focus().css('border', '1px solid green');
        }
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
                beforeSend : function(){},
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
    $('#email_adrs').on('keyup', function(e) {
        var email_adrs = $('#email_adrs').val();
        var emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        if(email_adrs === ''){
            $('#vld_email_adrs').text('This field is required').css('color', 'red').show();
            $('#email_adrs').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_email_adrs").hide(); }, 5000);
            e.preventDefault();
        } else {
            if(!emailRegex.test(email_adrs)) {
                $('#vld_email_adrs').text('Please enter a valid email').css('color', 'red').show();
                $('#email_adrs').focus().css('border', '1px solid red');
                setTimeout(function () { $("#vld_email_adrs").hide(); }, 5000);
                e.preventDefault();
            } else {
                $("#vld_email_adrs").hide();
                $('#email_adrs').focus().css('border', '1px solid green');
            }
        }
    });
    $('#gender').on('change', function(e) {
        var gender = $('#gender').val();
        if(gender === ''){
            $('#vld_gender').text('This field is required').css('color', 'red').show();
            $('#gender').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_gender").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_gender").hide();
            $('#gender').focus().css('border', '1px solid green');
        }
    });
    $('#dob').on('change', function(e) {
        var dob = $('#dob').val();
        if(dob === ''){
            $('#vld_dob').text('This field is required').css('color', 'red').show();
            $('#dob').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_dob").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_dob").hide();
            $('#dob').focus().css('border', '1px solid green');
        }
    });
    $('#phone_no').on('keyup', function(e) {
        var phone_no = $('#phone_no').val();
        var phoneRegex = /^\d{10}$/;
        if(phone_no === ''){
            $('#vld_phone_no').text('This field is required').css('color', 'red').show();
            $('#phone_no').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_phone_no").hide(); }, 5000);
            e.preventDefault();
        } else {
            if(!phoneRegex.test(phone_no)) {
                $('#vld_phone_no').text('Please enter a valid phone no').css('color', 'red').show();
                $('#phone_no').focus().css('border', '1px solid red');
                setTimeout(function () { $("#vld_phone_no").hide(); }, 5000);
                e.preventDefault();
            } else {
                $("#vld_phone_no").hide();
                $('#phone_no').focus().css('border', '1px solid green');
            }
        }
    });
    $('#address').on('keyup', function(e) {
        var address = $('#address').val();
        if(address === ''){
            $('#vld_address').text('This field is required').css('color', 'red').show();
            $('#address').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_address").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_address").hide();
            $('#address').focus().css('border', '1px solid green');
        }
    });
    $('#country').on('change', function(e) {
        var country = $('#country').val();
        if(country === ''){
            $('#vld_country').text('This field is required').css('color', 'red').show();
            $('#country').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_country").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_country").hide();
            $('#country').focus().css('border', '1px solid green');
        }
    });
    $('#state').on('change', function(e) {
        var state = $('#state').val();
        if(state === ''){
            $('#vld_state').text('This field is required').css('color', 'red').show();
            $('#state').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_state").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_state").hide();
            $('#state').focus().css('border', '1px solid green');
        }
    });
    $('#city').on('change', function(e) {
        var city = $('#city').val();
        if(city === ''){
            $('#vld_city').text('This field is required').css('color', 'red').show();
            $('#city').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_city").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_city").hide();
            $('#city').focus().css('border', '1px solid green');
        }
    });
    $('#zip_code').on('keyup', function(e) {
        var zip_code = $('#zip_code').val();
        if(zip_code === ''){
            $('#vld_zip_code').text('This field is required').css('color', 'red').show();
            $('#zip_code').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_zip_code").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_zip_code").hide();
            $('#zip_code').focus().css('border', '1px solid green');
        }
    });
    $('#password').on('keyup', function(e) {
        var password = $('#password').val();
        if(password === ''){
            $('#vld_password').text('This field is required').css('color', 'red').show();
            $('#password').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_password").hide(); }, 5000);
            e.preventDefault();
        } else {
            if (password.length < 8) {
                $('#vld_password').text('Password should be at least 8 characters long').css('color', 'red').show();
                $('#password').focus().css('border', '1px solid red');
                setTimeout(function () { $("#vld_password").hide(); }, 5000);
                e.preventDefault();
            } else {
                $("#vld_password").hide();
                $('#password').focus().css('border', '1px solid green');
            }
        }
    });
    $('#con_password').on('keyup', function(e) {
        var con_password = $('#con_password').val();
        if(con_password === ''){
            $('#vld_con_passwordd').text('This field is required').css('color', 'red').show();
            $('#con_password').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_password").hide(); }, 5000);
            e.preventDefault();
        } else {
            if (con_password.length < 8) {
                $('#vld_con_password').text('Confirm Password should be at least 8 characters long').css('color', 'red').show();
                $('#con_password').focus().css('border', '1px solid red');
                setTimeout(function () { $("#vld_con_password").hide(); }, 5000);
                e.preventDefault();
            } else {
                if ($('#password').val() !== $('#con_password').val()) {
                    $('#vld_con_password').text('Password Mismatch').css('color', 'red').show();
                    $('#con_password').focus().css('border', '1px solid red');
                    setTimeout(function () { $("#vld_con_password").hide(); }, 2000);
                    e.preventDefault();
                } else {
                    $('#con_password').focus().css('border', '1px solid green');
                    $('#vld_con_password').text('Password Match').css('color', 'green').show();
                }
            }
        }
    });
    
    //for billing address validation when address toggle is not checked
    $('#address-toggle').change(function() {
        if ($(this).is(':checked')) {
            $('#billing-address-fields').hide();
            $('#address_toggle').val('0');
        } else {
            $('#billing-address-fields').show();
            $('#billing-address-fields h3').css({'visibility':'visible','animation-name':'fadeInUp'});
            $('#address_toggle').val('1');
        }
    });
    
    $('#bfirst_name').on('keyup', function(e) {
        var bfirst_name = $('#bfirst_name').val();
        if(bfirst_name === ''){
            $('#vld_bfirst_name').text('This field is required').css('color', 'red').show();
            $('#bfirst_name').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_bfirst_name").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_bfirst_name").hide();
            $('#bfirst_name').focus().css('border', '1px solid green');
        }
    });
    $('#blast_name').on('keyup', function(e) {
        var blast_name = $('#blast_name').val();
        if(blast_name === ''){
            $('#vld_blast_name').text('This field is required').css('color', 'red').show();
            $('#blast_name').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_blast_name").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_blast_name").hide();
            $('#blast_name').focus().css('border', '1px solid green');
        }
    });
    $('#bphone_no').on('keyup', function(e) {
        var bphone_no = $('#phone_no').val();
        var bphoneRegex = /^\d{10}$/;
        if(bphone_no === ''){
            $('#vld_bphone_no').text('This field is required').css('color', 'red').show();
            $('#bphone_no').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_bphone_no").hide(); }, 5000);
            e.preventDefault();
        } else {
            if(!bphoneRegex.test(bphone_no)) {
                $('#vld_bphone_no').text('Please enter a valid phone no').css('color', 'red').show();
                $('#bphone_no').focus().css('border', '1px solid red');
                setTimeout(function () { $("#vld_bphone_no").hide(); }, 5000);
                e.preventDefault();
            } else {
                $("#vld_bphone_no").hide();
                $('#bphone_no').focus().css('border', '1px solid green');
            }
        }
    });
    $('#baddress').on('keyup', function(e) {
        var baddress = $('#baddress').val();
        if(baddress === ''){
            $('#vld_baddress').text('This field is required').css('color', 'red').show();
            $('#baddress').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_baddress").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_baddress").hide();
            $('#baddress').focus().css('border', '1px solid green');
        }
    });
    $('#bcountry').on('change', function(e) {
        var bcountry = $('#bcountry').val();
        if(bcountry === ''){
            $('#vld_bcountry').text('This field is required').css('color', 'red').show();
            $('#bcountry').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_bcountry").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_bcountry").hide();
            $('#bcountry').focus().css('border', '1px solid green');
        }
    });
    $('#bstate').on('change', function(e) {
        var bstate = $('#bstate').val();
        if(bstate === ''){
            $('#vld_bstate').text('This field is required').css('color', 'red').show();
            $('#bstate').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_bstate").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_bstate").hide();
            $('#bstate').focus().css('border', '1px solid green');
        }
    });
    $('#bcity').on('change', function(e) {
        var bcity = $('#bcity').val();
        if(bcity === ''){
            $('#vld_bcity').text('This field is required').css('color', 'red').show();
            $('#bcity').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_bcity").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_bcity").hide();
            $('#bcity').focus().css('border', '1px solid green');
        }
    });
    $('#bzip_code').on('keyup', function(e) {
        var bzip_code = $('#bzip_code').val();
        if(bzip_code === ''){
            $('#vld_bzip_code').text('This field is required').css('color', 'red').show();
            $('#bzip_code').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_bzip_code").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_bzip_code").hide();
            $('#bzip_code').focus().css('border', '1px solid green');
        }
    });
});
$("#registrationForm").submit(function (e) {
    var emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if ($('#course_name').val() === '') {
        $('#vld_coursename').text('This field is required').css('color', 'red').show();
        $('#course_name').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_coursename").hide(); }, 2000);
        e.preventDefault();
    }
    if ($('#first_name').val() === '') {
        $('#vld_first_name').text('This field is required').css('color', 'red').show();
        $('#first_name').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_first_name").hide(); }, 2000);
        e.preventDefault();
    }
    if ($('#last_name').val() === '') {
        $('#vld_last_name').text('This field is required').css('color', 'red').show();
        $('#last_name').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_last_name").hide(); }, 2000);
        e.preventDefault();
    }
    if ($('#username').val() === '') {
        $('#vld_username').text('This field is required').css('color', 'red').show();
        $('#username').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_username").hide(); }, 2000);
        e.preventDefault();
    }
    if ($('#email_adrs').val() === '') {
        $('#vld_email_adrs').text('This field is required').css('color', 'red').show();
        $('#email_adrs').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_email_adrs").hide(); }, 2000);
        e.preventDefault();
    } else {
        if(!emailRegex.test($('#email_adrs').val())) {
            $('#vld_email_adrs').text('Please enter a valid email').css('color', 'red').show();
            $('#email_adrs').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_email_adrs").hide(); }, 2000);
            e.preventDefault();
        }
    }
    if ($('#gender').val() === '') {
        $('#vld_gender').text('This field is required').css('color', 'red').show();
        $('#gender').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_gender").hide(); }, 2000);
        e.preventDefault();
    }
    if ($('#dob').val() === '') {
        $('#vld_dob').text('This field is required').css('color', 'red').show();
        $('#dob').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_dob").hide(); }, 2000);
        e.preventDefault();
    }
    if ($('#phone_no').val() === '') {
        $('#vld_phone_no').text('This field is required').css('color', 'red').show();
        $('#phone_no').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_phone_no").hide(); }, 2000);
        e.preventDefault();
    }
    if ($('#address').val() === '') {
        $('#vld_address').text('This field is required').css('color', 'red').show();
        $('#address').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_address").hide(); }, 2000);
        e.preventDefault();
    }
    if ($('#country').val() === '') {
        $('#vld_country').text('This field is required').css('color', 'red').show();
        $('#country').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_country").hide(); }, 2000);
        e.preventDefault();
    }
    if ($('#state').val() === '') {
        $('#vld_state').text('This field is required').css('color', 'red').show();
        $('#state').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_state").hide(); }, 2000);
        e.preventDefault();
    }
    if ($('#city').val() === '') {
        $('#vld_city').text('This field is required').css('color', 'red').show();
        $('#city').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_city").hide(); }, 2000);
        e.preventDefault();
    }
    if ($('#zip_code').val() === '') {
        $('#vld_zip_code').text('This field is required').css('color', 'red').show();
        $('#zip_code').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_zip_code").hide(); }, 2000);
        e.preventDefault();
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
        } else {
            $('#password').focus().css('border', '1px solid green');
        }
    }
    if ($('#con_password').val() === '') {
        $('#vld_con_password').text('This field is required').css('color', 'red').show();
        $('#con_password').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_con_password").hide(); }, 2000);
        e.preventDefault();
    } else {
        if ($('#con_password').val().length < 8) {
            $('#vld_con_password').text('Confirm Password should be at least 8 characters long').css('color', 'red').show();
            $('#con_password').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_con_password").hide(); }, 2000);
            e.preventDefault();
        } else {
            $('#con_password').focus().css('border', '1px solid green');
        }
    }
    if ($('#password').val() !== $('#con_password').val()) {
        $('#vld_con_password').text('Password Mismatch').css('color', 'red').show();
        $('#con_password').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_con_password").hide(); }, 2000);
        e.preventDefault();
    }
    
    //for billing address validation when address toggle is not checked
    var address_toggle = $('#address_toggle').val();
    if(address_toggle === '1'){
        $('#bcountry').on('change', function() {
            var country_id = this.value;
            $.ajax({
                url: "<?php echo base_url()?>home/states_by_country",
                type: "POST",
                data: {country_id: country_id},
                cache: false,
                success: function(result){
                    $("#bstate").html(result);
                    $('#bcity').html('<option value="">Select State First</option>');
                }
            });
        });
        $('#bstate').on('change', function() {
            var state_id = this.value;
            $.ajax({
                url: "<?php echo base_url()?>home/cities_by_state",
                type: "POST",
                data: {state_id: state_id},
                cache: false,
                success: function(result){
                    $("#bcity").html(result);
                }
            });
        });
        if ($('#bfirst_name').val() === '') {
            $('#vld_bfirst_name').text('This field is required').css('color', 'red').show();
            $('#bfirst_name').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_bfirst_name").hide(); }, 2000);
            e.preventDefault();
        }
        if ($('#blast_name').val() === '') {
            $('#vld_blast_name').text('This field is required').css('color', 'red').show();
            $('#blast_name').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_blast_name").hide(); }, 2000);
            e.preventDefault();
        }
        if ($('#bphone_no').val() === '') {
            $('#vld_bphone_no').text('This field is required').css('color', 'red').show();
            $('#bphone_no').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_bphone_no").hide(); }, 2000);
            e.preventDefault();
        }
        if ($('#baddress').val() === '') {
            $('#vld_baddress').text('This field is required').css('color', 'red').show();
            $('#baddress').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_baddress").hide(); }, 2000);
            e.preventDefault();
        }
        if ($('#bcountry').val() === '') {
            $('#vld_bcountry').text('This field is required').css('color', 'red').show();
            $('#bcountry').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_bcountry").hide(); }, 2000);
            e.preventDefault();
        }
        if ($('#bstate').val() === '') {
            $('#vld_bstate').text('This field is required').css('color', 'red').show();
            $('#bstate').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_bstate").hide(); }, 2000);
            e.preventDefault();
        }
        if ($('#bcity').val() === '') {
            $('#vld_bcity').text('This field is required').css('color', 'red').show();
            $('#bcity').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_bcity").hide(); }, 2000);
            e.preventDefault();
        }
        if ($('#bzip_code').val() === '') {
            $('#vld_bzip_code').text('This field is required').css('color', 'red').show();
            $('#zip_bcode').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_bzip_code").hide(); }, 2000);
            e.preventDefault();
        }
    }
});
</script>