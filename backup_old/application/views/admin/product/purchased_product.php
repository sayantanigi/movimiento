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
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>Sl No.</th>
                            <th>TXN ID</th>
                            <th>Ordered Item</th>
                            <th>Ordered By</th>
                            <th>Shipping Address</th>
                            <th>Status</th>
                            <th>Created Date</th>
                        </tr>
                        <?php
                        if (is_array($product_order_details) && count($product_order_details) > 0) {
                        $i = 0;
                        foreach ($product_order_details as $product) {
                        $i++;
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $product['txn_id']?></td>
                            <td>
                            <?php 
                            $order_item = json_decode($product['order_item']); 
                            for($i=0; $i < count($order_item); $i++) {
                                $proQuery = $this->db->query("SELECT * FROM product WHERE id = '".$order_item[$i]->product_id."'")->result_array();
                                foreach ($proQuery as $proData) {?>
                                <p style="margin: 0px; text-align: end;">
                                    <?= $proData['product_name']." (".$order_item[$i]->size.") x".$order_item[$i]->quantity." = ".$order_item[$i]->price?>
                                </p>
                            <?php } } ?>
                                <p style="margin: 0px; text-align: end;">Shipping: <?= $product['shipping']; ?></p>
                                <p style="margin: 0px; text-align: end;">Tax: <?= number_format((float)$product['tax'], 2, '.', ''); ?></p>
                                <hr style="margin: 1px;">
                                <p style="margin: 0px; text-align: end;">Total: <?= number_format((float)$product['order_total'], 2, '.', ''); ?></p>
                            </td>
                            <td>
                            <?php 
                            $getUserdata = $this->db->query("SELECT fname, lname FROM users WHERE id = '".$product['user_id']."'")->row(); 
                            echo $getUserdata->fname." ".$getUserdata->lname;
                            ?>
                            </td>
                            <td>
                            <?php 
                            $getdeliveraddress = $this->db->query("SELECT * FROM user_address WHERE id = '".$product['user_addressid']."'")->row(); 
                            if($getdeliveraddress->shiptodifferentadd == 'on') { ?>
                                <p><b>Shipping Address:</b> <?= $getdeliveraddress->shipping_first_name." ".$getdeliveraddress->shipping_last_name.", ".$getdeliveraddress->shipping_company_name.", ".$getdeliveraddress->shipping_email.", ".$getdeliveraddress->shipping_phone.", ".$getdeliveraddress->shipping_address1.", ".$getdeliveraddress->shipping_address2.", ".$getdeliveraddress->shipping_city.", ".$getdeliveraddress->shipping_state.", ".$getdeliveraddress->shipping_country.", ".$getdeliveraddress->shipping_postcode ?></p>
                                <p><b>Billing Address:</b> <?= $getdeliveraddress->billing_first_name." ".$getdeliveraddress->billing_last_name.", ".$getdeliveraddress->billing_company_name.", ".$getdeliveraddress->billing_email.", ".$getdeliveraddress->billing_phone.", ".$getdeliveraddress->billing_address1.", ".$getdeliveraddress->billing_address2.", ".$getdeliveraddress->billing_city.", ".$getdeliveraddress->billing_state.", ".$getdeliveraddress->billing_country.", ".$getdeliveraddress->billing_postcode ?></p>
                            <?php } else { ?>

                            <?php } ?>
                            </td>
                            <td><?= $product['status']?></td>
                            <td><?= $product['created_date']?></td>
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