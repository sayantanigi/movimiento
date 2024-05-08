<!-- Main content -->
<section class="content-header">
  <h1>
    <?= $title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
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
          <h3 class="box-title">Add pages</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('cms/add/'.$pages->id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Page</label>
                      <input type="text" name="frm[page]" value="<?=$pages->page?>" disabled class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="frm[title]" value="<?=$pages->title?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                  </div>
                   <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta Title</label>
                      <input type="text" name="frm[meta_title]" value="<?=$pages->meta_title?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Meta Title">
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta Description</label>
                      <textarea name="frm[meta_description]" class="form-control" value="<?=$pages->meta_description?>" id="editor133"><?=$pages->meta_description?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea name="frm[description]" value="" id="editor1"><?=$pages->description?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                <?php if($pages->id=="1" || $pages->id=="21" || $pages->id=="24" || $pages->id=="26") { ?>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <img src="<?=site_url('uploads/cms/'.$pages->image)?>" onerror="this.src='<?=site_url()?>assets/images/no-image.png';" class="img-responsive" style="width:100px">
                      <label for="exampleInputEmail1">Image</label>
                      <input type="hidden" name="old_image" value="<?php echo @$pages->image; ?>">
                      <input type="file" name="image" value="<?=$pages->image?>" class="form-control" id="exampleInputEmail1">
                    </div>
                  </div>
                <?php } 
                if($pages->id=="21" || $pages->id=="24") { ?>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <img src="<?=site_url('uploads/cms/'.$pages->image1)?>" onerror="this.src='<?=site_url()?>assets/images/no-image.png';" class="img-responsive" style="width:100px">
                      <label for="exampleInputEmail1">Alternate Image</label>
                      <input type="hidden" name="old_image1" value="<?php echo @$pages->image1; ?>">
                      <input type="file" name="image1" value="<?=$pages->image1?>" class="form-control" id="exampleInputEmail1">
                    </div>
                  </div>
                <?php } ?>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="frm[status]" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
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