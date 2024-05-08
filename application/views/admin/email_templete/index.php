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
                    <h3 class="box-title">Email Template Lists</h3>
                    <a href="<?= admin_url('email_templete/add/') ?>" class="pull-right btn btn-primary"><span class="fa fa-plus"></span> Add New</a>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Template Name</th>
                            <th>Template Subject</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                        if (!empty($email_templete)) {
                        $i = 1;
                        foreach ($email_templete as $etmplt) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $etmplt->name ?></td>
                            <td><?= $etmplt->subject ?></td>
                            <td><?= date('dM Y h:i A', strtotime($etmplt->created_date)); ?></td>
                            <td style="vertical-align: middle;">
                                <div class="checkbox checbox-switch switch-success" style="margin-left: 20px;">
                                    <label>
                                        <input type="checkbox" value="<?= @$etmplt->status ?>" <?= (@$etmplt->status == 1) ? 'checked="checked"' : ''; ?> onchange="changeEventStatus(<?= @$etmplt->id ?>, $(this))">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="action-button">
                                    <a href="<?= admin_url('email_templete/add/' . $etmplt->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                    <button class="btn btn-xs btn-danger" style="margin-left: 5px;" title="Delete" data-toggle="tooltip" onclick="deleteEvent(<?= @$etmplt->id ?>)">
                                        <i class="fa fa-trash"></i>
                                    </button>
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
            window.location.href = '<?= admin_url('email_templete/deleteEvent/') ?>' + id
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
                url: '<?= admin_url('email_templete/changeStatus') ?>',
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
            url: "<?= base_url()?>admin/email_templete/fileUpload",
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