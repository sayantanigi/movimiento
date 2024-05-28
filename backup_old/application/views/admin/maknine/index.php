<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Makutano 09 List</h3>
                    <a href="<?= admin_url('maknine/add') ?>" class="pull-right btn btn-primary"><span class="fa fa-plus"></span> Add</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Image</th>
                            <th>Presentation For</th>
                            <th>status</th>
                            <th style="width: 40px">Action</th>
                        </tr>
                        <?php
                        if (is_array($maknine) && count($maknine) > 0) {
                        $i = 1;
                        foreach ($maknine as $gal) {
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><img src="<?= site_url('uploads/maknine/' . @$gal->image) ?>" title="" width="80px" ></td>
                            <td>
                                <?php
                                if($gal->presentation_for == 'mak_09'){echo 'Makutano 09';} elseif($gal->presentation_for == 'mak_08') {echo 'Makutano 08';} else { echo 'No data';}
                                ?>
                            </td>
                            <td>
                                <?php if ($gal->status == 1) { ?>
                                <a href="<?= admin_url('maknine/deactivate/' . $gal->id) ?>"><span class="badge bg-green">Active</span></a>
                                <?php } else { ?>
                                <a href="<?= admin_url('maknine/activate/' . $gal->id) ?>"><span class="badge bg-red">Inactive</span></a>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="action-button">
                                    <a href="<?= admin_url('maknine/add/' . $gal->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                    <a href="<?= admin_url('maknine/delete/' . $gal->id) ?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
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