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
                    <h3 class="box-title">Community Lists</h3>
                    <a href="<?= admin_url('community/add_community') ?>" class="pull-right btn btn-primary">Add</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Uploaded By</th>
                            <th>Status</th>
                            <th style="width: 40px">Action</th>
                        </tr>
                        <?php
                        if (is_array($community) && count($community) > 0) {
                        $i = 1;
                        foreach ($community as $community_v) {
                            $string = strip_tags($community_v->description);
                            if (strlen($string) > 500) {
                                $stringCut = substr($string, 0, 900);
                                $endPoint = strrpos($stringCut, ' ');
                                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                $string .= '    ....';
                            }
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $community_v->title ?></td>
                            <td><?= $string?></td>
                            <td>
                                <?php
                                if(!empty($community_v->uploaded_by)){
                                    $userdetails = $this->db->query("SELECT * FROM users WHERE id = '".$community_v->uploaded_by."'")->row();
                                    echo $userdetails->full_name;
                                } else {
                                    echo "Admin";
                                }
                                ?>
                            </td>
                            <td>
                                <?php if ($community_v->status == 1) { ?>
                                <a href="<?= admin_url('community/deactivate/' . $community_v->id) ?>"><span class="badge bg-green">Active</span></a>
                                <?php } else { ?>
                                <a href="<?= admin_url('community/activate/' . $community_v->id) ?>"><span class="badge bg-red">Inactive</span></a>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="action-button">
                                    <a href="<?= admin_url('community/add_community/' . $community_v->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                    <a href="<?= admin_url('community/delete/' . $community_v->id) ?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
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