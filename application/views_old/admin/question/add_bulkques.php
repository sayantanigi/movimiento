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
          <h3 class="box-title">Add Bulk Questions</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
     
              <!-- form start -->
        <form action="<?=admin_url('question/addbulkquestions')?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                   <div class="col-sm-6">
                     <div class="form-group">
                      <label for="exampleInputEmail1">Select Course Category</label>
                      <select name="cat_id" class="form-control" onchange="getvalue(this);" required>
                        <option value="">Select</option>
                        <option  value="1">Compliance Training</option>
                        <option  value="2">Certificate Courses</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group">
                      <label for="exampleInputEmail1">Select Course</label>
                      <select name="course_id" class="form-control" id="courselist" required>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Import csv File For bulk question uploading</label>
                      <input type="file" name="file" accept=".csv"/>
                    </div>
                  </div>
                   <div class="box-footer">
                  <button type="submit" name="importSubmit" class="btn btn-primary">Import</button>
                </div>
                </div>
         
              </div>
            </div>
          </div>
         
        </form>
      <!-- /.box -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>