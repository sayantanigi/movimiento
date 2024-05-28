<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">
            <?= $title ?>
        </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Team</h3>
                </div>
                <form action="<?= admin_url('intervenants/add/' . $intervenants->id) ?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" name="frm[name]" value="<?= $intervenants->name ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Designation</label>
                                            <input type="text" name="frm[designation]" value="<?= $intervenants->designation ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Designation">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <img src="<?= site_url('uploads/intervenants/' . $intervenants->profilePics) ?>" onerror="this.src='<?= site_url("assets/images/no-image.png") ?>';" class="img-responsive" style="width:100px">
                                            <label for="exampleInputEmail1">Profile Pics</label>
                                            <input type="file" name="profilePics" value="<?= $intervenants->profilePics ?>" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Status</label>
                                            <select name="frm[status]" class="form-control select2">
                                                <option value="">Select Status</option>
                                                <option value="1" <?php if ($intervenants->status == '1') {echo "selected";}?>>Active</option>
                                                <option value="0" <?php if ($intervenants->status == '0') {echo "selected";}?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>