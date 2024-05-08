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
                    <h3 class="box-title">
                        <?php echo @$title; ?>
                    </h3>
                </div>
                <?php
                if (@$member->image && file_exists('./uploads/profile_pictures/' . @$member->image)) {
                    $profileImage = base_url('uploads/profile_pictures/' . @$member->image);
                } else {
                    $profileImage = base_url('images/thumbs.jpg');
                }
                if (@$member->id) {
                    $formPath = admin_url('members/userUpdate/' . @$member->id);
                } else {
                    $formPath = admin_url('members/add/' . @$member->id);
                }
                ?>
                <form action="<?php echo @$formPath; ?>" method="post" enctype="multipart/form-data"
                    id="form_validation">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="usrImage">Profile Image</label>
                                            <input type="hidden" name="old_image"
                                                value="<?php echo @$member->image; ?>">
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" class="form-control" name="profile_image" id="customFile" onchange="preview_image(event)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 text-left">
                                        <label></label>
                                        <img id="output_image" src="<?= @$profileImage ?>" />
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="fname">First Name<span class="red">*</span></label>
                                            <input type="text" name="fname" value="<?= @$member->fname ?>" class="form-control" id="fname" placeholder="Enter First Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lname">Last Name<span class="red">*</span></label>
                                            <input type="text" name="lname" value="<?= @$member->lname ?>" class="form-control" id="lname" placeholder="Enter Last Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email<span class="red">*</span></label>
                                            <input type="text" name="email" value="<?= @$member->email ?>" class="form-control" id="email" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php if (@$member->id) { ?>
                                                <label for="password">Password<span class="red">*</span><span class="red" style="font-size: 11px; margin-left:2px;">(Enter only when you want to change the password)</span></label>
                                                <input type="text" name="usr_password" value="" class="form-control"
                                                    id="password" placeholder="******">
                                            <?php } else { ?>
                                                <label for="password">Password<span class="red">*</span></label>
                                                <input type="text" name="password" value="" class="form-control" id="password" placeholder="******">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" name="phone" value="<?= @$member->phone ?>" class="form-control" id="phone" placeholder="Enter phone">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="status">User Type</label>
                                            <select name="userType" class="form-control">
                                                <option value="1" <?= (@$member->userType == 1) ? 'selected' : ''; ?>>Student </option>
                                                <option value="2" <?= (@$member->userType == 2) ? 'selected' : ''; ?>>Instructor </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1" <?= (@$member->status == 1) ? 'selected' : ''; ?>>Active </option>
                                                <option value="0" <?= (@$member->status == 0) ? 'selected' : ''; ?>>Inactive </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer" style="margin-left:30px;">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                        <a href="<?= admin_url('members') ?>" class="btn btn-warning" title="Back">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>