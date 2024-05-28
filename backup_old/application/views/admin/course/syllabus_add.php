<section class="content-header">
    <h1><?= $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= admin_url('course/course_list') ?>"> Course List</a></li>
        <li><a href="<?= admin_url('course/syllabus_list/' . $course_id) ?>"> Syllabus List</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border"></div>
                <form action="<?= admin_url('course/save_syllabus/' . $this->uri->segment(4)) ?>" method="post" enctype="multipart/form-data" id="form_validation">
                    <input type="hidden" name="course_id" value="<?php echo @$course_id; ?>">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Syllabus Title</label>
                                            <input type="text" name="frm[syllabus_name]" value="<?= $course->syllabus_name ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Syllabus Title">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Status</label>
                                            <select name="frm[status]" class="form-control">
                                                <option <?php if ($course->status == 1) { echo "selected"; } ?> value="1">Active</option>
                                                <option <?php if ($course->status == 0) { echo "selected"; } ?> value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea name="frm[syllabus_content]" id="editor1"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>