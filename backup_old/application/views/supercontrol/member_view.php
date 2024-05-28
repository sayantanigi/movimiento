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
                    <div class="caption"> <i class="fa fa-gift"></i>View details</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  
                  <div class="portlet-body form"> 
                   <?php if($this->session->flashdata('edit_message')!=''){?>
                        <div class="alert alert-success1" style="background-color:#98E0D5;">
                        <button type="button" class="close" data-dismiss="alert">&#10006;</button>
                        <strong style="color:#063;"><?php echo @$this->session->flashdata('edit_message');?></strong> 
                        </div>
                        <?php }?>
                    <!-- BEGIN FORM-->
                    <?php foreach($userlist as $c){?>
                    <form action="<?php echo base_url().'supercontrol/member/edit_member'?>" class="form-horizontal" method="post" enctype"multipart/form-data">
                    <input type="hidden" name="member_id" value="<?=$c->member_id;?>" disabled="disabled">
                    <div class="form-group"> <b>
                          <label class="col-md-3 control-label">First Name *</label>
                          </b>
                          <div class="col-md-8">
                            <input type="text" name="first_name" id="title" value="<?=$c->first_name;?>" class="form-control" placeholder="Course Name" onkeyup= "leftTrim(this)" disabled="disabled"/>
                            <label id="errorBox"></label>
                          </div>
                        </div>
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">last Name *</label>
                          </b>
                          <div class="col-md-8">
                            <input type="text" name="last_name" id="title" value="<?=$c->last_name;?>" class="form-control" placeholder="Course Name" onkeyup= "leftTrim(this)" disabled="disabled"/>
                            <label id="errorBox"></label>
                          </div>
                        </div>
                        
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Email *</label>
                          </b>
                          <div class="col-md-8">
                            <input type="email" name="email" id="title" value="<?=$c->email;?>" class="form-control" placeholder="Course Name" onkeyup= "leftTrim(this)" disabled="disabled"/>
                            <label id="errorBox"></label>
                          </div>
                        </div>
                        
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Phone no *</label>
                          </b>
                          <div class="col-md-8">
                            <input type="text" name="phoneno" id="title" value="<?=$c->phoneno;?>" class="form-control" placeholder="Course Name" onkeyup= "leftTrim(this)" disabled="disabled"/>
                            <label id="errorBox"></label>
                          </div>
                        </div>
                      <div class="form-body">
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Gender</label>
                          </b>
                          <div class="col-md-8"> 
                          <select name="gender" class="form-control" disabled="disabled">
                         	<option value="male" <?php if($c->gender=='male'){?> selected="selected"<?php }?>>Male</option>
                           <option value="female" <?php if($c->gender=='female'){?> selected="selected"<?php }?>>Female</option>
                          </select>
                            <label id="errorBox"></label>
                          </div>
                        </div>
                        
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">User Type</label>
                          </b>
                          <div class="col-md-8"> 
                          <select name="user_type" class="form-control" disabled="disabled">
                         	<option value="std" <?php if($c->user_type=='std'){?> selected="selected"<?php }?>>Student</option>
                           <option value="inst" <?php if($c->user_type=='inst'){?> selected="selected"<?php }?>>Instructor</option>
                           <option value="busi" <?php if($c->user_type=='busi'){?> selected="selected"<?php }?>>Business</option>
                          </select>
                            <label id="errorBox"></label>
                          </div>
                        </div>
                        
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Status</label>
                          </b>
                          <div class="col-md-8"> 
                          <select name="status" class="form-control" disabled="disabled">
                         	<option value="1" <?php if($c->status=='1'){?> selected="selected"<?php }?>>Active</option>
                           <option value="0" <?php if($c->status=='0'){?> selected="selected"<?php }?>>InActive</option>
                          </select>
                            <label id="errorBox"></label>
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
