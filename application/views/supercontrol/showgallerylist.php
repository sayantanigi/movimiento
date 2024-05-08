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
                                <span>Show Gallery </span>
                            </li>
                        </ul>
                        
                    </div>
					
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <?php if (isset($success_msg)) { echo $success_msg; } ?>
                    <?php if (isset($success_msg1)) { echo $success_msg1; } ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabbable-line boxless tabbable-reversed">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_0">
                                        <div class="portlet box blue-hoki">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i>Show Gallery</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                    
                                                    <a href="javascript:;" class="reload"> </a>
                                                    <a href="javascript:;" class="remove"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                <thead>
                  <tr>
                  	<th width="241" style="max-width:170px;">Image</th>
                    <th width="39">Gallery Title</th>
                    
					 <th width="66">Status</th>
                    <th width="27">Edit</th>
                    <th width="27">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                	foreach($ecms as $i){
                ?>
                    <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                        <td><?php if($i->gallery_image==""){?>No Image<?php }else{?><img src="<?php echo base_url()?>/gallery/<?php echo $i->gallery_image;?>" width="150" height="100" /><?php }?></td>
                        <td  style="max-width:200px;"><?php echo $i->gallery_name;?></td>
                   
						<td  style="max-width:250px;"><div class="form-group">
                  
                    <div class="col-md-5">
                    	<select name="gallery_status" id="stachange" onchange="f1(this.value,<?php echo $i->id ;?>)">
                        	<option value="1" <?php if($i->gallery_status==1){?> selected="selected"<?php }?>>Active</option>
                            <option value="0" <?php if($i->gallery_status==0){?> selected="selected"<?php }?>>Inactive</option>
                        </select>
                      
                      <input type="hidden" name="id" value="<?php echo $i->id;?>">
                    </div>
                  </div>
					   </td>
						 
                       
                        <td style="max-width:50px;"><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/gallery/show_gallery_id/<?php echo $i->id; ?>">Edit</a></td>
                        <td style="max-width:50px;"><a onclick="return confirm('Are you sure you want to delete ?');" class="btn red btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/gallery/delete_gallery/<?php echo $i->id; ?>">Delete</a></td>
                  </tr>
                  <?php }?>
				  
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
                    url:"<?php echo base_url(); ?>supercontrol/gallery/statusgallery",
                     data:{stat : stat, id :id}
					 
					  });
		//$.get('<?php echo base_url(); ?>banner/statusbanner',{ stat : stat , id : id });
	}
</script>
        <!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>
        