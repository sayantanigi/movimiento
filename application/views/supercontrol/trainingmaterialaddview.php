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
                                            <a href="javascript:;" class="collapse"></a>
                                            <a href="#portlet-config" data-toggle="modal" class="config"></a> 
                                            <a href="javascript:;" class="reload"></a>
                                            <a href="javascript:;" class="remove"></a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form action="<?php echo base_url().'supercontrol/course/add_course_trainingmaterial/'.$id ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Module Name</label>
                                                    <div class="col-md-8">
                                                        <select name="module" class="form-control" id="module">
                                                            <option value="">Select Module</option>
                                                            <?php foreach ($module as $crse) { ?>
                                                            <option value="<?= $crse->id ?>"><?= $crse->name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Material Type</label>
                                                    <div class="col-md-8">
                                                        <select name="material_type" class="form-control" id="ordr">
                                                            <option value="">Choose</option>
                                                            <option value="video">Video</option>
                                                            <option value="resource">Resource</option>
                                                            <option value="quiz">Quiz</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="vid_type">
                                                    <label class="control-label col-md-3">Video Type</label>
                                                    <div class="col-md-8">
                                                        <select name="video_type" class="form-control" id="v_type" onchange="videoclick()">
                                                            <option value="">Choose</option>
                                                            <option value="youtube">Youtube</option>
                                                            <option value="video">Video File</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="video_link">
                                                    <label class="control-label col-md-3">Enter Youtube Video URL</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="video_url" value="" class="form-control" placeholder="Enter Youtube Video URL">
                                                    </div>
                                                </div>
                                                <div class="form-group" id="videof">
                                                    <label class="control-label col-md-3">Video</label>
                                                    <div class="col-md-8">
                                                        <input type="file" name="video_file" value="" accept="video/*" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group" id="res_doc">
                                                    <label class="control-label col-md-3">Resource Document files</label>
                                                    <div class="col-md-8">
                                                        <input type="file" class="form-control" name="files[]" multiple />
                                                    </div>
                                                    <label class="control-label col-md-3">Resource Document Text</label>
                                                    <div class="col-md-8">
                                                        <textarea name="material_description" id="editor1"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="quiz_s">
                                                    <h3 style="text-align: center;">Quiz Section</h3>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Question</label>
                                                        <div class="col-md-8">
                                                            <textarea name="ques[]" class="form-control" id="exampleInputEmail1" placeholder="Enter Question1" rows="10"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Image</label>
                                                        <div class="col-md-8">
                                                            <input type="file" name="file_name[]" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Option1</label>
                                                            <input type="text" name="ans1[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Option1 Image</label>
                                                            <input type="file" name="option1_file_name[]" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Option2</label>
                                                            <input type="text" name="ans2[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Option2 Image</label>
                                                            <input type="file" name="option2_file_name[]" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Option3</label>
                                                            <input type="text" name="ans3[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Option3 Image</label>
                                                            <input type="file" name="option3_file_name[]" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Option4</label>
                                                            <input type="text" name="ans4[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Option4 Image</label>
                                                            <input type="file" name="option4_file_name[]" class="form-control">
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input type="checkbox" id="upload_option" name="ans_img_flag[]" value="1">
                                                        <label for="upload_option">Checked for image upload option with answer</label>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Choose Correct Answer</label>
                                                            <select name="cor_ans[]" class="form-control">
                                                                <option value="">Choose</option>
                                                                <option value="ans1">Option1</option>
                                                                <option value="ans2">Option2</option>
                                                                <option value="ans3">Option3</option>
                                                                <option value="ans4">Option4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <div class="col-sm-12 form-group">
                                                        <button type="button" id="addmoreques" class="btn btn-primary">Add More question</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Status</label>
                                                <div class="col-md-8">
                                                    <select name="status" class="form-control">
                                                        <option value="">Choose</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                                                        <input type="hidden" name="course_id" value="<?php echo $id; ?>" />
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
<!-- <script src="<?php echo base_url(); ?>js/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.datetimepicker.full.js"></script>-->
<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script> 
<script>
    CKEDITOR.replace('editor1');
$(document).ready(function () {
    $('#vid_type').hide();
    $('#video_link').hide();
    $('#quiz_s').hide();
    $('#res_doc').hide();
    $('#videof').hide();
    $('#addmoreques').hide();
    $("#ordr").change(function () {
        var orderBy = $(this).val();
        if (orderBy == "") {
            $('#vid_type').hide();
            $('#video_link').hide();
            $('#quiz_s').hide();
            $('#res_doc').hide();
            $('#videof').hide();
            $('#addmoreques').hide();
        } else if (orderBy == 'video') {
            $('#quiz_s').hide();
            $('#res_doc').hide();
            $('#vid_type').show();
            $('#video_link').hide();
            $('#videof').hide();
            $('#addmoreques').hide();
        } else if (orderBy == 'resource') {
            $('#res_doc').show();
            $('#video_link').hide();
            $('#vid_type').hide();
            $('#quiz_s').hide();
            $('#videof').hide();
            $('#addmoreques').hide();
        } else if (orderBy == 'quiz') {
            $('#quiz_s').show();
            $('#vid_type').hide();
            $('#video_link').hide();
            $('#videof').hide();
            $('#res_doc').hide();
            $('#addmoreques').show();
        }
    });
});
function videoclick() {
    var vdd = document.getElementById("v_type").value;
    if (vdd == 'youtube') {
        $('#video_link').show();
        $('#videof').hide();
    } else if(vdd == 'video'){
        $('#videof').show();
        $('#video_link').hide();
    } else {
        $('#video_link').hide();
        $('#videof').hide();
    }
}
//CKEDITOR.replace('editor1');
$(document).ready(function () {
    var i = 1;
    $('#addmoreques').click(function () {
        i++;
        $('#quiz_s').append('<div class="col-sm-12" style="margin-top:20px;" id="morques' + i + '"><button style="margin-top:41px; margin-left: 20px;" type="button" name="remove" id="' + i + '" class="btn btn-danger btn-sm btn_remove">X</button><div class="col-sm-11" style="padding: 15px 0 0 0;"><div class="form-group"><label for="exampleInputEmail1">Question</label><textarea name="ques[]" class="form-control" id="exampleInputEmail1" placeholder="Enter Question" rows="10"></textarea></div></div><div class="col-sm-12" style="padding: 15px 0 0 0;"><div class="form-group"><label for="exampleInputEmail1">Image</label><input type="file" name="file_name[]" class="form-control"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option1</label><input type="text" name="ans1[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option1 Image</label><input type="file" name="option1_file_name[]" class="form-control"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option2</label><input type="text" name="ans2[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option2 Image</label><input type="file" name="option2_file_name[]" class="form-control"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option3</label> <input type="text" name="ans3[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option3 Image</label><input type="file" name="option3_file_name[]" class="form-control"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option4</label><input type="text" name="ans4[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option4 Image</label><input type="file" name="option4_file_name[]" class="form-control"></div></div><div class="col-sm-12" style="padding: 15px 0 0 0;"><div class="form-group"><label for="exampleInputEmail1">Choose Correct Answer</label> <select name="cor_ans[]" class="form-control"><option value="">Choose</option><option  value="ans1">Option1</option><option value="ans2">Option2</option><option value="ans3">Option3</option><option value="ans4">Option4</option></select></div></div>')
    });
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#morques' + button_id + '').remove();
    });
});
$(document).ready(function () {
    var j = 1;
    $('#addmoreques_edit').click(function () {
        j++;
        $('#quiz_s_edt').append('<div class="col-sm-12" style="margin-top:20px;" id="morques' + j + '"><button style="margin-top:41px; margin-left: 20px;" type="button" name="remove" id="' + j + '" class="btn btn-danger btn-sm btn_remove">X</button><div class="col-sm-11" style="padding: 15px 0 0 0;"><div class="form-group"><label for="exampleInputEmail1">Question</label><textarea name="ques[]" class="form-control" id="exampleInputEmail1" placeholder="Enter Question" rows="10"></textarea></div></div><div class="col-sm-12" style="padding: 15px 0 0 0;"><div class="form-group"><label for="exampleInputEmail1">Image</label><input type="file" name="file_name[]" class="form-control"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option1</label><input type="text" name="ans1[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option1 Image</label><input type="file" name="option1_file_name[]" class="form-control"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option2</label><input type="text" name="ans2[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option2 Image</label><input type="file" name="option2_file_name[]" class="form-control"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option3</label> <input type="text" name="ans3[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option3 Image</label><input type="file" name="option3_file_name[]" class="form-control"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option4</label><input type="text" name="ans4[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer"></div></div><div class="col-sm-6" style="padding: 15px 15px 0 0;"><div class="form-group"><label for="exampleInputEmail1">Option4 Image</label><input type="file" name="option4_file_name[]" class="form-control"></div></div><div class="col-sm-12" style="padding: 15px 0 0 0;"><div class="form-group"><label for="exampleInputEmail1">Choose Correct Answer</label> <select name="cor_ans[]" class="form-control"><option value="">Choose</option><option  value="ans1">Option1</option><option value="ans2">Option2</option><option value="ans3">Option3</option><option value="ans4">Option4</option></select></div></div>')
    });

    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#morquesedt' + button_id + '').remove();
    });
});
function removedQuiz(id) {
    $('#quizRemoved-' + id).remove();
}
</script>
<?php //$this->load->view ('footer');?>