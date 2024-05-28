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
            <div class="producstPnl mb-60">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-4 h3 fw-bold">Best Selling T-Shirts</h2>
                    <div class="ms-2 mb-3"><a href="<?= base_url()?>product_list" class="btn btn-outline-light btn-sm">View All</a>
                    </div>
                </div>
                <div class="owl-carousel owl-theme" id="prolist1">
                <?php if(!empty($bestSale)) { 
                foreach ($bestSale as $value) { 
                    if (@$value['product_image'] && file_exists('./uploads/products/' . @$value['product_image'])) {
                        $image = base_url('/uploads/products/' . @$value['product_image']);
                    } else {
                        $image = base_url('assets/images/no-image.png');
                    } ?>
                    <div class="item">
                        <div class="productlistBox">
                            <div class="pListImgbox">
                                <a href="<?= base_url()?>product_details/<?php echo $value['id'];?>" class="productlistImg">
                                    <img src="<?php echo $image;?>">
                                </a>
                                <a href="<?= base_url()?>product_details/<?php echo $value['id'];?>" class="pListCart shadow">View Details</a>
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
                    <?php } } ?>
                </div>
            </div>
            <div class="mb-60">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-4 h3 fw-bold">Premium Bag Collection</h2>
                    <div class="ms-2 mb-3"><a href="<?= base_url()?>product_list" class="btn btn-outline-light btn-sm">View All</a>
                    </div>
                </div>
                <div class="row g-4">
                    <?php if(!empty($premiumBag)) { 
                    foreach ($premiumBag as $value1) {
                    if (@$value1['product_image'] && file_exists('./uploads/products/' . @$value1['product_image'])) {
                        $image1 = base_url('/uploads/products/' . @$value1['product_image']);
                    } else {
                        $image1 = base_url('assets/images/no-image.png');
                    } ?>
                    <div class="col-lg-6 col-md-6 col-6">
                        <div class="productlistBox">
                            <div class="pListImgbox">
                                <a href="<?= base_url()?>product_details/<?php echo $value1['id'];?>" class="productlistImg">
                                    <img src="<?php echo $image1;?>">
                                </a>
                                <a href="<?= base_url()?>product_details/<?php echo $value1['id'];?>" class="pListCart shadow">View Details</a>
                            </div>
                            <h3 class="productlistTitle"><a href="<?= base_url()?>product_details/<?php echo $value1['id'];?>"><?= $value1['product_name'];?></a></h3>
                            <div class="d-md-flex justify-content-between">
                                <p class="pListPrice">$<?= $value1['sale_price']?> <del class="text-slate-400">$<?= $value1['mrp']?></del></p>
                                <div class="productListRate">
                                    <?php 
                                    $rating = $this->db->query("SELECT * FROM product_review WHERE product_id = '".$value1['id']."'")->result_array();
                                    $totalrate = $this->db->query("SELECT SUM(rating) as total FROM product_review WHERE product_id = '".$value1['id']."'")->row();
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
                    <?php } } ?>
                </div>
            </div>
            <div class="producstPnl mb-60">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-4 h3 fw-bold">Best Hat Collection</h2>
                    <div class="ms-2 mb-3"><a href="<?= base_url()?>product_list" class="btn btn-outline-light btn-sm">View All</a>
                    </div>
                </div>
                <div class="owl-carousel owl-theme" id="prolist2">
                <?php if(!empty($hat)) { 
                    foreach ($hat as $value2) {
                    if (@$value2['product_image'] && file_exists('./uploads/products/' . @$value2['product_image'])) {
                        $image2 = base_url('/uploads/products/' . @$value2['product_image']);
                    } else {
                        $image2 = base_url('assets/images/no-image.png');
                    } ?>
                    <div class="item">
                        <div class="productlistBox">
                            <div class="pListImgbox">
                                <a href="<?= base_url()?>product_details/<?php echo $value2['id'];?>" class="productlistImg">
                                    <img src="<?php echo $image2;?>">
                                </a>
                                <a href="<?= base_url()?>product_details/<?php echo $value2['id'];?>" class="pListCart shadow">View Details</a>
                            </div>
                            <h3 class="productlistTitle"><a href="<?= base_url()?>product_details/<?php echo $value2['id'];?>"><?= $value2['product_name'];?></a></h3>
                            <div class="d-md-flex justify-content-between">
                                <p class="pListPrice">$<?= $value2['sale_price']?> <del class="text-slate-400">$<?= $value2['mrp']?></del></p>
                                <div class="productListRate">
                                    <?php 
                                    $rating = $this->db->query("SELECT * FROM product_review WHERE product_id = '".$value2['id']."'")->result_array();
                                    $totalrate = $this->db->query("SELECT SUM(rating) as total FROM product_review WHERE product_id = '".$value2['id']."'")->row();
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
                    <?php } } ?>
                </div>
            </div>
            <div class="mb-60">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-4 h3 fw-bold">Latest Gift Collection </h2>
                    <div class="ms-2 mb-3"><a href="<?= base_url()?>product_list" class="btn btn-outline-light btn-sm">View All</a>
                    </div>
                </div>
                <div class="row g-4">
                <?php if(!empty($product)) { 
                    foreach ($product as $value3) {
                    if (@$value3['product_image'] && file_exists('./uploads/products/' . @$value3['product_image'])) {
                        $image3 = base_url('/uploads/products/' . @$value3['product_image']);
                    } else {
                        $image3 = base_url('assets/images/no-image.png');
                    } ?>
                    <div class="col-lg-6 col-md-6 col-6">
                        <div class="productlistBox">
                            <div class="pListImgbox">
                                <a href="<?= base_url()?>product_details/<?php echo $value3['id'];?>" class="productlistImg">
                                    <img src="<?php echo $image3;?>">
                                </a>
                                <a href="<?= base_url()?>product_details/<?php echo $value3['id'];?>" class="pListCart shadow">View Details</a>
                            </div>
                            <h3 class="productlistTitle"><a href="<?= base_url()?>product_details/<?php echo $value3['id'];?>"><?= $value3['product_name'];?></a></h3>
                            <div class="d-md-flex justify-content-between">
                                <p class="pListPrice">$<?= $value3['sale_price']?> <del class="text-slate-400">$<?= $value3['mrp']?></del></p>
                                <div class="productListRate">
                                    <?php 
                                    $rating = $this->db->query("SELECT * FROM product_review WHERE product_id = '".$value3['id']."'")->result_array();
                                    $totalrate = $this->db->query("SELECT SUM(rating) as total FROM product_review WHERE product_id = '".$value2['id']."'")->row();
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
                    <?php } } ?>
                </div>
            </div>
        </div>
    </section>
</main>