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
                                <span>supercontrol panel</span>
                            </li>
                        </ul>
                        
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
					<!--<div class="alert alert-success alert-dismissable" style="padding:10px;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
        <strong>
			<?php 
				$last = end($this->uri->segments); 
				if($last=="success"){echo "Data Added Successfully ......";}
				if($last=="successdelete"){echo "Data Deleted Successfully ......";}
            ?>
        </strong> 
      </div>-->
       <?php if (isset($success_msg)) { echo $success_msg; } ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabbable-line boxless tabbable-reversed">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_0">
                                        <div class="portlet box blue-hoki">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i>Add Gallery</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                    <a href="javascript:;" class="reload"> </a>
                                                    <a href="javascript:;" class="remove"> </a>
                                                </div>
                                            </div>
											
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
  
                                                <form action="<?php echo base_url().'supercontrol/gallery/add_gallery' ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" onsubmit="return Submit();">
                <div class="form-body">
                   
                  <div class="form-group last">
                                                <label class="control-label col-md-3">Image</label>
                                                <div class="col-md-9">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                   
                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> 
                                                          
                                                            </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                        <div>
                                                            <span class="btn default btn-file">
                                                                <span class="fileinput-new"> Select image </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <!--<input type="file" name="...">-->
																<?php
                                                                $file = array('type' => 'file','name' => 'userfile', 'id'=>'chkimg','onchange'=>'checkFile(this);');
                                                                echo form_input($file);
                                                                ?>
                                                            </span>
                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix margin-top-10">
                                                        <span class="label label-danger">Format</span> jpg, jpeg, png, gif </div>
                                                </div>
                                            </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3"> Gallery Name</label>
                    <div class="col-md-8">
                      <?php echo form_input(array('id' => 'gallery_name', 'name' => 'gallery_name','class'=>'form-control', 'onkeyup'=> 'leftTrim(this)')); ?>
                      <?php //echo form_error('cms_heading'); ?>
                      <label id="errorBox"></label>
                    </div>
                  </div>
       
                  
                  
                  
                  <!--<div class="form-group">
                    <label class="control-label col-md-3">Gallery Image</label>
                    <div class="col-md-8">
                      <?php
                    $file = array('type' => 'file','name' => 'userfile', 'id'=>'chkimg','onchange'=>'checkFile(this);');
					echo form_input($file);
                    ?>
                    <label>Please select jpg, png, jpeg or gif file.</label>
                    <label id="errorBox1"></label>
                    </div>
                  </div>-->
                 
                 
                 
                 
                  
                </div>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                      <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                      <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit' ,'class'=>'btn red')); ?>
                      <a href="<?php echo base_url(); ?>supercontrol/gallery/show_gallery"><button type="button" class="btn default">Cancel</button></a>
                    </div>
                  </div>
                </div>
              </form>
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
        <script>
		function Submit(){
		if($("#gallery_name").val() == "" ){
				$("#gallery_name").focus();
				$("#errorBox").html("Please Enter Gallery Name");
				return false;
		}else{
				$("#errorBox").html("");  
		}



if($("#chkimg").val() == "" ){
$("#chkimg").focus();
$("#errorBox1").html("Please Enter Gallery Image");
return false;
}else{
$("#errorBox1").html("");  
}

}

function leftTrim(element){
if(element)
element.value=element.value.replace(/^\s+/,"");
}

 $('INPUT[type="file"]').change(function () {
										// alert("jjjjj");
    var ext = this.value.match(/\.(.+)$/)[1];
    switch (ext) {
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            $('#chkimg').attr('disabled', false);
            break;
        default:
            alert('This is not an allowed file type.');
            this.value = '';
    }
 });
</script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>-->

<style>
#errorBox{
 color:#F00;
 }
 
 #errorBox1{
 color:#F00;
 }
 
 #errorBox2{
 color:#F00;
 }
</style>  
        <!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>
        