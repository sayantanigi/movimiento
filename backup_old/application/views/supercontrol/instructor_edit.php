<?php //$this->load->view ('header');?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<!-- BEGIN CONTAINER -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.datetimepicker.css"/>

<div class="page-container"> 

  <!-- BEGIN SIDEBAR -->

  <div class="page-sidebar-wrapper"> 

    <!-- BEGIN SIDEBAR --> 

    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing --> 

    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->

    <div class="page-sidebar navbar-collapse collapse"> 

      <!-- BEGIN SIDEBAR MENU --> 

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

          <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i> </li>

          <li> <span>Supercontrol panel</span> </li>

        </ul>

      </div>

      <!-- END PAGE BAR --> 

      <!-- BEGIN PAGE TITLE--> 

      <!-- END PAGE TITLE--> 

      <!-- END PAGE HEADER-->

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

                    <div class="caption"> <i class="fa fa-gift"></i>Edit  Instructor</div>

                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>

                  </div>

                  <div class="portlet-body form"> 

                    <!-- BEGIN FORM-->

                    <?php foreach($inst as $i){ ?>

                    <form action="<?php echo base_url().'supercontrol/course/edit_instructor' ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">

                      <div class="form-body">

                      <div class="form-group"> <b>

                        <label class="col-md-3 control-label">Select Course *</label>

                        </b>

                        <div class="col-md-8"> 

                        <select name="course_idd" class="form-control">

                        <?php foreach($course as $c){?>

                        <option value="<?php echo $c->course_id?>" <?php if($c->course_id==$i->course_id){?> selected="selected"<?php }?>><?php echo $c->course_name;?></option>

                        <?php }?>

                        </select>

                        <label id="errorBox"></label>

                        </div>

                        </div>

                      

                        <div class="form-group"> <b>

                        <label class="col-md-3 control-label">Select Instructor *</label>

                        </b>

                        <div class="col-md-8"> 

                        <select name="instructor_id" class="form-control">

                        <?php foreach($instr as $ac){?>

                        <option value="<?php echo $ac->member_id?>" <?php if($ac->member_id==$i->instructor_id){?> selected="selected" <?php }?>><?php echo $ac->first_name." ".$ac->last_name;?></option>

                        <?php }?>

                        </select>

                        <label id="errorBox"></label>

                        </div>

                        </div>

                        

                        <div class="form-group"> <b>

                        <label class="col-md-3 control-label">Select Course Mode *</label>

                        </b>

                        <div class="col-md-8"> 

                        <select name="mode_id" class="form-control">

                        <?php foreach($mode as $m){?>

                        <option value="<?php echo $m->id?>" <?php if($m->id==$i->mode_id){?> selected="selected" <?php }?>><?php echo $m->mode_title;?></option>

                        <?php } ?>

                        </select>

                        <label id="errorBox"></label>

                        </div>

                        </div>



                        <div class="form-group">

                          <label class="control-label col-md-3">Class Date</label>

                          <div class="col-md-8"> <?php echo form_input(array('id' => 'datetimepicker2', 'name' => 'class_date','value'=>date('Y-m-d',strtotime($i->class_date)),'class'=>'form-control')); ?>

                            <?php //echo form_error('cms_heading'); ?>

                          </div>

                        </div>

                        <div class="form-group">

                          <label class="control-label col-md-3">Start Time</label>

                          <div class="col-md-8"> <?php echo form_input(array('id' => 'timepicker1', 'name' => 'start_time','value'=>date('H:i:s',strtotime($i->start_time)),'class'=>'form-control')); ?>

                            <?php //echo form_error('cms_sub_heading'); ?>

                          </div>

                        </div>

                        <div class="form-group">

                          <label class="control-label col-md-3">End Time</label>

                          <div class="col-md-8"> <?php echo form_input(array('id' => 'timepicker2', 'name' => 'end_time','value'=>date('H:i:s',strtotime($i->end_time)),'class'=>'form-control')); ?>

                            <?php //echo form_error('description'); ?>

                          </div>

                        </div>

                        <div class="form-group"> <b>

                        <label class="col-md-3 control-label">Status</label>

                        </b>

                        <div class="col-md-8"> 

                        <select name="status" class="form-control">

                        <option value="1" <?php if($i->status==1){?> selected="selected"<?php }?>>Active</option>

                        <option value="0" <?php if($i->status==0){?> selected="selected"<?php }?>>InActive</option>

                        </select>

                        <label id="errorBox"></label>

                        </div>

                        </div>

                      </div>

                      <div class="form-actions">

                        <div class="row">

                          <div class="col-md-offset-3 col-md-9"> 

                            <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>--> 

                            <!-- <input type="hidden" name="inst_id" value="<?php echo @end($this->uri->segment_array());?>" /> -->

                            <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit' ,'class'=>'btn red')); ?>

                            <button type="button" class="btn default">Cancel</button>

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

