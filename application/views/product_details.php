<main>
    <section class="signup__area po-rel-z1 pt-100 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 mt-50">
                    <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">Store</h2>
                        <nav>
                            <ol class="breadcrumbnav mb-lg-0">
                                <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Store</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-5">
                    <?php
                    if (@$productDetails[0]['product_image'] && file_exists('./uploads/products/' . @$productDetails[0]['product_image'])) {
                        $image = base_url('/uploads/products/' . @$productDetails[0]['product_image']);
                    } else {
                        $image = base_url('assets/images/no-image.png');
                    } ?>
                    <img src="<?= $image?>" class="img-fluid">
                </div>
                <div class="col-lg-7 ps-lg-5 productdetails">
                    <h1 class="h2 fw-bold"><?= @$productDetails[0]['product_name']?></h1>
                    <div class="d-md-flex">
                        <p class="pListPrice">$<?= @$productDetails[0]['sale_price']?> <del class="text-slate-400">$<?= @$productDetails[0]['mrp']?></del></p>
                        <div class="productListRate ms-md-4">
                        <?php 
                        $rating = $this->db->query("SELECT * FROM product_review WHERE product_id = '".$productDetails[0]['id']."'")->result_array();
                        $totalrate = $this->db->query("SELECT SUM(rating) as total FROM product_review WHERE product_id = '".$productDetails[0]['id']."'")->row();
                        if(!empty($rating)) {
                        $rate = round($totalrate->total/count($rating), 0); 
                        foreach (range(1,5) as $i) { 
                        if($rate > 0) { ?>
                        <span class="active"><i class="fas fa-star"></i></span>
                        <?php } else { ?>
                        <span><i class="fas fa-star"></i></span>
                        <?php } $rate--; } ?>
                        <?php } else { ?>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="mt-4 ">
                        <h4>Overview :</h4>
                        <div class="text-light"><?= @$productDetails[0]['overview']?></div>
                        <div class="mb-4">
                            <div class="d-flex sizeSelect align-items-center mb-4">
                                <label class="me-2" style="min-width: 80px;">Size:</label>
                                <?php $getQuantity = $this->db->query("SELECT * FROM product_details WHERE product_id = '".$productDetails[0]['id']."'")->result_array();
                                if($getQuantity) { ?>
                                <select class="form-control form-select" id="selectSize">
                                    <option value="">Select</option>
                                    <?php foreach ($getQuantity as $qnty) { ?>
                                    <option value="<?= $qnty['size']?>"><?= $qnty['size']?></option>
                                    <?php } } ?>
                                </select>
                                <input type="hidden" id="stock" value="">
                                <input type="hidden" id="pId" value="<?= $productDetails[0]['id']?>">
                                <input type="hidden" id="price" value="<?= $productDetails[0]['sale_price']?>">
                            </div>
                            <div class="d-flex align-items-center">
                                <label class="me-2" style="min-width: 80px;">Quantity:</label>
                                <div class="qty-input">
                                    <button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
                                    <input class="product-qty" type="number" name="product-qty" id="product_qty" min="0" max="100" value="1">
                                    <button class="qty-count qty-count--add" data-action="add" type="button">+</button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <?php if(empty($this->session->userdata('isLoggedIn'))) { ?>
                            <a href="<?= base_url()?>login" class="e-btn addcartbtn">Add to Cart</a>
                            <?php } else { ?>
                            <a href="javascript:void(0)" class="e-btn addcartbtn" onclick="addToCart()">Add to Cart</a>
                            <input type="hidden" id="user_id" value="<?= $this->session->userdata('user_id')?>">
                            <?php } ?>
                        </div>
                        <div class="error-message"></div>
                    </div>
                </div>
            </div>
            <div class="accordianpDetails mt-4">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <?php if(!empty($productDetails[0]['description'])) { ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Description</button>
                    </li>
                    <?php } ?>
                    <?php if(!empty($productDetails[0]['additional_information'])) { ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Additional Information</button>
                    </li>
                    <?php } ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Review</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div><?= @$productDetails[0]['description']?></div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"><?= @$productDetails[0]['additional_information']?></div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="reviewBox">
                            <?php
                            $checkReview = $this->db->query("SELECT * FROM product_review WHERE product_id = '".$productDetails[0]['id']."'")->result_array();
                            if(!empty($checkReview)) { 
                            foreach ($checkReview as $review) { ?>
                            <div class="reviews-list">
                                <div class="productListRate">
                                    <?php foreach (range(1,5) as $i) { 
                                    if($review['rating'] > 0) { ?>
                                    <span class="active"><i class="fas fa-star"></i></span>
                                    <?php } else { ?>
                                    <span><i class="fas fa-star"></i></span>
                                    <?php } $review['rating']--; } ?>
                                </div>
                                <p><?= $review['comment']?></p>
                                <h5>
                                <?php
                                $getuserDetail = $this->db->query("SELECT * FROM users WHERE id = '".$review['user_id']."'")->row();
                                echo "- ".$getuserDetail->fname."  ".$getuserDetail->lname;
                                ?>
                                </h5>
                            </div>
                            <?php } } else { 
                            if(empty($this->session->userdata('user_id'))) { ?>
                            No Review
                            <?php } } ?>
                        </div>
                        <?php if(!empty($this->session->userdata('user_id'))) { ?>
                        <div class="row" style="padding-top: 40px; border-top: 1px solid;">
                            <div class="col-lg-8">
                                <h3>Leave A Comment:</h3>
                                <form>
                                    <div class="row g-4">
                                        <div class="col-lg-6">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" id='fname' name='fname' placeholder="First Name" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" id='lname' name='lname' placeholder="Last Name" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Email Address</label>
                                            <input type="email" class="form-control" id='email' name='email' placeholder="Email Address" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Rating</label>
                                            <select class="form-control form-select" id='rating' name='rating' required>
                                                <option value="">Select</option>
                                                <option value="5">5 Stars</option>
                                                <option value="4">4 Stars</option>
                                                <option value="3">3 Stars</option>
                                                <option value="2">2 Stars</option>
                                                <option value="1">1 Star</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Your Comment</label>
                                            <textarea class="form-control" rows="5" id='comment' name='comment' required></textarea>
                                            <input type="hidden" id="product_id" name="product_id" value="<?= @$productDetails[0]['id']?>"/>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="button" class="e-btn" id="submitReview">Submit</button>
                                        </div>
                                        <div id="successmsg"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <?php 
                    $relatedProduct = $this->db->query("SELECT * FROM product WHERE categori_id = '".@$productDetails[0]['categori_id']."' AND id != '".@$productDetails[0]['id']."' AND status = '1'")->result_array();
                    if(!empty($relatedProduct)) {
                    ?>
                    <div class="producstPnl mb-60 mt-60">
                        <div>
                            <h2 class="mb-4 h3 fw-bold text-center">Related Products</h2>
                        </div>
                        <div class="owl-carousel owl-theme" id="prolist1">
                            <?php foreach ($relatedProduct as $key => $value) { 
                            if (@$value['product_image'] && file_exists('./uploads/products/' . @$value['product_image'])) {
                                $image1 = base_url('/uploads/products/' . @$value['product_image']);
                            } else {
                                $image1 = base_url('assets/images/no-image.png');
                            } ?>
                            <div class="item">
                                <div class="productlistBox">
                                    <div class="pListImgbox">
                                        <a href="<?= base_url()?>product_details/<?php echo $value['id'];?>" class="productlistImg">
                                            <img src="<?php echo $image1;?>">
                                        </a>
                                        <a href="#" class="pListCart shadow">Add to Cart</a>
                                    </div>
                                    <h3 class="productlistTitle"><a href="<?= base_url()?>product_details/<?php echo $value['id'];?>"><?= $value['product_name'];?></a></h3>
                                    <div class="d-md-flex justify-content-between">
                                        <p class="pListPrice">$<?= $value['sale_price']?> <del class="text-slate-400">$<?= $value['mrp']?></del></p>
                                        <div class="productListRate">
                                        <?php 
                                        $rating = $this->db->query("SELECT * FROM product_review WHERE product_id = '".$value['id']."'")->result_array();
                                        $totalrate = $this->db->query("SELECT SUM(rating) as total FROM product_review WHERE product_id = '".$value['id']."'")->row();
                                        if(!empty($rating)) {
                                        $rate = round($totalrate->total/count($rating), 0); 
                                        foreach (range(1,5) as $i) { 
                                        if($rate > 0) { ?>
                                        <span class="active"><i class="fas fa-star"></i></span>
                                        <?php } else { ?>
                                        <span><i class="fas fa-star"></i></span>
                                        <?php } $rate--; } ?>
                                        <?php } else { ?>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } else { ?>
                    <div class="producstPnl mb-60 mt-60">No releted product found</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</main>
<style>
.text-light * {color: #fff;}
.error-message {margin-top: 15px;color: #db3636;}
#pills-contact ::-webkit-scrollbar {width: 6px;}
#pills-contact ::-webkit-scrollbar-track {box-shadow: inset 0 0 5px grey; border-radius: 10px;}
#pills-contact ::-webkit-scrollbar-thumb {background: #db3636; border-radius: 10px;}
#pills-contact ::-webkit-scrollbar-thumb:hover {background: #b30000;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    var QtyInput = (function () {
    var $qtyInputs = $(".qty-input");
    if (!$qtyInputs.length) {
        return;
    }
    var $inputs = $qtyInputs.find(".product-qty");
    var $countBtn = $qtyInputs.find(".qty-count");
    var qtyMin = parseInt($inputs.attr("min"));
    var qtyMax = parseInt($inputs.attr("max"));

    $inputs.change(function () {
        var $this = $(this);
        var $minusBtn = $this.siblings(".qty-count--minus");
        var $addBtn = $this.siblings(".qty-count--add");
        var qty = parseInt($this.val());
        if (isNaN(qty) || qty <= qtyMin) {
            $this.val(qtyMin);
            $minusBtn.attr("disabled", true);
        } else {
            $minusBtn.attr("disabled", false);
            if(qty >= qtyMax){
                $this.val(qtyMax);
                $addBtn.attr('disabled', true);
            } else {
                $this.val(qty);
                $addBtn.attr('disabled', false);
            }
        }
    });

    $countBtn.click(function () {
        var operator = this.dataset.action;
        var $this = $(this);
        var $input = $this.siblings(".product-qty");
        var qty = parseInt($input.val());
        if (operator == "add") {
            qty += 1;
            if (qty >= qtyMin + 1) {
                $this.siblings(".qty-count--minus").attr("disabled", false);
            }
            if (qty >= qtyMax) {
                $this.attr("disabled", true);
            }
        } else {
            qty = qty <= qtyMin ? qtyMin : (qty -= 1);
            if (qty == qtyMin) {
                $this.attr("disabled", true);
            }
            if (qty < qtyMax) {
                $this.siblings(".qty-count--add").attr("disabled", false);
            }
        }
        $input.val(qty);
    });
})();
$(document).ready(function(){
    $('.error-message').hide() // Hide it initially
    $('#selectSize').change(function() {
        var pId = $('#pId').val();
        var size = $(this).val();
        $.ajax({
            method: 'POST',
            url: '<?= base_url()?>Home/getQuantityBySize',
            cache: false,
            data: {pId: pId, size: size},
            success: function(data){
                $('#stock').val(data);
            }
        })
    })

    $("#submitReview").click(function(){
        let fname = $("#fname").val();
        let lname = $("#lname").val();
        let email = $("#email").val();
        let rating = $("#rating").val();
        let comment = $("#comment").val();
        let product_id = $("#product_id").val();
        $.ajax({
            method:"post",
            url: "<?php echo base_url('users/submitReview') ?>",
            data:{fname: fname, lname: lname, email:email, rating:rating, comment:comment, product_id:product_id},
            success:function(data){
                if(data == 1) {
                    $('#successmsg').append('Review posted successfully');
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                } else if(data == 2) {
                    $('#successmsg').append('You have already reviewed this product');
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                } else {
                    $('#successmsg').append('Something went wrong! Please try again later');
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
            }
        })
    })
})
function addToCart() {
    var pid = $('#pId').val();
    var size = $('#selectSize').val();
    var stock = $('#stock').val();
    var quantity = $('#product_qty').val();
    var price = $('#price').val();
    var user_id = $('#user_id').val();
    if(size.length > 0) {
        if(parseInt(quantity) > parseInt(stock)) {
            $('.error-message').show().html('Sorry! This product is out of stock');
            setTimeout(() => {
                $('.error-message').hide();
            }, 3000);
            return false;
        } else {
            $.ajax({
                url: "<?php echo base_url('users/addToCartFromProductPage') ?>",
                type: "POST",
                data: {pid: pid, size: size, quantity: quantity, user_id: user_id, price: price} ,
                dataType: "json",
                success: function(response) {
                    //console.log(response);
                    if(response == 1) {
                        window.location="<?php echo base_url('cart')?>";
                    }else{
                        alert("Error");
                    }
                },
                error: function() {
                    alert("Error");
                }
            });
        }
    } else {
        $('.error-message').show().html('Please select size');
        setTimeout(() => {
            $('.error-message').hide();
        }, 3000);
    }
}
</script>