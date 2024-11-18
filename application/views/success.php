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
                    <div class="course-overview" style="text-align: center;">
                        <div class="rs-services style2 px-4">
                        <?php
                        use PHPMailer\PHPMailer\PHPMailer;
                        use PHPMailer\PHPMailer\SMTP;
                        use PHPMailer\PHPMailer\Exception;
                        require 'vendor/autoload.php';
                        require_once APPPATH."third_party/stripe/init.php";
                        \Stripe\Stripe::setApiKey('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');
                        //\Stripe\Stripe::setApiKey('sk_test_51PMX1GK1Euj0OQwTx1jdmG0dBNTBDThgrYFeWI1kQ7WUx2Hdv41hDbY1NRGoGTERB2Yv9ZmIcyWXh7Sch12UX2c500DDt3DUdI');
                        $session = \Stripe\Checkout\Session::retrieve($p_id);
                        $stripe = new \Stripe\StripeClient('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');
                        //$stripe = new \Stripe\StripeClient('sk_test_51PMX1GK1Euj0OQwTx1jdmG0dBNTBDThgrYFeWI1kQ7WUx2Hdv41hDbY1NRGoGTERB2Yv9ZmIcyWXh7Sch12UX2c500DDt3DUdI');
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
                                $getOptionsSql = "SELECT * FROM `options`";
                                $optionsList = $this->db->query($getOptionsSql)->result();
                                $admEmail = $optionsList[8]->option_value;
                                $address = $optionsList[6]->option_value;
                                $this->db->insert('users', $userDetails);
                                $user_id = $this->db->insert_id();
                                $extraInfo = '<p class="card-text">Also you will received an email containing your login credential.</p>';
                                $customer_name = ucwords($session['customer_details']['name']); // Customer's name
                                $pass = $generatedPassword;

                                $to1 = $session['customer_details']['email']; // Recipient's email address
                                $subject1 = 'Login Credentials';
                                $boundary1 = md5(uniqid(time())); // Generate a unique boundary for separating email parts
                                $headers1 = "From: <support@movimientolatinouniversity.com>\r\n";
                                $headers1 .= "MIME-Version: 1.0\r\n";
                                $headers1 .= "Content-Type: multipart/related; boundary=\"$boundary1\"\r\n";
                                $message1 = "--$boundary1\r\n";
                                $message1 .= "Content-Type: text/html; charset=UTF-8\r\n";
                                $message1 .= "Content-Transfer-Encoding: 7bit\r\n\r\n";

                                $message1 .= "
                                <div style='width: 600px; margin: 0 auto; background: #fff; border: 1px solid #e6e6e6'>
                                    <div style='padding: 30px 30px 15px 30px; box-sizing: border-box'>
                                        <img src=\"cid:logo\" alt=\"Company Logo\" style='width: 220px; float: right; margin-top: 0'>
                                        <h3 style='padding-top: 45px;line-height: 20px;'>Greetings from<span style='font-weight: 900;font-size: 25px;color: #F44C0D;display: block'> Movimiento Latino University</span></h3>
                                        <p style='font-size: 14px;'>Dear ".$customer_name.",</p>
                                        <p style='font-size: 14px;'>Your Login credentials are given below</p>
                                        <p style='font-size: 14px;margin: 0 0 18px 0;'>Username: ".$to1."</p>
                                        <p style='font-size: 14px; margin: 0px;'>Password: ".$pass."</p>
                                        <p style='font-size:40px;'></p>
                                        <p style='font-size: 14px;margin: 0;list-style: none'>Sincerly</p>
                                            <p style='font-size: 12px; margin: 0px; list-style: none'><b>Movimiento Latino University</b></p>
                                            <p style='font-size: 12px; margin: 0px; list-style: none'><b>Visit us:</b> <span>@$address</span></p>
                                            <p style='font-size: 12px; margin: 0px; list-style: none'><b>Email us:</b> <span>@$admEmail</span></p>
                                        </div>
                                        <table style='width: 100%;'>
                                            <tr>
                                                <td style='height:30px;width:100%; background: red;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy; <?=date('Y')?> Movimiento. All rights reserved.</td>
                                            </tr>
                                        </table>
                                    </div>
                                </body>\r\n";
                                $message1 .= "--$boundary1\r\n";
                                $message1 .= "Content-Type: image/png; name=\"logo.png\"\r\n";
                                $message1 .= "Content-Transfer-Encoding: base64\r\n";
                                $message1 .= "Content-Disposition: inline; filename=\"logo.png\"\r\n";
                                $message1 .= "Content-ID: <logo>\r\n\r\n";
                                $logoPath1 = "uploads/logo/logo2.png"; // Provide the correct path to your logo file
                                $logoData1 = file_get_contents($logoPath1);
                                $message1 .= chunk_split(base64_encode($logoData1)) . "\r\n";
                                $message1 .= "--$boundary1--";
                                mail($to1, $subject1, $message1, $headers1);
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
                            $getOptionsSql = "SELECT * FROM `options`";
                            $optionsList = $this->db->query($getOptionsSql)->result();
                            $admEmail = $optionsList[8]->option_value;
                            $address = $optionsList[6]->option_value;
                            $message1 = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'> <tbody> <tr> <td align='center'> <table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; border-top:2px solid #232323'> <tbody> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'> <img src='cid:Logo'/> </td> </tr> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Dear ".ucwords($session['customer_details']['name']).",</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'>Congratulations! Your purchase on <strong style='font-weight:bold;'>Movimiento</strong> was successful. </td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'>Please click on the below link to view purchase invoice.</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='text-align:center;padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: bold;'> <a href=".$invoice['hosted_invoice_url']." target='_blank' style='background:#232323;color:#fff;padding:10px;text-decoration:none;line-height:24px;'>Click Here</a> </td> </tr> <tr> <td height='30'></td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:16px; color:#232323; line-height:24px; font-weight: 700;'>Thank you!</td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>Sincerely</td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>Movimiento</td> </tr> </tbody> </table> </td> </tr> </tbody> </table>";
                            $mail = new PHPMailer(true);
                            try {

                                $to = $session['customer_details']['email']; // Recipient's email address
                                $customer_name = ucwords($session['customer_details']['name']); // Customer's name
                                $invoice_url = $invoice['hosted_invoice_url']; // Invoice URL

                                $to2 = $session['customer_details']['email']; // Recipient's email address
                                $subject2 = 'Course Payment Invoice';
                                $boundary2 = md5(uniqid(time())); // Generate a unique boundary for separating email parts
                                $headers2 = "From: <support@movimientolatinouniversity.com>\r\n";
                                $headers2 .= "MIME-Version: 1.0\r\n";
                                $headers2 .= "Content-Type: multipart/related; boundary=\"$boundary2\"\r\n";
                                $message2 = "--$boundary2\r\n";
                                $message2 .= "Content-Type: text/html; charset=UTF-8\r\n";
                                $message2 .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
                                $message2 .= "
                                <div style='width: 600px; margin: 0 auto; background: #fff; border: 1px solid #e6e6e6'>
                                    <div style='padding: 30px 30px 15px 30px; box-sizing: border-box'>
                                        <img src=\"cid:logo\" alt=\"Company Logo\" style='width: 220px; float: right; margin-top: 0'>
                                        <h3 style='padding-top: 45px;line-height: 20px;'>Greetings from<span style='font-weight: 900;font-size: 25px;color: #F44C0D;display: block'> Movimiento Latino University</span></h3>
                                        <p style='font-size: 14px;'>Dear " . $customer_name . ",</p>
                                        <p style='font-size: 14px;'>Congratulations! Your purchase on <strong style='font-weight:bold;'>Movimiento Latino University</strong> was successful.</p>
                                        <p style='font-size: 14px;margin: 0 0 18px 0;'>Please click on the below link to view purchase invoice.</p>
                                        <p style='font-size: 14px; margin: 0px;'>
                                            <a href=".$invoice_url." target='_blank' style='background:#232323;color:#fff;padding:10px;text-decoration:none;line-height:24px;'>Click Here</a>
                                        </p>
                                        <p style='font-size:40px;'></p>
                                        <p style='font-size: 14px;margin: 0;list-style: none'>Sincerly</p>
                                            <p style='font-size: 12px; margin: 0px; list-style: none'><b>Movimiento Latino University</b></p>
                                            <p style='font-size: 12px; margin: 0px; list-style: none'><b>Visit us:</b> <span>@$address</span></p>
                                            <p style='font-size: 12px; margin: 0px; list-style: none'><b>Email us:</b> <span>@$admEmail</span></p>
                                        </div>
                                        <table style='width: 100%;'>
                                            <tr>
                                                <td style='height:30px;width:100%; background: red;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy; <?=date('Y')?> Movimiento. All rights reserved.</td>
                                            </tr>
                                        </table>
                                    </div>
                                </body>\r\n";
                                $message2 .= "--$boundary2\r\n";
                                $message2 .= "Content-Type: image/png; name=\"logo.png\"\r\n";
                                $message2 .= "Content-Transfer-Encoding: base64\r\n";
                                $message2 .= "Content-Disposition: inline; filename=\"logo.png\"\r\n";
                                $message2 .= "Content-ID: <logo>\r\n\r\n";

                                $logoPath2 = "uploads/logo/logo2.png"; // Provide the correct path to your logo file
                                $logoData2 = file_get_contents($logoPath2);
                                $message2 .= chunk_split(base64_encode($logoData2)) . "\r\n";

                                $message2 .= "--$boundary2--";

                                if (mail($to2, $subject2, $message2, $headers2)) {
                                    echo 'Email has been sent successfully';
                                } else {
                                    echo 'Email could not be sent.';
                                    echo 'Mailer Error: ' . $mail->ErrorInfo;
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