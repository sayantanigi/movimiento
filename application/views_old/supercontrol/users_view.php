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
      <?php foreach($viewusers as $vwusr) {?>
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
             <div class="tab-content">
              <div class="tab-pane active" id="tab_1_1">
                <div class="row">
                  <div class="col-md-3">
                    <ul class="list-unstyled profile-nav">
                      <li> 
                      <?php if($vwusr->image == "") {?>
                      <img src="<?php echo base_url(); ?>images/nopic.png" class="img-responsive pic-bordered" alt="">
                      <?php }else {?>
                      <img src="<?php echo base_url(); ?>uploads/propic/<?php echo $vwusr->image;?>" class="img-responsive pic-bordered" alt="">
                      <?php }?>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-9">
                    <div class="row">
                      <div class="col-md-8 profile-info">
                        <h1 class="font-green sbold uppercase"><?php echo $vwusr->first_name ." ".$vwusr->last_name;?></h1>
                        <p> 
                        <?php if($vwusr->default_message!=""){ echo $vwusr->default_message;}?>
                        </p>
                        <ul class="list-inline" style="line-height:30px;">
                          <li> <i class="fa fa-map-marker"></i> <?php echo $vwusr->time_zone;?> </li>
                          <li> <i class="fa fa-envelope"></i> <?php echo $vwusr->email;?> </li>
                          <li> <i class="fa fa-unlock-alt"></i> <?php echo base64_decode($vwusr->password);?> </li>
                          <li> <i class="fa fa-mobile"></i> <?php echo $vwusr->phone;?> </li>
                          <li> <i class="fa fa-globe"></i> <?php echo $vwusr->nicename;?> </li>
                          <?php if($vwusr->home_phone!="") {?>
                          <li> <i class="fa fa-phone"></i> <?php echo $vwusr->home_phone;?> </li>
                          <?php }?>
                          <li> <i class="fa fa-calendar"></i> <?=date('j F Y', strtotime($vwusr->reg_date))?> </li>
                        </ul>
                      </div>
                      <!--end col-md-8-->
                      <div class="col-md-4">
                        <div class="portlet sale-summary">
                          <div class="portlet-title">
                            <div class="caption font-red sbold"> IP Address & Stats </div>
                            <div class="tools"> <a class="reload" href="javascript:;" data-original-title="" title=""> </a> </div>
                          </div>
                          <div class="portlet-body">
                            <ul class="list-unstyled" style="line-height:20px;">
                              <li> <span class="sale-info">IP Address: &nbsp; <?php echo $vwusr->ip_address;?>  </li>
                              <li> 
                              <span class="sale-info"> User Status: &nbsp;
							  <?php if($vwusr->user_status==1){?> <b style="color:#0F0;">Active</b><?php }?> 
                              <?php if($vwusr->user_status==0){?> <b style="color:#F00;">Inactive</b><?php }?>
                              </li>
                              <li> 
                              <span class="sale-info"> GST Status: &nbsp;
							  <?php if($vwusr->gst_status==1){?> <b style="color:#0F0;">YES</b><?php }?> 
                              <?php if($vwusr->gst_status==0){?> <b style="color:#F00;">N/A</b><?php }?>
                              </li>
                              <li> 
                              <span class="sale-info"> On Boarding Manual: &nbsp;
							  <?php if($vwusr->on_boarding_manual_status==1){?> <b style="color:#0F0;">Checked</b><?php }?> 
                              <?php if($vwusr->on_boarding_manual_status==0){?> <b style="color:#F00;">N/A</b><?php }?>
                              </li>
                              <li> 
                              <span class="sale-info"> Contractor Agreement: &nbsp;
							  <?php if($vwusr->contractor_agreement_status==1){?> <b style="color:#0F0;">Checked</b><?php }?> 
                              <?php if($vwusr->contractor_agreement_status==0){?> <b style="color:#F00;">N/A</b><?php }?>
                              </li>
                              <li> 
                              <span class="sale-info"> E-mail Verification Status: &nbsp;
							  <?php if($vwusr->emailverification==1){?> <b style="color:#0F0;">YES</b><?php }?> 
                              <?php if($vwusr->emailverification==0){?> <b style="color:#F00;">NO</b><?php }?>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <!--end col-md-4-->
                    </div>
                    <!--end row-->
                    <div class="tabbable-line tabbable-custom-profile">
                      <ul class="nav nav-tabs">
                        <li class="active"> <a href="#tab_1_11" data-toggle="tab" aria-expanded="true"> Normal User Information </a> </li>
                        <li class=""> <a href="#tab_1_22" data-toggle="tab" aria-expanded="true"> Exco User Information </a> </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab_1_11">
                          <div class="portlet-body" <?php if($vwusr->user_type_main == 1) {?> style="display:block;" <?php }else {?> style="display:none;" <?php }?>>
                            <table class="table table-striped table-bordered table-advance table-hover">
                              <thead>
                                <tr>
                                  <th> <i class="fa fa-user"></i> User Type </th>
                                  <th class="hidden-xs"> <i class="fa fa-phone"></i> Phone Preference </th>
                                  <th> <i class="fa fa-briefcase"></i> Business Name </th>
                                  <th> <i class="fa fa-envelope"></i> Billing Email </th>
                                  <th> <i class="fa fa-commenting-o"></i> Default Message </th>
                                  <th> <i class="fa fa-id-card"></i> ID Proof </th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td> <?php echo $vwusr->user_type_sub;?> </td>
                                  <td> <?php echo $vwusr->phone_pref;?> </td>
                                  <td> <span class="label label-warning label-sm"> <?php echo $vwusr->business_name;?> </span> </td>
                                  <td> <?php echo $vwusr->billing_email;?> </td>
                                  <td> <?php echo $vwusr->default_message;?> </td>
                                  <td> <a href="<?php echo base_url();?>uploads/idproof/<?php echo $vwusr->id_proof; ?>" style="text-decoration:none;" download><?php echo $vwusr->id_proof; ?></a> </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!--tab-pane-->
                        <div class="tab-pane" id="tab_1_22">
                          <div class="tab-pane active" id="tab_1_1_1">
                            <div class="portlet-body" <?php if($vwusr->user_type_main == 2) {?> style="display:block;" <?php }else {?> style="display:none;" <?php }?>>
                            <table class="table table-striped table-bordered table-advance table-hover">
                              <thead>
                                <tr>
                                  <th> <i class="fa fa-home"></i> Home Address </th>
                                  <th> <i class="fa fa-sort-numeric-asc"></i> ABN or ACN </th>
                                  <th> <i class="fa fa-motorcycle"></i> Vehicle </th>
                                  <th> <i class="fa fa-circle"></i> Contact Preference </th>
                                  <th> <i class="fa fa-android"></i>/<i class="fa fa-apple"></i> Device </th>
                                  <th> <i class="fa fa-id-card"></i> ID Proof </th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td> <?php echo $vwusr->address;?> </td>
                                  <td> <?php echo $vwusr->abn_acn_num;?> </td>
                                  <td> <span class="label label-warning label-sm"> <?php echo $vwusr->vehicle;?> </span> </td>
                                  <td> <?php echo $vwusr->contact_preference;?> </td>
                                  <td> <?php echo $vwusr->device;?> </td>
                                  <td> <a href="<?php echo base_url();?>uploads/idproof/<?php echo $vwusr->id_proof; ?>" style="text-decoration:none;" download><?php echo $vwusr->id_proof; ?></a> </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          </div>
                        </div>
                        <!--tab-pane-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php }?>  
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
