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
                    <div class="caption"> <i class="fa fa-gift"></i>Consignment edit</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <?php foreach($viewconsignment as $i){?>
                    <form method="post" class="form-horizontal form-bordered" action="" enctype="multipart/form-data">
                      <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-3">Pickup Address</label>
                          <div class="col-md-5">
                            <?php echo $i->pickup_address;?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Pickup Location</label>
                          <div class="col-md-5">
                           <?php echo $i->pickup_location;?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Delivery Address</label>
                          <div class="col-md-5">
                            <?php echo $i->delivery_address;?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Delivery Location</label>
                          <div class="col-md-5">
                           <?php echo $i->delivery_location;?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Vehicle</label>
                          <div class="col-md-5">
                            <?php echo $i->vehicle;?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Delivery Option</label>
                          <div class="col-md-5">
                            <?php echo $i->delivery_option;?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Item Ready Time</label>
                          <div class="col-md-5">
                            <?php echo $i->item_ready_time;?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Item Description</label>
                          <div class="col-md-7">
                            <?php echo $i->item_name_description;?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Pickup User Name</label>
                          <div class="col-md-5">
                            <?php echo $i->pickup_usr_name;?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Pickup Country</label>
                          <div class="col-md-5">
                            <?php foreach($cou as $c){?>
                            <?php echo $c->name;?>
                            <?php } ?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Pickup Phone</label>
                          <div class="col-md-5">
                            <?php echo $i->pickup_phone;?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Pickup Instruction</label>
                          <div class="col-md-5">
                            <?php echo $i->pickup_instruction;?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Delivery User Name</label>
                          <div class="col-md-5">
                            <?php echo $i->delivery_usr_name;?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Delivery Country</label>
                          <div class="col-md-5">
                          
                            <?php foreach($cout as $c){?>
                            <?php echo $c->name;?>
                            <?php } ?>
                          
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Delivery Phone</label>
                          <div class="col-md-5">
                            <?php echo $i->delivery_phone;?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Delivery Instruction</label>
                          <div class="col-md-5">
                            <?php echo $i->delivery_instruction;?>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Delivery Amount</label>
                          <div class="col-md-5">
                            <?php echo $i->delivery_amount;?>
                          </div>
                        </div>
                        
                        
                        </div>
                      </div>
                      <div class="form-actions">
                        
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
