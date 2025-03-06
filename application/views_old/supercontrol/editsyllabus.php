<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.datetimepicker.css" />
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
                    <li> <span>supercontrol panel</span> </li>
                </ul>
            </div>
            <div class="alert alert-success alert-dismissable" style="padding:10px;">
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
                <strong>
                    <?php
                    $last = end($this->uri->segments);
                    if ($last == "success") {
                        echo "Data Added Successfully ......";
                    }
                    if ($last == "successdelete") {
                        echo "Data Deleted Successfully ......";
                    }
                    ?>
                    <?php if ($this->session->flashdata('success') != '') { ?>
                    <div class="alert alert-success text-center">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } ?>
                </strong>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i>Edit Syllabus</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a> 
                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a> 
                                            <a href="javascript:;" class="reload"> </a> 
                                            <a href="javascript:;" class="remove"> </a> 
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <?php
                                        if ($slist != '') {
                                        foreach ($slist as $ll) { ?>
                                        <form action="<?php echo base_url() . 'supercontrol/course/edit_module' ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="course_id" value="<?php echo @$ll->course_id; ?>">
                                            <input type="hidden" name="module_id" value="<?php echo @$ll->id; ?>">
                                            <?php
                                            if (@$ll->module_image && file_exists('./uploads/modules/' . @$ll->module_image)) {
                                            $image = base_url('./uploads/modules/' . @$ll->module_image);
                                            } else {
                                            $image = base_url('assets/images/no-image.png');
                                            } ?>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3"><b>Image</b></label>
                                                    <div class="col-md-8">
                                                        <input type="file" accept="image/*" class="form-control" name="module_image" id="customFile" onchange="preview_image(event)">
                                                        <input type="hidden" name="old_image" value="<?php echo @$ll->module_image; ?>">
                                                    </div>
                                                    <img id="output_image" src="<?php echo @$image; ?>" style="width: 90px; height: 80px;"/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3"><b>Module Name</b></label>
                                                    <div class="col-md-8"> 
                                                        <input type="text" class="form-control" id="" name="name" value="<?php echo $ll->name; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3"><b>Description</b></label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" name="module_descriptions" id="pagedes" rows="8" cols="16" id="cms_pagedes"><?php echo $ll->module_descriptions; ?></textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label class="control-label col-md-3">Syllabus Order</label>
                                                    <div class="col-md-8">  
                                                        <input type="text" class="form-control" id="" value="<?php echo $ll->s_order; ?>" name="s_order">
                                                    </div>
                                                </div>-->
                                                <div class="form-group">
                                                    <label class="control-label col-md-3"><b>Status</b></label>
                                                    <div class="col-md-8">
                                                        <select name="status" class="form-control">
                                                            <option value="1" <?php if ($ll->status == '1') { ?> selected="selected" <?php } ?>>Active</option>
                                                            <option value="0" <?php if ($ll->status == '0') { ?> selected="selected" <?php } ?>>Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                                                        <input type="hidden" name="syllabus_id" value="<?php echo $ll->id; ?>" />
                                                        <input type="hidden" name="course_id" value="<?php echo $ll->course_id; ?>" />
                                                        <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit', 'class' => 'btn red')); ?>
                                                        <button type="button" class="btn default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <?php } } ?>
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
<script src="<?php echo base_url(); ?>js/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.datetimepicker.full.js"></script>
<script>
    $.datetimepicker.setLocale('en');
    $('#timepicker1').datetimepicker({
        datepicker: false,
        format: 'H:i',
        step: 5
    });

    $('#timepicker2').datetimepicker({
        datepicker: false,
        format: 'H:i',
        step: 5
    });

    $('#datetimepicker2').datetimepicker({
        format: 'd-m-Y',
        timepicker: false,
        formatDate: 'd-m-Y',
        minDate: '-2016/11/03',
    });
    $('#datetimepicker_dark').datetimepicker({ theme: 'dark' })
</script>
<?php //$this->load->view ('footer');?>