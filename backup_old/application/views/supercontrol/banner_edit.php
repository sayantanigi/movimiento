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
                            <li>
                                <a href="">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Supercontrol Panel</span>
                            </li>
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
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i>Banner edit</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                    <a href="javascript:;" class="reload"> </a>
                                                    <a href="javascript:;" class="remove"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                               <?php foreach($ecms as $i){?>
              <form method="post" class="form-horizontal form-bordered" action="<?php echo base_url()?>supercontrol/banner/edit_banner" enctype="multipart/form-data">
                <div class="form-body">
                <input type="hidden" name="banner_id" value="<?=$i->id;?>">
                <input type="hidden" name="banner_img" value="<?php echo $i->banner_img;?>">
                
                
                <!--<div class="form-group">
                    <label class="control-label col-md-3">Image Upload</label>
                    <div class="col-md-7">
                    <?php
                    $file = array('type' => 'file','name' => 'userfile','onchange' => 'readURL(this);');
					echo form_input($file);
                    ?>
                     <div id='default_img'><img id="select" src="<?php echo base_url()?>/uploads/banner/<?php echo $i->	banner_img;?>" alt="your image" style="width:150px;"/></div>
                    </div>
                  </div>-->
                 
                 <div class="form-group last">
                                                <label class="control-label col-md-3">Image</label>
                                                <div class="col-md-9">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                        <?php if($i->banner_img==''){ ?>
                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> 
                                                        <?php }else{?> 
                                                        	<img src="<?php echo base_url()?>/uploads/banner/<?php echo $i->banner_img;?>" alt="" /> 
                                                        <?php }?>      
                                                            </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                        <div>
                                                            <span class="btn default btn-file">
                                                                <span class="fileinput-new"> Select image </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                
																<?php
                                                                $file = array('type' => 'file','name' => 'userfile','onchange' => 'readURL(this);');
                                                                echo form_input($file);
                                                                ?>
                                                            </span>
                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix margin-top-10">
                                                        <span class="label label-danger">Format</span> jpg, jpeg, png, gif </div>
                                                </div>
                                            </div>
                 
                 <div class="form-group">
                    <label class="control-label col-md-3">Banner heading</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" id="banner_heading" value="<?php echo $i->banner_heading;?>" name="banner_heading">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Banner_Subheading</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" id="banner_sub_heading" value="<?php echo $i->banner_sub_heading;?>" name="banner_sub_heading">
                    </div>
                  </div>
                  
                  
                  
                
                  <div class="form-group">
                    <label class="control-label col-md-3">Descriptions</label>
                    <div class="col-md-7">
                      <textarea class="form-control" name="description" id="pagedes" rows="6"> <?php echo $i->banner_description;?> </textarea>
                    </div>
                  </div>
                  
                  
                  
                 
                </div>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                      <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                      <input type="submit" class="btn red" id="submit" value="Submit" name="update">
                      <button class="btn default" type="button">Cancel</button>
                    </div>
                  </div>
                </div>
              </form>
              <?php }?>
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
