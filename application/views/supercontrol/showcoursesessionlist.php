<?php //$this->load->view ('header');?>
<!-- BEGIN CONTAINER -->
<style>
#sample_1_filter{
	padding: 8px;
    float: right;
	}
#sample_1_length{
	padding: 8px;
	}
#sample_1_info{
	padding: 8px;	
	}
#sample_1_paginate{
	float: right;
    padding: 8px;
	}	
	.modal-open .modal {
    display: flex!important;
    align-items: center!important;
}
.modal-dialog {
	flex-grow: 1;
}
</style>
<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
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
      <!-- END THEME PANEL -->
      <!-- BEGIN PAGE BAR -->
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>supercontrol Panel</span> <i class="fa fa-circle"></i> </li>
          <li> <span>Show Press List </span> </li>
        </ul>
      </div>
      <!-- END PAGE BAR -->
      <!-- END PAGE HEADER-->
      <?php if(@$success_msg){echo @$success_msg;}?>
	   <?php if(@$message){echo @$message;}?>
	     <?php if(@$msg){echo @$msg;}?>
		    <?php if(@$msg1){echo @$msg1;}?> 
			<?php if($this->session->flashdata('success')!=''){?><div class="alert alert-success text-center"><?php echo $this->session->flashdata('success');?></div><?php }?>
			
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Show Press</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a>  <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  
                  <div class="portlet-body form">
                  
                  
                    <!-- BEGIN FORM-->
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                    <div id="mydiv">
                      <thead>
                        <tr>
                          <th width="20"><input id="selectall" type="checkbox"></th>
                          <th>Total Session</th>
                          <th>Total Time</th>
                          <th>Session Time table </th>
                          <th width="27">Edit</th>
                          <th width="27">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                          <td>
                          <input name="checkbox[]" class="checkbox1" type="checkbox"  value="<?php echo $batchlist->id;?>">
                          </td>
                          <td><?php echo $batchlist->total_session;?></td>
                          <td><?php echo $batchlist->total_hour;?></td>
                          <td>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                              Session Time table
                            </button>
                                     <!--<a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url();?>supercontrol/course/session_view"><i class="fa fa-plus" aria-hidden="true"></i> Time Table</a> -->
                          </td>      
                          <td style="max-width:50px;"><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/course/edit_coursesession_view/<?php echo $batchlist->batchId;?>">Edit</a></td>
                          <td style="max-width:50px;"><a class="btn red btn-sm btn-outline sbold uppercase" onclick="return confirm('Are you you want to  delete?');" href="<?php echo base_url()?>supercontrol/course/delete_coursesession/<?php echo $batchlist->syllabus_id; ?>">Delete</a></td>
                        </tr>
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
					 //alert ("<?php echo base_url() ?>supercontrol/controllers/press/delete_multiple");
                    $.ajax({
                        url: '<?php echo base_url() ?>supercontrol/press/delete_multiple',
                        type: 'post',
                        data: 'ids=' + checkValues
                    }).done(function(data) {
                        $("#respose").html(data);
						//location.reload();
						var newurl= '<?php echo base_url() ?>supercontrol/press/show_press';
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
		url:"<?php echo base_url(); ?>supercontrol/press/statuspress",
		data:{stat : stat, id :id}
		});
		}
</script>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Course Session Time Table</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                    <div id="mydiv">
                      <thead>
                        <tr>
                          <!--<th width="20"><input id="selectall" type="checkbox"></th>-->
                          <!--<th width="180" style="max-width:170px;">Image</th>-->
                          <th>Session   </th>
                          <th>Session Start date   </th>
                          <th>Session Start Time   </th>
                          <th>Session  End Time  </th>
                          <th>Session Time Type  </th>
                          <th>Session  Objective </th>
                          <th>Session Location  </th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php if(is_array($batchSession )): ?>
        					  <?php
        					  $ctn=1;
                              foreach($batchSession  as $i){
                              ?> 
                          
                     
                        <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                         
                          
                                   <!--<td>
                                         <input name="checkbox[]" class="checkbox1" type="checkbox"  value="<?php echo $i->id;?>">
                                   </td>-->
                                   <td><?php echo $ctn;?></td>
                                   <td  style="max-width:200px;"><?php echo $i->date;?></td>
                                   <td  style="max-width:200px;"><?php echo $i->starttime;?></td>
                                   <td  style="max-width:200px;"><?php echo $i->endtime;?></td>
                                   <td  style="max-width:200px;"><?php echo $i->time_type;?></td>
                                   <td  style="max-width:200px;"><?php echo $i->session_objective;?></td>
                                   <td  style="max-width:200px;"><?php 
								$this->load->model('generalmodel'); 
								$table_name = 'sm_location';
								$primary_key = 'id';
								$wheredata = $i->session_location;
								$queryalllevels = $this->generalmodel->getAllData($table_name,$primary_key,$wheredata,'','');
								echo $queryalllevels[0]->location_name;
							?></td>
                                   
                              
                         </tr>
                        <?php $ctn++;}?>
                                <?php endif; ?>
                         
                      </tbody>
                      </div>
                    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>
