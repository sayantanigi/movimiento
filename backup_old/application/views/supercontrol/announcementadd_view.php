<?php //$this->load->view ('header');?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<!-- BEGIN CONTAINER -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.datetimepicker.css"/>

<div class="page-container"> 

  <!-- BEGIN SIDEBAR -->

  <div class="page-sidebar-wrapper"> 

    <div class="page-sidebar navbar-collapse collapse"> 

      <?php $this->load->view ('supercontrol/leftbar');?>
    </div>

  </div>

  <!-- END SIDEBAR --> 

  <!-- BEGIN CONTENT -->

  <div class="page-content-wrapper"> 

    <!-- BEGIN CONTENT BODY -->

    <div class="page-content"> 


      <div class="page-bar">

        <ul class="page-breadcrumb">

          <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i> </li>

          <li> <span>supercontrol panel</span> </li>

        </ul>

      </div>

      <div class="alert alert-success alert-dismissable" style="padding:10px;">

        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>

        <strong>

        <?php 

				$last = end($this->uri->segments); 

				if($last=="success"){echo "Data Added Successfully ......";}

				if($last=="successdelete"){echo "Data Deleted Successfully ......";}

            ?>

            <?php if($this->session->flashdata('success')!=''){?><div class="alert alert-success text-center"><?php echo $this->session->flashdata('success');?></div><?php }?>

        </strong> </div>

      <div class="row">

        <div class="col-md-12">

          <div class="tabbable-line boxless tabbable-reversed">

            <div class="tab-content">

              <div class="tab-pane active" id="tab_0">

                <div class="portlet box blue-hoki">

                  <div class="portlet-title">

                    <div class="caption"> <i class="fa fa-gift"></i>Add Announcement</div>

                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>

                  </div>

                  <div class="portlet-body form"> 

                    <!-- BEGIN FORM-->

                    <form action="<?php echo base_url().'supercontrol/announcement/add_announcement' ?>" class="form-horizontal form-bordered" method="post">

                      <div class="form-body">

                        <div class="form-group">

                          <label class="control-label col-md-3">Announcement Title</label>

                          <div class="col-md-8"> <?php echo form_input(array('id' => 'announcement_title', 'name' => 'announcement_title','class'=>'form-control')); ?>

                            <?php echo form_error('announcement_title'); ?>

                          </div>

                        </div>

                        <div class="form-group">

                          <label class="control-label col-md-3">Description</label>

                          <div class="col-md-8"> 
                          <textarea class="form-control" name="description" id="pagedes" rows="8" cols="16" id="cms_pagedes"></textarea>

                            <?php echo form_error('description'); ?>

                          </div>

                        </div>

                        

                      </div>

                      <div class="form-actions">

                        <div class="row">

                          <div class="col-md-offset-3 col-md-9"> 

                            <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>--> 

                            <input type="hidden" name="course_id" value="<?php echo end($this->uri->segment_array());?>" />

                            <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit' ,'class'=>'btn red')); ?>

                            <button type="button" class="btn default">Cancel</button>

                          </div>

                        </div>

                      </div>

                    </form>

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

<script src="<?php echo base_url(); ?>js/jquery.js"></script>

<script src="<?php echo base_url(); ?>js/jquery.datetimepicker.full.js"></script>

<script>

$.datetimepicker.setLocale('en');

$('#timepicker1').datetimepicker({

	datepicker:false,

	format:'H:i',

	step:5

});



$('#timepicker2').datetimepicker({

	datepicker:false,

	format:'H:i',

	step:5

});



$('#datetimepicker2').datetimepicker({

	format:'d-m-Y',

	timepicker:false,

	formatDate:'d-m-Y',

	minDate:'-2016/11/03', // yesterday is minimum date

});

$('#datetimepicker_dark').datetimepicker({theme:'dark'})

</script>

<!-- END CONTAINER -->

<?php //$this->load->view ('footer');?>

