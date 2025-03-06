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
                            <li>
                                <a href="<?php echo base_url(); ?>supercontrol/home">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>supercontrol Panel</span>
                                 <i class="fa fa-circle"></i>
                            </li>
                            
                             <li>
                                <span>Reset Password</span>
                            </li>
                        </ul>
                        
                    </div>
					
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="alert alert-success alert-dismissable" style="padding:10px;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
        <?php echo @$titlemessage;//echo $this->session->flashdata('success_msg');; ?>
      </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabbable-line boxless tabbable-reversed">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_0">
                                        <div class="portlet box blue-hoki">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i>Reset Password</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                    <a href="javascript:;" class="reload"> </a>
                                                    <a href="javascript:;" class="remove"> </a>
                                                </div>
                                            </div>
            <div class="portlet-body form">
            
            
           <form action="<?php echo base_url().'supercontrol/main/reset_password' ?>" method="post" style="width:750px;" name="myForm" onsubmit="return validateForm()">  
           <?php if(validation_errors()){?>
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span> <?php echo validation_errors(); ?>  </span>
                </div>
                <?php }?>
           <input type="hidden" name="id" value="<?php echo $this->session->userdata('username')?> ">
           
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                                            
                  
           <tr><td >Old Password :</td>   <td>  <input class="form-control small_control_field form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Old Password" name="old_password" onkeyup="leftTrim(this)" /> </td>      </tr> 
           <tr><td>New Password :</td>   <td>  <input class="form-control small_control_field form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="New Password" name="newpassword"  onkeyup="leftTrim(this)"/> </td>      </tr>
			<tr><td>Retype Password :</td>   <td>  <input class="form-control small_control_field form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Retype Password" name="re_password" onkeyup="leftTrim(this)"/> </td>      </tr>
            
            </table>
              
             <center><div> <input type="submit" class="btn green uppercase pull-right" value="Reset">       </div></center><br />
              
              
              </form>
              <!-- BEGIN FORM-->
              <br><br>
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
		<script>
			function f1(stat,id)
	{
		
		//alert(stat);
		//alert(id);
		$.ajax({
                    type:"get",
                    url:"<?php echo base_url(); ?>team/statusteam",
                     data:{stat : stat, id :id}
					 
					  });
		//$.get('<?php echo base_url(); ?>banner/statusbanner',{ stat : stat , id : id });
	}
</script>

<script>
function validateForm() {
    var x = document.forms["myForm"]["UserPassword"].value;
	var y = document.forms["myForm"]["con_pass"].value;
	
    if (x != y) {
        alert("Password and Confirm Password do not match !!! ");
        return false;
    }
}
</script>

