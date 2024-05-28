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
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Course Category Lists</h3> -->
              <a href="<?=admin_url('course/add_chapters')?>" class="pull-right btn btn-primary">Add</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Course Name</th>
                  <th>Chapter Name</th>
                  <th style="width: 40px">Action</th>
                </tr>
                <?php
                  if(is_array($chap) && count($chap)>0){
                    $i=1;
                    foreach ($chap as $course_v) {
                      $crsnm = $this->db->get_where('courses',array('id'=>$course_v->course_id))->row();
                      ?>
                      <tr>
                        <td><?=$i?></td> 
                        <td><?=$crsnm->title?></td>
                        <td><?=$course_v->name?></td>
                        <td>
                          <div class="action-button">
                            <a href="<?=admin_url('course/add_compliance_chapters/'.$course_v->id)?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                            <a href="<?=admin_url('course/delete_chapter/'.$course_v->id)?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
                          </div>
                        </td>
                      </tr>
                      <?php
                    $i++;
                    }
                  }
                ?>
              </table>
            </div>
            <!-- /.box-body -->
           
          </div>
          <!-- /.box -->
        </div>
      </div>