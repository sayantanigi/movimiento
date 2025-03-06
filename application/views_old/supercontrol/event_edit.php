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
                    <li> <a href="index.html">Home</a> <i class="fa fa-circle"></i> </li>
                    <li> <span>Instructor Panel</span> </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i>Event Edit</div>
                                    </div>
                                    <div class="portlet-body form">
                                        <?php foreach ($eevent as $i) { ?>
                                            <form method="post" class="form-horizontal form-bordered" action="<?php echo base_url() ?>supercontrol/event/edit_event" enctype="multipart/form-data">
                                                <div class="form-body">
                                                    <input type="hidden" name="event_id" value="<?= $i->id; ?>">
                                                    <input type="hidden" name="event_image" value="<?php echo $i->event_img; ?>">
                                                    <div class="form-group last">
                                                        <label class="control-label col-md-3">Image</label>
                                                        <div class="col-md-9">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                    <?php if ($i->event_img == '') { ?>
                                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                                    <?php } else { ?>
                                                                    <img src="<?php echo base_url() ?>/uploads/event/<?php echo $i->event_img; ?>" alt="" />
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                <div> <span class="btn default btn-file"> 
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
                                                        <label class="control-label col-md-3">Course Name</label>
                                                        <div class="col-md-8">
                                                            <select name="course_id" class="form-control">
                                                                <option value="">Choose option</option>
                                                                <?php if(!empty($course_list)) { 
                                                                foreach ($course_list as $cList) { ?>
                                                                <option value="<?= @$cList['id']?>" <?php if($i->course_id == $cList['id']) { echo "selected";}?>><?= @$cList['title']?></option>
                                                                <?php } } else { ?>
                                                                <option value="">No data found</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Event Name</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="event_name" value="<?php echo $i->event_name; ?>" name="event_name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Description</label>
                                                        <div class="col-md-8">
                                                            <textarea rows="10" cols="10" id="pagedes" name="event_desc"><?php echo $i->event_desc; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Event Date</label>
                                                        <div class="col-md-8">
                                                            <input type='text' class="form-control" id='datepicker' name="event_dt" value="<?= @$i->event_dt ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">From Time</label>
                                                        <div class="col-md-8">
                                                            <input type="time" name="from_time" value="<?= @$i->from_time ?>" class="form-control" id="from_time">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">To Time</label>
                                                        <div class="col-md-8">
                                                            <input type="time" name="to_time" value="<?= @$i->to_time ?>" class="form-control" id="to_time">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Event Mode</label>
                                                        <div class="col-sm-8">
                                                            <select name="event_mode" id="event_mode" class="form-control">
                                                                <option value="">Choose option</option>
                                                                <option value="online" <?= (@$i->event_mode == 'online') ? 'selected' : ''; ?>>Online </option>
                                                                <option value="offline" <?= (@$i->event_mode == 'offline') ? 'selected' : ''; ?>>Offline </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <div class="form-group checkforLink" style="display: <?php if($i->event_mode == "online") {echo "block";} else {echo "none";}?>">
                                                        <label class="control-label col-md-3">Event Meeting Link</label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="event_link" value="<?= @$i->event_link ?>" class="form-control" id="event_link" placeholder="Meeting Link">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Event Level</label>
                                                        <div class="col-sm-8">
                                                            <select name="event_level" id="event_level" class="form-control">
                                                                <option value="">Choose option</option>
                                                                <option value="Upcoming" <?= (@$i->event_level == 'Upcoming') ? 'selected' : ''; ?>>Upcoming </option>
                                                                <option value="Complete" <?= (@$i->event_level == 'Complete') ? 'selected' : ''; ?>>Complete </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group checkforUpload" style="display: <?php if($i->event_level == "Complete") {echo "block";} else {echo "none";}?>">
                                                        <?php if(empty($i->video_file)) { ?>
                                                        <label class="control-label col-md-3">Upload Event Video</label>
                                                        <div class="col-md-8">
                                                        <?php } else { ?>
                                                        <label class="control-label col-md-3">Update Event Video</label>
                                                        <div class="col-md-7">
                                                        <?php } ?>
                                                            <input type="file" class="form-control" name="videos_file" />
                                                            <input type="hidden" id="old_video" value="<?= $i->video_file; ?>"/>
                                                            <?php if(!empty($i->video_file)) { ?>
                                                            <video src="<?= base_url()?>uploads/event/videos_file/<?= $i->video_file; ?>" controls style="width: 320px; margin-top: 5px;"></video>
                                                            <?php }  ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Event Type</label>
                                                        <div class="col-sm-8">
                                                            <select name="event_type" id="event_type" class="form-control">
                                                                <option value="">Choose option</option>
                                                                <option value="free" <?= (@$i->event_type == 'free') ? 'selected' : ''; ?>>Free </option>
                                                                <option value="paid" <?= (@$i->event_type == 'paid') ? 'selected' : ''; ?>>Paid </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="eventTypeForm" style="display:<?php if($i->event_type == 'paid') {echo "block";} else {echo "none";}?>">
                                                        <div class="form-group">
                                                        <label class="control-label col-md-3">Event Price</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="event_price" value="<?= @$i->event_price ?>" class="form-control" id="event_price" placeholder="Event Price">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Price Key</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="price_key" value="<?= @$i->price_key ?>" class="form-control" id="price_key" placeholder="Price Key">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Status</label>
                                                        <div class="col-md-8">
                                                        <select name="status" class="form-control">
                                                            <option value="">Choose option</option>
                                                            <option value="1" <?= (@$i->status == 1) ? 'selected' : ''; ?>>Active </option>
                                                            <option value="2" <?= (@$i->status == 2) ? 'selected' : ''; ?>>Inactive </option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <input type="submit" class="btn red" id="submit" value="Submit" name="update">
                                                            <button class="btn default" type="button">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php } ?>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
.eventTypeForm {display: none;}
.checkforLink {display: none;}
.checkforUpload {display: none;}
</style>
<script type="text/javascript">
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