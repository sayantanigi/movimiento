<!--<h2>Welcome <?php //echo $UserName; ?>!</h2>-->

<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <?php $this->load->view('leftbar'); ?>
    <!-- END SIDEBAR -->
  </div>
  <!-- END SIDEBAR -->
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
      <!-- END THEME PANEL -->
      <!-- BEGIN PAGE TITLE-->
      <h3 class="page-title"> <?php echo @$title;?>
        <!--<small>classic page head option</small>-->
      </h3>
      <!-- END PAGE TITLE-->
      <!-- BEGIN PAGE BAR -->
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="dashboard.php">Home</a> <i class="fa fa-angle-right"></i> </li>
          <li> <span><?php echo @$title;?></span> </li>
        </ul>
      </div>
      <!-- END PAGE BAR -->
      <!-- END PAGE HEADER-->
     
      <div class="alert alert-success alert-dismissable" style="padding:10px;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
        <strong>
			<?php 
				$last = end($this->uri->segments); 
				if($last=="successupdate"){echo "Data Updated Successfully ......";}
				if($last=="successdelete"){echo "Data Deleted Successfully ......";}
            ?>
        </strong> 
      </div>
      <div class="row">
        <div class="col-md-12">
          <!-- BEGIN PORTLET-->
          <div class="portlet box blue-hoki">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-reorder"></i>
                <?php echo @$title;?>
              </div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <!-- BEGIN FORM-->
              <div class="table-toolbar"> </div>
              <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                <thead>
                  <tr>
                    <th width="18%">Title </th>
                    <th width="10%">Phone</th>
                    <th width="9%"> Email </th>
                    <th width="8%"> FB link </th>
                    <th width="8%"> Edit </th>
                  </tr>
                </thead>
                <tbody>
				<?php
                foreach($ecms as $i){
                ?>
                  <tr class="odd gradeX">
                    <td><?php echo $i->title; ?></td>
                    <td><?php echo $i->phonenumber;?></td>
                    <td><?php echo $i->email;?></td>
                    <td><?php echo $i->fb_link;?></td>
                    <td><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>index.php/settings/show_settings_id/<?php echo $i->id?>">Edit</a></td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>
              <!-- END FORM-->
            </div>
          </div>
          <!-- END PORTLET-->
        </div>
      </div>
    </div>
    <!-- END CONTENT BODY -->
  </div>
  <!-- END CONTENT -->
  <!-- BEGIN QUICK SIDEBAR -->
  <!-- END QUICK SIDEBAR -->
</div>
