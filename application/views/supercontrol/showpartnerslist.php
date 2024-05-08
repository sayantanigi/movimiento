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
          <li> <a href="<?php echo base_url();?>supercontrol/home">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>supercontrol Panel</span> <i class="fa fa-circle"></i> </li>
          <li> <span>Show partnerss </span> </li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php if (isset($success_msg)) { echo $success_msg; } ?>
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Show Partners</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a>  <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                      <thead>
                        <tr>
                          <th width="241" style="max-width:170px;">Image</th>
                          <th width="50">Status</th>
                          <th width="35">Edit</th>
                          <th width="35">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(is_array($ecms)): ?>
                        <?php
                                            foreach($ecms as $i){
                                            ?>
                        <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                          <td width="200"><?php if($i->partners_img==""){?>
                            No Image
                            <?php }else{?>
                            <img src="<?php echo base_url()?>uploads/partners/<?php echo $i->partners_img;?>" width="180" height="120" style="border: 5px solid #dddddd;"/>
                            <?php }?></td>
                          <td  style="max-width:250px;"><div class="form-group">
                              <div class="col-md-5">
                                <select name="status" id="stachange" onchange="f1(this.value,<?php echo $i->id ;?>)" style="padding:4px;">
                                  <option value="1" <?php if($i->status==1){?> selected="selected"<?php }?>>Active</option>
                                  <option value="0" <?php if($i->status==0){?> selected="selected"<?php }?>>Inactive</option>
                                </select>
                                <input type="hidden" name="id" value="<?php echo $i->id;?>">
                              </div>
                            </div></td>
                          <td style="max-width:50px;"><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/partners/show_partners_id/<?php echo $i->id; ?>">Edit</a></td>
                          <td style="max-width:50px;"><a class="btn red btn-sm btn-outline sbold uppercase" onclick="return confirm('Are you sure about this delete?');" href="<?php echo base_url()?>supercontrol/partners/delete_partners/<?php echo $i->id; ?>">Delete</a></td>
                        </tr>
                        <?php }?>
                        <?php endif; ?>
                      </tbody>
                    </table>
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
<script>
function f1(stat,id)
	{
		$.ajax({
				type:"get",
				url:"<?php echo base_url(); ?>supercontrol/partners/statuspartners",
				data:{stat : stat, id :id}
				});
	}
</script>
