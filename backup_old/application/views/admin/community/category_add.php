<!-- Main content -->
<section class="content-header">
    <h1><?= $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= admin_url('community/community_list') ?>"> Community List</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border"></div>
                <form action="<?= admin_url('community/category_add/' . @$community_cat->id) ?>" id="form_validation" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Category Title</label>
                                            <input type="text" name="frm[category_name]" value="<?= @$community_cat->category_name ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter category Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Category Sub Title</label>
                                            <input type="text" name="frm[category_subtitle]" value="<?= @$community_cat->category_subtitle ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter category Sub Title">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Category Image</label>
                                            <input type="file" name="category_image" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                    <?php if (!empty(@$community_cat->category_image)) { ?>
                                    <img src="<?= base_url()?>uploads/community/category/<?= $community_cat->category_image; ?>" style="width: 100px">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>