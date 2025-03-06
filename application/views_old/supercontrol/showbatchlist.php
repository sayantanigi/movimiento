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
	<div class="page-sidebar-wrapper"> 
		<div class="page-sidebar navbar-collapse collapse"> 
			<?php $this->load->view ('supercontrol/leftbar');?>
		</div>

	</div>
	<style>
	.dataTables_info{padding:7px;}
</style>
<div class="page-content-wrapper"> 
	<div class="page-content"> 
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li><a href="<?php echo base_url(); ?>supercontrol/home">Home</a><i class="fa fa-circle"></i> </li>
				<li><span>Supercontrol Panel</span> <i class="fa fa-circle"></i></li>
				<li><span>Show Batch List </span></li>
			</ul>
		</div>
				<?php if($this->session->flashdata('success')!=''){ ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">&#10006;</button>
											<strong>
												<?php echo @$this->session->flashdata('success');?>
											</strong>
										</div>
									<?php } ?>
									<?php if($this->session->flashdata('error')!=''){ ?>
										<div class="alert alert-danger">
											<button type="button" class="close" data-dismiss="alert">&#10006;</button>
											<strong>
												<?php echo @$this->session->flashdata('error');?>
											</strong>
										</div>
									<?php } ?>

		<div class="row">
			<div class="col-md-12">
				<div class="tabbable-line boxless tabbable-reversed showcase_buttons">
					<div class="tab-content">
						<div class="tab-pane active" id="tab_0">
							<div class="portlet box blue-hoki">
								<div class="portlet-title">
									<div class="caption"> <i class="fa fa-gift"></i> Course Batch Details </div>
									<div class="tools"> <a href="javascript:;" class="collapse"> </a>  <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
								</div>
								<div class="portlet-body form">

							
									<!-- BEGIN FORM-->
									<table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
										<div id="mydiv">
											<thead>
												<tr>

													<th width="30">Course</th>
													<th width="30">Batch Title</th>
													<th width="30">Batch Location</th>
													<th width="27">Status</th>
													<!-- <th width="27">Action</th> -->
												</tr>
											</thead>
											<tbody>
												<?php  if(!empty($eloca)){ ?>
													<?php

													$ctn=1;

													foreach($eloca as $i){
														?>
														<tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">


															<td  style="max-width:200px;">
																<?php $table_name = 'sm_course';
																$primary_key = 'course_id';
																$wheredata = $i->courseId;
																$queryallcat = $this->generalmodel->getAllData($table_name,$primary_key,$wheredata,'','');
																echo $queryallcat[0]->course_name;
																?>

																

															</td>
															<td  style="max-width:200px;"><?php echo $i->batchName;?></td>
															<td style="max-width:80px;">
                            <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url()?>supercontrol/batch/add_batch_location"><i class="fa fa-plus" aria-hidden="true"></i> Location</a> 
                            <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url()?>supercontrol/batch/show_batch_location/<?= $i->batchId ?>"><i class="fa fa-eye" aria-hidden="true"></i>Batch  Location</a>
                            </td>
															
															<td  style="max-width:250px;"> <?php if($i->status='1'){ echo "Active"; } else {
																echo "In-Active";
															}?></td>



															
														
														</tr>
														<?php $ctn++; } ?>
													<?php } else { ?>
														<tr><td colspan="8"><p class="error"> No Batch Found</p></td></tr>
													<?php } ?>
												</tbody>
											</div>
										</table>

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
	
</div>
<script>

	$(document).ready(function() {

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
//alert ("<?php echo base_url() ?>supercontrol/controllers/blog/delete_multiple");
$.ajax({

	url: '<?php echo base_url() ?>supercontrol/course/delete_multiple',
	type: 'post',
	data: 'ids=' + checkValues
}).done(function(data) {
	$("#respose").html(data);
//location.reload();
var newurl= '<?php echo base_url() ?>supercontrol/course/show_course';
window.location.href = newurl;
$('#selectall').attr('checked', false);
});
});

		function  resetcheckbox(){
			$('input:checkbox').each(function() { 
				this.checked = false;                    
			});
		}
	});
</script> 
<script>
	function f1(stat,id)
	{
		$.ajax({
			type:"get",
			url:"<?php echo base_url(); ?>supercontrol/blog/statusblog",
			data:{stat : stat, id :id}
		});
	}
</script> 
<style type="text/css">
.showcase_buttons{}
.showcase_buttons .btn.btn-outline.green{ width: 100%; margin: 0 0 5px 0;}
.showcase_buttons .btn.btn-outline.red{ width: 100%; }
</style>
<!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>
