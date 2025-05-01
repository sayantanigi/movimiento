<style>
.form-check {display: flex; align-items: center;}
.form-check label {margin-left: 10px; font-size: 18px; font-weight: 500;}
.form-switch .form-check-input[type=checkbox] {border-radius: 2em; height: 50px; width: 100px;}
small > p{color:red;}
p strong{font-weight: 600 !important; color: black !important;}
.sa-confirm-button-container button{background-color: #146c43 !important; border-color: #146c43 !important;}
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?= $title ?></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active"><?= @$page ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-shadow rounded-lg border">
                        <div class="card-body">
                            <div class="">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" style="overflow-x: scroll; display: inline-block;">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Course Name</th>
                                            <th>Student Name</th>
                                            <th>Trainer Name</th>
                                            <th>Booking Date</th>
                                            <th>Booking Time</th>
                                            <th>Transaction Data</th>
                                            <th>Payment Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php if (is_array($booking_list) || is_object($booking_list)) { ?>
                                            <?php foreach ($booking_list as $key => $v): ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>
                                                    <td>
                                                        <?php
                                                        $courseData = $this->db->query("SELECT * FROM courses WHERE id = '".@$v->course_id."'")->row();
                                                        echo @$courseData->course_name;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $userData = $this->db->query("SELECT * FROM users WHERE id = '".@$v->user_id."'")->row();
                                                        echo @$userData->salutation." ".@$userData->first_name." ".@$userData->last_name;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $trainerData = $this->db->query("SELECT * FROM users WHERE id = '".@$v->trainer_id."'")->row();
                                                        if(!empty($trainerData)) {
                                                            echo @$trainerData->salutation." ".@$trainerData->first_name." ".@$trainerData->last_name;
                                                        } else {
                                                            echo "No trainer assigned yet";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $bookingDate = $this->db->query("SELECT * FROM booking_details WHERE booking_id = '".@$v->id."'")->result();
                                                        foreach ($bookingDate as $key => $value) {
                                                            if($value->booking_date != '0000-00-00') {
                                                                echo '<p class="mb-0">'.date('d-m-Y', strtotime($value->booking_date)).'</p>';
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= @$v->booking_time; ?></td>
                                                    <td>
                                                        <p style="margin: 0px;"><b>Transaction ID: </b><?= @$v->transaction_id;?></p>
                                                        <p style="margin: 0px;"><b>Transaction Date: </b><?= @$v->transaction_date;?></p>
                                                        <p style="margin: 0px;"><b>Payment: </b><?= @$v->total_payment;?></p>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if(@$v->status == '0') {
                                                            echo "Pending";
                                                        } else if(@$v->status == '1') {
                                                            echo "Paid";
                                                        } else {
                                                            echo "Failed";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if(!empty(@$v->trainer_id)) { ?>
                                                        <button class="btn btn-primary">Assigned</button>
                                                        <?php } else { ?>
                                                        <select class="form-control" onchange="assignTrainer()">
                                                            <?php
                                                            $trainerList = $this->db->query("SELECT * FROM users WHERE user_type = '2' AND status = '1' AND email_verify_status = '1'")->result();
                                                            if(!empty($trainerList)) { ?>
                                                            <option value="">Select Trainer</option>
                                                            <?php foreach ($trainerList as $trainer) { ?>
                                                            <option value="<?= $trainer->id; ?>"><?= $trainer->salutation." ".$trainer->last_name." ".$trainer->last_name ?></option>
                                                            <?php } } else { ?>
                                                            <option value="">No Trainer to assign</option>
                                                            <?php } ?>
                                                        </select>
                                                        <?php } ?>
                                                        <input type="hidden" id="booking_id_<?= @$v->id ?>" value="<?= @$v->id ?>">
                                                    </td>
                                                    <td class="text-center"></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php } ?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
<script type="text/javascript">
function deleteCourse(courseId) {
    swal({
        title: 'Are you sure want to delete this course?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#A5DC86',
        cancelButtonColor: '#DD6B55',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        closeOnConfirm: true,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            window.location.href = '<?= base_url('admin/course/delete_course/') ?>' + courseId
        }
    });
}

function changeCourseStatus(id, thisSwitch) {
    var newStatus;
    if (thisSwitch.val() == 1) {
        thisSwitch.val('0');
        newStatus = '0';
    } else {
        thisSwitch.val('1');
        newStatus = '1';
    }
    $.ajax({
        url: '<?php echo base_url('admin/course/changestatus'); ?>',
        type: 'POST',
        dataType: 'json',
        data: {
            id: String(id),
            status: String(newStatus)
        },
    })
    .done(function (data) {
        if (newStatus == 1) {
            swal({title: "Sucess!", text: "<strong>The course is now active.</strong>", type: "success", showConfirmButton: true, html: true}, function () {
                window.location.href = " "
            });
        } else if (newStatus == 0) {
            swal({title: "Sucess!", text: "<strong>The course is now deactive.</strong>", type: "success", showConfirmButton: true, html: true}, function () {
                window.location.href = " "
            });
        }
    })
    .fail(function (data) {
        console.log(data);
    });
}

function assignTrainer() {
    var selectElement = event.target;
    var selectedTrainerId = selectElement.value;

    var bookingIdInput = selectElement.closest('tr').querySelector('input[type="hidden"]');
    var bookingId = bookingIdInput.value;

    $.ajax({
        url: '<?= base_url()?>admin/course/assign_trainer', // Update with your URL
        type: 'POST',
        data: {
            booking_id: bookingId,
            trainer_id: selectedTrainerId
        },
        success: function(response) {
            if (response == 1) {
                alert("Trainer assigned successfully.");
                location.reload(); // Reload the page to reflect changes
            } else {
                alert("Failed to assign trainer: " + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert("An error occurred: " + error);
        }
    });
}
</script>
