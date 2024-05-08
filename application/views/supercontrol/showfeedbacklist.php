<?php //$this->load->view ('header');?>
<!-- BEGIN CONTAINER -->
<style>
#sample_1_filter{
	padding: 8px;
    float: right;
	}
#sample_1_length{
	padding: 8px;
	}
#sample_1_info{
	padding: 8px;	
	}
#sample_1_paginate{
	float: right;
    padding: 8px;
	}	
</style>
<style>
#sample_1_filter{
	padding: 8px;
    float: right;
	}
#sample_1_length{
	padding: 8px;
	}
#sample_1_info{
	padding: 8px;	
	}
#sample_1_paginate{
	float: right;
    padding: 8px;
	}
.dataTables_length{
	padding:10px;
	}
.dataTables_filter{
	padding: 10px;
    float: right;
	}
.dataTables_info{
	padding:10px;
	}
.pagination-panel{
	padding: 10px;
    float: right;
	}	
</style>
<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
      <!-- BEGIN SIDEBAR MENU -->
      <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
      <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
      <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
      <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
      <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
      <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
      <?php $this->load->view ('supercontrol/leftbar');?>
      <!-- END SIDEBAR MENU -->
      <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
  </div>
  <!-- END SIDEBAR -->
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
      <!-- BEGIN PAGE HEADER-->
      <!-- BEGIN THEME PANEL -->
      <!-- END THEME PANEL -->
      <!-- BEGIN PAGE BAR -->
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>supercontrol Panel</span> <i class="fa fa-circle"></i> </li>
          <li> <span>Show Feedback List </span> </li>
        </ul>
      </div>
      <!-- END PAGE BAR -->
      <!-- BEGIN PAGE TITLE-->
      <!-- END PAGE TITLE-->
      <!-- END PAGE HEADER-->
      <?php if (isset($success_msg)) { echo $success_msg; } ?>
      <div class="row">
      <?php if($this->session->flashdata('delete_message')!=''){?>
			<div class="alert alert-success text-center"><?php echo @$this->session->flashdata('delete_message');?></div>
	  <?php }?>
      
      <?php if($this->session->flashdata('email_message')!=''){?>
			<div class="alert alert-success text-center"><?php echo @$this->session->flashdata('email_message');?></div>
	  <?php }?>
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Show Feedback</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a>  <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_2">
                      <thead>
                        <tr>
                          <th>Sl No</th>
                          <th width="241" style="max-width:170px;">Name</th>
                          <th width="39">Email</th>
                          <th width="39">Phone</th>
                          <th width="39">Pin</th>
                          <th width="40">Reply</th>
                          <th width="66">View</th>
                          <th width="27">Action</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php
                        $ctn = 1;
						if($ecms!=''){
                        	foreach($ecms as $i){
                        ?>
                        <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_2">
                          <td><?php echo $ctn;?></td>
                          <td  style="max-width:200px;"><?php echo $i->name;?></td>
                          <td  style="max-width:200px;"><?php echo $i->email;?></td>
                          <td  style="max-width:200px;"><?php echo $i->phone;?></td>
                          <td  style="max-width:200px;"><?php echo $i->pin;?></td>
                          <td style="max-width:70px;"><a href="#myModal<?=$ctn?>" class="btn green btn-sm btn-outline sbold uppercase" data-toggle="modal">Reply</a>
                          <!--------- Open modal start here------>
                            <div class="container">
                              <!-- Modal -->
                              <div class="modal fade" id="myModal<?php echo $ctn; ?>" role="dialog">
                                <div class="modal-dialog">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <form action="<?php echo base_url()?>supercontrol/feedback/send_feedback" method="post">
                                      <?php  foreach($supercontrolmail as $j){ ?>
                                      <input type="hidden" name="supercontrolmail" value="<?php echo $j->MailAddress;?> " />
                                      <?php }?>
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h3 class="modal-title" style="color:#32c5d2;"><strong>Reply</strong></h3>
                                      </div>
                                      <div class="modal-body" style="text-align:center;">
                                        <input type="hidden" name="fid" value="<?php echo $i->fid;?>">
                                        <label style="float:left;">
                                        <h4>Reply to  :</h4>
                                        </label>
                                        <label>
                                          <input type="text" name="Email" value="<?php echo $i->email;?>" readonly="readonly"  style="height:38px; width:450px; border:1px solid #999; margin-left:-22px; padding:8px;">
                                        </label>
                                        <br />
                                        <label>
                                          <input type="text" name="reply_subject" style="height:38px; width:450px; border:1px solid #999; margin-left:-22px; padding:8px;" placeholder="Subject">
                                        </label>
                                        <br />
                                        <label>
                                          <textarea type="text" id="pagedes1" name="reply_message" value="" style="height:100px;width:448px; border:1px solid #999; margin-left:49px;" placeholder="Messsage"  > </textarea>
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
                            <!--------- Open modal end here------>
                            </td>
                          <td style="max-width:50px;"><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/feedback/show_feedback_id/<?php echo $i->fid; ?>">View</a></td>
                          <td><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/feedback/delete_row/<?php echo $i->fid;?>" onclick="return confirm('Are you sure you want to delete ?');">Delete</a></td>
                        </tr>
                        <?php $ctn++;}
						}
						?>
                        
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
    <!-- END CONTENT BODY -->
  </div>
  <!-- END CONTENT -->
  <!-- BEGIN QUICK SIDEBAR -->
  <!-- END QUICK SIDEBAR -->
</div>
<script>
			function f1(stat,id)
	{
		
		//alert(stat);
		//alert(id);
		$.ajax({
                    type:"get",
                    url:"<?php echo base_url(); ?>team/statusteam",
                     data:{stat : stat, id :id}
					 
					  });
		//$.get('<?php echo base_url(); ?>banner/statusbanner',{ stat : stat , id : id });
	}
</script>
<!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>
