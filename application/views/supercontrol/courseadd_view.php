<?php //$this->load->view ('header');?>
<style type="text/css">
label { width: 125px; display: block; float: left; }
label input { display: none; }
label span { display: block; width: 17px; height: 17px; border: 1px solid black; float: left; margin: 0 5px 0 0; position: relative; }
label.active span:after { content: " "; position: absolute; left: 3px; right: 3px; top: 3px; bottom: 3px; background: black; }
.topul li { list-style-type: none; }
</style>
<div class="page-container">
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <?php $this->load->view('supercontrol/leftbar'); ?>
        </div>
    </div>
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li> <a href="<?php echo base_url(); ?>supercontrol/user/dashboard">Home</a> <i
                            class="fa fa-circle"></i>
                    </li>
                    <li> <span>Admin panel</span> </li>
                </ul>
            </div>
            <?php 
            if (@$success_msg != '') {
                $msg = $success_msg;
            }
            $last = end($this->uri->segments);
            if ($last == "success") {
                $msg = "course Added Successfully ......";
            }
            if ($last == "successdelete") {
                $msg = "course Deleted Successfully ......";
            }
            ?>

            <?php if (@$msg != '') { ?>
            <div class="alert alert-success alert-dismissable" style="padding:10px;">
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
                <strong><?= @$msg;?></strong>
            </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i>Add course</div>
                                        <div class="tools"> 
                                            <a href="javascript:;" class="reload"> </a> 
                                            <a href="javascript:;" class="remove"> </a> 
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <!-- BEGIN FORM-->
                                        <form action="<?php echo base_url().'supercontrol/course/add_my_course'?>" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="check()">
                                            <div class="form-body">
                                                <div class="form-group"> 
                                                    <label class="col-md-3 control-label"><b>Course Category *</b></label>
                                                    <div class="col-md-8">
                                                        <select name="cat_id" class="form-control">
                                                            <option value="">Choose</option>
                                                            <?php foreach ($allcat as $ac) { ?>
                                                            <option value="<?php echo $ac->id ?>"> <?php echo $ac->category_name ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Course Mode *</b></label>
                                                    <div class="col-md-8">
                                                        <select name="mode_id" class="form-control">
                                                            <option>Choose</option>
                                                            <?php if (is_array($modes) && count($modes) > 0) {
                                                            foreach ($modes as $mo) { ?>
                                                            <option value="<?= $mo->id ?>"> <?= $mo->mode_title ?> </option>
                                                            <?php } } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Course Level *</b></label>
                                                    <div class="col-md-8">
                                                        <select name="level_id" class="form-control">
                                                            <option>Choose</option>
                                                            <?php if (is_array($levels) && count($levels) > 0) {
                                                            foreach ($levels as $lv) { ?>
                                                            <option value="<?= $lv->id ?>"> <?= $lv->level_title ?> </option>
                                                            <?php } } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group"> 
                                                    <label class="col-md-3 control-label"><b>Course Name *</b></label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="title" required="" id="title" class="form-control" placeholder="Course Name" onkeyup="leftTrim(this)" />
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group"> 
                                                    <label class="col-md-3 control-label"><b>Heading 1 *</b></label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="heading_1" required="" id="title" class="form-control" placeholder="Heading 1" onkeyup="leftTrim(this)" />
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group"> 
                                                    <label class="col-md-3 control-label"><b>Heading 2 *</b></label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="heading_2" required="" id="title" class="form-control" placeholder="Heading 2" onkeyup="leftTrim(this)" />
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Description</b></label>
                                                    <div class="col-md-8">
                                                        <textarea id="pagedes" class="form-control" name="description" cols="60" rows="10" aria-hidden="true"></textarea>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Program Overview</b></label>
                                                    <div class="col-md-8">
                                                        <textarea id="pagedes" class="form-control" name="program_overview" cols="60" rows="10" aria-hidden="true"></textarea>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Objectives</b></label>
                                                    <div class="col-md-8">
                                                        <textarea id="pagedes" class="form-control" name="objectives" cols="60" rows="10" aria-hidden="true"></textarea>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Curriculam</b></label>
                                                    <div class="col-md-8">
                                                        <textarea id="pagedes" class="form-control" name="curriculam" cols="60" rows="10" aria-hidden="true"></textarea>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Career Paths</b></label>
                                                    <div class="col-md-8">
                                                        <textarea id="pagedes" class="form-control" name="career_paths" cols="60" rows="10" aria-hidden="true"></textarea>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group"> 
                                                    <label class="col-md-3 control-label"><b>Duration *</b></label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="duration" required="" id="duration" class="form-control" placeholder="Duration" onkeyup="leftTrim(this)" />
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Course Fees *</b></label>
                                                    <div class="col-md-8">
                                                        <select name="course_fees" class="form-control" id="course_fees" required>
                                                            <option>Choose</option>
                                                            <option value="free" <?php if (@$course->course_type == 'free') { echo "selected"; } ?>>Free</option>
                                                            <option value="paid" <?php if (@$course->course_type == 'paid') { echo "selected"; } ?>>Paid</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="courseTypefield">
                                                    <div class="form-group"> 
                                                        <label class="col-md-3 control-label"><b>Course Price(In $)</b></label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="price" id="price" class="form-control price" placeholder="Course Price (In $)" onkeyup="leftTrim(this)" />
                                                            <label id="errorBox"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group"> 
                                                        <label class="col-md-3 control-label"><b>Price ID (Stripe Price ID)</b></label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="price_key" id="price_key" class="form-control price_key" placeholder="Price ID (Stripe Price ID)" onkeyup="leftTrim(this)" />
                                                            <label id="errorBox"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group"> 
                                                    <label class="col-md-3 control-label"><b>Course Type *</b></label>
                                                    <div class="col-md-8">
                                                        <select name="course_type" class="form-control">
                                                            <option value="">Choose</option>
                                                            <option value="Upcoming Courses">Upcoming Courses</option>
                                                            <option value="Coming Soon Courses">Coming Soon Courses</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Course Certificate *</b></label>
                                                    <div class="col-md-8">
                                                        <select name="course_certificate" class="form-control">
                                                            <option value="">Choose</option>
                                                            <option value="Certificate of Completion">Certificate of Completion</option>
                                                            <option value="Certificate of Attendance">Certificate of Attendance</option>
                                                            <option value="BOTH">BOTH</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group"> 
                                                    <label class="col-md-3 control-label"><b>Entry Requirement</b></label>
                                                    <div class="col-md-8">
                                                        <input type="text" required="" name="requirement" id="requirement" class="form-control" placeholder="Entry Requirement Details" />
                                                    </div>
                                                </div>
                                                <div class="form-group"> 
                                                    <label class="col-md-3 control-label"><b>Who should Attend</b></label>
                                                    <div class="col-md-8">
                                                        <input type="text" required="" name="attended" id="attended" class="form-control" placeholder="Entry Requirement Details" />
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div id="education_fields"></div>
                                                <div id="startdate"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3"><b>Course Image</b></label>
                                                <div class="col-md-9">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> 
                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> 
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                        <div> 
                                                            <span class="btn default btn-file"> 
                                                                <span class="fileinput-new"> Select image </span> 
                                                                <span class="fileinput-exists"> Change </span>
                                                                <?php
                                                                $file = array('type' => 'file', 'name' => 'userfile', 'onchange' => 'readURL(this);');
                                                                echo form_input($file);
                                                                ?>
                                                            </span> 
                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix margin-top-10"> <span class="label label-danger">Format</span> jpg, jpeg, png, gif </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><b>Status</b></label>
                                                <div class="col-md-8">
                                                    <select name="status" class="form-control">
                                                        <option value="">Choose</option>
                                                        <option <?php if (@$course->status == 1) { echo "selected"; } ?> value="1">Active</option>
                                                        <option <?php if (@$course->status == 0) { echo "selected"; } ?>value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <input type="submit" id="submit" value="Submit" class="btn red">
                                                        <button type="button" class="btn default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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

<style>
#errorBox {color: #F00;}
#tab_0 {display: block !important;}
.courseTypefield {display: none;}
</style>
<!-- <script src="<?php echo base_url(); ?>js/jquery.datetimepicker.full.js"></script> -->
<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
<script>
$(document).ready(function () {
    var selectedCourseType = $('#course_fees').val();
    if (selectedCourseType == 'free') {
        $('.courseTypefield').hide();
        $('.price').val('');
        $('.price_key').val('');
        $('.price').prop('required', false);
        $('.price_key').prop('required', false);
    } else if (selectedCourseType == 'paid') {
        $('.courseTypefield').show();
        $('.price').prop('required', true);
        $('.price_key').prop('required', true);
    } else {
        $('.courseTypefield').hide();
        $('.price').prop('required', false);
        $('.price_key').prop('required', false);
    }
});

$('#course_fees').change(function () {
    var selectedOption = $(this).val(); //alert(selectedOption);
    if (selectedOption == 'free') {
        $('.courseTypefield').hide();
        $('.price').val('');
        $('.price_key').val('');
        $('.price').prop('required', false);
        $('.price_key').prop('required', false);
    } else if (selectedOption == 'paid') {
        $('.courseTypefield').show();
        $('.price').prop('required', true);
        $('.price_key').prop('required', true);
    } else {
        $('.courseTypefield').hide();
        $('.price').prop('required', false);
        $('.price_key').prop('required', false);
    }
})
</script>
<?php //$this->load->view ('footer');?>