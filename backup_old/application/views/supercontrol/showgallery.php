<?php //$this->load->view ('header');?>
<!-- BEGIN CONTAINER -->

<div class="page-container">
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper"> 
  <!-- BEGIN SIDEBAR --> 
  <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing --> 
  <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
  <div class="page-sidebar navbar-collapse collapse"> 
    <!-- BEGIN SIDEBAR MENU --> 
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) --> 
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode --> 
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode --> 
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing --> 
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded --> 
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <?php $this->load->view ('supercontrol/sidebar');?>
    <!-- END SIDEBAR MENU --> 
    <!-- END SIDEBAR MENU --> 
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
    <li> <a href="index.html">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <span>supercontrol Panel</span> <i class="fa fa-circle"></i> </li>
    <li> <span>Show Gallery List</span> </li>
  </ul>
  <div class="page-toolbar">
    <div class="btn-group pull-right">
      <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions <i class="fa fa-angle-down"></i> </button>
      <?php 
				$last = end($this->uri->segments); 
				if($last=="successupdate"){echo "Data Updated Successfully ......";}
				if($last=="successdelete"){echo "Data Deleted Successfully ......";}
				if($last=="success"){echo "Data Inserted Successfully ......";}
            ?>
      <ul class="dropdown-menu pull-right" role="menu">
        <li> <a href="#"> <i class="icon-bell"></i> Action</a> </li>
        <li> <a href="#"> <i class="icon-shield"></i> Another action</a> </li>
        <li> <a href="#"> <i class="icon-user"></i> Something else here</a> </li>
        <li class="divider"> </li>
        <li> <a href="#"> <i class="icon-bag"></i> Separated link</a> </li>
      </ul>
    </div>
  </div>
</div>
<!-- END PAGE BAR --> 
<!-- BEGIN PAGE TITLE--> 
<!-- END PAGE TITLE--> 
<!-- END PAGE HEADER-->
<div class="row" id="editing">
  <div class="col-md-12">
    <div class="tabbable-line boxless tabbable-reversed">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_0">
          <div class="portlet box blue-hoki">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-home"></i>Show Gallery List</div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body form">
              <div class="table-toolbar">
                <div class="row">
                  <div class="col-md-6">
                    <div class="btn-group" style="padding:15px"> <a href="<?php echo base_url(); ?>index.php/gallery/gallery_main">
                      <button id="sample_editable_1_new" class="btn sbold green"> Add New <i class="fa fa-plus"></i> </button>
                      </a> </div>
                  </div>
                </div>
              </div>
              <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                <thead>
                  <tr>
                  <th width="5%">Sl No. </th>
                    <th width="15%">Image </th>
                    <th width="12%">Title </th>
                    <th width="15%">Type</th>
                    <th width="15%">Description </th>
                    <th width="10%"> Status </th>
                    <th width="7%">View </th>
                    <th width="5%">Edit</th>
                    <th width="7%">Delete </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
												$abc = 1;
                                                foreach($egallery as $i){
                                                ?>
                  <tr class="odd gradeX">
                  <td><?php echo $abc;?></td>
                    <td style="max-width:80px"><?php  if($i->image == ''){
														$pic = base_url()."gallery_img/noimage.jpg" ;
																
															}elseif(file_exists(base_url()."gallery_img/".$i->image)){
																$pic = base_url()."gallery_img/noimage.jpg" ;
															} else{
												
															$pic = base_url()."gallery_img/".$i->image ; } 
															 ?>
                      <img src="<?=$pic ?>"  alt="image" style="max-width:70px;max-height:90px" /></td>
                    <td><?php echo $i->title;?></td>
                    <td><?php echo $i->gallery_type;?></td>
                    <td><?php echo substr(stripslashes($i->description),0,48);?>...</td>
                    <td><?php $st = $i->gal_status;
														if($st=="1"){ echo "<b style='color:#5A9700'>Active</b>"; }else{
															echo "<b style='color:#DF6C33'>InActive</b>"; }
														?></td>
                    <td><a class="btn sbold yellow" href="<?php echo base_url()?>index.php/gallery/gallery_view/<?php echo $i->gal_id?>"><i class="fa fa-eye"></i> View </a></td>
                    
                    
                    <td><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>index.php/gallery/show_gallery_edit_id/<?php echo $i->gal_id?>"><i class="fa fa-edit"></i> Edit</a></td>
                    <td><a class="btn red btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>index.php/gallery/delete_gallery/<?php echo $i->gal_id?>" onclick="return confirm('Are you sure you want to delete ?');"><i class="fa fa-trash"></i> Delete</a></td>
                  </tr>
                  <?php $abc++ ; }?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- END EXAMPLE TABLE PORTLET--> 
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
