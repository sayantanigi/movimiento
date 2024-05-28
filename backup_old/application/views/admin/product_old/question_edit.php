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
        <form action="<?= admin_url('course/edit_question/' . $this->uri->segment(4) . '/' . $quizq->id) ?>" method="post">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-12">
                  <h3>Quiz Section</h3>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Question</label>
                      <input type="text" name="frm[ques]" value="<?= $quizq->question ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Question1">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Option1</label>
                      <input type="text" name="frm[ans1]" value="<?= $quizq->ans1 ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Option2</label>
                      <input type="text" name="frm[ans2]" value="<?= $quizq->ans2 ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Option3</label>
                      <input type="text" name="frm[ans3]" value="<?= $quizq->ans3 ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Option4</label>
                      <input type="text" name="frm[ans4]" value="<?= $quizq->ans4 ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Answer">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Correct Answer</label>
                      <input type="text" name="frm[cor_ans]" value="<?= $quizq->correct_answer ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Correct Answer">
                    </div>
                  </div>
                </div>

              </div>

              <div class="row">

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