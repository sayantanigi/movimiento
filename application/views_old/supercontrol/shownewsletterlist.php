<style type="text/css">
.tile {
	padding-top:0px;
	height: 117px;
	width: 184px !important;
	position: relative;
	overflow: hidden;
	cursor:pointer;
	border: 5px solid #ccc;
}
.tile .tile-body {
	height: 100%;
	overflow: hidden;
	position: relative;
}
.tile:active, .tile.selected {
	border-color: #ccc;
}
.tile.image > .tile-body > img {
	width: 100%;
	height: auto;
	min-height: 100%;
	max-width: 100%;
}
.dataTables_length{
	padding: 10px;
	}
.dataTables_filter{
	padding: 10px;
    float: right;
	}
.dataTables_info{
	padding: 10px;
	}
#sample_1_paginate{
	float: right;
    padding: 10px;
	}
#mceu_22{
	border-width: 1px;
    width: 400px;
    height: 340px;
	}	
</style>
<?php //$this->load->view ('header');?>
<div class="page-container">
  <div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
      <?php $this->load->view ('supercontrol/leftbar');?>
    </div>
  </div>
  <div class="page-content-wrapper">
    <div class="page-content">
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="#">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>supercontrol Panel</span> <i class="fa fa-circle"></i> </li>
          <li> <span>Show News Letter List </span> </li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Show Member</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a>  <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div style="color: white; font-size: 17px;text-align: center;">
                    <?php    echo $this->session->flashdata('email_sent'); ?>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
				 <?php if($this->session->flashdata('success')!=''){?>
			     <div class="alert alert-success text-center" style="color:#f00;text-align:center;"><?php echo @$this->session->flashdata('success');?></div>
	             <?php }?>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                      <thead>
                        <tr>
                          <th width="290" style="max-width:270px;">Email Address</th>
                          <th width="40">View</th>
                          <th width="40">Reply</th>
                          <th width="22">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(is_array($ecms)): ?>
                        <?php
				  
				  $ctn=1;
                	foreach($ecms as $i){
                ?>
                        <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                          <td  style="max-width:300px;"><?php echo $i->mail_address;?></td>
                          <td style="max-width:70px;"><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/newsletter/show_newsletter_id/<?php echo $i->mail_id; ?>">View</a></td>
                          <td style="max-width:70px;"><a href="#myModal<?=$ctn?>" class="btn green btn-sm btn-outline sbold uppercase" data-toggle="modal" data target=""  >Reply</a>
                            <!--------- Open modal start here------>
                            <div class="container">
                              <!-- Modal -->
                              <div class="modal fade" id="myModal<?php echo $ctn; ?>" role="dialog">
                                <div class="modal-dialog">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <form action="<?php echo base_url()?>supercontrol/newsletter/send_newsletter" method="post">
                                    
                                      <?php  foreach(@$supercontrol as $j){ ?>
                                      <input type="hidden" name="supercontrol_mail" value="<?php echo $j->MailAddress;?> " />
                                      <?php }?>
                                      
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h3 class="modal-title" style="color:#32c5d2;"><strong>Reply</strong></h3>
                                      </div>
                                      <div class="modal-body" style="text-align:center;">
                                        <input type="hidden" name="mail_id" value="<?php echo $i->mail_id;?>">
                                        <label style="float:left;">
                                        <h4>Reply to  :</h4>
                                        </label>
                                        <label>
                                          <input type="text" name="mail_address" value="<?php echo $i->mail_address;?>"  style="height:38px; width:450px; border:1px solid #999; margin-left:-22px; padding:8px;">
                                        </label>
                                        <br />
                                        <label>
                                          <input type="text" name="reply_subject" style="height:38px; width:450px; border:1px solid #999; margin-left:-22px; padding:8px;" placeholder="Subject">
                                        </label>
                                        <br/>
                                        <label>
                                          <textarea type="text" name="reply_message" style="height:100px;width:448px; border:1px solid #999; margin-left:49px;" placeholder="Messsage" id="pagedes"> </textarea>
                                        </label>
                                      </div>
                                      <div class="modal-footer">
                                        <input type="submit" class="btn green btn-sm btn-outline sbold uppercase"  style="width:80px;" name="submit" value="Send">
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!--------- Open modal end here------></td>
                          <td><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/newsletter/delete_row/<?php echo $i->mail_id;?>" onclick="return confirm('Are you sure you want to delete ?');">Delete</a></td>
                        </tr>
                        <?php $ctn++; }?>
                        <?php endif; ?>
                      </tbody>
                    </table>
                    <!-- END FORM-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
function f1(stat,id)
{
$.ajax({
type:"get",
url:"<?php echo base_url(); ?>supercontrol/team/statusteam",
data:{stat : stat, id :id}
});
}
</script>
<!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>
