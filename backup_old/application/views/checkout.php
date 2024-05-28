<?php
    $user_id = $this->session->userdata('user_id');
    $getUserDetails = $this->db->query("SELECT * FROM users where id = '".$user_id."' AND email_verified = '1' AND status = '1'")->row();
    //echo "<pre>"; print_r($getUserDetails); die();
    $isLoggedIn = $this->session->userdata('isLoggedIn');
    $catname = $this->db->query("SELECT * FROM sm_category WHERE id = '".$detail->cat_id."'")->row();
?>
<main>
    <section class="signup__area po-rel-z1 pt-100 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 mt-50">
                    <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">Checkout</h2>
                        <nav>
                            <ol class="breadcrumbnav mb-lg-0">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout-area pb-70">
        <div class="container">
            <!-- <form action="<?php echo base_url()?>Users/savecheckoutData" method="POST" id="idForm"> -->
            <form action="https://api-testbed.maxicashapp.com/PayEntryPost" method="POST" id="idForm">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="checkbox-form bg-white text-dark p-4">
                            <h3 class="text-danger">Billing Details</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>First Name <span class="required">*</span></label>
                                        <input type="text" placeholder="First Name" name="billing_first_name" id="billing_first_name" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Last Name <span class="required">*</span></label>
                                        <input type="text" placeholder="Last Name" name="billing_last_name" id="billing_last_name" required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Company Name</label>
                                        <input type="text" placeholder="Company Name" name="billing_company_name" id="billing_company_name" required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Address <span class="required">*</span></label>
                                        <input type="text" placeholder="Street address" name="billing_address1" id="billing_address1" required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <input type="text" placeholder="Apartment, suite, unit etc. (optional)" name="billing_address2" id="billing_address2" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Town / City <span class="required">*</span></label>
                                        <input type="text" placeholder="Town / City" name="billing_city" id="billing_city" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>State / County <span class="required">*</span></label>
                                        <input type="text" placeholder="State / County" name="billing_state" id="billing_state" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Country <span class="required">*</span></label>
                                        <input type="text" placeholder="Country" name="billing_country" id="billing_country" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Postcode / Zip <span class="required">*</span></label>
                                        <input type="text" placeholder="Postcode / Zip" name="billing_postcode" id="billing_postcode" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input type="email" placeholder="Email Address" name="billing_email" id="billing_email" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text" placeholder="Phone" name="billing_phone" id="billing_phone" required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list create-acc">
                                        <input id="cbox" type="checkbox" name="account" id="account"/>
                                        <label>Create an account?</label>
                                    </div>
                                    <div id="cbox_info" class="checkout-form-list create-account">
                                        <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                        <label>Account password <span class="required">*</span></label>
                                        <input type="password" placeholder="password" name="password" id="password"/>
                                    </div>
                                </div>
                            </div>
                            <div class="different-address">
                                <div class="ship-different-title">
                                    <h3>
                                        <label class="text-danger">Ship to a different address?</label>
                                        <input id="ship-box" type="checkbox" name="shiptodifferentadd"/>
                                    </h3>
                                </div>
                                <div id="ship-box-info">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>First Name <span class="required">*</span></label>
                                                <input type="text" placeholder="First Name" name="shipping_first_name" id="shipping_first_name" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Last Name <span class="required">*</span></label>
                                                <input type="text" placeholder="Last Name" name="shipping_last_name" id="shipping_last_name" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Company Name</label>
                                                <input type="text" placeholder="Company Name" name="shipping_company_name" id="shipping_company_name" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Address <span class="required">*</span></label>
                                                <input type="text" placeholder="Street address" name="shipping_address1" id="shipping_address1" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <input type="text" placeholder="Apartment, suite, unit etc. (optional)" name="shipping_address2" id="shipping_address2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Town / City <span class="required">*</span></label>
                                                <input type="text" placeholder="Town / City" name="shipping_city" id="shipping_city" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>State / County <span class="required">*</span></label>
                                                <input type="text" placeholder="State / County" name="shipping_state" id="shipping_state" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Country <span class="required">*</span></label>
                                                <input type="text" placeholder="Country" name="shipping_country" id="shipping_country" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Postcode / Zip <span class="required">*</span></label>
                                                <input type="text" placeholder="Postcode / Zip" name="shipping_postcode" id="shipping_postcode" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Email Address <span class="required">*</span></label>
                                                <input type="email" placeholder="Email Address" name="shipping_email" id="shipping_email" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Phone <span class="required">*</span></label>
                                                <input type="text" placeholder="Phone" name="shipping_phone" id="shipping_phone" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-notes">
                                    <div class="checkout-form-list">
                                        <label>Order Notes</label>
                                        <textarea id="checkout-mess" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery." name="order_note" id="order_note"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="your-order mb-30  bg-white text-dark p-4">
                            <h3 class="text-danger">Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-name fw-bold">Product</th>
                                            <th class="product-total fw-bold">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        $items = array();
                                        foreach ($cartItems as $key => $item) { 
                                        $product_details = $this->db->query("SELECT * FROM product WHERE id = '".$item['product_id']."'")->row();
                                        $items[$key]['id'] = $item['id'];
                                        $items[$key]['user_id'] = $item['user_id'];
                                        $items[$key]['product_id'] = $item['product_id'];
                                        $items[$key]['size'] = $item['size'];
                                        $items[$key]['quantity'] = $item['quantity'];
                                        $items[$key]['price'] = $item['price']; 
                                        ?>
                                        <tr class="cart_item">
                                            <td class="product-name"><?= $product_details->product_name." (Size: ".$item['size'].")"?><strong class="product-quantity"> × <?= $item['quantity'] ?></strong>
                                            </td>
                                            <td class="product-total">
                                                <span class="amount"><?= "$".number_format((float)$item['price'], 2, '.', '');?></span>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <?php 
                                            $totalQry = $this->db->query("SELECT SUM(price) as total FROM cart WHERE user_id = '".$this->session->userdata('user_id')."'")->row();
                                            $totalAmt = number_format((float)$totalQry->total, 2, '.', '');
                                            ?>
                                            <td><span class="amount">$<?= $totalAmt; ?></span></td>
                                        </tr>
                                        <tr class="shipping">
                                            <th>Shipping</th>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <?php 
                                                        $shippingQry = $this->db->query("SELECT * FROM options WHERE option_name = 'shipping_charge'")->row();
                                                        $shippingAmt = number_format((float)$shippingQry->option_value, 2, '.', '');
                                                        ?>
                                                        <input type="radio" checked/>
                                                        <label>
                                                            Flat Rate: <span class="amount">$<?= $shippingAmt; ?></span>
                                                        </label>
                                                    </li>
                                                    <!-- <li>
                                                        <input type="radio" />
                                                        <label>Free Shipping:</label>
                                                    </li>
                                                    <li></li> -->
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="shipping">
                                            <?php 
                                            $taxQry = $this->db->query("SELECT * FROM options WHERE option_name = 'tax'")->row();
                                            $taxAmt = number_format((float)$taxQry->option_value, 2, '.', '');
                                            $taxableamt = ($totalAmt * $taxAmt)/100
                                            ?>
                                            <th>Tax (<?= $taxAmt; ?>%)</th>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <label><span class="tax">$<?= $taxableamt; ?></span></label>
                                                    </li>
                                                    <!-- <li>
                                                        <input type="radio" />
                                                        <label>Free Shipping:</label>
                                                    </li>
                                                    <li></li> -->
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th class="fw-bold">Order Total</th>
                                            <td><span class="amount">$<?= $totalPrice = $totalAmt + $shippingAmt + $taxableamt; ?></span> </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="order-button-payment mt-20">
                                <button type="submit" class="e-btn" id="placeOrder">Place order</button>
                                <input type="hidden" name='user_id' value="<?= $this->session->userdata('user_id')?>">
                                <input type="hidden" name="order_item" value='<?= json_encode($items);?>'>
                                <input type="hidden" name='subtotal' value=<?php echo $totalAmt;?>>
                                <input type="hidden" name="shipping" value="<?= $shippingAmt; ?>">
                                <input type="hidden" name="tax" value="<?= $taxableamt; ?>">
                                <input type="hidden" name="order_total" value="<?= $totalPrice?>">

                                <input type="hidden" name="PayType" value="MaxiCash">
                                <input type="hidden" name="Amount" value="<?php echo (@$totalPrice*100)?>">
                                <input type="hidden" name="Currency" value="MaxiDollar">
                                <input type="hidden" name="Telephone" value="<?= $getUserDetails->phone?>">
                                <input type="hidden" name="Email" value="<?= $getUserDetails->email?>">
                                <input type="hidden" name="MerchantID" value="f00fab442fcc420ab3d04765bebe1818">
                                <input type="hidden" name="MerchantPassword" value="dec9a3edff854eec82c2c354efc8ba9c">
                                <input type="hidden" name="Language" value="En">
                                <input type="hidden" name="Reference" value="txn_<?php echo rand()?>">
                                <input type="hidden" name="accepturl" value="<?= base_url()?>cart">
                                <input type="hidden" name="cancelurl" value="<?= base_url()?>cart">
                                <input type="hidden" name="declineurl" value="<?= base_url()?>cart">
                                <input type="hidden" name="notifyurl" value="<?= base_url()?>cart">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#placeOrder').click(function(e) {
        //e.preventDefault(); 
        var form = $('#idForm');
        $.ajax({
            type: "POST",
            url: "<?php base_url() ?>users/savecheckoutData1",
            data: form.serialize(), // serializes the form's elements.
            success: function(data) {
                return true;
            }
        });
    })
})
</script>