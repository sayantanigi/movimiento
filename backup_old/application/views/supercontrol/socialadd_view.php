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
               <?php echo isset($title) ? $title : 'Default Title' ; ?>
              </div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body form">
            
            
            <form action="<?php echo base_url().'index.php/social/add_social' ?>" class="form-horizontal form-bordered" method="post" >
                <div class="form-body">
                   
                  <div class="form-group">
                    <label class="control-label col-md-3">Name</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'name', 'name' => 'name','class'=>'form-control')); ?>
                      <?php echo form_error('name'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Description</label>
                    <div class="col-md-8">
                      <?php echo form_textarea(array('id' => 'cms_pagedes', 'name' => 'description','class'=>'form-control')); ?>
                      <?php echo form_error('description'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Ip Address</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'ip_address', 'name' => 'ip_address','class'=>'form-control')); ?>
                      <?php echo form_error('ip_address'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Website</label>
                    <div class="col-md-8">
                     
                      <?php echo form_input(array('id' => 'website', 'name' => 'website','class'=>'form-control')); ?>
                      <?php echo form_error('website'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Domain Name</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'domain_name', 'name' => 'domain_name','class'=>'form-control')); ?>
                      <?php echo form_error('domain_name'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Url</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'url', 'name' => 'url','class'=>'form-control','maxlength'=>'10')); ?>
                      <?php echo form_error('url'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Email Address</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'email', 'name' => 'email','class'=>'form-control')); ?>
                      <?php echo form_error('email'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Marking Media</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'marking_media', 'name' => 'marking_media','class'=>'form-control')); ?>
                      <?php echo form_error('marking_media'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Add Meterial</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'add_meterial', 'name' => 'add_meterial','class'=>'form-control')); ?>
                      <?php echo form_error('add_meterial'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Marketing Meterial</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'marketing_meterial', 'name' => 'marketing_meterial','class'=>'form-control')); ?>
                      <?php echo form_error('marketing_meterial'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Commercials</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'commercials', 'name' => 'commercials','class'=>'form-control')); ?>
                      <?php echo form_error('commercials'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Infomercials</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'infomercials', 'name' => 'infomercials','class'=>'form-control')); ?>
                      <?php echo form_error('infomercials'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Media Link</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'media_link', 'name' => 'media_link','class'=>'form-control')); ?>
                      <?php echo form_error('media_link'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Network Site</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'network_site', 'name' => 'network_site','class'=>'form-control')); ?>
                      <?php echo form_error('network_site'); ?>
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
     