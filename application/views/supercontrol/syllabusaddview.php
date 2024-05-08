<style>
.error {color: #F00;}
</style>
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
                                        <div class="caption"> <i class="fa fa-gift"></i>Add page</div>
                                        <div class="tools"> 
                                            <a href="javascript:;" class="collapse"> </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a> 
                                            <a href="javascript:;" class="reload"> </a> 
                                            <a href="javascript:;" class="remove"> </a> 
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form action="<?php echo base_url().'supercontrol/course/add_course_module' ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3"><b>Image</b></label>
                                                    <div class="col-md-8">
                                                        <input type="file" accept="image/*" class="form-control" name="module_image" id="customFile" onchange="preview_image(event)">
                                                    </div>
                                                    <img id="output_image" src="<?php echo base_url('images/thumbs.jpg'); ?>" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3"><b>Module Name</b></label>
                                                    <div class="col-md-8">
                                                        <?php echo form_input(array('id' => '', 'name' => 'name', 'class' => 'form-control', 'required' => 'required')); ?>
                                                        <?php echo form_error('syllabus_name'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3"><b>Description</b></label>
                                                    <div class="col-md-8">
                                                        <?php echo form_textarea(array('id' => 'pagedes', 'name' => 'module_descriptions', 'class' => 'form-control')); ?>
                                                    </div>
                                                </div>
                                                <!--<div class="form-group">
                                                    <label class="control-label col-md-3">Syllabus Order</label>
                                                    <div class="col-md-8"> 
                                                        <?php //echo form_input(array('id' => 'order', 'required' => 'required', 'name' => 's_order', 'class' => 'form-control')); ?>
                                                    </div>
                                                </div>-->
                                                <div class="form-group">
                                                    <label class="control-label col-md-3"><b>Status</b></label>
                                                    <div class="col-md-8"> 
                                                        <?php //echo form_select(array('id' => 'order', 'required' => 'required', 'name' => 's_order', 'class' => 'form-control')); ?>
                                                        <select id="order" name="status" class="form-control" required>
                                                            <option value="" >Choose</option>
                                                            <option value="1">Active</option>
                                                            <option value="2">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                                                        <input type="hidden" name="course_id" value="<?php echo $id ?>" />
                                                        <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit', 'class' => 'btn red')); ?>
                                                        <button type="button" class="btn default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
<style>
#output_image {width: 60px;height: 60px;object-fit: cover;border: 1px solid #ccc;padding: 2px;border-radius: 5px;margin-top: 0;}
</style>
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
function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<?php //$this->load->view ('footer');?>