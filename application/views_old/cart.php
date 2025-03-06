<main>
    <section class="signup__area po-rel-z1 pt-100 pb-145">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 mt-50">
                    <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">My Cart</h2>
                        <nav>
                            <ol class="breadcrumbnav mb-lg-0">
                                <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">My Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <?php if(!empty($cartItems)) { ?>
            <div class="cart-area">
                <div class="table-content table-responsive carttable">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Images</th>
                                <th class="cart-product-name">Product</th>
                                <th class="product-price">Unit Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody id="updateCart">
                            <?php $i = 1;
                            foreach ($cartItems as $item) { 
                            $product_details = $this->db->query("SELECT * FROM product WHERE id = '".$item['product_id']."'")->row();
                            ?>
                            <tr>
                                <td class="product-thumbnail">
                                    <a href="#" class="cartProductimg">
                                        <img src="<?= base_url()?>uploads/products/<?= $product_details->product_image?>" alt="">
                                    </a>
                                </td>
                                <td class="product-name">
                                    <a href="javascript:void(0)"><?= $product_details->product_name." (Size: ".$item['size'].")"?></a>
                                </td>
                                <td class="product-price">
                                    <span class="amount"><?= "$".number_format((float)$product_details->sale_price, 2, '.', '');?></span>
                                </td>
                                <td class="product-quantity text-center">
                                    <div class="product-quantity mt-10 mb-10">
                                        <div class="product-quantity-form">
                                            <form action="#">
                                                <button class="cart-minus" id="qntyminus_<?= $i?>"><i class="far fa-minus"></i></button>
                                                <input class="cart-input" id="qntyinput_<?= $i?>" type="text" value="<?= $item['quantity'] ?>" readonly>
                                                <button class="cart-plus" id="qntyplus_<?= $i?>"><i class="far fa-plus"></i></button>
                                                <!-- <input type="hidden"  id="pId_<?= $i?>" value="<?= $item['product_id']?>"/>
                                                <input type="hidden" id="prodprice_<?= $i?>" value="<?= number_format((float)$product_details->sale_price, 2, '.', '')?>"/> -->
                                                <p class="d-none" id="pId_<?= $i?>"><?= $item['product_id']?></p>
                                                <p class="d-none" id="prodprice_<?= $i?>"><?= number_format((float)$product_details->sale_price, 2, '.', '')?></p>
                                                <p class="d-none" id="cartId_<?= $i?>"><?= $item['id']?></p>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td class="product-subtotal">
                                    <span class="amount">
                                    <?php 
                                    $price = number_format((float)$product_details->sale_price, 2, '.', '');
                                    $total_price = $price * $item['quantity'];
                                    echo "$".number_format((float)$total_price, 2, '.', '')
                                    ?>
                                    </span>
                                </td>
                                <td class="product-remove"><a href="javascript:void(0)" class="text-danger" id="removeFromCart_<?= $i?>"><i class="fa fa-times"></i></a></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="coupon-all">
                            <div class="coupon d-sm-flex align-items-center">
                            <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                            <button class="e-btn" name="apply_coupon" type="submit">Apply
                                    coupon</button>
                            </div>
                            <div class="coupon2">
                            <button class="e-btn" name="update_cart" id="update_cart" type="submit">Update cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-5 ml-auto">
                        <div class="cart-page-total">
                            <h2>Cart totals</h2>
                            <ul class="mb-20 bg-white">
                            <?php 
                            $totalQry = $this->db->query("SELECT SUM(price) as total FROM cart WHERE user_id = '".$this->session->userdata('user_id')."'")->row();
                            $totalAmt = number_format((float)$totalQry->total, 2, '.', '');
                            ?>
                            <li>Subtotal <span>$<?= $totalAmt; ?></span></li>
                            <?php 
                            $shippingQry = $this->db->query("SELECT * FROM options WHERE option_name = 'shipping_charge'")->row();
                            $shippingAmt = number_format((float)$shippingQry->option_value, 2, '.', '');
                            ?>
                            <li>Shipping Charges <span>$<?= $shippingAmt; ?></span></li>
                            <?php 
                            $taxQry = $this->db->query("SELECT * FROM options WHERE option_name = 'tax'")->row();
                            $taxAmt = number_format((float)$taxQry->option_value, 2, '.', '');
                            $taxableamt = ($totalAmt * $taxAmt)/100
                            ?>
                            <li>Tax (<?= $taxAmt; ?>%)<span>$<?= $taxableamt; ?></span></li>
                            <li class="fw-bold">Total <span>$<?= $totalAmt +  $shippingAmt + $taxableamt; ?></span></li>
                            </ul>
                            <div class="text-end"><a class="e-btn" href="<?= base_url()?>checkout">Proceed to checkout</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="cart-area" style="text-align: center;">No items in the cart! Please add some products to continue.</div>
            <?php } ?>
        </div>
    </section>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    <?php $i = 1;
    foreach ($cartItems as $item) { ?>
        $('#qntyminus_<?= $i?>').click(function() {
            var pId = $('#pId_<?= $i?>').text();
            var price = $('#prodprice_<?= $i?>').text();
            var cartId = $('#cartId_<?= $i?>').text();
            var qnty = $('#qntyinput_<?= $i?>').val();
            $.ajax({
                url: '<?= base_url()?>Users/updateCart',
                method: "POST",
                data: {pId :pId, price: price, cartId: cartId, qnty: qnty},
                success: function(data){
                    //console.log(data);
                    //$('#updateCart').html(data);
                }
            })
        })

        $('#qntyplus_<?= $i?>').click(function() {
            var pId = $('#pId_<?= $i?>').text();
            var price = $('#prodprice_<?= $i?>').text();
            var cartId = $('#cartId_<?= $i?>').text();
            var qnty = $('#qntyinput_<?= $i?>').val();
            $.ajax({
                url: '<?= base_url()?>Users/updateCart',
                method: "POST",
                data: {pId :pId, price: price, cartId: cartId, qnty: qnty},
                success: function(data){
                    //console.log(data);
                }
            })
        })

        $('#removeFromCart_<?= $i?>').click(function() {
            var cartId = $('#cartId_<?= $i?>').text();
            $.ajax({
                url: '<?= base_url()?>Users/removeFromCart',
                method: "POST",
                data: {cartId :cartId},
                success: function(data){
                    console.log(data);
                    location.reload();
                }
            })
        })
    <?php $i++;
    } ?>

    $('#update_cart').click(function() {
        location.reload();
    })

    var url = window.location.href;
    var splitURL=url.toString().split("/");
    var splitURL = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    var txn = splitURL[1].split('=');
    var txnR = txn[1];
    var user_id = "<?= $this->session->userdata('user_id')?>";
    if(window.location.href.indexOf("status=success") > -1) {
        var baseUrl = "<?= base_url(); ?>";
        $.ajax({
            url: baseUrl + 'Users/purchasePorderSuccess',
            type: 'POST',
            data: {txnR: txnR, user_id: user_id},
            success: function(data) {
                if(data == 1) {
                    window.location.href = "<?= base_url()?>student-dashboard";
                }
            }
        });
    } else {
        var baseUrl = "<?= base_url(); ?>";
        $.ajax({
            url: baseUrl + 'Users/purchasePorderFailed',
            type: 'POST',
            data: {txnR: txnR, user_id: user_id},
            success: function(data) {
                if(data == 1) {
                    window.location.href = "<?= base_url()?>student-dashboard";
                }
            }
        });
    }
})
</script>