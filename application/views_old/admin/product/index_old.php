<section class="content-header">
    <h1><?= $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>

<section class="content-header">
    <?php $this->load->view('alert'); ?>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border33">
                    <h3 class="box-title">Course Lists</h3>
                    <a href="<?= admin_url('products/add_product') ?>" class="pull-right btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>Sl No.</th>
                            <th>Image</th>
                            <th>Posted By</th>
                            <th>Product Name</th>
                            <th>Overview</th>
                            <th>Quantity</th>
                            <th>MRP</th>
                            <th>Sate Price</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        if (is_array($products) && count($products) > 0) {
                        $i = 0;
                        foreach ($products as $product) {
                        $i++;
                        if (@$product->product_image && file_exists('./uploads/products/' . @$product->product_image)) {
                            $image = base_url('/uploads/products/' . @$product->product_image);
                        } else {
                            $image = base_url('assets/images/no-image.png');
                        }
                        $queryallcat = $this->db->query("SELECT category_name FROM product_category WHERE id = $product->categori_id")->result_array();?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><img src="<?= @$image ?>" title="<?= $product->product_name ?>" style="width:60px; border:1px solid #ccc; padding:2px;"></td>
                            <td>
                                <?php
                                $getUserDetails = $this->db->query("SELECT fname, lname FROM users WHERE id = '".$product->user_id."'")->result_array();
                                if(!empty($getUserDetails)) {
                                    echo $getUserDetails[0]['fname']." ".$getUserDetails[0]['lname'];
                                } else {
                                    echo "Admin";
                                } ?>
                            </td>
                            <td>
                                <div class="truncate">
                                <?php if (@$product->product_name) {
                                    echo @$product->product_name;
                                } else {
                                    echo "&#8212;";
                                } ?>
                                </div>
                            </td>
                            <td>
                                <div class="truncate">
                                    <?= strip_tags($product->overview) ?>
                                </div>
                            </td>
                            <td>
                                <?php echo $product->quantity; ?>
                            </td>
                            <td>
                                <?php echo $price = '$'.number_format($product->mrp, 2); ?>
                            </td>
                            <td>
                                <?php echo $sale_price = '$'.number_format($product->sale_price, 2); ?>
                            </td>
                            <td>
                                <div class="checkbox checbox-switch switch-success">
                                    <label>
                                        <input type="checkbox" value="<?= @$product->status ?>" <?= (@$product->status == 1) ? 'checked="checked"' : ''; ?> onchange="changeProductStatus(<?= @$product->id ?>, $(this))">
                                    <span></span>
                                    </label>
                                    <a href="<?= admin_url('products/add_product/' . $product->id) ?>" class="btn btn-xs btn-warning"><span class="fa fa-pencil"></span></a>
                                    <button class="btn btn-xs btn-danger" style="margin-left: 5px;" title="Delete" data-toggle="tooltip" onclick="deleteProduct(<?= @$product->id ?>)"> <i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php } } ?>
                    </table>
                </div>
                <div class="box-footer clearfix"><?= $paginate ?></div>
            </div>
        </div>
    </div>
</section>
<style>
.modal-title {width: 90%;display: inline-block;}
.modal-close {background: none;border: none;float: right;}
</style>
<script>
function deleteProduct(id) {
    swal({
        title: 'Are You sure want to delete this product?',
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
            window.location.href = '<?= admin_url('products/delete/') ?>' + id
        }
    });
}
</script>