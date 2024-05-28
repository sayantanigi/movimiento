<style>
#sample_1_filter {padding: 8px;float: right;}
#sample_1_length {padding: 8px;}
#sample_1_info {padding: 8px;}
#sample_1_paginate {float: right;padding: 8px;}
#loader {display: none;position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%);z-index: 9999;}
</style>
<div id="loader"><img src="<?= base_url()?>loader.webp" style="width: 50px; background: #000;"></div>
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
                    <li> <a href="<?php echo base_url(); ?>user/dashboard">Home</a> <i class="fa fa-circle"></i> </li>
                    <li> <span>Instructor Panel</span> <i class="fa fa-circle"></i> </li>
                    <li> <span>Show Event </span> </li>
                </ul>
            </div>
            <?php if (isset($success_msg)) {
                echo $success_msg;
            } ?>
            <div class="row">
                <?php if ($this->session->flashdata('success_add') != '') { ?>
                <div class="alert alert-success alert-dismissable" style="padding:10px;">
                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
                    <strong>
                        <?php echo $this->session->flashdata('success_add'); ?>
                    </strong>
                </div>
                <?php } ?>
                <?php if ($this->session->flashdata('success_update') != '') { ?>
                <div class="alert alert-success alert-dismissable" style="padding:10px;">
                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
                    <strong>
                        <?php echo $this->session->flashdata('success_update'); ?>
                    </strong>
                </div>
                <?php } ?>
                <?php if ($this->session->flashdata('success_delete') != '') { ?>
                <div class="alert alert-success alert-dismissable" style="padding:10px;">
                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
                    <strong>
                        <?php echo $this->session->flashdata('success_delete'); ?>
                    </strong>
                </div>
                <?php } ?>
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i>Show CMS</div>
                                        <div class="tools"> 
                                            <a href="javascript:;" class="collapse"> </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a> 
                                            <a href="javascript:;" class="reload"> </a>
                                            <a href="javascript:;" class="remove"> </a> 
                                        </div>
                                    </div>
                                    <div class="portlet-body form" style="padding:5px;">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                                            <thead>
                                                <tr>
                                                    <th width="10" style="max-width:200px;">Sl No.</th>
                                                    <th class="hidden-480">Event Image</th>
                                                    <th class="hidden-480">Event Name</th>
                                                    <th class="hidden-480">Event Date Time</th>
                                                    <th class="hidden-480">Event Mode</th>
                                                    <th class="hidden-480">Event Level</th>
                                                    <th class="hidden-480">Meeting Link</th>
                                                    <th class="hidden-480">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $c = 1;
                                                if (is_array($event)) {
                                                foreach (@$event as $i) { ?>
                                                <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                                                    <td class="hidden-480" style="max-width:200px;">
                                                        <?php echo $c; ?>
                                                    </td>
                                                    <td  class="hidden-480">
                                                    <?php if ($i->event_img == "") { ?>
                                                        No Image
                                                    <?php } else { ?>
                                                        <img src="<?php echo base_url() ?>/uploads/event/<?php echo $i->event_img; ?>" width="100" height="100" style="border: 2px solid #ddd;"/>
                                                    <?php } ?>
                                                    </td>
                                                    <td class="hidden-480"><?php echo $i->event_name; ?></td>
                                                    <td><?= date('h:i A', strtotime($i->from_time))." to ".date('h:i A', strtotime($i->to_time))." on ".date('jS M Y', strtotime($i->event_dt)); ?></td>
                                                    <td class="hidden-480"><?php echo $i->event_mode; ?></td>
                                                    <td class="hidden-480">
                                                        <?php 
                                                        $nowdate = strtotime(date("Y-m-d"));
                                                        $event_date = date("Y-m-d", strtotime($i->event_dt));
                                                        $eventDate = strtotime($event_date);
                                                        if($eventDate >= $nowdate) {
                                                            echo "<p style='color:green'>Upcoming Event</p>";
                                                        } else { 
                                                            if(empty($i->video_file)) {?>
                                                            <p style="color:red">Completed Event</p>
                                                            <label for="event_link">Upload Event Video</label>
                                                            <input type="file" class="form-control" name="videos_file" id="videos_file" style="width: 215px" onchange="uploadVideo()"/>
                                                            <input type="hidden" id="event_id" value="<?= $i->id;?>" />
                                                        <?php } else { ?>
                                                            <p style="color:red">Completed Event</p>
                                                            <video src="<?= base_url()?>uploads/event/videos_file/<?= @$i->video_file; ?>" controls style="width: 160px;"></video>
                                                        <?php } } ?>
                                                    </td>
                                                    <td class="hidden-480"><a href="<?php if(!empty($i->video_file)) {echo $i->video_file;} else {echo $i->event_link;} ?>">Link</a></td>
                                                    <td class="hidden-480">
                                                        <a style="margin:3px;" class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url() ?>supercontrol/event/show_event_id/<?php echo $i->id; ?>">Edit</a><br>
                                                        <a style="margin:3px;" onclick="return confirm('Are you sure you want to delete this Event?');" class="btn red btn-sm btn-outline sbold uppercase" href="<?php echo base_url() ?>supercontrol/event/delete_event/<?php echo $i->id; ?>">Delete</a><br>
                                                    </td>
                                                </tr>
                                                <?php $c++; } } ?>
                                            </tbody>
                                        </table>
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
<link href="<?= base_url('assets/sweetalert/sweetalert.css') ?>" rel="stylesheet" type="text/css">
<script src="<?= base_url('assets/sweetalert/sweetalert.min.js') ?>"></script>
<script src="<?= base_url('assets/sweetalert/jquery.sweet-alert.custom.js') ?>"></script>
<script>
function uploadVideo() {
    //e.preventDefault();
    var event_id = $('#event_id').val();
    var file = $("#videos_file")[0].files[0];
    if (file) {
        var formData = new FormData();
        formData.append("event_id", event_id);
        formData.append("videos_file", file);
        $.ajax({
            url: "<?= base_url()?>supercontrol/Event/fileUpload",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(data) {
            console.log(data);
                if(data == 'success'){
                    swal({
                        title: "",
                        text: "Video uploaded successfully",
                        type: "success"
                    }, function() {
                        location.reload();
                    });
                }
            }
        });
    } else {
        console.log("No file selected")
    }
}
</script>