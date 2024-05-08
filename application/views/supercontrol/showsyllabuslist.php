<?php //$this->load->view ('header');?>
<!-- BEGIN CONTAINER -->
<style>
#sample_1_filter {padding: 8px; float: right;}
#sample_1_length {padding: 8px;}
#sample_1_info {padding: 8px;}
#sample_1_paginate {float: right; padding: 8px;}
.dataTables_info {padding: 7px;}
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
                    <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i>
                    </li>
                    <li> <span>Instructor Panel</span> <i class="fa fa-circle"></i> </li>
                    <li> <span>Show Module List </span> </li>
                </ul>
            </div>
            <?php if (@$success_msg) {
                echo @$success_msg;
            } ?>
            <?php if (@$message) {
                echo @$message;
            } ?>
            <?php if (@$msg) {
                echo @$msg;
            } ?>
            <?php if (@$msg1) {
                echo @$msg1;
            } ?>
            <?php if ($this->session->flashdata('success') != '') { ?>
            <div class="alert alert-success text-center">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i>Show Module List</div>
                                        <div class="tools"> 
                                            <a href="javascript:;" class="collapse"> </a> 
                                            <a href="javascript:;" class="reload"> </a> 
                                            <a href="javascript:;" class="remove"> </a> 
                                        </div>
                                    </div>
                                    <?php
                                    $CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
                                    $end = end(explode('/', $CurPageURL));
                                    ?>
                                    <div class="portlet-body form">
                                        <!--  -->
                                        <div style="text-align: end;margin: 10px;display: inline-block;width: 98%;">
                                            <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/course/add_course_module_view/<?php echo $end; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Module</a>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                                            <div id="mydiv">
                                                <thead>
                                                    <tr>
                                                        <th><input id="selectall" type="checkbox"></th>
                                                        <!-- <th>Sl No</th> -->
                                                        <th>Image</th>
                                                        <th>Module Name</th>
                                                        <th>Description</th>
                                                        <!-- <th>Materials</th> -->
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (is_array($syllabuslist)): ?>
                                                    <?php
                                                    $ctn = 1;
                                                    foreach ($syllabuslist as $i) { 
                                                    if (@$i->module_image && file_exists('./uploads/modules/' . @$i->module_image)) {
                                                        $image = base_url('./uploads/modules/' . @$i->module_image);
                                                    } else {
                                                        $image = base_url('assets/images/no-image.png');
                                                    }?>
                                                    <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                                                        <td><input name="checkbox[]" class="checkbox1" type="checkbox" value="<?php echo $i->id; ?>"></td>
                                                        <td><img src="<?= @$image ?>" style="width:35px; border:1px solid #ccc; padding:2px;"></td>
                                                        <td style="max-width:200px;"><?php echo $i->name; ?></td>
                                                        <td style="max-width:200px;"><?php echo $i->module_descriptions; ?></td>
                                                        <!-- <td><a href="<?php echo base_url() ?>supercontrol/course/material_list/<?php echo $i->course_id; ?>/<?php echo $i->id; ?>" class="btn btn-xs btn-info">Material Preference</a></td> -->
                                                        <td style="max-width:80px;">
                                                            <?php if ($i->status == '1') { ?> 
                                                            <a style="margin-right: 0px;" class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url() ?>supercontrol/course/change_module_status/<?php echo $i->course_id; ?>/<?php echo $i->id; ?>"><span class="fa fa-check"></span></a>
                                                            <?php } else { ?>
                                                            <a style="margin-right: 0px;" class="btn red btn-sm btn-outline sbold uppercase" href="<?php echo base_url() ?>supercontrol/course/change_module_status/<?php echo $i->course_id; ?>/<?php echo $i->id; ?>"><span class="fa fa-circle"></span></a>
                                                            <?php } ?>
                                                            <a style="margin-right: 0px;" class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url() ?>supercontrol/course/edit_module_view/<?php echo $i->course_id; ?>/<?php echo $i->id; ?>"><span class="fa fa-pencil"></span></a>
                                                            <a style="margin-right: 0px;" class="btn red btn-sm btn-outline sbold uppercase" onclick="return confirm('Are you you want to  delete?');" href="<?php echo base_url() ?>supercontrol/course/delete_mo/<?php echo $i->course_id; ?>/<?php echo $i->id; ?>"><span class="fa fa-trash"></span></a>
                                                        </td>
                                                    </tr>
                                                    <?php $ctn++; } ?>
                                                    <?php endif; ?>
                                                </tbody>
                                            </div>
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
<script>
$(document).ready(function () {
    //resetcheckbox();
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
            url: '<?php echo base_url() ?>supercontrol/press/delete_multiple',
            type: 'post',
            data: 'ids=' + checkValues
        }).done(function (data) {
            $("#respose").html(data);
            var newurl = '<?php echo base_url() ?>supercontrol/press/show_press';
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
        url: "<?php echo base_url(); ?>supercontrol/press/statuspress",
        data: { stat: stat, id: id }
    });
}
</script>
<?php //$this->load->view ('footer');?>