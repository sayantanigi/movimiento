<?php
$user_id = $this->session->userdata('user_id');
$userDetails = $this->Commonmodel->fetch_row('users', array('id' => $user_id));
//print_r($userDetails); die();
$completedCourse = 0;
$courseArray = array();

if (!empty($enrolments)) {
    foreach ($enrolments as $key => $value) {
        $totalModuleSql = "SELECT * FROM `course_modules` WHERE `course_id` = '" . @$value->course_id . "'";
        $totalmodule = $this->db->query($totalModuleSql)->num_rows();
        $moduleData = $this->db->query($totalModuleSql)->result();
        $moduleArray = array();
        if (!empty($moduleData)) {
            foreach ($moduleData as $keyn => $item) {
                $totalMaterialSql = "SELECT * FROM `course_materials` WHERE `course_id` = '" . @$value->course_id . "' AND `module` = '" . @$item->id . "'";
                $totalmaterial = $this->db->query($totalMaterialSql)->num_rows();
                $getAttemptModuleSql = "SELECT COUNT(*) as attemptModule FROM `course_enrollment_status` where `course_id` = '" . @$value->course_id . "' and `module` = '" . $item->id . "' and `enrollment_id` = '" . @$value->enrollment_id . "'";
                $attemptModuleRow = $this->db->query($getAttemptModuleSql)->row();
                $totalComModule = 0;
                if (@$totalmaterial == @$attemptModuleRow->attemptModule && @$totalmaterial != '0') {
                    $totalComModule++;
                    $moduleArray[] = $item->id;
                }
                // echo "<br> Course Id = ".@$value->course_id." Total Module ".$totalmodule." ModuleId = ".$item->id." Material ".$totalmaterial." attempt = ".@$attemptModuleRow->attemptModule." Completed = ".$totalComModule;
            }
        }
        if (@$totalmodule == count($moduleArray)) {
            $courseArray[] = $value->course_id;

        }
    }
}
$condition = "";
if (!empty($courseArray)) {
    $courseIds = implode("', '", $courseArray);
    $condition = " AND course_id NOT IN('$courseIds')";
}
$getEnrolmentSql = "SELECT COUNT(DISTINCT `enrollment_id`) AS activeCourse FROM `course_enrollment_status` WHERE `user_id` = '" . $user_id . "' $condition";
$active_data = $this->db->query($getEnrolmentSql)->row();
$activeCourse = 0;
if (!empty($active_data)) {
    $activeCourse = $active_data->activeCourse;
}
$data = array(
    'ctn_enrolment' => @$ctn_enrolment,
    'courseArray' => count($courseArray)
);
?>
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="assets/img/page-title/page-title-2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                <h3 class="page__title">Student Dashboard</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active" aria-current="page">Student Dashboard</li>
                    </ol>
                </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pb-145">
    <div class="rbt-dashboard-content-wrapper">
        <div class="container">
            <div class="rbt-tutor-information">
                <div class="rbt-tutor-information-left d-flex align-items-center">
                    <div class="thumbnail rbt-avatars size-lg">
                        <?php if (!empty($userDetails->image)) { ?>
                            <img src="<?= base_url() ?>/uploads/profile_pictures/<?= $userDetails->image ?>" alt="">
                        <?php } else { ?>
                            <img src="images/no-user.png" alt="">
                        <?php } ?>
                    </div>
                    <div class="tutor-content">
                        <h5 class="title h4 fw-bold text-white">
                            <?= ucwords($userDetails->full_name) ?>
                        </h5>
                        <ul class="listRbt mt--5">
                            <li><i class="far fa-book-alt"></i>
                                <?php echo @$ctn_enrolment; ?> Courses Enroled
                            </li>
                            <li><i class="far fa-file-certificate"></i>
                                <?php echo count($courseArray); ?> Certificate
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php $this->load->view('leftbar_dash'); ?>
            <div class="col-lg-8">
                <p id="error_msg" style="text-align: center;color: red;font-size: 18px;padding: 10px;border: 1px solid;">Please complete your profile to access all the menu tab.</p>
                <div class="card">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold text-uppercase">Thank you</h2>
                        <?php
                            use PHPMailer\PHPMailer\PHPMailer;
                            use PHPMailer\PHPMailer\SMTP;
                            use PHPMailer\PHPMailer\Exception;
                            require APPPATH.'../vendor/autoload.php';
                            require_once APPPATH."third_party/stripe/init.php";

                            \Stripe\Stripe::setApiKey('sk_test_51PMX1GK1Euj0OQwTx1jdmG0dBNTBDThgrYFeWI1kQ7WUx2Hdv41hDbY1NRGoGTERB2Yv9ZmIcyWXh7Sch12UX2c500DDt3DUdI');
                            $stripe = new \Stripe\StripeClient('sk_test_51PMX1GK1Euj0OQwTx1jdmG0dBNTBDThgrYFeWI1kQ7WUx2Hdv41hDbY1NRGoGTERB2Yv9ZmIcyWXh7Sch12UX2c500DDt3DUdI');
                            $session = \Stripe\Checkout\Session::retrieve($s_id);

                            $invoice_id = $session["invoice"];
                            $sub_data = $stripe->subscriptions->retrieve($session['subscription'],[]);
                            //echo "<pre>"; print_r($sub_data); die();
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
                                //print_r($dataDB);
                                $this->db->insert('user_subscription', $dataDB);
                                if($this->db->insert_id()) {
                                    $userDetails = $this->db->query("SELECT * FROM users where id = '".$_SESSION['user_id']."'")->row();
                                    $fullName = $userDetails->full_name;
                                    ?>
                                    <h4 class="card-title">Payment Successful.</h4>
                                    <p class="card-text">We received your payment on your purchase <b>#<?php echo $session['subscription']; ?></b>, check your email for more information.</p>
                                    <a href="<?php echo base_url('student-dashboard'); ?>" class="successBTN">Dashboard</a>
                                    <a href="<?php echo $invoice['hosted_invoice_url'];?>" target="_blank" class="successBTN">Generate Invoice</a>
                                    <?php
                                    $subject = "Subscription Payment Invoice";
                                    $getOptionsSql = "SELECT * FROM `options`";
                                    $optionsList = $this->db->query($getOptionsSql)->result();
                                    $admEmail = $optionsList[8]->option_value;
                                    $address = $optionsList[6]->option_value;
                                    $message = "
                                    <body>
                                        <div style='width:600px;margin: 0 auto;background: #fff;font-family: 'Poppins', sans-serif; border: 1px solid #e6e6e6;'>
                                            <div style='padding: 30px 30px 15px 30px;box-sizing: border-box;'>
                                                <img src='cid:Logo' style='width:100px;float: right;margin-top: 0 auto;'>
                                                <h3 style='padding-top:40px; line-height: 30px;'>Greetings from<span style='font-weight: 900;font-size: 35px;color: #F44C0D; display: block;'>Movimiento Latino University</span></h3>
                                                <p style='font-size:24px;'>Dear ".ucwords($fullName).",</p>
                                                <p style='font-size:24px;'>Congratulations! Your purchase on <strong style='font-weight:bold;'>Movimiento Latino University</strong> was successful.</p>
                                                <p style='font-size:24px;'>Please click on the below link to view purchase invoice.</p>
                                                <p style='text-align: center;'><a href=".$invoice['hosted_invoice_url']." style='height: 50px; width: 300px; background: rgb(253,179,2); background: linear-gradient(0deg, rgba(253,179,2,1) 0%, rgba(244,77,9,1) 100%); text-align: center; font-size: 18px; color: #fff; border-radius: 12px; display: inline-block; line-height: 50px; text-decoration: none; text-transform: uppercase; font-weight: 600;'>Click Here</a></p>
                                                <p style='font-size:20px;'>Thank you!</p>
                                                <p style='font-size:20px;list-style: none;'>Sincerly</p>
                                                <p style='list-style: none;'><b>Movimiento Latino University</b></p>
                                                <p style='list-style:none;'><b>Visit us:</b> <span>@$address</span></p>
                                                <p style='list-style:none'><b>Email us:</b> <span>@$admEmail</span></p>
                                            </div>
                                            <table style='width: 100%;'>
                                                <tr>
                                                    <td style='height:30px;width:100%; background: red;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy; <?=date('Y')?> Movimiento Latino University. All rights reserved.</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </body>";
                                    $mail = new PHPMailer(true);
                                    try {
                                        $mail->CharSet = 'UTF-8';
                                        $mail->SetFrom('support@movimientolatinouniversity.com', 'Movimiento Latino University');
                                        $mail->AddAddress($userDetails->email);
                                        $mail->IsHTML(true);
                                        $mail->Subject = $subject;
                                        $mail->AddEmbeddedImage('uploads/logo/logo.PNG', 'Logo');
                                        $mail->Body = $message;
                                        $mail->IsSMTP();
                                        $mail->SMTPAuth   = true;
                                        $mail->Host = 'localhost';
                                        $mail->SMTPAuth = false;
                                        $mail->SMTPAutoTLS = false;
                                        $mail->Port = 25;
                                        $mail->send();
                                        echo 'Message has been sent';
                                    } catch (Exception $e) {
                                        //$this->session->set_flashdata('error_message', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                                        $this->session->set_flashdata('message', "<p>Your message could not be sent. Please, try again later.</p>");
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
.successBTN {border: 2px solid #83d893; border-radius: 35px; font-weight: 600; width: auto; padding: 10px 25px !important; padding: 0 0 30px 0; display: inline-block;}
#error_msg {display: none;}
</style>