<style>
  .form-control{
    margin-bottom: 15px;
  }
</style>
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
              <h3 class="box-title">Reviewer Lists</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Review For</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th style="width: 25%">Description</th>
                  <th>Date</th>
                  <th>Reply Text</th>
                  <th>Action</th>
                </tr>
                <?php
                  if(is_array($contacts) && count($contacts)>0){
                    $i=0;
                    foreach ($contacts as $enquiry_v) {
                    $i++;
                      $detl=$this->db->get_where('courses',array('id'=>$enquiry_v->course_id,'status'=>1))->row();
                      $userdtl=$this->db->get_where('users',array('id'=>$enquiry_v->userid,'status'=>1))->row();
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><p><?=$detl->title?></p> </td>
                        <td> <p><?=@$userdtl->fname.' '.@$userdtl->lname?></p></td>
                        <td><?=@$userdtl->email?></td>
                        <td><?=@$enquiry_v->descr?></td>
                        <td><?=date('d M Y',strtotime($enquiry_v->created))?></td>
                        
                        <td><?=$enquiry_v->rply_text?></td>
                        <td>
                          <?php if($enquiry_v->rply_status !=1){ ?>
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal<?=$i?>" class="text-info" title="Reply">REPLY</a> 
                         <?php }else{ ?>
                           <a href="javascript:void(0);" class="btn btn-primary" title="Replied">REPLIED</a>
                            <p>Date: <?=date('d M Y',strtotime($enquiry_v->rply_date))?></p> 
                         <?php } ?>
                        </td>
                      </tr>
                      <!--start Modal for reply content-->
                      <div class="modal fade" id="myModal<?=$i?>" role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Reply from Admin</h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-8 col-md-offset-2">
                                  <form action="<?=admin_url('contacts/review_reply/'.$enquiry_v->id)?>" method="post">
                                  <input class="form-control" type="email" value="<?=$userdtl->email?>" name="email" readonly>
                                  <textarea class="form-control" name="cmnts" rows="4"></textarea>
                                  <input type="submit" value="Send" class="btn btn-primary">
                                </form>
                              </div>
                                </div>
                               
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                            
                          </div>
                      </div>
                      <!--end Modal for reply content-->
                      <?php
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