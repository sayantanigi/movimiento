<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style>
.files:before,.profile .image,.text{text-align:center}
small>p{color:red}
p strong{font-weight:600!important;color:#000!important}
.sa-confirm-button-container button{background-color:#146c43!important;border-color:#146c43!important}
.files,.image_area{position:relative}
.overlay,.text{position:absolute}
.preview,.preview1{overflow:hidden;width:160px;height:160px;margin:10px;border:1px solid red}
.modal-lg{max-width:1000px!important}
.overlay{bottom:10px;left:0;right:0;background-color:rgba(255,255,255,.5);overflow:hidden;height:0;transition:.5s;width:100%}
.image_area:hover .overlay{height:50%;cursor:pointer}
.text{color:#333;font-size:20px;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}
#img-container{border:1px solid red;width:75vw;height:75vw;background:#666}
img{display:block;max-width:100%}
body{margin-top:20px}
.profile{width:100%;position:relative;background:#fff;border:1px solid #d5d5d5;padding-bottom:5px;margin-bottom:20px}
.profile .image{display:block;position:relative;z-index:1;overflow:hidden;border:5px solid #fff}
.profile .user{position:relative;padding:0 5px 5px}
.profile .user .avatar{position:absolute;left:20px;top:-85px;z-index:2}
.profile .user h2{font-size:16px;line-height:20px;display:block;float:left;margin:4px 0 0 135px;font-weight:700}
.profile .user .actions{float:right}
.profile .user .actions .btn{margin-bottom:0}
.profile .info{float:left;margin-left:20px}
.files:after,.files:before{position:absolute;left:0;pointer-events:none;right:0;display:block;margin:0 auto}
.img-profile{height:100px;width:100px}
.img-cover{width:800px;height:180px}
@media (max-width:768px){.btn-responsive{padding:2px 4px;font-size:80%;line-height:1;border-radius:3px}}
@media (min-width:769px) and (max-width:992px){.btn-responsive{padding:4px 9px;font-size:90%;line-height:1.2}}
.files input{outline:#92b0b3 dashed 2px;outline-offset:-10px;-webkit-transition:outline-offset .15s ease-in-out,background-color .15s linear;transition:outline-offset .15s ease-in-out,background-color .15s linear;padding:52px 0 46px 32%;text-align:center!important;margin:0;width:100%!important}
.files input:focus{outline:#92b0b3 dashed 2px;outline-offset:-10px;-webkit-transition:outline-offset .15s ease-in-out,background-color .15s linear;transition:outline-offset .15s ease-in-out,background-color .15s linear;border:1px solid #92b0b3}
.files:after{top:60px;width:50px;height:56px;content:"";background-image:url(https://image.flaticon.com/icons/png/128/109/109612.png);background-size:100%;background-repeat:no-repeat}
.color input{background-color:#f1f1f1}
.files:before{bottom:10px;width:100%;height:57px;color:#2ea591;font-weight:600;text-transform:capitalize}
.jobsites{padding: 0px !important; margin: 0px !important;}
.table tr {box-shadow: unset !important; border-color: unset !important; border-style: hidden !important; border-width: 0px !important;}
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <section class="bg-light-gray">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?= $page ?></h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                                        <li class="breadcrumb-item active"><?= $page ?></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="submitform" action="<?= base_url('admin/student/add_student')?>" method="post" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="card shadow rounded">
                                    <div class="card-body">
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Salutation <span style="color:red">*</span></label>
                                            <select class="form-control" name="salutation" id="salutation" required>
                                                <option value="">Select Salutation</option>
                                                <option value="Mr." aria-label="Mr.">Mr.</option>
                                                <option value="Ms." aria-label="Ms.">Ms.</option>
                                                <option value="Mrs." aria-label="Mrs.">Mrs.</option>
                                                <option value="Mohd." aria-label="Mohd.">Mohd.</option>
                                                <option value="Miss." aria-label="Miss.">Miss.</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">First Name <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="fname" id="fname" required autocomplete="off">
                                        </div>
                                        <small id="fname_error"></small>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Last Name <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="lname" id="lname" required autocomplete="off">
                                        </div>
                                        <small id="lname_error"></small>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Username *</label>
                                            <input type="text" class="form-control" name="username"  id="username" required autocomplete="off">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Email <span style="color:red">*</span></label>
                                            <input type="email" class="form-control" name="email" id="email" required autocomplete="off">
                                        </div>
                                        <small id="email_error"></small>
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">Gender</label>
                                                    <select class="form-control" name="gender" id="gender">
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">DOB</label>
                                                    <input type="date" class="form-control" name="dob" id="dob">
                                                </div>
                                            </div>
                                        </div>
                                        <small id="gender_error"></small>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Phone <span style="color:red">*</span></label>
                                            <input type="number" class="form-control" name="phone" required id="phone" autocomplete="off">
                                        </div>
                                        <small id="phone_error"></small>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Parents First Name</label>
                                            <input type="text" class="form-control" name="pfirst_name" id="pfirst_name"  autocomplete="off">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Parents Last Name</label>
                                            <input type="text" class="form-control" name="plast_name" id="plast_name"  autocomplete="off">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Parents Email</label>
                                            <input type="text" class="form-control" name="pemail" id="pemail"  autocomplete="off">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Parents Phone Number</label>
                                            <input type="text" class="form-control" name="phone_2" id="phone_2"  autocomplete="off">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Street Address</label>
                                            <input type="text" class="form-control" name="address" id="autocomplete" value="">
                                            <input type="hidden" placeholder="Near"  name="latitude" id="latitude" >
                                            <input type="hidden" placeholder="Near" name="longitude" id="longitude" >
                                        </div>
                                        <small id="address_error"></small>
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">Country</label>
                                                    <select class="form-control form-select" id="country" name="country">
                                                        <option value="">Select Country</option>
                                                        <?php
                                                        $country_list = $this->db->query("SELECT * FROM countries WHERE flag = '1'")->result();
                                                        foreach($country_list as $val) {?>
                                                            <option value="<?php echo $val->id; ?>"><?php echo $val->name;?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">State</label>
                                                    <select class="form-control" name="state" id="state">
                                                        <option value="">Select Country</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">City</label>
                                                    <select class="form-control" name="city" id="city">
                                                        <option value="">Select State</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">Zip Code</label>
                                                    <input type="text" class="form-control" name="pincode" id="pincode">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Background With Degrees</label>
                                            <input type="text" class="form-control" name="degree"  id="degree"  autocomplete="off">
                                        </div>
                                        <small id="degree_error"></small>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Languages</label>
                                            <input type="text" class="form-control" name="languages"  id="languages"  autocomplete="off">
                                        </div>
                                        <small id="languages_error"></small>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Certificates</label>
                                            <input type="text" class="form-control" name="certificates"  id="certificates"  autocomplete="off">
                                        </div>
                                        <small id="certificates_error"></small>
                                        <div class="form-group mb-2 files">
                                            <label class="fw-semibold  text-black">Profile Image</label>
                                            <input type="file" class="form-control" name="upload_pimage" id="upload_pimage" >
                                        </div>
                                        <div class="form-group mb-2 files">
                                            <label class="fw-semibold  text-black">Cover Image</label>
                                            <input type="file" class="form-control" name="upload_cimage" id="upload_cimage" >
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Status <span style="color:red">*</span></label>
                                            <select class="form-control" name="status" required id="userstatus">
                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <small id="status_error"></small>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Password <span style="color:red">*</span></label>
                                            <input type="password" class="form-control" name="password" id="password" required autocomplete="off">
                                        </div>
                                        <small id="pass_error"></small>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Confirm Password <span style="color:red">*</span></label>
                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" required autocomplete="off">
                                        </div>
                                        <small id="cnfpass_error"></small>
                                        <div class="form-group mt-3 mb-2">
                                            <button class="btn btn-success text-uppercase px-5 shadow" id="addTrainerButton">Submit</button>
                                            <a class="btn btn-danger waves-effect waves-light m-l-30" href="javascript:history.go(-1)">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="card shadow rounded">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="container">
                                                <div class="col-md-12">
                                                    <div class="profile clearfix">
                                                        <div class="image item" id="Cover-Image">
                                                            <img src="<?= base_url('uploads/bnr.jpg'); ?>" class="img-cover" id="cblah">
                                                        </div>
                                                        <div class="user clearfix">
                                                            <div class="avatar item" id="item">
                                                                <img src="<?= base_url('uploads/unnamed.jpg') ?>" class="img-thumbnail img-profile" id="pblah">
                                                            </div>
                                                            <h2>
                                                                <span id="sltation"></span>
                                                                <span id="f-name"></span>
                                                                <span id="l-name"></span>
                                                            </h2>
                                                        </div>
                                                        <div class="info"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <div class="card rounded">
                                                    <div class="card-body">
                                                        <div class="mt-3" style="margin-top: 5px !important;">
                                                            <div class="tx-11 font-weight-bold mb-0 ">
                                                                <b>Salutation: </b><p class="text-muted" id="sltatn" style="display: contents"></p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3" style="margin-top: 5px !important;">
                                                            <div class="tx-11 font-weight-bold mb-0 ">
                                                                <b>First Name: </b><p class="text-muted" id="first_name" style="display: contents"></p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3" style="margin-top: 5px !important;">
                                                            <div class="tx-11 font-weight-bold mb-0 ">
                                                                <b>Last Name: </b><p class="text-muted" id="last_name" style="display: contents"></p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3" style="margin-top: 5px !important;">
                                                            <div class="tx-11 font-weight-bold mb-0 ">
                                                                <b>Email: </b><p class="text-muted" id="individual_email" style="display: contents"></p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3" style="margin-top: 5px !important;">
                                                            <div class="tx-11 font-weight-bold mb-0 ">
                                                                <b>Status: </b><p class="text-muted" id="individual_status" style="display: contents"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
<script>
$(document).on('change', '#salutation', function (e) {
    var salutation = $(this).val();
    $("#sltation").text(salutation);
    $("#sltatn").text(salutation);
});
$(document).on('keyup', '#fname', function (e) {
    var fname = $(this).val();
    if (fname) {
        $("#first_name").text(fname);
        $("#f-name").text(fname);
    } else {
        $("#first_name").text('First Name');
    }
});
$(document).on('keyup', '#lname', function (e) {
    var lname = $(this).val();
    if (lname) {
        $("#last_name").text(lname);
        $("#l-name").text(lname);
    } else {
        $("#last_name").text('Last Name');
    }
});
$(document).on('keyup', '#email', function (e) {
    var email = $(this).val();
    if (email) {
        $("#individual_email").text(email);
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/trainer/check_trainer_email') ?>",
            data: {trainer_email: email},
            success: function(response) {
                response = JSON.parse(response);
                if(response.status == 'success') {
                    $('#email_error').fadeIn().html(response.message).css({'color':'green','margin-bottom':'5px'});
                    $("#addTrainerButton").prop("disabled", false);
                } else {
                    $('#email_error').fadeIn().html(response.message).css({'color':'red','margin-bottom':'5px'});
                    setTimeout(function(){
                        $("#passerrormsg").html("");
                    },10000);
                    $("#email").focus();
                    $("#addTrainerButton").prop("disabled", true);
                    return false;
                }
            }
        })
    } else {
        $("#individual_email").text('Email');
    }
});
$(document).on('keyup', '#phone', function (e) {
    var phone = $(this).val();
    if (phone) {
        $("#individual_phone").text(phone);
    } else {
        $("#individual_phone").text('phone');
    }
});
$(document).on('change', '#sport', function (e) {
    var sport = $(this).val();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('admin/users/getSport_byId'); ?>',
        data: {sportId: sport},
        success: function (data) {
            $("#individual_sport").text(data);
        }
    });
});
$(document).on('change', '#userstatus', function (e) {
    var status = $(this).val();
    if (status == 1) {
        $("#individual_status").text('Active');
    }
    if (status == 0) {
        $("#individual_status").text('Inactive');
    }
});
upload_pimage.onchange = evt => {
    const [file] = upload_pimage.files
    if (file) {
        pblah.src = URL.createObjectURL(file)
    }
}
upload_cimage.onchange = evt => {
    const [file] = upload_cimage.files
    if (file) {
        cblah.src = URL.createObjectURL(file)
    }
}
</script>
<script src="<?= base_url() ?>assets/plugins/smt-img-upld/js/singleimage-uploader.js"></script>
<script>
$(document).ready(function () {
    $('#confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#password').focus().css('border', '2px solid green');
            $('#cnfpass_error').html('Password Match').css('color', 'green');
            $('#confirm_password').focus().css('border', '2px solid green');
            document.getElementById('addTrainerButton').disabled = false;
        } else {
            $('#password').focus().css('border', '2px solid red');
            $('#confirm_password').focus().css('border', '2px solid red');
            $('#cnfpass_error').html('Password Mismatch').css('color', 'red');
            document.getElementById('addTrainerButton').disabled = true;
        }
    });
});

$('#country').on('change', function() {
    var country_name = this.value;
    $.ajax({
        url: "<?php echo base_url()?>Home/states_by_country",
        type: "POST",
        data: {
            country_id: country_name
        },
        cache: false,
        success: function(result){
            //console.log(result);
            $("#state").html(result);
            $('#city').html('<option value="">Select State First</option>');
        }
    });
});

$('#state').on('change', function() {
    var state_name = this.value;
    $.ajax({
        url: "<?php echo base_url()?>Home/cities_by_state",
        type: "POST",
        data: {
            state_id: state_name
        },
        cache: false,
        success: function(result){
            $("#city").html(result);
        }
    });
});
</script>