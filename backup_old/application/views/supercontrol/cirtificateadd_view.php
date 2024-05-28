<?php 
$this->load->model('supercontrol/generalmodel');
//$this->load->view ('header');?>
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/jquery.datetimepicker.css"/>
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
			echo $this->session->flashdata('success');
			$last = end($this->uri->segments); 
			if($last=="success"){  echo "Data Added Successfully ......";}
			if($last=="successdelete"){ echo "Data Deleted Successfully ......";}
         ?>
        </strong> 
     </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Generate Certificate For <?php if($membername!=''){ foreach($membername as $ml){echo $ml->first_name." ".$ml->last_name; }}?></div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form"> 
                    <!-- BEGIN FORM-->
                    <form action="<?php echo base_url().'supercontrol/member/generate_cirtificate'?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" >
                      <div class="form-body">
                        <div class="form-group">
                        <label class="control-label col-md-3">Purchased  Course</label>
                        <div class="col-md-8">
                        <?php 
                        foreach($membername as $ml){
                          $std_id=$ml->email;
                          }
                          $details=$this->generalmodel->fetch_all_join("Select * from sm_course_booking  where student_id='$std_id'");
                          foreach ($details as $cid) {
                             echo $cid->course_name."<br/>";
                            }

                        ?>
                        </div>


                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Certificate for Course</label>
                          <div class="col-md-8"> 
                          	<select name="course_id" class="form-control">
                            	<?php foreach($course as $crs){?>
                                	<option value="<?php echo $crs->course_id?>"><?php echo $crs->course_name?></option>
                                <?php }?>
                            </select>
						   </div>
                        </div>
                        <div id="err1" style="color:#f00;text-align:center;"></div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Issue Date</label>
                          <div class="col-md-8"> 
						  <?php echo form_input(array('id' => 'datetimepicker2', 'name' => 'issue_date','class'=>'form-control')); ?> 
                         <!-- <input type="text" id="datetimepicker2"/>-->
                          </div>
                          <script src="<?php echo base_url()?>js/jquery.js"></script>
							<script src="<?php echo base_url()?>js/jquery.datetimepicker.full.js"></script>
							<script>
                            $.datetimepicker.setLocale('en');
                            $('#datetimepicker2').datetimepicker({
                                format:'d-m-Y',
                                timepicker:false,
                                formatDate:'d-m-Y',
                                minDate:'-2016/11/03', // yesterday is minimum date
                            });
                            $('#datetimepicker_dark').datetimepicker({theme:'dark'})
                            </script>
                        </div>
                        <div id="err2" style="color:#f00;text-align:center;"></div>
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9"> 
                            <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>--> 
                            <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit' ,'class'=>'btn red')); ?>
                            <input type="hidden" name="member_id" value="<?php echo $this->uri->segment(4);?>" />
                            <button type="button" class="btn default" onclick="goBack()">Cancel</button>
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
<?php //$this->load->view ('footer');?>
