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
        if(@$success_msg!=''){echo @$success_msg;}
        $last = end($this->uri->segments); 
        if($last=="success"){echo "Offer Added Successfully ......";}
        if($last=="successdelete"){echo "Offer Deleted Successfully ......";}
            ?>
        </strong> </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Offers</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo base_url().'supercontrol/discount/add_discount' ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" >
                      <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-3">Discount Code</label>
                          <div class="col-md-8"> <?php echo form_input(array('id' => 'discount_code', 'name' => 'discount_code','class'=>'form-control')); ?> <?php echo form_error('discount_code'); ?> </div>
                        </div>
                        <div id="err1" style="color:#f00;text-align:center;"></div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Percentage</label>
                          <div class="col-md-8"> <?php echo form_input(array('id' => 'percentage', 'name' => 'percentage','class'=>'form-control')); ?> <?php echo form_error('percentage'); ?> </div>
                        </div>
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                            <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit' ,'class'=>'btn red')); ?>
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
