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
                    <h3 class="box-title">Conference Lists</h3>
                    <a href="<?= admin_url('conference/add') ?>" class="pull-right btn btn-primary">Add</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Image</th>
                            <th>File</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Uploaded</th>
                            <th>Status</th>
                            <th style="width: 40px">Action</th>
                        </tr>
                        <?php
                        if (is_array($conference) && count($conference) > 0) {
                        $i = 1;
                        foreach ($conference as $conference_v) { ?>
                        <tr>
                            <td>
                                <?= $i ?>
                            </td>
                            <td><img src="<?= site_url('uploads/conference/' . $conference_v->image) ?>" title="<?= $conference_v->title ?>" width="100px" onerror="this.src='<?= site_url('assets/images/no-image.png'); ?>';"></td>
                            <td>
                                <?php if(empty($conference_v->attachment)) { ?>
                                <a href="<?= site_url('uploads/conference/' . $conference_v->attachment) ?>" title="<?= $conference_v->title ?>" width="100px" onerror="this.src='<?= site_url('assets/images/no-image.png'); ?>';">
                                <?php } else { ?>
                                <a href="<?= base_url()?>uploads/conference/<?= $conference_v->attachment?>" target="_blank">File Attachment</a>
                                <?php } ?>
                            </td>
                            <td><?= $conference_v->title ?></td>
                            <td><?= ucwords($conference_v->category) ?></td>
                            <td><?= date('Y-m-d', strtotime($conference_v->date)) ?></td>
                            <td>
                                <?php 
                                if(!empty($conference_v->uploaded_by)){
                                    $userdetails = $this->db->query("SELECT * FROM users WHERE id = '".$conference_v->uploaded_by."'")->row();
                                    echo $userdetails->fname." ".$userdetails->lname;
                                } else {
                                    echo "Admin";
                                }
                                ?>
                            </td>
                            <td>
                                <?php if ($conference_v->status == 1) { ?>
                                <a href="<?= admin_url('conference/deactivate/' . $conference_v->id) ?>"><span class="badge bg-green">Active</span></a>
                                <?php } else { ?>
                                <a href="<?= admin_url('conference/activate/' . $conference_v->id) ?>"><span class="badge bg-red">Inactive</span></a>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="action-button">
                                    <a href="<?= admin_url('conference/add/' . $conference_v->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                    <a href="<?= admin_url('conference/delete/' . $conference_v->id) ?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; } } ?>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <?= $paginate ?>
                </div>
            </div>
        </div>
    </div>
</section>