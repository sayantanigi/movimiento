<?php //$this->load->view ('header');
$this->load->model('generalmodel');
$this->load->model('supercontrol/instructor_model');
//error_reporting(0);
?>
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
     
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Course Batch Details</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a>  <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form"> 
                    <!-- BEGIN FORM-->
                    <?php foreach($lessdetails as $c){?>
                    <form action="<?php echo base_url().'supercontrol/course/edit_course'?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                      
                     
                      <div class="form-body">
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Course</label>
                          </b>
                          <div class="col-md-8">
                            <?php $table_name = 'sm_course';
                                $primary_key = 'course_id';
                                $wheredata = $c->course_id;
                                $queryallcat = $this->generalmodel->getAllData($table_name,$primary_key,$wheredata,'','');
                                echo $queryallcat[0]->course_name;
                                ?>
                           
                          </div>
                        </div>
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Batch Start Date</label>
                          </b>
                          <div class="col-md-8">
                            <?=$c->start_date;?>
                           
                          </div>
                        </div>
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Batch Start Time</label>
                          </b>
                          <div class="col-md-8">
                            <?=$c->start_time;?>
                            
                          </div>
                        </div>
                         <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Batch End Time</label>
                          </b>
                          <div class="col-md-8">
                            <?=$c->end_time;?>
                            
                          </div>
                        </div>
                       
                       
                        
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Status</label>
                          </b>
                          <div class="col-md-8">
                            <?php if($c->status='1'){ echo "Active"; } else {
                              echo "In-Active";
                            }?>
                            
                          </div>
                        </div>
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9"> </div>
                        </div>
                      </div>
                    </form>
                    <?php  } ?>
                    
                   
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
