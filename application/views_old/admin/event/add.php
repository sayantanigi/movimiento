<!-- Main content -->
<section class="content-header">
    <h1><?= $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?php echo @$title; ?>
                    </h3>
                </div>
                <?php
                if (@$event->event_img && file_exists('./uploads/event/' . @$event->event_img)) {
                    $event_img = base_url('uploads/event/' . @$event->event_img);
                } else {
                    $event_img = base_url('images/thumbs.jpg');
                }
                if (@$event->id) {
                    $formPath = admin_url('event/eventUpdate/' . @$event->id);
                } else {
                    $formPath = admin_url('event/add/' . @$event->id);
                }
                //echo "<pre>"; print_r($event); die();
                ?>
                <form action="<?php echo @$formPath; ?>" method="post" enctype="multipart/form-data"
                    id="form_validation">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <label for="usrImage">Event Image</label>
                                            <input type="hidden" name="old_image"
                                                value="<?php echo @$event->image; ?>">
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" class="form-control" name="event_img" id="customFile" onchange="preview_image(event)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 text-left">
                                        <label></label>
                                        <img id="output_image" src="<?= @$event_img ?>" />
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="event_name">Event Name<span class="red">*</span></label>
                                            <input type="text" name="event_name" value="<?= @$event->event_name ?>" class="form-control" id="event_name" placeholder="Enter First Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="event_desc">Event Description<span class="red">*</span></label>
                                            <!-- <input type="text" name="email" value="<?= @$event->email ?>" class="form-control" id="email" placeholder="Enter Email"> -->
                                            <textarea name="event_desc" class="form-control" id="event_desc" placeholder="Enter Event Description"><?= @$event->event_desc ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="status">Event Date</label>
                                            <div class='input-group date'>
                                                <input type='text' class="form-control" id='datepicker' name="event_dt" value="<?= @$event->event_dt ?>"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="from_time">From Time</label>
                                            <input type="time" name="from_time" value="<?= @$event->from_time ?>" class="form-control" id="from_time">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="to_time">To Time</label>
                                            <input type="time" name="to_time" value="<?= @$event->to_time ?>" class="form-control" id="to_time">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="event_mode">Event Mode</label>
                                            <select name="event_mode" id="event_mode" class="form-control">
                                                <option value="">Choose option</option>
                                                <option value="online" <?= (@$event->event_mode == 'online') ? 'selected' : ''; ?>>Online </option>
                                                <option value="offline" <?= (@$event->event_mode == 'offline') ? 'selected' : ''; ?>>Offline </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 checkforLink" style="display: <?php if(@$event->event_mode == "online") {echo "block";} else {echo "none";}?>">
                                        <div class="form-group">
                                            <label for="event_link">Event Meeting Link</label>
                                            <input type="text" name="event_link" value="<?= @$event->event_link ?>" class="form-control" id="event_link" placeholder="Meeting Link">
                                        </div>
                                    </div>
                                    <?php if(!empty(@$event->video_file)) { ?>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <?php if(empty(@$event->video_file)) { ?>
                                            <label for="event_link">Upload Event Video</label>
                                            <?php } else { ?>
                                            <label for="event_link">Update Event Video</label>
                                            <?php } ?>
                                            <input type="file" class="form-control" name="videos_file" />
                                            <input type="hidden" id="old_video" value="<?= @$event->video_file; ?>"/>
                                            <?php if(!empty(@$event->video_file)) { ?>
                                            <video src="<?= base_url()?>uploads/event/videos_file/<?= @$event->video_file; ?>" controls style="width: 20%; margin-top: 15px;"></video>
                                            <?php }  ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="event_type">Event Type</label>
                                            <select name="event_type" id="event_type" class="form-control">
                                                <option value="">Choose option</option>
                                                <option value="free" <?= (@$event->event_type == 'free') ? 'selected' : ''; ?>>Free </option>
                                                <option value="paid" <?= (@$event->event_type == 'paid') ? 'selected' : ''; ?>>Paid </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="eventTypeForm" style="display: <?php if(@$event->event_type == "paid") {echo "block";} else {echo "none";}?>">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="event_price">Event Price</label>
                                                <input type="text" name="event_price" value="<?= @$event->event_price ?>" class="form-control" id="event_price" placeholder="Event Price">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="price_key">Price Key</label>
                                                <input type="text" name="price_key" value="<?= @$event->price_key ?>" class="form-control" id="price_key" placeholder="Price Key">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="">Choose option</option>
                                                <option value="1" <?= (@$event->status == 1) ? 'selected' : ''; ?>>Active </option>
                                                <option value="2" <?= (@$event->status == 2) ? 'selected' : ''; ?>>Inactive </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer" style="margin-left:30px;">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                        <a href="<?= admin_url('event') ?>" class="btn btn-warning" title="Back">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<style>
.eventTypeForm {display: none;}
.checkforLink {display: none;}
.checkforUpload {display: none;}
</style>
<script>
CKEDITOR.replace('event_desc');
$(function() {
    $("#datepicker").datepicker();
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
});
</script>