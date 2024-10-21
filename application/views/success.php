<?php
function generatePassword($length = 12, $useUppercase = true, $useLowercase = true, $useNumbers = true, $useSpecialChars = true) {
    $uppercaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowercaseChars = 'abcdefghijklmnopqrstuvwxyz';
    $numberChars = '0123456789';
    $specialChars = '!@#$%^&*()-_=+[]{}|;:,.<>?';
    $charPool = '';

    if ($useUppercase) {
        $charPool .= $uppercaseChars;
    }
    if ($useLowercase) {
        $charPool .= $lowercaseChars;
    }
    if ($useNumbers) {
        $charPool .= $numberChars;
    }
    if ($useSpecialChars) {
        $charPool .= $specialChars;
    }
    if (empty($charPool)) {
        throw new InvalidArgumentException("At least one character type must be selected.");
    }
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $randomIndex = mt_rand(0, strlen($charPool) - 1);
        $password .= $charPool[$randomIndex];
    }
    return $password;
}
?>
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="<?= base_url()?>assets/img/page-title/page-title-2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                    <h3 class="page__title">Payment Success</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Payment Success</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="intro-section gray-bg pt-94 pb-100 md-pt-64 md-pb-70">
    <div class="container">
        <div class="row clearfix">
            <!-- Content Column -->
            <div class="col-lg-12 md-mb-50">
                <div class="content white-bg pt-30 mb-3">
                    <div class="course-overview">
                        <div class="rs-services style2 px-4">
                        <?php
                        use PHPMailer\PHPMailer\PHPMailer;
                        use PHPMailer\PHPMailer\SMTP;
                        use PHPMailer\PHPMailer\Exception;
                        require 'vendor/autoload.php';
                        require_once APPPATH."third_party/stripe/init.php";
                        \Stripe\Stripe::setApiKey('sk_test_51PMX1GK1Euj0OQwTx1jdmG0dBNTBDThgrYFeWI1kQ7WUx2Hdv41hDbY1NRGoGTERB2Yv9ZmIcyWXh7Sch12UX2c500DDt3DUdI');
                        $session = \Stripe\Checkout\Session::retrieve($p_id);
                        $stripe = new \Stripe\StripeClient('sk_test_51PMX1GK1Euj0OQwTx1jdmG0dBNTBDThgrYFeWI1kQ7WUx2Hdv41hDbY1NRGoGTERB2Yv9ZmIcyWXh7Sch12UX2c500DDt3DUdI');

                        try {
                            $passwordLength = 16; // Length of the password
                            $includeUppercase = true;
                            $includeLowercase = true;
                            $includeNumbers = true;
                            $includeSpecialChars = true;

                            $generatedPassword = generatePassword($passwordLength, $includeUppercase, $includeLowercase, $includeNumbers, $includeSpecialChars);
                            $userDetails = array(
                                'full_name' => $session['customer_details']['name'],
                                'email' => $session['customer_details']['email'],
                                'phone' => $session['customer_details']['phone'],
                                'password' => base64_encode($generatedPassword),
                                'userType' => '1',
                                'phone_full' => $session['customer_details']['address']['line1'].", ".$session['customer_details']['address']['line2'].", ".$session['customer_details']['address']['city'].", ".$session['customer_details']['address']['postal_code'],
                                'phone_country' => $session['customer_details']['address']['state'],
                                'phone_st_country' => $session['customer_details']['address']['country'],
                                'email_verified' => '1',
                                'status' => '1',
                            );
                            $getUserdetails = $this->db->query("SELECT * FROM users WHERE email = '".$session['customer_details']['email']."'")->row();
                            if(empty($getUserdetails)) {
                                $this->db->insert('users', $userDetails);
                                $user_id = $this->db->insert_id();
                                $extraInfo = '<p class="card-text">Also you will received an email containing your login credential.</p>';
                            } else {
                                $user_id = $getUserdetails->id;
                                $extraInfo = '';
                            }
                        } catch (InvalidArgumentException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        $invoice = $stripe->invoices->sendInvoice($session['invoice'],[]);
                        $pay_data = $stripe->paymentIntents->retrieve($session['payment_intent'],[]);
                        $price = $session['amount_total']/100;
                        if($session['status'] == 'complete') {
                            $course_id = $this->session->userdata('course_id');
                            //$user_id = $this->session->userdata('user_id');
                            $enrollment_price = $price;
                            $price_cents = $session['amount_total'];
                            $currency = $session['currency'];
                            $currency_symbol = '$';
                            $payment_status = $session['status'];
                            if($session['status'] == 'complete') {
                                $payment_status = 'COMPLETED';
                            } else {
                                $payment_status = 'FAILED';
                            }
                            $transaction_id = $session['payment_intent'];
                            $this->db->query("INSERT INTO course_enrollment (`course_id`, `user_id`, `enrollment_price`, `price_cents`, `currency`, `currency_symbol`, `payment_status`, `transaction_id`) VALUES ('$course_id', '$user_id', '$enrollment_price', '$price_cents', '$currency', '$currency_symbol', '$payment_status', '$transaction_id');
                            ");
                            if($this->db->insert_id()) { ?>
                                <div class="heading" style="text-align: center;">
                                    <h4 class="card-title">Payment Successful.</h4>
                                    <p class="card-text">We received your payment on your purchase <b>#<?php echo $transaction_id ; ?></b>, check your email for more information.</p>
                                    <?= $extraInfo; ?>
                                    <a href="<?php echo $invoice['hosted_invoice_url'];?>" target="_blank" style="padding: 0;display: inline-block;background: #83d893;padding: 12px 12px;color: #fff;font-size: 20px;font-weight: 600;">Generate Invoice</a>
                                </div>
                            <?php
                            $subject = "Course Payment Invoice";
                            $getOptionsSql = "SELECT * FROM `options`";
                            $optionsList = $this->db->query($getOptionsSql)->result();
                            //$imagePath = base_url().'uploads/logo/'.$optionsList[0]->option_value;
                            //$imagePath = base_url() . 'user_assets/images/C2C_Home/Header_Logo.png';
                            $message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'> <tbody> <tr> <td align='center'> <table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; border-top:2px solid #232323'> <tbody> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'> <img src='cid:Logo'/> </td> </tr> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Dear ".ucwords($session['customer_details']['name']).",</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'>Congratulations! Your purchase on <strong style='font-weight:bold;'>Movimiento</strong> was successful. </td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'>Please click on the below link to view purchase invoice.</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='text-align:center;padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: bold;'> <a href=".$invoice['hosted_invoice_url']." target='_blank' style='background:#232323;color:#fff;padding:10px;text-decoration:none;line-height:24px;'>Click Here</a> </td> </tr> <tr> <td height='30'></td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:16px; color:#232323; line-height:24px; font-weight: 700;'>Thank you!</td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>Sincerely</td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>Movimiento</td> </tr> </tbody> </table> </td> </tr> </tbody> </table>";
                            $mail = new PHPMailer(true);
                            try {
                                //Server settings
                                $mail->CharSet = 'UTF-8';
                                $mail->SetFrom('support@movimientolatinouniversity.com', 'Movimiento Latino University');
                                $mail->AddAddress($session['customer_details']['email']);
                                $mail->IsHTML(true);
                                $mail->AddEmbeddedImage('uploads/logo/Logo-Makutano-inblock.png', 'Logo');
                                $mail->Subject = $subject;
                                $mail->Body = $message;
                                //Send email via SMTP
                                $mail->IsSMTP();
                                $mail->SMTPAuth   = true;
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail->Host = 'localhost';
                                $mail->SMTPAuth = false;
                                $mail->SMTPAutoTLS = false;
                                $mail->Port = 25;
                                if ($mail->send()) {
                                    echo 'Message has been sent';
                                } else {
                                    echo 'Message could not be sent.';
                                    echo 'Mailer Error: ' . $mail->ErrorInfo; // Print error details
                                }
                            } catch (Exception $e) {
                                $this->session->set_flashdata('error_message', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                            }?>
                        <?php }	}?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>