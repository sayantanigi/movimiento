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
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
            
              <a href="<?=admin_url('question/add')?>" class="pull-right btn btn-primary">Add</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="faq-accordion">
          <ul class="accordion">

            <?php

             if(is_array($courselist) && count($courselist)>0){
              $i=0;
            foreach ($courselist as $fq) {
               $i++;
              $quescnt=$this->db->get_where('quiz_bank',array('course_id'=>$fq->id))->num_rows();
              $quesshw=$this->db->get_where('quiz_bank',array('course_id'=>$fq->id))->result();
            ?>
            <li class="accordion-item">
              <a class="accordion-title" href="javascript:void(0)"><i class="fa fa-plus"></i> <?=$fq->title?>(<?=$quescnt?>)</a>
              <div class="accordion-content">
              <table class="table table-bordered"> 
                <tr>
                  <th style="width: 40px"></th>
                  <th>Ques</th>
                  <th>Opt1</th>
                  <th>Opt2</th>
                  <th>Opt3</th>
                  <th>Opt4</th>
                  <th>Correct Ans</th>
                  <th>Status</th>
                  <th style="width: 40px">Action</th>
                </tr>
                <?php
                  if(is_array($quesshw) && count($quesshw)>0){
                    $j=1;
                    foreach ($quesshw as $course_v) { ?>
                      <tr>
                        <td><?=$j?></td>
                        <td><?=$course_v->ques?></td>
                        <td><?=$course_v->ans1?></td>
                        <td><?=$course_v->ans2?></td>
                        <td><?=$course_v->ans3?></td>
                        <td><?=$course_v->ans4?></td>
                        <td><?php if($course_v->cor_ans=='ans1'){
                          echo $course_v->ans1; } elseif($course_v->cor_ans=='ans2'){
                          echo $course_v->ans2; }if($course_v->cor_ans=='ans3'){
                          echo $course_v->ans3; }if($course_v->cor_ans=='ans4'){
                          echo $course_v->ans4; }
                          ?></td>
                        <td>
                          <?php
                          if($course_v->status == 1){
                            ?>
                            <a href="<?=admin_url('question/deactivate/'.$course_v->id)?>"><span class="badge bg-green">Active</span></a>
                            <?php
                          }
                          else{
                            ?>
                            <a href="<?=admin_url('question/activate/'.$course_v->id)?>"><span class="badge bg-red">Inactive</span></a>
                            <?php
                          }
                          ?>                          
                        </td>
                        <td>
                           <div class="action-button">
                            <a href="<?=admin_url('question/edit_question/'.$course_v->id)?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span> Edit </a>
                             <a href="<?=admin_url('question/delete_quesr/'.$course_v->id)?>" class="btn btn-xs btn-info"><span class="fa fa-trash"></span> Delete </a>
                          </div>
                        </td>
                      </tr>
                      <?php
                    $j++;
                    }
                  }
                ?>
              </table>
            </div>
            </li>
          <?php } } ?>
            
          </ul>
        </div>
             
            </div>


            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <?=@$paginate?>
              <!-- <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul> -->
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>