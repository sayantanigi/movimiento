<section class="content-header">
    <h1><?= $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Product Management</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Product Category Lists</h3>
                    <a href="<?= admin_url('products/add_product_cat') ?>" class="pull-right btn btn-primary"><span class="fa fa-plus"></span> Add New</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 30px;">Title</th>
                            <th style="width: 40px">Action</th>
                        </tr>
                        <?php
                        if (is_array($product_cat_list) && count($product_cat_list) > 0) {
                        $i = 1;
                        foreach ($product_cat_list as $list_v) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $list_v->category_name ?></td>
                            <td>
                                <a href="<?= admin_url('products/add_product_cat/' . $list_v->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                <!-- <a href="<?= admin_url('products/delete_prod_category/' . $list_v->id) ?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a> -->
                                <button class="btn btn-xs btn-danger" style="margin-left: 5px;" title="Delete" data-toggle="tooltip" onclick="deleteCategory(<?= @$list_v->id ?>)"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php $i++; } } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
function deleteCategory(id) {
    swal({
        title: 'Are you sure want to delete this category?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#36A1EA',
        cancelButtonColor: '#e50914',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        closeOnConfirm: true,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            window.location.href = '<?= admin_url('products/delete_category/') ?>' + id
        }
    });
}
</script>