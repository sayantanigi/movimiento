<?php //$this->load->view ('header');?>
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
<!-- BEGIN CONTAINER -->
<div class="page-container">
 <!-- BEGIN SIDEBAR -->
 <div class="page-sidebar-wrapper">
  <!-- BEGIN SIDEBAR -->
  <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
  <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
  <div class="page-sidebar navbar-collapse collapse">

   <?php $this->load->view ('supercontrol/leftbar');?>

  </div>
  <!-- END SIDEBAR -->
 </div>
 <!-- END SIDEBAR -->
 <!-- BEGIN CONTENT -->
 <div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
   <!-- BEGIN PAGE HEADER-->
   <!-- BEGIN THEME PANEL -->

   <!-- END THEME PANEL -->
   <!-- BEGIN PAGE BAR -->
   <div class="page-bar">
    <ul class="page-breadcrumb">
     <li>
      <a href="<?php echo base_url(); ?>supercontrol/home">Home</a>
      <i class="fa fa-circle"></i>
     </li>
     <li>
      <span>supercontrol Panel</span>
      <i class="fa fa-circle"></i>
     </li>

     <li>
      <span>Show CMS </span>
     </li>
    </ul>

   </div>
   <!-- END PAGE BAR -->

   <?php if (isset($success_msg)) { echo $success_msg; } ?>
   <div class="row">
    <div class="col-md-12">
     <div class="tabbable-line boxless tabbable-reversed">
      <div class="tab-content">
       <div class="tab-pane active" id="tab_0">
        <div class="portlet box blue-hoki">
         <div class="portlet-title">
          <div class="caption">
           <i class="fa fa-gift"></i>Show CMS Crop/Student</div>
           <div class="tools">

            <a href="javascript:;" class="reload"> </a>
            <a href="javascript:;" class="remove"> </a>
           </div>
          </div>
          <div class="portlet-body form" style="padding:5px;">
           <!-- BEGIN FORM-->
           <br/>
           <div class="pull-right btn green"> <a href="<?php echo base_url()?>supercontrol/cms/addcrop">Add New</a></div>
           <div class="clearfix"></div>
           <br/>
           <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
            <thead>
             <tr>
              <th width="10" style="max-width:200px;">Sl No.</th>
              <th class="hidden-480">For</th>
              <th class="hidden-480">Icon</th>
              <th class="hidden-480">Heading</th>
              <th class="hidden-480">Brief Description</th>
              <th class="hidden-480">Edit</th>
              <th class="hidden-480">Delete</th>
             </tr>
            </thead>
            <tbody>
             <?php
             $c=1;
             if( !empty($ecmsq) ) {
             foreach($ecmsq as $i){
              ?>
              <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
               <!--<td><?php if($i->cms_img==""){?>No Image<?php }else{?><img src="<?php echo base_url()?>/uploads/<?php echo $i->cms_img;?>" width="130" height="100" /><?php }?></td>-->
               <td class="hidden-480" style="max-width:200px;"><?php echo $c;?></td>
               <td  class="hidden-480"><?php echo $i->for_type;?></td>
               <td  class="hidden-480"><?php echo $i->icon;?></td>
               <td  class="hidden-480"><?php echo $i->heading;?></td>
               <td class="hidden-480"><?php echo substr(stripslashes(strip_tags($i->description)),0,120);?>.....</td>
               <td class="hidden-480"><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/cms/show_crop_id/<?php echo $i->id; ?>">Edit</a></td>
               <td class="hidden-480"><a class="btn red btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/cms/delete_crop/<?php echo $i->id; ?>">Delete</a></td>
              </tr>
              <?php $c++; } } else { ?>
              <tr><td colspan="7"> No List.</td></tr>
              <?php }?>
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
  <!-- END CONTAINER -->
  <?php //$this->load->view ('footer');?>
