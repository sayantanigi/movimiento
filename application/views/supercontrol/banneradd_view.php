<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript">
$(function() {
setTimeout(function() { $("#testdiv").fadeOut(1500); }, 5000)
$('#btnclick').click(function() {
$('#testdiv').show();
setTimeout(function() { $("#testdiv").fadeOut(1500); }, 5000)
})
})
</script>
        
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                
                <div class="page-sidebar navbar-collapse collapse">
                   
                    <?php $this->load->view ('supercontrol/leftbar');?>
                    
                </div>
              
            </div>
            
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Supercontrol Panel</span>
                            </li>
                        </ul>
                        
                    </div>
                    
                    
					 <?php if (isset($success_msg)) { echo $success_msg; } ?>
                    <div class="row">
                   
                        <div class="col-md-12">
                            <div class="tabbable-line boxless tabbable-reversed">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_0">
                                        <div class="portlet box blue-hoki">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i>Add Banner</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                    <a href="javascript:;" class="reload"> </a>
                                                    <a href="javascript:;" class="remove"> </a>
                                                </div>
                                            </div>
            <div class="portlet-body form">
          	<form action="<?php echo base_url().'supercontrol/banner/add_banner' ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
            <div class="form-body">
            
            
            <!--<div class="form-group">
            <label class="control-label col-md-3">Banner Image</label>
            <div class="col-md-8">
            <?php
            $file = array('id' => 'banner', 'type' => 'file','name' => 'userfile', 'onchange' => 'readURL(this);' );
            echo form_input($file);
            ?>
           <span class="text-danger"><?php if (isset($error)) { echo $error; } ?></span>
            </div>
            </div>-->
            
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
                                                               
																	<?php
                                                                    $file = array('id' => 'banner', 'type' => 'file','name' => 'userfile', 'onchange' => 'readURL(this);' );
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
            <label class="control-label col-md-3"> Heading</label>
            <div class="col-md-8">
            <?php echo form_input(array('id' => 'banner_heading', 'name' => 'banner_heading','class'=>'form-control' )); ?>
            <?php echo form_error('banner_heading'); ?>
            </div>
            </div>
            
            <div class="form-group">
            <label class="control-label col-md-3">Sub Heading</label>
            <div class="col-md-8">
            <?php echo form_input(array('id' => 'banner_sub_heading', 'name' => 'banner_sub_heading','class'=>'form-control' )); ?>
            <?php echo form_error('banner_sub_heading'); ?>
            </div>
            </div>
            
            <div class="form-group">
            <label class="control-label col-md-3">Description</label>
            <div class="col-md-8">
            <?php echo form_textarea(array('id' => 'pagedes', 'name' => 'banner_description','class'=>'form-control ' )); ?>
            <?php echo form_error('banner_description'); ?>
            </div>
            </div>
            
            
            </div>
            <div class="form-actions">
            <div class="row">
            <div class="col-md-offset-3 col-md-9">
            <?php echo form_submit(array('id' => 'submit', 'name' => 'Submit' , 'value' => 'Submit' ,'class'=>'btn red')); ?>
            <button type="button" class="btn default">Cancel</button>
            </div>
             
            </div>
            </div>
            </form>
			<script>
            $('INPUT[type="file"]').change(function () {
            var ext = this.value.match(/\.(.+)$/)[1];
            switch (ext) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
            $('#banner').attr('disabled', false);
            break;
            default:
            alert('This is not an allowed file type.');
            this.value = '';
            }
            });
            </script>
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
        