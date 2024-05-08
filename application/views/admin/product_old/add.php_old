<!-- Main content -->
<section class="content-header">
  <h1>
    <?= $title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?= admin_url('course/course_list') ?>"> Course List</a></li>
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
        <form action="<?= admin_url('course/add_course/' . $course->id) ?>" id="form_validation" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <?php //echo "<pre>"; print_r($course_cat); echo "<br>"; print_r($course); ?>
                      <label for="exampleInputEmail1">Course Category</label>
                      <select name="frm[cat_id]" class="form-control">
                        <option value="">Choose</option>
                        <?php foreach ($course_cat as $cat) { ?>
                          <option <?php if (@$course->cat_id == $cat['id']) { echo "selected"; } ?> value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Course Name</label>
                      <input type="text" name="frm[title]" value="<?= $course->title ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Course Name">
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Heading 1</label>
                      <textarea name="frm[heading_1]" class="form-control" rows="3"><?= $course->heading_1 ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Heading 2</label>
                      <textarea name="frm[heading_2]" class="form-control" rows="3"><?= $course->heading_2 ?></textarea>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Course Benefits</label>
                      <textarea name="frm[meta_descr]" class="form-control" rows="3"><?= $course->meta_descr ?></textarea>
                    </div>
                  </div>
                </div> -->
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea name="frm[description]" id="editor1"><?= $course->description ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Program Overview</label>
                      <textarea name="frm[program_overview]" id="editor2"><?= $course->program_overview ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Objectives</label>
                      <textarea name="frm[objectives]" id="editor3"><?= $course->objectives ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Curriculam</label>
                      <textarea name="frm[curriculam]" id="editor4"><?= $course->curriculam ?></textarea>
                    </div>
                  </div>
                </div>

                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Career Paths</label>
                      <textarea name="frm[career_paths]" id="editor5"><?= $course->career_paths ?></textarea>
                    </div>
                  </div>
                </div>

                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Duration</label>
                      <input type="text" name="frm[duration]" value="<?= $course->duration ?>" class="form-control" id="exampleInputEmaila1" placeholder="Enter Course Duration">
                      <!-- <textarea name="frm[duration]" id="editor5" rows="3"><?= $course->duration ?></textarea> -->
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Course Price(In $)</label>
                      <input type="text" name="frm[price]" value="<?= $course->price ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Price">
                    </div>
                  </div>
                  <!--  <div class="col-sm-6">
                     <div class="form-group">
                      <label for="exampleInputEmail1">Video</label>
                      <input type="file" name="video" value="<?= $course->video ?>" class="form-control" id="exampleInputEmail1">
                    </div>
                  </div> -->
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price ID (Stripe Price ID) <span style="color: red">*</span></label>
                      <input type="text" name="frm[price_key]" value="<?= $course->price_key ?>" class="form-control" id="exampleInputEmaila1" placeholder="Price ID (Stripe Price ID)" required>
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <img src="<?= site_url('assets/images/courses/' . $course->image) ?>" onerror="this.src='<?= site_url() ?>assets/images/no-image.png';" class="img-responsive" style="width:100px">
                      <label for="exampleInputEmail1">Image</label>
                      <input type="file" name="image" value="<?= $course->video ?>" class="form-control" id="exampleInputEmail1">
                    </div>
                  </div>
                  <div class="col-sm-6">

                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="frm[status]" class="form-control">
                        <option <?php if ($course->status == 1) {
                                  echo "selected";
                                } ?> value="1">Active</option>
                        <option <?php if ($course->status == 0) {
                                  echo "selected";
                                } ?>value="0">Inactive</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>