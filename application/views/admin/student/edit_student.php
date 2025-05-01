<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
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
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="card shadow rounded">
                                <div class="card-body">
                                    <form id="submitform" action="<?= base_url('admin/student/edit_student/'.@$result->id)?>" method="POST" enctype="multipart/form-data" >
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Salutation <span style="color:red">*</span></label>
                                            <select class="form-control" name="salutation" id="salutation">
                                                <option value="">Select Salutation</option>
                                                <option value="Mr." <?php if(@$result->salutation == 'Mr.'){echo "selected";}?>>Mr.</option>
                                                <option value="Ms." <?php if(@$result->salutation == 'Ms.'){echo "selected";}?>>Ms.</option>
                                                <option value="Mrs." <?php if(@$result->salutation == 'Mrs.'){echo "selected";}?>>Mrs.</option>
                                                <option value="Mohd." <?php if(@$result->salutation == 'Mohd.'){echo "selected";}?>>Mohd.</option>
                                                <option value="Miss." <?php if(@$result->salutation == 'Miss.'){echo "selected";}?>>Miss.</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">First Name *</label>
                                            <input type="text" class="form-control" name="fname" id="fname" required autocomplete="off" value="<?= @$result->first_name ?>">
                                        </div>
                                        <?php echo form_error('fname', '<small class="" style="color:red;">', '</small>'); ?>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Last Name *</label>
                                            <input type="text" class="form-control" name="lname"  id="lname" required autocomplete="off" value="<?= @$result->last_name ?>">
                                        </div>
                                        <?php echo form_error('lname', '<small class="" style="color:red;">', '</small>'); ?>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Username *</label>
                                            <input type="text" class="form-control" name="username"  id="username" required autocomplete="off" value="<?= @$result->username ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Email *</label>
                                            <input type="email" class="form-control" name="email"  id="email" required autocomplete="off" value="<?= @$result->email ?>">
                                        </div>
                                        <?php echo form_error('email', '<small class="" style="color:red;">', '</small>'); ?>
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold text-black">Gender</label>
                                                    <select class="form-control" name="gender" id="gender">
                                                        <option value="Male" <?php if(@$result->gender == 'Male'){echo "selected";}?>>Male</option>
                                                        <option value="Female" <?php if(@$result->gender == 'Female'){echo "selected";}?>>Female</option>
                                                        <option value="Other" <?php if(@$result->gender == 'Other'){echo "selected";}?>>Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">DOB</label>
                                                    <input type="date" class="form-control" name="dob" id="dob" value="<?= @$result->dob ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Phone *</label>
                                            <input type="text" class="form-control" name="phone"  id="phone" required autocomplete="off" value="<?= @$result->phone ?>">
                                        </div>
                                        <?php echo form_error('phone', '<small class="" style="color:red;">', '</small>'); ?>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Parents First Name</label>
                                            <input type="text" class="form-control" name="pfirst_name" id="pfirst_name"  autocomplete="off" value="<?= @$result->pfirst_name ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Parents Last Name</label>
                                            <input type="text" class="form-control" name="plast_name" id="plast_name"  autocomplete="off" value="<?= @$result->plast_name ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Parents Email</label>
                                            <input type="text" class="form-control" name="pemail" id="pemail"  autocomplete="off" value="<?= @$result->pemail ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Parents Phone Number</label>
                                            <input type="text" class="form-control" name="phone_2" id="phone_2"  autocomplete="off" value="<?= @$result->phone_2 ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Street Address</label>
                                            <input type="text" class="form-control" name="address"  id="address"  autocomplete="off" value="<?= @$result->address ?>">
                                            <input type="hidden" placeholder="Near"  name="latitude" id="latitude" value="<?= @$result->latitude ?>">
                                            <input type="hidden" placeholder="Near" name="longitude" id="longitude" value="<?= @$result->longitude ?>">
                                        </div>
                                        <small id="address_error"></small>
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">Country</label>
                                                    <!-- <input type="text" class="form-control" name="country" id="country" value="<?= @$result->country ?>"> -->
                                                    <select class="form-control form-select" id="country" name="country">
                                                        <option value="">Select Country</option>
                                                        <?php
                                                        $country_list = $this->db->query("SELECT * FROM countries WHERE flag = '1'")->result();
                                                        foreach($country_list as $val) {?>
                                                            <option value="<?php echo $val->id; ?>" <?php if(@$val->id == @$result->country) {echo "selected"; }?>><?php echo $val->name;?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input type="hidden" id="select_country_dropdown" value="<?php echo @$result->country; ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">State</label>
                                                    <select class="form-control" name="state" id="state">
                                                        <option value="">Select Country</option>
                                                    </select>
                                                    <input type="hidden" class="form-control" id="select_state_dropdown" value="<?= @$result->state ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">City</label>
                                                    <select class="form-control" name="city" id="city">
                                                        <option value="">Select State</option>
                                                    </select>
                                                    <input type="hidden" id="select_city_dropdown" value="<?= @$result->city ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">Zipcode</label>
                                                    <input type="text" class="form-control" name="pincode" id="pincode" value="<?= @$result->zipcode ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Background With Degrees</label>
                                            <input type="text" class="form-control" name="degree" id="degree"  autocomplete="off" value="<?= @$result->degree ?>">
                                        </div>
                                        <small id="degree_error"></small>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Languages</label>
                                            <input type="text" class="form-control" name="languages"  id="languages"  autocomplete="off" value="<?= @$result->languages ?>">
                                        </div>
                                        <small id="languages_error"></small>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Certificates</label>
                                            <input type="text" class="form-control" name="certificates" id="certificates"  autocomplete="off" value="<?= @$result->certificates ?>">
                                        </div>
                                        <small id="certificates_error"></small>
                                        <div class="form-group mb-2 files">
                                            <label class="fw-semibold  text-black">Profile Image</label>
                                            <input type="file" class="form-control" name="upload_pimage" id="upload_pimage" >
                                            <input type="hidden" class="form-control" name="old_pimage" value="<?= @$result->image ?>">
                                        </div>
                                        <div class="form-group mb-2 files">
                                            <label class="fw-semibold  text-black">Cover Image</label>
                                            <input type="file" class="form-control" name="upload_cimage" id="upload_cimage">
                                            <input type="hidden" class="form-control" name="old_cimage" value="<?= @$result->coverImage ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Status</label>
                                            <select class="form-control" name="status" required id="userstatus">
                                                <option value="">Select Status</option>
                                                <option value="1" <?php if(@$result->status == '1'){echo "selected";}?>>Active</option>
                                                <option value="0" <?php if(@$result->status == '0'){echo "selected";}?>>Inactive</option>
                                            </select>
                                            <small id="status_error"></small>
                                        </div>
                                        <div class="form-group mt-3 mb-2">
                                            <button class="btn btn-success text-uppercase px-5 shadow" type="submit">Submit</button>
                                            <a class="btn btn-danger waves-effect waves-light m-l-30" href="javascript:history.go(-1)">Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-0">
                            <div class="card shadow rounded">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container">
                                            <div class="col-md-12">
                                                <div class="profile clearfix">
                                                    <div class="image item" id="Cover-Image">
                                                        <img src="<?= !empty($result->coverImage) ? base_url('uploads/student/cover_image/' . $result->coverImage . '') : base_url('uploads/bnr.jpg'); ?>" class="img-cover" id="cblah">
                                                    </div>
                                                    <div class="user clearfix">
                                                        <div class="avatar item" id="item">
                                                            <?php if(!empty($result->image) && file_exists('uploads/student/profilePic/'.$result->image)) { ?>
                                                            <img src="<?= base_url('uploads/student/profilePic/'.$result->image) ?>" class="img-thumbnail img-profile" id="pblah">
                                                            <?php } else { ?>
                                                            <img src="<?= base_url('uploads/unnamed.jpg') ?>" class="img-thumbnail img-profile" id="pblah">
                                                            <?php } ?>
                                                        </div>
                                                        <h2>
                                                            <span id="slttn"><?= $result->salutation; ?></span>
                                                            <span id="f-name"><?= $result->fname; ?></span>
                                                            <span id="l-name"><?= $result->lname; ?></span>
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
                                                            <b>Salutation: </b><p class="text-muted" id="sltatn" style="display: contents"><?= @$result->salutation; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>First Name: </b><p class="text-muted" id="first_name" style="display: contents"><?= @$result->first_name; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Last Name: </b><p class="text-muted" id="last_name" style="display: contents"><?= @$result->last_name; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Email: </b><p class="text-muted" id="individual_email" style="display: contents"><?= @$result->email; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Status: </b><p class="text-muted" id="individual_status" style="display: contents"><?php if($result->status == '1') { echo "Active"; } else { echo "Inactive"; } ?> </p>
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
                </div>
            </section>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    if($('#select_country_dropdown').val() != '') {
        var country_name = $('#select_country_dropdown').val();
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
                $("#state").val(state_name);
            }
        });
    }

    if($('#select_state_dropdown').val() != '') {
        var state_name = $('#select_state_dropdown').val();
        $.ajax({
            url: "<?php echo base_url()?>Home/cities_by_state",
            type: "POST",
            data: {
                state_id: state_name
            },
            cache: false,
            success: function(result){
                console.log(result);
                $("#city").html(result);
                $("#city").val($('#select_city_dropdown').val());
            }
        });
    }
})
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
<script src="<?= base_url() ?>assets/plugins/smt-img-upld/js/singleimage-uploader.js"></script>