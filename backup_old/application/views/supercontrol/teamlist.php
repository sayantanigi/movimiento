<style>
#sample_1_filter {
	padding: 8px;
	float: right;
}
#sample_1_length {
	padding: 8px;
}
#sample_1_info {
	padding: 8px;
}
#sample_1_paginate {
	float: right;
	padding: 8px;
}
</style>
<!-- BEGIN CONTAINER -->
<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">
      <!-- BEGIN SIDEBAR MENU -->
      <?php $this->load->view ('supercontrol/leftbar');?>
      <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
  </div>
  <!-- END SIDEBAR -->
  <div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
      <!-- BEGIN PAGE BAR -->
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?php echo base_url(); ?>user/dashboard">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>Administrator Panel</span> <i class="fa fa-circle"></i> </li>
          <li> <span>Show Team List </span> </li>
        </ul>
      </div>
      <!-- END PAGE HEADER-->
      <?php if (isset($success_msg)) { echo $success_msg; } ?>
      <div class="row">
		<?php if($this->session->flashdata('success_add')!=''){?>
        	<div class="alert alert-success alert-dismissable" style="padding:10px;">
        		<button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
        		<strong> <?php echo $this->session->flashdata('success_add');?></strong>
        	</div>
        <?php }?>
		<?php if($this->session->flashdata('success_update')!=''){?>
            <div class="alert alert-success alert-dismissable" style="padding:10px;">
            	<button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
            	<strong> <?php echo $this->session->flashdata('success_update');?></strong>
            </div>
        <?php }?> 
		<?php if($this->session->flashdata('success_delete')!=''){?>
        	<div class="alert alert-success alert-dismissable" style="padding:10px;">
        		<button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
        		<strong> <?php echo $this->session->flashdata('success_delete');?></strong>
        	</div>
        <?php }?>    
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Show Team List</div>
                    
                  </div>
                  <div class="portlet-body form" style="padding:5px;">
                    <!-- BEGIN FORM-->
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                      <thead>
                        <tr>
                          <th width="24" style="max-width:200px;">Sl No.</th>
                          <th width="90" style="max-width:200px;">Member Photo</th>
                          <th width="100" class="hidden-480">Team Member Name</th>
                          <th width="100" class="hidden-480">Team Member Designations</th>
                          <!--<th width="99" class="hidden-480">Descriptions</th>
                          <th width="238" class="hidden-480">Social Links</th>-->
                          <th width="120" class="hidden-480">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
				  			$c=1;
							if(is_array($team)){
                			foreach(@$team as $i){
                		?>
                        <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                          <td class="hidden-480" style="max-width:200px;"><?php echo $c;?></td>
                          <td  class="hidden-480">
						  	<?php if($i->mem_image==""){?>
                            	No Image
                            <?php }else{?>
                            	<img src="<?php echo base_url()?>uploads/team/<?php echo $i->mem_image;?>" width="100" height="100" style="border: 2px solid #ddd;"/>
                            <?php }?>
                          </td>
                          <td  class="hidden-480"><?php echo $i->mem_name;?></td>
                          <td  class="hidden-480"><?php echo $i->mem_desig;?></td>
                         <!-- <td  class="hidden-480"><?=substr($i->mem_description,0,50)?></td>
                          <td  class="hidden-480" style="line-height: 2;">
						  <img src="<?php echo base_url()?>socialicons/fb.png" style="height:22px; width:22px;"> &nbsp;<a href="<?php echo $i->mem_fblink;?>" target="_blank"><?php echo $i->mem_fblink;?></a><br>
                          <img src="<?php echo base_url()?>socialicons/twitter.png" style="height:22px; width:22px;"> &nbsp;<a href="<?php echo $i->mem_twlink;?>" target="_blank"><?php echo $i->mem_twlink;?></a><br>
                          <img src="<?php echo base_url()?>socialicons/li.png" style="height:22px; width:22px;"> &nbsp;<a href="<?php echo $i->mem_lilink;?>" target="_blank"><?php echo $i->mem_lilink;?></a><br>
                          <img src="<?php echo base_url()?>socialicons/insta.png" style="height:22px; width:22px;"> &nbsp;<a href="<?php echo $i->mem_instalink;?>" target="_blank"><?php echo $i->mem_instalink;?></a><br>
                          <img src="<?php echo base_url()?>socialicons/gplus.png" style="height:22px; width:22px;"> &nbsp;<a href="<?php echo $i->mem_gpluslink;?>" target="_blank"><?php echo $i->mem_gpluslink;?></a><br>
						  
                          </td>-->
                          <td class="hidden-480"><a style="margin:3px;" class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/team/show_team_id/<?php echo $i->mem_id; ?>">Edit</a><br>
                          <a style="margin:3px;" onclick="return confirm('Are you sure you want to delete this Event?');" class="btn red btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/team/delete_team/<?php echo $i->mem_id; ?>">Delete</a><br>
                          </td>
                          
                        </tr>
                        <?php $c++; }}?>
                      </tbody>
                    </table>
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