<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Mymodel');
    }
    public function index() {
        $this->load->view('welcome_message');
    }
    public function paymentPage() {
        $data['userId'] = $userId = @$_GET['userId'];
        $data['subId'] = $subId = @$_GET['subId'];
        $data['amount'] = $amount = @$_GET['amount'];
        if (!empty(@$subId)) {
            $data['subscription'] = $this->db->query("select * from subscription where id = " . @$subId . " and status = '1'")->row();
        } else {
            $data['subscription'] = '';
        }
        $this->load->view('webviewpaymentpage', $data);
    }
    public function web_view_stripe_payment() {
        $stripeToken = $this->input->post('stripeToken');
        if (!empty($_POST['stripeToken'])) {
            $token = $_POST['stripeToken'];
            $subId = $_POST['subId'];
            $userId = $_POST['userId'];
            $total = $_POST['total'];
            $address = $_POST['card_address'];
            $country = $_POST['card_country'];
            $state = $_POST['card_state'];
            $city = $_POST['card_city'];
            $zipcode = $_POST['card_zipcode'];
            $card_name = $_POST['card_name'];
            $query = $this->db->query("SELECT * FROM `users` WHERE `id`= '" . $userId . "' LIMIT 1");
            $num_rows = $query->num_rows();
            if ($num_rows > 0) {
                $userInfo = $query->row();
                $name = $userInfo->fname . ' ' . $userInfo->lname;
                $email = $userInfo->email;
                $itemPrice = $total;
                $currency = 'USD';
                require APPPATH . '/libraries/stripe-php/init.php';
                \Stripe\Stripe::setApiKey(STRIPE_API_KEY);
                try {
                    $customer = \Stripe\Customer::create(array(
                        'email' => $email,
                        'source' => $token
                    ));
                } catch (Exception $e) {
                    $api_error = $e->getMessage();
                }
                if (empty($api_error) && $customer) {
                    $sub = $this->Mymodel->get_single_row_info('name, duration, invitation_limit', 'subscription', 'id = ' . $subId . ' and status = "1"', '', 1);
                    $itemName = @$sub->name;
                    $itemNumber = "Test_ITEM" . $this->generate_otp(6);
                    $itemPriceCents = ($itemPrice * 100);
                    $orderID = "TEST_" . $this->generate_otp(6);
                    try {
                        $charge = \Stripe\Charge::create(array(
                            'customer' => $customer->id,
                            'amount' => $itemPriceCents,
                            'currency' => 'USD',
                            'description' => $itemName,
                            'metadata' => array(
                                'order_id' => $orderID
                            )
                        ));
                    } catch (Exception $e) {
                        $api_error = $e->getMessage();
                    }
                    if (empty($api_error) && $charge) {
                        $chargeJson = $charge->jsonSerialize();
                        if ($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1) {
                            $transactionID = $chargeJson['balance_transaction'];
                            $paidAmount = $chargeJson['amount'];
                            $paidAmount = ($paidAmount / 100);
                            $paidCurrency = $chargeJson['currency'];
                            $payment_status = $chargeJson['status'];
                            $chargeID = $chargeJson['id'];
                            $paymentDate = date('Y-m-d H:i:s');
                            if ($payment_status == 'succeeded') {
                                $checksub_beforeexpire = $this->Mymodel->checksubBefore_expied($userId);
                                if (!empty($checksub_beforeexpire)) {
                                    $date_1 = date_create(date('Y-m-d'));
                                    $date_2 = date_create($checksub_beforeexpire->end_date);
                                    $diff = date_diff($date_1, $date_2);
                                    $sub_remaining_days = $diff->format("%a");
                                    $end_date = $this->get_expire_date(@$sub->duration, $sub_remaining_days);
                                    $extractDuration = explode('-', $sub->duration);
                                    $totalInvitation = $extractDuration[0] * $sub->invitation_limit;
                                    $previousInvi = $this->Mymodel->get_single_row_info('total_invitation', 'users', 'id = ' . $userId . ' and status = "1"', '', 1);
                                    if (!empty($previousInvi->total_invitation)) {
                                        $preIn = $previousInvi->total_invitation;
                                    } else {
                                        $preIn = 0;
                                    }
                                    $allTotalIn = $totalInvitation + $preIn;
                                    $update_query = $this->db->query("update users set total_invitation = '" . $allTotalIn . "', invitation_limit = '" . $sub->invitation_limit . "' where id = " . @$userId . "");
                                } else {
                                    $end_date = $this->end_date(@$sub->duration);
                                    $extractDuration = explode('-', $sub->duration);
                                    $totalInvitation = $extractDuration[0] * $sub->invitation_limit;
                                    $update_query = $this->db->query("update users set total_invitation = '" . $totalInvitation . "', invitation_limit = '" . $sub->invitation_limit . "' where id = " . @$userId . "");
                                }
                                $tran_data = array(
                                    'user_name' => $card_name, 'user_id' => $userId, 'sub_id' => $subId, 'order_id' => $orderID, 'tran_id' => $transactionID, 'address' => $address, 'country' => $country, 'state' => $state, 'city' => $city, 'zipcode' => $zipcode, 'amount' => $paidAmount, 'payment_type' => '1', 'start_date' => date('Y-m-d H:i:s'), 'end_date' => $end_date, 'status' => $payment_status, 'currency' => $paidCurrency, 'created_at' => date('Y-m-d H:i:s')
                                );
                                $tran_result = $this->Mymodel->add('transaction', $tran_data);
                            } else {
                                $status = 'failed';
                            }
                            if ($payment_status == 'succeeded') {
                                $ordStatus = 'success';
                                $statusMsg = 'Your Payment has been Successful!';
                            } else {
                                $statusMsg = "Your Payment has Failed!";
                            }
                            $vendortxndata = $this->db->query("SELECT * FROM `transaction` WHERE `id`= '" . $tran_result . "' and status = 'succeeded' LIMIT 1")->row();
                            redirect(base_url("paymentStatus?statusMsg=" . $statusMsg . "&status=" . $payment_status . "&txnId=" . $vendortxndata->tran_id . "&payId=" . $vendortxndata->id . "&userId=" . @$userId . ""), 'refresh');
                        } else {
                            $statusMsg = "Transaction has been failed!";
                            $payment_status = 'failed';
                            $txnId = '';
                            $payId = '';
                            redirect(base_url("paymentStatus?statusMsg=" . $statusMsg . "&status=" . $payment_status . "&txnId=" . $txnId . "&payId=" . $payId . "&userId=" . @$userId . ""), 'refresh');
                        }
                    } else {
                        $statusMsg = "Charge creation failed! $api_error";
                        $payment_status = 'failed';
                        $txnId = '';
                        $payId = '';
                        redirect(base_url("paymentStatus?statusMsg=" . $statusMsg . "&status=" . $payment_status . "&txnId=" . $txnId . "&payId=" . $payId . "&userId=" . @$userId . ""), 'refresh');
                    }
                } else {
                    $statusMsg = "Invalid card details! $api_error";
                    $payment_status = 'failed';
                    $txnId = '';
                    $payId = '';
                    redirect(base_url("paymentStatus?statusMsg=" . $statusMsg . "&status=" . $payment_status . "&txnId=" . $txnId . "&payId=" . $payId . "&userId=" . @$userId . ""), 'refresh');
                }
            } else {
                $statusMsg = "User Not Found.";
                $payment_status = 'failed';
                $txnId = '';
                $payId = '';
                redirect(base_url("paymentStatus?statusMsg=" . $statusMsg . "&status=" . $payment_status . "&txnId=" . $txnId . "&payId=" . $payId . "&userId=" . @$userId . ""), 'refresh');
            }
        } else {
            $statusMsg = "Error on form submission.";
            $payment_status = 'failed';
            $txnId = '';
            $payId = '';
            redirect(base_url("paymentStatus?statusMsg=" . $statusMsg . "&status=" . $payment_status . "&txnId=" . $txnId . "&payId=" . $payId . "&userId=" . @$userId . ""), 'refresh');
        }
    }
    public function paymentStatus() {
        echo "<br>" . $statusMsg = @$_GET['statusMsg'] . "<br>";
        echo "Status : " . "<br>" . $status = @$_GET['status'] . "<br>";
        echo "txnId : " . "<br>" . $txnId = @$_GET['txnId'] . "<br>";
        echo "payId :" . "<br>" . $payId = @$_GET['payId'] . "<br>";
        echo "userId :" . "<br>" . $userId = @$_GET['userId'] . "<br>";
    }
    public function generate_otp($length) {
        $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function get_expire_date($duration = '', $remainingDays = '') {
        $return = '';
        if ($duration == '1-Month') {
            $subDays = 30 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '2-Month') {
            $subDays = 60 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '3-Month') {
            $subDays = 90 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '4-Month') {
            $subDays = 120 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '5-Month') {
            $subDays = 150 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '6-Month') {
            $subDays = 180 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '7-Month') {
            $subDays = 210 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '8-Month') {
            $subDays = 240 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '9-Month') {
            $subDays = 270 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '10-Month') {
            $subDays = 300 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '11-Month') {
            $subDays = 330 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '12-Month') {
            $subDays = 360 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '1-Year') {
            $subDays = 360 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '2-Year') {
            $subDays = 720 + $remainingDays . 'Days';
            $endDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        }
        return $endDate;
    }
    function end_date($duration = '') {
        if ($duration == '1-Month') {
            $days = '30 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '2-Month') {
            $days = '60 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '3-Month') {
            $days = '90 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '4-Month') {
            $days = '120 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '5-Month') {
            $days = '150 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '6-Month') {
            $days = '180 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '7-Month') {
            $days = '210 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '8-Month') {
            $days = '240 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '9-Month') {
            $days = '270 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '10-Month') {
            $days = '300 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '11-Month') {
            $days = '330 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '12-Month') {
            $days = '360 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '1-Year') {
            $days = '360 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        } elseif ($duration == '2-Year') {
            $days = '720 Days';
            $endDate = date('Y-m-d', strtotime('' . $days . '', strtotime(date('Y-m-d')))) . PHP_EOL;
        }
        return $endDate;
    }

    function stripeEventPayment() {
        $data['eventId'] = $eventId = @$_GET['eventId'];
        $event = $this->Mymodel->get_single_row_info('*', 'event', 'event_id = ' . $eventId . ' and status = "1"', '', 1);
        $host = $this->Mymodel->get_single_row_info('stripe_acc_id', 'stripe_connected_acc', 'user_id = ' . $event->user_id . '', '', 1);
        $data['userId'] = $userId = @$_GET['userId'];
        if (!empty($host)) {
            $host_stripe_acc_id = $host->stripe_acc_id;
        } else {
            $statusMsg = "Sorry, the event host is not connected to a Stripe account!";
            $payment_status = 'failed';
            $txnId = '';
            redirect(base_url("stripeEventPaymentStatus?statusMsg=" . $statusMsg . "&status=" . $payment_status . "&txnId=" . $txnId . "&userId=" . @$userId . ""), 'refresh');
            return false;
        }

        $data['amount'] = $amount = @$_GET['amount'];
        $data['user'] = $this->Mymodel->get_single_row_info('fname, lname, email, address', 'users', 'id = ' . @$userId . ' and status = "1"', '', 1);
        $this->load->view('webviewstripeeventpage', $data);
    }
    function web_view_event_pay() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require APPPATH . '/libraries/stripe-php/init.php';
            $this->form_validation->set_rules('stripeToken', 'stripeToken', 'trim|required');
            $this->form_validation->set_rules('card_name', 'Name of Card Holder', 'trim|required');
            $this->form_validation->set_rules('card_amount_1', 'Amount', 'trim|required');
            $this->form_validation->set_rules('eventId', 'eventId', 'trim|required');
            $this->form_validation->set_rules('userId', 'userId', 'trim|required');
            if ($this->form_validation->run() == true) {
                $stripeToken = $this->input->post('stripeToken');
                $cardholder = strip_tags($this->input->post('card_name'));
                $amount = strip_tags($this->input->post('card_amount_1'));
                $userId = strip_tags($this->input->post('userId'));
                $country = strip_tags($this->input->post('card_country'));
                $state = strip_tags($this->input->post('card_state'));
                $city = strip_tags($this->input->post('card_city'));
                $zipcode = strip_tags($this->input->post('card_zipcode'));
                $address = strip_tags($this->input->post('card_address'));
                $payment_in = strip_tags($this->input->post('payment_in'));
                $email = strip_tags($this->input->post('card_email'));
                $eventId = strip_tags($this->input->post('eventId'));
                $stripe = array(
                    "secret_key" => "sk_test_51MPhgSIuZrwn6gWgucZ3pq3OGKnLaQMxviXsKtZb4F7tenDBs25KovJkAB4tii3db6CMW1tdWSk2CB9thQ8yOYdX00iUs05KRN",
                    "publishable_key" => "pk_test_51MPhgSIuZrwn6gWggTu5pxq41l6ZODzSg2zZ1kjKynv3yR61OZDey3AcNm2iwioDVJqSuJ3TCXJCdOAJn1VaNfyk00QkWY7DPT"
                );
                \Stripe\Stripe::setApiKey($stripe['secret_key']);
                $customer = \Stripe\Customer::create(array(
                    'email' => @$email,
                    'source' => $stripeToken
                ));

                $event = $this->Mymodel->get_single_row_info('*', 'event', 'event_id = ' . $eventId . ' and status = "1"', '', 1);
                $host = $this->Mymodel->get_single_row_info('stripe_acc_id', 'stripe_connected_acc', 'user_id = ' . $event->user_id . '', '', 1);
                $itemName = @$event->name;
                $itemNumber = "Test_ITEM" . $this->generate_otp(6);
                $itemPrice = $amount * 100;
                $currency = "USD";
                $orderID = "TEST_" . $this->generate_otp(6);
                $payDetails = \Stripe\Charge::create(array(
                    'amount' => $itemPrice,
                    'currency' => $currency,
                    'customer' => $customer->id,
                    'destination' => $host->stripe_acc_id,
                    'description' => $itemName,
                    'metadata' => array(
                        'order_id' => $orderID
                    )
                ));
                $paymenyResponse = $payDetails->jsonSerialize();
                if ($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1) {
                    $amountPaid = $paymenyResponse['amount'];
                    $balanceTransaction = $paymenyResponse['balance_transaction'];
                    $paidCurrency = $paymenyResponse['currency'];
                    $paymentStatus = $paymenyResponse['status'];
                    $paymentDate = date("Y-m-d H:i:s");
                    if ($paymentStatus == 'succeeded') {
                        $tran_data = array(
                            'user_name' => $cardholder, 'user_id' => $userId, 'order_id' => $orderID, 'tran_id' => $balanceTransaction, 'address' => $address, 'country' => $country, 'state' => $state, 'city' => $city, 'zipcode' => $zipcode, 'amount' => $amount, 'payment_type' => '2', 'status' => $paymentStatus, 'currency' => $paidCurrency, 'event_id' => $eventId, 'payment_in' => $payment_in, 'created_at' => date('Y-m-d H:i:s')
                        );
                        $result = $this->Mymodel->add('transaction', $tran_data);
                        if (!empty($result)) {
                            $update_query = $this->db->query("update event_invited_people set transaction = 'Paid' where email = '" . @$email . "' and event_id = " . @$eventId . "");
                            $msg = '<p>Your event payment has been successfully completed.</p>';
                            redirect(base_url("stripeEventPaymentStatus?statusMsg=" . $msg . "&status=" . $paymentStatus . "&txnId=" . $balanceTransaction . "&userId=" . @$userId . ""), 'refresh');
                        }
                    }
                } else {
                    $statusMsg = "Transaction has been failed!";
                    $payment_status = 'failed';
                    $txnId = '';
                    redirect(base_url("stripeEventPaymentStatus?statusMsg=" . $statusMsg . "&status=" . $payment_status . "&txnId=" . $txnId . "&userId=" . @$userId . ""), 'refresh');
                }
            }
        }
    }
    function stripeEventPaymentStatus() {
        echo "<br>" . $statusMsg = @$_GET['statusMsg'] . "<br>";
        echo "Status : " . "<br>" . $status = @$_GET['status'] . "<br>";
        echo "txnId : " . "<br>" . $txnId = @$_GET['txnId'] . "<br>";
        echo "userId :" . "<br>" . $userId = @$_GET['userId'] . "<br>";
    }
    function paypalPayment() {
        $this->load->library('paypal_lib');
        $data['eventId'] = $eventId = @$_GET['eventId'];
        $data['userId'] = $userId = @$_GET['userId'];
        $data['amount'] = $amount = @$_GET['amount'];
        $this->session->set_userdata('PaypalWebViewEid', $eventId);
        $event = $this->Mymodel->get_single_row_info('*', 'event', 'event_id = ' . $eventId . ' and status = "1"', '', 1);
        $host = $this->Mymodel->get_single_row_info('stripe_acc_id', 'stripe_connected_acc', 'user_id = ' . $event->user_id . '', '', 1);
        $event_name = $event->event_name;
        $item_number = "TEST_" . $this->generate_otp(6);
        $price = $amount;
        $returnURL = base_url() . 'welcome/paypalSuccess';
        $cancelURL = base_url() . 'welcome/paypalCancel';
        $notifyURL = base_url() . 'welcome/paypalIpn';
        
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', @$event_name);
        $this->paypal_lib->add_field('custom', $userId . '|' . $eventId);
        $this->paypal_lib->add_field('item_number', $item_number);
        $this->paypal_lib->add_field('amount', $price);
        $this->paypal_lib->paypal_auto_form();
    }

    function paypalSuccess() {
        $paypalInfo = $this->input->post();
        if (!empty($paypalInfo)) {
            $expData = explode('|', @$paypalInfo['custom']);
            $userId = $expData[0];
            $event_id = $expData[1];
            $order_id = $paypalInfo["item_number"];
            $txn_id = $paypalInfo["txn_id"];
            $amount = $paypalInfo["mc_gross"];
            $currency_code = $paypalInfo["mc_currency"];
            $payer_email = $paypalInfo["payer_email"];
            $created_at = date('Y-m-d H:m:i');
            $payment_type = 2;
            $payment_mode = 2;
            $address = $paypalInfo["address_street"] . ', ' . $paypalInfo["address_city"] . ', ' . $paypalInfo["address_state"] . ', ' . $paypalInfo["address_country_code"];
            $user_name = $paypalInfo["first_name"] . ' ' . $paypalInfo["last_name"];
            $zipcode = $paypalInfo["address_zip"];
            $country = $paypalInfo["residence_country"];
            $state = $paypalInfo["address_state"];
            $city = $paypalInfo["address_city"];
            $paid_by_admin = 1;
            $payment_in = 'Full Payment';
            $payer_id = $paypalInfo["payer_id"];
            if ($paypalInfo["payment_status"] == 'Completed') {
                $status = 'succeeded';
                $data = array(
                    'user_name' => $user_name,
                    'user_id' => $userId,
                    'event_id' => $event_id,
                    'order_id' => $order_id,
                    'tran_id' => $txn_id,
                    'address' => $address,
                    'country' => $country,
                    'state' => $state,
                    'city' => $city,
                    'zipcode' => $zipcode,
                    'amount' => $amount,
                    'payment_type' => $payment_type,
                    'currency' => $currency_code,
                    'status' => $status,
                    'paid_by_admin' => $paid_by_admin,
                    'payment_in' => $payment_in,
                    'payment_mode' => $payment_mode,
                    'payer_email' => $payer_email,
                    'created_at' => $created_at
                );
                $result = $this->Mymodel->add('transaction', $data);
                if ($result) {
                    $msg = 'Your event payment has been successfully completed.';
                    redirect(base_url("paypalEventPaymentStatus?statusMsg=" . $msg . "&status=" . $status . "&txnId=" . $txn_id . "&userId=" . @$userId . ""), 'refresh');
                }
            } else {
                $status = 'failed';
                $txn_id = '';
                $msg = 'Transaction has been failed!';
                redirect(base_url("paypalEventPaymentStatus?statusMsg=" . $msg . "&status=" . $status . "&txnId=" . $txn_id . "&userId=" . @$userId . ""), 'refresh');
            }
        } else {
            $status = 'failed';
            $txn_id = '';
            $msg = 'Transaction has been failed!';
            redirect(base_url("paypalEventPaymentStatus?statusMsg=" . $msg . "&status=" . $status . "&txnId=" . $txn_id . "&userId=" . @$userId . ""), 'refresh');
        }
    }
    function paypalIpn() {
        $this->load->library('paypal_lib');
        $paypalInfo = $this->input->get();
        $paypalURL = $this->paypal_lib->paypal_url;
        $result = $this->paypal_lib->curlPost($paypalURL, $paypalInfo);
        if (preg_match("/VERIFIED/i", $result)) {
        }
    }
    function paypalCancel() {
        $status = 'failed';
        $txn_id = '';
        $userId = '';
        $msg = 'Your transaction was canceled!';
        redirect(base_url("paypalEventPaymentStatus?statusMsg=" . $msg . "&status=" . $status . "&txnId=" . $txn_id . "&userId=" . @$userId . ""), 'refresh');
    }
    function paypalEventPaymentStatus() {
        echo "<br>" . $statusMsg = @$_GET['statusMsg'] . "<br>";
        echo "Status : " . "<br>" . $status = @$_GET['status'] . "<br>";
        echo "txnId : " . "<br>" . $txnId = @$_GET['txnId'] . "<br>";
        echo "userId :" . "<br>" . $userId = @$_GET['userId'] . "<br>";
    }
}
