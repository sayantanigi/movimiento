<!-- Main content -->
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
                if (@$banner->banner_image && file_exists('./uploads/banners/' . @$banner->banner_image)) {
                    $profileImage = base_url('uploads/banners/' . @$banner->banner_image);
                } else {
                    $profileImage = base_url('images/thumbs.jpg');
                }
                if (@$banner->id) {
                    $formPath = admin_url('banner/bannerUpdate/'.@$banner->id);
                } else {
                    $formPath = admin_url('banner/bannerSave/'.@$banner->id);
                }
                ?>
                <form action="<?php echo @$formPath; ?>" method="post" enctype="multipart/form-data" id="form_validation">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="usrImage">Banner Image</label>
                                            <input type="hidden" name="old_image" value="<?php echo @$banner->banner_image; ?>">
                                            <div class="custom-file">
                                            <?php if (@$banner->id) { ?>
                                                <input type="file" accept="image/*" class="form-control" name="banner_image_edt" id="customFile" onchange="preview_image(event)">
                                            <?php } else { ?>
                                                <input type="file" accept="image/*" class="form-control" name="banner_image" id="customFile" onchange="preview_image(event)">
                                            <?php } ?>  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 text-left">
                                        <label></label>
                                        <img id="output_image" src="<?= @$profileImage ?>" />
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="fname">URL</label>
                                            <input type="text" name="banner_url" value="<?=@$banner->banner_url?>" class="form-control" id="banner_url" placeholder="Enter URL">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="fname">Heading<span class="red">*</span></label>
                                            <textarea name="heading" class="form-control" role="3"><?=@$banner->heading?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="lname">Sub Heading<span class="red">*</span></label>
                                            <textarea name="sub_heading" class="form-control" role="3"><?=@$banner->sub_heading?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer" style="margin-left:30px;">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                        <a href="<?= admin_url('banner') ?>" class="btn btn-warning" title="Back">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>