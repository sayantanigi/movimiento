<?php //$this->load->view ('header');?>
<!-- BEGIN CONTAINER -->

<div class="page-container"> 
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper"> 
    <!-- BEGIN SIDEBAR --> 
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing --> 
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse"> 
      
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
          <li> <a href="">Home</a> <i class="fa fa-circle"></i> </li>
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
                    <div class="caption"> <i class="fa fa-gift"></i>Announcement Edit</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form"> 
                    <!-- BEGIN FORM-->
                    <?php foreach($ecms as $i){?>
                   <form method="post" class="form-horizontal form-bordered" action="<?php echo base_url()?>supercontrol/announcement/edit_announcement" >
                      <div class="form-body">
                        <input type="hidden" name="id" value="<?=$i->id;?>">
                        <div class="form-group">
                          <label class="control-label col-md-3">Announcement Title</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="announcement_title" value="<?php echo $i->announcement_title;?>" name="announcement_title">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Description</label>
                          <div class="col-md-5">
                           <textarea class="form-control" name="description" id="pagedes" rows="8" cols="16" id="cms_pagedes">
                            <?php echo $i->description;?>
                            </textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Status</label>
                          <div class="col-md-5">
                           	<select name="status" class="form-control">
                            	<option <?php if($i->status=='1'){?> selected="selected" <?php }?> value="1">Active</option>
                                <option <?php if($i->status=='0'){?> selected="selected" <?php }?> value="0">Inactive</option>
                            </select>
                          </div>
                        </div>
                        
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9"> 
                         	<input type="hidden" name="id" value="<?php echo $this->uri->segment(4);?>" />
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
