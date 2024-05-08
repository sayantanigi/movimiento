<!-- Main content -->
<section class="content-header">
  <h1>
    <?= $title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?= admin_url('course/course_list') ?>"> Course List</a></li>
    <li><a href="<?= admin_url('course/module_list/'.$course_id) ?>"> Module List</a></li>
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
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('course/update_save_module/'.$this->uri->segment(4).'/'.$this->uri->segment(5))?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="course_id" value="<?php echo @$course_id; ?>">
          <input type="hidden" name="module_id" value="<?php echo @$module_id; ?>">
          <?php
            if (@$course->module_image && file_exists('./uploads/modules/' . @$course->module_image)) {
              $image = base_url('./uploads/modules/' . @$course->module_image);
            } else {
              $image = base_url('assets/images/no-image.png');
            }
          ?>
          <div class="box-body">
            <div class="container">
              <div class="row">
              <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="usrImage">Image</label>
                      <input type="hidden" name="old_image" value="<?php echo @$course->module_image; ?>">
                      <div class="custom-file">
                        <input type="file" accept="image/*" class="form-control" name="module_image" id="customFile" onchange="preview_image(event)">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-2 text-left">
                    <label></label>
                    <img id="output_image" src="<?php echo @$image; ?>" />
                  </div>
                </div>

                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Module Name</label>
                       <input type="text" name="frm[name]" value="<?=@$course->name?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Chapter/Topic Name">
                    </div>
                  </div>
                   <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="frm[status]" class="form-control">
                        <option <?php if($course->status=="1"){ echo"selected";} ?> value="1">Active</option>
                        <option <?php if($course->status=="0"){ echo"selected";} ?> value="0">Inactive</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea name="frm[module_descriptions]" id="editor1"><?=@$course->module_descriptions?></textarea>
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
      <!-- /.box -->
    </div>
  </div>
</section>