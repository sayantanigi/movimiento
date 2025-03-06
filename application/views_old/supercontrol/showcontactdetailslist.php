<?php //$this->load->view ('header');?>
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
        <!-- BEGIN CONTAINER -->
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
                            <li>
                                <a href="<?php echo base_url(); ?>supercontrol/home">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>supercontrol Panel</span>
                                 <i class="fa fa-circle"></i>
                            </li>
                            
                             <li>
                                <span>Show Contact Detail </span>
                            </li>
                        </ul>
                        
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <?php if (isset($success_msg)) { echo $success_msg; } ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabbable-line boxless tabbable-reversed">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_0">
                                        <div class="portlet box blue-hoki">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i>Show Contact Details list</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                    
                                                    <a href="javascript:;" class="reload"> </a>
                                                    <a href="javascript:;" class="remove"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body form" style="padding:5px;">
                                                <!-- BEGIN FORM-->
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                <thead>
                  <tr>
                  	<th width="10" style="max-width:200px;">Sl No.</th>
                    <th class="hidden-480">Contact Country Name</th>
                    <th class="hidden-480">Contact Country Image</th>
                    <th class="hidden-480">Contact Country Address</th>
                    <th class="hidden-480">Contact Country Email</th>
                    <th class="hidden-480">Contact Country Phone</th>
                    <th class="hidden-480">Contact Country Mobile</th>
                    <th class="hidden-480">Contact Country Whatsapp</th>
                    <th class="hidden-480">Edit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
				  	$c=1;
                	foreach($ecms as $i){
                ?>
                    <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                        <!--<td><?php if($i->cms_img==""){?>No Image<?php }else{?><img src="<?php echo base_url()?>/uploads/<?php echo $i->cms_img;?>" width="130" height="100" /><?php }?></td>-->
                        <td class="hidden-480" style="max-width:200px;"><?php echo $c;?></td>
                        <td  class="hidden-480"><?php echo $i->country_name;?></td>
                        <td><?php if($i->country_image==""){?>No Image<?php }else{?><img src="<?php echo base_url()?>/uploads/contactdetails/<?php echo $i->country_image;?>" width="130" height="100" /><?php }?></td>
                        <td  class="hidden-480"><?php echo $i->address;?></td>
                        <td  class="hidden-480"><?php echo $i->mail;?></td>
                        <td  class="hidden-480"><?php echo $i->phone;?></td>
                        <td  class="hidden-480"><?php echo $i->mobile;?></td>
                        <td  class="hidden-480"><?php echo $i->whatapp;?></td>
                        <td class="hidden-480"><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/contactdetails/show_cms_id/<?php echo $i->id; ?>">Edit</a></td>
                  </tr>
                  <?php $c++; }?>
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
        <!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>
        