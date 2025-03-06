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
              <h3 class="box-title">Contact User Lists</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Certificate For</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Certificate Type</th>
                  <th>Payment Status</th>
                  <th>Payment Date</th>
                </tr>
                <?php
                  if(is_array($contacts) && count($contacts)>0){
                    $i=1;
                    foreach ($contacts as $contact) {
                      $user=$this->db->get_where('users',array('id'=>$contact->userid))->row();
                      $course=$this->db->get_where('courses',array('id'=>$contact->courseid))->row();
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?php if(!empty($course->title)){ echo $course->title;} else {echo "";} ?></td>
                        <td><?=@$user->fname.' '.@$user->lname?></td>
                        <td><?=@$user->email?></td>
                        <td><?=@$user->phone?></td>
                        <td>
                          <?php if(@$contact->shiped_price==19){
                            echo "Digital Certificate + Printed embossed Certificate ($19 + shipping)  ";
                          }else{
                            echo"Digital Certificate + Framed embossed Certificate ($39 + shipping)  ";
                          } ?>
                         </td>
                        <td><?=$contact->payment_status?></td>
                        <td><?=date('d M Y',strtotime($contact->date))?></td>
                       
                      </tr>
                      <?php
                    $i++;
                    }
                  }
                ?>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <?=$paginate?>
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