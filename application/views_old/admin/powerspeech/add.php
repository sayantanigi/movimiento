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
				if (@$powerspeech->icon && file_exists('./uploads/powerspeech/' . @$powerspeech->icon)) {
					$profileImage = base_url('uploads/powerspeech/' . @$powerspeech->icon);
				} else {
					$profileImage = base_url('images/thumbs.jpg');
				}
				?>
				<form action="<?= admin_url('homecourse/powerspeech_add/'); ?>" method="post" enctype="multipart/form-data" id="form_validation">
          			<div class="box-body">
						<div class="container">
							<div class="row">
								<div class="col-sm-10">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="usrImage">Image</label>
											<input type="hidden" name="old_image" value="<?php echo @$powerspeech->icon; ?>">
											<div class="custom-file">
											<?php if (@$powerspeech->id) { ?>
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
											<textarea name="heading" class="form-control" role="3"><?=@$powerspeech->heading?></textarea>
										</div>
									</div>
								</div>
								<div class="col-sm-10">
									<div class="col-sm-12">
										<div class="form-group">
											<label for="fname">Sub Heading<span class="red">*</span></label>
											<textarea name="sub_heading" class="form-control" role="3"><?=@$powerspeech->sub_heading?></textarea>
										</div>
									</div>
								</div>
								<div class="col-sm-10">
									<div class="col-sm-12">
										<div class="form-group">
											<label for="fname">Message<span class="red">*</span></label>
											<textarea name="message" class="form-control" rows="5"><?=@$powerspeech->message?></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
          			</div>
					<div class="box-footer" style="margin-left:30px;">
						<button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
						<input type="hidden" name="id" value="<?= $powerspeech->id;?>"/>
						<!-- <a href="<?= admin_url('powerspeech') ?>" class="btn btn-warning" title="Back">Back</a> -->
					</div>
       			 </form>
      		</div>
    	</div>
 	</div>
</section>