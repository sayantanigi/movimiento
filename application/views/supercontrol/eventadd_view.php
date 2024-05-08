<style type="text/css">
.datepicker .active {background-color: #fff !important;}
.datepicker {color: #333;}
.datepicker .active:hover {background-color: #fff !important;}
.datepicker--day-name {color: #67809f !important; font-weight: 600 !important;}
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
                    <li> <a href="">Home</a> <i class="fa fa-circle"></i> </li>
                    <li> <span>Instructor panel</span> </li>
                </ul>
            </div>
            <?php if (isset($success_msg)) {
                echo $success_msg;
            } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i>Add Events</div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form action="<?php echo base_url() . 'supercontrol/event/add_event' ?>"
                                            class="form-horizontal form-bordered" method="post"
                                            enctype="multipart/form-data">
                                            <div class="form-body">
                                                <div class="form-group last">
                                                    <label class="control-label col-md-3">Event Image</label>
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
                                                                    $file = array('id' => 'event', 'type' => 'file', 'name' => 'userfile', 'onchange' => 'readURL(this);');
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
                                                    <label class="control-label col-md-3">Course Name</label>
                                                    <div class="col-md-8">
                                                        <select name="course_id" class="form-control">
                                                            <option value="">Choose option</option>
                                                            <?php if(!empty($course_list)) { 
                                                            foreach ($course_list as $cList) { ?>
                                                            <option value="<?= @$cList['id']?>"><?= @$cList['title']?></option>
                                                            <?php } } else { ?>
                                                            <option value="">No data found</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Event Name</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="event_name" value="" class="form-control" id="event_name" placeholder="Enter First Name">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Event Description</label>
                                                    <div class="col-md-8">
                                                        <textarea name="event_desc" class="form-control" id="event_desc" placeholder="Enter Event Description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Event Date</label>
                                                    <div class="col-md-8">
                                                        <input type='text' class="form-control" id='datepicker' name="event_dt" value=""/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">From Time</label>
                                                    <div class="col-md-8">
                                                        <input type="time" name="from_time" value="" class="form-control" id="from_time">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">To Time</label>
                                                    <div class="col-md-8">
                                                        <input type="time" name="to_time" value="" class="form-control" id="to_time">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Event Mode</label>
                                                    <div class="col-sm-8">
                                                        <select name="event_mode" id="event_mode" class="form-control">
                                                            <option value="">Choose option</option>
                                                            <option value="online">Online </option>
                                                            <option value="offline">Offline </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group checkforLink">
                                                    <label class="control-label col-md-3">Event Meeting Link</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="event_link" value="" class="form-control" id="event_link" placeholder="Meeting Link">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Event Level</label>
                                                    <div class="col-sm-8">
                                                        <select name="event_level" id="event_level" class="form-control">
                                                            <option value="">Choose option</option>
                                                            <option value="Upcoming">Upcoming </option>
                                                            <option value="Complete">Complete </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group checkforUpload">
                                                    <label class="control-label col-md-3">Upload Event Video</label>
                                                    <div class="col-md-8">
                                                        <input type="file" class="form-control" name="videos_file" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Event Type</label>
                                                    <div class="col-sm-8">
                                                        <select name="event_type" id="event_type" class="form-control">
                                                            <option value="">Choose option</option>
                                                            <option value="free">Free </option>
                                                            <option value="paid">Paid </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="eventTypeForm">
                                                    <div class="form-group">
                                                    <label class="control-label col-md-3">Event Price</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="event_price" value="" class="form-control" id="event_price" placeholder="Event Price">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Price Key</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="price_key" value="" class="form-control" id="price_key" placeholder="Price Key">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Status</label>
                                                    <div class="col-md-8">
                                                    <select name="status" class="form-control">
                                                        <option value="">Choose option</option>
                                                        <option value="1">Active </option>
                                                        <option value="2">Inactive </option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
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
<?php //$this->load->view ('footer');?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<style>
.eventTypeForm {display: none;}
.checkforLink {display: none;}
.checkforUpload {display: none;}
</style>
<script>
CKEDITOR.replace('event_desc');
$(function() {
    var $j = jQuery.noConflict();
    $("#datepicker").datepicker();
});

// $('INPUT[type="file"]').change(function () {
//     var ext = this.value.match(/\.(.+)$/)[1];
//     switch (ext) {
//         case 'jpg':
//         case 'jpeg':
//         case 'png':
//         case 'gif':
//             $('#banner').attr('disabled', false);
//             break;
//         default:
//             alert('This is not an allowed file type.');
//             this.value = '';
//     }
// });
$(function() {
    $('#event_type').change(function() {
        var type = $(this).val();
        if(type == 'paid'){
            $('.eventTypeForm').show();
            $('#event_price').attr('required', true);
            $('#price_key').attr('required', true);
        } else if(type == 'free') {
            $('.eventTypeForm').hide();
            $('#event_price').attr('required', false);
            $('#event_price').val('0');
            $('#price_key').attr('required', false);
            $('#price_key').val('');
        } else {
            $('.eventTypeForm').hide();
            $('#event_price').attr('required', false);
            $('#event_price').val('');
            $('#price_key').attr('required', false);
            $('#price_key').val('');
        }
    })

    $('#event_mode').change(function() {
        var type = $(this).val();
        if(type == 'online') {
            $('.checkforLink').show();
            $('#event_link').attr('required', true);
        } else if(type == 'offline') {
            $('.checkforLink').hide();
            $('#event_link').attr('required', false);
        } else {
            $('.checkforLink').hide();
            $('#event_link').attr('required', false);
        }
    })

    $('#event_level').change(function() {
        var type = $(this).val();
        if(type == 'Complete') {
            $('.checkforUpload').show();
            $('.checkforLink').hide();
            $('#event_link').attr('required', false);
        } else if(type == 'Upcoming') {
            $('.checkforUpload').hide();
            $('.checkforLink').show();
            $('#event_link').attr('required', true);
        } else {
            $('.checkforUpload').hide();
            $('#event_link').attr('required', true);
        }
    })
});
</script>