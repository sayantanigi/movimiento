<style>
#sample_1_filter {padding: 8px;float: right;}
#sample_1_length {padding: 8px;}
#sample_1_info {padding: 8px;}
#sample_1_paginate {float: right; padding: 8px;}
.dataTables_info {padding: 7px;}
.showcase_buttons .btn.btn-outline.green { width: 100%; margin: 0 0 5px 0;}
.showcase_buttons .btn.btn-outline.red {width: 100%;}
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
                    <li><a href="<?php echo base_url(); ?>supercontrol/home">Home</a><i class="fa fa-circle"></i> </li>
                    <li><span>Supercontrol Panel</span> <i class="fa fa-circle"></i></li>
                    <li><span>Show Community List </span></li>
                </ul>
            </div>
            <?php if (@$success_msg) {
                echo @$success_msg;
            }
            if (@$message) {
                echo @$message;
            }
            if (@$msg) {
                echo @$msg;
            }
            if (@$msg1) {
                echo @$msg1;
            }
            if ($this->session->flashdata('success') != '') { ?>
            <div class="alert alert-success text-center">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php }
            if (isset($success_msg)) {
                echo $success_msg;
            }
            if ($this->session->flashdata('add_message') != '') { ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&#10006;</button>
                <strong>
                    <?php echo @$this->session->flashdata('add_message'); ?>
                </strong>
            </div>
            <?php }
            if ($this->session->flashdata('edit_message') != '') { ?>
            <div class="alert alert-success1" style="background-color:#98E0D5;">
                <button type="button" class="close" data-dismiss="alert">&#10006;</button>
                <strong style="color:#063;">
                    <?php echo @$this->session->flashdata('edit_message'); ?>
                </strong>
            </div>
            <?php }
            if ($this->session->flashdata('delete_message') != '') { ?>
            <div class="alert alert-success" style="background-color:#F0959B;">
                <button type="button" class="close" data-dismiss="alert">&#10006;</button>
                <strong style="color:#900;">
                    <?php echo @$this->session->flashdata('delete_message'); ?>
                </strong>
            </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed showcase_buttons">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i> Community List </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                            <a href="javascript:;" class="reload"> </a>
                                            <a href="javascript:;" class="remove"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive cstm_courselist" id="sample_1">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                        <th>Events</th>
                                                        <th>Status</th>
                                                        <th style="width: 40px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (is_array($community) && count($community) > 0) {
                                                    $i = 1;
                                                    foreach ($community as $community_v) {
                                                        $string = strip_tags($community_v->description);
                                                        if (strlen($string) > 500) {
                                                            $stringCut = substr($string, 0, 900);
                                                            $endPoint = strrpos($stringCut, ' ');
                                                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                            $string .= '    ....';
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td><?= $i ?></td>
                                                        <td><?= $community_v->title ?></td>
                                                        <td><?= $string?></td>
                                                        <td style="max-width:250px;">
                                                            <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/community/add_event/<?= $community_v->id; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Event</a>
                                                            <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/community/event_list/<?= $community_v->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Event</a>
                                                        </td>
                                                        <td>
                                                            <?php if ($community_v->status == 1) { ?>
                                                            <a href="<?= base_url('supercontrol/community/deactivate/' . $community_v->id) ?>"><span class="badge bg-green">Active</span></a>
                                                            <?php } else { ?>
                                                            <a href="<?= base_url('supercontrol/community/activate/' . $community_v->id) ?>"><span class="badge bg-red">Inactive</span></a>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <div class="action-button">
                                                                <a href="<?= base_url('supercontrol/community/add_community/' . $community_v->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                                                <a href="<?= base_url('supercontrol/community/delete/' . $community_v->id) ?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; } } ?>
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
</div>
<script>
$(document).ready(function () {
    $("#selectall").click(function () {
        var check = $(this).prop('checked');
        if (check == true) {
            $('.checker').find('span').addClass('checked');
            $('.checkbox1').prop('checked', true);
        } else {
            $('.checker').find('span').removeClass('checked');
            $('.checkbox1').prop('checked', false);
        }
    });
    $("#del_all").on('click', function (e) {
        e.preventDefault();
        var checkValues = $('.checkbox1:checked').map(function () {
            return $(this).val();
        }).get();
        console.log(checkValues);
        //alert(checkValues);
        $.each(checkValues, function (i, val) {
            //alert(val);
            $("#" + val).remove();
        });
        $.ajax({
            url: '<?php echo base_url() ?>supercontrol/course/delete_multiple',
            type: 'post',
            data: 'ids=' + checkValues
        }).done(function (data) {
            $("#respose").html(data);
            //location.reload();
            var newurl = '<?php echo base_url() ?>supercontrol/course/show_course';
            window.location.href = newurl;
            $('#selectall').attr('checked', false);
        });
    });
    function resetcheckbox() {
        $('input:checkbox').each(function () { //loop through each checkbox
            this.checked = false; //deselect all checkboxes with class "checkbox1"
        });
    }
});
function f1(stat, id) {
    $.ajax({
        type: "get",
        url: "<?php echo base_url(); ?>supercontrol/blog/statusblog",
        data: { stat: stat, id: id }
    });
}
</script>
<?php //$this->load->view ('footer');?>