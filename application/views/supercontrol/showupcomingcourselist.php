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
                    <li><span>supercontrol Panel</span> <i class="fa fa-circle"></i></li>
                    <li><span>Show Course List </span></li>
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
                                        <div class="caption"> <i class="fa fa-gift"></i> Upcoming Course List </div> 
                                        
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a> 
                                            <a href="javascript:;" class="reload"> </a> 
                                            <a href="javascript:;" class="remove"> </a> 
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                                                <div id="mydiv">
                                                    <thead>
                                                        <tr>
                                                            <th width="20"><input id="selectall" type="checkbox"></th>
                                                            <th>Image</th>
                                                            <th>Title</th>
                                                            <th>Destription</th>
                                                            <th>Overview</th>
                                                            <th>Details </th>
                                                            <th width="27">Module</th>
                                                            <th width="27">Material</th>
                                                            <!-- <th width="27">Course Session </th>
                                                            <th width="27">Course Clone</th> -->
                                                            <th width="27">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (is_array($eloca)): 
                                                        $ctn = 1;
                                                        foreach ($eloca as $i) { 
                                                        $queryallcat = $this->db->query("SELECT category_name FROM sm_category WHERE id = $i->cat_id")->result_array();?>
                                                        <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                                                            <td>
                                                                <input name="checkbox[]" class="checkbox1" type="checkbox" value="<?php echo $i->id; ?>">
                                                            </td>
                                                            <td>
                                                                <?php if ($i->image == "") { ?>
                                                                No Image
                                                                <?php } else { ?>
                                                                <img src="<?php echo base_url() ?>assets/images/courses/<?php echo $i->image; ?>" width="90" height="90" style="border: 2px solid #ddd;" />
                                                                <?php } ?>
                                                            </td>
                                                            <td> <?php echo $i->title; ?> </td>
                                                            <td> <?php echo $i->description; ?> </td>
                                                            <td>
                                                                <p style="margin:0px;"><b>Category </b>: <?php echo $queryallcat[0]['category_name']; ?></p>
                                                                <p style="margin:0px;"><b>Price </b>: <?php echo $i->price; ?></p>
                                                                <p style="margin:0px;"><b>Certification </b>: <?php echo $i->course_certificate; ?></p>
                                                                <p style="margin:0px;"><b>Requirement </b>: <?php echo $i->requirement; ?></p>
                                                                <p style="margin:0px;"><b>Who should Attend </b>: <?php echo $i->attended; ?></p>
                                                            </td>
                                                            <td>
                                                                <p style="margin:0px;"><b>Course Mode </b>:
                                                                <?php
                                                                $queryallmode = $this->db->query("SELECT mode_title FROM sm_mode WHERE id = $i->mode_id")->result_array();
                                                                echo $queryallmode[0]['mode_title'];
                                                                ?></p>
                                                                <p style="margin:0px;"><b>Course Level </b>:
                                                                <?php
                                                                $queryalllevel = $this->db->query("SELECT level_title FROM sm_levels WHERE id = $i->level_id")->result_array();
                                                                echo $queryalllevel[0]['level_title'];
                                                                ?></p>
                                                                <p style="margin:0px;"><b>Course Duration </b>: <?php echo $i->duration; ?></p>
                                                            </td>
                                                            <td style="max-width:250px;">
                                                                <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/course/add_course_module_view/<?php echo $i->id; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Module</a>
                                                                <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/course/module_list/<?php echo $i->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Module</a>
                                                            </td>
                                                            <td style="max-width:250px;">
                                                                <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/course/add_course_trainingmaterial_view/<?php echo $i->id; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Material</a>
                                                                <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/course/material_list/<?php echo $i->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Material</a>
                                                            </td>
                                                            <!-- <td style="max-width:250px;">
                                                                <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/course/add_course_session_view/<?php echo $i->id; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Course Session</a>
                                                                <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/course/course_session_list/<?php echo $i->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Course Session List</a>
                                                            </td>
                                                            <td style="max-width:250px;">
                                                                <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/course/add_course_clone/<?php echo $i->id; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Course Clone</a>
                                                            </td>
                                                            <td  style="max-width:250px;">
                                                                <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url() ?>supercontrol/course/add_lesson/<?php echo $i->id; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Lesson</a> 
                                                                <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url() ?>supercontrol/course/lesson_list/<?php echo $i->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Lesson</a>
                                                            </td>
                                                            <td style="max-width:250px;">
                                                                <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/location/location_add_form/<?php echo $i->id; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Location</a> 
                                                                <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/location/show_location/<?php echo $i->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Location</a>
                                                            </td> 
                                                            <td style="max-width:250px;">
                                                                <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/distance/adddistanceview/<?php echo $i->id; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Distance</a> 
                                                                <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/distance/showdistancebooking/<?php echo $i->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Distance</a>
                                                            </td>
                                                            <td  style="max-width:250px;">
                                                                <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/course/add_private/<?php echo $i->id; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Private</a> 
                                                                <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/course/view_private/<?php echo $i->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Private</a> 
                                                            </td>-->
                                                            <td style="max-width:50px;">
                                                                <!-- <a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url() ?>supercontrol/course/view_course/<?php echo $i->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i> </a> -->
                                                                <a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url() ?>supercontrol/course/show_course_id/<?php echo $i->id; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                                <!-- <a class="btn red btn-sm btn-outline sbold uppercase" onclick="return confirm('Are you sure about this delete?');" href="<?php echo base_url() ?>supercontrol/course/delete_course/<?php echo $i->id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a> -->
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