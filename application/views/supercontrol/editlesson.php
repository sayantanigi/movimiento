<?php //$this->load->view ('header');?>
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
          <li> <span>supercontrol panel</span> </li>
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
                    <div class="caption"> <i class="fa fa-gift"></i>Add page</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form"> 
                    <!-- BEGIN FORM-->
                    
                    <?php 
					if($llist!=''){
						foreach($llist as $ll){?>
                    		<form action="<?php echo base_url().'supercontrol/course/update_lesson' ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                      <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-3">Course Type</label>
                          <div class="col-md-8"> 
                          	<select name="type_id" class="form-control">
                            	<option value="wd" <?php if($ll->type_id=='wd'){?> selected="selected" <?php }?>>Weekdays</option>
                                <option value="ev" <?php if($ll->type_id=='ev'){?> selected="selected" <?php }?>>Evening</option>
                                <option value="we" <?php if($ll->type_id=='we'){?> selected="selected" <?php }?>>Weekend</option>
                            </select>
                            <?php //echo form_error('cms_pagetitle'); ?>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Lesson Date</label>
                          <div class="col-md-8">  <input type="text" class="form-control" id="datetimepicker2" value="<?php echo $ll->start_date;?>" name="start_date">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Start Time</label>
                          <div class="col-md-8">  <input type="text" class="form-control" id="timepicker1" value="<?php echo date('H:i',strtotime($ll->start_time));?>" name="start_time">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">End Time</label>
                          <div class="col-md-8">  <input type="text" class="form-control" id="timepicker2" value="<?php echo date('H:i',strtotime($ll->end_time));?>" name="end_time">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Status</label>
                          <div class="col-md-8">
                          	<select name="status" class="form-control">
                            	<option value="1" <?php if($ll->status=='1'){?> selected="selected" <?php }?>>Active</option>
                                <option value="0" <?php if($ll->status=='0'){?> selected="selected" <?php }?>>Inactive</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9"> 
                            <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>--> 
                            <input type="hidden" name="lession_id" value="<?php echo $ll->lession_id;?>" />
                            <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit' ,'class'=>'btn red')); ?>
                            <button type="button" class="btn default">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <?php }
					}
					?>
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
