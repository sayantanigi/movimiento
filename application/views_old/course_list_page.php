<?php
$user_id = $this->session->userdata('user_id');
$getUserDetails = $this->db->query("SELECT * FROM users where id = '" . $user_id . "' AND email_verified = '1' AND status = '1'")->row();
$isLoggedIn = $this->session->userdata('isLoggedIn');
//$catname = $this->db->query("SELECT * FROM sm_category WHERE id = '" . @$detail->cat_id . "'")->row();
?>
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="<?= base_url() ?>assets/img/page-title/page-title-2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                    <h3 class="page__title">Course List</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Course List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="course__area pt-0 pb-0">
    <div class="container" style="padding: 80px 0;">
        <div class="row">
            <div class="col-3">
                <div class="CourseFilter">
                    <div class="wrapper">
                        <nav class="filters">
                        </nav>
                        <nav class="refinements">
                            <a href="javascript:void(0);" class="category1">
                                <span>Category</span>
                                <svg viewBox="0 0 512 512">
                                    <use xlink:href="#right-arrow" />
                                </svg>
                            </a>
                            <nav>
                                <?php if(!empty($category_list)) {
                                foreach ($category_list as $catval) { ?>
                                <a href="javascript:void(0);" onclick="getcatwiseData(<?= $catval['id']?>)"><span><?= $catval['category_name']?></span>
                                    <div class="Block"></div>
                                    <input type="hidden" id="cat_id" value="<?= $catval['id']?>">
                                </a>
                                <?php } } else { ?>
                                <a href="javascript:void(0);"><span>No category found</span>
                                    <div class="Block"></div>
                                </a>
                                <?php } ?>
                            </nav>
                            <a href="javascript:void(0);" class="category2">
                                <span>Price</span>
                                <svg viewBox="0 0 512 512">
                                    <use xlink:href="#right-arrow" />
                                </svg>
                            </a>
                            <nav style="padding: 15px 15px 20px 15px;">
                                <div class="price-input">
                                    <div class="field">
                                        <span>Min</span>
                                        <input type="number" class="input-min" value="2500">
                                    </div>
                                    <div class="separator">-</div>
                                    <div class="field">
                                        <span>Max</span>
                                        <input type="number" class="input-max" value="7500">
                                    </div>
                                </div>
                                <div class="slider">
                                    <div class="progress"></div>
                                </div>
                                <div class="range-input">
                                    <input type="range" class="range-min" min="0" max="10000" value="2500" step="100">
                                    <input type="range" class="range-max" min="0" max="10000" value="7500" step="100">
                                </div>
                            </nav>
                            <a href="javascript:void(0);" class="category3 d-none">
                                <span>Lesson</span>
                                <svg viewBox="0 0 512 512">
                                    <use xlink:href="#right-arrow" />
                                </svg>
                            </a>
                            <nav class="d-none">
                                <a href="javascript:void(0);"><span>Short dress (178)</span></a>
                                <a href="javascript:void(0);"><span>Mid Dress (201)</span></a>
                                <a href="javascript:void(0);"><span>Long Dress (47)</span></a>
                                <a href="javascript:void(0);"><span>Maxi Dress (104)</span></a>
                            </nav>
                            <a href="javascript:void(0);" class="category3">
                                <span>Rating</span>
                                <svg viewBox="0 0 512 512">
                                    <use xlink:href="#right-arrow" />
                                </svg>
                            </a>
                            <nav>
                                <a href="javascript:void(0);">
                                    <span>Select All</span>
                                    <div class="Block"></div>
                                </a>
                                <a href="javascript:void(0);" onclick="getratewiseData(1)"><span>1 Star</span>
                                    <div class="Block"></div>
                                </a>
                                <a href="javascript:void(0);" onclick="getratewiseData(2)"><span>2 Star</span>
                                    <div class="Block"></div>
                                </a>
                                <a href="javascript:void(0);" onclick="getratewiseData(3)"><span>3 Star</span>
                                    <div class="Block"></div>
                                </a>
                                <a href="javascript:void(0);" onclick="getratewiseData(4)"><span>4 Star</span>
                                    <div class="Block"></div>
                                </a>
                                <a href="javascript:void(0);" onclick="getratewiseData(4)"><span>5 Star</span>
                                    <div class="Block"></div>
                                </a>
                            </nav>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="row" id="filter_data">
                <?php if (!empty($course_list)) {
                foreach ($course_list as $value) {
                    $catname = $this->db->query("SELECT * FROM sm_category WHERE id = '" . $value->cat_id . "'")->row(); ?>
                    <div class="col-md-4 col-sm-12 grid-item cat1 cat2 cat4">
                        <div class="course__item white-bg mb-30 fix">
                            <div class="course__thumb w-img p-relative fix">
                                <a href="<?= base_url('course-detail/' . @$value->id) ?>">
                                    <?php if (!empty($value->image)) { ?>
                                        <img src="<?= base_url() ?>assets/images/courses/<?= $value->image ?>" alt="" style="width: 282px; height: 190px;">
                                    <?php } else { ?>
                                        <img src="<?= base_url() ?>assets/images/no-image.png" alt="">
                                    <?php } ?>
                                </a>
                                <div class="course__tag">
                                    <a href="javascript:void(0)"><?= $catname->category_name ?></a>
                                </div>
                            </div>
                            <div class="course__content">
                                <div class="course__meta d-flex align-items-center justify-content-between">
                                    <div class="course__lesson">
                                        <?php
                                        $module = $this->db->query("SELECT count(id) as total_module FROM course_modules WHERE course_id = '" . $value->id . "'")->row();
                                        if (!empty($module)) {
                                            $count = $module->total_module;
                                        } else {
                                            $count = '0';
                                        }
                                        ?>
                                        <span><i class="far fa-book-alt"></i><?= $count; ?> Lesson</span>
                                    </div>
                                    <div class="course__rating">
                                        <?php
                                        $rating = $this->db->query("SELECT * FROM course_reviews WHERE course_id = '" . $value->id . "'")->result_array();
                                        $totalrate = $this->db->query("SELECT SUM(rating) as total FROM course_reviews WHERE course_id = '" . $value->id . "'")->row();
                                        if (!empty($rating)) {
                                            $rate = round($totalrate->total / count($rating), 0);
                                            foreach (range(1, 5) as $i) {
                                                if ($rate > 0) {
                                                    echo '<span class="active"><i class="fas fa-star"></i></span>';
                                                } else {
                                                    echo '<span><i class="fas fa-star zero"></i></span>';
                                                }
                                                $rate--;
                                            }
                                            echo "(" . round($totalrate->total / count($rating), 0) . ")";
                                        } else {
                                            echo '<span><i class="fas fa-star zero"></i></span>';
                                            echo '<span><i class="fas fa-star zero"></i></span>';
                                            echo '<span><i class="fas fa-star zero"></i></span>';
                                            echo '<span><i class="fas fa-star zero"></i></span>';
                                            echo '<span><i class="fas fa-star zero"></i></span>';
                                            echo "(0)";
                                        } ?>
                                    </div>
                                </div>
                                <h3 class="course__title"><a href="<?= base_url('course-detail/' . @$value->id) ?>"><?= $value->title ?></a></h3>
                                <?php if (!empty($value->user_id)) {
                                    $user_details = $this->db->query("SELECT id, full_name, image FROM users WHERE id = '" . $value->user_id . "' AND email_verified = '1' AND status = '1'")->row(); ?>
                                    <div class="course__teacher d-flex align-items-center">
                                        <div class="course__teacher-thumb mr-15">
                                            <?php if (!empty($user_details->image)) { ?>
                                                <img src="<?= base_url() ?>uploads/users/<?= $user_details->image ?>" alt="">
                                            <?php } else { ?>
                                                <img src="<?= base_url() ?>images/no-user.png" alt="">
                                            <?php } ?>
                                        </div>
                                        <h6><a href="javascript:void(0)"><?= $user_details->full_name ?></a></h6>
                                    </div>
                                <?php } else { ?>
                                    <div class="course__teacher d-flex align-items-center">
                                        <div class="course__teacher-thumb mr-15">
                                            <img src="<?= base_url() ?>assets/img/favicon.png" alt="">
                                        </div>
                                        <h6><a href="javascript:void(0)">Admin</a></h6>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="course__more d-flex justify-content-between align-items-center">
                                <div class="course__status">
                                    <?php if ($value->course_fees == 'free') { ?>
                                        <span><?= ucwords($value->course_fees) ?></span>
                                    <?php } else { ?>
                                        <span><?= "$" . ucwords($value->price) ?>100</span>
                                    <?php } ?>
                                </div>
                                <div class="course__btn">
                                    <a href="<?= base_url('course-detail/' . @$value->id) ?>" class="link-btn">
                                        Know Details
                                        <i class="far fa-arrow-right"></i>
                                        <i class="far fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } else { ?>
                    <p style="font-size: larger; color: #d3e0d4; text-align: center;">No course added yet</p>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--SVG definitions-->
<svg width="0" height="0" class="screen-reader">
    <defs>
        <polygon id="right-arrow" points="418.999,256.001 121.001,462 121.001,50 " />
        <polygon id="close" points="438.393,374.595 319.757,255.977 438.378,137.348 374.595,73.607 255.995,192.225 137.375,73.622 73.607,137.352 192.246,255.983 73.622,374.625 137.352,438.393 256.002,319.734 374.652,438.378 " />
        <polygon id="arrow-pointy" points="302.313,95.548 185.758,95.548 301.908,212.254 50,212.254 50,299.746 301.908,299.746 185.758,416.452 302.313,416.452 462,256 " />
        <polygon id="tick" points="37.316,80.48 0,43.164 17.798,25.366 37.316,44.885 82.202,0 100,17.798 37.316,80.48 " />
    </defs>
</svg>
<style>
    /* Filter Style */
    .zero {
        color: #ddd !important;
    }
    .screen-reader {
        position: absolute;
        top: -9999px;
        left: -9999px;
    }
    a {
        text-decoration: none;
        display: inline-block;
        box-sizing: border-box;
    }
    header a svg {
        width: 24px;
        fill: #fff;
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
        vertical-align: middle;
        float: left;
        height: 24px;
    }
    .filters {
        padding: 0;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        width: 100%;
    }
    .filters p {
        margin-bottom: 6px;
    }
    .filters a {
        display: inline-block;
        background: #69b55d;
        padding: 5px 10px;
        margin: 0 5px 5px 0;
        position: relative;
        border-radius: 3px;
    }
    .filters a span {
        color: #fff;
        font-size: 14px;
    }
    .filters a svg {
        width: 10px;
        height: 10px;
        fill: #fff;
        position: absolute;
        right: 1px;
        top: 1px;
    }
    .refinements a {
        padding: 12px;
        width: 100%;
        color: #000;
        text-transform: uppercase;
        box-shadow: 0px 0px 40px 0px rgba(1, 11, 60, 0.06);
        margin-bottom: 10px;
    }
    .refinements a .Block {
        position: absolute;
        width: 20px;
        height: 20px;
        border: 1.8px solid #7bce8a;
        border-radius: 5px;
        right: 11px;
        top: 13px;
    }
    .refinements a[class*="category"] svg {
        width: 13px;
        float: right;
        fill: #333;
        padding-top: 4px;
        height: 20px;
    }
    .refinements a.active {
        font-weight: bold;
        background-color: #000;
        color: #83d893;
    }
    .refinements a.active svg {
        transform: rotate(90deg);
        -webkit-transform: rotate(90deg);
        fill: #83d893;
    }
    .refinements nav {
        display: none;
        box-shadow: 0px 0px 40px 0px rgba(1, 11, 60, 0.06);
        margin-bottom: 10px;
    }
    .refinements nav a {
        position: relative;
        border-bottom: none;
        text-transform: capitalize;
        box-shadow: none;
        margin-bottom: 0;
    }
    .refinements nav a.selected {
        color: #519946;
        background: #ebf5e9;
    }
    .refinements nav a svg {
        fill: #69b55d;
        position: absolute;
        top: 15px;
        right: 13px;
        width: 15px;
        height: 18px;
    }
    /* Price Slider Style */
    .range-input {
        position: relative;
    }
    .range-input input {
        position: absolute;
        width: 100%;
        height: 5px;
        top: -5px;
        background: none;
        pointer-events: none;
    }
    input[type="range"]::-webkit-slider-thumb {
        height: 17px;
        width: 17px;
        border-radius: 50%;
        /* background: #17a2b8; */
        pointer-events: auto;
        -webkit-appearance: none;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
    }
    input[type="range"]::-moz-range-thumb {
        height: 17px;
        width: 17px;
        border: none;
        border-radius: 50%;
        /* background: #17a2b8; */
        pointer-events: auto;
        -moz-appearance: none;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
    }
    .price-input {
        width: 100%;
        display: flex;
        margin-bottom: 20px;
    }
    .price-input .field {
        display: flex;
        width: 100%;
        height: 30px;
        align-items: center;
    }
    .field input {
        width: 100%;
        height: 100%;
        outline: none;
        font-size: 14px;
        margin-left: 10px;
        border-radius: 5px;
        text-align: center;
        border: 1px solid #83d893;
        -moz-appearance: textfield;
    }
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
    .price-input .separator {
        width: 100px;
        display: flex;
        font-size: 20px;
        align-items: center;
        justify-content: center;
    }
    .slider {
        height: 5px;
        position: relative;
        background: #ddd;
        border-radius: 5px;
    }
    .slider .progress {
        height: 100%;
        left: 25%;
        right: 25%;
        position: absolute;
        border-radius: 5px;
        background: #83d893;
    }
    .range-input {
        position: relative;
    }
    .range-input input {
        position: absolute;
        width: 100%;
        height: 5px;
        top: -5px;
        background: none;
        pointer-events: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
    input[type="range"]::-webkit-slider-thumb {
        height: 17px;
        width: 17px;
        border-radius: 50%;
        background: #83d893;
        pointer-events: auto;
        -webkit-appearance: none;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
    }
    input[type="range"]::-moz-range-thumb {
        height: 17px;
        width: 17px;
        border: none;
        border-radius: 50%;
        background: #83d893;
        pointer-events: auto;
        -moz-appearance: none;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<!-- Filter Script -->
<script>
    if (typeof jQuery != 'undefined') {
        $(document).ready(function() {
            $(document).ready(function() {
                var noOfCats = $(".refinements").children('a').length;
                for (var i = 0; i < noOfCats; i++) {
                    $(".category" + [i]).click(function() {
                        $(this).next().slideToggle("250");
                        $(this).toggleClass("active");
                        $(this).next().toggleClass("active");
                    });
                }
            });
            $(".refinements nav a").click(function() {
                var filterText = $(this).text();
                var n = filterText.indexOf("(");
                var uniqueID = filterText.toLowerCase().replace(/[\*\^\'\!\&\£\-]/g, '').split(' ').join('');
                var isItselected = $(this).attr('class');
                if (isItselected != "selected") {
                    $(this).addClass("selected");
                    $(this).append("<svg viewBox='5.0 -8.048 100.0 108.648'><use xlink:href='#tick' /></svg>");
                    var newFilterBut = "<a href='javascript:void(0);' id='label-" + (uniqueID) + "'><span>" + (filterText) + "</span><svg viewBox='0 0 512 512'><use xlink:href='#close' /></svg></a>";
                    $(newFilterBut).appendTo(".filters");
                    $(this).attr("id", ("label-" + uniqueID));
                    var totalAnchors = $(".filters a").length;
                    console.log("There are " + totalAnchors + " anchors");
                    if (totalAnchors === 1) {
                        $(".refinements").css('margin-top', 0);
                        $(".filters").css('margin-bottom', 0);
                    }
                } else {
                    $(this).removeClass("selected");
                    $(".refinements #label-" + uniqueID + " svg").remove();
                    $(".filters #label-" + uniqueID).remove();
                }
            });
            $(".filters").on("click", "a", function() {
                $(this).remove();
                var idTag = $(this).attr("id");
                $(".refinements .active" + idTag).removeClass("selected");
                $(".refinements .active" + idTag + " svg").remove();
            });
        });
    } else {
        console.error('jQuery is not loaded.');
    }
</script>
<!-- Price Slider Script -->
<script>
const rangeInput = document.querySelectorAll(".range-input input"),
priceInput = document.querySelectorAll(".price-input input"),
range = document.querySelector(".slider .progress");
let priceGap = 1000;
priceInput.forEach((input) => {
    input.addEventListener("input", (e) => {
        let minPrice = parseInt(priceInput[0].value),
            maxPrice = parseInt(priceInput[1].value);
        if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
            if (e.target.className === "input-min") {
                rangeInput[0].value = minPrice;
                range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
            } else {
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});
rangeInput.forEach((input) => {
    input.addEventListener("input", (e) => {
        let minVal = parseInt(rangeInput[0].value),
            maxVal = parseInt(rangeInput[1].value);
        if (maxVal - minVal < priceGap) {
            if (e.target.className === "range-min") {
                rangeInput[0].value = maxVal - priceGap;
            } else {
                rangeInput[1].value = minVal + priceGap;
            }
        } else {
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});

function getcatwiseData(cat_id) {
    $.ajax({
        url: "<?= base_url()?>home/getcatwiseData",
        type: "POST",
        data: {cat_id: cat_id},
        success: function (data) {
            $('#filter_data').html(data);
        }

    })
}

function getratewiseData(rate_id) {
    $.ajax({
        url: "<?= base_url()?>home/getcatwiseData",
        type: "POST",
        data: {rate_id: rate_id},
        success: function (data) {
            $('#filter_data').html(data);
        }

    })
}
</script>