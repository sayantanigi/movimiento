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
          <li> <span>Supercontrol Panel</span> </li>
        </ul>
      </div>
      <!-- END PAGE BAR -->
      <!-- BEGIN PAGE TITLE-->
      <!-- END PAGE TITLE-->
      <!-- END PAGE HEADER-->
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Cms Edit</div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <?php foreach($ecms as $i){?>
                    <form method="post" class="form-horizontal form-bordered" action="<?php echo base_url()?>supercontrol/cms/edit_crop" enctype="multipart/form-data">
                      <div class="form-body">
                        <input type="hidden" name="cms_id" value="<?=$i->id;?>">
                           <div class="form-group">
                          <label class="control-label col-md-3">Page for</label>
                          <div class="col-md-8">
                            <select name="for_type" id="for_type" class="form-control">
                              <option value="corporate" <?php if($i->for_type =="corporate"){ echo 'selected'; } ?>>Corporate</option>
                              <option value="student" <?php if($i->for_type =="student"){ echo 'selected'; } ?>>Student</option>

                            </select>

                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Icon</label>
                          <div class="col-md-8">
                            <input type="text" name="icon" required="" class="form-control" value="<?php echo $i->icon;?>">
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Heading</label>
                          <div class="col-md-8"> 
                            <input type="text" name="heading" required="" class="form-control" value="<?php echo $i->heading;?>">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Description</label>
                          <div class="col-md-8"> 
                            <textarea class="form-control"  name="description" id="pagedes" rows="8" cols="16" id="cms_pagedes"><?php echo $i->description;?>
                            
                            </textarea>
                          </div>
                        </div>
                        
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <input type="submit" class="btn red" id="submit" value="Submit" name="update">
                            <a href="<?php echo base_url()?>supercontrol/cms/crop_cms">
                            <button class="btn default" type="button">Cancel</button>
                            </a> </div>
                        </div>
                      </div>
                    </form>
                    <?php }?>
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