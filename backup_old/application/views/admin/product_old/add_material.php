<!-- Main content -->

<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= admin_url('course/course_list') ?>"> Course List</a></li>
        <li><a href="<?= admin_url('course/material_list/' . $course_id) ?>"> Material List</a></li>
        <li class="active">
            <?= $title ?>
        </li>
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
                <form action="<?= admin_url('course/save_materials/' . $crsid) ?>" method="post" id="form_validation"
                    enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <!-- <h3>Step One....</h3> -->
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Module Name</label>
                                            <select name="module" class="form-control" required>
                                                <option value="">Choose Module</option>
                                                <?php foreach ($module as $crse) {
                                                    ?>
                                                    <option value="<?= $crse->id ?>">
                                                        <?= $crse->name ?>
                                                    </option>
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
                                                <option value="">Choose</option>
                                                <option value="video">Video</option>
                                                <option value="resource">Resource</option>
                                                <option value="quiz">Quiz</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6" id="vid_type">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Video Type</label>
                                            <select name="video_type" class="form-control" id="v_type"
                                                onchange="videoclick()">
                                                <option value="">Choose</option>
                                                <option value="youtube">Youtube</option>
                                                <option value="video">Video File</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-10">
                                    <div class="col-sm-6" id="video_link">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Enter Youtube Video URL</label>
                                            <input type="text" name="video_url" value="" class="form-control"
                                                placeholder="Enter Youtube Video URL">
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="videof">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Video</label>
                                            <input type="file" name="video_file" value="" accept="video/*"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-10" id="res_doc">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Resource Document files</label>
                                            <input type="file" class="form-control" name="files[]" multiple />
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Resource Document Text1</label>
                                            <textarea name="material_description" id="editor1"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row" id="quiz_s">
                                <div class="col-sm-10">
                                    <h3>Quiz Section</h3>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Question</label>
                                            <textarea name="ques[]" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter Question" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Image</label>
                                            <input type="file" name="file_name[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Option1</label>
                                            <input type="text" name="ans1[]" value="" class="form-control"
                                                id="exampleInputEmail1" placeholder="Enter Answer">
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
                                            <input type="text" name="ans2[]" value="" class="form-control"
                                                id="exampleInputEmail1" placeholder="Enter Answer">
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
                                            <input type="text" name="ans3[]" value="" class="form-control"
                                                id="exampleInputEmail1" placeholder="Enter Answer">
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
                                            <input type="text" name="ans4[]" value="" class="form-control"
                                                id="exampleInputEmail1" placeholder="Enter Answer">
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
                                        <button type="button" id="addmoreques" class="btn btn-primary">Add More
                                            question</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" name="submit"
                                            value="addMaterials">Submit</button>
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