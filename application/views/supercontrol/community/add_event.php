<?php //$this->load->view ('header');?>
<style type="text/css">
label { width: 125px; display: block; float: left; }
label input { display: none; }
label span { display: block; width: 17px; height: 17px; border: 1px solid black; float: left; margin: 0 5px 0 0; position: relative; }
label.active span:after { content: " "; position: absolute; left: 3px; right: 3px; top: 3px; bottom: 3px; background: black; }
.topul li { list-style-type: none; }
</style>
<?php
$url = $_SERVER['REQUEST_URI'];
$url = explode('/', $url);
$comm_id = $url[5];
?>
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
                    <li>
                        <a href="<?php echo base_url(); ?>supercontrol/user/dashboard">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li> <span>Admin panel</span> </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-body form">
                                        <!-- BEGIN FORM-->
                                        <form action="<?php echo base_url().'supercontrol/community/add_event/'.@$event->community_id.'/'.@$event->id?>" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="check()">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Event Title *</b></label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="frm[event_title]" required="" id="event_title" class="form-control" placeholder="Event Title" onkeyup="leftTrim(this)" value="<?= $event->event_title ?>"/>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Event From Date *</b></label>
                                                    <div class="col-md-8">
                                                        <input type="date" name="frm[event_from_date]" value="<?= @$event->event_from_date ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter From Date" required>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Event From Time *</b></label>
                                                    <div class="col-md-8">
                                                    <input type="time" name="frm[event_from_time]" value="<?= @$event->event_from_time ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter From Time" required>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Event To Date *</b></label>
                                                    <div class="col-md-8">
                                                    <input type="date" name="frm[event_to_date]" value="<?= @$event->event_to_date ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter To Date" required>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Event To Time *</b></label>
                                                    <div class="col-md-8">
                                                    <input type="time" name="frm[event_to_time]" value="<?= @$event->event_to_time ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter To Date" required>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Event Repeat *</b></label>
                                                    <div class="col-md-8">
                                                        <select name="frm[event_repeat]" class="form-control" required>
                                                                <option value="">Select option</option>
                                                                <option value="Does not repeat" <?php if (@$event->event_repeat == 'Does not repeat') { echo 'selected';} ?>>Does not repeat</option>
                                                                <option value="Daily" <?php if (@$event->event_repeat == 'Daily') { echo 'selected';} ?>>Daily</option>
                                                                <option value="Weekly" <?php if (@$event->event_repeat == 'Weekly') { echo 'selected';} ?>>Weekly</option>
                                                                <option value="Monthly" <?php if (@$event->event_repeat == 'Monthly') { echo 'selected';} ?>>Monthly</option>
                                                                <option value="Yearly" <?php if (@$event->event_repeat == 'Yearly') { echo 'selected';} ?>>Yearly</option>
                                                            </select>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Event Description</b></label>
                                                    <div class="col-md-8">
                                                        <textarea id="pagedes" class="form-control" name="frm[event_description]" cols="60" rows="10" aria-hidden="true"><?= $event->event_description ?></textarea>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Status</b></label>
                                                    <div class="col-md-8">
                                                        <select name="frm[event_status]" class="form-control">
                                                            <option value="">Select option</option>
                                                            <option value="1" <?php if (@$event->event_status == '1') { echo 'selected';} ?>>Active</option>
                                                            <option value="0" <?php if (@$event->event_status == '0') { echo 'selected';} ?>>Inactive</option>
                                                        </select>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <input type="submit" id="submit" value="Submit" class="btn red">
                                                        <input type="hidden" name="frm[community_id]" value="<?= $comm_id?>">
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