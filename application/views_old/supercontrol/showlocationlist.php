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
   
    <div class="page-sidebar navbar-collapse collapse">
      
      <?php $this->load->view ('supercontrol/leftbar');?>
     
    </div>
    
  </div>
  
  <style>
 	.dataTables_info{padding:7px;}
  </style>
  <div class="page-content-wrapper">
   
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
                    <div class="caption"> <i class="fa fa-gift"></i>Show Location</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a>  <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                  
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                    <div id="mydiv">
                      <thead>
                        <tr>
                          <th width="20"><input id="selectall" type="checkbox"></th>
                          <th width="30">Location Name</th>
                          <th width="30">Country</th>
                          <th width="30">City</th>
                          <th width="30">Address</th>
                          <th width="30">Telephone</th>
                          <th width="30">Currncy</th>
                          <th width="30">Direction</th>
                          <th width="30">Opening Hours</th>
                          <th width="27">Edit</th>
                          <th width="27">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if(is_array($ecms)): ?>
					  <?php
					  $ctn=1;
					  foreach($ecms as $i){
                      ?>
                        <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                          <td>
                          <input name="checkbox[]" class="checkbox1" type="checkbox"  value="<?php echo $i->id;?>">
                          </td>
                          
                          <td  style="max-width:200px;"><?php echo $i->location_name;?></td>
                          <td  style="max-width:200px;"><?php 
                                $this->load->model('generalmodel'); 
                                $table_name = 'sm_countrys';
                                $primary_key = 'id';
                                $wheredata = $i->location_country_id;
                                $queryalllevels = $this->generalmodel->getAllData($table_name,$primary_key,$wheredata,'','');
                                echo $queryalllevels[0]->country_name;
                            ?></td>
                          <td  style="max-width:200px;">
                              <?php 
                                $this->load->model('generalmodel'); 
                                $table_name = 'sm_city';
                                $primary_key = 'id';
                                $wheredata = $i->location_city_id;
                                $queryalcity = $this->generalmodel->getAllData($table_name,$primary_key,$wheredata,'','');
                                echo $queryalcity[0]->city_name;
                            ?></td>
                          <td  style="max-width:200px;"><?php echo $i->location_address;?></td>
                          <td  style="max-width:200px;"><?php echo $i->location_telephone_number;?></td>
                          <td  style="max-width:200px;"><?php echo $i->location_currency;?></td>
                          <td  style="max-width:200px;"><?php echo $i->location_direction;?></td>
                          <td  style="max-width:200px;"><?php echo $i->location_opening_hours;?></td>
                          
                          <td style="max-width:50px;"><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/location/show_location_id/<?php echo $i->id; ?>">Edit</a></td>
                          <td style="max-width:50px;"><a class="btn red btn-sm btn-outline sbold uppercase" onclick="return confirm('Are you sure about this delete?');" href="<?php echo base_url()?>supercontrol/location/delete_location/<?php echo $i->id; ?>">Delete</a></td>
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

