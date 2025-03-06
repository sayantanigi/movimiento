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
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Programme Sejour</h3>
                    <a href="<?= admin_url('programme_sejour/add') ?>" class="pull-right btn btn-primary">Add</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Title</th>
                            <th>Presentation For</th>
                            <th>Dress Code</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th style="width: 40px">Action</th>
                        </tr>
                        <?php
                        if (is_array($programmes) && count($programmes) > 0) {
                        $i = 1;
                        foreach ($programmes as $programmes_v) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $programmes_v->title ?></td>
                            <td><?php if($programmes_v->programme_for == 'mak_09') {echo 'Makutano 09';} elseif ($programmes_v->programme_for == 'mak_08') {echo 'Makutano 08';} else { echo 'No data';} ?></td>
                            <td>
                                <?php if(!empty($programmes_v->dress)) {
                                    echo $programmes_v->dress;
                                } else {
                                    echo "Nill";
                                } ?>
                            </td>
                            <td style="max-height: 100px !important;overflow-y: scroll;display: block;"><?= $programmes_v->description ?></td>
                            <td>
                                <?php if ($programmes_v->status == 1) { ?>
                                <a href="<?= admin_url('programme_sejour/deactivate/' . $programmes_v->id) ?>"><span class="badge bg-green">Active</span></a>
                                <?php } else { ?>
                                <a href="<?= admin_url('programme_sejour/activate/' . $programmes_v->id) ?>"><span class="badge bg-red">Inactive</span></a>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="action-button">
                                    <a href="<?= admin_url('programme_sejour/add/' . $programmes_v->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                    <a href="<?= admin_url('programme_sejour/delete/' . $programmes_v->id) ?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; } } ?>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $paginate ?>
                    <!-- <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul> -->
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>