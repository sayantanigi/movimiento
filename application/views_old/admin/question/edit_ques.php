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
        <form action="<?=admin_url('question/edit_question/'.$quiz_q->id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
                <div class="row">
                  <div class="col-sm-10">
                    <div class="col-sm-12">
                   <h3>Final Test Quiz Section</h3>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Select Course</label>
                      <select name="frm[course_id]" class="form-control" required>
                         <option value="">Choose</option>
                        <?php foreach ($courses as $crs) { ?>
                        <option  value="<?=$crs->id?>" <?php if($quiz_q->course_id==$crs->id){echo"selected";} ?>><?=$crs->title?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                </div>
                <div class="row">
                <div class="col-sm-10">
                    <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Question</label>
                      <input type="text" name="frm[ques]" value="<?=$quiz_q->ques?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Question1">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Option1</label>
                       <input type="text" name="frm[ans1]" value="<?=$quiz_q->ans1?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                    </div>
                  </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Option2</label>
                       <input type="text" name="frm[ans2]" value="<?=$quiz_q->ans2?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                    </div>
                  </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Option3</label>
                       <input type="text" name="frm[ans3]" value="<?=$quiz_q->ans3?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                    </div>
                  </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Option4</label>
                       <input type="text" name="frm[ans4]" value="<?=$quiz_q->ans4?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                    </div>
                  </div>
                   <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Choose Correct Answer</label>
                      <select name="frm[cor_ans]" class="form-control">
                        <option  value="ans1" <?php if($quiz_q->cor_ans=='ans1'){ echo"selected";} ?>>Option1</option>
                        <option value="ans2" <?php if($quiz_q->cor_ans=='ans2'){ echo"selected";} ?>>Option2</option>
                        <option value="ans3" <?php if($quiz_q->cor_ans=='ans3'){ echo"selected";} ?>>Option3</option>
                        <option value="ans4" <?php if($quiz_q->cor_ans=='ans4'){ echo"selected";} ?>>Option4</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="frm[status]" class="form-control">
                        <option  value="1" <?php if($quiz_q->status==1){ echo"selected";} ?>>Active</option>
                        <option value="0" <?php if($quiz_q->status==0){ echo"selected";} ?>>Inactive</option>
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