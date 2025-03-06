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
                    <div class="caption"> <i class="fa fa-gift"></i>Contact Detail Edit</div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <?php foreach($ecms as $i){?>
                    <form method="post" class="form-horizontal form-bordered" action="<?php echo base_url()?>supercontrol/contactdetails/edit_cms" enctype="multipart/form-data">
                      <div class="form-body">
                        <input type="hidden" name="id" value="<?=$i->id;?>">
                        
                        <div class="form-group last">
                          <label class="control-label col-md-3">Image</label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <?php if($i->country_image==''){ ?>
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                <?php }else{?>
                                <img src="<?php echo base_url()?>uploads/contactdetails/<?php echo $i->country_image;?>" alt="" />
                                <?php }?>
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                              <div> <span class="btn default btn-file"> <span class="fileinput-new"> Select image </span> <span class="fileinput-exists"> Change </span>
								<?php
                                $file = array('type' => 'file','name' => 'userfile','onchange' => 'readURL(this);');
                                echo form_input($file);
                                ?>
                                </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                            </div>
                            <div class="clearfix margin-top-10"> <span class="label label-danger">Format</span> jpg, jpeg, png, gif </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Contact Country Name</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control"  value="<?php echo $i->country_name;?>" name="country_name" style="background-color:#CCC;">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Contact Country Address</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control"  value="<?php echo $i->address;?>" name="address"  style="background-color:#CCC;">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Contact Country Email</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control"  value="<?php echo $i->mail;?>" name="mail"  style="background-color:#CCC;">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Contact Country Phone</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control"  value="<?php echo $i->phone;?>" name="phone"  style="background-color:#CCC;">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Contact Country Mobile</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control"  value="<?php echo $i->mobile;?>" name="mobile"  style="background-color:#CCC;">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Contact Country Whatsapp</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control"  value="<?php echo $i->whatapp;?>" name="whatapp"  style="background-color:#CCC;">
                          </div>
                        </div>
                        
                       
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <input type="submit" class="btn red" id="submit" value="Submit" name="update">
                            <a href="<?php echo base_url()?>supercontrol/contactdetails/show_cms">
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