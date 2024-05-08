 <div class="main-content">
            <!-- Breadcrumbs Start -->
            <div class="rs-breadcrumbs breadcrumbs-overlay">
                <div class="breadcrumbs-img">
                    <img src="assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
                </div>
                <div class="breadcrumbs-text white-color">
                    <h1 class="page-title">Reviews</h1>
                    <ul>
                        <li>
                            <a class="active" href="index.html">Home</a>
                        </li>
                        <li>Reviews</li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
            function timeAgo($time_ago) 
            {
                $time_ago =  strtotime($time_ago) ? strtotime($time_ago) : $time_ago;
                $time  = time() - $time_ago;
        
                switch($time):
                    // seconds
                    case $time <= 60;
                    return 'Just Now';
                    // minutes
                    case $time >= 60 && $time < 3600;
                    return (round($time/60) == 1) ? 'a minute' : round($time/60).' minutes ago';
                    // hours
                    case $time >= 3600 && $time < 86400;
                    return (round($time/3600) == 1) ? 'a hour ago' : round($time/3600).' hours ago';
                    // days
                    case $time >= 86400 && $time < 604800;
                    return (round($time/86400) == 1) ? 'a day ago' : round($time/86400).' days ago';
                    // weeks
                    case $time >= 604800 && $time < 2600640;
                    return (round($time/604800) == 1) ? 'a week ago' : round($time/604800).' weeks ago';
                    // months
                    case $time >= 2600640 && $time < 31207680;
                    return (round($time/2600640) == 1) ? 'a month ago' : round($time/2600640).' months ago';
                    // years
                    case $time >= 31207680;
                    return (round($time/31207680) == 1) ? 'a year ago' : round($time/31207680).' years ago' ;
        
                endswitch;
            }
        ?>

        <section class="intro-section py-5 loaded">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 mb-3">
                        <div class="sidebar shadow-sm">
                    <?php include("usr-menu.php"); ?>
                </div>
                    </div>
                    <div class="col-lg-9">
                        <div>
                            <div>
                                <div class="d-flex justify-content-between">
                                    <h3>Reviews</h3>
                                </div>

                                <div class="dashboard-reviews">
                                    <?php
                                        if(!empty($reviews)) {
                                            foreach ($reviews as $key => $value) {

                                                if (@$value->image && file_exists('./assets/images/courses/' . @$value->image)) {
                                                    $image = base_url('assets/images/courses/' . @$value->image);
                                                } else {
                                                    $image = base_url('./images/noimage.jpg');
                                                }

                                                $rating = $value->rating;

                                    ?>
                                    <div class="dashboard-review-item mb-3">
                                        <div class="dashboard-review-item__thumbnail">
                                            <img src="<?php echo @$image; ?>" alt="Courses" width="150" height="100">
                                        </div>
                                        <div class="dashboard-review-item__content">
                                            <div class="dashboard-review-item__title-wrap">
                                                <h2 class="dashboard-review-item__title"> <a href="javascript:void(0);"><?php echo @$value->title; ?></a></h2>
                                                <!-- <div class="dashboard-review-item__review-links">
                                                    <a href="#"><i class="fa fa-pencil"></i>  <span>Edit Feedback</span></a>
                                                </div> -->
                                            </div>
                                            <div class="dashboard-review-item__rating">
                                                <div class="courserate">
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
                                                    <!-- <span><i class="fa fa-star active"></i></span>
                                                    <span><i class="fa fa-star active"></i></span>
                                                    <span><i class="fa fa-star active"></i></span>
                                                    <span><i class="fa fa-star active"></i></span>
                                                    <span><i class="fa fa-star"></i></span> -->
                                                </div>
                                                <p class="text-muted"><?php echo timeAgo($value->review_date); ?></p>
                                            </div>
                                            <div class="dashboard-review-item__text">
                                                <p><?php echo @$value->review_message; ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <?php } } else  { echo"<div class='text-danger' style='text-align: center;'>No review found!</div>"; } ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <style>
            .stars {
                color: #ff7501;
                font-size: 1.2em;
            }
            .courserate span i {
                color: coral;
            }
        </style>