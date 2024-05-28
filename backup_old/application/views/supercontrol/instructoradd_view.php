<?php 
//$this->load->view ('header');?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.datetimepicker.css" />
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
                    <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i> </li>
                    <li> <span>supercontrol panel</span> </li>
                </ul>
            </div>
            <div class="alert alert-success alert-dismissable" style="padding:10px;">
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
                <strong>
                    <?php
                    $last = end($this->uri->segments);
                    if ($last == "success") {
                        echo "Data Added Successfully ......";
                    }
                    if ($last == "successdelete") {
                        echo "Data Deleted Successfully ......";
                    }
                    ?>
                    <?php if ($this->session->flashdata('success') != '') { ?>
                    <div class="alert alert-success text-center">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } ?>
                </strong>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"><i class="fa fa-gift"></i>Add Instructor</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"></a>
                                            <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                            <a href="javascript:;" class="reload"></a>
                                            <a href="javascript:;" class="remove"></a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form action="<?php echo base_url().'supercontrol/course/add_course_instructor'?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Select Course *</b></label>
                                                    <div class="col-md-8">
                                                        <select name="course_idd" class="form-control" required>
                                                            <option value="">Select Course Name</option>
                                                            <?php foreach ($course as $c) { ?>
                                                            <option value="<?php echo $c->course_id ?>"><?php echo ucwords($c->course_name); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Select Instructor *</b></label>
                                                    <div class="col-md-8">
                                                        <select name="instructor_id" class="form-control" required>
                                                            <option value="">Select Instructor's Name</option>
                                                            <?php foreach ($inst as $ac) { ?>
                                                                <option value="<?php echo $ac->member_id ?>"><?php echo ucwords($ac->first_name." ".$ac->last_name); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Select Course Mode *</b></label>
                                                    <div class="col-md-8">
                                                        <select name="mode_id" class="form-control" required>
                                                            <option value="">Select Mode of Training</option>
                                                            <?php foreach ($mode as $m) { ?>
                                                                <option value="<?php echo $m->id ?>"><?php echo ucwords($m->mode_title); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Class Date</label>
                                                    <div class="col-md-8">
                                                        <?php echo form_input(array('id' => 'datetimepicker2', 'name' => 'class_date', 'type' => 'text', 'class' => 'form-control')); ?>
                                                        <?php //echo form_error('cms_heading'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Start Time</label>
                                                    <div class="col-md-8">
                                                        <?php echo form_input(array('id' => 'timepicker1', 'name' => 'start_time', 'class' => 'form-control')); ?>
                                                        <?php //echo form_error('cms_sub_heading'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">End Time</label>
                                                    <div class="col-md-8">
                                                        <?php echo form_input(array('id' => 'timepicker2', 'name' => 'end_time', 'class' => 'form-control')); ?>
                                                        <?php //echo form_error('description'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                                                        <!-- <input type="hidden" name="course_id" value="<?php echo @end($this->uri->segment_array()); ?>" /> -->
                                                        <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit', 'class' => 'btn red')); ?>
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
<script src="<?php echo base_url(); ?>js/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.datetimepicker.full.js"></script>
<script>
$.datetimepicker.setLocale('en');
$('#timepicker1').datetimepicker({
    datepicker: false,
    format: 'H:i',
    step: 5
});
$('#timepicker2').datetimepicker({
    datepicker: false,
    format: 'H:i',
    step: 5
});
$('#datetimepicker2').datetimepicker({
    format: 'd-m-Y',
    timepicker: false,
    formatDate: 'd-m-Y',
    minDate: '-2016/11/03', // yesterday is minimum date
});
$('#datetimepicker_dark').datetimepicker({ theme: 'dark' })
</script>
<?php //$this->load->view ('footer');?>