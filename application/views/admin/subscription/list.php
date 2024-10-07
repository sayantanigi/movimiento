<section class="content-header">
    <h1><?= $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>

<section class="content-header">
    <?php $this->load->view('alert'); ?>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border33">
                    <h3 class="box-title">Subscription Lists</h3>
                    <a href="<?= admin_url('subscription/add') ?>" class="pull-right btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
                </div>
                <div class="box-body">
                    <table class="table Custom_Table">
                        <thead>
                        <tr>
                            <th style="width: 4%;">Sl No.</th>
                            <th style="width: 5%;">Action</th>
                            <th style="width: 10%;">Subscription Name</th>
                            <th style="width: 8%;">Subscription User Type</th>
                            <th style="width: 8%;">Subscription Type</th>
                            <th style="width: 5%;">Subscription Amount</th>
                            <th style="width: 5%;">Subscription Duration</th>
                            <!-- <th style="width: 5%;">Payment Link</th> -->
                            <th style="width: 15%;">Description</th>
                            <!-- <th>Syllabus</th> -->
                        </tr>
                        </thead>
                        <?php
                        if (is_array($subscription) && count($subscription) > 0) {
                            $i = 0;
                            foreach ($subscription as $subscription_v) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td style="word-wrap: break-word;">
                                        <div class="checkbox checbox-switch switch-success">
                                            <label>
                                                <input type="checkbox" value="<?= @$subscription_v->status ?>" <?= (@$subscription_v->status == 1) ? 'checked="checked"' : ''; ?> onchange="changeSubscribeStatus(<?= @$subscription_v->id ?>, $(this))">
                                                <span></span>
                                            </label>
                                            <a href="<?= admin_url('subscription/add/' . $subscription_v->id) ?>" class="btn btn-xs btn-warning"><span class="fa fa-pencil"></span></a>
                                            <button class="btn btn-xs btn-danger" style="margin-left: 5px;" title="Delete" data-toggle="tooltip" onclick="deleteSubscribe(<?= @$subscription_v->id ?>)"> <i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                    <td style="word-wrap: break-word;">
                                        <div class="truncate1">
                                            <?php if (@$subscription_v->subscription_name) {
                                                echo @$subscription_v->subscription_name;
                                            } else {
                                                echo "&#8212;";
                                            } ?>
                                        </div>
                                    </td>
                                    <td style="word-wrap: break-word;">
                                        <div class="truncate1">
                                            <?php if (@$subscription_v->subscription_user_type == '1') {
                                                echo "Student";
                                            } else if (@$subscription_v->subscription_user_type == '2') {
                                                echo "Instructor";
                                            } else {
                                                echo "&#8212;";
                                            } ?>
                                        </div>
                                    </td>
                                    <td style="word-wrap: break-word;">
                                        <?= ucwords($subscription_v->subscription_type); ?>
                                    </td>
                                    <td style="word-wrap: break-word;">
                                        <?php if (@$subscription_v->subscription_type == 'free') {
                                            $price = "$ 0.00";
                                        } else {
                                            $price = '$' . number_format($subscription_v->subscription_amount, 2);
                                        } ?>
                                        <p style="margin:0px;"><b>Price </b>: <?php echo $price; ?></p>
                                    </td>
                                    <td style="word-wrap: break-word;">
                                        <?= ucwords($subscription_v->subscription_duration); ?>
                                    </td>
                                    <!-- <td style="word-wrap: break-word;">
                                        <div class="truncate1">
                                            <?php if (@$subscription_v->payment_link) {
                                                echo @$subscription_v->payment_link;
                                            } else {
                                                echo "&#8212;";
                                            } ?>
                                        </div>
                                    </td> -->
                                    <td style="word-wrap: break-word;">
                                        <div class="truncate1">
                                            <?php if (@$subscription_v->subscription_description) {
                                                echo @$subscription_v->subscription_description;
                                            } else {
                                                echo "&#8212;";
                                            } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </table>
                </div>
                <div class="box-footer clearfix"><?= $paginate ?></div>
            </div>
        </div>
    </div>
</section>
<style>
.modal-title {width: 90%; display: inline-block;}
.modal-close {background: none; border: none; float: right;}
.box-body {overflow: auto;}
.Custom_Table {table-layout: fixed; width: 1500px; max-width: 1500px;}
.Custom_Table>thead>tr>th,
.Custom_Table>tbody>tr>td {border: 1px solid #f4f4f4 !important;}
.Custom_Table .btn {width: 100%;}
.Custom_Table .action-button {display: block; padding: 0; margin-left: 0;}
.Custom_Table .action-button a {margin: 0 !important;}
.Custom_Table .checkbox {display: flex; align-items: center; justify-content: space-between; margin: 0 !important;}
</style>
<script>
function deleteCourse(id) {
    swal({
        title: 'Are You sure want to delete this course?',
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
            window.location.href = '<?= admin_url('course/deleteCourse/') ?>' + id
        }
    });
}

<?php foreach ($subscription as $subscription_v) { ?>
    $('#assign_course_<?= $subscription_v->id ?>').click(function () {
        var courseID = $('#courseID_<?= $subscription_v->id ?>').val();
        $('#exampleModal_<?= $subscription_v->id ?>').show();
        $('.modal').css('opacity', '1');
        $('.modal-dialog').css('width', '300px');
        $('.modal-dialog').css('top', '30%');
        $('#assigncourseID_<?= $subscription_v->id ?>').val(courseID);
    })
    $('.modal-close').click(function () {
        $('.modal').css('opacity', '0');
        $('.modal-dialog').css('top', '30%');
        $('.modal').hide();
    })
    $('.assign_member_<?= $subscription_v->id ?>').click(function () {
        var member = $('#member-list_<?= $subscription_v->id ?>').val();
        var assigncourseID = $('#assigncourseID_<?= $subscription_v->id ?>').val();
        var baseUrl = "<?= base_url(); ?>";
        $.ajax({
            type: "post",
            cache: false,
            url: baseUrl + "admin/Course/purchaseCourse",
            data: { member: member, assigncourseID: assigncourseID },
            beforeSend: function () { },
            success: function (returndata) {
                $('.sussess_message').show();
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }
        });
    })

    $('#assign_instructor_<?= $subscription_v->id ?>').click(function () {
        var courseID = $('#courseID_<?= $subscription_v->id ?>').val();
        $('#exampleModalins_<?= $subscription_v->id ?>').show();
        $('.modal_ins').css('opacity', '1');
        $('.modal_ins1').css('width', '300px');
        $('.modal_ins1').css('top', '30%');
        $('#assigncourseID_<?= $subscription_v->id ?>').val(courseID);
    })
    $('.modal_insc').click(function () {
        $('.modal_ins').css('opacity', '0');
        $('.modal_ins1').css('top', '30%');
        $('.modal_ins').hide();
    })
    $('.assign_member1_<?= $subscription_v->id ?>').click(function () {
        var member = $('#member-list1_<?= $subscription_v->id ?>').val();
        var assigncourseID = $('#assigncourseID_<?= $subscription_v->id ?>').val();
        var baseUrl = "<?= base_url(); ?>";
        $.ajax({
            type: "post",
            cache: false,
            url: baseUrl + "admin/Course/assignInstructortoCourse",
            data: { member: member, assigncourseID: assigncourseID },
            beforeSend: function () { },
            success: function (returndata) {
                //console.log(returndata); return false;
                if (returndata == '1') {
                    $('.sussess_message1').show();
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    $('.error_message1').show();
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
            }
        });
    })
<?php } ?>
</script>