<?php
    $user_id = $this->session->userdata('user_id');
    $isLoggedIn = $this->session->userdata('isLoggedIn');
    $getUserSql = "SELECT * FROM `users` WHERE id = $user_id";
    $getUserList = $this->db->query($getUserSql)->result();
    $fullName = $getUserList[0]->fname.' '.$getUserList[0]->lname;
    $userEmail = $getUserList[0]->email;
?>
<!-- Main content Start -->
<div class="main-content">
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url('assets/images/breadcrumbs/2.jpg') ?>" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title">Success</h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url() ?>">Home</a>
                </li>
                <li>Success</li>
            </ul>
        </div>
    </div>
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
                            \Stripe\Stripe::setApiKey('sk_test_51NG6aKFoJzvzntq4UpLTpYCwazUyWiLjTDC2dett0Na0fAQjkqNPCasLo7nCTCisBX5BzRhIfmWO85ihAs4GsloW00PUsvhlau');
                            $session = \Stripe\Checkout\Session::retrieve($p_id);
                            $stripe = new \Stripe\StripeClient('sk_test_51NG6aKFoJzvzntq4UpLTpYCwazUyWiLjTDC2dett0Na0fAQjkqNPCasLo7nCTCisBX5BzRhIfmWO85ihAs4GsloW00PUsvhlau');
                            $invoice = $stripe->invoices->sendInvoice($session['invoice'],[]);
                            $pay_data = $stripe->paymentIntents->retrieve($session['payment_intent'],[]);
                            $price = $session['amount_total']/100;
                            if($session['status'] == 'complete') {
                                $course_id = $this->session->userdata('course_id');
                                $user_id = $this->session->userdata('user_id');
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
                                        <a href="<?php echo $invoice['hosted_invoice_url'];?>" target="_blank" style="padding: 0 0 30px 0; display: inline-block;">Generate Invoice</a>
                                    </div>
                                <?php
                                $subject = "Course Payment Invoice";
                                $getOptionsSql = "SELECT * FROM `options`";
                                $optionsList = $this->db->query($getOptionsSql)->result();
                                $imagePath = base_url().'uploads/logo/'.$optionsList[0]->option_value;
                                //$imagePath = base_url() . 'user_assets/images/C2C_Home/Header_Logo.png';
                                $message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'> <tbody> <tr> <td align='center'> <table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; border-top:2px solid #232323'> <tbody> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'> <img src='".$imagePath."'/> </td> </tr> <tr> <td height='35'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Dear ".ucwords($fullName).",</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'>Congratulations! Your purchase on <strong style='font-weight:bold;'>ConceptToCreation</strong> was successful. </td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'>Please click on the below link to view purchase invoice.</td> </tr> <tr> <td height='10'></td> </tr> <tr> <td align='left' style='text-align:center;padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: bold;'> <a href=".$invoice['hosted_invoice_url']." target='_blank' style='background:#232323;color:#fff;padding:10px;text-decoration:none;line-height:24px;'>Click Here</a> </td> </tr> <tr> <td height='30'></td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:16px; color:#232323; line-height:24px; font-weight: 700;'>Thank you!</td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>Sincerely</td> </tr> <tr> <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>ConceptToCreation</td> </tr> </tbody> </table> </td> </tr> </tbody> </table>";
                                $mail = new PHPMailer(true);
                                try {
                                    //Server settings
                                    $mail->CharSet = 'UTF-8';
                                    $mail->SetFrom('no-reply@goigi.com', 'ContactToCreation');
                                    $mail->AddAddress($userEmail);
                                    $mail->IsHTML(true);
                                    $mail->Subject = $subject;
                                    $mail->Body = $message;
                                    //Send email via SMTP
                                    $mail->IsSMTP();
                                    $mail->SMTPAuth   = true;
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                    $mail->Host       = "smtp.gmail.com";
                                    $mail->Port       = 587; //587 465
                                    $mail->Username   = "no-reply@goigi.com";
                                    $mail->Password   = "wj8jeml3eu0z";
                                    $mail->send();
                                    // echo 'Message has been sent';
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
</div>