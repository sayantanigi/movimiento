<?php

if (!empty($reviewList)) {
    foreach ($reviewList as $key => $value) {
        $rating = $value->rating;
?>
        <div class="cource-review-box mb-30">
            <h4 style="font-size: 18px;"><?php echo $value->fname . " " . $value->lname; ?></h4>
            <div class="rating333">
                <span class="total-rating" style="color: #0e151a;"><?php echo @$value->rating; ?></span> 
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
            </div>
            <div class="text"><?php echo $value->review_message; ?></div>

        </div>
<?php }
} ?>

<style>
    /* .cource-review-box .rating .fa {
        color: #FFD700;
    } */
    .stars {
        color: #ff7501;
        font-size: 1.2em;
    }
 </style>