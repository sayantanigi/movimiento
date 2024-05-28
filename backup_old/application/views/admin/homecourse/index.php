<style>
    .form-control {margin-bottom: 15px;}
</style>
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
                <div class="box-header with-border2">
                    <h3 class="box-title"><?= $title ?> Lists</h3>
                    <a href="<?= admin_url('homecourse/add/') ?>" class="pull-right btn btn-primary"><span class="fa fa-plus"></span> Add New</a>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Image</th>
                            <th>Heading</th>
                            <th>Sub Heading</th>
                            <th>URL</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                        if (!empty($homecourse)) {
                        $i = 1;
                        foreach ($homecourse as $row) {
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td style="vertical-align: middle;">
                            <?php if (@$row->course_icon && file_exists('./uploads/homecourse/' . @$row->course_icon)) { ?>
                                <img src="<?= base_url('uploads/homecourse/' . @$row->course_icon) ?>" alt="" style="width: auto; max-height: 60px; padding: 1px; border: 2px solid #ccc;background: #ccc;">
                            <?php } else { ?>
                                <img src="<?= base_url('images/thumbs.jpg') ?>" alt="" style="width: auto; max-height: 52px; padding: 1px; border: 2px solid #e87c03;background: #ccc;">
                            <?php } ?>
                            </td>
                            <td><?= $row->heading ?></td>
                            <td><?= $row->sub_heading ?></td>
                            <td><?php if(@$row->course_url) {echo @$row->course_url; } else { echo"&#8212;"; } ?></td>
                            <td><?= date('d M Y', strtotime($row->created_at)); ?></td>
                            <td style="vertical-align: middle;">
                                <div class="checkbox checbox-switch switch-success">
                                    <label>
                                        <input type="checkbox" value="<?= @$row->status ?>" <?= (@$row->status == 1) ? 'checked="checked"' : ''; ?> onchange="changehomecoursetatus(<?= @$row->id ?>, $(this))">
                                        <span></span>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="action-button">
                                    <a href="<?= admin_url('homecourse/add/' . $row->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                    <button class="btn btn-xs btn-danger" style="margin-left: 5px;" title="Delete" data-toggle="tooltip" onclick="deleteHomecourse(<?= @$row->id ?>)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; } } else { ?>
                        <tr><td colspan='8' class='text-center red'><h3>No record available!</h3></td></tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="box-footer clearfix"><?= $paginate ?></div>
            </div>
        </div>
    </div>
</section>
<script>
function deleteHomecourse(id) {
    swal({
        title: 'Are You sure want to delete this record?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#36A1EA',
        cancelButtonColor: '#e50914',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        closeOnConfirm: true,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) {
            window.location.href = '<?= admin_url('homecourse/deleteHomecourse/') ?>' + id
        }
    });
}
</script>