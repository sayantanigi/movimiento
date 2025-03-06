<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Makutano 09 List</h3>
                    <a href="<?= admin_url('newsletter/add') ?>" class="pull-right btn btn-primary"><span class="fa fa-plus"></span> Add</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Attachment</th>
                            <th>Presentation For</th>
                            <th>status</th>
                            <th style="width: 40px">Action</th>
                        </tr>
                        <?php
                        if (is_array($newsletter) && count($newsletter) > 0) {
                        $i = 1;
                        foreach ($newsletter as $gal) {
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><a href="<?= site_url('uploads/newsletter/' . @$gal->image) ?>" title="" width="80px" >File Attachment</a></td>
                            <td><?php echo $gal->title; ?>
                            </td>
                            <td>
                                <?php if ($gal->status == 1) { ?>
                                <a href="<?= admin_url('newsletter/deactivate/' . $gal->id) ?>"><span class="badge bg-green">Active</span></a>
                                <?php } else { ?>
                                <a href="<?= admin_url('newsletter/activate/' . $gal->id) ?>"><span class="badge bg-red">Inactive</span></a>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="action-button">
                                    <a href="<?= admin_url('newsletter/add/' . $gal->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                    <a href="<?= admin_url('newsletter/delete/' . $gal->id) ?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; } } ?>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> <?= $paginate ?> </div>
            </div>
        </div>
    </div>
</section>