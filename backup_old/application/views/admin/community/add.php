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
                <form action="<?= admin_url('community/add_community/' . $community->id) ?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="text" name="frm[title]" value="<?= $community->title ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Title">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Full Description</label>
                                            <textarea name="frm[description]" value="<?= $community->description ?>" id="editor1"><?= $community->description ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Type</label>
                                            <select name="frm[cat_id]" class="form-control">
                                                <option value="">Select option</option>
                                                <?php
                                                if(!empty($community_cat)) {
                                                foreach ($community_cat as $community_cat_v) { ?>
                                                <option value="<?= $community_cat_v['id']?>" <?php if($community_cat_v['id'] == $community->cat_id) { echo "selected"; }?>><?= $community_cat_v['category_name']?></option>
                                                <?php } } else { ?>
                                                <option value="">No Data</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Status</label>
                                            <select name="frm[status]" class="form-control">
                                                <option value="">Select option</option>
                                                <option value="1" <?php if ($community->status == 1) { echo 'selected';} ?>>Active</option>
                                                <option value="2" <?php if ($community->status == 2) { echo 'selected';} ?>>Inactive</option>
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