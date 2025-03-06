<?php
    $user_id = $this->session->userdata('user_id');
    $getUserDetails = $this->db->query("SELECT * FROM users where id = '".$user_id."' AND email_verified = '1' AND status = '1'")->row();
    //echo "<pre>"; print_r($getUserDetails); die();
    $isLoggedIn = $this->session->userdata('isLoggedIn');
    $catname = $this->db->query("SELECT * FROM sm_category WHERE id = '".$detail->cat_id."'")->row();
?>
<main>
    <section class="signup__area po-rel-z1 pt-150 pb-50">
        <div class="container">
            <div class="section__title-wrapper ">
                <span class="page__title-pre">Posted By:
                    <?php
                    if (!empty($eventDetails->user_id)) {
                        $userdetails = $this->db->query("SELECT * FROM users WHERE id = '" . $eventDetails->user_id . "'")->row();
                        echo $userdetails->fname . " " . $userdetails->lname;
                    } else {
                        echo "Admin";
                    } ?>
                </span>
                <h2 class="section__title text-capitalize">
                    <?= $eventDetails->event_name; ?>
                </h2>
                <nav>
                    <ol class="breadcrumbnav mb-lg-0">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/event">Events</a></li>
                        <li class="breadcrumb-item active"><a
                                href="<?= base_url() ?>event/<?= $eventDetails->event_slug; ?>">
                                <?= $eventDetails->event_name; ?>
                            </a></li>
                    </ol>
                </nav>
                <span class="evntdate">
                    <?= date('d M Y', strtotime($eventDetails->event_dt)); ?>
                </span> <span class="evnttime">
                    <?= date('h:i A', strtotime($eventDetails->from_time)) . " - " . date('h:i A', strtotime($eventDetails->to_time)) ?>
                </span>
            </div>
            <div class="my-4 eventsdetails">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-4">
                            <?php if (!empty($eventDetails->event_img)) { ?>
                                <img src="<?= base_url(); ?>uploads/event/<?= $eventDetails->event_img ?>"
                                    class="rounded w-100" style="height: 500px;">
                            <?php } else { ?>
                                <img src="<?= base_url(); ?>images/no_image.jpg" class="rounded w-100"
                                    style="height: 500px;">
                            <?php } ?>
                        </div>
                        <div>
                            <?= $eventDetails->event_desc; ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="course__sidebar pl-70 p-relative">
                            <div class="course__shape">
                                <img class="course-dot" src="<?= base_url(); ?>assets/img/course/course-dot.png" alt="">
                            </div>
                            <div class="course__sidebar-widget-2 white-bg mb-20">
                                <div class="course__video">
                                    <div class="course__video-thumb w-img mb-25">
                                        <?php if(!empty($eventDetails->event_img)) { ?>
                                        <img src="<?= base_url(); ?>uploads/event/<?= $eventDetails->event_img?>" class="rounded w-100" style="height: 155px;">
                                        <?php } else { ?>
                                        <img src="<?= base_url(); ?>images/no_image.jpg" class="rounded w-100" style="height: 155px;">
                                        <?php } ?>
                                        <?php if(!empty($eventDetails->video_file)) { ?>
                                        <div class="course__video-play"> 
                                        <?php 
                                        if(!empty($this->session->userdata('user_id'))) { 
                                        if($this->session->userdata('userType') == '1') { 
                                            $checkenrolled = $this->db->query("SELECT * FROM event_booked WHERE event_id = '".$eventDetails->id."' AND user_id = '".$this->session->userdata('user_id')."'")->result_array();
                                            if(!empty($checkenrolled)) { ?>
                                            <a href="<?= base_url()?>uploads/event/videos_file/<?= $eventDetails->video_file?>" data-fancybox="" class="play-btn"> 
                                                <i class="fas fa-play"></i> 
                                            </a>
                                            <?php } } } else { ?>
                                            <a href="<?= base_url()?>uploads/event/videos_file/<?= $eventDetails->video_file?>" data-fancybox="" class="play-btn" style="pointer-events: none; cursor: default; text-decoration: none; color: black;"> 
                                                <i class="fas fa-play"></i> 
                                            </a>
                                        <?php } ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="course__video-meta mb-25 d-flex align-items-center justify-content-between">
                                        <div class="course__video-price ">
                                            <?php if($eventDetails->event_type == "free") { ?>
                                            <h5 class="text-dark">$0.<span>00</span></h5>
                                            <?php } else { 
                                            $price = explode('.', $eventDetails->event_price)
                                            ?>
                                            <h5 class="text-dark">$<?= $price[0]?>.<span><?php if(!empty($price[1])) {echo $price[1]; } else { echo "00";} ?></span> </h5>
                                            <?php } ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="course__video-content mb-35">
                                        <ul>
                                            <li class="d-flex align-items-center">
                                                <div class="course__video-icon">
                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                                        <path class="st0" d="M2,6l6-4.7L14,6v7.3c0,0.7-0.6,1.3-1.3,1.3H3.3c-0.7,0-1.3-0.6-1.3-1.3V6z" />
                                                        <polyline class="st0" points="6,14.7 6,8 10,8 10,14.7 " />
                                                    </svg>
                                                </div>
                                                <div class="course__video-info">
                                                    <h5><span>Instructor :</span> 
                                                    <?php 
                                                    if(!empty($getCourse->user_id)) { 
                                                        $user_details = $this->db->query("SELECT id, fname, lname, image FROM users WHERE id = '".$getCourse->user_id."' AND email_verified = '1' AND status = '1'")->row();
                                                        echo $user_details->fname." ".$user_details->lname;
                                                    } else {
                                                        echo "Admin";
                                                    }
                                                    ?>
                                                    </h5>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <div class="course__video-icon">
                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                                        <circle class="st0" cx="8" cy="8" r="6.7" />
                                                        <polyline class="st0" points="8,4 8,8 10.7,9.3 " />
                                                    </svg>
                                                </div>
                                                <div class="course__video-info">
                                                    <h5><span>Duration :</span>
                                                    <?php 
                                                    $to_time = strtotime($eventDetails->to_time);
                                                    $from_time = strtotime($eventDetails->from_time);
                                                    echo round(abs($to_time - $from_time) / 60,2). " minutes";
                                                    ?>
                                                    </h5>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="course__enroll-btn">
                                    <?php
                                    if($this->session->userdata('userType') == '1') {
                                    if(!empty($isLoggedIn)) {
                                    $checkUserEnrolledSql = "SELECT `event`.`id`, `event_booked`.`id`, `event_booked`.`event_id`, `event_booked`.`user_id`,`event_booked`.`payment_status` FROM `event_booked` JOIN `event` ON `event`.`id` = `event_booked`.`event_id` WHERE `event`.`id` = '" . @$eventDetails->id . "' AND `event_booked`.`payment_status` = 'COMPLETED' and `event_booked`.`user_id` = '".@$this->session->userdata('user_id')."'";
                                    $checkUserenrollment = $this->db->query($checkUserEnrolledSql)->result_array();
                                    //print_r($checkUserenrollment);
                                    if(@$checkUserenrollment[0]['user_id'] == @$this->session->userdata('user_id')) { ?>
                                    <a href="<?php echo base_url()?>event-booked" class="e-btn e-btn-7 w-100">Go to Dashboard <i class="far fa-arrow-right"></i></a>
                                    <?php } else { 
                                    if (@$eventDetails->event_price != 'free') { ?>
                                    <!-- <form action="https://api.maxicashapp.com/PayEntryPost" method="POST"> -->
                                    <form action="https://api-testbed.maxicashapp.com/PayEntryPost" method="POST">
                                        <input type="hidden" name="PayType" value="MaxiCash">
                                        <input type="hidden" name="Amount" value="<?php echo (@$eventDetails->event_price*100)?>">
                                        <input type="hidden" name="Currency" value="MaxiDollar">
                                        <input type="hidden" name="Telephone" value="<?= $getUserDetails->phone?>">
                                        <input type="hidden" name="Email" value="<?= $getUserDetails->email?>">
                                        <input type="hidden" name="MerchantID" value="f00fab442fcc420ab3d04765bebe1818">
                                        <input type="hidden" name="MerchantPassword" value="dec9a3edff854eec82c2c354efc8ba9c">
                                        <input type="hidden" name="Language" value="En">
                                        <input type="hidden" name="Reference" value="txn_<?php echo rand()?>">
                                        <input type="hidden" name="accepturl" value="<?= base_url()?>event/<?= $eventDetails->event_slug?>">
                                        <input type="hidden" name="cancelurl" value="<?= base_url()?>event/<?= $eventDetails->event_slug?>">
                                        <input type="hidden" name="declineurl" value="<?= base_url()?>event/<?= $eventDetails->event_slug?>">
                                        <input type="hidden" name="notifyurl" value="<?= base_url()?>event/<?= $eventDetails->event_slug?>">
                                        <button type="submit" name="enrollment" class="e-btn e-btn-7 w-100">Enroll</button>
                                    </form>
                                    <?php } else { ?>
                                    <div class="btn-part">
                                        <a href="javascript:void(0)" class="e-btn e-btn-7 w-100" onclick="bookEvent()">Book Event <i class="far fa-arrow-right"></i></a>
                                        <input type="hidden" id="userId" value="<?= $this->session->userdata('user_id')?>">
                                        <input type="hidden" id="eventId" value="<?= $eventDetails->id?>"/>
                                        <input type="hidden" id="price" value="<?= $eventDetails->event_price?>"/>
                                    </div>
                                    <?php } } } else {
                                    if (@$eventDetails->event_price != 'free') { ?>
                                    <form action="<?= base_url('login/') ?>" method="post" id="form_validation33" enctype="multipart/form-data">
                                        <div class="btn-part">
                                            <button type="submit" name="enrollment" value="<?php echo @$detail->price_key; ?>"  class="e-btn e-btn-7 w-100">Enroll</button>
                                        </div>
                                    </form>
                                    <?php } else { ?>
                                    <div class="btn-part">
                                        <a href="<?= base_url('login/') ?>" name="enrollment" id="event_activation1"  class="e-btn e-btn-7 w-100">Activate</a>
                                    </div>
                                <?php } } } else if(empty($this->session->userdata('userType'))) { ?>
                                    <div class="btn-part">
                                        <a href="<?= base_url('login/') ?>" name="enrollment" id="event_activation1"  class="e-btn e-btn-7 w-100">Activate</a>
                                    </div>
                                <?php } ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
function bookEvent() {
    var user_id = $('#userId').val();
    var event_id = $('#eventId').val();
    var price = $('#price').val();
    var baseUrl = "<?= base_url(); ?>";
    $.ajax({
        url: baseUrl + 'Home/purchaseEvent',
        type: 'POST',
        data: {user_id: user_id, event_id: event_id, price: price},
        success: function(data) {
            if(data == 1) {
                location.reload();
            }
        }
    });
}
$(document).ready(function(){
    var url = window.location.href;
    var splitURL=url.toString().split("/");
    var splitURL = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    var txn = splitURL[1].split('=');
    var txnR = txn[1];
    var event_id = "<?= $eventDetails->id?>"; alert(event_id);
    var user_id = "<?= $this->session->userdata('user_id')?>"; alert(user_id);
    var price = "<?= $eventDetails->event_price?>"; alert(price);
    if(window.location.href.indexOf("status=success") > -1) {
        var baseUrl = "<?= base_url(); ?>";
        $.ajax({
            url: baseUrl + 'Home/purchaseMEvent',
            type: 'POST',
            data: {txnR: txnR, event_id: event_id, user_id: user_id, price: price},
            success: function(data) {
                if(data == 1) {
                    window.location.href = "<?= base_url()?>event-booked";
                }
            }
        });
    }
})
</script>