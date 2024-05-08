<?php //$this->load->view ('header');?>
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
  <div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
      <?php $this->load->view ('supercontrol/leftbar');?>
    </div>
  </div>
  <div class="page-content-wrapper">
    <div class="page-content">
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>supercontrol panel</span> </li>
        </ul>
      </div>
      <div class="alert alert-success alert-dismissable" style="padding:10px;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
        <strong>
        <?php 
				$last = end($this->uri->segments); 
				if($last=="success"){echo "Data Added Successfully ......";}
				if($last=="successdelete"){echo "Data Deleted Successfully ......";}
            ?>
        </strong> </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Add Blog</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo base_url().'supercontrol/blog/add_blog' ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" >
                      <div class="form-body">
                        
                        <div class="form-group last">
                          <label class="control-label col-md-3">Blog Image</label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                              <div> <span class="btn default btn-file"> <span class="fileinput-new"> Select image </span> <span class="fileinput-exists"> Change </span>
								<?php
                                $file = array('type' => 'file','name' => 'userfile' ,'id' => 'userfile' ,'onchange' => 'readURL(this);');
                                echo form_input($file);
                                ?>
                                <span class="text-danger">
                                <?php if (isset($error)) { echo $error; } ?>
                                </span> 
                                </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                            </div>
                            <div class="clearfix margin-top-10"> <span class="label label-danger">Format</span> jpg, jpeg, png, gif </div>
                          </div>
                        </div>
                        <div id="err" style="color:#f00;text-align:center;"></div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Blog Title</label>
                          <div class="col-md-8"> <?php echo form_input(array('id' => 'blog_title', 'name' => 'blog_title','class'=>'form-control')); ?> <?php echo form_error('blog_title'); ?> </div>
                        </div>
                        <div id="err1" style="color:#f00;text-align:center;"></div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Posted By</label>
                          <div class="col-md-8"> <?php echo form_input(array('id' => 'posted_by', 'name' => 'posted_by','class'=>'form-control')); ?> <?php echo form_error('posted_by'); ?> </div>
                        </div>
                        <div id="err2" style="color:#f00;text-align:center;"></div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Blog Description</label>
                          <div class="col-md-8"> <?php echo form_textarea(array('id' => 'pagedes', 'name' => 'blog_desc','class'=>'form-control')); ?> <?php echo form_error('blog_desc'); ?> </div>
                        </div>
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                            <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit' ,'class'=>'btn red')); ?>
                            <button type="button" class="btn default" onclick="goBack()">Cancel</button>
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
                    $('#userfile').attr('disabled', false);
                    break;
                    default:
                    alert('This is not an allowed file type.');
                    this.value = '';
                    }
                    });
                    </script>
                    <script>
function validateForm() {

  if($("#userfile").val() == "" ){
   $("#userfile").focus();
   $("#err").html("Upload an Image");
   return false;
  }
 else if($("#blog_title").val() == "" ){
   $("#blog_title").focus();
   $("#err1").html("enter the Blog Title");
   return false;
  }
  
  else if($("#posted_by").val() == "" ){
    $("#posted_by").focus();
    $("#err2").html("enter Posted By");
    return false;
  }

  }


</script>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php //$this->load->view ('footer');?>
