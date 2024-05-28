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
<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
      <!-- BEGIN SIDEBAR MENU -->
            <?php $this->load->view ('supercontrol/leftbar');?>
      <!-- END SIDEBAR MENU -->
      <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
  </div>
  <!-- END SIDEBAR -->
  <!-- BEGIN CONTENT -->
  <style>
 	.dataTables_info{padding:7px;}
  </style>
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
          <li> <span>Show List </span> </li>
        </ul>
      </div>
      <!-- END PAGE BAR -->
      <!-- BEGIN PAGE TITLE-->
      <!-- END PAGE TITLE-->
      <!-- END PAGE HEADER-->
      <?php if(@$message){echo @$message;}?>
      <div class="row">
      <?php if($this->session->flashdata('add_message')!=''){?>
			<div class="alert alert-success text-center"><?php echo @$this->session->flashdata('add_message');?></div>
	  <?php }?>
       <?php if($this->session->flashdata('edit_message')!=''){?>
			<div class="alert alert-success text-center"><?php echo @$this->session->flashdata('edit_message');?></div>
	  <?php }?>
      <?php if($this->session->flashdata('delete_message')!=''){?>
			<div class="alert alert-success text-center"><?php echo @$this->session->flashdata('delete_message');?></div>
	  <?php }?>
      <?php if($this->session->flashdata('delete_message1')!=''){?>
			<div class="alert alert-success text-center"><?php echo @$this->session->flashdata('delete_message1');?></div>
	  <?php }?>
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Show List</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a>  <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  
                  <div class="portlet-body form">
                  
                    <!-- BEGIN FORM-->
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                    <div id="mydiv">
                      <thead>
                        <tr>
                         
                          <th width="30">Course Name</th>
                          <th width="30">Package Name</th>
                          <th width="60">Print Materials</th>
                          <th width="60">Online Access</th>
                          <th width="60">Tutor Support</th>
                          <th width="60">Certificates</th>
                          <th width="60">Price</th>
                          <th width="60">Status</th>
                          <th width="27">Edit</th>
                          <th width="27">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if(is_array($distancebooking)){ ?>
            					  <?php
            					  $ctn=1;
                      foreach($distancebooking as $i){
                      ?>
                        <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                          
                          <td><?php echo $coursename;?></td>
                          <td  style="max-width:200px;"><?php echo $i->package_name;?></td>
                          <td  style="max-width:200px;"><?php echo $i->print_material;?></td>
                          <td  style="max-width:200px;"><?php echo $i->online_access;?></td>
                          <td  style="max-width:200px;"><?php echo $i->tutor_support;?></td>
                          <td  style="max-width:200px;"><?php echo $i->cirtificates;?></td>
                          <td  style="max-width:200px;"><?php echo $i->price;?></td>
                          <td  style="max-width:250px;"><?php if($i->status=='0'){?><span style="color:#F00;">Inactive</span><?php }else{?><span style="color:#090;">Active</span><?php }?></td>
                          <!--<td style="max-width:50px;"><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/agent/show_agent_id/<?php echo $i->diatance_id; ?>">Edit</a></td>-->
                          
                          <td style="max-width:50px;"><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/distance/editshowdistancebooking/<?php echo $i->diatance_id; ?>">Edit</a></td>
                          <td style="max-width:50px;"><a class="btn red btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/distance/deletedistancebooking/<?php echo $i->course_id;?>/<?php echo $i->diatance_id; ?>">Delete</a></td>
                          
                         <!-- <td style="max-width:50px;"><a class="btn red btn-sm btn-outline sbold uppercase" onclick="return confirm('Are you sure about this delete?');" href="#">Delete</a></td>-->
                        </tr>
                        <?php $ctn++;}?>
                        <?php //}
					  }
						?> 
                      </tbody>
                      </div>
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


<!-- END CONTAINER -->

