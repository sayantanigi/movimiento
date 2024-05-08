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
          <li> <a href="">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>Administrator Panel</span> </li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Team Edit</div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <?php foreach($eteam as $i){?>
                    <form method="post" class="form-horizontal form-bordered" action="<?php echo base_url()?>supercontrol/team/edit_team" enctype="multipart/form-data">
                      <div class="form-body">
                        <input type="hidden" name="member_id" value="<?=$i->mem_id;?>">
                        <input type="hidden" name="member_image" value="<?php echo $i->mem_image;?>">
                        <div class="form-group last">
                          <label class="control-label col-md-3">Image</label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <?php if($i->mem_image==''){ ?>
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                <?php }else{?>
                                <img src="<?php echo base_url()?>uploads/team/<?php echo $i->mem_image;?>" alt="" />
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
                          <label class="control-label col-md-3">Member Name</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="mem_name" value="<?php echo $i->mem_name;?>" name="mem_name">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Member Designations</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="mem_desig" value="<?php echo $i->mem_desig;?>" name="mem_desig">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Member Description</label>
                          <div class="col-md-5">
                            <textarea type="text" class="form-control" id="pagedes" name="mem_description"><?php echo $i->mem_description;?></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Phone No</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="mem_phone" value="<?php echo $i->mem_phone;?>" name="mem_phone">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Email Id</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="mem_email" value="<?php echo $i->mem_email;?>" name="mem_email">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Facebook Link</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="mem_fblink" value="<?php echo $i->mem_fblink;?>" name="mem_fblink">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Twitter Link</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="mem_twlink" value="<?php echo $i->mem_twlink;?>" name="mem_twlink">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Linked In Link</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="mem_lilink" value="<?php echo $i->mem_lilink;?>" name="mem_lilink">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Instagram Link</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="mem_instalink" value="<?php echo $i->mem_instalink;?>" name="mem_instalink">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Google Plus Link</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="mem_gpluslink" value="<?php echo $i->mem_gpluslink;?>" name="mem_gpluslink">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Status</label>
                          <div class="col-md-5">
                            <select name="status" class="form-control">
                              <option value="1" <?php if($i->status==1){?> selected="selected" <?php }?>>Active</option>
                              <option value="0" <?php if($i->status==0){?> selected="selected" <?php }?>>Inactive</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <input type="submit" class="btn red" id="submit" value="Submit" name="update">
                            <button class="btn default" type="button">Cancel</button>
                          </div>
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
