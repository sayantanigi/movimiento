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
               <?php echo isset($title) ? $title : 'Nahids Property' ; ?>
              </div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body form">
            

            <!--<form action="<?php echo base_url().'index.php/banner/edit_banner' ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" >-->
              <?php foreach($ecms as $i){?>

                  <?php
				  $steeurl = base_url().'index.php/banner/edit_banner';
				   $attr = "class='form-horizontal form-bordered'"; 
				   ?>
         
            	<?php echo form_open_multipart($steeurl,$attr); ?>
                
                                <input type="hidden" name="id" value="<?php echo $i->id;?>">
                <input type="hidden" name="oldimg" value="<?php echo $i->banner_image;?>">

                <div class="form-body">
                
                <div class="form-group">
                    <label class="control-label col-md-3">Image</label>
                    <div class="col-md-8">
                    <?php $pic = base_url().'banner/'.$i->banner_image; ?>
                    <div>
						 <img src="<?=$pic?>" alt="Wait..." width="200px" title="<?=$i->title?>">
                         </div>
                      <?php echo form_input(array('id' => 'banner_image', 'type'=>'file', 'name' => 'banner_image','class'=>'form-control')); ?>
                      <?php echo form_error('banner_image'); ?>
                    </div>
                  </div>
                   
                  <div class="form-group">
                    <label class="control-label col-md-3">Heading</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'title', 'name' => 'title','class'=>'form-control'),$i->title); ?>
                      <?php echo form_error('title'); ?>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3">Sub Heading</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'subtitle', 'name' => 'subtitle','class'=>'form-control'),$i->subtitle); ?>
                      <?php echo form_error('subtitle'); ?>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3">Description</label>
                    <div class="col-md-8">
                      <?php echo form_textarea(array('id' => 'cms_pagedes', 'name' => 'description','class'=>'form-control'),$i->description); ?>
                      <?php echo form_error('description'); ?>
                      
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
     