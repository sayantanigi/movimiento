<?php //$this->load->view ('header');?>
<!-- BEGIN CONTAINER -->
<style>
#sample_1_filter {
	padding: 8px;
	float: right;
}
#sample_1_length {
	padding: 8px;
}
#sample_1_info {
	padding: 8px;
}
#sample_1_paginate {
	float: right;
	padding: 8px;
}
</style>
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
          <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>Admin Panel</span> <i class="fa fa-circle"></i> </li>
          <li> <span>Show Details </span> </li>
        </ul>
      </div>
      
      <!-- END PAGE BAR --> 
      <!-- BEGIN PAGE TITLE--> 
      <!-- END PAGE TITLE--> 
      <!-- END PAGE HEADER-->
      <?php if (isset($success_msg)) { echo $success_msg; } ?>
      <?php if (isset($success_msg1)) { echo $success_msg1; } ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Instructor schedule list</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a>  <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form"> 
                    <!-- BEGIN FORM-->
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                      <thead>
                        <tr>
                          <th width="20" style="max-width:190px;">ID</th>
                          <th width="20">Instructor</th>
                          <th width="45" style="max-width:190px;">Title</th>
                          <th width="66">Start</th>
                          <th width="66">End</th>
                          <th width="27">Approved Status</th>
                          <th width="27">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(count($userlist)>1)
                        {
                			foreach($userlist as $i){
                		?>
                        <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                           <td width="60" style="max-width:190px;"><?php echo $i->id;?></td>
                           <td><?php 
                           $inst=$i->instructor_id;
                           
                            $user=$this->generalmodel->fetch_member('member',$inst);

                           echo $user->first_name." ".$user->last_name;  ?></td>

                          <td width="60" style="max-width:190px;"><?php echo $i->schedule_title;?></td>
                          <td  style="max-width:200px;"><?php echo $i->start;?></td>
                          <td  style="max-width:200px;"><?php echo $i->end;?></td>
                         
                          
                          <td>
                    <select id="status" onchange="changestatus(this.value, <?=$i->id;?>);">
                  <option value="Yes" <?php if($i->approved=="Yes"){echo 'selected';}?>>Yes</option>
                  <option value="No" <?php if($i->approved=="No"){echo 'selected';}?>>No</option>
                </select>
                            </td>
                          
                          <td style="max-width:50px;"><a onclick="deleteone(<?php echo $i->id;?>);" class="btn red btn-sm btn-outline sbold uppercase" href="javascript:Void(0);">Delete</a></td>
                        </tr>
                        <?php } 
                      } else {?>
                      <tr>
                        <td colspan="7"> No  Schdeule List</td>

                      </tr>

                      <?php } ?>
                      </tbody>
                    </table>
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
	function f1(stat,id)
	{
		$.ajax({
           type:"get",
           url:"<?php echo base_url(); ?>supercontrol/property/statusproperty",
           data:{stat : stat, id :id}
					 
					  });
		//$.get('<?php echo base_url(); ?>banner/statusbanner',{ stat : stat , id : id });
	}
   function deleteone(id)
  {
    cnf = confirm("Are you confirm to delete?");
    if(cnf)
    {
      $('.portlet .tools a.reload').click();
      $.ajax({
        type:"GET",
        url:"<?php echo base_url();?>supercontrol/member/Deleteinstschedule",
        data:"id="+id,
        success:function(data)
        {

      //alert(data);
         if(data=="deleted")
         {
          alert("Successful deleted!");
          setTimeout(function() 
          {
                        location.reload();  //Refresh page
                      }, 1000);
                      //$('#user'+id).css('display', 'none');
                    }
                  }
                });

    }
  }
  function changestatus(val,id)
  {
      //alert(val);
      //alert(id);
      $.ajax({
        type:"GET",
        url:"<?php echo base_url();?>supercontrol/member/instscheduleStatus",
        data:"id="+id+"&val="+val,
        success:function(data)
        {
          //alert(data);
          alert("Successful Updated Approved  Status!");
          setTimeout(function() 
          {
                    location.reload();  //Refresh page
                  }, 1000);
        }
      });
      
    }
</script> 
<!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>
