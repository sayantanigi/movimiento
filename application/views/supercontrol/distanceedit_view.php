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
                    <div class="caption"> <i class="fa fa-gift"></i>Edit Distance</div>
                    <div class="tools"> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form"> 
                    <!-- BEGIN FORM-->
                    <form action="<?php echo base_url()?>supercontrol/distance/edit_distance" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?php echo $slist->diatance_id; ?>">
                      <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-3">Package Name</label>
                          <div class="col-md-8"> 
                            <input type="text" name="package_name" value="<?php echo $slist->package_name; ?>" class="form-control" />
                           <?php echo form_error('package_name'); ?> </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Print Material</label>
                          <div class="col-md-8"> 
                          	<input type="radio" name="print_material" value="Yes" <?php if($slist->print_material=="Yes") { ?> checked="checked" <?php }?> /> Yes
                            <input type="radio" name="print_material" value="No" <?php if($slist->print_material=="No") { ?> checked="checked" <?php }?> /> No
						
                           </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Online Access</label>
                          <div class="col-md-8"><input type="text" name="online_access" value="<?php echo $slist->online_access; ?>" class="form-control" onkeypress="return IsNumeric(event);" placeholder="Enter Between 0 to 12 (0,1,2 ...12)" />
                          <?php //echo form_error('online_access'); ?>
                          	<span id="error" style="color: Red; display: none">* Input digits (0 - 9)</span>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Tutor Support</label>
                          <div class="col-md-8"> 
                          	<input type="radio" name="tutor_support" value="Limited" <?php if($slist->tutor_support=="Limited") { ?> checked="checked" <?php }?> /> Limited
                            <input type="radio" name="tutor_support" value="Full"  <?php if($slist->tutor_support=="Full") { ?> checked="checked" <?php }?> /> Full
                            <?php //echo form_error('tutor_support'); ?>
                           </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Certificate </label>
                          <div class="col-md-8"> 
                          	<input type="radio" name="cirtificates" value="Yes" <?php if($slist->cirtificates=="Yes") { ?> checked="checked" <?php }?> /> Yes
                            <input type="radio" name="cirtificates" value="No" <?php if($slist->cirtificates=="No") { ?> checked="checked" <?php }?> /> No
                            <?php //echo form_error('cirtificates'); ?>
                           </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Price</label>
                          <div class="col-md-8"> 
                          	<input type="text" name="price" value="<?php echo $slist->price; ?>" class="form-control" />
                            <?php echo form_error('price'); ?>
                           </div>
                        </div>
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9"> 
                            <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>--> 
                            
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
