<style>
.form-control {margin-bottom: 15px;}
#loader {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
}
</style>
<div id="loader"><img src="<?= base_url()?>loader.webp" style="width: 50px; background: #000;"></div>
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
            <div class="box">
                <div class="box-header with-border2">
                    <h3 class="box-title">Event Lists</h3>
                    <a href="<?= admin_url('event/add/') ?>" class="pull-right btn btn-primary"><span class="fa fa-plus"></span> Add New</a>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Image</th>
                            <th>Event Name</th>
                            <!-- <th>Event Description</th> -->
                            <th>Event Date Time</th>
                            <th>Event Link</th>
                            <th>Event Mode</th>
                            <th>Event Level</th>
                            <th>Posted By</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                        if (!empty($event)) {
                        $i = 1;
                        foreach ($event as $evnt) {
                            if (@$evnt->event_img && file_exists('./uploads/event/' . @$evnt->event_img)) {
                            $event_img = base_url('uploads/event/' . @$evnt->event_img);
                        } else {
                            $event_img = base_url('images/thumbs.jpg');
                        }
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><img src="<?= $event_img ?>" style="width: 90px;"/></td>
                            <td><?= $evnt->event_name ?></td>
                            <!-- <td><?= $evnt->event_desc ?></td> -->
                            <td><?= date('h:i A', strtotime($evnt->from_time))." to ".date('h:i A', strtotime($evnt->to_time))." on ".date('jS M Y', strtotime($evnt->event_dt)); ?></td>
                            <td><a href="<?php if(!empty($evnt->video_file)) {echo $evnt->video_file;} else {echo $evnt->event_link;} ?>">Link</a></td>
                            <td><?= $evnt->event_mode ?></td>
                            <td>
                                <?php 
                                $nowdate = strtotime(date("Y-m-d"));
                                $event_date = date("Y-m-d", strtotime($evnt->event_dt));
                                $eventDate = strtotime($event_date);
                                if($eventDate >= $nowdate) {
                                    echo "<p style='color:green'>Upcoming Event</p>";
                                } else { 
                                    if(empty($evnt->video_file)) {?>
                                    <p style="color:red">Completed Event</p>
                                    <label for="event_link">Upload Event Video</label>
                                    <input type="file" class="form-control" name="videos_file" id="videos_file" onchange="uploadVideo()"/>
                                    <input type="hidden" id="event_id" value="<?= $evnt->id;?>" />
                                <?php } else { ?>
                                    <p style="color:red">Completed Event</p>
                                    <video src="<?= base_url()?>uploads/event/videos_file/<?= @$evnt->video_file; ?>" controls style="width: 160px;"></video>
                                <?php } } ?>
                            </td>
                            <td>
                                <?php 
                                if(!empty($evnt->user_id)){
                                    $userdetails = $this->db->query("SELECT * FROM users WHERE id = '".$evnt->user_id."'")->row();
                                    echo $userdetails->fname." ".$userdetails->lname;
                                } else {
                                    echo "Admin";
                                }
                                ?>
                            </td>
                            <td style="vertical-align: middle;">
                                <div class="checkbox checbox-switch switch-success">
                                    <label>
                                        <input type="checkbox" value="<?= @$evnt->status ?>" <?= (@$evnt->status == 1) ? 'checked="checked"' : ''; ?> onchange="changeEventStatus(<?= @$evnt->id ?>, $(this))">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="action-button">
                                    <a href="<?= admin_url('event/add/' . $evnt->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                    <button class="btn btn-xs btn-danger" style="margin-left: 5px;" title="Delete" data-toggle="tooltip" onclick="deleteEvent(<?= @$evnt->id ?>)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <!-- <a href="<?= admin_url('event/deleteUsers/' . $evnt->id) ?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a> -->
                                </div>
                            </td>
                        </tr>
                        <?php $i++; } } else {
                        echo "<tr><td colspan='7' class='text-center red'><h3>No record available!</h3></td></tr>";
                        } ?>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <?= $paginate ?>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
function deleteEvent(id) {
    swal({
        title: 'Are You sure want to delete this user?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#36A1EA',
        cancelButtonColor: '#e50914',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        closeOnConfirm: true,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            window.location.href = '<?= admin_url('event/deleteEvent/') ?>' + id
        }
    });
}
function changeEventStatus(id, thisSwitch) {
    swal({
        title: 'Are you sure want to change the status?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#36A1EA',
        cancelButtonColor: '#e50914',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        closeOnConfirm: true,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('2');
                newStatus = '2';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }
            $.ajax({
                url: '<?= admin_url('event/changeStatus') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus)
                },
            })
            .done(function (data) {
                alert_func(data);
            })
            .fail(function (data) {
                console.log(data);
            });
        } else {
            location.reload();
        }
    });
}

function uploadVideo() {
    //e.preventDefault();
    var event_id = $('#event_id').val();
    var file = $("#videos_file")[0].files[0];
    if (file) {
        var formData = new FormData();
        formData.append("event_id", event_id);
        formData.append("videos_file", file);
        $.ajax({
            url: "<?= base_url()?>admin/event/fileUpload",
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