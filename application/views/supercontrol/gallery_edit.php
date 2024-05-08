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
                            </li>
                        </ul>
                        
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabbable-line boxless tabbable-reversed">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_0">
                                        <div class="portlet box blue-hoki">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i>Gallery edit</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                    <a href="javascript:;" class="reload"> </a>
                                                    <a href="javascript:;" class="remove"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                
                                               <?php foreach($ecms as $i){?>
              <form method="post" class="form-horizontal form-bordered" action="<?php echo base_url().'supercontrol/gallery/edit_gallery '?>" enctype="multipart/form-data" onsubmit="return Submit()">
                <div class="form-body">
                <input type="hidden" name="gallery_id" value="<?=$i->id;?>">
                <input type="hidden" name="old_file" value="<?=$i->gallery_image;?>">
                
                <div class="form-group last">
                                                <label class="control-label col-md-3">Image</label>
                                                <div class="col-md-9">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                        <?php if($i->gallery_image==''){ ?>
                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> 
                                                        <?php }else{?> 
                                                        	<img src="<?php echo base_url()?>/gallery/<?php echo $i->gallery_image;?>" alt="" /> 
                                                        <?php }?>      
                                                            </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                        <div>
                                                            <span class="btn default btn-file">
                                                                <span class="fileinput-new"> Select image </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <!--<input type="file" name="...">-->
																<?php
                                                                $file = array('type' => 'file','name' => 'userfile','id'=>'chkimg','onchange'=>'checkFile(this);');
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
                    <label class="control-label col-md-3">Gallery Name</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" id="gallery_name" value="<?php echo $i->gallery_name;?>" name="gallery_name" onkeyup="leftTrim(this)" />
                      <label id="errorBox"></label>
                    </div>
                  </div>
        
                  <!--<div class="form-group">
                    <label class="control-label col-md-3">Image Upload</label>
                    <div class="col-md-7">
                    <?php
                    $file = array('type' => 'file','name' => 'userfile','id'=>'chkimg','onchange'=>'checkFile(this);');
					echo form_input($file);
                    ?>
                    <label>Please select jpg, png, jpeg or gif file.</label>
                    	<?php //echo form_input(array('id' => 'name', 'name'=>'image','type' =>'file' ,'class'=>'form-control fileimage')); ?>
                     <div id='default_img'><img id="select" src="<?php echo base_url()?>/gallery/<?php echo $i->gallery_image;?>" alt="your image" style="width:150px;"/></div>
                    </div>
                  </div>-->
                  
                  
                  
                 
                </div>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                      <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                      <input type="submit" class="btn red" id="submit" value="Submit" name="update">
                      <a href="<?php echo base_url();?>gallery/show_gallery"><button type="button" class="btn default">Cancel</button></a>
                    </div>
                  </div>
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
        <script>
		function Submit(){
		if($("#gallery_name").val() == "" ){
		$("#gallery_name").focus();
		$("#errorBox").html("Please Enter Gallery Name");
		return false;
		}else{
		$("#errorBox").html("");  
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
