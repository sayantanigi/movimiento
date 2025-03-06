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
        <form action="<?=admin_url('question/add')?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
                <div class="row">
                  <div class="col-sm-10">
                   <h3>Final Test Quiz Section</h3>
                    <div class="col-sm-6">
                     <div class="form-group">
                      <label for="exampleInputEmail1">Select Course Category</label>
                      <select name="cat_id" class="form-control" onchange="getvalue(this);" required>
                        <option value="">Choose</option>
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
                </div>
                </div>
                <div class="row" id="quiz_quess">
                <div class="col-sm-10">
                    <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Question</label>
                      <input type="text" name="ques[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Question1" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Option1</label>
                       <input type="text" name="ans1[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer" autocomplete="off">
                    </div>
                  </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Option2</label>
                       <input type="text" name="ans2[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer" autocomplete="off">
                    </div>
                  </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Option3</label>
                       <input type="text" name="ans3[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer" autocomplete="off">
                    </div>
                  </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Option4</label>
                       <input type="text" name="ans4[]" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer" autocomplete="off">
                    </div>
                  </div>
                   <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Choose Correct Answer</label>
                      <select name="cor_ans[]" class="form-control">
                        <option  value="ans1">Option1</option>
                        <option value="ans2">Option2</option>
                        <option value="ans3">Option3</option>
                        <option value="ans4">Option4</option>
                      </select>
                    </div>
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-sm-12">
                   <button type="button" id="addmorequesbank" class="btn btn-primary">Add More question</button>
                </div>
               
              </div>
              
              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="frm[status]" class="form-control">
                        <option  value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                 <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
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