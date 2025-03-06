<?php //$this->load->view ('header');?>

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
          <li> <span>Admin Panel</span> </li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Country edit</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <?php foreach($ecategory as $i){?>
                    <form method="post" class="form-horizontal form-bordered" action="<?php echo base_url().'supercontrol/country/edit_country'?>" enctype="multipart/form-data" onsubmit="return check();">
                      <div class="form-body">
                        <input type="hidden" name="id" value="<?=$i->id;?>">
                        <div class="form-group">
                          <label class="control-label col-md-3">Country Name</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="country_name" value="<?php echo $i->country_name;?>" name="country_name" onkeyup= "leftTrim(this)">
                            <div id="errorBox"></div>
                          </div>
                        </div>
                      <!--  <div class="form-group">
                          <label class="control-label col-md-3">Sort Order</label>
                          <div class="col-md-5">
                            <input type="text" class="form-control" id="sorting_order" value="<?php echo $i->sorting_order;?>" name="sorting_order" onkeyup= "leftTrim(this)">
                            <div id="errorBox"></div>
                          </div>
                        </div>-->
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <input type="submit" class="btn red" id="submit" value="Submit" name="update">
                            <button class="btn default" type="button">Cancel</button>
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
<!-- END CONTAINER -->
	<script>
    function check(){
		if($("#category_name").val() == "" ){
		$("#category_name").focus();
		$("#errorBox").html("Please Enter Project Type or Category");
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
