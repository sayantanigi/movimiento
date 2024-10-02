<?php
ob_start();
error_reporting(0);
class Subscription extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library(array('form_validation', 'session'));
		if ($this->session->userdata('isLoggedIn') != 1) {
			redirect('login', 'refresh');
		}
		$this->load->model('supercontrol/category_model', 'cat');
		$this->load->library('form_validation');
		$this->load->model('generalmodel');
		$this->load->model('supercontrol/instructor_model');
		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->library('image_lib');

	}
	function index() {
		$data['subscription'] = $this->generalmodel->getAllData('subscription', 'status =', '1', '', '');
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/subscription/showallsubscriptionlist', $data);
		$this->load->view('supercontrol/footer');
	}
	function userSubscription(){
        $getUsename = $this->db->query("SELECT * FROM users WHERE status = '1' and email_verified = '1' AND id = '".$_POST['user_id']."'")->row();
        $getSubDetails = $this->db->query("SELECT * FROM subscription WHERE id = '".$_POST['subscription_id']."'")->row();
        $_SESSION['subscription_id'] = $getSubDetails->id;
		/*$paymentDate = date('Y-m-d H:i:s');
		$n=24;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}
		$data = array(
			'employer_id' => $getUsename->id,
			'subscription_id' => $getSubDetails->id,
			'name_of_card' => $getSubDetails->subscription_name,
			'email' => $getUsename->email,
			'amount' => $getSubDetails->subscription_amount,
			'duration' => $getSubDetails->subscription_duration,
			'transaction_id' => "sub_".$randomString,
			'payment_date' => $paymentDate,
			'created_date' => $paymentDate,
			'payment_status' => 'paid',
            'expiry_date' => date('Y-m-d', strtotime('+30 days', strtotime($paymentDate)))
		);
        print_r($data); die();
		$this->Crud_model->SaveData('employer_subscription', $data);
		$insert_id = $this->db->insert_id();
		if(!empty($insert_id)) {
			echo '1';
		} else {
			echo '2';
		}*/
        echo $payment_link = $getSubDetails->payment_link;
	}
    public function thank_you() {
        require 'vendor/autoload.php';
        require_once APPPATH."third_party/stripe/init.php";

        // The library needs to be configured with your account's secret key.
        // Ensure the key is kept out of any version control system you might be using.
        $stripe = new \Stripe\StripeClient('sk_test_...');

        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = 'whsec_31f0a35ffa6da882f0dec4c8453bba1fa45f366df2839a3673cae44b1b3c3709';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
        );
        } catch(\UnexpectedValueException $e) {
        // Invalid payload
        http_response_code(400);
        exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
        // Invalid signature
        http_response_code(400);
        exit();
        }

        // Handle the event
        switch ($event->type) {
        case 'account.updated':
            $data = $account = $event->data->object;
        case 'account.application.authorized':
            $data = $application = $event->data->object;
        case 'account.application.deauthorized':
            $data = $application = $event->data->object;
        case 'account.external_account.created':
            $data = $externalAccount = $event->data->object;
        case 'account.external_account.deleted':
            $data = $externalAccount = $event->data->object;
        case 'account.external_account.updated':
            $data = $externalAccount = $event->data->object;
        case 'application_fee.created':
            $data = $applicationFee = $event->data->object;
        case 'application_fee.refunded':
            $data = $applicationFee = $event->data->object;
        case 'application_fee.refund.updated':
            $data = $refund = $event->data->object;
        case 'balance.available':
            $data = $balance = $event->data->object;
        case 'billing.alert.triggered':
            $data = $alert = $event->data->object;
        case 'billing_portal.configuration.created':
            $data = $configuration = $event->data->object;
        case 'billing_portal.configuration.updated':
            $data = $configuration = $event->data->object;
        case 'billing_portal.session.created':
            $data = $session = $event->data->object;
        case 'capability.updated':
            $data = $capability = $event->data->object;
        case 'cash_balance.funds_available':
            $data = $cashBalance = $event->data->object;
        case 'charge.captured':
            $data = $charge = $event->data->object;
        case 'charge.expired':
            $data = $charge = $event->data->object;
        case 'charge.failed':
            $data = $charge = $event->data->object;
        case 'charge.pending':
            $data = $charge = $event->data->object;
        case 'charge.refunded':
            $data = $charge = $event->data->object;
        case 'charge.succeeded':
            $data = $charge = $event->data->object;
        case 'charge.updated':
            $data = $charge = $event->data->object;
        case 'charge.dispute.closed':
            $data = $dispute = $event->data->object;
        case 'charge.dispute.created':
            $data = $dispute = $event->data->object;
        case 'charge.dispute.funds_reinstated':
            $data = $dispute = $event->data->object;
        case 'charge.dispute.funds_withdrawn':
            $data = $dispute = $event->data->object;
        case 'charge.dispute.updated':
            $data = $dispute = $event->data->object;
        case 'charge.refund.updated':
            $data = $refund = $event->data->object;
        case 'checkout.session.async_payment_failed':
            $data = $session = $event->data->object;
        case 'checkout.session.async_payment_succeeded':
            $data = $session = $event->data->object;
        case 'checkout.session.completed':
            $data = $session = $event->data->object;
        case 'checkout.session.expired':
            $data = $session = $event->data->object;
        case 'climate.order.canceled':
            $data = $order = $event->data->object;
        case 'climate.order.created':
            $data = $order = $event->data->object;
        case 'climate.order.delayed':
            $data = $order = $event->data->object;
        case 'climate.order.delivered':
            $data = $order = $event->data->object;
        case 'climate.order.product_substituted':
            $data = $order = $event->data->object;
        case 'climate.product.created':
            $data = $product = $event->data->object;
        case 'climate.product.pricing_updated':
            $data = $product = $event->data->object;
        case 'coupon.created':
            $data = $coupon = $event->data->object;
        case 'coupon.deleted':
            $data = $coupon = $event->data->object;
        case 'coupon.updated':
            $data = $coupon = $event->data->object;
        case 'credit_note.created':
            $data = $creditNote = $event->data->object;
        case 'credit_note.updated':
            $data = $creditNote = $event->data->object;
        case 'credit_note.voided':
            $data = $creditNote = $event->data->object;
        case 'customer.created':
            $data = $customer = $event->data->object;
        case 'customer.deleted':
            $data = $customer = $event->data->object;
        case 'customer.updated':
            $data = $customer = $event->data->object;
        case 'customer.discount.created':
            $data = $discount = $event->data->object;
        case 'customer.discount.deleted':
            $data = $discount = $event->data->object;
        case 'customer.discount.updated':
            $data = $discount = $event->data->object;
        case 'customer.source.created':
            $data = $source = $event->data->object;
        case 'customer.source.deleted':
            $data = $source = $event->data->object;
        case 'customer.source.expiring':
            $data = $source = $event->data->object;
        case 'customer.source.updated':
            $data = $source = $event->data->object;
        case 'customer.subscription.created':
            $data = $subscription = $event->data->object;
        case 'customer.subscription.deleted':
            $data = $subscription = $event->data->object;
        case 'customer.subscription.paused':
            $data = $subscription = $event->data->object;
        case 'customer.subscription.pending_update_applied':
            $data = $subscription = $event->data->object;
        case 'customer.subscription.pending_update_expired':
            $data = $subscription = $event->data->object;
        case 'customer.subscription.resumed':
            $data = $subscription = $event->data->object;
        case 'customer.subscription.trial_will_end':
            $data = $subscription = $event->data->object;
        case 'customer.subscription.updated':
            $data = $subscription = $event->data->object;
        case 'customer.tax_id.created':
            $data = $taxId = $event->data->object;
        case 'customer.tax_id.deleted':
            $data = $taxId = $event->data->object;
        case 'customer.tax_id.updated':
            $data = $taxId = $event->data->object;
        case 'customer_cash_balance_transaction.created':
            $data = $customerCashBalanceTransaction = $event->data->object;
        case 'entitlements.active_entitlement_summary.updated':
            $data = $activeEntitlementSummary = $event->data->object;
        case 'file.created':
            $data = $file = $event->data->object;
        case 'financial_connections.account.created':
            $data = $account = $event->data->object;
        case 'financial_connections.account.deactivated':
            $data = $account = $event->data->object;
        case 'financial_connections.account.disconnected':
            $data = $account = $event->data->object;
        case 'financial_connections.account.reactivated':
            $data = $account = $event->data->object;
        case 'financial_connections.account.refreshed_balance':
            $data = $account = $event->data->object;
        case 'financial_connections.account.refreshed_ownership':
            $data = $account = $event->data->object;
        case 'financial_connections.account.refreshed_transactions':
            $data = $account = $event->data->object;
        case 'identity.verification_session.canceled':
            $data = $verificationSession = $event->data->object;
        case 'identity.verification_session.created':
            $data = $verificationSession = $event->data->object;
        case 'identity.verification_session.processing':
            $data = $verificationSession = $event->data->object;
        case 'identity.verification_session.requires_input':
            $data = $verificationSession = $event->data->object;
        case 'identity.verification_session.verified':
            $data = $verificationSession = $event->data->object;
        case 'invoice.created':
            $data = $invoice = $event->data->object;
        case 'invoice.deleted':
            $data = $invoice = $event->data->object;
        case 'invoice.finalization_failed':
            $data = $invoice = $event->data->object;
        case 'invoice.finalized':
            $data = $invoice = $event->data->object;
        case 'invoice.marked_uncollectible':
            $data = $invoice = $event->data->object;
        case 'invoice.overdue':
            $data = $invoice = $event->data->object;
        case 'invoice.paid':
            $data = $invoice = $event->data->object;
        case 'invoice.payment_action_required':
            $data = $invoice = $event->data->object;
        case 'invoice.payment_failed':
            $data = $invoice = $event->data->object;
        case 'invoice.payment_succeeded':
            $data = $invoice = $event->data->object;
        case 'invoice.sent':
            $data = $invoice = $event->data->object;
        case 'invoice.upcoming':
            $data = $invoice = $event->data->object;
        case 'invoice.updated':
            $data = $invoice = $event->data->object;
        case 'invoice.voided':
            $data = $invoice = $event->data->object;
        case 'invoice.will_be_due':
            $data = $invoice = $event->data->object;
        case 'invoiceitem.created':
            $data = $invoiceitem = $event->data->object;
        case 'invoiceitem.deleted':
            $data = $invoiceitem = $event->data->object;
        case 'issuing_authorization.created':
            $data = $issuingAuthorization = $event->data->object;
        case 'issuing_authorization.updated':
            $data = $issuingAuthorization = $event->data->object;
        case 'issuing_card.created':
            $data = $issuingCard = $event->data->object;
        case 'issuing_card.updated':
            $data = $issuingCard = $event->data->object;
        case 'issuing_cardholder.created':
            $data = $issuingCardholder = $event->data->object;
        case 'issuing_cardholder.updated':
            $data = $issuingCardholder = $event->data->object;
        case 'issuing_dispute.closed':
            $data = $issuingDispute = $event->data->object;
        case 'issuing_dispute.created':
            $data = $issuingDispute = $event->data->object;
        case 'issuing_dispute.funds_reinstated':
            $data = $issuingDispute = $event->data->object;
        case 'issuing_dispute.funds_rescinded':
            $data = $issuingDispute = $event->data->object;
        case 'issuing_dispute.submitted':
            $data = $issuingDispute = $event->data->object;
        case 'issuing_dispute.updated':
            $data = $issuingDispute = $event->data->object;
        case 'issuing_personalization_design.activated':
            $data = $issuingPersonalizationDesign = $event->data->object;
        case 'issuing_personalization_design.deactivated':
            $data = $issuingPersonalizationDesign = $event->data->object;
        case 'issuing_personalization_design.rejected':
            $data = $issuingPersonalizationDesign = $event->data->object;
        case 'issuing_personalization_design.updated':
            $data = $issuingPersonalizationDesign = $event->data->object;
        case 'issuing_token.created':
            $data = $issuingToken = $event->data->object;
        case 'issuing_token.updated':
            $data = $issuingToken = $event->data->object;
        case 'issuing_transaction.created':
            $data = $issuingTransaction = $event->data->object;
        case 'issuing_transaction.updated':
            $data = $issuingTransaction = $event->data->object;
        case 'mandate.updated':
            $data = $mandate = $event->data->object;
        case 'payment_intent.amount_capturable_updated':
            $data = $paymentIntent = $event->data->object;
        case 'payment_intent.canceled':
            $data = $paymentIntent = $event->data->object;
        case 'payment_intent.created':
            $data = $paymentIntent = $event->data->object;
        case 'payment_intent.partially_funded':
            $data = $paymentIntent = $event->data->object;
        case 'payment_intent.payment_failed':
            $data = $paymentIntent = $event->data->object;
        case 'payment_intent.processing':
            $data = $paymentIntent = $event->data->object;
        case 'payment_intent.requires_action':
            $data = $paymentIntent = $event->data->object;
        case 'payment_intent.succeeded':
            $data = $paymentIntent = $event->data->object;
        case 'payment_link.created':
            $data = $paymentLink = $event->data->object;
        case 'payment_link.updated':
            $data = $paymentLink = $event->data->object;
        case 'payment_method.attached':
            $data = $paymentMethod = $event->data->object;
        case 'payment_method.automatically_updated':
            $data = $paymentMethod = $event->data->object;
        case 'payment_method.detached':
            $data = $paymentMethod = $event->data->object;
        case 'payment_method.updated':
            $data = $paymentMethod = $event->data->object;
        case 'payout.canceled':
            $data = $payout = $event->data->object;
        case 'payout.created':
            $data = $payout = $event->data->object;
        case 'payout.failed':
            $data = $payout = $event->data->object;
        case 'payout.paid':
            $data = $payout = $event->data->object;
        case 'payout.reconciliation_completed':
            $data = $payout = $event->data->object;
        case 'payout.updated':
            $data = $payout = $event->data->object;
        case 'person.created':
            $data = $person = $event->data->object;
        case 'person.deleted':
            $data = $person = $event->data->object;
        case 'person.updated':
            $data = $person = $event->data->object;
        case 'plan.created':
            $data = $plan = $event->data->object;
        case 'plan.deleted':
            $data = $plan = $event->data->object;
        case 'plan.updated':
            $data = $plan = $event->data->object;
        case 'price.created':
            $data = $price = $event->data->object;
        case 'price.deleted':
            $data = $price = $event->data->object;
        case 'price.updated':
            $data = $price = $event->data->object;
        case 'product.created':
            $data = $product = $event->data->object;
        case 'product.deleted':
            $data = $product = $event->data->object;
        case 'product.updated':
            $data = $product = $event->data->object;
        case 'promotion_code.created':
            $data = $promotionCode = $event->data->object;
        case 'promotion_code.updated':
            $data = $promotionCode = $event->data->object;
        case 'quote.accepted':
            $data = $quote = $event->data->object;
        case 'quote.canceled':
            $data = $quote = $event->data->object;
        case 'quote.created':
            $data = $quote = $event->data->object;
        case 'quote.finalized':
            $data = $quote = $event->data->object;
        case 'quote.will_expire':
            $data = $quote = $event->data->object;
        case 'radar.early_fraud_warning.created':
            $data = $earlyFraudWarning = $event->data->object;
        case 'radar.early_fraud_warning.updated':
            $data = $earlyFraudWarning = $event->data->object;
        case 'refund.created':
            $data = $refund = $event->data->object;
        case 'refund.failed':
            $data = $refund = $event->data->object;
        case 'refund.updated':
            $data = $refund = $event->data->object;
        case 'reporting.report_run.failed':
            $data = $reportRun = $event->data->object;
        case 'reporting.report_run.succeeded':
            $data = $reportRun = $event->data->object;
        case 'review.closed':
            $data = $review = $event->data->object;
        case 'review.opened':
            $data = $review = $event->data->object;
        case 'setup_intent.canceled':
            $data = $setupIntent = $event->data->object;
        case 'setup_intent.created':
            $data = $setupIntent = $event->data->object;
        case 'setup_intent.requires_action':
            $data = $setupIntent = $event->data->object;
        case 'setup_intent.setup_failed':
            $data = $setupIntent = $event->data->object;
        case 'setup_intent.succeeded':
            $data = $setupIntent = $event->data->object;
        case 'sigma.scheduled_query_run.created':
            $data = $scheduledQueryRun = $event->data->object;
        case 'source.canceled':
            $data = $source = $event->data->object;
        case 'source.chargeable':
            $data = $source = $event->data->object;
        case 'source.failed':
            $data = $source = $event->data->object;
        case 'source.mandate_notification':
            $data = $source = $event->data->object;
        case 'source.refund_attributes_required':
            $data = $source = $event->data->object;
        case 'source.transaction.created':
            $data = $transaction = $event->data->object;
        case 'source.transaction.updated':
            $data = $transaction = $event->data->object;
        case 'subscription_schedule.aborted':
            $data = $subscriptionSchedule = $event->data->object;
        case 'subscription_schedule.canceled':
            $data = $subscriptionSchedule = $event->data->object;
        case 'subscription_schedule.completed':
            $data = $subscriptionSchedule = $event->data->object;
        case 'subscription_schedule.created':
            $data = $subscriptionSchedule = $event->data->object;
        case 'subscription_schedule.expiring':
            $data = $subscriptionSchedule = $event->data->object;
        case 'subscription_schedule.released':
            $data = $subscriptionSchedule = $event->data->object;
        case 'subscription_schedule.updated':
            $data = $subscriptionSchedule = $event->data->object;
        case 'tax.settings.updated':
            $data = $settings = $event->data->object;
        case 'tax_rate.created':
            $data = $taxRate = $event->data->object;
        case 'tax_rate.updated':
            $data = $taxRate = $event->data->object;
        case 'terminal.reader.action_failed':
            $data = $reader = $event->data->object;
        case 'terminal.reader.action_succeeded':
            $data = $reader = $event->data->object;
        case 'test_helpers.test_clock.advancing':
            $data = $testClock = $event->data->object;
        case 'test_helpers.test_clock.created':
            $data = $testClock = $event->data->object;
        case 'test_helpers.test_clock.deleted':
            $data = $testClock = $event->data->object;
        case 'test_helpers.test_clock.internal_failure':
            $data = $testClock = $event->data->object;
        case 'test_helpers.test_clock.ready':
            $data = $testClock = $event->data->object;
        case 'topup.canceled':
            $data = $topup = $event->data->object;
        case 'topup.created':
            $data = $topup = $event->data->object;
        case 'topup.failed':
            $data = $topup = $event->data->object;
        case 'topup.reversed':
            $data = $topup = $event->data->object;
        case 'topup.succeeded':
            $data = $topup = $event->data->object;
        case 'transfer.created':
            $data = $transfer = $event->data->object;
        case 'transfer.reversed':
            $data = $transfer = $event->data->object;
        case 'transfer.updated':
            $data = $transfer = $event->data->object;
        // ... handle other event types
        default:
            echo 'Received unknown event type ' . $event->type;
        }
        print_r($data);
        http_response_code(200);
        die();
        $this->load->view('supercontrol/header');
		$this->load->view('supercontrol/subscription/thank_you');
		$this->load->view('supercontrol/footer');
    }
}
?>