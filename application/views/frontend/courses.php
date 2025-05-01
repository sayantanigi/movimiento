<section class="courseListpnl">
    <div class="container">
        <h2 class="subtitle wow fadeInUp">Course List</h2>
        <h3 class="maintitle mb-4 wow fadeInUp">Driving Course Details and Offerings</h3>
        <div id="loader" style="display:none; text-align: center; position: absolute; z-index: 1; width: 100%;">
            <img src="<?= base_url() ?>assets/images/loader.gif" alt="Loading...">
        </div>
        <div class="row g-4" id="course_data_list" style="position: relative;">
            <?php
            if (!empty($course_list)) {
            foreach ($course_list as $course) { ?>
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
                            <div class="text-center mt-3"><a href="<?= base_url('course/course_details?pincode='.$pincode.'&course_type='.base64_encode($course_type).'&cttle='.base64_encode($course->course_name))?>" class="text-warning fw-bold">Read More <i class="fas fa-arrow-right"></i></a></div>
                        </div>
                        <?php if(!empty($_SESSION['bayhill']['user_id'])) {
                            $getBookingData = $this->db->query("SELECT * FROM booking WHERE user_id = '".@$_SESSION['bayhill']['user_id']."' AND course_id = '".@$course->id."'")->result();
                            if(!empty($getBookingData)) { ?>
                            <div class="package-card__body__btn text-center">
                                <a href="javascript:void(0)" class="drivschol-btn w-100">Already Booked</a>
                            </div>
                            <?php } else { ?>
                            <div class="package-card__body__btn text-center">
                                <a href="<?= base_url() ?>booking_slot?pincode=<?= $pincode ?>&course_type=<?= base64_encode($course_type)?>&ctitle=<?= base64_encode($course->course_name)?>&uid=<?= base64_encode($_SESSION['bayhill']['user_id'])?>" class="drivschol-btn w-100">Select Package</a>
                            </div>
                            <?php } ?>
                        <?php } else { ?>
                        <div class="package-card__body__btn text-center">
                            <a href="<?= base_url() ?>registration?pincode=<?= $pincode ?>&course_type=<?= base64_encode($course_type)?>&ctitle=<?= base64_encode($course->course_name)?>" class="drivschol-btn w-100">Select Package</a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } } else { ?>
            <div class="col-lg-12 col-md-12 wow fadeInUp">No data found related to <?= htmlspecialchars($pincode) ?> zipcode.</div>
            <?php } ?>
        </div>
    </div>
</section>
<style>
.drivschol-btn {line-height: 162.5%; border-radius: 30px; padding: 7px 46px; font-size: 15px; font-style: normal; font-weight: 600;}
.package-card__body__btn button::after {background-color: var(--theme-primary, #EC2526);}
.package-card__body__btn button:hover {color: var(--drivschol-white, #fff);}
</style>
<script>
function searchByPincode() {
    var pincode = $('#pincode').val();
    if (pincode != '') {
        $('#pincode').css({ 'border': '1px solid #000' });
        $.ajax({
            url: "<?= base_url('search_course') ?>",
            type: 'POST',
            data: { pincode: pincode },
            //dataType: 'json',
            beforeSend: function () {
                $('#course_data_list').html('');
                $('#loader').show();
                $('#loader').css('position', 'unset');
            },
            success: function (returndata) {
                setTimeout(() => {
                    $('#loader').hide();
                    $('#course_data_list').html(returndata).fadeIn(2000);
                }, 5000);
            }
        });
    } else {
        $('#pincode').css({ 'color': 'red', 'border': '1px solid red' });
        $('#pincode').prop('placeholder', 'Enter a valid ZIP code');
    }
}
</script>