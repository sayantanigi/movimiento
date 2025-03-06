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
            
             <?php foreach($ecms as $i){?>
            <form action="<?php echo base_url().'index.php/settings/edit_settings' ?>" class="form-horizontal form-bordered" method="post" >
            <input type="hidden" name="id" value="<?php echo $i->id;?>">
                <div class="form-body">
                   
                  <div class="form-group">
                    <label class="control-label col-md-3">Title</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'name', 'name' => 'title','class'=>'form-control'),$i->title); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Phonenumber</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'phonenumber', 'name' => 'phonenumber','class'=>'form-control') ,$i->phonenumber); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Email</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'email', 'name' => 'email','class'=>'form-control') ,$i->email); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">facebook link</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'fb_link', 'name' => 'fb_link','class'=>'form-control') ,$i->fb_link); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Twitter Link</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'twitter_link', 'name' => 'twitter_link','class'=>'form-control') ,$i->twitter_link); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Google plus link</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'gplus_link', 'name' => 'gplus_link','class'=>'form-control') ,$i->gplus_link); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">V Link</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'v_link', 'name' => 'v_link','class'=>'form-control') ,$i->v_link); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Address</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'address', 'name' => 'address','class'=>'form-control') ,$i->address); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Map</label>
                    <div class="col-md-8">
                      <?php echo form_textarea(array('id' => 'cms_pagedes', 'name' => 'map','class'=>'form-control') ,$i->map); ?>
                    </div>
                  </div>
                  
                </div>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                      <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                      <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit' ,'class'=>'btn red')); ?>
                      <button class="btn default" type="button">Cancel</button>
                    </div>
                  </div>
                </div>
              </form>
               <?php }?>
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
     