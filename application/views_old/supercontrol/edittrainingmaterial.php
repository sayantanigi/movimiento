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
                    <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i></li>
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
                                        <div class="tools"> <a href="javascript:;" class="collapse"></a>
                                            <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                            <a href="javascript:;" class="reload"></a>
                                            <a href="javascript:;" class="remove"></a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <?php
                                        //echo "<pre>"; print_r($slist); die();
                                        if ($slist != '') {
                                        foreach ($slist as $ll) { ?>
                                        <form action="<?php echo base_url().'supercontrol/course/edit_trainingmaterial/'.$course_id.'/'.$mat_id?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Module Name</label>
                                                    <div class="col-md-8">
                                                        <select name="module" class="form-control" id="module">
                                                            <option value="">Select Module</option>
                                                            <?php foreach ($module as $crse) { ?>
                                                            <option value="<?= $crse->id ?>" <?php if(@$ll->module==$crse->id) { echo"selected"; } ?>><?= $crse->name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Material Type</label>
                                                    <div class="col-md-8">
                                                        <select name="material_type" class="form-control" id="ordr">
                                                            <option value="">Choose</option>
                                                            <option value="video" <?php if(@$ll->material_type=='video') { echo"selected"; } ?>>Video</option>
                                                            <option value="resource" <?php if(@$ll->material_type=='resource') { echo"selected"; } ?>>Resource</option>
                                                            <option value="quiz" <?php if(@$ll->material_type=='quiz') { echo"selected"; } ?>>Quiz</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="vid_type2" style="display: <?php if(@$ll->material_type=='video') { echo"block"; } else { echo"none"; } ?>">
                                                    <label class="control-label col-md-3">Video Type</label>
                                                    <div class="col-md-8">
                                                        <select name="video_type" class="form-control" id="v_type" onchange="videoclick()">
                                                            <option value="">Choose</option>
                                                            <option value="youtube" <?php if(@$ll->video_type=='youtube') { echo"selected"; } ?>>Youtube</option>
                                                            <option value="video" <?php if(@$ll->video_type=='video') { echo"selected"; } ?>>Video File</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div style="display: <?php if(@$ll->material_type=='video') { echo"block"; } else { echo"none"; } ?>">
                                                    <div class="form-group" id="video_link2" style="display: <?php if(@$ll->video_type=='youtube') { echo"block"; } else { echo"none"; } ?>">
                                                        <label class="control-label col-md-3">Enter Youtube Video URL</label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="video_url" value="<?php echo @$ll->video_url; ?>" class="form-control" placeholder="Enter Youtube Video URL">
                                                        </div>
                                                    </div>
                                                    <div class="form-group" id="videof2" style="display: <?php if(@$ll->video_type=='video') { echo"block"; } else { echo"none"; } ?>">
                                                        <label class="control-label col-md-3">Video</label>
                                                        <div class="col-md-8">
                                                            <input type="file" name="video_file" value="" accept="video/*" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group" id="res_doc2" style="display: <?php if(@$ll->material_type=='resource') { echo"block"; } else { echo"none"; } ?>">
                                                    <div style="margin-bottom:5px;">
                                                        <?php $fileList = $this->db->get_where('course_resources', array('material_id' => $ll->id))->result();
                                                        if (!empty($fileList)) {
                                                        $k = 1;
                                                        foreach ($fileList as $file) { ?>
                                                        <div>
                                                            <a href="javascript:void(0);" onclick="deleteFile('<?= @$file->id ?>', '<?= @$file->course_id ?>', '<?= @$file->material_id ?>')" class="" style="color:#dd4b39; margin-right: 5px;">
                                                                <span class="fa fa-trash"></span>
                                                            </a>
                                                            <?php echo @$file->resource_file ?></div>
                                                        <?php $k++; } } ?>
                                                    </div>
                                                    <label class="control-label col-md-3">Resource Document files</label>
                                                    <div class="col-md-8">
                                                        <input type="file" class="form-control" name="files[]" multiple />
                                                    </div>
                                                    <label class="control-label col-md-3">Resource Document Text</label>
                                                    <div class="col-md-8">
                                                        <textarea name="material_description" id="editor1"><?php echo @$ll->material_description; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group" id="quiz_s_edt" style="display: <?php if(@$ll->material_type=='quiz') { echo"block"; } else { echo"none"; } ?>">
                                                    <h3 style="text-align: center;">Quiz Section</h3>
                                                    <?php
                                                    $quizList = $this->db->get_where('course_quiz', array('material_id' => $ll->id))->result();
                                                    if (!empty($quizList)) {
                                                    foreach ($quizList as $qs) { ?>
                                                    <div id="quizRemoved-<?= @$qs->id ?>">
                                                        <div class="col-sm-11" style="padding-right: 0;">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Question</label>
                                                                <input type="text" name="ques[]" value="<?= $qs->question ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Question1">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group">
                                                                <button style="margin-top:27px;" type="button" name="remove" id="2" class="btn btn-danger btn-sm" onclick="removedQuiz('<?= @$qs->id ?>');">X</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Image</label>
                                                                <?php if (@$qs->quiz_file && file_exists('./uploads/quizs/' . @$qs->quiz_file)) { ?>
                                                                <input type="hidden" name="old_image[]" value="<?php echo @$qs->quiz_file; ?>">
                                                                <img src="<?= base_url('uploads/quizs/' . @$qs->quiz_file) ?>" alt="" style="width: auto; max-height: 59px; padding: 1px; border: 2px solid #ccc;background: #ccc;">
                                                                <?php } else { ?>
                                                                <input type="hidden" name="old_image[]" value="">
                                                                <img src="<?= base_url('images/thumbs.jpg') ?>" alt="" style="width: auto; max-height: 52px; padding: 1px; border: 2px solid #e87c03;background: #ccc;">
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Image</label>
                                                                <input type="file" name="file_name[]" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Option1</label>
                                                                    <input type="text" name="ans1[]" value="<?= $qs->ans1 ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Option1 Image</label>
                                                                    <input type="file" name="option1_file_name[]" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Option1 Image</label>
                                                                    <?php if (@$qs->ans1_file && file_exists('./uploads/quizs/answer_files/' . @$qs->ans1_file)) { ?>
                                                                    <input type="hidden" name="ans1_old_image[]" value="<?php echo @$qs->ans1_file; ?>">
                                                                    <img src="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans1_file) ?>" alt="" style="width: auto; max-height: 50px; padding: 1px; border: 2px solid #ccc;background: #ccc;">
                                                                    <?php } else { ?>
                                                                    <input type="hidden" name="ans1_old_image[]" value="">
                                                                    <img src="<?= base_url('images/thumbs.jpg') ?>" alt="" style="width: auto; max-height: 50px; padding: 1px; border: 2px solid #e87c03;background: #ccc;">
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Option2</label>
                                                                    <input type="text" name="ans2[]" value="<?= $qs->ans2 ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Option2 Image</label>
                                                                    <input type="file" name="option2_file_name[]" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Option2 Image</label>
                                                                    <?php if (@$qs->ans2_file && file_exists('./uploads/quizs/answer_files/' . @$qs->ans2_file)) { ?>
                                                                    <input type="hidden" name="ans2_old_image[]" value="<?php echo @$qs->ans2_file; ?>">
                                                                    <img src="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans2_file) ?>" alt="" style="width: auto; max-height: 50px; padding: 1px; border: 2px solid #ccc;background: #ccc;">
                                                                    <?php } else { ?>
                                                                    <input type="hidden" name="ans2_old_image[]" value="">
                                                                    <img src="<?= base_url('images/thumbs.jpg') ?>" alt="" style="width: auto; max-height: 50px; padding: 1px; border: 2px solid #e87c03;background: #ccc;">
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Option3</label>
                                                                    <input type="text" name="ans3[]" value="<?= $qs->ans3 ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Option3 Image</label>
                                                                    <input type="file" name="option3_file_name[]" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Option3 Image</label>
                                                                    <?php if (@$qs->ans3_file && file_exists('./uploads/quizs/answer_files/' . @$qs->ans3_file)) { ?>
                                                                    <input type="hidden" name="ans3_old_image[]" value="<?php echo @$qs->ans3_file; ?>">
                                                                    <img src="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans3_file) ?>" alt="" style="width: auto; max-height: 50px; padding: 1px; border: 2px solid #ccc;background: #ccc;">
                                                                    <?php } else { ?>
                                                                    <input type="hidden" name="ans3_old_image[]" value="">
                                                                    <img src="<?= base_url('images/thumbs.jpg') ?>" alt="" style="width: auto; max-height: 50px; padding: 1px; border: 2px solid #e87c03;background: #ccc;">
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Option4</label>
                                                                    <input type="text" name="ans4[]" value="<?= $qs->ans4 ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Option4 Image</label>
                                                                    <input type="file" name="option4_file_name[]" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Option4 Image</label>
                                                                    <?php if (@$qs->ans4_file && file_exists('./uploads/quizs/answer_files/' . @$qs->ans4_file)) { ?>
                                                                    <input type="hidden" name="ans4_old_image[]" value="<?php echo @$qs->ans4_file; ?>">

                                                                            <img src="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans4_file) ?>" alt="" style="width: auto; max-height: 50px; padding: 1px; border: 2px solid #ccc;background: #ccc;">
                                                                        <?php } else { ?>
                                                                    <input type="hidden" name="ans4_old_image[]" value="">

                                                                            <img src="<?= base_url('images/thumbs.jpg') ?>" alt="" style="width: auto; max-height: 50px; padding: 1px; border: 2px solid #e87c03;background: #ccc;">
                                                                        <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12" style="margin-bottom: 15px;">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Choose Correct Answer</label>
                                                                <select name="cor_ans[]" class="form-control">
                                                                <option value="ans1" <?php if(@$qs->correct_answer=='ans1') { echo"selected"; } ?>>Option1</option>
                                                                <option value="ans2" <?php if(@$qs->correct_answer=='ans2') { echo"selected"; } ?>>Option2</option>
                                                                <option value="ans3" <?php if(@$qs->correct_answer=='ans3') { echo"selected"; } ?>>Option3</option>
                                                                <option value="ans4" <?php if(@$qs->correct_answer=='ans4') { echo"selected"; } ?>>Option4</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } } else { echo"&#8212;"; } ?>
                                                </div>
                                            </div>

                                            <div class="row" style="display: <?php if(@$ll->material_type=='quiz') { echo"block"; } else { echo"none"; } ?>">
                                                <div class="col-sm-10">
                                                    <div class="col-sm-12 form-group">
                                                        <button type="button" id="addmoreques_edit" class="btn btn-primary">Add More question</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Status</label>
                                                <div class="col-md-8">
                                                    <select name="status" class="form-control">
                                                        <option value="">Choose</option>
                                                        <option value="1" <?php if(@$ll->status=='1') { echo"selected"; } ?>>Active</option>
                                                        <option value="0" <?php if(@$ll->status=='0') { echo"selected"; } ?>>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <input type="hidden" name="training_material_id" value="<?php echo $ll->id; ?>" />
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
<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
<link href="<?= base_url('assets/sweetalert/sweetalert.css') ?>" rel="stylesheet" type="text/css">
<script src="<?= base_url('assets/sweetalert/sweetalert.min.js') ?>"></script>
<script src="<?= base_url('assets/sweetalert/jquery.sweet-alert.custom.js') ?>"></script>
<script>
CKEDITOR.replace('editor1');
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
    minDate: '-2016/11/03', // yesterday is minimum date
});
$('#datetimepicker_dark').datetimepicker({ theme: 'dark' })

function deleteFile(id, course_id, material_id) {
    swal({
        title: 'Are You sure want to delete this file?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#36A1EA',
        cancelButtonColor: '#e50914',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        closeOnConfirm: true,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) {
            window.location.href = '<?= base_url('supercontrol/course/deleteMaterialFile/') ?>' + id + '/' + course_id + "/" + material_id
        }
    });
}
$(document).ready(function () {
            var j = 1;
            $('#addmoreques_edit').click(function () {
                j++;
                $('#quiz_s_edt').append('<div class="col-sm-10" style="margin-top:20px;" id="morques' + j + '"><button style="margin-top:27px;" type="button" name="remove" id="' + j + '" class="btn btn-danger btn-sm btn_remove">X</button><div class="col-sm-11"><div class="form-group"><label for="exampleInputEmail1">Question</label><input type="text" name="ques[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Question"></div></div><div class="col-sm-12"><div class="form-group"><label for="exampleInputEmail1">Image</label><input type="file" name="file_name[]" class="form-control"></div></div><div class="col-sm-6"><div class="form-group"><label for="exampleInputEmail1">Option1</label><input type="text" name="ans1[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer"></div></div><div class="col-sm-6"><div class="form-group"><label for="exampleInputEmail1">Option1 Image</label><input type="file" name="option1_file_name[]" class="form-control"></div></div><div class="col-sm-6"><div class="form-group"><label for="exampleInputEmail1">Option2</label><input type="text" name="ans2[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer"></div></div><div class="col-sm-6"><div class="form-group"><label for="exampleInputEmail1">Option2 Image</label><input type="file" name="option2_file_name[]" class="form-control"></div></div><div class="col-sm-6"><div class="form-group"><label for="exampleInputEmail1">Option3</label> <input type="text" name="ans3[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer"></div></div><div class="col-sm-6"><div class="form-group"><label for="exampleInputEmail1">Option3 Image</label><input type="file" name="option3_file_name[]" class="form-control"></div></div><div class="col-sm-6"><div class="form-group"><label for="exampleInputEmail1">Option4</label><input type="text" name="ans4[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer"></div></div><div class="col-sm-6"><div class="form-group"><label for="exampleInputEmail1">Option4 Image</label><input type="file" name="option4_file_name[]" class="form-control"></div></div><div class="col-sm-12"><div class="form-group"><label for="exampleInputEmail1">Choose Correct Answer</label> <select name="cor_ans[]" class="form-control"><option  value="ans1">Option1</option><option value="ans2">Option2</option><option value="ans3">Option3</option><option value="ans4">Option4</option></select></div></div>')
            });

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                //alert(button_id);
                $('#morques' + button_id + '').remove();
            });
        });
function removedQuiz(id) {
    $('#quizRemoved-' + id).remove();
}
</script>
<?php //$this->load->view ('footer');?>