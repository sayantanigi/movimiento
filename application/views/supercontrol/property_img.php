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
          <li> <a href="">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>Admin Panel</span> </li>
        </ul>
        <div class="page-toolbar">
          <!--<div class="btn-group pull-right">
            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions <i class="fa fa-angle-down"></i> </button>
            <ul class="dropdown-menu pull-right" role="menu">
              <li> <a href="#"> <i class="icon-bell"></i> Action</a> </li>
              <li> <a href="#"> <i class="icon-shield"></i> Another action</a> </li>
              <li> <a href="#"> <i class="icon-user"></i> Something else here</a> </li>
              <li class="divider"> </li>
              <li> <a href="#"> <i class="icon-bag"></i> Separated link</a> </li>
            </ul>
          </div>-->
        </div>
      </div>
      <?php
	  $last = end($this->uri->segment_array());
	  if($last=="imgup"){
	  ?>
      <div class="alert alert-success alert-dismissable" style="padding:10px;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
        <strong>
        <?php 
				
				echo "Image Added Successfully ......";
				
            ?>
        </strong> </div>
      <?php }?>
       <?php
	  $last = end($this->uri->segment_array());
	  if($last=="imgdlt"){
	  ?>
      <div class="alert alert-success alert-dismissable" style="padding:10px;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
        <strong>
        <?php 
				
				echo "Image Deleted Successfully ......";
				
            ?>
        </strong> </div>
      <?php }?>
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
                                                    <i class="fa fa-gift"></i>Add Property Images</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                    <a href="javascript:;" class="reload"> </a>
                                                    <a href="javascript:;" class="remove"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                
                                                
                                               <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/dropzone.css" />
                                              <script type="text/javascript" src="<?php echo base_url() ?>asset/js/jquery-1.10.2.min.js"></script>
												<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/dropzone.js"></script>
                                                <style>
                                                    .dropzone {
                                                    background: white none repeat scroll 0 0;
                                                    border: 2px dashed #ff7361 !important;
                                                    border-radius: 5px;
                                                }
                                                .dropzone.dz-clickable .dz-message, .dropzone.dz-clickable .dz-message * {
                                                    cursor: pointer;
                                                    font-weight: 600;
                                                    margin-top: 40px;
                                                }
                                                </style>
                                                
										<script type="text/javascript">
                                            $(document).ready(function(){

                                            Dropzone.autoDiscover = false; // keep this line if you have multiple dropzones in the same page
                                                $("#uploadform").dropzone({	
                                                acceptedFiles: "image/jpeg",
                                                url: '<?php echo base_url('supercontrol/imageupload/doupload/'.$this->uri->segment(4));?>',
                                                maxFiles: 10, // Number of files at a time
                                                maxFilesize: 10, //in MB
                                                maxfilesexceeded: function(file) {
                                                    alert('You have uploaded more than 10 Image. Only the first file will be uploaded!');
                                                },
                                                success: function (response) {
                                                    var x = JSON.parse(response.xhr.responseText);
                                                    $('.icon').hide();
                                                    $('#uploader').modal('hide');
                                                    $('.img').attr('src',x.img);
                                                    $('.thumb').attr('src',x.thumb);
                                                    $('img').addClass('imgdecoration');
                                                    //this.removeAllFiles();
                                                    console.log('Image -> '+x.img+', Thumb -> '+x.thumb);          // Just to return the JSON to the console.
                                                    
                                                    $.post("<?php echo base_url('supercontrol/imageupload/property_img_ajax/'.'/'.$this->uri->segment(4));?>",
                                                                           function(file)
                                                                            {
                                                                              $("#tablesec").html(file);
                                                                            }
                                                                           );
                                                    
                                                },		
                                                addRemoveLinks: true,
                                                removedfile: function(file) {
                                                var _ref;
                                                         return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;  
                                                 }	
                                                
                                                });
                                                
                                            });
                                            </script>
                                            
                                            <div class="image_upload_div">
                                                <form action="<?php echo base_url('supercontrol/imageupload/doupload/'.$this->uri->segment(4));?>" class="dropzone23 uploadform dropzone no-margin dz-clickable" id="uploadform">
                                                 <input type="hidden" name="property_id" value="<?php echo $this->uri->segment(4); ?>" />
                                                </form>
                                            </div>
                        
                                                <p style="font-size:18px; margin-left:15px; padding-top:25px;">Property Images </p>
                                                   
                                                    
                                                 <div id="tablesec">
                                                  <?php
                                                  if($mulimg){
                                                  ?>
                                                    <?php   foreach($mulimg as $i){?>
                                                      <?php   if($i->apartment_image == ''){
                                                                $pic = base_url()."property_img/noimage.jpg" ;
                                                              } else{
                                                            $pic = base_url()."property_img/".$i->apartment_image ; } 
                                                    ?>
                                                    
                                                    <div class="img">
                                                      
                                                        <img src="<?=$pic ?>" alt="Image Loading..." width="151" height="152">
                                                     
                                                      <div class="desc"><button style="background-color:#F00;"><a style="text-decoration:none; color:#FFF;" href="<?php echo base_url()?>supercontrol/imageupload/delete_property_img/<?php echo $i->id?>/<?=$this->uri->segment(4); ?>" onclick="return confirm('Are you sure you want to delete ?');"><i class="fa fa-trash"></i> Delete</a>
                                                     <!-- <img src="<?=$pic ?>" alt="Image loading.." style="width:150px;"/>
                                                      <div>
                                                      <a href="<?php echo base_url()?>supercontrol/imageupload/delete_property_img/<?php echo $i->id?>/<?=$this->uri->segment(4); ?>" onclick="return confirm('Are you sure you want to delete ?');"><i class="fa fa-trash"></i> Delete</a>-->
                                                      </div> </div>
                                                    <?php }  ?>
                                                  <?php }?>
                                                  <style>
                                                        div.img {
                                                            margin: 5px;
                                                            border: 1px solid #ccc;
                                                            float: left;
                                                            width: 181px;
															
                                                        }
                                                        
                                                        div.img:hover {
                                                            border: 1px solid #777;
                                                        }
                                                        
                                                        div.img img {
                                                            width: 180px;
                                                            height: 150px;
                                                        }
                                                        
                                                        div.desc {
                                                            padding: 15px;
                                                            text-align: center;
                                                        }
                                                    </style>
                                                    
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
  <!-- END CONTENT -->
  <!-- BEGIN QUICK SIDEBAR -->
  <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>

