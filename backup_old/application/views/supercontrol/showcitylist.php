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
.dataTables_length{
	padding:10px;
	}
.dataTables_filter{
	padding: 10px;
    float: right;
	}
.dataTables_info{
	padding:10px;
	}
.pagination-panel{
	padding: 10px;
    float: right;
	}	
</style>

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
      <?php $this->load->view ('supercontrol/leftbar');?>
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
          <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>supercontrol Panel</span> <i class="fa fa-circle"></i> </li>
          <li> <span>Show City List </span> </li>
        </ul>
      </div>
      <!-- END PAGE BAR -->
      <!-- BEGIN PAGE TITLE-->
      <!-- END PAGE TITLE-->
      <!-- END PAGE HEADER-->
      <?php if (isset($success_msg)) { echo $success_msg; } ?>
      <div class="row">
      <?php if($this->session->flashdata('delete_message')!=''){?>
			<div class="alert alert-success text-center"><?php echo @$this->session->flashdata('delete_message');?></div>
	  <?php }?>
      
      <?php if($this->session->flashdata('email_message')!=''){?>
			<div class="alert alert-success text-center"><?php echo @$this->session->flashdata('email_message');?></div>
	  <?php }?>
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Show City</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a>  <a href="javascript:;" class="reload"> </a> <a href="javascript:void(0);" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <table class="table table-striped table-bordered table-hover table-checkable " >

                        <tr>
                          <th>Sl No</th>
                          <th>Country Name</th>
                          <th>City Name</th>
                          <th>Action</th>
                        </tr>
                      
                        <tbody>
						<?php
                        $ctn = 1;
						if($eloca!=''){
                        	foreach($eloca as $i){
                        ?>
                        <tr class="table table-striped table-bordered table-hover table-checkable " id="<?=$i->id;?>">
                          <td style="max-width:10px;"><?php echo $ctn;?></td>
                          <td  style="max-width:200px;"><?php echo $i->country_name;?></td>
                          <td  style="max-width:200px;"><?php echo $i->city_name;?></td>
                          <td>
                              <a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/city/show_city_id/<?php echo $i->id;?>" >Edit</a>
                              <a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/city/delete_city/<?php echo $i->id;?>" onclick="return confirm('Are you sure you want to delete ?');">Delete</a></td>
                        </tr>
                        <?php $ctn++;}
						}
						?>
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

<script type="text/javascript">
  $.ajax({
    url: '<?php echo base_url();?>supercontrol/country/show_category_id/".$id."',
    type: 'POST',
    data: {orderarr: 'orderarr'},
  })
  .done(function(resp) {
    console.log("success");
  })
  .fail(function() {
    console.log("error while arranging country");
  })
  .always(function() {
    console.log("complete");
  });
  
</script>
