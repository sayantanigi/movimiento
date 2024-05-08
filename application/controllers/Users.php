<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Users extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Apimodel');
		$this->load->model('Commonmodel');
		// $this->isLoggedIn();
		require 'vendor/autoload.php';
		if (!$this->session->has_userdata('isLoggedIn') || !$this->session->has_userdata('user_id')) {
			$redirectto = urlencode(current_url());
			redirect(base_url('login?redirectto=' . $redirectto), 'refresh');
		}
	}
	public function index() {
		$data = array('title' => 'Student Dashboard', 'page' => 'dashboard');
		$user_id = $this->session->userdata('user_id');
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$getEnrolmentSql = "SELECT * FROM `course_enrollment` WHERE `user_id` = '" . $user_id . "' and `payment_status` = 'COMPLETED'";
		$data['ctn_enrolment'] = $this->db->query($getEnrolmentSql)->num_rows();
		$data['enrolments'] = $this->db->query($getEnrolmentSql)->result();
		//$getEnrolmentSql = "SELECT COUNT(DISTINCT `enrollment_id`) AS activeCourse FROM `course_enrollment_status` WHERE `user_id` = '" . $user_id . "'";
		//$data['active_data'] = $this->db->query($getEnrolmentSql)->row();
		$this->load->view('header', $data);
		$this->load->view('dashboard');
		$this->load->view('footer');
	}
	public function profile() {
		$data = array('title' => 'Student Profile','page' => 'profile');
		$user_id = $this->session->userdata('user_id');
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$where = array('id' => $user_id);
		$getEnrolmentSql = "SELECT * FROM `course_enrollment` WHERE `user_id` = '" . $user_id . "' and `payment_status` = 'COMPLETED'";
		$data['ctn_enrolment'] = $this->db->query($getEnrolmentSql)->num_rows();
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$this->load->view('header', $data);
		$this->load->view('profile');
		$this->load->view('footer');
	}
	public function purchaseList() {
		$data = array(
			'title' => 'Purchase History',
			'page' => 'purchase',
		);
		$user_id = $this->session->userdata('user_id');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$getPurchaseSql = "SELECT ctrl.*, cour.title FROM `course_enrollment` as ctrl INNER JOIN `courses` as cour ON cour.id = ctrl.course_id WHERE ctrl.user_id = '" . $user_id . "' ORDER BY ctrl.enrollment_date DESC";
		$data['orders'] = $this->Commonmodel->fetch_all_join($getPurchaseSql);
		$getEnrolmentSql = "SELECT * FROM `course_enrollment` WHERE `user_id` = '" . $user_id . "' and `payment_status` = 'COMPLETED'";
		$data['ctn_enrolment'] = $this->db->query($getEnrolmentSql)->num_rows();
		$this->load->view('header', $data);
		$this->load->view('purchase-list');
		$this->load->view('footer');
	}
	public function reviews() {
		$data = array(
			'title' => 'Reviews',
			'page' => 'reviews',
		);
		$user_id = $this->session->userdata('user_id');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$getReviewsSql = "SELECT ctrl.*, cour.title, cour.image FROM `course_reviews` as ctrl INNER JOIN `courses` as cour ON cour.id = ctrl.course_id WHERE ctrl.user_id = '".$user_id."' ORDER BY ctrl.review_date DESC";
		$data['reviews'] = $this->Commonmodel->fetch_all_join($getReviewsSql);
		$getEnrolmentSql = "SELECT * FROM `course_enrollment` WHERE `user_id` = '" . $user_id . "' and `payment_status` = 'COMPLETED'";
		$data['ctn_enrolment'] = $this->db->query($getEnrolmentSql)->num_rows();
		$this->load->view('header', $data);
		$this->load->view('reviews');
		$this->load->view('footer');
	}
	public function editProfile() {
		$data = array(
			'title' => 'Edit Profile',
			'page' => 'profile',
		);
		$user_id = $this->session->userdata('user_id');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$getEnrolmentSql = "SELECT * FROM `course_enrollment` WHERE `user_id` = '" . $user_id . "' and `payment_status` = 'COMPLETED'";
		$data['ctn_enrolment'] = $this->db->query($getEnrolmentSql)->num_rows();
		$this->load->view('header', $data);
		$this->load->view('edit-profile');
		$this->load->view('footer');
	}
	public function testInput($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	public function profileUpdate() {
		//echo "test"; die();
		$user_id = $this->session->userdata('user_id');
		$oldImage = $this->input->post('old_image');
		$email = $this->input->post('email');
		$first_name = $this->testInput($this->input->post('first_name'));
		//$last_name = $this->testInput($this->input->post('last_name'));
		$phone_full = $this->input->post('phone_full');
		$phone_code = $this->input->post('phone_code');
		$phone_country = $this->input->post('phone_country');
		$phone_st_country = $this->input->post('phone_st_country');
		$check_email = $this->db->get_where('users', array('email' => $email, 'id !=' => $user_id))->num_rows();
		if ($check_email > 0) {
			$this->session->set_flashdata('error', 'The email id you are trying to use is already registered. Please try unique email address!');
			redirect(base_url('edit-profile'), 'refresh');
		}
		$where = array('id' => @$user_id);
		$mydata = array(
			'fname' => $first_name, 
			'email' => $email, 
			'phone' => $this->input->post('phone'), 
			'phone_full' => $phone_full, 
			'skills' => $this->input->post('skills'),
			'phone_code' => $phone_code, 
			'phone_country' => $phone_country, 
			'phone_st_country' => $phone_st_country, 
			'user_bio' => $this->input->post('user_bio')
		);
		//print_r($mydata); die();
		if ($_FILES['profile_image']['name'] != '') {
			$config['upload_path'] = './uploads/profile_pictures/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '*';
			$config['overwrite'] = false;
			$config['remove_spaces'] = TRUE;  //it will remove all spaces
			$config['encrypt_name'] = false;   //it wil encrypte the original file name
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('profile_image')) {
				$error = array('error' => $this->upload->display_errors());
				$msg = '["' . $error['error'] . '", "error", "#e50914"]';
			} else {
				// Uploaded file data 
				$fileData = $this->upload->data();
				$mydata['image'] = $fileData['file_name'];
			}
		}

		if ($this->input->post('password_edit') && $this->input->post('password_edit') != '') {
			$mydata['password'] = md5($this->input->post('password_edit'));
		}

		if (empty($mydata)) {
			$msg = '["Profile updated successfully!", "success", "#36A1EA"]';
		} else {
			if (!($this->Commonmodel->edit_single_row('users', $mydata, $where))) {
				$msg = '["Some error occured, Please try again!", "error", "#e50914"]';
			} else {
				if ($oldImage && $_FILES['profile_image']['name'] != '') {
					if (file_exists('./uploads/profile_pictures/' . $oldImage)) {
						@unlink('./uploads/profile_pictures/' . $oldImage);
					}
				}
				$msg = '["Profile updated successfully!", "success", "#36A1EA"]';
			}
		}
		$this->session->set_flashdata('msg', $msg);
		redirect(base_url('profile'), 'refresh');
	}
	public function enrolledCourse() {
		$data = array(
			'title' => 'Enrolled Courses',
			'page' => 'enrolled',
		);
		$user_id = $this->session->userdata('user_id');
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$getAllEnrolledSql = "SELECT cre.*, cr.* FROM `course_enrollment` cre INNER JOIN `courses` AS cr ON cr.id = cre.course_id WHERE cre.payment_status = 'COMPLETED' AND cre.user_id = '" . $user_id . "'";
		$data['courses'] = $this->Commonmodel->fetch_all_join($getAllEnrolledSql);
		$getEnrolmentSql = "SELECT * FROM `course_enrollment` WHERE `user_id` = '" . $user_id . "' and `payment_status` = 'COMPLETED'";
		$data['ctn_enrolment'] = $this->db->query($getEnrolmentSql)->num_rows();
		$this->load->view('header', $data);
		$this->load->view('enrolled-courses');
		$this->load->view('footer');
	}
	public function courseModule($id = null) {
		if (empty($id)) {
			redirect(base_url('enrolled-courses'), 'refresh');
		}
		$data = array(
			'title' => 'Enrolled Course Detail',
			'page' => 'enrolled',
		);
		$user_id = $this->session->userdata('user_id');
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$getEnrolledSql = "SELECT cre.*, cr.* FROM `course_enrollment` cre INNER JOIN `courses` AS cr ON cr.id = cre.course_id WHERE cre.enrollment_id = '" . $id . "'";
		$data['courses'] = $this->Commonmodel->fetch_single_join($getEnrolledSql);
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$this->load->view('header', $data);
		$this->load->view('enrolled-course-detail');
		$this->load->view('footer');
	}
	public function courseMaterial($enrollment_id = null, $id = null) {
		if (empty($id) && empty($enrollment_id)) {
			redirect(base_url('enrolled-courses'), 'refresh');
		}
		$data = array('title' => 'Module Details', 'page' => 'enrolled');
		$user_id = $this->session->userdata('user_id');
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$getEnrolledSql = "SELECT cre.*, cr.* FROM `course_enrollment` cre INNER JOIN `courses` AS cr ON cr.id = cre.course_id WHERE cre.enrollment_id = '" . $enrollment_id . "'";
		$data['courses'] = $this->Commonmodel->fetch_single_join($getEnrolledSql);
		$getModuleSql = "SELECT * FROM `course_modules` WHERE `id` = '" . @$id . "' ORDER BY `position_order` ASC";
		$data['module'] = $this->Commonmodel->fetch_single_join($getModuleSql);
		$data['enrollment_id'] = $enrollment_id;
		$getAllVideoSql = "SELECT * FROM `course_materials` WHERE `course_id` = '" . @$data['module']->course_id . "' AND `module` = '" . $id . "' AND `status` = '1' ORDER BY `position_order` ASC";
		$data['materials'] = $this->Commonmodel->fetch_all_join($getAllVideoSql);
		$this->load->view('header', $data);
		$this->load->view('enrolled-course-read');
		$this->load->view('footer');
	}
	public function completedMaterial() {
		$user_id = $this->session->userdata('user_id');
		$enrollment_id = $this->input->post('enrollment_id');
		$id = $this->input->post('id');
		// Get Material Details
		$getMaterialSql = "SELECT `course_id`, `module`, `material_type` FROM `course_materials` WHERE `id` = '" . @$id . "'";
		$materialData = $this->Commonmodel->fetch_single_join($getMaterialSql);
		$course_id = @$materialData->course_id;
		$module = @$materialData->module;
		$material_type = @$materialData->material_type;
		$isExitMaterialSql = "SELECT * FROM `course_enrollment_status` WHERE `user_id` = '" . $user_id . "' AND `course_id` = '" . $course_id . "' AND `module` = '" . $module . "' AND `material_id` = '" . $id . "'";
		$isExist = $this->db->query($isExitMaterialSql)->num_rows();
		if ($isExist == 0) {
			$materialData = array('enrollment_id' => @$enrollment_id, 'course_id' => @$course_id, 'module' => @$module, 'user_id' => @$user_id, 'material_id' => @$id, 'material_type' => @$material_type, 'completed_date' => date('Y-m-d H:i:s'));
			$lastId = $this->Commonmodel->add_details('course_enrollment_status', $materialData);
		}
	}
	public function courseQuizMaterial() {
		$user_id = $this->session->userdata('user_id');
		$enrollment_id = $this->input->post('enrollment_id');
		$id = $this->input->post('id');
		$keyId = $this->input->post('key');
		$page = $this->input->post('page');
		$optionArray = $this->input->post('optionArray');
		$quizList = "SELECT * FROM `course_quiz` WHERE `material_id` = '" . $id . "'";
		$totalQuiz = $this->db->query($quizList)->num_rows();
		$score = 0;
		$attempt = 0;
		$notAttempt = 0;
		$correctAttempt = 0;
		if (!empty($optionArray)) {
			foreach ($optionArray as $key => $value) {
				$correctAnswer = "SELECT `correct_answer` FROM `course_quiz` WHERE `id` = '" . $value['id'] . "'";
				$correctData = $this->db->query($correctAnswer)->row();
				$correct_answer = @$correctData->correct_answer;
				if ($value['choice'] != '') {
					if ($correct_answer == $value['choice']) {
						$score++;
						$correctAttempt++;
					}
					$attempt++;
				}
				if ($value['choice'] == '') {
					$notAttempt++;
				}
			}
		}
		$correctAttempt = $correctAttempt;
		$score = $score	/ $totalQuiz * 100;
		if ($score < 50) {
			$message = 'You need to score at least 50% to pass the exam.';
		} else {
			$message = 'You have passed the exam and scored ' . $score . '%.';
		}
		$data['totalQuiz'] = $totalQuiz;
		$data['totalAttempt'] = $attempt;
		$data['correctAttempt'] = $correctAttempt;
		$data['score'] = $score;
		$data['notAttempt'] = $notAttempt;
		$data['message'] = $message;
		$data['id'] = $id;
		$data['enrollment_id'] = $enrollment_id;
		$data['keyId'] = $keyId;
		$data['page'] = $page;
		$data['optionArray'] = $optionArray;
		$this->load->view('ajax-quiz-result', $data);
	}
	public function eventBooked() {
		$data = array(
			'title' => 'Booked Event List',
			'page' => 'booked',
		);
		$user_id = $this->session->userdata('user_id');
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$getAllBookedSql = "SELECT evb.*, evnt.* FROM `event_booked` evb INNER JOIN `event` AS evnt ON evnt.id = evb.event_id WHERE evb.payment_status = 'COMPLETED' AND evb.user_id = '" . $user_id . "'";
		$data['event'] = $this->Commonmodel->fetch_all_join($getAllBookedSql);
		$getBookedSql = "SELECT * FROM `event_booked` WHERE `user_id` = '" . $user_id . "' and `payment_status` = 'COMPLETED'";
		$data['ctn_enrolment'] = $this->db->query($getBookedSql)->num_rows();
		$this->load->view('header', $data);
		$this->load->view('event_booked');
		$this->load->view('footer');
	}
	public function usrReviews() {
		$data = array('title' => 'Reviews','page' => 'reviews');
		$user_id = $this->session->userdata('user_id');
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$this->load->view('header', $data);
		$this->load->view('reviews');
		$this->load->view('footer');
	}
	public function addToCartFromProductPage() {
		$data = array(
			'user_id' => $_POST["user_id"],
			'product_id' => $_POST["pid"],
			'size' => $_POST["size"],
			'quantity' => $_POST["quantity"],
			'price' => $_POST["quantity"] * $_POST["price"]
		);
		$checkcartProduct = $this->db->query("SELECT * FROM cart WHERE user_id = '".$_POST["user_id"]."' AND product_id = '".$_POST["pid"]."' AND size = '".$_POST["size"]."'")->row();
		if(!empty($checkcartProduct)) {
			$finalquantity = $checkcartProduct->quantity + $_POST["quantity"];
			$finalPrice = $finalquantity * $_POST["price"]; 
			$this->db->query("UPDATE cart SET quantity = '".$finalquantity."', price = '".$finalPrice."' WHERE user_id = '".$_POST["user_id"]."' AND product_id = '".$_POST["pid"]."' AND size = '".$_POST["size"]."'");
			echo '1';
		} else {
			$insert_id = $this->Commonmodel->add_details('cart', $data);
			if(!empty($insert_id)) {
				echo '1';
			} else {
				echo '2';
			}
		}
	}
	public function updateCart() {
		//echo "<pre>"; print_r($_POST);
		$checkCart = $this->db->query("SELECT * FROM cart WHERE product_id = '".$_POST['pId']."'")->row();
		if(!empty($checkCart)) {
			$updateprc = $_POST['qnty'] * $_POST['price'];
			$updateCart = $this->db->query("UPDATE cart SET quantity = '".$_POST['qnty']."', price = '".$updateprc."' WHERE `id` = '".$_POST['cartId']."'");
			// if($updateCart > 0) {
			// 	$cartItems = $this->db->query("SELECT * FROM cart WHERE user_id = '".$this->session->userdata('user_id')."'")->result_array();
			// 	$html = '';
			// 	$i = 1;
			// 	foreach ($cartItems as $item) {
			// 		$product_details = $this->db->query("SELECT * FROM product WHERE id = '".$item['product_id']."'")->row();
			// 		$price = number_format((float)$product_details->sale_price, 2, '.', '');
			// 		$total_price = $price * $item['quantity'];
			// 		$html .="<tr><td class='product-thumbnail'><a href='#' class='cartProductimg'><img src=".base_url()."uploads/products/".$product_details->product_image." alt=''></a></td><td class='product-name'><a href='javascript:void(0)'>$product_details->product_name</a></td><td class='product-price'><span class='amount'>$".number_format((float)$product_details->sale_price, 2, '.', '')."</span></td><td class='product-quantity text-center'><div class='product-quantity mt-10 mb-10'><div class='product-quantity-form'><form action='#'><button class='cart-minus' id='qntyminus_$i'><i class='far fa-minus'></i></button><input class='cart-input' id='qntyinput_$i' type='text' value=".$item['quantity']." readonly><button class='cart-plus' id='qntyplus_$i'><i class='far fa-plus'></i></button><p class='d-none' id='pId_$i'>".$item['product_id']."</p><p class='d-none' id='prodprice_$i'>".number_format((float)$product_details->sale_price, 2, '.', '')."</p><p class='d-none' id='cartId_$i'>".$item['id']."</p></form></div></div></td><td class='product-subtotal'><span class='amount'>$".number_format((float)$total_price, 2, '.', '')."</span></td><td class='product-remove'><a href='#' class='text-danger'><i class='fa fa-times'></i></a></td></tr>";
			// 		$i++;
			// 	}
			// } else {
			// 	$html .= "No data found";
			// }
		}
		//echo $html;
	}
	public function removeFromCart() {
		$cartId = $_POST['cartId'];
		$this->db->query("DELETE FROM cart where id = '".$cartId."'");
		echo '1';
	}
	public function savecheckoutData1() {
		$data = array(
			'billing_first_name' => $_POST['billing_first_name'], 
			'billing_last_name' => $_POST['billing_last_name'], 
			'billing_company_name' => $_POST['billing_company_name'], 
			'billing_address1' => $_POST['billing_address1'], 
			'billing_address2' => $_POST['billing_address2'], 
			'billing_city' => $_POST['billing_city'], 
			'billing_state' => $_POST['billing_state'], 
			'billing_country' => $_POST['billing_country'], 
			'billing_postcode' => $_POST['billing_postcode'], 
			'billing_email' => $_POST['billing_email'],
			'billing_phone' => $_POST['billing_phone'], 
			'shiptodifferentadd' => $_POST['shiptodifferentadd'], 
			'shipping_first_name' => $_POST['shipping_first_name'], 
			'shipping_last_name' => $_POST['shipping_last_name'], 
			'shipping_company_name' => $_POST['shipping_company_name'], 
			'shipping_address1' => $_POST['shipping_address1'], 
			'shipping_address2' => $_POST['shipping_address2'], 
			'shipping_city' => $_POST['shipping_city'], 
			'shipping_state' => $_POST['shipping_state'], 
			'shipping_country' => $_POST['shipping_country'], 
			'shipping_postcode' => $_POST['shipping_postcode'], 
			'shipping_email' => $_POST['shipping_email'], 
			'shipping_phone' => $_POST['shipping_phone'], 
			'order_note' => $_POST['order_note'], 
			'user_id' => $_POST['user_id']
		);
		$insert_id = $this->Commonmodel->add_details('user_address', $data);
		if(!empty($insert_id)) {
			$data1 = array(
				'user_id' => $_POST['user_id'],
				'user_addressid' => $insert_id,
				'txn_id' => $_POST['Reference'],
				'order_item' => $_POST['order_item'], 
				'cart_subtotal' => $_POST['subtotal'],
				'shipping' => $_POST['shipping'],
				'tax' => $_POST['tax'],
				'order_total' => $_POST['order_total'],
			);
		}
		$insert_id = $this->Commonmodel->add_details('product_order_details', $data1);
	}
	public function purchasePorderSuccess() {
		$user_id = $this->input->post('user_id');
        $transaction_id	= $this->input->post('txnR');
        $this->db->query("UPDATE product_order_details SET status = 'SUCCESS' WHERE txn_id = '".$transaction_id."' AND  user_id='".$user_id."'");
		$this->db->query("DELETE FROM cart WHERE user_id = '".$user_id."'");
        echo '1';
	}
	public function purchasePorderFailed() {
		$user_id = $this->input->post('user_id');
        $transaction_id	= $this->input->post('txnR');
        $this->db->query("UPDATE product_order_details SET status = 'FAILED' WHERE txn_id = '".$transaction_id."' AND  user_id='".$user_id."'");
        echo '1';
	}
	public function productOrderList(){
		$data = array(
			'title' => 'Product Order History',
			'page' => 'product',
		);
		$user_id = $this->session->userdata('user_id');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$getPurchaseSql = "SELECT ctrl.*, cour.title FROM `course_enrollment` as ctrl INNER JOIN `courses` as cour ON cour.id = ctrl.course_id WHERE ctrl.user_id = '" . $user_id . "' ORDER BY ctrl.enrollment_date DESC";
		$data['orders'] = $this->Commonmodel->fetch_all_join($getPurchaseSql);
		$getEnrolmentSql = "SELECT * FROM `course_enrollment` WHERE `user_id` = '" . $user_id . "' and `payment_status` = 'COMPLETED'";
		$data['ctn_enrolment'] = $this->db->query($getEnrolmentSql)->num_rows();
		$data['productOrderList'] = $this->db->query("SELECT * FROM product_order_details WHERE user_id = '".$user_id."'")->result_array();
		$this->load->view('header', $data);
		$this->load->view('product-order-list');
		$this->load->view('footer');
	}
	public function submitReview() {
		$data = array(
			'fname' => $_POST['fname'],
			'lname' => $_POST['lname'],
			'email' => $_POST['email'],
			'rating' => $_POST['rating'],
			'comment' => $_POST['comment'],
			'user_id' => $this->session->userdata('user_id'),
			'product_id' => $_POST['product_id']
		);
		$checkreview = $this->db->query("SELECT * FROM product_review WHERE user_id = '".$this->session->userdata('user_id')."' AND product_id = '".$_POST['product_id']."'")->result_array();
		if(!empty($checkreview)) {
			echo "2";
		} else {
			$insert_id = $this->Commonmodel->add_details('product_review', $data);
			if(!empty($insert_id)){
				echo "1";
			} else{
				echo "3";
			}
		}
	}
	public function logout() {
		session_destroy();
		$this->session->set_flashdata('success', 'You have successfully logout!');
		redirect(base_url('login'), 'refresh');
	}
}
