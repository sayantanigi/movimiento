<?php
$getCourse = $this->db->query("SELECT * FROM courses WHERE id = '".$course_id."'")->row();
$site_setting = $this->db->query("select * from  settings")->row();
?>
<section class="enrollPnl">
    <div class="container">
        <!-- <div class="text-success-msg f-20">
            <?php if ($this->session->flashdata('message')) {
                echo '<h3 class="h3 fw-bold mb-2  wow fadeInUp" style="text-align: center; font-size: 18px; padding: 10px; background: green; border-radius: 20px; margin-bottom: 30px; color: #fff;">'.$this->session->flashdata('message').'</h3>';
                unset($_SESSION['message']);
            } ?>
            <?php if ($this->session->flashdata('error')) {
                echo '<h3 class="h3 fw-bold mb-2  wow fadeInUp" style="text-align: center; font-size: 18px; padding: 10px; background: red; border-radius: 20px; margin-bottom: 30px; color: #fff;">'.$this->session->flashdata('error').'</h3>';
                unset($_SESSION['error']);
            } ?>
        </div> -->
        <h2 class="subtitle  wow fadeInUp">Payment Details</h2>
        <h3 class="maintitle mb-5  wow fadeInUp">Enter your payment information</h3>
        <form action="<?php echo base_url() ?>create-payment?ctitle=<?= base64_encode($getCourse->course_name)?>&uid=<?= base64_encode($user_id)?>" method="POST" id="createpaymentForm">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <div class="courseBlock mb-5">
                                <div class="courseBlockcontent w-100">
                                    <img src="assets/images/serviceicon/serv-01.png" class="courblockicon">
                                    <h2><a href="#"><?= $getCourse->course_name; ?></a></h2>
                                    <p>Course Week: <span><?= $getCourse->course_week; ?></span></p>
                                    <p>Classes per Week: <span><?= $getCourse->class_week; ?></span></p>
                                    <p>Price: <span>$ <?= $getCourse->offer_price; ?></span></p>
                                </div>
                            </div>
                            <table class="table paytable">
                                <tbody>
                                    <tr>
                                        <td class="border-top">Subtotal:</td>
                                        <td class="border-top text-end">$ <?= $getCourse->offer_price; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tax:</td>
                                        <td class="text-end">$ <?= $site_setting->tax_amount; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-top fw-semibold">Total payable amount:</td>
                                        <td class="border-top text-end h5 text-primary fw-semibold">$ <?= $getCourse->offer_price + $site_setting->tax_amount; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="p-lg-5 p-4 shadow-lg rounded-4">
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <label class="mb-2">Card Number</label>
                                <input type="text" class="form-control" placeholder="Card Number" name="card_number" id="card_number">
                                <div id="vld_card_number"></div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-4">
                                <label class="mb-2">CVV</label>
                                <input type="text" class="form-control" placeholder="Enter CVV" name="cvv" id="cvv">
                                <div id="vld_cvv"></div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-4">
                                <label class="mb-2">Expiry Date</label>
                                <input type="text" class="form-control" placeholder="MM/YYYY" name="expiry_date" id="expiry_date">
                                <div id="vld_expiry_date"></div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <div class="form-check form-switch form-check-success">
                                    <input class="form-check-input" type="checkbox" role="switch" id="terms">
                                    <label class="form-check-label text-primary" for="terms">By proceeding, you confirm that you have read and agree to BayHill Terms of Use and Privacy Notice.</label>
                                    <div id="vld_terms"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button class="enrollbtn" type="submit">Book for $ <?= $getCourse->offer_price + $site_setting->tax_amount; ?></button>
                                <input type="hidden" id="course_id" name="course_id" value="<?= $getCourse->id; ?>">
                                <input type="hidden" id="user_id" name="user_id" value="<?= $user_id; ?>">
                                <input type="hidden" id="booking_id" name="booking_id" value="<?= $booking_id; ?>">
                                <input type="hidden" id="price" name="price" value="<?= $getCourse->offer_price; ?>">
                                <input type="hidden" id="tax" name="tax" value="<?= $site_setting->tax_amount; ?>">
                                <input type="hidden" id="total_payment" name="total_payment" value="<?= $getCourse->offer_price + $site_setting->tax_amount; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<script>
$(document).ready(function() {
    $('#createpaymentForm').submit(function (e) {
        e.preventDefault();
        var isValid = true;
        var cardNumber = $('#card_number').val().replace(/\s+/g, '');
        var cvv = $('#cvv').val();
        var expiryDate = $('#expiry_date').val();
        var terms = $('#terms').is(':checked');

        // Card number validation (Luhn algorithm)
        function luhnCheck(cardNumber) {
            let sum = 0;
            let shouldDouble = false;
            for (let i = cardNumber.length - 1; i >= 0; i--) {
                let digit = parseInt(cardNumber[i]);
                if (shouldDouble) {
                    digit *= 2;
                    if (digit > 9) {
                        digit -= 9;
                    }
                }
                sum += digit;
                shouldDouble = !shouldDouble;
            }
            return sum % 10 === 0;
        }

        // Validate card number
        if (cardNumber === '' || !luhnCheck(cardNumber)) {
            $('#vld_card_number').text('Please enter a valid card number').css('color', 'red').show();
            $('#card_number').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_card_number").hide(); }, 2000);
            isValid = false;
        } else {
            $('#card_number').css('border', '1px solid green');
        }

        // Validate CVV (3 or 4 digits)
        if (cvv === '' || !/^\d{3,4}$/.test(cvv)) {
            $('#vld_cvv').text('Please enter a valid CVV').css('color', 'red').show();
            $('#cvv').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_cvv").hide(); }, 2000);
            isValid = false;
        } else {
            $('#cvv').css('border', '1px solid green');
        }

        // Validate expiry date (MM/YYYY)
        if (expiryDate === '' || !/^\d{2}\/\d{4}$/.test(expiryDate)) {
            $('#vld_expiry_date').text('Please enter a valid expiry date in MM/YYYY format.').css('color', 'red').show();
            $('#expiry_date').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_expiry_date").hide(); }, 2000);
            isValid = false;
        } else {
            const [month, year] = expiryDate.split('/');
            const expiry = new Date(year, month-1);
            const now = new Date();
            if (expiry < new Date(now.getFullYear(), now.getMonth())) {
                $('#vld_expiry_date').text('The expiry date cannot be in the past.').css('color', 'red').show();
                setTimeout(function () { $("#vld_expiry_date").hide(); }, 2000);
                isValid = false;
            } else {
                $('#expiry_date').css('border', '1px solid green');
            }
        }

        // Validate terms and conditions
        if (!terms) {
            $('#vld_terms').text('Please agree to the terms and conditions.').css('color', 'red').show();
            setTimeout(function () { $("#vld_terms").hide(); }, 2000);
            isValid = false;
        }
        if (!isValid) {
            e.preventDefault();
        } else {
            this.submit();
        }
    });
});
</script>