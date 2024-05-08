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
          <li> <span>Supercontrol Panel</span> </li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Timeline edit</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <?php foreach($ecms as $i){?>
                    <form method="post" class="form-horizontal form-bordered" action="<?php echo base_url()?>supercontrol/timeline/edit_timeline" enctype="multipart/form-data">
                      <div class="form-body">
                        <input type="hidden" name="timeline_id" value="<?=$i->id;?>">
                        <div class="form-group">
                          <label class="control-label col-md-3">Timeline heading</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="timeline_heading" value="<?php echo $i->timeline_heading;?>" name="timeline_heading">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Timeline Subheading</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="timeline_sub_heading" value="<?php echo $i->timeline_sub_heading;?>" name="timeline_sub_heading">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Descriptions</label>
                          <div class="col-md-7">
                            <textarea class="form-control" name="description" id="pagedes" rows="6"> <?php echo $i->timeline_description;?> </textarea>
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
