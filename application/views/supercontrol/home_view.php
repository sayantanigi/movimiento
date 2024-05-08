<style type="text/css">
.dashboard-stat .visual>i {margin-left: 0;}
.dashboard-stat .visual {height: 150px !important;}
.dashboard-stat .details .desc {font: 30px;}
</style>
<div class="page-container">
	<div class="page-sidebar-wrapper">
		<?php $this->load->view('supercontrol/leftbar'); //include"lib/leftbar.php" ?>
	</div>
	<div class="page-content-wrapper">
		<div class="page-content">
			<h3 class="page-title"> Dashboard </h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a style="pointer-events:none;" href="<?php base_url(); ?>supercontrol/home">Home</a><i class="fa fa-angle-right"></i></li>
					<li><span>Dashboard</span></li>
				</ul>
			</div>
			<div class="row">
				<!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		  			<div class="dashboard-stat blue">
						<div class="visual"> <i class="fa fa-sliders"></i> </div>
						<div class="details">
			  				<div class="desc">Course Managements</div>
						</div>
						<a class="more" href="<?php echo base_url(); ?>supercontrol/course/show_course"> View more <i class="m-icon-swapright m-icon-white"></i> </a>
					</div>
				</div> -->

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="dashboard-stat red">
						<div class="visual"> <i class="fa fa-picture-o"></i> </div>
						<div class="details">
							<div class="desc">Course Management</div>
						</div>
						<a class="more" href="<?php echo base_url(); ?>supercontrol/course/show_course"> View more <i class="m-icon-swapright m-icon-white"></i> </a>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="dashboard-stat red">
						<div class="visual"> <i class="fa fa-picture-o"></i> </div>
						<div class="details">
							<div class="desc">Instructor Management</div>
						</div>
						<a class="more" href="<?php echo base_url(); ?>supercontrol/home"> View more <i class="m-icon-swapright m-icon-white"></i> </a>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="dashboard-stat red">
						<div class="visual"><i class="fa fa-newspaper-o"></i> </div>
						<div class="details">
							<div class="desc">Booking Management</div>
						</div>
						<a class="more" href="<?php echo base_url(); ?>supercontrol/home"> View more <i class="m-icon-swapright m-icon-white"></i> </a>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="dashboard-stat red">
						<div class="visual"> <i class="fa fa-envelope"></i> </div>
						<div class="details">
							<div class="desc">Student Management</div>
						</div>
						<a class="more" href="<?php echo base_url(); ?>supercontrol/home"> View more <i class="m-icon-swapright m-icon-white"></i> </a>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<a href="javascript:;" class="page-quick-sidebar-toggler"> <i class="icon-login"></i> </a>
	<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">