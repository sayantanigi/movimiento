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
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>supercontrol Panel</span> <i class="fa fa-circle"></i> </li>
          <li> <span>Show users List </span> </li>
        </ul>
      </div>
      <?php if(@$message){echo @$message;}?>
      <div class="row">
      <?php if($this->session->flashdata('success')!=''){?>
			<div class="alert alert-success text-center"><?php echo @$this->session->flashdata('success');?></div>
	  <?php }?>
       <?php if($this->session->flashdata('edit_success')!=''){?>
			<div class="alert alert-success text-center"><?php echo @$this->session->flashdata('edit_success');?></div>
	  <?php }?>
      <?php if($this->session->flashdata('delete_message')!=''){?>
			<div class="alert alert-success text-center"><?php echo @$this->session->flashdata('delete_message');?></div>
	  <?php }?>
      <?php if($this->session->flashdata('delete_message1')!=''){?>
			<div class="alert alert-success text-center"><?php echo @$this->session->flashdata('delete_message1');?></div>
	  <?php }?>
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Show users</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a>  <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  
                  <div class="portlet-body form">
                  
                  
                    <!-- BEGIN FORM-->
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                    <div id="mydiv">
                      <thead>
                        <tr>
                          <th width="20"><input id="selectall" type="checkbox"></th>
                          <th width="180" style="max-width:170px;">Image</th>
                          <th width="30">Users Name</th>
                          <th width="30">User Type</th>
                          <th width="60">Email</th>
                          <th width="60">Status</th>
                          <th width="40">Add/Edit ID</th>
                          <th width="60">View</th>
                          <th width="27">Edit</th>
                          <th width="27">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if(is_array($euser)): ?>
					  <?php
					  $ctn=1;
                      foreach($euser as $i){
                      ?>
                        <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                          <td>
                          <input name="checkbox[]" class="checkbox1" type="checkbox"  value="<?php echo $i->uid;?>">
                          </td>
                          <td><?php if($i->image==""){?>
                            <img src="<?php echo base_url()?>images/nopic.png" width="150" height="100" style="border: 2px solid #ddd;"/>
                            <?php }else{?>
                            <img src="<?php echo base_url()?>uploads/propic/<?php echo $i->image;?>" width="150" height="100" style="border: 2px solid #ddd;"/>
                            <?php }?></td>
                          <td  style="max-width:200px;"><?php echo $i->first_name." ".$i->last_name;?></td>
                          <td  style="max-width:200px;">
						  <?php if($i->user_type_main==1){?><a class="btn sbold yellow" style="pointer-events:none;">Normal User</a><?php }?>
                          <?php if($i->user_type_main==2){?><a class="btn sbold red" style="pointer-events:none;">Exco User</a><?php }?>
                          </td>
                          <td  style="max-width:200px;"><?php echo $i->email;?></td>
                          <td  style="max-width:250px;"><div class="form-group">
                              <div class="col-md-5">
                                <select name="blog_status" id="stachange" onchange="f1(this.value,<?php echo $i->uid ;?>)" style="padding:4px;">
                                  <option value="1" <?php if($i->user_status==1){?> selected="selected"<?php }?>>Active</option>
                                  <option value="0" <?php if($i->user_status==0){?> selected="selected"<?php }?>>Inactive</option>
                                </select>
                                <input type="hidden" name="id" value="<?php echo $i->uid;?>">
                              </div>
                            </div></td>
                            <td style="max-width:90px;">
                            <?php if($i->id_proof=="") {?>
                            <a class="btn blue btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/users/add_idproof_id/<?php echo $i->uid; ?>">ID proof</a>
                            <?php }?>
                            <?php if($i->id_proof!="") {?>
                            <a class="btn blue btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/users/edit_idproof_id/<?php echo $i->uid; ?>">Edit</a>
                            <?php }?>
                            </td>
                            <td><a class="btn sbold yellow" href="<?php echo base_url()?>supercontrol/users/users_view/<?php echo $i->uid?>"><i class="fa fa-eye"></i> View </a></td>
                          <td style="max-width:60px;"><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/users/show_users_id/<?php echo $i->uid; ?>">Edit</a></td>
                          <td style="max-width:70px;"><a class="btn red btn-sm btn-outline sbold uppercase" onclick="return confirm('Are you sure about this delete?');" href="<?php echo base_url()?>supercontrol/users/delete_users/<?php echo $i->uid; ?>">Delete</a></td>
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
					 //alert ("<?php echo base_url() ?>supercontrol/controllers/users/delete_multiple");
                    $.ajax({
						  
                        url: '<?php echo base_url() ?>supercontrol/users/delete_multiple',
                        type: 'post',
                        data: 'ids=' + checkValues
                    }).done(function(data) {
                        $("#respose").html(data);
						//location.reload();
						var newurl= '<?php echo base_url() ?>supercontrol/users/show_users';
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
		url:"<?php echo base_url(); ?>supercontrol/users/statususers",
		data:{stat : stat, id :id}
		});
		}
</script>

<!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>
