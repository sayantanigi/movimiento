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
</style>
<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
      <!-- BEGIN SIDEBAR MENU -->
      <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
      <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
      <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
      <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
      <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
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
      <!-- BEGIN THEME PANEL -->
      <!-- END THEME PANEL -->
      <!-- BEGIN PAGE BAR -->
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>supercontrol Panel</span> <i class="fa fa-circle"></i> </li>
          <li> <span>Show Location List </span> </li>
        </ul>
      </div>
      <!-- END PAGE BAR -->
      <!-- BEGIN PAGE TITLE-->
      <!-- END PAGE TITLE-->
      <!-- END PAGE HEADER-->
      <?php if(@$message){echo @$message;}?>
      <div class="row">
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
        <div class="alert alert-error" style="background-color:#F0959B;">
        <button type="button" class="close" data-dismiss="alert">&#10006;</button>
        <strong style="color:#900;"><?php echo @$this->session->flashdata('delete_message');?></strong> 
        </div>
        <?php }?>
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Show Start Date</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  
                  <div class="portlet-body form">
                  
                  
                    <!-- BEGIN FORM-->
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                    <div id="mydiv">
                      <thead>
                        <tr>
                          <th width="20"><input id="selectall" type="checkbox"></th>
                          <th width="30">End Date</th>
                          <th width="30">Hour</th>
                          <th width="30">Per Hour Price</th>
                          <th width="27">Edit</th>
                          <th width="27">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if(is_array($ecms)): ?>
					  <?php
					  $last = $this->uri->total_segments();
					  $record_num = $this->uri->segment($last);
					  $ctn=1;
                      foreach($ecms as $i){
                      ?>
                        <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                          <td>
                          <input name="checkbox[]" class="checkbox1" type="checkbox"  value="<?php echo $i->end_date_id;?>">
                          </td>
                          <td  style="max-width:200px;"><?php echo date('d-m-Y', strtotime($i->end_date));?></td>
                          <td  style="max-width:200px;"><?php echo $i->hour;?></td>
                          <td  style="max-width:200px;"> &pound; <?php echo $i->per_hour_price;?></td>
                          <!--<td  style="max-width:200px;"><?php echo date('d-m-Y', strtotime($i->end_date));?></td>-->
                          <td style="max-width:50px;"><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/location/show_end_date_id/<?php echo $i->end_date_id; ?>/<?=$record_num?>">Edit</a></td>
                          <td style="max-width:50px;"><a class="btn red btn-sm btn-outline sbold uppercase" onclick="return confirm('Are you sure about this delete?');" href="<?php echo base_url()?>supercontrol/location/delete_end_date/<?php echo $i->end_date_id; ?>">Delete</a></td>
                        </tr>
                        <?php $ctn++;}?>
                        <?php endif; ?>
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
					 //alert ("<?php echo base_url() ?>supercontrol/controllers/location/delete_multiple");
                    $.ajax({
						  
                        url: '<?php echo base_url() ?>supercontrol/location/delete_multiple',
                        type: 'post',
                        data: 'ids=' + checkValues
                    }).done(function(data) {
                        $("#respose").html(data);
						//location.reload();
						var newurl= '<?php echo base_url() ?>supercontrol/location/show_location';
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
		url:"<?php echo base_url(); ?>supercontrol/location/statuslocation",
		data:{stat : stat, id :id}
		});
		}
</script>

<!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>
