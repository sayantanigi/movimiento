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
          <li> <a href="<?php echo base_url(); ?>user/dashboard">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>Admin Panel</span> <i class="fa fa-circle"></i> </li>
          <li> <span>Show Service List </span> </li>
        </ul>
      </div>
      <!-- END PAGE BAR -->
      <!-- BEGIN PAGE TITLE-->
      <!-- END PAGE TITLE-->
      <!-- END PAGE HEADER-->
    <div class="alert alert-success">
    	<center><?php if(@$message){echo @$message;}?></center>
    </div>
    <?php
	if($this->session->flashdata('success')!=''){
	?>
    <div class="alert alert-danger">
    	<center><?php echo @$this->session->flashdata('success');?></center>
    </div>
    <?php }?>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Show Service</div>
                  </div>
                  <table class="table table-striped" id="">
                  	<tr>
                    	<td>
                  			<div class="portlet-body form">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                    <div id="mydiv">
                      <thead>
                        <tr>
                          <th width="180" style="max-width:170px; float:left;">Service List</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if(is_array($eserv)): ?>
					  <?php
					  $ctn=1;
                      foreach($eserv as $i){
                      ?>
                        <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                          <td  style="max-width:200px;">
                          <div class="col-md-12" style="text-align:left;">
                          	<div class="col-md-12" style="background-color: #999;border-bottom: 1px solid #ccc;color: #fff; padding: 5px;">
                          	<?php echo $i->category_name;?>&nbsp;<a class="btn green sbold uppercase btn-xs" href="<?php echo base_url()?>supercontrol/service/show_service_id/<?php echo $i->category_id; ?>">Edit</a>
                            &nbsp;<a class="btn red sbold uppercase btn-xs" onclick="return confirm('Are you sure about this delete?');" href="<?php echo base_url()?>supercontrol/service/delete_service/<?php echo $i->category_id; ?>">Delete</a>
                             </div>
                             <!--=====================2nd Level====================-->
                             	<div class="col-md-12" style="padding:5px;clear:both;">
									<?php
                                    	$this->db->from('sm_category');
                                    	$this->db->where('parent_id',$i->category_id);
                                    	$this->db->group_by('category_name', $i->category_name);
                                    	$query = $this->db->get();
                                    	if($query->num_rows > 0 ){
                                    		foreach ($query->result() as $row){
                                    ?>
                            <div class="col-md-2"> 
								<?php echo $row->category_name;?> &nbsp;
                                <a class="btn  btn-xs" href="<?php echo base_url()?>supercontrol/service/show_service_id/<?php echo $row->category_id; ?>">&nbsp;</a>
                            &nbsp;<a class="" onclick="return confirm('Are you sure about this delete?');" href="<?php echo base_url()?>supercontrol/service/delete_service/<?php echo $row->category_id; ?>">&nbsp;</a>
                            </div>
                            <div class="col-md-12" style="padding:5px; margin-left:25px; clear:both;">
                             <?php
								$this->db->from('sm_category');
								$this->db->where('parent_id',$row->category_id);
								$this->db->group_by('category_name', $row->category_name);
								$query = $this->db->get();
  								if($query->num_rows > 0 ){
									foreach ($query->result() as $newr){
								?>
                            	<div class="col-md-4">
                            	<?php echo $newr->category_name;?>
                            	&nbsp;<a class="btn green sbold uppercase btn-xs" href="<?php echo base_url()?>supercontrol/service/show_service_id/<?php echo $newr->category_id; ?>">Edit</a>
                           	 	&nbsp;<a class="btn red sbold uppercase btn-xs" onclick="return confirm('Are you sure about this delete?');" href="<?php echo base_url()?>supercontrol/service/delete_service/<?php echo $newr->category_id; ?>">Delete</a>
                            </div>
                            <?php 
									}
								}
							?>
                            
                            </div>
                            &nbsp;<a class="btn green sbold uppercase btn-xs" href="<?php echo base_url()?>supercontrol/service/show_service_id/<?php echo $row->category_id; ?>">Edit</a>
                            &nbsp;<a class="btn red sbold uppercase btn-xs" onclick="return confirm('Are you sure about this delete?');" href="<?php echo base_url()?>supercontrol/service/delete_service/<?php echo $row->category_id; ?>">Delete</a><br>
                            <div class="clearfix" style="padding:12px;"></div>
                            <?php }
								}
							?>
                            <div class="clearfix"></div>
                            </div>
                             <!--=====================2nd Level====================-->
                             <div class="clearfix"></div>
                           </div> 
                          </td>
                        </tr>
                        <?php $ctn++;}?>
                        <?php endif; ?>
                      </tbody>
                      </div>
                    </table>
                      		</div>
                      	</td>
                     </tr>   
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