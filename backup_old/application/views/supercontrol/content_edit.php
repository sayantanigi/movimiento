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
                    <div class="caption"> <i class="fa fa-gift"></i> Page Content Edit</div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <?php foreach($ecms as $i){?>
                    <form method="post" class="form-horizontal form-bordered" action="<?php echo base_url()?>supercontrol/Content/edit_cms" enctype="multipart/form-data">
                      <div class="form-body">
                        <input type="hidden" name="id" value="<?=$i->id;?>">
                        <?php $last=$i->id; if($last=="1" || $last=="2" || $last=="5" || $last=="6" || $last=="8" || $last=="9" ){?>
                        <div class="form-group last">
                          <label class="control-label col-md-3">Image</label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <?php if($i->content_image==''){ ?>
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                <?php }else{?>
                                <img src="<?php echo base_url()?>uploads/content/<?php echo $i->content_image;?>" alt="" />
                                <?php }?>
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                              <div> <span class="btn default btn-file"> <span class="fileinput-new"> Select image </span> <span class="fileinput-exists"> Change </span>
								<?php
                                $file = array('type' => 'file','name' => 'userfile','onchange' => 'readURL(this);');
                                echo form_input($file);
                                ?>
                                </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                                <span class="label label-danger"> ALL Image Size : 781 * 575</span>
                            </div>
                            <div class="clearfix margin-top-10"> <span class="label label-danger">Format</span> jpg, jpeg, png, gif </div>
                          </div>
                        </div>
                        
                        
                        <div class="form-group last">
                          <label class="control-label col-md-3">Content Image </label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <?php if($i->content_image_1==''){ ?>
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                <?php }else{?>
                                <img src="<?php echo base_url()?>uploads/content/<?php echo $i->content_image_1;?>" alt="" />
                                <?php }?>
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                              <div> <span class="btn default btn-file"> <span class="fileinput-new"> Select image </span> <span class="fileinput-exists"> Change </span>
								<?php
                                $file = array('type' => 'file','name' => 'userfile1','onchange' => 'readURL(this);');
                                echo form_input($file);
                                ?>
                                </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                            </div>
                            <div class="clearfix margin-top-10"> <span class="label label-danger">Format</span> jpg, jpeg, png, gif </div>
                          </div>
                        </div>
                        
                        <div class="form-group last">
                          <label class="control-label col-md-3">Content Image I</label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <?php if($i->content_image_2==''){ ?>
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                <?php }else{?>
                                <img src="<?php echo base_url()?>uploads/content/<?php echo $i->content_image_2;?>" alt="" />
                                <?php }?>
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                              <div> <span class="btn default btn-file"> <span class="fileinput-new"> Select image </span> <span class="fileinput-exists"> Change </span>
								<?php
                                $file = array('type' => 'file','name' => 'userfile2','onchange' => 'readURL(this);');
                                echo form_input($file);
                                ?>
                                </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                            </div>
                            <div class="clearfix margin-top-10"> <span class="label label-danger">Format</span> jpg, jpeg, png, gif </div>
                          </div>
                        </div>
                        
                        <div class="form-group last">
                          <label class="control-label col-md-3">Content Image II</label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <?php if($i->content_image_3==''){ ?>
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                <?php }else{?>
                                <img src="<?php echo base_url()?>uploads/content/<?php echo $i->content_image_3;?>" alt="" />
                                <?php }?>
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                              <div> <span class="btn default btn-file"> <span class="fileinput-new"> Select image </span> <span class="fileinput-exists"> Change </span>
								<?php
                                $file = array('type' => 'file','name' => 'userfile3','onchange' => 'readURL(this);');
                                echo form_input($file);
                                ?>
                                </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                            </div>
                            <div class="clearfix margin-top-10"> <span class="label label-danger">Format</span> jpg, jpeg, png, gif </div>
                          </div>
                        </div>
                        
                        <div class="form-group last">
                          <label class="control-label col-md-3">Content Image III</label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <?php if($i->content_image_4==''){ ?>
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                <?php }else{?>
                                <img src="<?php echo base_url()?>uploads/content/<?php echo $i->content_image_4;?>" alt="" />
                                <?php }?>
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                              <div> <span class="btn default btn-file"> <span class="fileinput-new"> Select image </span> <span class="fileinput-exists"> Change </span>
								<?php
                                $file = array('type' => 'file','name' => 'userfile4','onchange' => 'readURL(this);');
                                echo form_input($file);
                                ?>
                                </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                            </div>
                            <div class="clearfix margin-top-10"> <span class="label label-danger">Format</span> jpg, jpeg, png, gif </div>
                          </div>
                        </div>
                        <?php } else{?>
                        
                        <?php } ?>
                        <div class="form-group">
                          <label class="control-label col-md-3">Page Title</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="page_title" value="<?php echo $i->page_title;?>" name="page_title" readonly="readonly" style="background-color:#CCC;">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Content Heading</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="content_title" value="<?php echo $i->content_title;?>" name="content_title">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Content Sub Heading</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="content_sub_title" value="<?php echo $i->content_sub_title;?>" name="content_sub_title">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Video Link</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="video_link" value="<?php echo $i->video_link;?>" name="video_link">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Read More Link</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="read_more" value="<?php echo $i->read_more;?>" name="read_more">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Descriptions</label>
                          <div class="col-md-7">
                            <textarea class="form-control" name="content_details" id="pagedes" rows="8" cols="16" id="content_details">
                            <?php echo $i->content_details;?>
                            </textarea>
                          </div>
                        </div>
                        
                        
                   
                        <div class="form-group">
                          <label class="control-label col-md-3">Content Heading 1</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="content_title_1" value="<?php echo $i->content_title_1;?>" name="content_title_1">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Content Sub Heading 1</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="content_sub_title_1" value="<?php echo $i->content_sub_title_1;?>" name="content_sub_title_1">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Video Link 1 </label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="video_link_1" value="<?php echo $i->video_link_1;?>" name="video_link_1">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Read More Link 1</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="read_more_1" value="<?php echo $i->read_more_1;?>" name="read_more_1">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Descriptions 1</label>
                          <div class="col-md-7">
                            <textarea class="form-control" name="content_details_1" id="pagedes1" rows="8" cols="16" id="content_details_1">
                            <?php echo $i->content_details_1;?>
                            </textarea>
                          </div>
                        </div>
                        
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Content Heading 2</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="content_title_2" value="<?php echo $i->content_title_2;?>" name="content_title_2">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Content Sub Heading 2</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="content_sub_title_2" value="<?php echo $i->content_sub_title_2;?>" name="content_sub_title_2">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Video Link 2 </label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="video_link_2" value="<?php echo $i->video_link_2;?>" name="video_link_2">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Read More Link 2</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="read_more_2" value="<?php echo $i->read_more_2;?>" name="read_more_2">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Descriptions 2</label>
                          <div class="col-md-7">
                            <textarea class="form-control" name="content_details_2" id="pagedes2" rows="8" cols="16" id="content_details_2">
                            <?php echo $i->content_details_2;?>
                            </textarea>
                          </div>
                        </div>
                        
                        <?php $last=$i->id; if($last=="1" || $last=="4" || $last=="6" || $last=="7" || $last=="9"){?>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Content Heading 3</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="content_title_3" value="<?php echo $i->content_title_3;?>" name="content_title_3">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Content Sub Heading 3</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="content_sub_title_3" value="<?php echo $i->content_sub_title_3;?>" name="content_sub_title_3">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Video Link 3 </label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="video_link_3" value="<?php echo $i->video_link_3;?>" name="video_link_3">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Read More Link 3</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="read_more_3" value="<?php echo $i->read_more_3;?>" name="read_more_3">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Descriptions 3</label>
                          <div class="col-md-7">
                            <textarea class="form-control" name="content_details_3" id="pagedes3" rows="8" cols="16" id="content_details_3">
                            <?php echo $i->content_details_3;?>
                            </textarea>
                          </div>
                        </div>
                        
                        
                        
                         <div class="form-group">
                          <label class="control-label col-md-3">Content Heading 4</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="content_title_4" value="<?php echo $i->content_title_4;?>" name="content_title_4">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Content Sub Heading 4</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="content_sub_title_4" value="<?php echo $i->content_sub_title_4;?>" name="content_sub_title_4">
                          </div>
                        </div>
                        
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Video Link 4 </label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="video_link_4" value="<?php echo $i->video_link_4;?>" name="video_link_4">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Read More Link 4</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="read_more_4" value="<?php echo $i->read_more_4;?>" name="read_more_4">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Descriptions 4</label>
                          <div class="col-md-7">
                            <textarea class="form-control" name="content_details_4" id="pagedes4" rows="8" cols="16" id="content_details_4">
                            <?php echo $i->content_details_4;?>
                            </textarea>
                          </div>
                        </div>
                        <?php }?>
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <input type="submit" class="btn red" id="submit" value="Submit" name="update">
                            <a href="<?php echo base_url()?>supercontrol/Content/show_cms">
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