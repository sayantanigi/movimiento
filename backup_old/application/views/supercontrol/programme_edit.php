<?php //$this->load->view ('header');?>

<div class="page-container">
  <div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
      <?php $this->load->view ('supercontrol/leftbar');?>
    </div>
  </div>
  <div class="page-content-wrapper">
    <div class="page-content">
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>supercontrol Panel</span> </li>
        </ul>
      </div>
	  
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Blog edit</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <?php foreach($ecms as $i){?>
                    <form method="post" class="form-horizontal form-bordered" action="<?php echo base_url().'supercontrol/blog/edit_blog '?>" enctype="multipart/form-data">
                      <div class="form-body">
                        <input type="hidden" name="blog_id" value="<?=$i->id;?>">
                        <input type="hidden" name="blog_image" value="<?=$i->blog_image;?>">
                        
                        <div class="form-group last">
                            <label class="control-label col-md-3">Blog Image</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <?php if($i->blog_image==''){ ?>
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> 
                                    <?php }else{?> 
                                        <img src="<?php echo base_url()?>uploads/blog/<?php echo $i->blog_image;?>" alt="" /> 
                                    <?php }?>      
                                        </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> Select image </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <!--<input type="file" name="...">-->
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
                          <label class="control-label col-md-3">Blog Title</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="blog_title" value="<?php echo $i->blog_title;?>" name="blog_title">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Posted By</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="posted_by" value="<?php echo $i->posted_by;?>" name="posted_by">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Blog Descriptions</label>
                          <div class="col-md-7">
                            <textarea class="form-control" name="blog_desc" rows="6" id="pagedes"><?php echo $i->blog_desc;?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                            <input type="submit" class="btn red" id="submit" value="Submit" name="update">
                            <button class="btn default" type="button" onclick="goBack()">Cancel</button>
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
