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
      <?php if (isset($success_msg)) { echo $success_msg; } ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Add Timeline</div>
                  </div>
                  <div class="portlet-body form">
                    <form action="<?php echo base_url().'supercontrol/timeline/add_timeline'?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                      <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-3">Heading</label>
                          <div class="col-md-8"> <?php echo form_input(array('id' => 'timeline_heading', 'name' => 'timeline_heading','class'=>'form-control' )); ?> <?php echo form_error('timeline_heading'); ?> </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Sub Heading</label>
                          <div class="col-md-8"> <?php echo form_input(array('id' => 'timeline_sub_heading', 'name' => 'timeline_sub_heading','class'=>'form-control' )); ?> <?php echo form_error('timeline_sub_heading'); ?> </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Description</label>
                          <div class="col-md-8"> <?php echo form_textarea(array('id' => 'pagedes', 'name' => 'timeline_description','class'=>'form-control ' )); ?> <?php echo form_error('timeline_description'); ?> </div>
                        </div>
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9"> <?php echo form_submit(array('id' => 'submit', 'name' => 'Submit' , 'value' => 'Submit' ,'class'=>'btn red')); ?>
                            <button type="button" class="btn default">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </form>
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
