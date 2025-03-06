<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add Gallery Images</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('gallery/add_image/'.$id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
               <!--  <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="title" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                  </div>
                </div> -->
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Image</label>
                      <input type="file" name="image[]" multiple>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>