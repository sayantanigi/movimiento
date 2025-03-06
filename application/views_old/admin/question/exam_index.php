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
          <!-- <h3 class="box-title">Add Service</h3> -->
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="" method="post">
          <div class="box-body">
            <div class="container">
                <div class="row">
                  <div class="col-sm-10">
                   <h3>Final Test Quiz Section</h3>
                    <div class="col-sm-8">
                     <div class="form-group">
                      <label for="exampleInputEmail1">Select Course</label>
                      <select name="course_id" class="form-control" required>
                         <option value="">Select One</option>
                        <?php foreach ($courses as $crs) { ?>
                        <option  value="<?=$crs->id?>"><?=$crs->title?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                   <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">No.of Question</label>
                      <input type="number" name="ques_no" class="form-control" id="exampleInputEmail1" placeholder="Enter No.of Questions" autocomplete="off">
                    </div>
                  </div>
                </div>
                </div>
             
              <div class="row">
                <div class="col-sm-6 col-sm-offset-4">
                 <div class="box-footer">
            <input type="submit" class="btn btn-primary" value="Set Quiz">
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