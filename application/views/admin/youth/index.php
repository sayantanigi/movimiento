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
                    <h3 class="box-title">Media Lists</h3>
                    <a href="<?= admin_url('youth_activity/add') ?>" class="pull-right btn btn-primary">Add</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Heading</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th style="width: 40px">Action</th>
                        </tr>
                        <?php
                        if (is_array($youth) && count($youth) > 0) {
                        $i = 1;
                        foreach ($youth as $youth_v) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $youth_v->heading ?></td>
                            <td><?= $youth_v->description ?></td>
                            <td>
                                <?php if ($youth_v->status == 1) { ?>
                                <a href="<?= admin_url('youth_activity/deactivate/' . $youth_v->id) ?>"><span class="badge bg-green">Active</span></a>
                                <?php } else { ?>
                                <a href="<?= admin_url('youth_activity/activate/' . $youth_v->id) ?>"><span class="badge bg-red">Inactive</span></a>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="action-button">
                                    <a href="<?= admin_url('youth_activity/add/' . $youth_v->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                    <a href="<?= admin_url('youth_activity/delete/' . $youth_v->id) ?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; } } ?>
                    </table>
                </div>
                <div class="box-footer clearfix"><?= $paginate ?></div>
            </div>
        </div>
    </div>