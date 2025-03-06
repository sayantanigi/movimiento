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
        <form action="<?=admin_url('course/add_certif_course/'.$course->id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                  <!--  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Course Category</label>
                      <select name="frm[cat_id]" class="form-control">
                        <option value="">Choose</option>
                        <?php foreach ($course_cat as $cat) { ?>
                        <option <?php if($course->cat_id == $cat->id){ echo"selected";} ?> value="<?=$cat->id?>"><?=$cat->name?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div> -->
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Course Title</label>
                      <input type="text" name="frm[title]" value="<?=$course->title?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Course Name">
                    </div>
                  </div>
                </div>
                  <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Course Benefits</label>
                      <textarea name="frm[meta_descr]" class="form-control" rows="3"><?=$course->meta_descr?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea name="frm[description]" id="editor1"><?=$course->description?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Course Price(In $)</label>
                      <input type="text" name="frm[price]" value="<?=$course->price?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Price">
                    </div>
                  </div>
                 <!--   <div class="col-sm-6">
                   <div class="form-group">
                      <label for="exampleInputEmail1">Video</label>
                      <input type="file" name="video" value="<?=$course->video?>" class="form-control" id="exampleInputEmail1">
                    </div>
                  </div> -->
                 
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <img src="<?=site_url('assets/images/courses/'.$course->image)?>" onerror="this.src='<?=site_url()?>assets/images/no-image.png';" class="img-responsive" style="width:100px">
                      <label for="exampleInputEmail1">Image</label>
                      <input type="file" name="image" value="<?=$course->video?>" class="form-control" id="exampleInputEmail1">
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="frm[status]" class="form-control">
                        <option <?php if($course->status ==1){ echo"selected";} ?> value="1">Active</option>
                        <option <?php if($course->status ==0){ echo"selected";} ?>value="0">Inactive</option>
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