<section class="courseListpnl">
    <div class="container">
        <h2 class="subtitle  wow fadeInUp">Welcome, <?= $_SESSION['bayhill']['first_name']." ".$_SESSION['bayhill']['last_name']?></h2>
        <h2 class="subtitle  wow fadeInUp">Course List</h2>
        <h3 class="maintitle mb-4  wow fadeInUp">Your Purchased Course List</h3>
        <div class="row g-4">
            <?php
            if (!empty($getPurchasedCourseList)) {
            foreach ($getPurchasedCourseList as $purchsedList) {
            $course = $this->db->query("SELECT * FROM courses WHERE id = '".$purchsedList->course_id."'")->row();
            ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp">
                <div class="package-card">
                    <div class="package-card__head">
                        <div class="package-card__head__item">
                            <span class="discountBox">Save $<?= (int)$course->course_price - (int)$course->offer_price; ?></span>
                            <span class="package-card__head__item__price"> <sub>$</sub>
                            <?= $course->offer_price; ?></span>
                            <div class="package-card__head__item__shape__one">
                                <svg width="90" height="95" viewBox="0 0 90 95" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M90 -0.000350952L0 69.6066L90 94.9996V-0.000350952Z" fill="" fill-opacity="0.06" />
                                </svg>
                            </div>
                            <div class="package-card__head__item__shape__two">
                                <svg width="60" height="64" viewBox="0 0 60 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.789585 63.2843L59.4571 16.7158L0.00060816 0.747339L0.789585 63.2843Z" fill="" fill-opacity="0.06" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="package-card__body">
                        <h3 class="package-card__body__title"><?= $course->course_name; ?></h3>
                        <div class="pt-3">
                            <ul class="listBoxcourse">
                                <?php
                                $decodedContent = htmlspecialchars_decode($course->course_short_description);
                                echo $cleanedContent = str_replace(['<ul>', '</ul>'], '', $decodedContent);
                                ?>
                            </ul>
                            <div class="text-center mt-3"><a href="<?= base_url('course/course_details?cttle='.base64_encode($course->course_name))?>" class="text-warning fw-bold">Read More <i class="fas fa-arrow-right"></i></a></div>
                        </div>
                        <?php if($purchsedList->status != '1') { ?>
                        <div class="package-card__body__btn text-center">
                            <a href="<?= base_url() ?>payment-details?ctitle=<?= base64_encode($course->course_name)?>&uid=<?= base64_encode($purchsedList->user_id)?>&bookingID=<?= base64_encode($purchsedList->id)?>" class="drivschol-btn w-100">Complete this payment</a>
                        </div>
                        <?php } else { ?>
                        <div class="package-card__body__btn text-center">
                            <a href="javascript:void(0)" class="drivschol-btn w-100">Payment Complete</a>
                        </div>
                        <?php } ?>
                        <?php if(!empty($purchsedList->trainer_id)) {
                        $getTrainer = $this->db->query("SELECT * FROM users WHERE id = '".$purchsedList->trainer_id."'")->row();
                        ?>
                        <div class="package-card__body__btn text-center">
                            <a href="javascript:void(0)" class="drivschol-btn w-100">Assigned To <?= $getTrainer->salutation." ".$getTrainer->first_name." ".$getTrainer->last_name; ?></a>
                        </div>
                        <?php } else { ?>
                        <div class="package-card__body__btn text-center">
                            <a href="javascript:void(0)" class="drivschol-btn w-100">Trainer Not assigned</a>
                        </div>
                        <?php } ?>
                        <?php
                        $getBookingData = $this->db->query("SELECT * FROM booking WHERE user_id = '".@$_SESSION['bayhill']['user_id']."' AND course_id = '".@$course->id."'")->row();
                        if(!empty($getBookingData->transaction_id)){
                            $getBookingSlots = $this->db->query("SELECT * FROM booking_details WHERE booking_id = '".@$getBookingData->id."'")->result();
                            if($course->course_class > count($getBookingSlots)) { ?>
                            <div class="package-card__body__btn text-center">
                                <a href="<?= base_url() ?>booking_slot?ctitle=<?= base64_encode($course->course_name)?>&uid=<?= base64_encode($_SESSION['bayhill']['user_id'])?>&bookingid=<?= base64_encode($getBookingData->id)?>" class="drivschol-btn w-100">Book slot for pending classes</a>
                            </div>
                            <?php } else { ?>
                            <div class="col-lg-12 col-md-12 wow fadeInUp" style="text-align: center;margin-top: 15px;border: 1px solid #f59b24;border-radius: 18px;">
                                <?php
                                if(!empty($getBookingSlots)) {
                                    $i = 1;
                                    foreach ($getBookingSlots as $slot) { ?>
                                    <p style="margin: 0px;font-size: 14px;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time; ?></p>
                                <?php $i++; } } ?>
                            </div>
                            <?php }
                        } else { ?>
                        <div class="package-card__body__btn text-center">
                            <a href="javascript:void(0)" onclick="completePayment(<?= @$getBookingData->id ?>)" class="drivschol-btn w-100">Book slot for pending classes</a>
                        </div>
                        <div class="completePayment_<?= @$getBookingData->id ?>" style="display: none;text-align: center; margin-top: 20px; color: #ed1c24; font-size: 15px;">Please complete your payment first for this course to book pending slots.</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } } else { ?>
            <div class="col-lg-12 col-md-12 wow fadeInUp">No course purchased yet.</div>
            <?php } ?>
        </div>
    </div>
</section>
<script>
function completePayment(id) {
    $('.completePayment_'+id).show();
    setTimeout(function () {
        $('.completePayment_'+id).fadeOut('slow');
    }, 4000);
}
</script>