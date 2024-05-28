<!--<h2>Welcome <?php //echo $UserName; ?>!</h2>-->

<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <?php $this->load->view('supercontrol/leftbar'); ?>
    <!-- END SIDEBAR -->
  </div>
  <!-- END SIDEBAR -->
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
      <!-- END THEME PANEL -->
      <!-- BEGIN PAGE TITLE-->
      <h3 class="page-title"> <?php echo @$title;?>
        <!--<small>classic page head option</small>-->
      </h3>
      <!-- END PAGE TITLE-->
      <!-- BEGIN PAGE BAR -->
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="dashboard.php">Home</a> <i class="fa fa-angle-right"></i> </li>
          <li> <span><?php echo @$title;?></span> </li>
        </ul>
      </div>
      <!-- END PAGE BAR -->
      <!-- END PAGE HEADER-->
     <style type="text/css">
	 			.tile {
			padding-top:0px;
		  height: 117px;
		  width: 184px !important;
		  position: relative;
		  overflow: hidden;
		  cursor:pointer;
		  border: 5px solid #ccc;
		}
		
		
		.tile .tile-body {
		  height: 100%;
		  overflow: hidden;
		  position: relative;
		}
		.tile:active, .tile.selected {
		  border-color: #ccc;
		}
		
		
		.tile.image > .tile-body > img{
		  width: 100%;
		  height: auto;
		  min-height: 100%;
		  max-width: 100%;
		}
	 </style>
      <div class="alert alert-success alert-dismissable" style="padding:10px;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
       
			 <?php if($this->session->flashdata('success')!=''){?><div class="alert alert-success text-center"><?php echo $this->session->flashdata('success');?></div><?php }?>
       
      </div>
      <div class="row">
        <div class="col-md-12">
          <!-- BEGIN PORTLET-->
          <div class="portlet box blue-hoki">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-reorder"></i>
                <?php echo @$title;?>
              </div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a>  <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
            
             
              <!-- BEGIN FORM-->
              <div class="table-toolbar"> </div>
              <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                <thead>
                  <tr>
                  	<th width="5%"><input id="selectall" type="checkbox" ></th>
                    <th width="5%"> Announcement Title </th>
                    <th width="50%"> Details </th>
                    <th width="10%"> Add Date </th>
                    <th width="10%"> Status </th>
                    <th width="10%"> Edit </th>
                    <th width="10%"> Delete </th>
                  </tr>
                </thead>
               
                <tbody>
				<?php
                foreach($ecms as $i){
                ?>
                  <tr class="odd gradeX">
                   <td>
                          <input name="checkbox[]" class="checkbox1" type="checkbox"  value="<?php echo $i->id;?>">
                          </td>
                    <td><?php echo $i->announcement_title;?></td>
                    <td><?php echo substr(stripslashes($i->description),0,100);?></td>
                    <td><?php echo date('d-m-Y',strtotime($i->add_date));?></td>
                    <td><?php if($i->status ==1){?>
                      <span style="color:#063;"><?php echo "Active";?></span>
                      <?php }else{?>
                      <span style="color:#900;"><?php echo "Inactive";?></span>
                      <?php }?></td>
                    <td><a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/announcement/show_announcement_id/<?php echo $i->id?>"><i class="fa fa-edit"></i> Edit</a></td>
                    <td><a class="btn red btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/announcement/delete_announcement/<?php echo $i->id?>" onclick="return confirm('Are you sure you want to delete ?');"><i class="fa fa-trash"></i> Delete</a></td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>
              <!-- END FORM-->
            </div>
          </div>
          <!-- END PORTLET-->
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
//====FOR DELETE MULTIPLE====
     $(document).ready(function() {
                //resetcheckbox();
        $("#selectall").click(function(){
          var check = $(this).prop('checked');
            if(check == true) {
              $('.checker').find('span').addClass('checked');
              $('.checkbox1').prop('checked', true);
            } else {
              $('.checker').find('span').removeClass('checked');
              $('.checkbox1').prop('checked', false);
            }
        });
                $("#del_all").on('click', function(e) {
                    e.preventDefault();
                    var checkValues = $('.checkbox1:checked').map(function()
                    {
                        return $(this).val();
                    }).get();
                    console.log(checkValues);
                     //alert(checkValues);
                    $.each( checkValues, function( i, val ) {
           //alert(val);
                        $("#"+val).remove();
                        });
//                    return  false;
           //alert ("<?php echo base_url() ?>supercontrol/controllers/mode/delete_multiple");
                    $.ajax({
              
                        url: '<?php echo base_url() ?>supercontrol/announcement/delete_multiple',
                        type: 'post',
                        data: 'ids=' + checkValues
                    }).done(function(data) {
                        $("#respose").html(data);
           
                        var newurl= '<?php echo base_url() ?>supercontrol/announcement/showannouncement';
                        window.location.href = newurl;
                        $('#selectall').attr('checked', false);
                    });
                });
                 
                function  resetcheckbox(){
                $('input:checkbox').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                   });
                }
            });
</script>
<script>
    function f1(stat,id)
    {
    $.ajax({
    type:"get",
    url:"<?php echo base_url(); ?>supercontrol/mode/statusmode",
    data:{stat : stat, id :id}
    });
    }
</script>

<!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>
