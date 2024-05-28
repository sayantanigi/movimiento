<style>
#sample_1_filter {
	padding: 8px;
	float: right;
}
#sample_1_length {
	padding: 8px;
}
#sample_1_info {
	padding: 8px;
}
#sample_1_paginate {
	float: right;
	padding: 8px;
}
</style>
<div class="page-container"> 
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper"> 
    <!-- BEGIN SIDEBAR --> 
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
  <style>
 	.dataTables_info{padding:7px;}
  </style>
  <div class="page-content-wrapper"> 
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content"> 
      <!-- BEGIN PAGE HEADER--> 
      <!-- BEGIN PAGE BAR -->
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li><a href="<?php echo base_url(); ?>supercontrol/home">Home</a><i class="fa fa-circle"></i> </li>
          <li><span>Supercontrol Panel</span> <i class="fa fa-circle"></i></li>
          <li><span>Show Instructor List </span></li>
        </ul>
      </div>
      <!-- END PAGE BAR --> 
      <!-- END PAGE HEADER-->
      <?php if(@$success_msg){echo @$success_msg;}?>
      <?php if(@$message){echo @$message;}?>
      <?php if(@$msg){echo @$msg;}?>
      <?php if(@$msg1){echo @$msg1;}?>
      <?php if($this->session->flashdata('success')!=''){?>
      <div class="alert alert-success text-center"><?php echo $this->session->flashdata('success');?></div>
      <?php }?>
      
      <?php if (isset($success_msg)) { echo $success_msg; } ?>
						<?php if($this->session->flashdata('add_message')!=''){?>
                        <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&#10006;</button>
                        <strong><?php echo @$this->session->flashdata('add_message');?></strong> 
                        </div>
                        <?php }?>
                        <?php if($this->session->flashdata('edit_message')!=''){?>
                        <div class="alert alert-success1" style="background-color:#98E0D5;">
                        <button type="button" class="close" data-dismiss="alert">&#10006;</button>
                        <strong style="color:#063;"><?php echo @$this->session->flashdata('edit_message');?></strong> 
                        </div>
                        <?php }?>
                        <?php if($this->session->flashdata('delete_message')!=''){?>
                        <div class="alert alert-success" style="background-color:#F0959B;">
                        <button type="button" class="close" data-dismiss="alert">&#10006;</button>
                        <strong style="color:#900;"><?php echo @$this->session->flashdata('delete_message');?></strong> 
                        </div>
                        <?php }?>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Show Instructor Details</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a>  <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                    
                    
                    <!-- BEGIN FORM-->
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                      <div id="mydiv">
                        <thead>
                          <tr>
                            <th width="20"><input id="selectall" type="checkbox"></th>
                            <!--  <th width="180" style="max-width:170px;">Image</th>-->
                            <th width="30">Course Title</th>
                            <th width="30">Course Mode</th>
                            <th width="27">Instructor</th>
                            <th width="27">Class Date</th>
                            <th width="27">Start Time</th>
                            <th width="27">End Time</th>
                            <th width="27">Status</th>
                            <th width="27">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          	<?php if(is_array($inst)){ ?>
                            <?php
					  		$ctn=1;
                      		foreach($inst as $i){
								$cid = $i->course_id;
								$course = $this->instructor_model->show_course_id($cid);
								if(!empty($course)){
                      		?>
                          <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                            <td><input name="checkbox[]" class="checkbox1" type="checkbox"  value="<?php echo $i->inst_id;?>"></td>
                           
                            <td  style="max-width:200px;"><?php echo @$course[0]->course_name;?></td>
                            <td  style="max-width:200px;">
							<?php 
								$mid = $i->mode_id;
								$mode = $this->instructor_model->show_mode_id($mid);
								echo $mode[0]->mode_title;
							?>
                            </td>
                            <td  style="max-width:250px;">
							<?php 
								$uid = $i->instructor_id;
								$instructor = $this->instructor_model->show_member_id($uid);
								echo $instructor->first_name." ".$instructor->last_name;
							?>
                            </td>
                            <td  style="max-width:250px;"><?php echo date('Y-m-d',strtotime($i->class_date));?></td>
                            <td  style="max-width:250px;"><?php echo date('H:i:s',strtotime($i->start_time));?></td>
                            <td  style="max-width:250px;"><?php echo date('H:i:s',strtotime($i->end_time));?></td>
                            <td  style="max-width:250px;"><?php if($i->status=='1'){ echo "<b style='color:green;'>Active</b>"; }else{ echo "<b style='color:red;'>InActive</b>"; }?></td>
                            

                            
                            <td style="max-width:50px;">
                            <a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/member/view_member_id/<?php echo $i->instructor_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i>
</a>
                            
                            <a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/course/show_instructor_id/<?php echo $i->inst_id; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</a>
                            
                            <a class="btn red btn-sm btn-outline sbold uppercase" onclick="return confirm('Are you sure about this delete?');" href="<?php echo base_url()?>supercontrol/course/delete_instructor/<?php echo $i->inst_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i>
</a>
                            </td>
                          </tr>
                          <?php }?>
                          <?php $ctn++; }?>
                          <?php }  ?>
                         
                        </tbody>
                      </div>
                    </table>
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
<script>
//====FOR DELETE MULTIPLE====
     $(document).ready(function() {
                //resetcheckbox();
				$("#selectall").click(function(){
					var check = $(this).prop('checked');
						if(check == true) {
							$('.checker').find('span').addClass('checked');
							$('.checkbox1').prop('checked', true);
						} else {
							$('.checker').find('span').removeClass('checked');
							$('.checkbox1').prop('checked', false);
						}
				});
                $("#del_all").on('click', function(e) {
                    e.preventDefault();
                    var checkValues = $('.checkbox1:checked').map(function()
                    {
                        return $(this).val();
                    }).get();
                    console.log(checkValues);
                     //alert(checkValues);
                    $.each( checkValues, function( i, val ) {
					 //alert(val);
                        $("#"+val).remove();
                        });
//                    return  false;
					 //alert ("<?php echo base_url() ?>supercontrol/controllers/blog/delete_multiple");
                    $.ajax({
						  
                        url: '<?php echo base_url() ?>supercontrol/course/delete_multiple_inst',
                        type: 'post',
                        data: 'ids=' + checkValues
                    }).done(function(data) {
                        $("#respose").html(data);
						//location.reload();
						var newurl= '<?php echo base_url() ?>supercontrol/course/show_instructor';
						window.location.href = newurl;
                        $('#selectall').attr('checked', false);
                    });
                });
                 
                function  resetcheckbox(){
                $('input:checkbox').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                   });
                }
            });
</script> 
<script>
		function f1(stat,id)
		{
		$.ajax({
		type:"get",
		url:"<?php echo base_url(); ?>supercontrol/blog/statusblog",
		data:{stat : stat, id :id}
		});
		}
</script> 

<!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>
