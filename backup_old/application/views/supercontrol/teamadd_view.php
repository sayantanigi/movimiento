<style type="text/css">
.datepicker .active {
	background-color: #fff !important;
}
.datepicker {
	color: #333;
}
.datepicker .active:hover {
	background-color: #fff !important;
}
.datepicker--day-name {
	color: #67809f!important;
	font-weight: 600!important;
}
</style>
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
      <?php if (isset($success_msg)) { echo $success_msg; } ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Add Team Members</div>
                  </div>
                  <div class="portlet-body form">
                    <form action="<?php echo base_url().'supercontrol/team/add_team' ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                      <div class="form-body">
                        <div class="form-group last">
                          <label class="control-label col-md-3">Image</label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                              <div> <span class="btn default btn-file"> <span class="fileinput-new"> Select image </span> <span class="fileinput-exists"> Change </span>
								<?php
                                $file = array('id' => 'team', 'type' => 'file','name' => 'userfile', 'onchange' => 'readURL(this);' );
                                echo form_input($file);
                                ?>
                                </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                            </div>
                            <div class="clearfix margin-top-10"> <span class="label label-danger">Format</span> jpg, jpeg, png, gif </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Members Name</label>
                          <div class="col-md-8"> <?php echo form_input(array('id' => 'mem_name', 'name' => 'mem_name','class'=>'form-control' )); ?> <?php echo form_error('mem_name'); ?> </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Members Designation</label>
                          <div class="col-md-8"> <?php echo form_input(array('id' => 'mem_desig', 'name' => 'mem_desig', 'class'=>'form-control' )); ?> <?php echo form_error('mem_desig'); ?> </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Members Description</label>
                          <div class="col-md-8"> <?php echo form_textarea(array('id' => 'pagedes', 'name' => 'mem_description','class'=>'form-control')); ?> </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Phone No</label>
                          <div class="col-md-8"> <?php echo form_input(array('id' => '', 'name' => 'mem_phone','class'=>'form-control')); ?> </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Email Id</label>
                          <div class="col-md-8"> <?php echo form_input(array('id' => '', 'name' => 'mem_email','class'=>'form-control')); ?> </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Facebook Link</label>
                          <div class="col-md-8"> <?php echo form_input(array('id' => '', 'name' => 'mem_fblink','class'=>'form-control')); ?> </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Twitter Link</label>
                          <div class="col-md-8"> <?php echo form_input(array('id' => '', 'name' => 'mem_twlink','class'=>'form-control')); ?> </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Linked In Link</label>
                          <div class="col-md-8"> <?php echo form_input(array('id' => '', 'name' => 'mem_lilink','class'=>'form-control')); ?> </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Instagram Link</label>
                          <div class="col-md-8"> <?php echo form_input(array('id' => '', 'name' => 'mem_instalink','class'=>'form-control')); ?> </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Google Plus Link</label>
                          <div class="col-md-8"> <?php echo form_input(array('id' => '', 'name' => 'mem_gpluslink','class'=>'form-control')); ?> </div>
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
					<script>
                        $('INPUT[type="file"]').change(function () {
                            var ext = this.value.match(/\.(.+)$/)[1];
                            switch (ext) {
                                case 'jpg':
                                case 'jpeg':
                                case 'png':
                                case 'gif':
                                $('#team').attr('disabled', false);
                                break;
                                default:
                                alert('This is not an allowed file type.');
                                this.value = '';
                            }
                        });
                    </script>
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
