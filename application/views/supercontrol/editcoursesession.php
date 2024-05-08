<?php //$this->load->view ('header');?>

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
          <li> <span>supercontrol Panel</span> </li>
        </ul>
      </div>
	  
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Course Session Edit</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                   <?php foreach($lessdetails as $i){?>
  <form action="<?php echo base_url().'supercontrol/batch/edit'?>" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="check()">
                                 <div class="form-body">
                                    <div class="form-group">
                                       <b>
                                       <label class="col-md-3 control-label">Total Session *</label>
                                       </b>
                                       <div class="col-md-8">
                                          <input type="text" class="form-control" id="total_session"  value="<?php echo $i->total_session;?>" name="total_session"   required>
                                          <label id="errorBox"></label>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <b>
                                       <label class="col-md-3 control-label">Total hours *</label>
                                       </b>
                                       <div class="col-md-8">
                                          <input type="text" class="form-control"  value="<?php echo $i->total_hour;?>" name="total_hour" required="required">
                                          <label id="errorBox"></label>
                                       </div>
                                    </div>
                                    <div id="startdate">
                                    <?php $ctb=1; foreach($batchSessionlist as $j){?>
                                     <div class="form-group">
                                       <b>
                                       <label class="col-md-3 control-label">Session <?php echo $ctb;?> Date *</label>
                                       </b>
                                       <div class="col-md-8">
                                          <input type="date" class="form-control"  value="<?php echo $j->date;?>" name="date" required="required">
                                          <label id="errorBox"></label>
                                       </div>
                                    </div>
                                     <div class="form-group">
                                       <b>
                                       <label class="col-md-3 control-label">Session <?php echo $ctb;?> Start Time  *</label>
                                       </b>
                                       <div class="col-md-8">
                                          <input type="text" class="form-control"  value="<?php echo $j->starttime;?>" name="starttime" required="required">
                                          <label id="errorBox"></label>
                                       </div>
                                    </div>
                                     <div class="form-group">
                                       <b>
                                       <label class="col-md-3 control-label">Session <?php echo $ctb;?> End Time *</label>
                                       </b>
                                       <div class="col-md-8">
                                          <input type="text" class="form-control"  value="<?php echo $j->endtime;?>" name="endtime" required="required">
                                          <label id="errorBox"></label>
                                       </div>
                                    </div>
                                     <div class="form-group">
                                       <b>
                                       <label class="col-md-3 control-label">Session <?php echo $ctb;?> Time Type *</label>
                                       </b>
                                       <div class="col-md-8">
                                          <input type="text" class="form-control"  value="<?php echo $j->time_type;?>" name="time_type" required="required">
                                          <label id="errorBox"></label>
                                       </div>
                                    </div>
                                     <div class="form-group">
                                       <b>
                                       <label class="col-md-3 control-label">Session <?php echo $ctb;?> Session Objective *</label>
                                       </b>
                                       <div class="col-md-8">
                                          <input type="text" class="form-control"  value="<?php echo $j->session_objective;?>" name="session_objective" required="required">
                                          <label id="errorBox"></label>
                                       </div>
                                    </div>
                                     <div class="form-group">
                                       <b>
                                       <label class="col-md-3 control-label">Session <?php echo $ctb;?> Location *</label>
                                       </b>
                                       <div class="col-md-8">
                                           
                                           
                                           <?php 
								$this->load->model('generalmodel'); 
								$table_name = 'sm_location';
								$primary_key = 'id';
								$wheredata = $j->session_location;
								$queryalllevels = $this->generalmodel->getAllData($table_name,$primary_key,$wheredata,'','');
							//	echo $queryalllevels[0]->location_name;
								
							?>
                                          <input type="text" class="form-control"  value="<?php echo $queryalllevels[0]->location_name;?>" name="session_location" required="required" readonly>
                                          <label id="errorBox"></label>
                                       </div>
                                    </div>
                                    
                                    
                                    <?php $ctb++;} ?>

                                    </div>
                                 </div>
                                 <div class="form-actions">
                                    <div class="row">
                                       <div class="col-md-offset-3 col-md-9">
                                           
                                           <input type="hidden" name="batch_id"  value="<?php echo $i->batchId;?>" />
                                           <input type="hidden" name="courseId" value="<?php echo $i->courseId;?>" />
                           <input type="submit" id="submit" value="Submit" class="btn red">
                                          <!--<input type="submit" id="submit" value="Submit" class="btn red">-->
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
<!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>

<script>
function myFunction() {
  var txt;
  var r = confirm("Press a button!");
  if (r == true) {
    txt = "You pressed OK!";
  } else {
    txt = "You pressed Cancel!";
  }
  document.getElementById("demo").innerHTML = txt;
}
</script>


<script>
   $(document).ready(function() {
      $('#total_session').on("focusout",function(){
          var r = confirm("Want To Sure Edit");
          if (r == true) {
         var val = $(this).val();
         var html = '';
         for(var i=1; i<=val; i++){
             html += '<div class="form-group"><b><label class="col-md-3 control-label">Session'+i+' Date *</label></b><div class="col-md-8"><input type="date" name="date[]" id="timepicker1"  class="form-control" /><label id="errorBox"></label></div></div><div class="form-group"><b><label class="col-md-3 control-label">Session'+i+' Start Time *</label></b><div class="col-md-8"><input type="time" name="startTime[]" id="timepicker1"  class="form-control" /><label id="errorBox"></label></div></div><div class="form-group"><b><label class="col-md-3 control-label">Session'+i+' End Time *</label></b><div class="col-md-8"><input type="time" name="endTime[]" id="timepicker1"  class="form-control" /><label id="errorBox"></label></div></div><div class="form-group"><b><label class="col-md-3 control-label">Session'+i+' Time Type *</label></b><div class="col-md-8"><input type="text" name="time_type[]"   class="form-control" /><label id="errorBox"></label></div></div><div class="form-group"><b><label class="col-md-3 control-label">Session'+i+' Session Objective *</label></b><div class="col-md-8"><input type="text" name="session_objective[]"   class="form-control" /><label id="errorBox"></label></div></div><div class="form-group"><b><label class="col-md-3 control-label">Session'+i+' Location *</label></b><div class="col-md-8"><select name="session_location[]" class="form-control"><option>-- Select Location --</option><?php if(is_array($locations) && count($locations)>0){foreach($locations as $ls){ ?>
              <option value="<?=$ls->id?>"><?=$ls->location_name?></option> <?php }} ?></select><label id="errorBox"></label></div></div>';
         
         }
         $('#startdate').html(html);
         console.log(html);
          }else{
              return false;
          }
      });
   });
   
</script>
<script>
    function cityget(sl,j){
        var  id = sl.value;
        
        if(id==''){
            jQuery('#cityShow'+j).html('<option>--Select Course--</option>');
            return false;
        }
        jQuery.ajax({
       url: '<?=site_url('courses/getCity');?>',
       type: 'POST',
       dataType: 'html',
       data: {id:id},
       })
       .done(function(e) {
           jQuery('#cityShow'+j).html(e);
       });
    }
</script>
<script>
    function confirmationDelete(anchor)
{
   var conf = confirm('Are you sure want to Edit this record?');
   if(conf)
      window.location=anchor.attr("href");
}
</script>


