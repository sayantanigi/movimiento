<?php //$this->load->view ('header');?>
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
          <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>supercontrol panel</span> </li>
        </ul>
      </div>
      <!-- END PAGE BAR --> 
      <!-- BEGIN PAGE TITLE--> 
      <!-- END PAGE TITLE--> 
      <!-- END PAGE HEADER-->
      <div class="alert alert-success alert-dismissable" style="padding:10px;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
        <strong>
        <?php 
				$last = end($this->uri->segments); 
				if($last=="success"){echo "Data Added Successfully ......";}
				if($last=="successdelete"){echo "Data Deleted Successfully ......";}
            ?>
        </strong> </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Add Corp/Student</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form"> 
                    <!-- BEGIN FORM-->
                    <form action="<?php echo base_url().'supercontrol/cms/add_crop' ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                      <div class="form-body">
                         <div class="form-group">
                          <label class="control-label col-md-3">Page for</label>
                          <div class="col-md-8">
                            <select name="for_type" id="for_type" class="form-control">
                              <option value="corporate" selected="">Corporate</option>
                              <option value="student">Student</option>

                            </select>

                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Icon</label>
                          <div class="col-md-8">
                            <input type="text" name="icon" required="" class="form-control">

                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Heading</label>
                          <div class="col-md-8"> 
                            <input type="text" name="heading" required="" class="form-control">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Description</label>
                          <div class="col-md-8"> 
                            <textarea class="form-control"  name="description" id="pagedes" rows="8" cols="16" id="cms_pagedes">
                            
                            </textarea>
                          </div>
                        </div>
                        
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9"> 
                            <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>--> 
                            <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit' ,'class'=>'btn red')); ?>
                            <button type="button" class="btn default">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </form>
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
