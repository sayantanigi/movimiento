<!-- Main content -->
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
                    <h3 class="box-title"><?= $title ?></h3>
                </div>
                <form action="<?= admin_url('conference/add/' . $conference->id) ?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" name="frm[title]" value="<?= $conference->title ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Full Description</label>
                                            <textarea name="frm[description]" value="<?= $conference->description ?>" id="editor1"><?= $conference->description ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date</label>
                                            <input type="date" name="frm[date]" value="<?= $conference->date ?>" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Category</label>
                                            <select name="frm[category]" class="form-control">
                                                <option value="">Select option</option>
                                                <option value="foundation" <?php if ($conference->category == 'foundation') { echo 'selected';} ?>>Foundation</option>
                                                <option value="institute" <?php if ($conference->category == 'institute') { echo 'selected';} ?>>Institute</option>
                                                <option value="network" <?php if ($conference->category == 'network') { echo 'selected';} ?>>Network</option>
                                                <option value="webinar" <?php if ($conference->category == 'webinar') { echo 'selected';} ?>>Webinar</option>
                                                <option value="Analyses Makutano" <?php if ($conference->category == 'Analyses Makutano') { echo 'selected';} ?>>Analyses Makutano</option>
                                                <option value="Working Papers" <?php if ($conference->category == 'Working Papers') { echo 'selected';} ?>>Working Papers</option>
                                                <option value="RABA/ARBI" <?php if ($conference->category == 'RABA/ARBI') { echo 'selected';} ?>>RABA/ARBI</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Status</label>
                                            <select name="frm[status]" class="form-control">
                                                <option value="">Select option</option>
                                                <option value="0" <?php if ($conference->status == 0) { echo 'selected';} ?>>Inactive</option>
                                                <option value="1" <?php if ($conference->status == 1) { echo 'selected';} ?>>Active
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <img src="<?= site_url('uploads/conference/' . $conference->image) ?>" onerror="this.src='<?= site_url() ?>assets/images/no-image.png';" class="img-responsive" style="width:100px">
                                            <label for="exampleInputEmail1">Image</label>
                                            <input type="file" name="image" value="<?= $conference->image ?>" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <img src="<?= site_url('uploads/conference/attachment/' . $conference->attachment) ?>" onerror="this.src='<?= site_url() ?>assets/images/no-image.png';" class="img-responsive" style="width:100px">
                                            <label for="exampleInputEmail1">Attachment</label>
                                            <input type="file" name="attachment" value="<?= $conference->attachment ?>" class="form-control" id="exampleInputEmail1">
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