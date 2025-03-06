<style>
  .action-button{
    float: left;
  }
</style>
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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?=admin_url('course/save_chapter_pref/'.$this->uri->segment(4).'/'.$this->uri->segment(5))?>" method="post" enctype="multipart/form-data">
              <table class="table table-bordered" id="tblLocations">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Course Name</th>
                  <th>Order By</th>
                  <th>Video</th>
                  <th width="400px">Resource</th>
                  <th width="400px">Quiz</th>
                  <th>Action</th>
                </tr>
                <?php
                  if(is_array($matr) && count($matr)>0){
                    $i=1;
                    foreach ($matr as $course_v) {
                      $crsnm = $this->db->get_where('courses',array('id'=>$course_v->course_id))->row();
                      ?>
                      <tr>
                        <td><?=$i?> <input type="hidden" name="pref[]" value="<?=$course_v->id?>"></td>
                        <td><?=$crsnm->title?></td>
                        <td><?=$course_v->order_by?></td>
                        <td><?php if($course_v->vid_type=='yt_link'){ ?>
                         <iframe width="100" height="100" src="<?=$course_v->yt_link?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <?php } else{ ?>
                        <video  width="100" src="<?=site_url('assets/images/materials/'.$course_v->video)?>"></video>
                        <?php } ?>
                        </td> 
                        <td><?=$course_v->res_descr?></td> 
                        <td><?php if($course_v->order_by=='quiz'){ 
                          foreach($quesquz as $qs){ ?>
                            <a href="<?=admin_url('course/edit_question/'.$this->uri->segment(4).'/'.$qs->id)?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a><br>
                            
                          <b>Ques: <?=$qs->ques?></b>
                          <ul>
                            <li><?=$qs->ans1?></li>
                            <li><?=$qs->ans2?></li>
                            <li><?=$qs->ans3?></li>
                            <li><?=$qs->ans4?></li>
                          </ul>
                          <b>Ans: <?=$qs->cor_ans?></b><br>

                        <?php } } ?>
                        </td> 
                        <td>
                          <?php if($course_v->order_by!='quiz'){ ?>
                          <div class="action-button">
                            <a href="<?=admin_url('course/update_material/'.$this->uri->segment(4).'/'.$course_v->id)?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                            <a href="<?=admin_url('course/delete_material/'.$this->uri->segment(4).'/'.$course_v->id)?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
                          </div>
                        <?php } ?>
                        </td>
                      </tr>
                      <?php
                    $i++;
                    }
                  }?>
              </table>
               <button type="submit" class="btn btn-primary">Change Preffrence</button>
              </form>
            </div>
            <!-- /.box-body -->
           
          </div>
          <!-- /.box -->
        </div>
      </div>


      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>


      <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/smoothness/jquery-ui.css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#tblLocations").sortable({
                items: 'tr:not(tr:first-child)',
                cursor: 'pointer',
                axis: 'y',
                dropOnEmpty: false,
                start: function (e, ui) {
                    ui.item.addClass("selected");
                },
                stop: function (e, ui) {
                    ui.item.removeClass("selected");
                    $(this).find("tr").each(function (index) {
                        if (index > 0) {
                            // $(this).find("td").eq(2).html(index);
                        }
                    });
                }
            });
        });
    </script>