<?php //$this->load->view ('header');?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript">
$(function() {
setTimeout(function() { $("#testdiv").fadeOut(1500); }, 5000)
$('#btnclick').click(function() {
$('#testdiv').show();
setTimeout(function() { $("#testdiv").fadeOut(1500); }, 5000)
})
})
</script>

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
          <?php if($this->session->flashdata('success_add')!=''){ ?>  
          <?php echo $this->session->flashdata('success_add')?>
          <?php }?>
        </strong> </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Add Private Booking</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form"> 
                    <!-- BEGIN FORM-->
                    <form action="<?php echo base_url().'supercontrol/course/add_private_booking'?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                      <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-3">Whole Course Price</label>
                          <div class="col-md-8"><input type="text" name="price_whole_course" value="" required="" class="form-control" onkeypress="return IsNumeric(event);" placeholder="&pound; 100" />
                          <?php echo form_error('price_whole_course'); ?>
                          	<span id="error" style="color: red; display: none">*  Enter numeric Value</span>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Price Per Hour</label>
                          <div class="col-md-8"><input type="text" name="price_per_hr" value="" required="" class="form-control" onkeypress="return IsNumeric(event);" placeholder="&pound; 10" />
                          <?php echo form_error('price_per_hr'); ?>
                          	<span id="error1" style="color:red; display: none">*  Enter numeric Value  </span>
                          </div>
                        </div>
                        
                       </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9"> 
                            <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>--> 
                            <input type="hidden" name="course_id" value="<?php echo end($this->uri->segment_array())?>" />
                            <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit' ,'class'=>'btn red')); ?>
                            <button type="button" class="btn default">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <script type="text/javascript">
						var specialKeys = new Array();
						specialKeys.push(8); //Backspace
						function IsNumeric(e) {
							var keyCode = e.which ? e.which : e.keyCode
							var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
							document.getElementById("error").style.display = ret ? "none" : "inline";
							return ret;
						}
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
<?php //$this->load->view ('footer');?>
