<?php //$this->load->view ('header');?>
<style>
.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.panel-body
{
    overflow-y: scroll;
    height: 250px;
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

</style>
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
      <div class="row" >
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="panel panel-primary">
        <div class="panel-heading"> <span class="glyphicon glyphicon-comment"></span> Chat With User
          <div class="btn-group pull-right">
          </div>
        </div>
        <div class="panel-body" id="mydiv">
          <ul class="chat" id="chat_new">
            <?php if(!empty($allchat)){ foreach($allchat as $all){?>
            <?php if($all->admin_id!=0){?>
            <li class="left clearfix"><span class="chat-img pull-left"> <img style="width:50px; height:50px;"
             src="<?php echo base_url()?>user_panel/student/img/logo1.png" alt="User Avatar" class="img-circle" /> </span>
              <div class="chat-body clearfix">
                <div class="header"> <strong class="primary-font">Admin</strong> <small class="pull-right text-muted"> <span class="glyphicon glyphicon-time"></span><?php echo date('d-m-Y h:i:s', strtotime($all->send_date));?></small> </div>
                <p> <?=$all->message;?></p>
              </div>
            </li>
            <?php }else{?>
            <li class="right clearfix"><span class="chat-img pull-right"><?php if(!empty($myprofile)){?> <img style="width:50px; height:50px;" src="<?php echo base_url()?>uploads/profile/<?php echo $myprofile[0]->profile_image?>" alt="User Avatar" class="img-circle" /><?php }else{?><img style="width:50px; height:50px;" src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" /> <?php }?> </span>
              <div class="chat-body clearfix">
                <div class="header"> <small class=" text-muted"><span class="glyphicon glyphicon-time"></span><?php echo date('d-m-Y h:i:s', strtotime($all->send_date));?></small> <strong class="pull-right primary-font"><?=$myprofile[0]->first_name;?></strong> </div>
                <p style="float:right;"> <?=$all->message;?> </p>
              </div>
            </li>
            <?php }?>
            <?php }}?>
          </ul>
        </div>
        <div class="panel-footer">
        <form method="post">
        <input type="hidden" name="uid" id="uid" value="<?=$this->uri->segment(4);?>">
          <div class="input-group">
            <input id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." />
            <span class="input-group-btn">
            <input type="submit" value="Send" class="btn btn-warning btn-sm" id="createGrade"/>
            </span> 
           </div>
         </form>  
        </div>
      </div>
    </div>
    <div class="col-md-3"></div>
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
