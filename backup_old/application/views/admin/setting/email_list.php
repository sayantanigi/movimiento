<style>
.form-control {
    margin-bottom: 15px;
}
</style>
<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">
            <?= $title ?>
        </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border2">
                    <h3 class="box-title">Email Subscribe Lists</h3>
                </div>
                <div class="box-body">
                    <table id="<?php if (!empty($members)) {echo "recordsTable";} ?>" class="display">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all"/></th>
                                <!-- <th style="width: 10px">#</th> -->
                                <th>Email</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!empty($members)) {
                        $i = 1;
                        foreach ($members as $member) {
                        ?>
                        <tr id="recordsRow">
                            <td><input type="checkbox" class="checkbox" value="<?= $member->id?>"/></td>
                            <!-- <td><?= $i ?></td> -->
                            <td><?= $member->user_email ?></td>
                            <td><?= date('d M Y', strtotime($member->created_at)); ?></td>
                            <td><?php if($member->status == '1') { echo "Active"; } else { echo "Inactive";} ?></td>
                        </tr>
                        <?php $i++; } } else {
                            echo "<tr><td colspan='7' class='text-center red'><h3>No record available!</h3></td></tr>";
                        } ?>
                        </tbody>
                    </table>
                </div>
                <div style="display: inline-block; float: right; margin-right: 25px;">
                    <button class="btn btn-primary" type="button" id="sendEmail">Send Email</button>
                    <button class="btn btn-danger" type="button" id="deleteAcc">Delete</button>
                </div>
                <div class="box-footer clearfix"><?= $paginate ?></div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModal1"  data-bs-backdrop="static"  data-bs-keyboard="false"  tabindex="-1" aria-labelledby="aboutUsLabel"  aria-hidden="true"> 
    <div class="modal-dialog" style="width: 300px !important;top: 120px;border-bottom: none !important;"> 
        <div class="modal-content" style="width: 300px;border-radius: 10px;">
            <div class="modal-header"> 
                <div style="text-align: right;margin-right: -15px;top: -15px;position: relative;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style=" border-radius: 20px; border: none; font-size: 20px; width: 30px; text-align: center;" onclick="closeModal()">X</button> 
                </div>
                <div class="modal-body" style="padding-bottom: 0;">
                    <select name="templeteID" id="templeteID" class="form-control">
                        <option value="">Choose Template</option>
                        <?php 
                        $templates = $this->db->query("SELECT * FROM email_templete WHERE status = '1'")->result_array();
                        if(!empty($templates)) {
                        foreach ($templates as $template) { ?>
                        <option value="<?= $template['id']?>"><?= $template['subject']?></option>
                        <?php } } ?>
                    </select>
                </div> 
                <div style="text-align: center;padding-bottom: 20px;">
                    <button type="button" onclick="sendEmailtoUser()">Send</button>
                    <input type="hidden" id="post_arr" value="">
                </div>
                <div style="text-align:center; color:red;" id="err_message"></div>
            </div> 
        </div> 
    </div> 
</div>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border2">
                    <h3 class="box-title">Users Email Lists</h3>
                </div>
                <?php 
                $userList = $this->db->query("SELECT * FROM users WHERE status = '1'")->result_array();
                ?>
                <div class="box-body">
                    <table id="<?php if (!empty($userList)) {echo "recordsTable1";} ?>" class="display">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all1"/></th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!empty($userList)) {
                        $i = 1;
                        foreach ($userList as $users) {
                        ?>
                        <tr id="recordsRow1">
                            <td><input type="checkbox" class="checkbox1" value="<?= $users['id']?>"/></td>
                            <td><?= $users['email'] ?></td>
                            <td><?= date('d M Y', strtotime($users['created_at'])); ?></td>
                            <td><?php if($users['status'] == '1') { echo "Active"; } else { echo "Inactive";} ?></td>
                        </tr>
                        <?php $i++; } } else {
                            echo "<tr><td colspan='7' class='text-center red'><h3>No record available!</h3></td></tr>";
                        } ?>
                        </tbody>
                    </table>
                </div>
                <div style="display: inline-block; float: right; margin-right: 25px;">
                    <button class="btn btn-primary" type="button" id="sendEmail1">Send Email</button>
                </div>
                <div class="box-footer clearfix"><?= $paginate ?></div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModal2"  data-bs-backdrop="static"  data-bs-keyboard="false"  tabindex="-1" aria-labelledby="aboutUsLabel"  aria-hidden="true"> 
    <div class="modal-dialog" style="width: 300px !important;top: 120px;border-bottom: none !important;"> 
        <div class="modal-content" style="width: 300px;border-radius: 10px;">
            <div class="modal-header"> 
                <div style="text-align: right;margin-right: -15px;top: -15px;position: relative;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style=" border-radius: 20px; border: none; font-size: 20px; width: 30px; text-align: center;" onclick="closeModal1()">X</button> 
                </div>
                <div class="modal-body" style="padding-bottom: 0;">
                    <select name="templeteID1" id="templeteID1" class="form-control">
                        <option value="">Choose Template</option>
                        <?php 
                        $templates = $this->db->query("SELECT * FROM email_templete WHERE status = '1'")->result_array();
                        if(!empty($templates)) {
                        foreach ($templates as $template) { ?>
                        <option value="<?= $template['id']?>"><?= $template['subject']?></option>
                        <?php } } ?>
                    </select>
                </div> 
                <div style="text-align: center;padding-bottom: 20px;">
                    <button type="button" onclick="sendEmailtoUser1()">Send</button>
                    <input type="hidden" id="post_arr1" value="">
                </div>
                <div style="text-align:center; color:red;" id="err_message1"></div>
            </div> 
        </div> 
    </div> 
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
<script>
/*function deleteUsers(id) {
    swal({
        title: 'Are You sure want to delete this email id?',
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
            window.location.href = '<?= admin_url('settings/deleteUsers/') ?>' + id
        }
    });
}*/
$(document).ready(function() {
    $("#recordsTable").dataTable();
    $("#recordsTable1").dataTable();
    $('#select_all').on('click',function() {
        if(this.checked) {
            $('.checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('.checkbox').each(function() {
                this.checked = false;
            });
        }
    });
    $('.checkbox').on('click',function() {
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });

    $('#select_all1').on('click',function() {
        if(this.checked) {
            $('.checkbox1').each(function() {
                this.checked = true;
            });
        } else {
            $('.checkbox1').each(function() {
                this.checked = false;
            });
        }
    });
    $('.checkbox1').on('click',function() {
        if($('.checkbox1:checked').length == $('.checkbox1').length){
            $('#select_all1').prop('checked',true);
        }else{
            $('#select_all1').prop('checked',false);
        }
    });

    $('#sendEmail').click(function() {
        var post_arr = [];
        $('#recordsRow input[type=checkbox]').each(function() {
            if ($(this).is(":checked")) {
                var id = $(this).val();
                post_arr.push(id);
            }
        });
        if(post_arr.length > 0) {
            $('#exampleModal1').modal('show');
            $('#post_arr').val(post_arr);
        } else {
            swal({
                title: 'Please select alteast one record!',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#36A1EA',
                cancelButtonColor: '#e50914',
                confirmButtonText: 'Ok',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            });
        }
    })
    $('#sendEmail1').click(function() {
        var post_arr = [];
        $('#recordsRow1 input[type=checkbox]').each(function() {
            if ($(this).is(":checked")) {
                var id = $(this).val();
                post_arr.push(id);
            }
        });
        if(post_arr.length > 0) {
            $('#exampleModal2').modal('show');
            $('#post_arr1').val(post_arr);
        } else {
            swal({
                title: 'Please select alteast one record!',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#36A1EA',
                cancelButtonColor: '#e50914',
                confirmButtonText: 'Ok',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            });
        }
    })

    $('#deleteAcc').click(function() {
        var post_arr = [];
        // Get checked checkboxes
        $('#recordsRow input[type=checkbox]').each(function() {
            if ($(this).is(":checked")) {
                var id = $(this).val();
                post_arr.push(id);
            }
        });
        if(post_arr.length > 0) {
            swal({
                title: 'Are You sure want to delete this email id?',
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
                    $.ajax({
                        url: '<?= admin_url()?>Settings/deleteUsers',
                        type: 'POST',
                        data: { post_id: post_arr},
                        success: function(response){
                            $.each(post_arr, function(i,l) {
                                $("#tr_"+l).remove();
                            });
                        }
                    });
                }
            });
        }
    })
})
function sendEmailtoUser(id) {
    var userID = $('#post_arr').val();
    var templateID = $('#templeteID').val();
    if(templateID.length > 0) {
        $.ajax({
            method:'POST',
            url:"<?= admin_url()?>Settings/storeEmailToSend",
            data:{userID:userID,templateID:templateID,type:'1'},
            success: function(response){
                if(response == 1) {
                    swal({
                        title: 'Mail sent',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#36A1EA',
                        cancelButtonColor: '#e50914',
                        confirmButtonText: 'Ok',
                        cancelButtonText: 'No',
                        closeOnConfirm: true,
                        closeOnCancel: true
                    }, function (isConfirm) {
                        if (isConfirm) {
                            location.reload();
                        }
                    });
                } else {
                    swal({
                        title: 'Something went wrong. Please try again later.',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#36A1EA',
                        cancelButtonColor: '#e50914',
                        confirmButtonText: 'Ok',
                        cancelButtonText: 'No',
                        closeOnConfirm: true,
                        closeOnCancel: true
                    }, function (isConfirm) {
                        if (isConfirm) {
                            location.reload();
                        }
                    });
                }
            }
        });
    } else {
        $('#err_message').show().html('Please select an email template first');
        setTimeout(function() {
            $('#err_message').fadeOut('slow')
        }, 3000);
    }
}
function sendEmailtoUser1(id) {
    var userID1 = $('#post_arr1').val();
    var templateID1 = $('#templeteID1').val();
    if(templateID1.length > 0) {
        $.ajax({
            method:'POST',
            url:"<?= admin_url()?>Settings/storeEmailToSend",
            data:{userID:userID1,templateID:templateID1,type:'2'},
            success: function(response){
                if(response == 1) {
                    swal({
                        title: 'Mail sent',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#36A1EA',
                        cancelButtonColor: '#e50914',
                        confirmButtonText: 'Ok',
                        cancelButtonText: 'No',
                        closeOnConfirm: true,
                        closeOnCancel: true
                    }, function (isConfirm) {
                        if (isConfirm) {
                            location.reload();
                        }
                    });
                } else {
                    swal({
                        title: 'Something went wrong. Please try again later.',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#36A1EA',
                        cancelButtonColor: '#e50914',
                        confirmButtonText: 'Ok',
                        cancelButtonText: 'No',
                        closeOnConfirm: true,
                        closeOnCancel: true
                    }, function (isConfirm) {
                        if (isConfirm) {
                            location.reload();
                        }
                    });
                }
            }
        });
    } else {
        $('#err_message1').show().html('Please select an email template first');
        setTimeout(function() {
            $('#err_message1').fadeOut('slow')
        }, 3000);
    }
}
function closeModal() {
    $('#exampleModal1').modal('hide');
}
function closeModal1() {
    $('#exampleModal2').modal('hide');
}
</script>