<!--<h2>Welcome <?php //echo $UserName; ?>!</h2>-->

<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <?php $this->load->view('supercontrol/leftbar'); ?>
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
     <style type="text/css">
	 			.tile {
			padding-top:0px;
		  height: 117px;
		  width: 184px !important;
		  position: relative;
		  overflow: hidden;
		  cursor:pointer;
		  border: 5px solid #ccc;
		}
		
		
		.tile .tile-body {
		  height: 100%;
		  overflow: hidden;
		  position: relative;
		}
		.tile:active, .tile.selected {
		  border-color: #ccc;
		}
		
		
		.tile.image > .tile-body > img{
		  width: 100%;
		  height: auto;
		  min-height: 100%;
		  max-width: 100%;
		}
	 </style>
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
            
            <div class="table-toolbar" style="margin-bottom:10px;">
            <div class="btn-group">
            <a class="btn green" href="<?php echo base_url()?>supercontrol/banner" data-toggle="modal">
            Add New
            <i class="fa fa-plus"></i>
            </a>
            </div>
            
            </div>
              <!-- BEGIN FORM-->
              <div class="table-toolbar"> </div>
              <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                <thead>
                  <tr>
                    <th width="18%"> Image </th>
                    <th width="10%"> Heading </th>
                    <th width="9%"> Sub Heading </th>
                    <th width="8%"> Description </th>
                    <th width="10%"> Status </th>
                    <th width="8%"> Edit </th>
                    <th width="12%"> Delete </th>
                  </tr>
                </thead>
               
                <tbody>
				<?php
                foreach($ecms as $i){
                ?>
                  <tr class="odd gradeX">
                    <td><?php $pic = base_url().'banner/'.$i->banner_image; ?>
                    	  <div class="tile image double selected">
					        <div class="tile-body">
                            <img src="<?=$pic?>" alt="Wait..." width="100px" title="<?=$i->title?>">
                            </div>	
                         </div>	
                    </td>
                    <td><?php echo $i->title;?></td>
                    <td><?php echo $i->subtitle;?></td>
                    <td><?php echo substr(stripslashes($i->description),0,75);?></td>
                    <td><?php if($i->status ==1){?>
                      <span style="color:#063;"><?php echo "Active";?></span>
                      <?php }else{?>
                      <span style="color:#900;"><?php echo "Inactive";?></span>
                      <?php }?></td>
                    <td><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/banner/show_banner_id/<?php echo $i->id?>"><i class="fa fa-edit"></i> Edit</a></td>
                    <td><a class="btn red btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/banner/delete_banner/<?php echo $i->id?>" onclick="return confirm('Are you sure you want to delete ?');"><i class="fa fa-trash"></i> Delete</a></td>
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
