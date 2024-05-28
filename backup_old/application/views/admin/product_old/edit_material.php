<!-- Main content -->
<section class="content-header">
  <h1>
    <?= $title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?= admin_url('course/course_list') ?>"> Course List</a></li>
    <li><a href="<?= admin_url('course/material_list/' . $course_id) ?>"> Material List</a></li>
    <li class="active"><?= $title ?></li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <!-- <h3 class="box-title">Add Service</h3> -->
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?= admin_url('course/save_edit_material/' . $this->uri->segment(4) . '/' . @$course_str->id) ?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Module Name</label>
                      <select name="module" class="form-control" required>
                        <?php foreach ($module as $crse) {
                        ?>
                          <option value="<?= $crse->id ?>" <?php if(@$course_str->module==$crse->id) { echo"selected"; } ?>><?= $crse->name ?></option>
                        <?php } ?>

                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Material Type</label>
                      <select name="material_type" class="form-control" id="ordr" required>
                        <option value="video" <?php if(@$course_str->material_type=='video') { echo"selected"; } ?> disabled>Video</option>
                        <option value="resource" <?php if(@$course_str->material_type=='resource') { echo"selected"; } ?> disabled>Resource</option>
                        <option value="quiz" <?php if(@$course_str->material_type=='quiz') { echo"selected"; } ?> disabled>Quiz</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-6" id="vid_type2" style="display: <?php if(@$course_str->material_type=='video') { echo"block"; } else { echo"none"; } ?>">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Video Type</label>
                      <select name="video_type" class="form-control" id="v_type" onchange="videoclick()">
                        <option value="youtube" <?php if(@$course_str->video_type=='youtube') { echo"selected"; } ?> disabled>Youtube</option>
                        <option value="video" <?php if(@$course_str->video_type=='video') { echo"selected"; } ?> disabled>Video File</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-sm-10" style="display: <?php if(@$course_str->material_type=='video') { echo"block"; } else { echo"none"; } ?>">
                  <div class="col-sm-12" id="video_link2" style="display: <?php if(@$course_str->video_type=='youtube') { echo"block"; } else { echo"none"; } ?>">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Enter Youtube Video URL</label>
                      <input type="text" name="video_url" value="<?php echo @$course_str->video_url; ?>" class="form-control" placeholder="Enter Youtube Video URL">
                    </div>
                  </div>
                  <div class="col-sm-12" id="videof2" style="display: <?php if(@$course_str->video_type=='video') { echo"block"; } else { echo"none"; } ?>">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Video</label>
                      <input type="file" name="video_file" value="" accept="video/*" class="form-control">
                      <input type="hidden" name="old_file" value="<?php echo @$course_str->video_file; ?>">
                    </div>
                  </div>
                </div>

                <div class="col-sm-10" id="res_doc2" style="display: <?php if(@$course_str->material_type=='resource') { echo"block"; } else { echo"none"; } ?>">
                  <div class="col-sm-12">
                    <div style="margin-bottom:5px;">
                        <?php 
                          $fileList = $this->db->get_where('course_resources', array('material_id' => $course_str->id))->result();

                          if (!empty($fileList)) {
                            $k = 1;
                            foreach ($fileList as $file) {
                        ?>
                          <div><a href="javascript:void(0);" onclick="deleteFile('<?= @$file->id ?>', '<?= @$file->course_id ?>', '<?= @$file->material_id ?>')" class="" style="color:#dd4b39; margin-right: 5px;"><span class="fa fa-trash"></span></a><?php echo @$file->resource_file ?></div>
                        <?php $k++; } } ?>
                      </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Resource Document files</label>
                      <input type="file" class="form-control" name="files[]" multiple />
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Resource Document Text</label>
                      <textarea name="material_description" id="editor1"><?php echo @$course_str->material_description; ?></textarea>
                    </div>
                  </div>
                </div>

              </div>

              <div class="row" id="quiz_s_edt" style="display: <?php if(@$course_str->material_type=='quiz') { echo"block"; } else { echo"none"; } ?>">
                <div class="col-sm-10">
                  <h3>Quiz Section</h3>
                  <?php
                      $quizList = $this->db->get_where('course_quiz', array('material_id' => $course_str->id))->result();

                      if (!empty($quizList)) {
                        foreach ($quizList as $qs) {
                    ?>
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
                    <!-- <div class="col-sm-12">
                    <div class="form-group">
                      <?php  //if($qs->ans_img_flag==1){
                        ?>
                      <input type="checkbox" checked id="upload_option" name="ans_img_flag[]" value="1">
                      <?php
                      //} else{
                        ?>
                        <input type="checkbox" id="upload_option" name="ans_img_flag[]" value="1">
                        <?php

                     // } ?>
                     
                      <label for="upload_option">Checked for image upload option with answer</label>
                    </div>
                  </div> -->
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

              <div class="row" style="display: <?php if(@$course_str->material_type=='quiz') { echo"block"; } else { echo"none"; } ?>">
                <div class="col-sm-10">
                  <div class="col-sm-12 form-group">
                    <button type="button" id="addmoreques_edit" class="btn btn-primary">Add More question</button>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="status" class="form-control">
                        <option value="1" <?php if(@$course_str->status=='1') { echo"selected"; } ?>>Active</option>
                        <option value="0" <?php if(@$course_str->status=='0') { echo"selected"; } ?>>Inactive</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="submit" value="editMaterials">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>

<script>
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
          window.location.href = '<?= admin_url('course/deleteMaterialFile/') ?>' + id + '/' + course_id + "/" + material_id
        }
      });
    }
  </script>