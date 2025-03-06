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
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Team Lists</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th style="width: 40px">Action</th>
                        </tr>
                        <?php
                        if (is_array($intervenants) && count($intervenants) > 0) {
                        $i = 1;
                        foreach ($intervenants as $intervenant) {
                        ?>
                        <tr>
                            <td>
                                <?= $i ?>
                            </td>
                            <td><img src="<?= site_url('uploads/intervenantS/' . $intervenant->profilePics) ?>" title="<?= $intervenant->name ?>" width="100px" onerror="this.src='<?= site_url('images/no_image.jpg'); ?>';"></td>
                            <td><?= $intervenant->name ?></td>
                            <td><?= $intervenant->designation ?></td>
                            <td>
                                <div class="action-button">
                                    <a href="<?= admin_url('intervenants/add/' . $intervenant->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                    <a href="<?= admin_url('intervenants/delete/' . $intervenant->id) ?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
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