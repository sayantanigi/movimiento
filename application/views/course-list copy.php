<div class="main-content">
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url() ?>user_assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title">Courses</h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url() ?>">Home</a>
                </li>
                <li>Courses</li>
            </ul>
        </div>
    </div>
</div>
<div id="rs-services" class="rs-popular-courses style3 pt-50 pb-100 md-pt-70 md-pb-70">
    <div class="container">
        <div class="row mt-50">
            <div class="col-lg-3 col-md-12 col-sm-12 mb-5">
                <div class="Filter-Box p-3 mb-3">
                    <span class="Filter-Box-Mask"></span>
                    <div class="Filter-Box-Dta">
                        <input type="text" class="form-control" id="search_course" name="search_course" placeholder="Search Courses">
                        <button type="button" class="btn btn-info mt-3 w-100" onclick="search_data()">SEARCH</button>
                    </div>
                </div>
                <div class="Filter-Box p-3 mb-3">
                    <span class="Filter-Box-Mask"></span>
                    <div class="Filter-Box-Dta">
                        <button type="button" id="sortby" class="btn btn-info w-100 IconDown">SORT BY</button>
                        <ul class="m-0 p-0 Filter-Option1 mt-2">
                            <li>
                                <input type="checkbox" id="shortByChkBox" value="new_first" name="sortby[1][]" onclick="shortByChkBox(this.value)">
                                <label class="m-0">Newest First</label>
                            </li>
                            <li>
                                <input type="checkbox" id="shortByChkBox" value="old_first" name="sortby[1][]" onclick="shortByChkBox(this.value)">
                                <label class="m-0">Oldest First</label>
                            </li>
                            <li>
                                <input type="checkbox" id="shortByChkBox" value="most_relevant" name="sortby[1][]" onclick="shortByChkBox(this.value)">
                                <label class="m-0">Most Relevant</label>
                            </li>
                            <li>
                                <input type="checkbox" id="shortByChkBox" value="most_popular" name="sortby[1][]" onclick="shortByChkBox(this.value)">
                                <label class="m-0">Most Popular</label>
                            </li>
                            <li>
                                <input type="checkbox" id="shortByChkBox" value="top_rated_first" name="sortby[1][]" onclick="shortByChkBox(this.value)">
                                <label class="m-0">Top Rated First</label>
                            </li>
                            <li>
                                <input type="checkbox" id="shortByChkBox" value="price_high_to_low" name="sortby[1][]" onclick="shortByChkBox(this.value)">
                                <label class="m-0">Price High to Low</label>
                            </li>
                            <li>
                                <input type="checkbox" id="shortByChkBox" value="price_low_to_high" name="sortby[1][]" onclick="shortByChkBox(this.value)">
                                <label class="m-0">Price Low to High</label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="Filter-Box p-3">
                    <span class="Filter-Box-Mask"></span>
                    <div class="Filter-Box-Dta">
                        <button type="button" id="filterby" class="btn btn-info w-100 IconDown">FILTER BY</button>
                        <ul class="m-0 p-0 Filter-Option2 mt-2">
                            <?php 
                            if(!empty($course_cat)) { 
                                foreach ($course_cat as $cat) { ?>
                            <li>
                                <input type="checkbox" id="<?php echo $cat['slug']; ?>" value="<?php echo $cat['id']; ?>" name="filterby[1][]" onclick="filterByChkBox(this.value)">
                                <label class="m-0"><?php echo $cat['name']; ?></label>
                            </li>
                            <?php } } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12">
                <div class="row show_filter_data">
                <?php 
                if(!empty($list)) {
                    foreach ($list as $key => $value) {
                        if (@$value->image && file_exists('./assets/images/courses/' . @$value->image)) {
                            $image = base_url('assets/images/courses/' . @$value->image);
                        } else {
                            $image = base_url('./images/noimage.jpg');
                        }
                        // Get Average Rating.
                        $getAverageRatingSql = "SELECT ROUND(AVG(rating),1) as averageRating FROM `course_reviews` where `course_id` = '" . @$value->id . "'";
                        $ratingRow = $this->db->query($getAverageRatingSql)->row();
                        $averageRating = @$ratingRow->averageRating;
                        $rating = @$ratingRow->averageRating;
                        // Total user enroll
                        $totalEnrolledSql = "SELECT * FROM `course_enrollment` WHERE `course_id` = '" . @$value->id . "' AND `payment_status` = 'COMPLETED'";
                        $totalEnrolledUsr = $this->db->query($totalEnrolledSql)->num_rows();
                ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 mb-40">
                        <div class="courses-item">
                            <div class="img-part">
                                <img src="<?php echo @$image; ?>" alt="Course Image...">
                            </div>
                            <div class="content-part">
                                <h3 class="title truncate2 m-0">
                                    <a href="<?=base_url('course-detail/'.@$value->id)?>"><?php if(@$value->title) { echo strip_tags($value->title); } ?></a>
                                </h3>
                                <ul class="meta-part m-0">
                                    <li class="user">
                                        <img src="<?php echo base_url('user_assets/images/C2C_Home/Tag_Blue.png');?>">
                                    </li>
                                    <li><span class="price">
                                    <?php if(@$value->course_type == 'free') {
                                        echo "Free";
                                    } else {
                                        echo '$'.number_format($value->price, 2);
                                    }
                                    ?></span></li>
                                </ul>
                                <div class="bottom-part">
                                    <div class="info-meta">
                                        <ul>
                                            <li class="ratings">
                                            <?php
                                            echo "<span class='stars'>";
                                            for ( $i = 1; $i <= 5; $i++ ) {
                                                if ( round( $rating - .25 ) >= $i ) {
                                                    echo "<i class='fa fa-star'></i>"; //fas fa-star for v5
                                                } elseif ( round( $rating + .25 ) >= $i ) {
                                                    echo "<i class='fa fa-star-half-o'></i>"; //fas fa-star-half-alt for v5
                                                } else {
                                                    echo "<i class='fa fa-star-o'></i>"; //far fa-star for v5
                                                }
                                            }
                                            echo '</span>';
                                            ?>
                                            (<?php echo @$averageRating; ?>)
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="btn-part">
                                        <a href="<?=base_url('course-detail/'.@$value->id)?>">
                                            <span>
                                                View Details
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="siteURL" value="<?= base_url(); ?>">
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" async="" src="<?php echo base_url();?>user_assets/js/course-list.js"></script>