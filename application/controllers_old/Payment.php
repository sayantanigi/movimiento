<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Square\SquareClient;
use Square\Exceptions\ApiException;
use Square\Environment;
use Square\Models\Money;
use Square\Models\CreatePaymentRequest;

class Payment extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Apimodel');
		$this->load->model('Commonmodel');
		// $this->isLoggedIn();
		require 'vendor/autoload.php';
	}

	public function testInput($data)
	{
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function createPayment($course_id = null)
	{

		$user_id = $this->session->userdata('user_id');

		$data = json_decode(file_get_contents('php://input'), true);


		$client = new SquareClient([
			'accessToken' => 'EAAAED6ZVeDUinmdr_63zyHSowZMF9yGr2Q3ygxFbYZMwoLinZGjxvRUdFJQ0_bl',
			'environment' => Environment::SANDBOX,
		]);

		try {

			$payments_api = $client->getPaymentsApi();

			$price = ($data['course_price'] * 100);
			$money = new Money();
			$money->setAmount($price);
			// Set currency to the currency for the location
			$money->setCurrency('USD');
			$orderId = rand(9000, 1000);

			// Every payment you process with the SDK must have a unique idempotency key.
			// If you're unsure whether a particular payment succeeded, you can reattempt
			// it with the same idempotency key without worrying about double charging
			// the buyer.
			$create_payment_request = new CreatePaymentRequest($data['sourceId'], $orderId, $money);

			$response = $payments_api->createPayment($create_payment_request);


			if ($response->isSuccess()) {
				$resp_arr = $response->getBody();
				$resp_dec = json_decode($resp_arr, true);

				$status = $resp_dec["payment"]['status'];
				$transid = $resp_dec["payment"]["id"];

				$enrollmentData = array(
					'currency' 				    => 'USD',
					'currency_symbol' 		    => '$',
					'course_id' 				=> $data['course_id'],
					'user_id' 				    => $user_id,
					'enrollment_price' 		    => $data['course_price'],
					'transaction_id' 			=> $transid,
					'price_cents' 				=> $price,
					'payment_status'            => $status,
					'order_id'            		=> $orderId,
					// 'enrollment_date' 			=> date('Y-m-d H:i:s')
				);

				//insert code
				$lastId = $this->Commonmodel->add_details('course_enrollment', $enrollmentData);

				if ($lastId) {

					$sql = "select u.fname,u.lname,u.email,c.title,ce.* from course_enrollment ce inner join users u on u.id = ce.user_id inner join courses c on c.id = ce.course_id where ce.enrollment_id='$lastId'";
					$fetch_data = $this->db->query($sql)->row();
					$course_name = @$fetch_data->title;
					$user_name = @$fetch_data->fname." ".@$fetch_data->lname;

					$enrollment_date=date('d M Y', strtotime(@$fetch_data->enrollment_date));
					$enrollment_price=@$fetch_data->price_cents;
					$transaction_id=@$fetch_data->transaction_id;
					$email=@$fetch_data->email;
					$enrollment_id=base64_encode($fetch_data->enrollment_id);

					




					// $subject = $sub;
					$subject = 'Course Enrollment';
					$imagePath = base_url() . 'user_assets/images/C2C_Home/mailhead.jpg';
					$unsubscribe = base_url() . 'email_unsubscribe/'.$enrollment_id;
					$message = "<table style='width: 100%;'><tr><td><table style='width: 800px; height: 800px; margin: 0 auto; border: 1px solid #bbb;'><tr><td colspan='3' style='height: 250px;'><img src='" . $imagePath . "'></td></tr><tr><td style='width: 100px; height: 410px;'></td><td style='width: 600px; height: 410px;'><table style='width: 100%; height: 410px;'><tr><td colspan='2' style='text-align: center; font-size: 25px; font-weight: 600;'>Course Enrollment from Concept To Creation</td></tr><tr><td style='width: 50%; font-size: 18px; font-weight: 600;'>Buyer Name</td><td style='width: 50%; color: #8d8d8d;'>$user_name</td></tr><tr><td style='width: 50%; font-size: 18px; font-weight: 600;'>Course Name</td><td style='width: 50%; color: #8d8d8d;'>$course_name</td></tr><tr><td style='width: 50%; font-size: 18px; font-weight: 600;'>Order Id</td><td style='width: 50%; color: #8d8d8d;'>$orderId</td></tr><tr><td style='width: 50%; font-size: 18px; font-weight: 600;'>Enrollment Date</td><td style='width: 50%; color: #8d8d8d;'>$enrollment_date</td></tr><tr><td style='width: 50%; font-size: 18px; font-weight: 600;'>Enrollment Price</td><td style='width: 50%; color: #8d8d8d;'>$enrollment_price</td></tr><tr><td style='width: 50%; font-size: 18px; font-weight: 600;'>Transaction Id</td><td style='width: 50%;color: #8d8d8d;'>$transaction_id</td></tr></table></td><td style='width: 100px; height: 410px;'></td></tr><tr><td style='width: 100px;'></td><td style='border-top: 1px solid #8d8d8d; border-bottom: 1px solid #8d8d8d; height: 100px; text-align: center; width: 600px;'><p style='width: 400px; margin: auto; color: #8d8d8d;'>call at 1800-126-457-5 <a href='$unsubscribe'>Click to Unsubscribe</a></p></td><td style='width: 100px;'></td></tr><tr><td colspan='3' style='height: 40px;'></td></tr></table></td></tr></table>";
					$mail = new PHPMailer(true);
					try {
						//Server settings
						$mail->CharSet = 'UTF-8';
						$mail->SetFrom($email);
						$mail->AddAddress($email, 'ContactToCreation');
						$mail->IsHTML(true);
						$mail->Subject = $subject;
						$mail->Body = $message;
						//Send email via SMTP
						$mail->IsSMTP();
						$mail->send();
						// echo 'Message has been sent';
					} catch (Exception $e) {
						$this->session->set_flashdata('error_message', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
					}
					// echo $msg = "Thank You for Contacting Us";




					$this->session->set_flashdata('success', 'Thanks! Your enrollment is successfull.');
				} else {
					$this->session->set_flashdata('error', 'Sorry! enrollment is not done.');
				}

				echo json_encode($response->getResult());
			} else {
				echo json_encode($response->getErrors());
				$this->session->set_flashdata('error', 'Sorry! enrollment is not done.');
			}
		} catch (ApiException $e) {
			// echo "ApiException occurred: <b/>";
			// echo $e->getMessage() . "<p/>";
			$this->session->set_flashdata('error', 'Sorry! enrollment is not done. ApiException occurred!');
		}
	}

	public function paymentStatus()
	{

		$user_id = $this->session->userdata('user_id');

		$data = array(
			'title' => 'Course Enrollment Successfull',
			'page' => 'course',
		);

		$this->load->view('header', $data);
		$this->load->view('payment-success');
		$this->load->view('footer');
	}
}
