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
                                    <form id="submitform" action="<?= base_url('admin/trainer/edit_trainer/'.@$result->id)?>" method="POST" enctype="multipart/form-data" >
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
                                        <div class="form-row mb-3 mt-3">
                                            <div class="form-group col-md-12">
                                                <label class="fw-semibold  text-black">About</label>
                                                <textarea name="about" id="about" class="form-control editor summermote"><?= @$result->about ?></textarea>
                                            </div>
                                        </div>
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
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">Background With Degrees</label>
                                                    <input type="text" class="form-control" name="degree" id="degree"  autocomplete="off" value="<?= @$result->degree ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">Certificates</label>
                                                    <input type="text" class="form-control" name="certificates" id="certificates"  autocomplete="off" value="<?= @$result->certificates ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">Languages</label>
                                                    <input type="text" class="form-control" name="languages"  id="languages"  autocomplete="off" value="<?= @$result->languages ?>">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">Experience</label>
                                                    <input type="text" class="form-control" name="experience"  id="experience"  autocomplete="off" value="<?= @$result->experience ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <div class="panel-body">
                                                <table class="table jobsites" id="purchaseTableclone1">
                                                    <tr class="color">
                                                        <th><label class="fw-semibold text-black">Skills</label></th>
                                                        <th style="text-align: end;"><button type="button" class="btn btn-info addMoreBtn" onclick="add_row()" >Add Skill</button></th>
                                                    </tr>
                                                    <tbody id="clonetable_feedback1">
                                                        <?php if(!empty(@$result->skills)) {
                                                        $skills = unserialize(@@$result->skills);
                                                        $rows=1;
                                                        foreach ($skills as $key) { ?>
                                                        <tr>
                                                            <td style="width: 45%;">
                                                                <input type="text" name="skills[]" id="skills<?= $rows; ?>" class="form-control" value="<?= $key['skills']; ?>">
                                                            </td>
                                                            <td style="width: 45%;">
                                                                <input type="text" name="rating[]" id="rating<?= $rows; ?>" class="form-control" value="<?= $key['rating']; ?>">
                                                            </td>
                                                            <td><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return removeRow(this)">X</a></td>
                                                        </tr>
                                                        <?php } } else { ?>
                                                        <tr>
                                                            <td style="width: 45%;">
                                                                <input type="text" name="skills[]" id="skills1" class="form-control" placeholder="Skill Name">
                                                            </td>
                                                            <td style="width: 45%;">
                                                                <input type="text" name="rating[]" id="rating1" class="form-control" placeholder="Rate (Ex: 91)">
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return removeRow(this)">X</a>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
                                                        <img src="<?= !empty($result->coverImage) ? base_url('uploads/trainer/cover_image/' . $result->coverImage . '') : base_url('uploads/bnr.jpg'); ?>" class="img-cover" id="cblah">
                                                    </div>
                                                    <div class="user clearfix">
                                                        <div class="avatar item" id="item">
                                                            <?php if(!empty($result->image) && file_exists('uploads/trainer/profilePic/'.$result->image)) { ?>
                                                            <img src="<?= base_url('uploads/trainer/profilePic/'.$result->image) ?>" class="img-thumbnail img-profile" id="pblah">
                                                            <?php } else { ?>
                                                            <img src="<?= base_url('uploads/default_profile.jpg') ?>" class="img-thumbnail img-profile" id="pblah">
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
                            <!-- <div class="card shadow rounded">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container">
                                            <div class="col-md-12">
                                                <p style="color:red; margin: 0;" class="" id="validateerrschedule"></p>
                                                <p style="color:red; margin: 0;" class="" id="validateerrschedulefromtime"></p>
                                                <p style="color:red; margin: 0;" class="" id="validateerrscheduletotime"></p>
                                                <p style="color:red; margin: 0;" class="" id="errstartingdate"></p>
                                                <form id="myForm">
                                                    <div class="form-group">
                                                        <h5 class="control-label" style="text-align: center; font-size: 15px;">Weekly Schedule</h5>
                                                        <?php
                                                        date("Y-m-d", strtotime("+1 week"));
                                                        $startDate = date('Y-m');
                                                        $calenderday = $this->db->query("SELECT calender FROM settings WHERE settingId = '1'")->row();
                                                        $data = explode(',', $calenderday->calender);
                                                        $getstart_date = $this->db->query("SELECT * FROM trainer_availability WHERE user_id = '".@$result->id."' ORDER BY `start_date` ASC")->result_array(); ?>
                                                        <div style="display: flex;flex-wrap: nowrap;align-items: baseline;justify-content: space-evenly;margin-bottom: 30px;">
                                                            <label for="timeZone" style="padding: 0;">Current Time Zone <span style="color:red">*</span></label>
                                                            <select id="timeZone" name="timeZone" class="form-control" style="display: flex; width: 300px;">
                                                                <option value="">Select Time Zone</option>
                                                                <?php
                                                                $getTimeZone = $this->db->query("SELECT * FROM timezone WHERE status = 1")->result();
                                                                foreach($getTimeZone as $zone){
                                                                if(!empty($getstart_date)) { ?>
                                                                <option value="<?= @$zone->value?>" <?php if(@$zone->value == @$getstart_date[0]['timeZone']){echo "selected";}?>><?= $zone->name?></option>
                                                                <?php } else { ?>
                                                                <option value="<?= $zone->value?>"><?= $zone->name?></option>
                                                                <?php } } ?>
                                                            </select>
                                                        </div>
                                                        <?php for($i = 0; $i < count($data); $i++) {
                                                        $value = explode('.', $data[$i]);
                                                        $getavailability = $this->db->query("SELECT * FROM trainer_availability WHERE user_id = '".@$result->id."' AND weekday = '".$value[1]."' AND is_datewise = '0' GROUP BY weekday")->result_array();
                                                        if(!empty($getavailability)) {
                                                        foreach ($getavailability as $key => $avail) { ?>
                                                        <div for="<?= $value[1]?>" class="col-12" style="width: 100%; display:inline-block;">
                                                            <div class="icheck-primary col-3" style="display: inline-block; float: left">
                                                                <input type="checkbox" id="checkboxPrimary<?= $value[0]?>" class="chooseday" name="weekDay<?= $value[0]?>" value='<?= $value[1]?>' checked>
                                                                <label for="checkboxPrimary<?= $value[0]?>"> <?= $value[1]?></label>
                                                            </div>
                                                            <div class="form-group date col-9" id="calenderDays<?= $value[0]?>" <?php if ($avail['weekday'] == $value[1]) { echo 'style="display: flex; border: 1px solid;border-radius: 12px;flex-direction: row-reverse; flex-wrap: nowrap; align-items: center; margin-bottom: 15px;"'; } else { echo 'style="display: none; background: #fcddde; border: 1px solid;border-radius: 12px; margin-bottom: 15px;"'; }?>>
                                                                <button type="button" class="btn btn-info addMoreBtn1" id="add_row_<?= $value[0]?>" style=" padding: 5px; margin-right: 8px; width: 28px; height: 28px; display: flex; border-radius: 15px; ">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                                <table class="table jobsites" id="purchaseTableclone<?= $value[0]?>" style="margin: 0;">
                                                                    <tbody id="clonetable_feedback<?= $value[0]?>">
                                                                    <?php
                                                                    $getTimeslot = $this->db->query("SELECT * FROM trainer_availability WHERE user_id = '".@$result->id."' AND weekday = '".$value[1]."' AND is_datewise = '0' GROUP BY weekdayslot")->result_array();
                                                                    foreach ($getTimeslot as $key => $timeslot) { ?>
                                                                        <?php
                                                                        $avail_time = $timeslot['weekdayslot'];
                                                                        $fromTime = explode(' to ', $avail_time); ?>
                                                                        <tr style="box-shadow: none;">
                                                                            <td style=" padding: 0px 0px 0px 5px; border-radius: 5px; "><input type="time" class="form-control getfromtime" name="fromtime<?= $value[0]?>[]" id="fromtime" required value="<?= $fromTime[0]?>"></td>
                                                                            <td><input type="time" class="form-control gettotime" name="totime<?= $value[0]?>[]" id="totime" required value="<?= $fromTime[1]?>"></td>
                                                                            <td><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return remove(<?= $value[0]?>)">X</a></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <?php } } else { ?>
                                                        <div for="<?= $value[1]?>" class="col-12" style="width: 100%; display:inline-block;">
                                                            <div class="icheck-primary col-3" style="display: inline-block; float: left">
                                                                <input type="checkbox" id="checkboxPrimary<?= $value[0]?>" class="chooseday" name="weekDay<?= $value[0]?>" value='<?= $value[1]?>'>
                                                                <label for="checkboxPrimary<?= $value[0]?>"> <?= $value[1]?></label>
                                                            </div>
                                                            <div class="form-group date col-9" id="calenderDays<?= $value[0]?>" style="display: none; border: 1px solid; border-radius: 12px; flex-wrap: nowrap; flex-direction: row-reverse; align-items: center; justify-content: center; margin-bottom: 15px;">
                                                                <button type="button" class="btn btn-info addMoreBtn1" id="add_row_<?= $value[0]?>" style=" padding: 5px; margin-right: 8px; width: 28px; height: 28px; display: flex; border-radius: 15px; ">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                                <table class="table jobsites" id="purchaseTableclone<?= $value[0]?>">
                                                                    <tbody id="clonetable_feedback<?= $value[0]?>">
                                                                        <tr>
                                                                            <td><input type="time" class="form-control getfromtime" name="fromtime<?= $value[0]?>[]" id="fromtime" required></td>
                                                                            <td><input type="time" class="form-control gettotime" name="totime<?= $value[0]?>[]" id="totime" required></td>
                                                                            <td><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return remove(<?= $value[0]?>)">X</a></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <?php } } ?>
                                                    </div>
                                                    <div class="form-group" style="display: flex;">
                                                        <div class="col-12" style=" display: flex; align-items: center; justify-content: space-evenly; ">
                                                            <div class="col-6" style=" display: flex; flex-wrap: nowrap; flex-direction: row; align-items: baseline;">
                                                                <h5 class="control-label" style="font-size: 15px; width: 80px; display: inline-block; float: left;">Start Date</h5>
                                                                <?php
                                                                if(!empty(@$getstart_date[0]['start_date'])) {
                                                                    $date = date('Y-m-d', strtotime(@$getstart_date[0]['start_date']));
                                                                    $val = '1';
                                                                } else {
                                                                    $date = "";
                                                                    $val = '0';
                                                                } ?>
                                                                <input type="text" id="starting_date" class="form-control" name="starting_date" style="background: #fff;padding: 15px;border-radius: 15px;width: 130px;padding: 0;text-align: center;" value="<?= $date?>"/>
                                                            </div>
                                                            <div class="icheck-primary col-6" style="text-align: end;">
                                                                <input type="checkbox" id="repeat_month" name="repeat_month" <?php if(@$getstart_date[0]['repeat_month'] == '1') {echo "checked value='1'"; } else {echo "value='0'"; }?>>
                                                                <label for="repeat_month">Repeat Every Month </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="modal-footer border-top-0 d-flex justify-content-center">
                                                            <input type="button" class="btn btn-success" id="submit-button" value="Save">
                                                            <input type="hidden" name="user_id" id="user_id" value="<?php echo @@$result->id?>">
                                                            <input type="hidden" name="action_id" id="action_id" value="<?php echo @$val; ?>">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $('#about').summernote({
        placeholder: '',
        height: 200
    });
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
    $(function() {
        $("#starting_date").datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            immediateUpdates: true,
            todayHighlight: true,
            startDate:'+0d'
        }).datepicker("setDate", "0");
        $("#specific_date").datepicker({
            multidate: true,
            format: "yyyy-mm-dd",
            immediateUpdates: true,
            todayHighlight: true,
            startDate:'+0d'
        }).datepicker("setDate", "0");
    });

    $("#repeat_month").click(function(){
        if($("#repeat_month").is(':checked')) {
            $("#repeat_month").val("1");
        } else {
            $("#repeat_month").val("0");
        }
    })
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
});

$('#submit-button').on('click', function() {
    var action_id = $('#action_id').val();
    var schedule = $(".chooseday:checked").val();
    var from_time = $('.getfromtime').val().length;
    var to_time = $('.gettotime').val().length;
    var starting_date = $('#starting_date').val().length;
    var timeZone = $("#timeZone").val();
    if (schedule === undefined || schedule.trim() === '') {
        $('#validateerrschedule').text('Please enter schedule');
        setInterval(function () {
            $('#validateerrschedule').empty();
        }, 5000);
    } else if(timeZone === ''){
        $('#validateerrschedule').text('Please enter your timezone');
        setInterval(function () {
            $('#validateerrschedule').empty();
        }, 5000);
    } else if(starting_date === 0){
        $('#validateerrschedule').text('Please enter start date');
        setInterval(function () {
            $('#validateerrschedule').empty();
        }, 5000);
    } else {
        var date1 = new Date('1970-01-01T'+$('.getfromtime').val()+':00');
        var date2 = new Date('1970-01-01T'+$('.gettotime').val()+':00');
        var differenceiInms = date2 - date1;
        var differenceInDays = Math.floor(differenceiInms / (1000 * 60));
        if(differenceInDays > 60) {
            $('#validateerrschedule').text('Please select 60 minutes interval slot');
        } else {
            var form_data = $('#myForm').serialize();
            $.ajax({
                type:"post",
                url:"<?php echo base_url()?>admin/trainer/create_availability",
                data: form_data,
                success:function(returndata) {
                    if(returndata == 1) {
                        $.confirm({
                            title: '',
                            content: "Data added successfuly",
                            buttons: {
                                somethingElse: {
                                    text: 'Ok',
                                    btnClass: 'btn-secondary',
                                    keys: ['enter', 'shift'],
                                    action: function(){
                                        location.reload();
                                    }
                                }
                            }
                        });
                    } else {
                        $.alert({
                            title: '',
                            content: "Something went wrong. Please try again later.",
                        });
                        return false;
                    }
                }
            });
            return false;
        }
    }
})

function updateschedule(slotid) {
    var slotid = slotid;
    alert(slotid);
}

function closeAvail() {
    location.reload();
}

<?php
for($i = 0; $i < count($data); $i++) {
    $value = explode('.', $data[$i]); ?>
    $("#checkboxPrimary<?= $value[0]?>").click(function(){
        if($("#checkboxPrimary<?= $value[0]?>").is(':checked')) {
            $("#calenderDays<?= $value[0]?>").css("display", "flex");
        } else {
            $("#calenderDays<?= $value[0]?>").css("display", "none");
        }
    })
    $("#add_row_<?= $value[0]?>").click(function() {
        var y = document.getElementById('clonetable_feedback<?= $value[0]?>');
        var new_row = y.rows[0].cloneNode(true);
        var len = y.rows.length;
        new_number=Math.round(Math.exp(Math.random()*Math.log(10000000-0+1)))+0;
        var inp0 = new_row.cells[0].getElementsByTagName('input')[0];
        inp0.value = '';
        inp0.id = 'service'+(len+1);
        var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
        inp1.value = '';
        inp1.id = 'service'+(len+1);
        var submit_btn =$('#submit').val();
        y.appendChild(new_row);
    })
<?php } ?>

function remove(row) {
    var y=document.getElementById('purchaseTableclone'+row);
    var len = y.rows.length;
    console.log(len);
    if(len>1) {
        var i= (len-1);
        document.getElementById('purchaseTableclone'+row).deleteRow(i);
    }
}

$("#add_rowdate1").click(function() {
    var y = document.getElementById('clonetable_feedbackdate1');
    var new_row = y.rows[0].cloneNode(true);
    var len = y.rows.length;
    new_number=Math.round(Math.exp(Math.random()*Math.log(10000000-0+1)))+0;
    var inp0 = new_row.cells[0].getElementsByTagName('input')[0];
    inp0.value = '';
    inp0.id = 'service'+(len+1);
    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.value = '';
    inp1.id = 'service'+(len+1);
    var submit_btn =$('#submit').val();
    y.appendChild(new_row);
})

function removesdate1(row) {
    var y=document.getElementById('purchaseTableclonedate1');
    var len = y.rows.length;
    console.log(len);
    if(len>1) {
        var i= (len-1);
        document.getElementById('purchaseTableclonedate1').deleteRow(i);
    }
}

$('#submit_buttonDate').on('click', function() {
    var specificdate = $('#specific_date').val().length;
    var fromtimedate = $('.getfromtimedate').val().length;
    var totimedate = $('.gettotimedate').val().length;
    var timeZone = $("#timeZonedate").val();
    if(specificdate === 0) {
        $('#errspecificdate').text('Please enter starting date');
        setInterval(function () {
            $('#errspecificdate').empty();
        }, 5000);
    } /*else if(fromtimedate === 0){
        $('#errfromtimedate').text('Please enter from time');
        setInterval(function () {
            $('#errfromtimedate').empty();
        }, 5000);
    }*/
    else if(timeZone === ''){
        $('#validateerrschedule').text('Please enter your timezone');
        setInterval(function () {
            $('#validateerrschedule').empty();
        }, 5000);
    } else if(totimedate === 0){
        $('#errtotimedate').text('Please enter to time');
        setInterval(function () {
            $('#errtotimedate').empty();
        }, 5000);
    } else {
        var form_datadate = $('#myDateform').serialize();
        $.ajax({
            type:"post",
            url:"<?php echo base_url()?>admin/trainer/create_availability",
            data: form_datadate,
            success:function(returndata) {
                if(returndata == 1) {
                    $.confirm({
                        title: '',
                        content: "Data added successfuly",
                        buttons: {
                            somethingElse: {
                                text: 'Ok',
                                btnClass: 'btn-secondary',
                                keys: ['enter', 'shift'],
                                action: function(){
                                    location.reload();
                                }
                            }
                        }
                    });
                } else {
                    $.alert({
                        title: '',
                        content: "Something went wrong. Please try again later.",
                    });
                    return false;
                }
            }
        });
        return false;
    }
})

function deletedata(id) {
    var slotid = id;
    $.confirm({
        title: 'Confirm!',
        content: confirmTextDelete,
        buttons: {
            confirm: function () {
            var base_url = $('#base_url').val();
            $.ajax({
                url: "<?php echo base_url()?>user/Dashboard/deletedatewiseavailability",
                method:"POST",
                data: {slotid: slotid},
                beforeSend : function(){
                    $("#loader").show();
                },
                success:function(data) {
                    if (data == '1'){
                        $.confirm({
                            title: '',
                            content: "You already have a booking for this slot",
                            buttons: {
                                somethingElse: {
                                    text: 'Ok',
                                    btnClass: 'btn-secondary',
                                    keys: ['enter', 'shift'],
                                    action: function(){
                                        location.reload();
                                    }
                                }
                            }
                        });
                    } else if(data == '2') {
                        $.confirm({
                            title: '',
                            content: "Data deleted successfuly",
                            buttons: {
                                somethingElse: {
                                    text: 'Ok',
                                    btnClass: 'btn-secondary',
                                    keys: ['enter', 'shift'],
                                    action: function(){
                                        location.reload();
                                    }
                                }
                            }
                        });
                    } else {
                        $.alert({
                            title: '',
                            content: "Something went wrong. Please try again later.",
                        });
                        return false;
                    }
                }
            })
            },
            cancel: function () {
                location.reload();
            },
        }
    });
}

let rowCount = 1;

function add_row() {
    rowCount++;
    const table = document.getElementById("clonetable_feedback1");
    const row = table.insertRow();
    row.innerHTML = `<td style="width: 45%;"><input type="text" name="skills[]" id="skills${rowCount}" class="form-control" placeholder="Skill Name"></td><td style="width: 45%;"><input type="text" name="rating[]" id="rating${rowCount}" class="form-control" placeholder="Rate (Ex: 91)"></td><td><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return removeRow(this)">X</a></td>`;
}

function removeRow(element) {
    const row = element.parentElement.parentElement;
    row.remove();
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