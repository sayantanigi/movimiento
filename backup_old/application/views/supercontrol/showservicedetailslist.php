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
  <div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
      <?php $this->load->view ('supercontrol/leftbar');?>
    </div>
  </div>
  <div class="page-content-wrapper">
    <div class="page-content">
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?php echo base_url(); ?>supercontrol/user/dashboard">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>Admin Panel</span> <i class="fa fa-circle"></i> </li>
          <li> <span>Show Service </span> </li>
        </ul>
      </div>
      <?php if (isset($success_msg)) { echo $success_msg; } ?>
      <?php if (isset($success_msg1)) { echo $success_msg1; } ?>
      <?php if (isset($message)) { echo $message; } ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Show Service</div>
                  </div>
                  <div class="portlet-body form">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                      <thead>
                        <tr>
                          <th width="20" style="max-width:190px;">Service</th>
                          <th width="45" style="max-width:190px;">Service Title</th>
                          <th width="30">Status</th>
                          <th width="35">Edit</th>
                          <th width="35">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(is_array(@$eserv)): ?>
                        <?php
				
                	foreach($eserv as $i){
                ?>
                        <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                          <td width="60" style="max-width:190px;"><?php echo $i->category_name;?></td>
                          <td  style="max-width:200px;"><?php echo $i->service_name;?></td>
                          <td  style="max-width:250px;"><div class="form-group">
                              <div class="col-md-5">
                                <select name="property_status" id="stachange" onchange="f1(this.value,<?php echo $i->serv_id ;?>)" style="padding:5px;">
                                  <option value="1" <?php if($i->status==1){?> selected="selected"<?php }?>>Active</option>
                                  <option value="0" <?php if($i->status==0){?> selected="selected"<?php }?>>Inactive</option>
                                </select>
                                <input type="hidden" name="id" value="<?php echo $i->serv_id;?>">
                              </div>
                            </div></td>
                          <td width="40"><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/servicedetails/show_id/<?php echo $i->serv_id; ?>">Edit</a></td>
                          <td width="60"><a onclick="return confirm('Are you sure you want to delete ?');" class="btn red btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/servicedetails/delete_servicedetails/<?php echo $i->serv_id; ?>">Delete</a></td>
                        </tr>
                        <?php  }?>
                        <?php endif; ?>
                      </tbody>
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
	function f1(stat,id)
		{
			$.ajax({
				type:"get",
				url:"<?php echo base_url(); ?>supercontrol/servicedetails/statusservicedetails",
				data:{stat : stat, id :id}
			});
		}
</script>