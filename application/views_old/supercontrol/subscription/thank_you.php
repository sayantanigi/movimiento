<div class="page-container">
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <?php $this->load->view('supercontrol/leftbar'); ?>
        </div>
    </div>
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content" style="position: absolute; top: 155px; left: 290px;text-align: center;">
                            <div class="tab-pane active" id="tab_0">
                                <h1 style="text-align: center">Thank you</h1>
                            </div>
                            <div class="heading">
                            <?php
                            use PHPMailer\PHPMailer\PHPMailer;
                            use PHPMailer\PHPMailer\SMTP;
                            use PHPMailer\PHPMailer\Exception;
                            require APPPATH.'../vendor/autoload.php';
                            require_once APPPATH."third_party/stripe/init.php";
                            // \Stripe\Stripe::setApiKey('sk_test_51PMX1GK1Euj0OQwTx1jdmG0dBNTBDThgrYFeWI1kQ7WUx2Hdv41hDbY1NRGoGTERB2Yv9ZmIcyWXh7Sch12UX2c500DDt3DUdI');
                            // $stripe = new \Stripe\StripeClient
                            // ('sk_test_51PMX1GK1Euj0OQwTx1jdmG0dBNTBDThgrYFeWI1kQ7WUx2Hdv41hDbY1NRGoGTERB2Yv9ZmIcyWXh7Sch12UX2c500DDt3DUdI');

                            \Stripe\Stripe::setApiKey('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');
                            $stripe = new \Stripe\StripeClient('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');
                            $session = \Stripe\Checkout\Session::retrieve($s_id);

                            $invoice_id = $session["invoice"];
                            $sub_data = $stripe->subscriptions->retrieve($session['subscription'],[]);
                            $invoice = $stripe->invoices->retrieve($session['invoice'],[]);
                            $expire_date = date('Y-m-d', $sub_data['current_period_end']);
                            $created_date = date('Y-m-d');
                            $futureDate = $expire_date;
                            $month = (int)abs((strtotime($created_date) - strtotime($futureDate))/(60*60*24*30));
                            $price = $session['amount_total']/100;
                            $printKEY = $sub_data['items']['data'][0]['plan']['id'];
                            $subQuery = $this->db->query("SELECT * FROM subscription where price_key = '".$printKEY."'")->row();

                            if($session['status'] == 'complete') {
                                $dataDB = array(
                                    'employer_id' => $_SESSION['user_id'],
                                    'subscription_id' => $subQuery->id,
                                    'name_of_card' => $subQuery->subscription_name,
                                    'email' => $session['customer_details']['email'],
                                    'amount' => $price,
                                    'payment_status' => $session['payment_status'],
                                    'transaction_id' => $session['subscription'],
                                    'payment_date' => date('Y-m-d H:i:s'),
                                    'created_date' => date('Y-m-d H:i:s'),
                                    'expiry_date' => $expire_date,
                                    'invoice_url' => $invoice['hosted_invoice_url'],
                                    'invoice_pdf' => $invoice['invoice_pdf'],
                                    'status' => '1',
                                    'duration' => $subQuery->subscription_duration
                                );

                                $this->db->insert('user_subscription', $dataDB);
                                if($this->db->insert_id()) {
                                    $userDetails = $this->db->query("SELECT * FROM users where id = '".$_SESSION['user_id']."'")->row();
                                    if(!empty($userDetails->firstname)){
                                        $fullName = $userDetails->firstname.' '.$userDetails->lastname;
                                    } else {
                                        $fullName = $userDetails->companyname;
                                    }?>
                                    <h4 class="card-title">Payment Successful.</h4>
                                    <p class="card-text">We received your payment on your purchase <b>#<?php echo $session['subscription']; ?></b>, check your email for more information.</p>
                                    <a href="<?php echo base_url('supercontrol/home'); ?>" class="successBTN">Dashboard</a>
                                    <a href="<?php echo $invoice['hosted_invoice_url'];?>" target="_blank" class="successBTN">Generate Invoice</a>
                                    <?php
                                    $getOptionsSql = "SELECT * FROM `options`";
                                    $optionsList = $this->db->query($getOptionsSql)->result();
                                    $admEmail = $optionsList[8]->option_value;
                                    $address = $optionsList[6]->option_value;

                                    $mail = new PHPMailer(true);
                                    $invoice_url = $invoice['hosted_invoice_url']; // Invoice URL

                                    $to1 = $userDetails->email;
                                    $subject1 = "Subscription Payment Invoice";
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
                                            <p style='font-size: 14px;'>Dear " . $full_name . ",</p>
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
                                    $message1 .= "--$boundary1\r\n";
                                    $message1 .= "Content-Type: image/png; name=\"logo.png\"\r\n";
                                    $message1 .= "Content-Transfer-Encoding: base64\r\n";
                                    $message1 .= "Content-Disposition: inline; filename=\"logo.png\"\r\n";
                                    $message1 .= "Content-ID: <logo>\r\n\r\n";
                                    $logoPath1 = "uploads/logo/logo2.png"; // Provide the correct path to your logo file
                                    $logoData1 = file_get_contents($logoPath1);
                                    $message1 .= chunk_split(base64_encode($logoData1)) . "\r\n";
                                    $message1 .= "--$boundary1--";
                                    if (mail($to1, $subject1, $message1, $headers1)) {
                                        echo 'Email has been sent successfully';
                                    } else {
                                        echo 'Email could not be sent.';
                                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                                    }
                                }
                            } ?>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.successBTN {border: 2px solid #83d893; border-radius: 35px; font-weight: 600; width: auto; padding: 10px 25px !important; padding: 0 0 30px 0; display: inline-block;}
</style>