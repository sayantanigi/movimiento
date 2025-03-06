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
                <form action="<?= admin_url('blog/add/' . $blog->id) ?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" name="frm[title]" value="<?= $blog->title ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Full Description</label>
                                            <textarea name="frm[description]" value="<?= $blog->description ?>" id="editor1"><?= $blog->description ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Type</label>
                                            <select name="frm[popular]" class="form-control">
                                                <option value="">Select option</option>
                                                <option value="blog" <?php if ($blog->popular == 'blog') { echo 'selected'; } ?>>Blog</option>
                                                <option value="news" <?php if ($blog->popular == 'news') { echo 'selected'; } ?>>News</option>
                                                <option value="press" <?php if ($blog->popular == 'press') { echo 'selected'; } ?>>Press</option>
                                                <option value="inv_kit" <?php if ($blog->popular == 'inv_kit') { echo 'selected'; } ?>>Investor Kit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Status</label>
                                            <select name="frm[status]" class="form-control">
                                                <option value="">Select option</option>
                                                <option value="0" <?php if ($blog->status == 0) { echo 'selected';} ?>>Inactive</option>
                                                <option value="1" <?php if ($blog->status == 1) { echo 'selected';} ?>>Active
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <img src="<?= site_url('assets/images/blog/' . $blog->image) ?>" onerror="this.src='<?= site_url() ?>assets/images/no-image.png';" class="img-responsive" style="width:100px">
                                            <label for="exampleInputEmail1">Image</label>
                                            <input type="file" name="image" value="<?= $blog->image ?>" class="form-control" id="exampleInputEmail1">
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