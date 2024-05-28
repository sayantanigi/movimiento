<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Portfolio List</h3>
                    <a href="<?= admin_url('portfolio/add') ?>" class="pull-right btn btn-primary"><span class="fa fa-plus"></span> Add</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Portfolio Name</th>
                            <th>Image</th>
                            <th style="width: 40px">Action</th>
                        </tr>
                        <?php
                        if (is_array($portfolio) && count($portfolio) > 0) {
                        $i = 1;
                        foreach ($portfolio as $gal) {
                        ?>
                        <tr>
                            <td>
                                <?= $i ?>
                            </td>
                            <td>
                            <?php if($gal->portfolioId == '1') { 
                                echo "Portfolio 9";
                            } else if($gal->portfolioId == '2') {
                                echo "Portfolio 8";
                            } else if($gal->portfolioId == '3') {
                                echo "Portfolio 7";
                            } else if($gal->portfolioId == '4') {
                                echo "Youth";
                            } else {
                                echo "Women In Business";
                            }?>
                            </td>
                            <td>
                                <img src="<?= site_url('uploads/portfolio/' . @$gal->image) ?>" title="" width="80px" >
                            </td>
                            <td>
                            <?php
                            if ($gal->status == 1) {
                                ?>
                                <a href="<?= admin_url('portfolio/deactivate/' . $gal->id) ?>"><span
                                        class="badge bg-green">Active</span></a>
                                <?php
                            } else {
                                ?>
                                <a href="<?= admin_url('portfolio/activate/' . $gal->id) ?>"><span
                                        class="badge bg-red">Inactive</span></a>
                                <?php
                            }
                            ?>
                            </td>
                            <td>
                                <div class="action-button">
                                    <a href="<?= admin_url('portfolio/add/' . $gal->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                    <a href="<?= admin_url('portfolio/delete/' . $gal->id) ?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
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