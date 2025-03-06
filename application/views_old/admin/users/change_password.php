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
          <h3 class="box-title">Change Password</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('profile')?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                 <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Admin Username</label>
                      <input type="text" name="uname" class="form-control" id="exampleInputEmail1" placeholder="Enter Admin Username" value="<?=$rsid->username?>">
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Old Password</label>
                      <input type="password" name="old_password" class="form-control" id="exampleInputEmail1" placeholder="Enter Old Password">
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">New Password</label>
                      <input type="password" name="new_password" class="form-control" id="exampleInputEmail1" placeholder="Enter New Password">
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Re-Enter Password</label>
                      <input type="password" name="retype_password" class="form-control" id="exampleInputEmail1" placeholder="Enter Confirm Password">
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