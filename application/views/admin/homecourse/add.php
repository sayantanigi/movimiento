<section class="content-header">
    <h1><?= $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo @$title; ?></h3>
				</div>
				<?php
				if (@$homecourse->course_icon && file_exists('./uploads/homecourse/' . @$homecourse->course_icon)) {
					$profileImage = base_url('uploads/homecourse/' . @$homecourse->course_icon);
				} else {
					$profileImage = base_url('images/thumbs.jpg');
				}

				if (@$homecourse->id) {
					$formPath = admin_url('homecourse/homecourseUpdate/'.@$homecourse->id);
				} else {
					$formPath = admin_url('homecourse/homecourseSave/'.@$homecourse->id);
				}
				?>
				<form action="<?php echo @$formPath; ?>" method="post" enctype="multipart/form-data" id="form_validation">
          			<div class="box-body">
						<div class="container">
							<div class="row">
								<div class="col-sm-10">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="usrImage">Course Icon</label>
											<input type="hidden" name="old_image" value="<?php echo @$homecourse->course_icon; ?>">
											<div class="custom-file">
											<?php if (@$homecourse->id) { ?>
												<input type="file" accept="image/*" class="form-control" name="course_icon_edt" id="customFile" onchange="preview_image(event)">
											<?php } else { ?>
												<input type="file" accept="image/*" class="form-control" name="course_icon" id="customFile" onchange="preview_image(event)">
											<?php } ?>
											</div>
										</div>
									</div>
									<div class="col-sm-2 text-left">
										<label></label>
										<img id="output_image" src="<?= @$profileImage ?>" style='background: #ccc;'/>
									</div>
								</div>
								<div class="col-sm-10">
									<div class="col-sm-12">
										<div class="form-group">
											<label for="fname">Heading<span class="red">*</span></label>
											<textarea name="heading" class="form-control" role="3"><?=@$homecourse->heading?></textarea>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label for="lname">Sub Heading<span class="red">*</span></label>
										<textarea name="sub_heading" class="form-control" role="3"><?=@$homecourse->sub_heading?></textarea>
										</div>
									</div>
								</div>
								<div class="col-sm-10">
									<div class="col-sm-12">
										<div class="form-group">
											<label for="fname">URL</label>
											<input type="text" name="course_url" value="<?=@$homecourse->course_url?>" class="form-control" id="course_url" placeholder="Enter URL">
										</div>
									</div>
								</div>
							</div>
						</div>
          			</div>
					<div class="box-footer" style="margin-left:30px;">
						<button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
						<a href="<?= admin_url('homecourse') ?>" class="btn btn-warning" title="Back">Back</a>
					</div>
       			 </form>
      		</div>
    	</div>
 	</div>
</section>