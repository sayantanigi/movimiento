<?php //$this->load->view ('header');?>
<script>
        $(document).ready(function(){
            $("#check").click(function(){
                $("#drop").show(1000);
				$("#check").hide();
				$("#check2").show();
            });
			
			$("#check2").click(function(){
                $("#drop").hide(1000);
				$("#check").show();
				$("#check2").hide();
            });
            
        });
		
        </script>
<script>
			$(document).ready(function () {
				$('label').click(function() {
					$('.active').removeClass("active");
				$(this).addClass("active");
				});
			});
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
          <li> <a href="<?php echo base_url(); ?>supercontrol/user/dashboard">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>Admin panel</span> </li>
        </ul>
      </div>
      <div class="alert alert-success alert-dismissable" style="padding:10px;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
        <strong>
        <?php 
				if(@$success_msg!=''){echo @$success_msg;}
				$last = end($this->uri->segments); 
				if($last=="success"){echo "course Added Successfully ......";}
				if($last=="successdelete"){echo "course Deleted Successfully ......";}
            ?>
        </strong> </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Edit course</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form"> 
                    <!-- BEGIN FORM-->
                    <?php foreach($course as $c){?>
                    <form action="<?php echo base_url().'supercontrol/course/edit_course'?>" class="form-horizontal" method="post" enctype"multipart/form-data">
                    <input type="hidden" name="course_id" value="<?=$c->course_id;?>">
                    <input type="hidden" name="course_image" value="<?php echo $c->course_image;?>">
                      <div class="form-body">
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Select Category *</label>
                          </b>
                          <div class="col-md-8"> 
                          <select name="course_category" class="form-control">
                          <?php foreach($allcat as $ac){?>
                          	<option value="<?php echo $ac->category_id?>" <?php if($c->course_category==$ac->category_id){?> selected="selected" <?php }?>><?php echo $ac->category_name?></option>
                            <?php }?>
                          </select>
                            <label id="errorBox"></label>
                          </div>
                        </div>
                        
                        
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Course Country *</label>
                          </b>
                          <div class="col-md-8">
                            <input type="text" name="course_country" id="title" value="<?=$c->course_country;?>" class="form-control" placeholder="Course Country" onkeyup= "leftTrim(this)"/>
                            <label id="errorBox"></label>
                          </div>
                        </div>
                        
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Course Name *</label>
                          </b>
                          <div class="col-md-8">
                            <input type="text" name="course_name" id="title" value="<?=$c->course_name;?>" class="form-control" placeholder="Course Name" onkeyup= "leftTrim(this)"/>
                            <label id="errorBox"></label>
                          </div>
                        </div>
                        
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Price *</label>
                          </b>
                          <div class="col-md-8">
                            <input type="text" name="price" id="price" value="<?=$c->price;?>" class="form-control" placeholder="Price" onkeyup= "leftTrim(this)"/>
                            <label id="errorBox1"></label>
                          </div>
                        </div>
                        <div class="form-group"> <b>
                      <label class="col-md-3 control-label">CPD accredited</label>
                    </b>
                    <div class="col-md-8">
                      
                      <input type="radio" name="cpd" class="form-control" <?php if($c->cpd=="Yes") { ?> checked="" <?php } ?> value="Yes">Yes
                      <input type="radio" name="cpd" class="form-control" <?php if($c->cpd=="No") { ?> checked="" <?php } ?>  value="No">No 
                    </div>
                  </div>
                  <div class="form-group"> <b>
                      <label class="col-md-3 control-label">Certificate</label>
                    </b>
                    <div class="col-md-8">
                      <input type="text" required="" name="certificate" id="certificate" class="form-control" value="<?=$c->certificate;?>" placeholder="Certificate Details"/>
                      <!-- <label id="errorBox1"></label>-->
                    </div>
                  </div>
                  <div class="form-group"> <b>
                      <label class="col-md-3 control-label">Entry Requirement</label>
                    </b>
                    <div class="col-md-8">
                      <input type="text" required="" name="entry_requirment" id="entry_requirment" value="<?=$c->entry_requirment;?>" class="form-control" placeholder="Entry Requirement Details"/>
                      <!-- <label id="errorBox1"></label>-->
                    </div>
                  </div>
                  
                  
                  
                  
                  
                   <div class="form-group"><b>
                                        <label class="col-md-3 control-label">Opening Date * </label></b>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input type="date" name="start_date" id="date" value="<?=$c->start_date;?>"  placeholder="Enter Day"  class="form-control"  data-format="dd-mm-yyyy">
                                            </div>
                                        </div>                                                                                                
                                    </div>
                                    
                                    <div class="form-group"><b>
                                        <label class="col-md-3 control-label">End  Date * </label></b>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input type="date" name="end_date" id="date"  value="<?=$c->end_date;?>" placeholder="Last Day"  class="form-control"  data-format="dd-mm-yyyy">
                                            </div>
                                        </div>                                                                                                
                                    </div>
                  
                  
                  
                  
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Description</label>
                          </b>
                          <div class="col-md-8">
                          <textarea id="pagedes" class="form-control" name="course_description" cols="60" rows="10"  aria-hidden="true"><?=$c->course_description;?></textarea>
                           
                          </div>
                        </div>
                        
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Sort Order</label>
                          </b>
                          <div class="col-md-8">
                            <input type="text" name="sort_order" id="sort_order" value="<?=$c->sort_order;?>" class="form-control" placeholder="Sort Order" onkeyup= "leftTrim(this)"/>
                           <!-- <label id="errorBox1"></label>-->
                          </div>
                        </div>
                        
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <input type="submit" id="submit" value="Submit" class="btn red">
                            <button type="button" class="btn default">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <?php }?>
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
<style type="text/css">
		label {
  width: 125px;
  display: block;
  float: left;
}
label input {
  display: none;
}
label span {
  display: block;
  width: 17px;
  height: 17px;
  border: 1px solid black;
  float: left;
  margin: 0 5px 0 0;
  position: relative;
}
label.active span:after {
  content: " ";
  position: absolute;
  left: 3px;
  right: 3px;
  top: 3px;
  bottom: 3px;
  background: black;
}
		.topul li {
			list-style-type:none;
				
		}
		</style>
<script>
    	function check(){
    		if($("#title").val() == "" ){
    			$("#title").focus();
    			$("#errorBox").html("Please Enter Project Type or course");
    			return false;
    		}else{
    			$("#errorBox").html("");
    
   		 	}
    	}
    </script> 
<script>
		function leftTrim(element){
			if(element)
			element.value=element.value.replace(/^\s+/,"");
		}
	</script>
<style>
        #errorBox{
        color:#F00;
        }
        </style>
<?php //$this->load->view ('footer');?>
