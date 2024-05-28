<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <?php //include"lib/leftbar.php"?>
   <?php $this->load->view('leftbar'); ?>
    <!-- END SIDEBAR -->
  </div>
  <!-- END SIDEBAR -->
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
      <!-- END THEME PANEL -->
      <!-- BEGIN PAGE TITLE-->
      <h3 class="page-title">
        <?//=$pagetitle?>
        <!--<small>classic page head option</small>-->
      </h3>
      <!-- END PAGE TITLE-->
      <!-- BEGIN PAGE BAR -->
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="dashboard.php">Home</a> <i class="fa fa-angle-right"></i> </li>
          <li> <span>
            <?php echo @$title;//echo $this->session->flashdata('success_msg');; ?>
            </span> </li>
        </ul>
      </div>
      <!-- END PAGE BAR -->
     
      
      <?php //} ?>
		<?php
        //if($_REQUEST['mess'] == 'added') {
        ?>
      <div class="alert alert-success alert-dismissable" style="padding:10px;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
        <?php echo @$h1title;//echo $this->session->flashdata('success_msg');; ?>
      </div>
      <?php // } ?>
      <div class="row">
        <div class="col-md-12">
          <!-- BEGIN PORTLET-->
          <div class="portlet box blue-hoki">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-reorder"></i>
                <?//=$pagetitle?>
              </div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a>  <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body form">
            
            
            <form action="<?php echo base_url().'index.php/institute/add_institute' ?>" class="form-horizontal form-bordered" method="post" >
                <div class="form-body">
                  <!--<div class="form-group">
                    <label class="control-label col-md-3">Member Type</label>
                    <div class="col-md-5">
                      <?php
						 $options = array(
							'1' => 'newsmedia',
							'2' => 'Student',
							'3' => 'Educational Institution',
							'4' => 'Instructional Facility /School',
							);
							
							echo form_dropdown('member_type', $options, 'Computer Science Engineering', 'class="form-control"');
						?>
                        
                    </div>
                  </div>--> 
                  <div class="form-group">
                    <label class="control-label col-md-3">Name</label>
                    <div class="col-md-5">
                      <?php echo form_input(array('id' => 'name', 'name' => 'name','class'=>'form-control')); ?>
                      <?php echo form_error('name'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Description</label>
                    <div class="col-md-5">
                      <?php echo form_textarea(array('id' => 'cms_pagedes', 'name' => 'description','class'=>'form-control')); ?>
                      <?php echo form_error('description'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">School Bulletin</label>
                    <div class="col-md-5">
                      <?php echo form_input(array('id' => 'school_bulletin', 'name' => 'school_bulletin','class'=>'form-control')); ?>
                      <?php echo form_error('school_bulletin'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Instructor</label>
                    <div class="col-md-5">
                     
                      <?php echo form_input(array('id' => 'instructor', 'name' => 'instructor','class'=>'form-control')); ?>
                      <?php echo form_error('instructor'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Address</label>
                    <div class="col-md-5">
                      <?php echo form_input(array('id' => 'address', 'name' => 'address','class'=>'form-control')); ?>
                      <?php echo form_error('address'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Telephone Number</label>
                    <div class="col-md-5">
                      <?php echo form_input(array('id' => 'tel_no', 'name' => 'tel_no','class'=>'form-control','maxlength'=>'10')); ?>
                      <?php echo form_error('tel_no'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Email</label>
                    <div class="col-md-5">
                      <?php echo form_input(array('id' => 'email', 'name' => 'email','class'=>'form-control')); ?>
                      <?php echo form_error('email'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">SMS No</label>
                    <div class="col-md-5">
                      <?php echo form_input(array('id' => 'sms_no', 'name' => 'sms_no','class'=>'form-control')); ?>
                      <?php echo form_error('sms_no'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">IP Address</label>
                    <div class="col-md-5">
                      <?php echo form_input(array('id' => 'ip_address', 'name' => 'ip_address','class'=>'form-control')); ?>
                      <?php echo form_error('ip_address'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Website</label>
                    <div class="col-md-5">
                      <?php echo form_input(array('id' => 'website', 'name' => 'website','class'=>'form-control')); ?>
                      <?php echo form_error('website'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Domain Name</label>
                    <div class="col-md-5">
                      <?php echo form_input(array('id' => 'domain_name', 'name' => 'domain_name','class'=>'form-control')); ?>
                      <?php echo form_error('domain_name'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">URL</label>
                    <div class="col-md-5">
                      <?php echo form_input(array('id' => 'url', 'name' => 'url','class'=>'form-control')); ?>
                      <?php echo form_error('url'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Learning Portal</label>
                    <div class="col-md-5">
                      <?php echo form_input(array('id' => 'learning_portal', 'name' => 'learning_portal','class'=>'form-control')); ?>
                      <?php echo form_error('learning_portal'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Schools</label>
                    <div class="col-md-5">
                      <?php echo form_input(array('id' => 'schools', 'name' => 'schools','class'=>'form-control')); ?>
                      <?php echo form_error('schools'); ?>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                      <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                      <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit' ,'class'=>'btn red')); ?>
                      <button type="button" class="btn default">Cancel</button>
                    </div>
                  </div>
                </div>
              </form>
              <!-- BEGIN FORM-->
              
              <!-- END FORM-->
            </div>
          </div>
          <!-- END PORTLET-->
        </div>
      </div>
    </div>
    <!-- END CONTENT BODY -->
  </div>
  <!-- END CONTENT -->
  <!-- BEGIN QUICK SIDEBAR -->
  <!-- END QUICK SIDEBAR -->
</div>              