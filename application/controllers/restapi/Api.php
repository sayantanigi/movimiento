<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Apimodel');
		$this->load->model('Mymodel');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->library('form_validation');
		error_reporting(0);
	}

	public function signup_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['firstName'] = $this->post('firstName');
			$userData['lastName'] = $this->post('lastName');
			$userData['email'] = $this->post('email');
			$userData['password'] = $this->post('password');
			$userData['confirmPassword'] = $this->post('confirmPassword');
		}

		$this->form_validation->set_rules('firstName', 'firstName', 'trim|required');
		$this->form_validation->set_rules('lastName', 'lastName', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('confirmPassword', 'confirmPassword', 'required|matches[password]');

		if ($this->form_validation->run() === false) 
		{
            
			if(form_error('firstName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('firstName'))
				], 400);
			}
			
			if(form_error('lastName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('lastName'))
				], 400);
			}
			
			if(form_error('email')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('email'))
				], 400);
			}

			if(form_error('password')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('password'))
				], 400);
			}
			if(form_error('confirmPassword')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('confirmPassword'))
				], 400);
			}

		} else {
            $emailToken = md5($userData['email']).rand(10,9999);
			
			$mydata=array(
				'fname'=>$userData['firstName'],
				'lname'=>$userData['lastName'],
				'email'=>$userData['email'],
				'password'=>md5($userData['password']),
				'created_at'=>date('Y-m-d H:i:s'),
				'email_verify_token' => $emailToken,
				'status'=> '0'
			);
			
			$result=$this->Apimodel->add_details("users", $mydata);

			if($result)
			{

				$email = trim($userData['email']);
				$fetchdetails=$this->Apimodel->get_cond('users', "id='$result'");

				/*$notiData= array(
					'message'=>'New user has joined. Email Id is : '.$email,
					'created'=>date('Y-m-d H:i:s'),
				);
				$this->Apimodel->add_details("notifications", $notiData);*/
				$link = base_url().'home/verify?key='.$email.'&&token='.$emailToken;
				$name = "User";		
				
				/*$emailEncode = $this->mymodel->myUrlEncode($email);
				$data_mail['email']=$this->mymodel->my_encrypt($emailEncode);*/
				
				//add free default subscription
				
				$subId = $this->Mymodel->get_single_row_info('id', 'subscription', 'pck_type="Free"', '', 1);
				$fullname = @$userData['firstName'].' '.@$userData['lastName'];
				$this->Apimodel->add_details('transaction', array('user_name' => $fullname, 'user_id' => $result, 'sub_id' => @$subId->id, 'subscription' => 'Free', 'payment_type' => '1'));
				//add free default subscription

				$settings=$this->Apimodel->getSettings();
				
				$data_mail['mail_content'] = "<table>
					 <thead>				
					 <tr>
					 <th colspan='2'><p style='font-size:12px;list-style: none;'>Please click on the link below to activate your new listing.</p></th>
					 </tr>
					 <tr>
					 <th colspan='2'><p style='font-size:12px;list-style: none;'><a href='" .$link."'>".$link."</a></p></th>
					 </tr>
					 <tr>
					 <th colspan='2'> <p style='color:blue;'>Your Login Details</p></th>

					 </tr>
						 <tr>
							 <th style='border:1px solid grey'>
								 Username/Email: 
							 </th>
							 <th style='border:1px solid grey'>
								 ".$email."
							 </th>
						 </tr>
					 </thead>
					 <tbody>
						 <tr>
							 <th style='border:1px solid grey'>
								 Pasword :
							 </th>
							 <th style='border:1px solid grey'>
								".$userData['password']."
							 </th>
						 </tr>
					 </tbody>
				 </table>";
                
				$htmlContent = $this->load->view('template/common.php', $data_mail, true);
				//print_r($settings->email);die;
                $this->Mymodel->send_mail($userData['email'], 'info@madetosplit.com', $htmlContent, 'Confirm MadeToSplit Registration', 'info@madetosplit.com', 'M@d32spl1t');	
				//$this->Mymodel->send_mail('chetanbele1994@gmail.com', 'info@madetosplit.com', 'test', 'test', 'info@madetosplit.com', 'M@d32spl1t');
				
				/*$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->from($settings->email,'MadeToSplit');
				$this->email->to($email);
				$this->email->subject('Confirm MadeToSplit Registration');
				$this->email->message($htmlContent);
				$this->email->set_mailtype("html");
				$this->email->send();*/

				$array = [
					'status' => "1",
					'message'=>'Your registration is successfully completed. Please authenticate your email address by clicking the link sent to you via email!',
					'userId' => $fetchdetails->id
				];

				$array = $this->arrcheck($array);
				$this->response($array, 200);
			} else {
				$this->response([
					'status' =>"0",
					'error' => "Some problems occurred, please try again.!"
				], 400);

			}

		}
	}

	public function login_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['email'] = $this->post('email');
			$userData['password'] = $this->post('password');
		}
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		if ($this->form_validation->run() === false)
		{

			if(form_error('email'))
			{
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('email'))
				], 400);
			}
			if(form_error('password')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('password'))
				], 400);
			}
		} else {

			$where = "email = '".$userData['email']."'";

			if ($this->Mymodel->count('users', $where) != 1)
			{
				$this->response([
					'status' =>"0",
					'error' => "Invalid Email"
				], 400);
			}else{

				$user = $this->Mymodel->get_by('users', true, $where);
                //print_r($user->password);die;
				if(md5($userData['password']) != $user->password)
				{
					$this->response([
						'status' =>"0",
						'error' => "Invalid Password"
					], 400);
				}elseif ($user->status=='0')
				{
					$this->response([
						'status' =>"0",
						'error' => "Your account has not verified. Please verify."
					], 400);

				}
				else{
					
					if($user->image!="")
					{
					    $pic = base_url().'uploads/profile/'.$user->image;
					} else {
				    	$pic = base_url().'uploads/unnamed.jpg';
					}

					$array = [
						'status' =>"1",
						'personalInfo' => [
							'userId' => @$user->id,
							'fullName' => @$user->fname.' '.@$user->lname,
							'email' => @$user->email,
							'mobileNo' => @$user->phone,
							'address'=> @$user->address,
							// 'country'=> @$user->country,
							// 'state'=> @$user->state,
							// 'city'=> @$user->city,
							'profilePic' => @$pic,
							//'zipcode'=> @$user->zipcode,
							'bio'=> @$user->about,
					    ]
					];

					$array = $this->arrcheck($array);
					$this->response($array, 200);
				}
			}
		}

	}
	
	public function changePassword_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['userId'] = $this->post('userId');
			$userData['oldPassword'] = $this->post('oldPassword');
			$userData['newPassword'] = $this->post('newPassword');
		}

		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('oldPassword', 'oldPassword', 'trim|required');
		$this->form_validation->set_rules('newPassword', 'newPassword', 'trim|required|min_length[6]');		

		if ($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}

			if(form_error('oldPassword')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('oldPassword'))
				], 400);
			}

			if(form_error('newPassword')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('newPassword'))
				], 400);
			}

		} else {	

			$userId = $userData['userId'];		
			$where = "id = '$userId'";
			$details = $this->Apimodel->get_cond('users', $where);

			if($details) 
			{
				if (md5($userData['oldPassword'])!=$details->password) 
				{
					$this->response([
						'status' => "0",
						'error' => 'Old password is not matched!'
					], 400);

				}

				$data = array(
					'password' => md5($userData['newPassword'])
				); 		

				$where="id = $userId";
				
				$update=$this->Apimodel->update_cond('users', $where, $data);	
				
				if($update)
				{

					$this->response([
						'status' => "1",
						'userId' => $userId,
						'message' => 'Password updated successfully.'
					], 200);

				} else {
					$this->response([
						'status' => "0",
						'error' => "Some problems occurred, please try again."
					], 400);
				}
			} else {

				$this->response([
					'status' => "0",
					'error' => 'User not found!'
				], 400);

			}

		}
	}
	
	public function profilePic_post() 
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			//$userData['profilePic'] = $this->post('profilePic');
		}

		//print_r($userData);die;

		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		//$this->form_validation->set_rules('profilePic', 'profilePic', 'trim|required');
		
		if ($this->form_validation->run() === false) {
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);

			}
			
		} else {
			if(empty($_FILES['profilePic']['name'])){
				$this->response([
					'status' => "0",
					'error' => "Please select profilePic"
				], 400);

			} else {
				
				$userId = $userData['userId']; 
				$query = $this->db->query("SELECT * FROM `users` WHERE `id`= '".$userId."'");
				$num_rows = $query->num_rows();
				$dataraw = $query->row();

				if($num_rows>0) {
					
					$config['upload_path'] = './uploads/profile/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = 204800;
					$config['max_width'] = 30000;
					$config['max_height'] = 20000;
					$config['file_name'] = uniqid();
					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('profilePic')) 
					{
						$error = array('error' => $this->upload->display_errors());
						$image = @$dataraw->image;

					} else {
						$file_data = $this->upload->data();
						$image = $file_data['file_name'];

					}

					$data = array(
						'image'=>$image
					); 

					$where = array('id' => $userId);
					$update = $this->Apimodel->update_cond('users',$where, $data);

					$path = base_url()."uploads/profile/".$image;

					if($update){
						$this->response([
							'status' => "1",
							'profilePic' => $path,
							'message' => 'Profile pic updated successfully.'
						], 200);

					} else {
						    $this->response([
							'status' => "0",
							'error' => "Some problems occurred, please try again."
							], 400);
					}

				} else {
					$this->response([
						'status' => "0",
						'error' => 'userId is invalid.'

					], 400);
				}
			}
		}
	}
	
	public function editProfile_post() 
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			$userData['firstName'] = $this->post('firstName');
			$userData['lastName'] = $this->post('lastName');
			$userData['email'] = $this->post('email');
			$userData['mobileNo'] = $this->post('mobileNo');
			$userData['address'] = $this->post('address');
			$userData['bio'] = $this->post('bio');
			$userData['facebookUrl'] = $this->post('facebookUrl');
			$userData['twitterUrl'] = $this->post('twitterUrl');
			$userData['pintrestUrl'] = $this->post('pintrestUrl');
			$userData['instagramUrl'] = $this->post('instagramUrl');
			$userData['cashApp'] = $this->post('cashApp');
			$userData['zelle'] = $this->post('zelle');
			$userData['venmo'] = $this->post('venmo');
			$userData['applePay'] = $this->post('applePay');
		}

		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('firstName', 'firstName', 'trim|required');
		$this->form_validation->set_rules('lastName', 'lastName', 'trim|required');	
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('mobileNo', 'mobileNo', 'trim|required');	
		$this->form_validation->set_rules('address', 'address', 'trim|required');
		$this->form_validation->set_rules('bio', 'bio', 'trim|required');	
	
		if($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}

			if(form_error('firstName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('firstName'))
				], 400);
			}	
			
			if(form_error('lastName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('lastName'))
				], 400);
			}	

            if(form_error('mobileNo')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('mobileNo'))
				], 400);
			}	

            if(form_error('email')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('email'))
				], 400);
			}	

            if(form_error('address')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('address'))
				], 400);
			}
			
            if(form_error('bio')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('bio'))
				], 400);
			}
			
		} else {

			$userId = $userData['userId'];			
			$dataraw = $this->Apimodel->get_cond('users', "id='".$userId."'");

			if(!empty($dataraw))
			{
				
				$mydata = array(
					'fname' => @$userData['firstName'],
					'lname' => @$userData['lastName'],
					'email' => @$userData['email'],
					'phone' => @$userData['mobileNo'],
					'address' => @$userData['address'],
					'about' => @$userData['bio'],
					'facebook' => @$userData['facebookUrl'],
					'twitter' => @$userData['twitterUrl'],
					'instagram' => @$userData['instagramUrl'],
					'pinterest' => @$userData['pintrestUrl'],
					'cashapp' => @$userData['cashApp'],
					'zelle' => @$userData['zelle'],
					'venmo' => @$userData['venmo'],
					'apple_pay' => @$userData['applePay'],
				); 

				$where="id='".$userId."'";
				$update=$this->Apimodel->update_cond('users', $where, $mydata);

				$user = $this->Apimodel->get_cond('users', "id='".$userId."'");

				$arr= array(
					'userId' => @$user->id,
					'firstName' => @$user->fname,
					'lastName' => @$user->lname,
					'email' => @$user->email,
					'mobileNo' => @$user->phone,
					'address' => @$user->address,
					'bio' => @$user->about,
					'facebookUrl' => @$user->facebook,
					'twitterUrl' => @$user->twitter,
					'instagramUrl' => @$user->instagram,
					'pintrestUrl' => @$user->pinterest,
					'cashApp' => @$user->cashapp,
					'zelle' => @$user->zelle,
					'venmo' => @$user->venmo,
					'applePay' => @$user->apple_pay,
					'created' => @$user->created_at,
					'updated' => @$user->updated_at,
				);

				if($update)
				{
					$this->response([
						'status'=>"1",
						'message' => 'Profile updated successfully.',
						'personalInfo'=>$arr
					], 200);
				} else {
					$this->response([
						'status' => "0",
						'error' => "Some problems occurred, please try again."
					], 400);
				}

			} else {
				$this->response([
					'status' => "0",
					'error' => 'No user found.'
				], 400);

			}

		}
	}
	
	function profileDetails_get(){
		if(!empty(@$_GET['userId'])){
			$userId = @$_GET['userId'];
			$query = $this->db->query("SELECT * FROM `users` WHERE `id`= '".$userId."' LIMIT 1");
			$num_rows = $query->num_rows();
			if($num_rows > 0){
				$user = $query->row();
				
                if(!empty($user->image)){
					$profilePic = base_url('uploads/profile/'.$user->image.'');
				}else{
					$profilePic = base_url('uploads/unnamed.jpg');
				}
				
				$user_sub_id = $this->Mymodel->get_single_row_info('sub_id, end_date', 'transaction', 'user_id='.$userId.' and payment_type="1"', 'id DESC', 1);
				
				if(!empty($user_sub_id)){
					$user_sub_name = $this->Mymodel->get_single_row_info('name', 'subscription', 'id='.@$user_sub_id->sub_id.'', '', 1);
					$user_sub_name_1 = $user_sub_name->name;
				}else{
				    $user_sub_name_1 = '';
				}
				
				if(!empty(@$user_sub_id->end_date)){
					$expiry_date = date('M d, Y', strtotime(@$user_sub_id->end_date));
				}else{
					$expiry_date = '';
				}
				
				if(!empty(@$user->auto_renew_status)){
					$autoRenue = @$user->auto_renew_status;
				}else{
					$autoRenue = 0;
				}
				$arr= array(
					'userId' => @$user->id,
					'firstName' => @$user->fname,
					'lastName' => @$user->lname,
					'email' => @$user->email,
					'mobileNo' => @$user->phone,
					'address' => @$user->address,
					'bio' => @$user->about,
					'facebookUrl' => @$user->facebook,
					'twitterUrl' => @$user->twitter,
					'instagramUrl' => @$user->instagram,
					'pintrestUrl' => @$user->pinterest,
					'cashApp' => @$user->cashapp,
					'zelle' => @$user->zelle,
					'venmo' => @$user->venmo,
					'applePay' => @$user->apple_pay,
					'profilePic' => $profilePic,
					'autoRenue' => @$autoRenue,
					'customizePayment' => @$user->customize_payment,
					'subscriptionName' => @$user_sub_name_1,
					'expireOn' => @$expiry_date,
					'created' => @$user->created_at,
					'updated' => @$user->updated_at,
				);
				
				$this->response([
					'status'=>"1",
					'personalInfo'=>$arr
				], 200);
				
			}else{
				$this->response([
					'status' => "0",
					'error' => 'No user found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'userId is required.'
			], 400);
		}
	}
	
	public function getOtp_post() 
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['email'] = $this->post('email');
		}
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required');
		if ($this->form_validation->run() === false) 
		{
			if(form_error('email')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('email'))
				], 400);
			}
		} else {

			$checkuser=$this->Apimodel->get_cond('users', "email='".$userData['email']."'");
			$userId = @$checkuser->id;

			if(!empty($checkuser))
			{ 
				$otpData = array(
					'otp'=>$this->generate_otp(6),
				); 

				$where = array('id' => $userId);
				$update = $this->Apimodel->update_cond('users', $where, $otpData);

				$fetchdetails=$this->Apimodel->get_cond('users', "email='".$userData['email']."'");
				$array = [
					'status' => "1",
					'userId' => $fetchdetails->id,
					'otp'=> $fetchdetails->otp
				];
				$array = $this->arrcheck($array);
				$this->response($array, 200);

			} else {
				$this->response([
					'status' => "0",
					'error' => 'No details found'
				], 400);
			}
		}
	}
	
	public function recoveryUpdatePassword_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			$userData['otp'] = $this->post('otp');
			$userData['newPassword'] = $this->post('newPassword');
		}
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('otp', 'otp', 'trim|required');
		$this->form_validation->set_rules('newPassword', 'newPassword', 'trim|required|min_length[6]');			

		if ($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
			if(form_error('otp')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('otp'))
				], 400);
			}
			if(form_error('newPassword')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('newPassword'))
				], 400);

			}		


		} else {

			$where = "id = '".$userData['userId']."' AND otp='".$userData['otp']."'";
			
			if ($this->Apimodel->count('users', $where) != 1) 
			{				
				$this->response([
					'status' =>"0",
					'error' => "Invalid User!"
				], 400);

			}else{

				$data = array(
					'password' => md5($userData['newPassword']),
					'otp'=>$this->generate_otp(6),
				); 		

				$where="id = '".$userData['userId']."'";

				$update=$this->Apimodel->update_cond('users', $where, $data);	

				if($update){

					$this->response([
						'status' => "1",
						'userId' => $userData['userId'],
						'message' => 'Password Updated successfully.'
					], 200);

				} else {
					$this->response([
						'status' => "0",
						'error' => 'Some problems occurred, please try again'
					], 400);
					
				}
			}
		}

	}
	
	public function subscription_get(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;		
		}	
		
		$list = $this->Apimodel->get_cond_all('subscription',"status='1'");

		if(!empty($list)) 
		{
			foreach ($list as $k => $v)
			{
                if(@$v->duration){
					$explodeDuration = explode('-', @$v->duration);
					$month = $explodeDuration[0];
					$monthText = $explodeDuration[1];
				}else{
					$month = '';
					$monthText = '';
				}
				
				$array[] = [
					'subscriptionId' => @$v->id,
					'name' => @$v->name,
					'description' => strip_tags(@$v->description),
					'amount' => @$v->amount,
					'duration' => @$month.' '.@$monthText,
					'subType' => @$v->pck_type,
				];				
			}

			$array = $this->arrcheck($array);

			$this->response([
				'status'=>"1",
				'list'=>$array,

			], 200);
		} else {
			$this->response([
				'status' => "0",
				'error' => 'No subscription found.'
			], 400);
		}		
	}
	
	public function aboutUs_get(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;		
		}	
		
		$list = $this->Apimodel->get_cond_all('about_us',"status='1' AND slug='about'");

		if(!empty($list)) 
		{
			foreach ($list as $k => $v)
			{
				$description = preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/is', "$1$3", $v->description);
				 $des = strip_tags(html_entity_decode(trim($description)));
				 $str = str_replace("\n", '', $des);
				 $str1 = str_replace("\r", '', $str);
				 $str2 = str_replace("\r\n", '', $str1);
				if(!empty($v->image) && file_exists('uploads/about_us/'.$v->image.'')){
					$image = base_url('uploads/about_us/'.$v->image.'');
				}else{
					
					$image = base_url('uploads/noimage.jpg');
				}
				
				$array[] = [
					'id' => @$v->id,
					'heading' => @$v->heading,
					'description' => trim($str2), 
					//'description' => @$v->description, 
					'image' => @$image, 
				];				
			}

			$array = $this->arrcheck($array);

			$this->response([
				'status'=>"1",
				'list'=>$array,

			], 200);
		} else {
			$this->response([
				'status' => "0",
				'error' => 'No about us found.'
			], 400);
		}		
	}
	
	public function privacyPolicy_get(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;		
		}	
		
		$list = $this->Apimodel->get_cond_all('about_us',"status='1' AND slug='privacy'");

		if(!empty($list)) 
		{
			foreach ($list as $k => $v)
			{
				$description = preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/is', "$1$3", $v->description);
				 $des = strip_tags(html_entity_decode(trim($description)));
				 $str = str_replace("\n", '', $des);
				 $str1 = str_replace("\r", '', $str);
				 $str2 = str_replace("\r\n", '', $str1);
				$array[] = [
					'id' => @$v->id,
					'heading' => @$v->heading,
					'description' => trim($str2), 
					//'description' => $v->description, 
				];				
			}

			$array = $this->arrcheck($array);

			$this->response([
				'status'=>"1",
				'list'=>$array,

			], 200);
		} else {
			$this->response([
				'status' => "0",
				'error' => 'No privacy policy found.'
			], 400);
		}		
	}
	function replace_carriage_return($replace, $string)
	{
    	return str_replace(array("\n\r", "\n", "\r"), $replace, $string);
	}
	public function termandCondition_get(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;		
		}	
		
		$list = $this->Apimodel->get_cond_all('about_us',"status='1' AND slug='term'");

		if(!empty($list)) 
		{
			foreach ($list as $k => $v)
			{
				$description = preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/is', "$1$3", $v->description);
				 $des = strip_tags(html_entity_decode(trim($description)));
				 $str = str_replace("\n", '', $des);
				 $str1 = str_replace("\r", '', $str);
				 $str2 = str_replace("\r\n", '', $str1);

				$array[] = [
					'id' => @$v->id,
					'heading' => @$v->heading,
					'description' => trim($str2), 
					//'description' => $v->description, 
				];				
			}

			$array = $this->arrcheck($array);

			$this->response([
				'status'=>"1",
				'list'=>$array,

			], 200);
		} else {
			$this->response([
				'status' => "0",
				'error' => 'No term and condition found.'
			], 400);
		}		
	}
	
	public function helpandSupport_get(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;		
		}	
		
		$list = $this->Apimodel->get_cond_all('about_us',"status='1' AND slug='help'");

		if(!empty($list)) 
		{
			foreach ($list as $k => $v)
			{
				$description = preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/is', "$1$3", $v->description);
				$des = strip_tags(html_entity_decode(trim($description)));
				$str = str_replace("\n", '', $des);
				$str1 = str_replace("\r", '', $str);
				$str2 = str_replace("\r\n", '', $str1);
				
				$array[] = [
					'id' => @$v->id,
					'heading' => @$v->heading,
					'description' => trim($str2), 
					//'description' => $v->description, 
				];				
			}

			$array = $this->arrcheck($array);

			$this->response([
				'status'=>"1",
				'list'=>$array,

			], 200);
		} else {
			$this->response([
				'status' => "0",
				'error' => 'No help and support found.'
			], 400);
		}		
	}
	function faqs_get(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;		
		}	
		
		$list = $this->Apimodel->get_cond_all('faq',"status='1'");

		if(!empty($list)) 
		{
			foreach ($list as $k => $v)
			{
				$array[] = [
					'faqid' => @$v->id,
					'question' => @$v->question,
					'answer' => strip_tags(@$v->answer),
				];				
			}

			$array = $this->arrcheck($array);

			$this->response([
				'status'=>"1",
				'list'=>$array,

			], 200);
		} else {
			$this->response([
				'status' => "0",
				'error' => 'No faqs found.'
			], 400);
		}	
	}
	function addEvent_post(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			$userData['eventName'] = $this->post('eventName');
			$userData['eventDescription'] = $this->post('eventDescription');
			$userData['eventAddress'] = $this->post('eventAddress');
			$userData['eventCost'] = $this->post('eventCost');
			$userData['eventTime'] = $this->post('eventTime');
			$userData['eventDate'] = $this->post('eventDate');
			$userData['latitude'] = $this->post('latitude');
			$userData['longitude'] = $this->post('longitude');
			$userData['country'] = $this->post('country');
			$userData['state'] = $this->post('state');
			$userData['city'] = $this->post('city');
			$userData['zipcode'] = $this->post('zipcode');
		}
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('eventName', 'eventName', 'trim|required');
		$this->form_validation->set_rules('eventDescription', 'eventDescription', 'trim|required');			
		$this->form_validation->set_rules('eventAddress', 'eventAddress', 'trim|required');			
		$this->form_validation->set_rules('eventCost', 'eventCost', 'trim|required');			
		$this->form_validation->set_rules('eventTime', 'eventTime', 'trim|required');			
		$this->form_validation->set_rules('eventDate', 'eventDate', 'trim|required');			

		if ($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
			if(form_error('eventName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventName'))
				], 400);
			}
			if(form_error('eventDescription')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventDescription'))
				], 400);
			}	
			
            if(form_error('eventAddress')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventAddress'))
				], 400);
			}	
			if(form_error('eventCost')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventCost'))
				], 400);
			}
            if(form_error('eventTime')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventTime'))
				], 400);
			}
			if(form_error('eventDate')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventDate'))
				], 400);
			}
          			
		} else {
                if(!empty($_FILES['eventImage']['name']) && count($_FILES['eventImage']['name']) > 0){
					$filesCount = count(@$_FILES['eventImage']['name']); 
					for($i = 0; $i < $filesCount; $i++){
						$_FILES['file']['name']     = $_FILES['eventImage']['name'][$i]; 
						$_FILES['file']['type']     = $_FILES['eventImage']['type'][$i]; 
						$_FILES['file']['tmp_name'] = $_FILES['eventImage']['tmp_name'][$i]; 
						$_FILES['file']['error']     = $_FILES['eventImage']['error'][$i]; 
						$_FILES['file']['size']     = $_FILES['eventImage']['size'][$i]; 
						$config['upload_path'] = 'uploads/event'; 
						$config['allowed_types'] = 'jpg|png|jpeg|gif';
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if (!$this->upload->do_upload('file')) {
							$this->response([
								'status' => "0",
								'error' => @$this->upload->display_errors()
							], 200);
							exit();
						}else{  
							$fileData = $this->upload->data();
							$uploadData[$i]['image'] = $fileData['file_name']; 
							$uploadData[$i]['userId'] = $userId; 
						} 
					}
					//print_r($uploadData);die;
					if(!empty($uploadData)){
						$data = array(
							'event_name' => strip_tags(@$userData['eventName']),
							'event_description' => @$userData['eventDescription'],
							'event_address' => strip_tags(@$userData['eventAddress']),
							'event_date' => date('Y-m-d', strtotime(@$userData['eventDate'])),
							'event_time' => date('h:i A', strtotime(@$userData['eventTime'])),
							'event_price' => @$userData['eventCost'],
							'status' => '1',
							'event_latitude' => strip_tags(@$userData['latitude']),
							'event_longitude' => strip_tags(@$userData['longitude']),
							'event_country' => strip_tags(@$userData['country']),
							'event_state' => strip_tags(@$userData['state']),
							'event_city' =>  strip_tags(@$userData['city']),
							'event_zipcode' => strip_tags(@$userData['zipcode']),
							'user_id' => @$userData['userId'],
							'slug' => url_title(strip_tags(@$userData['eventName']), 'dash', true),
							'created_at'   => date('Y-m-d H:i:s')
						);
						
						$result=$this->Apimodel->add_details("event", $data);
						if(!empty($result)){
							$eventId = $result;
							$this->Apimodel->add_multiple_listing_gallery($uploadData, 'event_gallery', $eventId);
							
							$this->response([
								'status' => "1",
								'userId' => @$userData['userId'],
								'eventId' => @$eventId,
								'message' => 'Your event added successfully.'
							], 200);
							
						}else{
							$this->response([
								'status' => "0",
								'userId' => @$userData['userId'],
								'eventId' => '',
								'error' => 'Some problems occurred, please try again.'
							], 200);
						}
					}
				}else{
					$this->response([
						'status' => "0",
						'error' => 'Event image is required.'
					], 200);
				}
			
		}
	}
	
	function eventDetails_get(){
		if(!empty(@$_GET['eventId'])){
			$eventId = @$_GET['eventId'];
			$query = $this->db->query("SELECT * FROM `event` WHERE `event_id`= '".$eventId."' AND status = '1' LIMIT 1");
			$num_rows = $query->num_rows();
			if($num_rows > 0){
				$eventInfo = $query->row();
				if(!empty(@$eventInfo->co_host_id) && @$eventInfo->co_host_id != '0'){
					$co_host_id = @$eventInfo->co_host_id;
				}else{
					$co_host_id = '';
				}
                // if(!empty($user->image)){
					// $profilePic = base_url('uploads/profile/'.$user->image.'');
				// }else{
					// $profilePic = base_url('uploads/unnamed.jpg');
				// }
				$gallery = $this->db->query("select * from event_gallery where event_id = '".@$eventInfo->event_id."'")->result();
				$galleryImg = [];
				if(!empty($gallery)){
					foreach($gallery as $k => $v){
						//print_r($v);
						if(!empty(@$v->image) && file_exists('uploads/event/'.@$v->image.'')){
							$galleryImg[] = [
							    'id' => @$v->id,
							    'image' => base_url('uploads/event/'.@$v->image.'')
							];
						}
					}
				}
				
				$hostInfo = [];
				$host = $this->db->query("select * from users where id = '".@$eventInfo->user_id."'")->row();
				if(!empty(@$host)){
					if(!empty(@$host->image) && file_exists('uploads/profile/'.@$host->image.'')){
						$hostImg = base_url('uploads/profile/'.@$host->image.'');
					}else{
						$hostImg = base_url('uploads/noimage.jpg');
					}
					$hostName = @$host->fname.' '.@$host->lname;
					$hostInfo[] = [
					    'hostId' => @$host->id,
					    'cohostId' => @$co_host_id,
					    'hostImg' => @$hostImg,
					    'hostName' => @$hostName,
					    'cashApp' => @$host->cashapp,
					    'zelle' => @$host->zelle,
					    'venmo' => @$host->venmo,
					    'applePay' => @$host->apple_pay,
					];
				}
				
				@$currentURL  = 'https://madetosplit.com/event/details?eId='.base64_encode(@$eventInfo->event_id).'';
				
				$twitterURL = 'http://twitter.com/share?url='.@$currentURL.'&text='.@$eventInfo->event_name.'';
				$facebookURL = 'https://www.facebook.com/sharer.php?u='.@$currentURL.'';
				$googleURL = 'https://plus.google.com/share?url='.@$currentURL.'';
				$linkedinURL = 'http://www.linkedin.com/shareArticle?mini=true&url='.@$currentURL.'';
				
				$share = [
				    'twitter' => $twitterURL,
				    'facebook' => $facebookURL,
				    'google' => $googleURL,
				    'linkedin' => $linkedinURL,
				];
					
				
				$arr= array(
					'eventId' => @$eventInfo->event_id,
					'eventName' => @$eventInfo->event_name,
					'eventDescription' => strip_tags(@$eventInfo->event_description),
					'eventAddress' => @$eventInfo->event_address,
					'eventCost' => @$eventInfo->event_price,
					'eventDate' => @$eventInfo->event_date,
					'eventTime' => @$eventInfo->event_time,
					'latitude' => @$eventInfo->event_latitude,
					'longitude' => @$eventInfo->event_longitude,
					'country' => @$eventInfo->event_country,
					'state' => @$eventInfo->event_state,
					'city' => @$eventInfo->event_city,
					'zipcode' => @$eventInfo->event_zipcode,
					'created' => @$eventInfo->created_at,
					'eventGallery' => $galleryImg,
					'hostInfo' => $hostInfo,
					'shareURL' => $share,
				);
				
				$this->response([
					'status'=>"1",
					'personalInfo'=>$arr
				], 200);
				
			}else{
				$this->response([
					'status' => "0",
					'error' => 'No event found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'eventId is required.'
			], 400);
		}
	}
	
	
	function editEvent_post(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['eventId'] = $this->post('eventId');
			$userData['eventName'] = $this->post('eventName');
			$userData['eventDescription'] = $this->post('eventDescription');
			$userData['eventAddress'] = $this->post('eventAddress');
			$userData['eventCost'] = $this->post('eventCost');
			$userData['eventTime'] = $this->post('eventTime');
			$userData['eventDate'] = $this->post('eventDate');
			$userData['latitude'] = $this->post('latitude');
			$userData['longitude'] = $this->post('longitude'); 
			$userData['country'] = $this->post('country');
			$userData['state'] = $this->post('state');
			$userData['city'] = $this->post('city');
			$userData['zipcode'] = $this->post('zipcode');
			$userData['cohost'] = $this->post('cohost');
		}
		$this->form_validation->set_rules('eventId', 'eventId', 'trim|required');
		$this->form_validation->set_rules('eventName', 'eventName', 'trim|required');
		$this->form_validation->set_rules('eventDescription', 'eventDescription', 'trim|required');			
		$this->form_validation->set_rules('eventAddress', 'eventAddress', 'trim|required');			
		$this->form_validation->set_rules('eventCost', 'eventCost', 'trim|required');			
		$this->form_validation->set_rules('eventTime', 'eventTime', 'trim|required');			
		$this->form_validation->set_rules('eventDate', 'eventDate', 'trim|required');			

		if ($this->form_validation->run() === false) 
		{
			if(form_error('eventId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventId'))
				], 400);
			}
			if(form_error('eventName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventName'))
				], 400);
			}
			if(form_error('eventDescription')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventDescription'))
				], 400);
			}	
			
            if(form_error('eventAddress')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventAddress'))
				], 400);
			}	
			if(form_error('eventCost')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventCost'))
				], 400);
			}
            if(form_error('eventTime')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventTime'))
				], 400);
			}
			if(form_error('eventDate')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventDate'))
				], 400);
			}
          			
		} else {
                if(!empty($_FILES['eventImage']['name']) && count($_FILES['eventImage']['name']) > 0){
					$filesCount = count(@$_FILES['eventImage']['name']); 
					for($i = 0; $i < $filesCount; $i++){
						$_FILES['file']['name']     = $_FILES['eventImage']['name'][$i]; 
						$_FILES['file']['type']     = $_FILES['eventImage']['type'][$i]; 
						$_FILES['file']['tmp_name'] = $_FILES['eventImage']['tmp_name'][$i]; 
						$_FILES['file']['error']     = $_FILES['eventImage']['error'][$i]; 
						$_FILES['file']['size']     = $_FILES['eventImage']['size'][$i]; 
						$config['upload_path'] = 'uploads/event'; 
						$config['allowed_types'] = 'jpg|png|jpeg|gif';
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if (!$this->upload->do_upload('file')) {
							$this->response([
								'status' => "0",
								'error' => @$this->upload->display_errors()
							], 200);
							exit();
						}else{  
							$fileData = $this->upload->data();
							$uploadData[$i]['image'] = $fileData['file_name']; 
						} 
					}
					//print_r($uploadData);die;
					if(!empty($uploadData)){
						$data = array(
							'event_name' => strip_tags(@$userData['eventName']),
							'event_description' => @$userData['eventDescription'],
							'event_address' => strip_tags(@$userData['eventAddress']),
							'event_date' => date('Y-m-d', strtotime(@$userData['eventDate'])),
							'event_time' => date('h:i A', strtotime(@$userData['eventTime'])),
							'event_price' => @$userData['eventCost'],
							'event_latitude' => strip_tags(@$userData['latitude']),
							'event_longitude' => strip_tags(@$userData['longitude']),
							'event_country' => strip_tags(@$userData['country']),
							'event_state' => strip_tags(@$userData['state']),
							'event_city' =>  strip_tags(@$userData['city']),
							'event_zipcode' => strip_tags(@$userData['zipcode']),
							'slug' => url_title(strip_tags(@$userData['eventName']), 'dash', true),
							'co_host_id' => strip_tags(@$userData['cohost']),
							'created_at'   => date('Y-m-d H:i:s')
						);
						

						$where="event_id='".@$userData['eventId']."'";
				        $result=$this->Apimodel->update_cond('event', $where, $data);
						if(!empty($result)){
							$eventId = $userData['eventId'];
							$this->Apimodel->add_multiple_listing_gallery_update($uploadData, 'event_gallery', $eventId);
							
							$this->response([
								'status' => "1",
								'eventId' => @$eventId,
								'message' => 'Your event updated successfully.'
							], 200);
							
						}else{
							$this->response([
								'status' => "0",
								'userId' => @$userData['userId'],
								'eventId' => '',
								'error' => 'Some problems occurred, please try again.'
							], 200);
						}
					}
				}else{
					$data = array(
						'event_name' => strip_tags(@$userData['eventName']),
						'event_description' => @$userData['eventDescription'],
						'event_address' => strip_tags(@$userData['eventAddress']),
						'event_date' => date('Y-m-d', strtotime(@$userData['eventDate'])),
						'event_time' => date('h:i A', strtotime(@$userData['eventTime'])),
						'event_price' => @$userData['eventCost'],
						'event_latitude' => strip_tags(@$userData['latitude']),
						'event_longitude' => strip_tags(@$userData['longitude']),
						'event_country' => strip_tags(@$userData['country']),
						'event_state' => strip_tags(@$userData['state']),
						'event_city' =>  strip_tags(@$userData['city']),
						'event_zipcode' => strip_tags(@$userData['zipcode']),
						'slug' => url_title(strip_tags(@$userData['eventName']), 'dash', true),
						'co_host_id' => strip_tags(@$userData['cohost']),
						'created_at'   => date('Y-m-d H:i:s')
					);
					
					$where="event_id='".@$userData['eventId']."'";
					$result=$this->Apimodel->update_cond('event', $where, $data);
					if(!empty($result)){
						$eventId = $userData['eventId'];
						$this->response([
							'status' => "1",
							'eventId' => @$eventId,
							'message' => 'Your event updated successfully.'
						], 200);
						
					}else{
						$this->response([
							'status' => "0",
							'userId' => @$userData['userId'],
							'eventId' => '',
							'error' => 'Some problems occurred, please try again.'
						], 200);
					}
					
				}
			
		}
	}
	
	function latestEvent_post(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			
		}
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		if ($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
				

		} else {

			$where = "id = '".@$userData['userId']."' and status = '1'";
			
			$checkUser = $this->db->query("select * from users where ".@$where."")->row();
			if($checkUser){
				
				$current_date = date('Y-m-d');
				$list = $this->db->query("select * from event where status = '1' and (user_id = ".@$userData['userId']." OR event_id IN(select event_id from event_invited_people where email = '".@$checkUser->email."')) and event_date >= '".$current_date."' ORDER BY event_date ASC LIMIT 10")->result();
				
				if(!empty($list)) 
				{
					foreach ($list as $k => $v)
					{
						
						$gallery = $this->db->query("select * from event_gallery where event_id = '".@$v->event_id."' ORDER BY id ASC")->row();
						if(!empty($gallery)){
							if(!empty(@$gallery->image) && file_exists('uploads/event/'.@$gallery->image.'')){
							    $eventImg = base_url('uploads/event/'.@$gallery->image.'');
							}else{
							    $eventImg = base_url('uploads/noimage.jpg');
							}
						}else{
						    $eventImg = base_url('uploads/noimage.jpg');
						}
						
						$array[] = [
							'eventId' => @$v->event_id,
							'eventName' => @$v->event_name,
							'eventDate' => @$v->event_date,
							'eventTime' => @$v->event_time,
							'eventAddress' => @$v->event_address,
							'eventImg' => @$eventImg,
						];				
					}

					$array = $this->arrcheck($array);

					$this->response([
						'status'=>"1",
						'list'=>$array,

					], 200);
				} else {
					$this->response([
						'status' => "0",
						'error' => 'No events found.'
					], 400);
				}
				
			}else{
				$this->response([
					'status' => "0",
					'error' => 'No user found.'
				], 400);
			}
			
		}
	}
	
	function myEvent_get(){
		if(!empty(@$_GET['userId'])){
			$userId = @$_GET['userId'];
			$page_no = @$_GET['page_no'];
			$query = $this->db->query("SELECT * FROM `users` WHERE `id`= '".$userId."' AND status = '1' LIMIT 1");
			$num_rows = $query->num_rows();
			if($num_rows > 0){
				
				$this->load->library("pagination");
				$config = array();
				$where = "user_id=".@$userId." AND status = '1'";
				$config["total_rows"] = $this->Apimodel->countMyeventList('event', $where);
				$config["per_page"] = 10;
				$config['use_page_numbers'] = TRUE;
				$config['last_link'] = '<p style="padding: 0px 10px;"> Last </p>';
				$this->pagination->initialize($config);

				if($page_no){
				$start = ($page_no*$config["per_page"])-$config["per_page"];
				} else{
				$start = 0;
				}
				$data["links"] = $this->pagination->create_links();
				$countPage =  ceil($config["total_rows"]/$config["per_page"]);
				$list = $this->Apimodel->getAllMyeventList($start, $config["per_page"], @$where, 'event');
				if(!empty($list)) 
				{
					foreach ($list as $k => $v)
					{
						
						$gallery = $this->db->query("select * from event_gallery where event_id = '".@$v->event_id."' ORDER BY id ASC")->row();
						if(!empty($gallery)){
							if(!empty(@$gallery->image) && file_exists('uploads/event/'.@$gallery->image.'')){
							    $eventImg = base_url('uploads/event/'.@$gallery->image.'');
							}else{
							    $eventImg = base_url('uploads/noimage.jpg');
							}
						}else{
						    $eventImg = base_url('uploads/noimage.jpg');
						}
						
						$array[] = [
							'eventId' => @$v->event_id,
							'eventName' => @$v->event_name,
							'eventDate' => @$v->event_date,
							'eventTime' => @$v->event_time,
							'eventAddress' => @$v->event_address,
							'eventImg' => @$eventImg,
						];				
					}

					$array = $this->arrcheck($array);

					$this->response([
						'status'=>"1",
						'list'=>$array,
                        'pageCount' =>(!empty($array) ? $countPage : 0)	
					], 200);
				} else {
					$array = [];
					$this->response([
						'status' => "0",
						'error' => 'No events found.',
						'list'=>$array,
                        'pageCount' =>''	
					], 400);
				}

			}else{
				$this->response([
					'status' => "0",
					'error' => 'No user found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'userId is required.'
			], 400);
		}
	}
	
	function allEvent_get(){
		if(!empty(@$_GET['userId'])){
			$userId = @$_GET['userId'];
			$page_no = @$_GET['page_no'];
			$query = $this->db->query("SELECT * FROM `users` WHERE `id`= '".$userId."' AND status = '1' LIMIT 1");
			$num_rows = $query->num_rows();
			if($num_rows > 0){
				$userInfo = $query->row();
				
				$this->load->library("pagination");
				$config = array();
				$where = "user_id=".@$userId." AND status = '1'";
				$config["total_rows"] = $this->Apimodel->countAlleventList($userId, @$userInfo->email);
				$config["per_page"] = 10;
				$config['use_page_numbers'] = TRUE;
				$config['last_link'] = '<p style="padding: 0px 10px;"> Last </p>';
				$this->pagination->initialize($config);

				if($page_no){
				$start = ($page_no*$config["per_page"])-$config["per_page"];
				} else{
				$start = 0;
				}
				$data["links"] = $this->pagination->create_links();
				$countPage =  ceil($config["total_rows"]/$config["per_page"]);
				$list = $this->Apimodel->getAlleventList($start, $config["per_page"], @$userId, @$userInfo->email);
				if(!empty($list)) 
				{
					foreach ($list as $k => $v)
					{
						
						$gallery = $this->db->query("select * from event_gallery where event_id = '".@$v->event_id."' ORDER BY id ASC")->row();
						if(!empty($gallery)){
							if(!empty(@$gallery->image) && file_exists('uploads/event/'.@$gallery->image.'')){
							    $eventImg = base_url('uploads/event/'.@$gallery->image.'');
							}else{
							    $eventImg = base_url('uploads/noimage.jpg');
							}
						}else{
						    $eventImg = base_url('uploads/noimage.jpg');
						}
						
						$array[] = [
							'eventId' => @$v->event_id,
							'eventName' => @$v->event_name,
							'eventDate' => @$v->event_date,
							'eventTime' => @$v->event_time,
							'eventAddress' => @$v->event_address,
							'eventImg' => @$eventImg,
						];				
					}

					$array = $this->arrcheck($array);

					$this->response([
						'status'=>"1",
						'list'=>$array,
                        'pageCount' =>(!empty($array) ? $countPage : 0)	
					], 200);
				} else {
					$array = [];
					$this->response([
						'status' => "0",
						'error' => 'No events found.',
						'list'=>$array,
                        'pageCount' =>''	
					], 400);
				}

			}else{
				$this->response([
					'status' => "0",
					'error' => 'No user found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'userId is required.'
			], 400);
		}
	}
	
	function searchEvent_get(){
		
		if(!empty(@$_GET['userId'])){
			$userId = @$_GET['userId'];
			$page_no = @$_GET['page_no'];
			$query = $this->db->query("SELECT * FROM `users` WHERE `id`= '".$userId."' AND status = '1' LIMIT 1");
			$num_rows = $query->num_rows();
			if($num_rows > 0){
			    $userInfo = $query->row();
				
				$latitude = '';
				$longitude = '';
				
				if(!empty(@$_GET['latitude']) && !empty(@$_GET['longitude'])){ 
					$latitude = $_GET['latitude']; 
					$longitude = $_GET['longitude']; 
				}else{
					if(!empty($_GET['location'])){
						$where = "and event_address LIKE '%".@$_GET['location']."%'";
					}else{
						$where .= '';
					}
				}
				
				if(!empty($_GET['event'])){
					$event = $_GET['event'];
					$where .= "and event_name LIKE '%".@$_GET['event']."%'";
				}else{
					$where .= '';
				}
				
				$sql_distance = $having = ''; 
				if(!empty($latitude) && !empty($longitude)){ 
					$sql_distance = " ,(((acos(sin((".$latitude."*pi()/180)) * sin((`event_latitude`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`event_latitude`*pi()/180)) * cos(((".$longitude."-`event_longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance"; 
					$having = " HAVING (distance <= 100) "; 
					$order_by = ' distance ASC '; 
				}else{ 
					$order_by = ' event_id DESC '; 
				}
				
				$sql_1 = "SELECT * ".$sql_distance." FROM event where status = '1' and (user_id = ".$userId." OR event_id IN(select event_id from event_invited_people where email = '".$userInfo->email."')) $where $having ORDER BY $order_by"; 
				$countRows = $this->db->query($sql_1)->num_rows();
				
				$this->load->library("pagination");
				$config = array();
				//$where = "user_id=".@$userId." AND status = '1'";
				$config["total_rows"] = $countRows;
				$config["per_page"] = 10;
				$config['use_page_numbers'] = TRUE;
				$config['last_link'] = '<p style="padding: 0px 10px;"> Last </p>';
				$this->pagination->initialize($config);

				if($page_no){
				    $start = ($page_no*$config["per_page"])-$config["per_page"];
				} else{
				    $start = 0;
				}
				
				$data["links"] = $this->pagination->create_links();
				$countPage =  ceil($config["total_rows"]/$config["per_page"]);
				
				if(@$start == 0){
				    @$start = '';
				}else{
				    @$start = ''.$start.',';
				}
				
				//$limit = $config["per_page"];
			    //echo $where;die;
				$query = "SELECT * ".$sql_distance." FROM event where status = '1' and (user_id = ".$userId." OR event_id IN(select event_id from event_invited_people where email = '".$userInfo->email."')) $where $having ORDER BY $order_by Limit ".$start." ".@$config["per_page"].""; 
				$list = $this->db->query($query)->result();
				
				
				if(!empty($list)) 
				{
					foreach ($list as $k => $v)
					{
						
						$gallery = $this->db->query("select * from event_gallery where event_id = '".@$v->event_id."' ORDER BY id ASC")->row();
						if(!empty($gallery)){
							if(!empty(@$gallery->image) && file_exists('uploads/event/'.@$gallery->image.'')){
							    $eventImg = base_url('uploads/event/'.@$gallery->image.'');
							}else{
							    $eventImg = base_url('uploads/noimage.jpg');
							}
						}else{
						    $eventImg = base_url('uploads/noimage.jpg');
						}
						
						$array[] = [
							'eventId' => @$v->event_id,
							'eventName' => @$v->event_name,
							'eventDate' => @$v->event_date,
							'eventTime' => @$v->event_time,
							'eventAddress' => @$v->event_address,
							'eventImg' => @$eventImg,
						];				
					}

					$array = $this->arrcheck($array);

					$this->response([
						'status'=>"1",
						'list'=>$array,
                        'pageCount' =>(!empty($array) ? $countPage : 0)	
					], 200);
				} else {
					$array = [];
					$this->response([
						'status' => "0",
						'error' => 'No events found.',
						'list'=>$array,
                        'pageCount' =>''	
					], 400);
				}

			}else{
				$this->response([
					'status' => "0",
					'error' => 'No user found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'userId is required.'
			], 400);
		}
		
	}
	
	function completedEvent_get(){
		if(!empty(@$_GET['limit'])){
			$limit = "LIMIT ".@$_GET['limit']."";
		}else{
			$limit = "";
		}
		$current_date = date('Y-m-d');
		$query = $this->db->query("select event_id, event_name, event_description, event_date from event where status = '1' and event_date <='".$current_date."' ORDER BY event_id DESC $limit");
		$list = ($query->num_rows() > 0) ? $query->result() : FALSE;
		if(!empty($list)) 
		{
			foreach ($list as $k => $v)
			{
				
				$gallery = $this->db->query("select * from event_gallery where event_id = '".@$v->event_id."' ORDER BY id ASC")->row();
				if(!empty($gallery)){
					if(!empty(@$gallery->image) && file_exists('uploads/event/'.@$gallery->image.'')){
						$eventImg = base_url('uploads/event/'.@$gallery->image.'');
					}else{
						$eventImg = base_url('uploads/noimage.jpg');
					}
				}else{
					$eventImg = base_url('uploads/noimage.jpg');
				}
				
				$array[] = [
					'eventId' => @$v->event_id,
					'eventName' => @$v->event_name,
					'eventDate' => @$v->event_date,
					'eventTime' => @$v->event_time,
					'eventAddress' => @$v->event_address,
					'eventDescription' => strip_tags(@$v->event_description),
					'eventImg' => @$eventImg,
				];				
			}

			$array = $this->arrcheck($array);

			$this->response([
				'status'=>"1",
				'list'=>$array,
			], 200);
		} else {
			$array = [];
			$this->response([
				'status' => "0",
				'error' => 'No events found.',
				'list'=>$array,
				
			], 400);
		}

	}
	
	function customizePayment_post(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['userId'] = $this->post('userId');
			$userData['customizePayment'] = $this->post('customizePayment');
		}
		
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('customizePayment', 'customizePayment', 'trim|required');
		
		if ($this->form_validation->run() === false) 
		{
            
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
			
			if(form_error('customizePayment')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('customizePayment'))
				], 400);
			}

		} else {
			$data = array('customize_payment' => $userData['customizePayment']);
			$where="id='".@$userData['userId']."'";
			$result=$this->Apimodel->update_cond('users', $where, $data);
			if(!empty($result)){
				$fetchdetails = $this->Apimodel->get_cond('users', "id='".@$userData['userId']."'");
				if($fetchdetails->customize_payment == 1){
					$message = 'Your customize payment is ON successfully.';
				}else{
					$message = 'Your customize payment is OFF successfully.';
				}
				
				$this->response([
					'status' => "1",
					'userId' => @$userData['userId'],
					'message' => @$message
				], 200);
				
			}else{
				$this->response([
					'status' => "0",
					'userId' => @$userData['userId'],
					'error' => 'Some problems occurred, please try again.'
				], 200);
			}
			
		}
	}
	
	function invitedGuest_post(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['eventId'] = $this->post('eventId');
			$userData['email'] = $this->post('email');
			$userData['mobile'] = $this->post('mobile');
			$userData['amount'] = $this->post('amount');
			$userData['subscription'] = $this->post('subscription');
			
		}

		$this->form_validation->set_rules('eventId', 'eventId', 'trim|required');
		//$this->form_validation->set_rules('email', 'email', 'trim|required');
		//$this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
		$this->form_validation->set_rules('subscription', 'subscription', 'trim|required');
		

		if ($this->form_validation->run() === false) 
		{
            
			if(form_error('eventId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventId'))
				], 400);
			}
			
			// if(form_error('email')) {
				// $this->response([
					// 'status' => "0",
					// 'error' => strip_tags(form_error('email'))
				// ], 400);
			// }
			
			// if(form_error('mobile')) {
				// $this->response([
					// 'status' => "0",
					// 'error' => strip_tags(form_error('mobile'))
				// ], 400);
			// }


		} else {
            $eventInfo = $this->Apimodel->get_cond('event', "event_id='".@$userData['eventId']."'");
			if(!empty($eventInfo)){
				$userInfo = $this->Apimodel->get_cond('users', "id='".@$eventInfo->user_id."'");
				if(!empty($userInfo)){
					$userId = @$userInfo->id;
					//print_r($this->Mymodel->check_monthly_invitepeople_limit($userId));die;
					if($this->Mymodel->check_monthly_invitepeople_limit($userId) == '0'){
						$msg = 'Your limit is over for this month.';
						$title = 'Limit Reached';
						$this->response([
							'status' =>"0",
							'error' => $msg
						], 400);
						exit();
					}elseif($this->Mymodel->check_monthly_invitepeople_limit($userId) == 'free_limit_over'){
						$msg = 'Your free subscription has reached its limit.';
						$title = 'Limit Reached';
						$this->response([
							'status' =>"0",
							'error' => $msg
						], 400);
						exit();
					}elseif($this->Mymodel->check_monthly_invitepeople_limit($userId) == 'sub_over'){
						$msg = 'Your subscription plan is expired now.';
						$title = 'Subscription Expired';
						$this->response([
							'status' =>"0",
							'error' => $msg
						], 400);
						exit();
					}elseif($this->Mymodel->check_monthly_invitepeople_limit($userId) == 'total_invitaion_limit_over'){
						$msg = 'Your total invitation limit is over, Please subscribe now.';
						$title = 'Invitation Limit Over';
						$this->response([
							'status' =>"0",
							'error' => $msg
						], 400);
						exit();
					}elseif($this->Mymodel->check_monthly_invitepeople_limit($userId) == 'sub_not_found'){
						$msg = 'Your account has not found any subscription, Please subscribe now.';
						$title = 'Subscription Not Found.';
						$this->response([
							'status' =>"0",
							'error' => $msg
						], 400);
						exit();
					}
					
					$eventId = $userData['eventId'];
					$subscription = $userData['subscription'];
					$email = array_filter(@$userData['email']);
					$mobile = array_filter(@$userData['mobile']);
					
					
					$check_customize_payment = $this->Mymodel->get_single_row_info('customize_payment', 'users', 'id='.$userId.'', '', 1);
					$get_sub_id = $this->Mymodel->get_single_row_info('id', 'transaction', 'user_id='.$userId.' and payment_type = "1"', 'id DESC', 1);
					if($check_customize_payment->customize_payment == 1){
						$amount = array_filter(@$userData['amount']);
						$countemail = count($email);
						for($i=0;$i<$countemail;$i++){
							$email = $email[$i];
							$amount = $amount[$i];
							$insert_distrubuted_price[] = $this->db->query("INSERT INTO event_invited_people (email, event_id, distributed_event_price, user_id, status, invited_people, created_at, tran_id)VALUES ('".@$email."', ".@$eventId.", ".@$amount.", ".@$userId.", '1', '".@$subscription."', '".date('Y-m-d H:i:s')."', '".@$get_sub_id->id."')");
						}
						
						if(!empty(@$insert_distrubuted_price)){
							$userInfo = $this->db->query("select fname, lname from users where id = ".@$eventInfo->user_id."")->row();
							$from = ucfirst(@$userInfo->fname) .' '. ucfirst(@$userInfo->lname);
							$subject = "You've been invited to (".@$eventInfo->event_name.")";
							$date = $eventInfo->event_date.' '.$eventInfo->event_time;
							for($i=0;$i<$countemail;$i++){
								$email = $email[$i];
							    $amount = $amount[$i];
								$this->sendMail($email, $eventInfo->event_name, $from, $amount, $subject, $date);
								$this->db->query("UPDATE users set `total_invitation` = `total_invitation` - 1 where `id` = '".$userId."'");
							}
							
							$sms_invited_msg = "You've been invited to (".@$eventInfo->event_name.") \r\n";
							$sms_invited_msg .= "".base_url()."event/details?eId=".base64_encode(@$eventId)." \r\n";
							$sms_invited_msg .= "From : MadeToSplit ";
							for($i=0;$i<$countemail;$i++){
								$email = $email[$i];
							    $amount = $amount[$i];
								
								if(!empty($mobile)){
									@$this->Mymodel->send_sms($mobile, $sms_invited_msg);
								}
								
							}
							
							$this->response([ 
								'status' =>"1",
								'message' => "You have invited people successfully."
							], 200);
							
						}else{
							$this->response([ 
								'status' =>"0",
								'error' => "Some error occur, Please try again."
							], 400);
						}
						
						
					}else{
						if(!empty($email)){
							for($i = 0; $i < count($email); $i++){
								$checkEmail = $this->db->query("select email from event_invited_people where email = '".$email[$i]."' and event_id = '".$eventId."'")->num_rows();
								
								if($checkEmail > 0){
									$this->response([
										'status' =>"0",
										'error' => 'This email address '.@$email[$i].' is already invited for this event.'
									], 400);
									exit();	
								}
							}
						
							$existUser = $this->Mymodel->exist_invite_peoplecount($eventId);
							if($existUser > 0){
								$count = count(@$email) + $existUser;
								$amount = @$eventInfo->event_price / $count;
							}else{
								$count = count(@$email);
								$amount = @$eventInfo->event_price / $count;
							}
							$result = $this->Mymodel->addInvitedPeople($email, $eventId, $amount, $subscription);
							if($result){
								$this->Mymodel->update_price($eventId, $amount);
								$subject = "You've been invited to (".@$eventInfo->event_name.")";
							    $date = $eventInfo->event_date.' '.$eventInfo->event_time;
								if(!empty($email) && $email != ''){
									foreach($email as $k => $v){
										if(!empty($v) && $v != ''){
											$this->sendMail($v, $eventInfo->event_name, $from, $amount, $subject, $date);
											$this->db->query("UPDATE users set `total_invitation` = `total_invitation` - 1 where `id` = '".$userId."'");
										}else{
											break;
										}
										
									}
								}
								
								$this->response([ 
									'status' =>"1",
									'message' => "You have invited people successfully."
								], 200);
								
							}else{
								$this->response([ 
									'status' =>"0",
									'error' => "Some error occur, Please try again."
								], 400);
						    }
						}else{
							$this->response([ 
								'status' =>"0",
								'error' => "The email field is required."
							], 400);
						}
				    }
					
					
				}else{
					$this->response([ 
						'status' =>"0",
						'error' => "User not found."
					], 400);
				}
			}else{
				$this->response([
					'status' =>"0",
					'error' => "Event not found."
				], 400);
			}

		}
	}
	
	function eventGuestlist_get(){
		if(!empty(@$_GET['eventId'])){
			$eventId = @$_GET['eventId'];
			$query = $this->db->query("SELECT * FROM `event` WHERE `event_id`= '".$eventId."' AND status = '1' LIMIT 1");
			$num_rows = $query->num_rows();
			if($num_rows > 0){
				$eventInfo = $query->row();
                $list = $this->db->query("select * from event_invited_people where event_id = ".@$eventInfo->event_id." and status = '1'")->result();
			    if(!empty(@$list)){
					foreach(@$list as $k => $v){
						
						$getUser = $this->db->query("select id, fname, lname from users where email = '".@$v->email."' and status = '1'")->row();
						$userName = !empty($getUser->fname) ? @$getUser->fname .' '. @$getUser->lname : 'New User - Awaiting user registration';
						
						if(!empty($getUser->id)){
							$query = $this->db->query("select sum(amount) as totalAmount from transaction where user_id = ".$getUser->id." and event_id = ".$v->event_id." and payment_type = '2'")->row();
							$totolAmount = $query->totalAmount;
							$balance = $v->distributed_event_price - $totolAmount;
							$userId = $getUser->id;
						}else{
							$balance = $v->distributed_event_price;
							$totolAmount = 0;
							$userId = "";
						}
						
						if($v->distributed_event_price == $totolAmount){
							$status = 'Paid';
						}elseif($totolAmount == 0){
							$status = 'Unpaid';
						}elseif($balance < $v->distributed_event_price){
							$status = 'Partial';
						}
													
						$arr[] = [
							'id' => @$v->id,
							'invitedGuest' => @$userName,
							'email' => @$v->email,
							'perPerson' => @$v->distributed_event_price,
							'balance' => number_format(@$balance, 2),
							'status' => @$status,
						];
					}
					$this->response([
						'status'=>"1",
						'list'=>$arr
					], 200);
					
				}else{
					$arr = [];
					$this->response([
						'status' => "0",
						//'error' => 'No guest list found.',
						'list'=>$arr
					], 200);
				}

			}else{
				$this->response([
					'status' => "0",
					'error' => 'No event found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'eventId is required.'
			], 400);
		}
	}
	
	function deleteEvent_get(){
		if(!empty(@$_GET['eventId'])){
			$eventId = @$_GET['eventId'];
			$query = $this->db->query("select * from event where event_id = '".@$eventId."' ORDER BY event_id DESC");
			$event = ($query->num_rows() > 0) ? $query->num_rows() : FALSE;
			if($event > 0) 
			{
                $deleteEvent = $this->db->query("delete from event where event_id = '".@$eventId."'");
				if($deleteEvent){
					
					$gallery = $this->db->query("select * from event_gallery where event_id = '".@$eventId."' ORDER BY event_id DESC")->result();
					if(!empty($gallery)){
						foreach($gallery as $k => $v){
							if(!empty(@$v->image) && file_exists('uploads/event/'.@$v->image.'')){
								unlink('uploads/event/'.@$v->image.'');
								$this->db->query("delete from event_gallery where event_id = '".@$eventId."'");
							}
						}  
					}
					
					$this->response([
						'status'=>"1",
						'eventId'=>$eventId,
						'message'=>'Event deleted successfully.',
					], 200);
					
				}else{
					$this->response([
						'status' => "0",
						'error' => 'Some error occur, Please try again.'
					], 400);
				}
			}else{
				$this->response([
					'status' => "0",
					'error' => 'Event not found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'eventId is required.'
			], 400);
		}
	}
	
	function deleteEventImage_get(){
		if(!empty(@$_GET['imageId'])){
			$imageId = @$_GET['imageId'];
			$query = $this->db->query("select * from event_gallery where id = '".@$imageId."'");
			$image = ($query->num_rows() > 0) ? $query->num_rows() : FALSE;
			if($image > 0) 
			{

				$gallery = $this->db->query("select * from event_gallery where id = '".@$imageId."'")->row();
				if(!empty(@$gallery->image) && file_exists('uploads/event/'.@$gallery->image.'')){
					unlink('uploads/event/'.@$gallery->image.'');
					$this->db->query("delete from event_gallery where id = '".@$imageId."'");
				}
				$this->response([
					'status'=>"1",
					'imageId'=>$imageId,
					'message'=>'Image deleted successfully.',
				], 200);
			}else{
				$this->response([
					'status' => "0",
					'error' => 'Image not found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'imageId is required.'
			], 400);
		}
	}
	
	function featureList_get(){
       
		$current_date = date('Y-m-d');
		$query = $this->db->query("select * from features where status = '1'  ORDER BY id DESC");
		$list = ($query->num_rows() > 0) ? $query->result() : FALSE;
		if(!empty($list)) 
		{
			foreach ($list as $k => $v)
			{

				if(!empty(@$v->image) && file_exists('uploads/feature/'.@$v->image.'')){
					$featureImg = base_url('uploads/feature/'.@$v->image.'');
				}else{
					$featureImg = base_url('uploads/noimage.jpg');
				}
				
				
				$array[] = [
					'id' => @$v->id,
					'heading' => @$v->heading,
					'description' => strip_tags(@$v->description),
					'image' => @$featureImg
				];				
			}

			$array = $this->arrcheck($array);

			$this->response([
				'status'=>"1",
				'list'=>$array,
			], 200);
		} else {
			$array = [];
			$this->response([
				'status' => "0",
				'error' => 'No features found.',
			], 400);
		}
	}
	
	function eventPlaning_get(){
		$current_date = date('Y-m-d');
		$query = $this->db->query("select * from event_step_process where status = '1'  ORDER BY id DESC");
		$list = ($query->num_rows() > 0) ? $query->result() : FALSE;
		if(!empty($list)) 
		{
			foreach ($list as $k => $v)
			{

				if(!empty(@$v->image) && file_exists('uploads/event_process/'.@$v->image.'')){
					$featureImg = base_url('uploads/event_process/'.@$v->image.'');
				}else{
					$featureImg = base_url('uploads/noimage.jpg');
				}
				
				
				$array[] = [
					'id' => @$v->id,
					'heading' => @$v->heading,
					'description' => strip_tags(@$v->description),
					'image' => @$featureImg
				];				
			}

			$array = $this->arrcheck($array);

			$this->response([
				'status'=>"1",
				'list'=>$array,
			], 200);
		} else {
			$array = [];
			$this->response([
				'status' => "0",
				'error' => 'Not found.',
			], 400);
		}
	}
	
	function transactionHistory_get(){
		if(!empty(@$_GET['userId'])){
			$userId = @$_GET['userId'];
			$query = $this->db->query("select * from users where id = '".@$userId."'");
			$userInfo = ($query->num_rows() > 0) ? $query->num_rows() : FALSE;
			if($userInfo > 0) 
			{

				$list = $this->db->query("select * from transaction where user_id = '".@$userId."' and (subscription IS NULL OR subscription = 'Paid') ORDER BY id DESC")->result();
				if(!empty($list)){
					foreach($list as $k => $v){
						
						if(!empty(@$v->sub_id)){
							$sub = $this->db->query("select name from subscription where id = ".@$v->sub_id."")->row();
							$subName = @$sub->name;
							if(@$v->payment_type == 1){
							$payment_type = 'Subscription';
							}
						}else{
							$payment_type = 'Paid For Event';
							$subName = '';
						}
						
						if($v->paid_by_admin == 1){
						    $paid_by = 'User';
						}else{
						    $paid_by = 'Event Host';
						}
												
						$array[] = [
						    'id' => @$v->id,
						    'userName' => @$v->user_name,
						    'tranId' => @$v->tran_id,
						    'orderId' => @$v->order_id,
						    'amount' => @$v->amount,
						    'paymentType' => @$payment_type,
						    'paidBy' => @$paid_by,
						    'currency' => @$v->currency,
						    'subscription' => @$subName,
						    'paymentStatus' => @$v->status,
						    'paymentDate' => @$v->created_at,
						];
					}
					$array = $this->arrcheck($array);

					$this->response([
						'status'=>"1",
						'list'=>$array,
					], 200);

				}else{
					$this->response([
						'status' => "0",
						'error' => 'No transaction found.'
					], 400);
				}
				
			}else{
				$this->response([
					'status' => "0",
					'error' => 'User not found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'userId is required.'
			], 400);
		}
	}
	
	function createTemplate_post(){
        $json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['userId'] = $this->post('userId');
			$userData['subject'] = $this->post('subject');
			$userData['body'] = $this->post('body');
		}
		
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('subject', 'subject', 'trim|required');
		$this->form_validation->set_rules('body', 'body', 'trim|required');
		
		if ($this->form_validation->run() === false) 
		{
            
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
			
			if(form_error('subject')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('subject'))
				], 400);
			}
			
			if(form_error('body')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('body'))
				], 400);
			}

		} else {
			$checkUser = $this->db->query("select * from users where id = '".@$userData['userId']."'")->num_rows();
			if($checkUser > 0){
				if(!empty($_FILES['attachment']['name'])){
					$config['upload_path'] = 'uploads/email'; # check path is correct
					$config['allowed_types'] = 'jpg|png|jpeg|pdf|docx|xlxs|csv|gif'; # add video extenstion on here
					$config['overwrite'] = FALSE;
					$config['remove_spaces'] = TRUE;
					$image_name = preg_replace("/\s+/", "_", $_FILES['attachment']['name']);
					$config['file_name'] = $image_name;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('attachment')) {
						$this->response([
							'status' => "0",
							'error' => $this->upload->display_errors()
						], 400);
						exit();
					}else {
						$data = array(
							'body' => @$userData['body'],
							'subject' => @$userData['subject'],
							'attachment' => $image_name,
							'user_id' => @$userData['userId'],
							'created_date'   => date('Y-m-d H:i:s')
						);
						$result=$this->Apimodel->add_details("email_template", $data);
						if($result){
							$this->response([
								'status'=>"1",
								'templateId'=>@$result,
								'message'=>'Created email template successfully.',
							], 200);
						}else{
							$this->response([
								'status' => "0",
								'error' => 'Some error ocure.Please try again.'
							], 400);
						}
					}
				}else{
					$data = array(
						'body' => @$userData['body'],
						'subject' => @$userData['subject'],
						'user_id' => @$userData['userId'],
						'created_date'   => date('Y-m-d H:i:s')
					);
					$result=$this->Apimodel->add_details("email_template", $data);
					if($result){
						$this->response([
							'status'=>"1",
							'templateId'=>@$result,
							'message'=>'Created email template successfully.',
						], 200);
					}else{
						$this->response([
							'status' => "0",
							'error' => 'Some error ocure.Please try again.'
						], 400);
					}
				}
			}else{
				$this->response([
					'status' => "0",
					'error' => 'User not found.'
				], 400);
			}
		}
	}
	
	function templateList_get(){
		if(!empty(@$_GET['userId'])){
			$userId = @$_GET['userId'];
			$query = $this->db->query("select * from users where id = '".@$userId."'");
			$userInfo = ($query->num_rows() > 0) ? $query->num_rows() : FALSE;
			if($userInfo > 0) 
			{
				$list = $this->db->query("select * from email_template where user_id = '".@$userId."' ORDER BY id DESC")->result();
				if(!empty($list)){
					foreach($list as $k => $v){
						if(!empty(@$v->attachment) && file_exists('uploads/email/'.@$v->attachment.'')){
							$attachment = base_url('uploads/email/'.@$v->attachment.'');
						}else{
							$attachment = '';
						}
						
						$array[] = [
						    'templateId' => @$v->id,
						    'subject' => @$v->subject,
						    'body' => @$v->body,
						    'attachment' => @$attachment,
						];
					}
					
					$array = $this->arrcheck($array);

					$this->response([
						'status'=>"1",
						'list'=>$array,
					], 200);
					
				}else{
					$this->response([
						'status' => "0",
						'error' => 'No template found.'
					], 400);
				}
			}else{
				$this->response([
					'status' => "0",
					'error' => 'User not found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'userId is required.'
			], 400);
		}
	}
	
	function templateDetails_get(){
		if(!empty(@$_GET['templateId'])){
			$templateId = @$_GET['templateId'];
			
				$list = $this->db->query("select * from email_template where id = '".@$templateId."' ORDER BY id DESC")->row();
				if(!empty($list)){
					
						if(!empty(@$list->attachment) && file_exists('uploads/email/'.@$list->attachment.'')){
							$attachment = base_url('uploads/email/'.@$list->attachment.'');
						}else{
							$attachment = '';
						}
						
						$array = [
						    'templateId' => @$list->id,
						    'subject' => @$list->subject,
						    'body' => @$list->body,
						    'attachment' => @$attachment,
						];
					
					
					$this->response([
						'status'=>"1",
						'templateDetail'=>$array,
					], 200);
					
				}else{
					$this->response([
						'status' => "0",
						'error' => 'No template found.'
					], 400);
				}
			
		}else{
			$this->response([
				'status' => "0",
				'error' => 'templateId is required.'
			], 400);
		}
	}
	function editTeplate_post(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['templateId'] = $this->post('templateId');
			$userData['subject'] = $this->post('subject');
			$userData['body'] = $this->post('body');
		}
		
		$this->form_validation->set_rules('templateId', 'templateId', 'trim|required');
		$this->form_validation->set_rules('subject', 'subject', 'trim|required');
		$this->form_validation->set_rules('body', 'body', 'trim|required');
		
		if ($this->form_validation->run() === false) 
		{
            
			if(form_error('templateId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('templateId'))
				], 400);
			}
			
			if(form_error('subject')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('subject'))
				], 400);
			}
			
			if(form_error('body')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('body'))
				], 400);
			}

		} else {
			
			if(!empty($_FILES['attachment']['name'])){
				$config['upload_path'] = 'uploads/email'; # check path is correct
				$config['allowed_types'] = 'jpg|png|jpeg|pdf|docx|xlxs|csv|gif'; # add video extenstion on here
				$config['overwrite'] = FALSE;
				$config['remove_spaces'] = TRUE;
				$image_name = preg_replace("/\s+/", "_", $_FILES['attachment']['name']);
				$config['file_name'] = $image_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('attachment')) {
					$this->response([
						'status' => "0",
						'error' => $this->upload->display_errors()
					], 400);
					exit();
				}else {
					$data = array(
						'body' => @$userData['body'],
						'subject' => @$userData['subject'],
						'attachment' => $image_name,
						'created_date'   => date('Y-m-d H:i:s')
					);
					
					$result=$this->Apimodel->update_cond('email_template', array('id' => $userData['templateId']), $data);	
					if($result){
						$this->response([
							'status'=>"1",
							'templateId'=>@$userData['templateId'],
							'message'=>'Email template updated successfully.',
						], 200);
					}else{
						$this->response([
							'status' => "0",
							'error' => 'Some error ocure.Please try again.'
						], 400);
					}
				}
			}else{
				$data = array(
					'body' => @$userData['body'],
					'subject' => @$userData['subject'],
					'created_date'   => date('Y-m-d H:i:s')
				);
				$result=$this->Apimodel->update_cond('email_template', array('id' => $userData['templateId']), $data);	
				if($result){
					$this->response([
						'status'=>"1",
						'templateId'=>@$userData['templateId'],
						'message'=>'Email template updated successfully.',
					], 200);
				}else{
					$this->response([
						'status' => "0",
						'error' => 'Some error ocure.Please try again.'
					], 400);
				}
			}
		}
	}
	
	function duplicateTemplate_get()
	{
		
		if(!empty(@$_GET['templateId'])){
			$templateId = @$_GET['templateId'];
			
				$list = $this->db->query("select * from email_template where id = '".@$templateId."' ORDER BY id DESC")->row();
				if(!empty($list)){
					$data=array(
						'subject'=>$list->subject,
						'body'=>$list->body,
						'attachment'=>$list->attachment,
						'type'=>'duplicate',
						'user_id'=>$list->user_id,
						'created_date'=>date('Y-m-d H:i:s'),
					);
					
					$result=$this->Apimodel->add_details("email_template", $data);
					if($result){
						$this->response([
							'status'=>"1",
							'templateId'=>@$result,
							'message'=>'Duplicate email template created successfully..',
						], 200);
					}else{
						$this->response([
							'status' => "0",
							'error' => 'Some error ocure.Please try again.'
						], 400);
					}
					
				}else{
					$this->response([
						'status' => "0",
						'error' => 'No template found.'
					], 400);
				}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'templateId is required.'
			], 400);
		}
		
	}
	
	function deleteTemplate_get(){
		if(!empty(@$_GET['templateId'])){
			$templateId = @$_GET['templateId'];
			$query = $this->db->query("select * from email_template where id = '".@$templateId."'");
			$image = ($query->num_rows() > 0) ? $query->num_rows() : FALSE;
			if($image > 0) 
			{

				$email_template = $this->db->query("select * from email_template where id = '".@$templateId."'")->row();
				if(!empty(@$email_template->attachment) && file_exists('uploads/email/'.@$email_template->attachment.'')){
					unlink('uploads/email/'.@$email_template->attachment.'');
					$this->db->query("delete from email_template where id = '".@$templateId."'");
				}
				$this->response([
					'status'=>"1",
					'templateId'=>$templateId,
					'message'=>'Email template deleted successfully.',
				], 200);
			}else{
				$this->response([
					'status' => "0",
					'error' => 'Email template not found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'templateId is required.'
			], 400);
		}
	}
	
	function draftList_get(){
		if(!empty(@$_GET['userId'])){
			$userId = @$_GET['userId'];
			$query = $this->db->query("select * from users where id = '".@$userId."'");
			$userInfo = ($query->num_rows() > 0) ? $query->num_rows() : FALSE;
			if($userInfo > 0) 
			{
				
				$list = $query = $this->db->query("select * from compose_email where user_id = '".@$userId."' AND type = 'draft' ORDER BY id DESC")->result();
				if(!empty($list)){
					foreach($list as $k => $v){
						
						
						if(empty(@$v->created_date) || @$v->created_date == '0000-00-00 00:00:00'){
							$date = '';
						} else{
							$date = @$v->created_date;
						}
						
						if(!empty($v->recipients)){
							$recipients = $v->recipients;
							
						}
						
						$array[] = [
						    'id' => @$v->id,
						    'date' => @$date,
						    'subject' => @$v->subject,
						    'recipients' => [@$recipients],
						];
					}
					
					$array = $this->arrcheck($array);

					$this->response([
						'status'=>"1",
						'list'=>$array,
					], 200);
					
				}else{
					$array = [];
					$this->response([
						'status' => "0",
						'error' => 'No list found.',
						'list'=>$array,
					], 200);
				}
			}else{
				$this->response([
					'status' => "0",
					'error' => 'User not found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'userId is required.'
			], 400);
		}
	}
	
	function draftDetails_get(){
		if(!empty(@$_GET['draftTemplateId'])){
			$useTemplate = $this->db->query("select * from compose_email where id = '".@$_GET['draftTemplateId']."'")->row();
			if(!empty($useTemplate)){
				
				if(!empty($useTemplate->attachment) && file_exists('uploads/email/'.$useTemplate->attachment.'')){
					$attachment = base_url('uploads/email/'.$useTemplate->attachment.'');
				}else{
					$attachment = '';
				}
				
				$array = [
					'draftTemplateId' => $useTemplate->id,
					'subject' => $useTemplate->subject,
					'body' => $useTemplate->body,
					'attachment' => $attachment,
				];
				
				$array = $this->arrcheck($array);

				$this->response([
					'status'=>"1",
					'details'=>$array,

				], 200);
				
			}else{
				$this->response([
					'status' => "0",
					'error' => 'No data found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'draftTemplateId is required.'
			], 400);
		}
	}
	
	function invitedCsv_post(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			
			$userData['eventId'] = $this->post('eventId');
			$userData['userId'] = $this->post('userId');
			$userData['customizePayment'] = $this->post('customizePayment');
		}
		
		$this->form_validation->set_rules('eventId', 'eventId', 'trim|required');
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('customizePayment', 'customizePayment', 'trim|required');
		if ($this->form_validation->run() === false) 
		{
			if(form_error('eventId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventId'))
				], 400);
			}
			
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
			
			if(form_error('customizePayment')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('customizePayment'))
				], 400);
			}
		}else{
			$csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv','text/xls','text/xlsx');
			if(!empty($_FILES['file']['name'])){
				if(in_array($_FILES['file']['type'],$csvMimes)){
					$eventId = $userData['eventId'];
					$customizePayment = $userData['customizePayment'];
					
					$event_info = $this->Mymodel->get_single_row_info('user_id, event_price', 'event', 'event_id='.@$eventId.'', '', 1);
					
					$get_sub_id = $this->Mymodel->get_single_row_info('id, subscription', 'transaction', 'user_id='.$event_info->user_id.' and payment_type = "1"', 'id DESC', 1);
					
					if(!empty(@$get_sub_id)){
						if(@$get_sub_id->subscription == 'Free'){
							$subscription = 'free subscription';
						}else{
							$subscription = 'paid subscription';
						}
					}else{
						$subscription = '';
					}
					
					if($customizePayment == 1){
						$csv_explode_email = [];
						$csv_explode_amount = [];
						$csv_explode_phone = [];
						$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
						fgetcsv($csvFile);
						
						while(($line = fgetcsv($csvFile)) !== FALSE){ 
							$csv_explode_email[] = $line[0];
							$csv_explode_amount[] = $line[1];
							$csv_explode_phone[] = $line[2];
						}
						$mobile_number = array_filter(@$csv_explode_phone);
						$amount_filter = $csv_explode_amount;
						$array_email = !empty($this->showDups(array_filter($csv_explode_email))) ? $this->showDups(array_filter($csv_explode_email)) : '';
						$array_email_count = !empty($array_email) ? count((array)$array_email) : 0;
						if($array_email_count > 0){
							$this->response([
								'status' => "0",
								'error' => "Following are the duplicate email '".join(",", @$array_email)."' "
							], 400);
							exit();
						}else{

							$large_amount = $this->check_bulk_amount($eventId, $amount_filter);
							//print_r($large_amount);die;
							if(@$large_amount > @$event_info->event_price){
								$this->response([
									'status' => "0",
									'error' => "Your have enter distributed amount greater than event amount.Please enter small amount."
								], 400);
								exit();
							}

							for($i = 0; $i < count($csv_explode_email); $i++){
								if(!empty($csv_explode_email[$i])){
									// print_r($csv_explode_email[$i]);
									// print_r($amount_filter[$i]);
									$result[] = $this->db->query("INSERT INTO event_invited_people (email, event_id, distributed_event_price, user_id, status, invited_people, created_at, tran_id)VALUES ('".@$csv_explode_email[$i]."', ".@$eventId.", ".@$amount_filter[$i].", ".@$event_info->user_id.", '1', '".@$subscription."', '".date('Y-m-d H:i:s')."', '".@$get_sub_id->id."')");
								}
							}
                            if(!empty($result)){
								$this->send_mail_via_bulk_upload($eventId, $csv_explode_email);
								$this->send_mobile_sms($eventId, $mobile_number);
								$this->response([
									'status' => "1",
									'message' => "You have invited people successfully."
								], 200);
							}else{
								$this->response([
									'status' => "0",
									'message' => "Some error occure, Please try again."
								], 400);
							}							
						}
						
					}else{
						$csv_explode_email = [];
						$csv_explode_phone = [];
						//open uploaded csv file with read only mode
						$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
						fgetcsv($csvFile);
						while(($line = fgetcsv($csvFile)) !== FALSE){ 
							//print_r($line[0]);
							$csv_explode_email[] = $line[0];
							$csv_explode_phone[] = $line[2];
						}
						
						$array_email = !empty($this->showDups(array_filter($csv_explode_email))) ? $this->showDups(array_filter($csv_explode_email)) : '';
						$array_email_count = !empty($array_email) ? count((array)$array_email) : 0;
						$mobile_number = array_filter(@$csv_explode_phone);
						if($array_email_count > 0){
							$this->response([
								'status' => "0",
								'error' => "Following are the duplicate email '".join(",", @$array_email)."' "
							], 400);
							exit();
						}else{
							$existUser = $this->Mymodel->exist_invite_peoplecount($eventId);
							if($existUser > 0){
								$count = count(array_filter(@$csv_explode_email)) + $existUser;
								$amount = @$event_info->event_price / $count;
							}else{
								$count = count(array_filter(@$csv_explode_email));
								$amount = @$event_info->event_price / $count;
							}
						
							for($i = 0; $i < count($csv_explode_email); $i++){
								if(!empty($csv_explode_email[$i])){
									$result[] = $this->db->query("INSERT INTO event_invited_people (email, event_id, distributed_event_price, user_id, status, invited_people, created_at, tran_id)VALUES ('".@$csv_explode_email[$i]."', ".@$eventId.", ".@$amount.", ".@$event_info->user_id.", '1', '".@$subscription."', '".date('Y-m-d H:i:s')."', '".@$get_sub_id->id."')");
								}
							}
							
							if(!empty($result)){
								$this->send_mail_via_bulk_upload($eventId, $csv_explode_email);
								$this->send_mobile_sms($eventId, $mobile_number);
								$this->response([
									'status' => "1",
									'message' => "You have invited people successfully."
								], 200);
							}else{
								$this->response([
									'status' => "0",
									'message' => "Some error occure, Please try again."
								], 400);
							}
							
						}
					}
					
				}else{
					$this->response([
						'status' => "0",
						'error' => "Your file type not supported."
					], 400);
				}
			}else{
				$this->response([
					'status' => "0",
					'error' => "file is required."
				], 400);
			}
		}
		
	}
	
	function send_mobile_sms($event_id = '', $mobile = array()){
		
		$event_id = $event_id;
		$mobile = array_filter($mobile);
		$event = $this->db->query("select * from event where event_id = ".$event_id."")->row();
		
		$sms_invited_msg = "You've been invited to (".@$event->event_name.") \r\n";
		$sms_invited_msg .= "".base_url()."event/details?eId=".base64_encode(@$event->event_id)." \r\n";
		$sms_invited_msg .= "From : MadeToSplit ";
		
		for($i = 0; $i < count($mobile); $i++){
			@$this->Mymodel->send_sms('+'.$mobile[$i], $sms_invited_msg);
		}
	}
	function send_mail_via_bulk_upload($event_id = '', $email = array()){
		
		$event_id = $event_id;
		$email = array_filter($email);
		//$amount = array_filter($this->input->post('amount'));
		//print_r($_POST);
		$event_info = $this->Mymodel->get_single_row_info('event_id, event_name, event_date, user_id', 'event', 'event_id='.$event_id.'', '', 1);
		//print_r($event_info);die;
		$event_org_info = $this->Mymodel->get_single_row_info('id, fname, lname', 'users', 'id='.$event_info->user_id.'', '', 1);
		
		$subject = "You've been invited to (".@$event_info->event_name.")";
		@$from = @$event_org_info->fname .' '. @$event_org_info->lname;
			require_once APPPATH.'third_party/email/vendor/autoload.php';
			$from_email = "info@madetosplit.com"; 
			$imagePath = base_url() . 'uploads/logos/logo.png';
			$imagebackPath = '';
			$mesg = "<!Doctype html>
			<html>
				<head>
					<meta charset='utf-8'>
					<meta name='viewport' content='width=device-width, initial-scale=1'>
					<title>Invite People</title>
					<link href='https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap' rel='stylesheet'>
					</head>
				<body>
					<div style='max-width:600px;
					margin:auto;
					border:1px solid #eee;
					box-shadow:0 0 10px rgba(0, 0, 0, .15);
					line-height:17px;
					font-size:13px;
					box-sizing:border-box; -webkit-print-color-adjust: exact;font-family: Poppins, sans-serif; background:url(".$imagebackPath.")'>
						<div style='padding:20px; box-sizing: border-box;text-align: center; background: #fff;'>
							<a href='#'><img src='".$imagePath."' style='width: 350px; height80px;'></a>
						</div>
						<div style='width: 400px; margin:50px auto;background: #ffffffd1;padding: 50px;text-align: center;'>
							<h1 style=' font-size: 30px; line-height: 32px; color: #0b0b0b; margin: 30px 0;'>Dear User</h1>
							<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'>You have invited for <strong>".@$event_info->event_name."</strong> event from <strong>".@$from." </strong></p>
							
							<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'>Event date : <strong>".date('d M, Y', strtotime(@$event_info->event_date))."</strong></p>
							
							<a href='".base_url('login')."' >Register</a>
						</div>
						
						<div style='background: #000;
						text-align: left;
						box-sizing: border-box;
						width: 100%;
						padding: 20px 50px;
						color: #fff;'>
							<p style='margin: 5px 0;font-size: 12px;'>Warm Regards,</p>
							<p style='margin: 5px 0;font-size: 12px;'>Made to Split</p>
							<p style='margin: 5px 0;font-size: 12px;'><strong>Email:</strong> <a href='#' style='color: #78daff;'>info@madetosplit.com</a></p>
							<br/>
							<p style='margin: 5px 0;font-size: 11px;'>This is an automated response, please do not reply.</p>
						</div>
					</div>
				</body>
			</html>";
			$to=[];
		   
			foreach ($email as $value){
				$to[] = $value;
			}
			$result = $this->Mymodel->mail_send_management('info@madetosplit.com', 'info@madetosplit.com', $to, $mesg, @$subject, 'info@madetosplit.com', 'M@d32spl1t');
		
	}
	
	function showDups($array)
	{
		$array_temp = array();
		foreach($array as $val)
		{
			if (!in_array($val, $array_temp))
			{
			    $array_temp[] = $val;
			}
			else
			{
			    //echo 'duplicate = ' . $val . '<br />';
				return $val;
			}
		}
	}
	function check_bulk_amount($event_id = '', $amount = ''){
		$guest_amount = array_sum($amount);
		$total_amount_sum = $this->Mymodel->total_sum(@$event_id);
		$total_event_amount = $guest_amount + $total_amount_sum->totalAmount;
		return $total_event_amount;
	}
	
	function guestDetails_get(){
		if(!empty(@$_GET['guestId'])){
			$guestId = @$_GET['guestId'];
			$query = $this->db->query("select * from event_invited_people where id = '".@$guestId."'");
			$userInfo = ($query->num_rows() > 0) ? $query->num_rows() : FALSE;
			if($userInfo > 0) 
			{
				
				$list = $query = $this->db->query("select * from event_invited_people where id = '".@$guestId."' ORDER BY id DESC LIMIT 1")->result();
				if(!empty($list)){
					foreach($list as $k => $v){
						$getUser = $this->db->query("select id, fname, lname from users where email = '".@$v->email."' and status = '1'")->row();
						$userName = !empty($getUser->fname) ? @$getUser->fname .' '. @$getUser->lname : 'New User - Awaiting user registration';
						
						if(!empty($getUser->id)){
							$query = $this->db->query("select sum(amount) as totalAmount from transaction where user_id = ".$getUser->id." and event_id = ".$v->event_id." and payment_type = '2'")->row();
							$totolAmount = $query->totalAmount;
							$balance = $v->distributed_event_price - $totolAmount;
							$userId = $getUser->id;
						}else{
							$balance = $v->distributed_event_price;
							$totolAmount = 0;
							$userId = "";
						}
						
						if($v->distributed_event_price == $totolAmount){
							$status = 'Paid';
						}elseif($totolAmount == 0){
							$status = 'Unpaid';
						}elseif($balance < $v->distributed_event_price){
							$status = 'Partial';
						}
													
						$arr[] = [
							'id' => @$v->id,
							'guestId' => @$userId,
							'invitedGuest' => @$userName,
							'email' => @$v->email,
							'perPerson' => @$v->distributed_event_price,
							'balance' => number_format(@$balance, 2),
							'status' => @$status,
						];
					}
					
					$array = $this->arrcheck($arr);

					$this->response([
						'status'=>"1",
						'guestDetails'=>$arr,
					], 200);
					
				}else{
					$array = [];
					$this->response([
						'status' => "0",
						'error' => 'No data found.',
						'guestDetails'=>$array,
					], 200);
				}
			}else{
				$this->response([
					'status' => "0",
					'error' => 'Guest not found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'guestId is required.'
			], 400);
		}
	}
	
	function editGuest_post(){
        $json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['guestId'] = $this->post('guestId');
			$userData['email'] = $this->post('email');
			$userData['amount'] = $this->post('amount');
			$userData['eventId'] = $this->post('eventId');
		}
		
		$this->form_validation->set_rules('guestId', 'guestId', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('amount', 'amount', 'trim|required');
		$this->form_validation->set_rules('eventId', 'eventId', 'trim|required');
		
		if ($this->form_validation->run() === false) 
		{
            
			if(form_error('guestId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('guestId'))
				], 400);
			}
			
			if(form_error('email')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('email'))
				], 400);
			}
			
			if(form_error('amount')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('amount'))
				], 400);
			}
			
			if(form_error('eventId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventId'))
				], 400);
			}

		} else {
			$checkemailexist = $this->db->query("select * from event_invited_people where id =".trim(strip_tags(@$userData['guestId']))."")->row();
			if(@$checkemailexist->email != trim(strip_tags(@$userData['email']))){
				
				$email_exit = $this->db->query("select * from event_invited_people where email ='".@$userData['email']."' and event_id = ".@$userData['eventId']."")->num_rows();
				if($email_exit > 0){
					$this->response([
						'status' => "0",
						'error' => 'This email address is already invited for this event.'
					], 400);
					exit();
				}else{
					$clientamount = @$userData['amount'];
					$total_amount_sum = $this->Mymodel->total_sum(trim(strip_tags(@$userData['eventId'])));
					$total_event_amount = $clientamount + $total_amount_sum->totalAmount;
					$eventPrice = $this->Mymodel->get_single_row_info('event_price', 'event', 'event_id='.trim(strip_tags(@$userData['eventId'])).'', '', 1);
					if(@$total_event_amount <= @$eventPrice->event_price){
						$data = array('email' => @$userData['email'], 'distributed_event_price' => @$userData['amount']);
						$result = $this->Mymodel->update($data, 'event_invited_people', array('event_id' => @$userData['eventId'], 'id' => @$userData['guestId']));
						if(!empty($result)){
							$this->response([
								'status' => "1",
								'message' => 'Invited people updated successfully.'
							], 200);
						}else{
							$this->response([
								'status' => "0",
								'error' => 'Some problems occured, Please try again.'
							], 400);
						}
					}else{
						$this->response([
							'status' => "0",
							'error' => 'Your have enter distributed amount greater than event amount.Please enter small amount.'
						], 400);
					}
				}
				
			}else{
				$clientamount = @$userData['amount'];
				$total_amount_sum = $this->Mymodel->total_sum(trim(strip_tags(@$userData['eventId'])));
				$total_event_amount = $clientamount + $total_amount_sum->totalAmount;
				$eventPrice = $this->Mymodel->get_single_row_info('event_price', 'event', 'event_id='.trim(strip_tags(@$userData['eventId'])).'', '', 1);
				if(@$total_event_amount <= @$eventPrice->event_price){
					$data = array('email' => @$userData['email'], 'distributed_event_price' => @$userData['amount']);
					$result = $this->Mymodel->update($data, 'event_invited_people', array('event_id' => @$userData['eventId'], 'id' => @$userData['guestId']));
					if(!empty($result)){		
						$this->response([
							'status' => "1",
							'message' => 'Invited people updated successfully.'
						], 200);
					}else{
						$this->response([
							'status' => "0",
							'error' => 'Some problems occured, Please try again.'
						], 400);
					}
				}else{
					$this->response([
						'status' => "0",
						'error' => 'Your have enter distributed amount greater than event amount.Please enter small amount.'
					], 400);
				}
			}	
		}
	}
	
	function deleteGuest_get(){
		if(!empty(@$_GET['guestId'])){
			$guestId = @$_GET['guestId'];
			$query = $this->db->query("select * from event_invited_people where id = '".@$guestId."'");
			$userInfo = ($query->num_rows() > 0) ? $query->num_rows() : FALSE;
			if($userInfo > 0) 
			{
                $deleteQuery = $this->db->query("delete from event_invited_people where id = '".$guestId."'");
				if($deleteQuery){
					$this->response([
						'status' => "1",
						'error' => 'Guest deleted successfully.'
					], 200); 
				}else{
					$this->response([
						'status' => "0",
						'error' => 'Some error occured, Please try again.'
					], 400);
				}
			}else{
				$this->response([
					'status' => "0",
					'error' => 'Guest not found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'guestId is required.'
			], 400);
		}
	}
	
	function cohostList_get(){
		if(!empty(@$_GET['eventId'])){
			$eventId = @$_GET['eventId'];
			$query = $this->db->query("select * from event where event_id = '".@$eventId."'");
			$eventInfo = ($query->num_rows() > 0) ? $query->num_rows() : FALSE;
			if($eventInfo > 0) 
			{
				$arr = [];
                $list = $this->db->query("select email from event_invited_people where event_id = ".$eventId."")->result();
				if(!empty($list)){
					foreach($list as $k => $v){
						
						$cohost = $this->db->query('select id, fname, lname from users where email = "'.$v->email.'"')->row();
						if(!empty($cohost)){
							$arr[] = [
								'cohostId' => @$cohost->id,
								'name' => @$cohost->fname.' '.@$cohost->lname,
							];
						}
						
					}
					$array = $this->arrcheck($arr);

					$this->response([
						'status'=>"1",
						'list'=>$arr,
					], 200);
				}else{
					$array = [];
					$this->response([
						'status' => "0",
						'error' => 'Cohost not found.',
						'list'=>$array,
					], 400);
				}
			}else{
				$this->response([
					'status' => "0",
					'error' => 'Event not found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'eventId is required.'
			], 400);
		}
	}
	
	function homeBanner_get(){	
		$query = $this->db->query("select * from banner_block where status = '1'");
		$bannerInfo = ($query->num_rows() > 0) ? $query->num_rows() : FALSE;
		if($bannerInfo > 0) 
		{
			$banner = $query->row();
			if(!empty(@$banner->image_2) && file_exists('uploads/banner/'.@$banner->image_2.'')){
				$image = base_url('uploads/banner/'.@$banner->image_2.'');
			}else{
				$image = base_url('assets/images/user-bg.png');
			}
			$array = [
				'status' =>'1',
				'bannerInfo' => [
					'id' => $banner->id,
					'image' => $image,
					'heading' => $banner->heading,
					'buttonText' => $banner->button_text,
				]
			];
			
			$array = $this->arrcheck($array);
			$this->response($array, 200);
		}else{
			$this->response([
				'status' => "0",
				'error' => 'Banner info not found.'
			], 400);
		}
	}

	function newsletter_post(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['email'] = $this->post('email');
		}
		
		$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|callback_email_check');
		if ($this->form_validation->run() === false) 
		{
            
			if(form_error('email')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('email'))
				], 400);
			}

		} else {
			$data = array(
				'email' => strip_tags($userData['email']),
				'created_at'   => date('Y-m-d H:i:s')
			);
			$result= $this->Mymodel->add('subscribe', $data);
			if(!empty($result)){
				$this->response([
					'status' => "0",
					'message' => "Your have subscribed successfully."
				], 200);
			}else{
				$this->response([
					'status' => "0",
					'error' => "Some error ocure.Please try again"
				], 400);
			}
		}
	}
	public function email_check($str){ 
        $con = array( 
            'returnType' => 'count', 
            'conditions' => array( 
                'email' => $str 
            ) 
        ); 
        $checkEmail = $this->Mymodel->UniqueEmail_subscribe($con); 
		if($checkEmail->num_rows() > 0){ 
            $this->form_validation->set_message('email_check', 'The given email already exists.'); 
            return FALSE; 
        }else{ 
            return TRUE; 
        } 
    }
	
	function contactUs_post(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['name'] = $this->post('name');
			$userData['phone'] = $this->post('phone');
			$userData['email'] = $this->post('email');
			$userData['subject'] = $this->post('subject');
			$userData['message'] = $this->post('message');
		}
		
		$this->form_validation->set_rules('name', 'name', 'required|trim');
		$this->form_validation->set_rules('phone', 'phone', 'required|trim|numeric');
		$this->form_validation->set_rules('subject', 'subject', 'required|trim');
		$this->form_validation->set_rules('message', 'message', 'required|trim');
		$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
		if ($this->form_validation->run() === false) 
		{
            if(form_error('name')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('name'))
				], 400);
			}
			if(form_error('phone')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('phone'))
				], 400);
			}
			if(form_error('subject')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('subject'))
				], 400);
			}
			if(form_error('message')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('message'))
				], 400);
			}
			if(form_error('email')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('email'))
				], 400);
			}

		} else {
			$data = array(
				'name' => strip_tags($userData['name']),
				'email' => strip_tags($userData['email']),
				'phone' => strip_tags($userData['phone']),
				'subject' => strip_tags($userData['subject']),
				'message' => strip_tags($userData['message']),
				'created_at'   => date('Y-m-d H:i:s')
			);
			$result= $this->Mymodel->add('contact', $data);
			
			if(!empty($result)){
				$this->response([
					'status' => "0",
					'message' => "Your contact query submited successfully.we will get back to soon"
				], 200);
			}else{
				$this->response([
					'status' => "0",
					'error' => "Some error ocure.Please try again"
				], 400);
			}
		}
	}
	
	
	function addofflinePay_post(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['eventId'] = $this->post('eventId');
			$userData['guestId'] = $this->post('guestId');
			$userData['transaction'] = $this->post('transaction');
			$userData['id'] = $this->post('id');
			$userData['amount'] = $this->post('amount');
		}
		
		$this->form_validation->set_rules('eventId', 'eventId', 'required|trim');
		$this->form_validation->set_rules('guestId', 'guestId', 'required|trim');
		$this->form_validation->set_rules('transaction', 'transaction', 'required|trim');
		$this->form_validation->set_rules('id', 'id', 'required|trim');
		$this->form_validation->set_rules('amount', 'amount', 'required|trim');
		
		if ($this->form_validation->run() === false) 
		{
            if(form_error('eventId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventId'))
				], 400);
			}
			if(form_error('guestId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('guestId'))
				], 400);
			}
			if(form_error('id')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('id'))
				], 400);
			}
			if(form_error('transaction')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('transaction'))
				], 400);
			}
			if(form_error('amount')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('amount'))
				], 400);
			}

		} else {
			$user_id = $userData['guestId'];
			$id = $userData['id'];
			$transaction = $userData['transaction'];
			$addamount = $userData['amount'];
			$event_id = $userData['eventId'];
			
			$get_user_count = $this->db->query("select id from users where id = ".@$user_id."")->num_rows();
			if($get_user_count > 0){
				$update_event_pay = $this->db->query("update event_invited_people set transaction = '".@$transaction."' where id = ".@$id." and event_id = ".@$event_id."");
				if($transaction == 'Paid'){
					if(!empty(@$update_event_pay)){
						
						$get_user = $this->db->query("select id, fname, lname, email, address, country, state, city, zipcode from users where id = ".@$user_id."")->row();
						
						$get_invited_people = $this->db->query("select distributed_event_price from event_invited_people where id = ".@$id." and event_id = ".@$event_id." ")->row();
						
						//print_r($addamount);die;
						if($addamount != ''){
							$amount = @$addamount;
						}else{
							$amount = @$get_invited_people->distributed_event_price;
						}
						
						//print_r($amount);die;
						$cardholder = @$get_user->fname .' '. @$get_user->lname;
						$user_id = @$user_id;
						$email =  @$get_user->email;
						$country =  @$get_user->country;
						$state =  @$get_user->state;
						$city =  @$get_user->city;
						$zipcode =  @$get_user->zipcode;
						$address = @$get_user->address;
						$currency = "USD";
						$orderID = "TEST_".$this->generate_otp(6);
						
						$tran_data = array(
							'user_name' => $cardholder, 'user_id' => $user_id, 'order_id' => $orderID, 'address' => $address, 'country' => $country, 'state' => $state, 'city' => $city, 'zipcode' => $zipcode, 'amount' => $amount, 'payment_type' => '2', 'status' => 'succeeded', 'currency' => 'usd', 'event_id' => $event_id, 'paid_by_admin' => '2', 'created_at' => date('Y-m-d H:i:s')
						);
						$result= $this->Mymodel->add('transaction', $tran_data);
						if(!empty($result)){
							$this->response([
								'status' => "1",
								'message' => "You have successfully added a payment for this user."
							], 200);
						}else{
							$this->response([
								'status' => "1",
								'error' => "some error occure.please try again."
							], 400);
						}
						
					}
				}else{
					if(!empty(@$update_event_pay)){
						$delete_tran = $this->db->query("delete from transaction where user_id = ".@$user_id." and event_id = ".@$event_id." and payment_type = '2' and paid_by_admin = '2'");
						
						if(!empty($delete_tran)){
							$this->response([
								'status' => "1",
								'message' => "transaction deleted successfully."
							], 200);
						}else{
							$this->response([
								'status' => "1",
								'error' => "some error occure.please try again."
							], 400);
						}
					}
				}
			}else{
				$this->response([
					'status' => "0",
					'error' => "user not register yet."
				], 400);
			}
			
		}
	}
	
	function composeMail_post(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			
			$userData['subject'] = $this->post('subject');
			$userData['body'] = $this->post('body');
			$userData['eventId'] = $this->post('eventId');
			$userData['type'] = $this->post('type');
			$userData['guestEmail'] = $this->post('guestEmail');
			$userData['userId'] = $this->post('userId');
		}
		
		$this->form_validation->set_rules('userId', 'userId', 'required|trim');
		$this->form_validation->set_rules('subject', 'subject', 'required|trim');
		$this->form_validation->set_rules('body', 'body', 'required|trim');
		$this->form_validation->set_rules('eventId', 'eventId', 'required|trim');
		$this->form_validation->set_rules('type', 'type', 'required|trim');

		
		if ($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
			
            if(form_error('subject')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('subject'))
				], 400);
			}
			if(form_error('body')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('body'))
				], 400);
			}
			if(form_error('eventId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventId'))
				], 400);
			}
			if(form_error('type')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('type'))
				], 400);
			}
			

		} else {
			
			if($_FILES['attachment']['name'] != '') {
				$src = $_FILES['attachment']['tmp_name'];
				$filEnc = time();
				$avatar ='mail'.'_'.rand(11111, 99999)."_".$_FILES['attachment']['name'];
				$avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
				$dest = getcwd() . '/uploads/email/' . $avatar1;
				if (move_uploaded_file($src, $dest)) {
					$attachment  = $avatar1;
				}
			} else {
				$attachment ='';
			}
			//print_r($userData['guestEmail']);die;
			if($userData['type'] == 'sent'){
				
				$to=[];
			   
				foreach ($userData['guestEmail'] as $value){
					$to[] = $value;
				}
				//print_r($to);die;
				$recipients = implode(',', $to);
				$email_data = array('body' => @$userData['body'], 'attachment' => @$attachment);
				$msg = $this->load->view('account/email_management/email_template',$email_data,TRUE);
				$result = $this->Mymodel->mail_send_management('info@madetosplit.com', 'info@madetosplit.com', $to, $msg, @$userData['subject'], 'info@madetosplit.com', 'M@d32spl1t'); 
				
				if(!empty($result)){
					
					$data = array('subject' => @$userData['subject'], 'body' => @$userData['body'], 'event_id' => @$userData['eventId'], 'attachment' => $attachment, 'user_id' => @$userData['userId'], 'type' => 'send', 'status' => '1', 'created_date' => date('Y-m-d H:i:s'), 'recipients' => $recipients);
					
					$this->Mymodel->add('compose_email', $data);
					
					// $this->session->set_flashdata('msg', 'Sent successfully !!');
				    // redirect(base_url('mailer/list_send_mail'));
					$this->response([
						'status' => "1",
						'message' => "Sent successfully!"
					], 200);
				}else{
					$this->response([
						'status' => "0",
						'error' => "some error occure.please try again.!"
					], 400);
				}
			}else{
				$to=[];
			   
				foreach ($userData['guestEmail'] as $value){
					$to[] = $value;
				}
				$recipients = implode(',', $to);
				
				$data = array('subject' => @$userData['subject'], 'body' => @$userData['body'], 'event_id' => @$userData['eventId'], 'attachment' => $attachment, 'user_id' => @$userData['userId'], 'type' => 'draft', 'status' => '1', 'created_date' => date('Y-m-d H:i:s'), 'recipients' => $recipients);
				
				
				$result = $this->Mymodel->add('compose_email', $data);
				if(!empty($result)){
					$this->response([
						'status' => "1",
						'message' => "Save successfully!"
					], 200);
				}else{
					$this->response([
						'status' => "0",
						'error' => "some error occure.please try again.!"
					], 400);
				}
			}
		}
	}
	
	function useTemplateList_get(){
		if(!empty($_GET['userId'])){
			$userId = $_GET['userId'];
			$list = $this->Mymodel->get_multiple_row_info('*', 'email_template', 'user_id = '.$userId.'', 'id DESC', '');
			if(!empty($list)) 
			{
				foreach ($list as $k => $v)
				{
					if(!empty($v->attachment) && file_exists('uploads/email/'.$v->attachment.'')){
						$attachment = base_url('uploads/email/'.$v->attachment.'');
					}else{
						$attachment = '';
					}
					
					$array[] = [
						'id' => @$v->id,
						'subject' => @$v->subject,
						'attachment' => $attachment

					];				
				}

				$array = $this->arrcheck($array);

				$this->response([
					'status'=>"1",
					'list'=>$array,

				], 200);
			} else {
				$array = [];
				$this->response([
					'status' => "0",
					'error' => 'No list found.',
					'list'=>$array,
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'userId is required.'
			], 400);
		}
        
	}
	
	function useTemplateDetails_get(){
		if(!empty(@$_GET['useTemplateId'])){
			$useTemplate = $this->db->query("select * from email_template where id = '".@$_GET['useTemplateId']."'")->row();
			if(!empty($useTemplate)){
				
				if(!empty($useTemplate->attachment) && file_exists('uploads/email/'.$useTemplate->attachment.'')){
					$attachment = base_url('uploads/email/'.$useTemplate->attachment.'');
				}else{
					$attachment = '';
				}
				
				$array = [
					'useTemplateId' => $useTemplate->id,
					'subject' => $useTemplate->subject,
					'body' => $useTemplate->body,
					'attachment' => $attachment,
				];
				
				$array = $this->arrcheck($array);

				$this->response([
					'status'=>"1",
					'details'=>$array,

				], 200);
				
			}else{
				$this->response([
					'status' => "0",
					'error' => 'No data found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'useTemplateId is required.'
			], 400);
		}
	}
	
	function sendUseMail_post(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			
			$userData['subject'] = $this->post('subject');
			$userData['body'] = $this->post('body');
			$userData['eventId'] = $this->post('eventId');
			$userData['type'] = $this->post('type');
			$userData['guestEmail'] = $this->post('guestEmail');
			$userData['userId'] = $this->post('userId');
			$userData['templateId'] = $this->post('templateId');
		}
		
		$this->form_validation->set_rules('userId', 'userId', 'required|trim'); 
		$this->form_validation->set_rules('subject', 'subject', 'required|trim');
		$this->form_validation->set_rules('body', 'body', 'required|trim');
		$this->form_validation->set_rules('eventId', 'eventId', 'required|trim');
		$this->form_validation->set_rules('type', 'type', 'required|trim');
		$this->form_validation->set_rules('templateId', 'templateId', 'required|trim');

		
		if ($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
			
            if(form_error('subject')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('subject'))
				], 400);
			}
			if(form_error('body')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('body'))
				], 400);
			}
			if(form_error('eventId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventId'))
				], 400);
			}
			if(form_error('type')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('type'))
				], 400);
			}
			
			if(form_error('templateId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('templateId'))
				], 400);
			}
			

		} else {
			
			if($_FILES['attachment']['name'] != '') {
				$src = $_FILES['attachment']['tmp_name'];
				$filEnc = time();
				$avatar ='mail'.'_'.rand(11111, 99999)."_".$_FILES['attachment']['name'];
				$avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
				$dest = getcwd() . '/uploads/email/' . $avatar1;
				if (move_uploaded_file($src, $dest)) {
					$attachment  = $avatar1;
				}
			} else {
				$email_attach = $this->Mymodel->get_single_row_info('attachment', 'email_template', 'id = '.@$userData['templateId'].'', '', 1);
				if(!empty(@$email_attach)){
					$attachment = $email_attach->attachment;
				}else{
					$attachment = '';
				}
				//$attachment ='';
			}
			//print_r($userData['guestEmail']);die;
			if($userData['type'] == 'sent'){
				
				$to=[];
			   
				foreach ($userData['guestEmail'] as $value){
					$to[] = $value;
				}
				//print_r($to);die;
				$recipients = implode(',', $to);
				$email_data = array('body' => @$userData['body'], 'attachment' => @$attachment);
				$msg = $this->load->view('account/email_management/email_template',$email_data,TRUE);
				$result = $this->Mymodel->mail_send_management('info@madetosplit.com', 'info@madetosplit.com', $to, $msg, @$userData['subject'], 'info@madetosplit.com', 'M@d32spl1t'); 
				
				if(!empty($result)){
					
					$data = array('subject' => @$userData['subject'], 'body' => @$userData['body'], 'event_id' => @$userData['eventId'], 'attachment' => $attachment, 'user_id' => @$userData['userId'], 'type' => 'send', 'status' => '1', 'created_date' => date('Y-m-d H:i:s'), 'recipients' => $recipients);
					$this->Mymodel->add('compose_email', $data);
					//$this->Mymodel->update('email_template', $data);
					//$this->Mymodel->update($data, 'email_template', array('id' => @$userData['templateId']));
					// $this->session->set_flashdata('msg', 'Sent successfully !!');
				    // redirect(base_url('mailer/list_send_mail'));
					$this->response([
						'status' => "1",
						'message' => "Sent successfully!"
					], 200);
				}else{
					$this->response([
						'status' => "0",
						'error' => "some error occure.please try again.!"
					], 400);
				}
			}else{
				$to=[];
			   
				foreach ($userData['guestEmail'] as $value){
					$to[] = $value;
				}
				$recipients = implode(',', $to);
				
				$data = array('subject' => @$userData['subject'], 'body' => @$userData['body'], 'event_id' => @$userData['eventId'], 'attachment' => $attachment, 'user_id' => @$userData['userId'], 'type' => 'draft', 'status' => '1', 'created_date' => date('Y-m-d H:i:s'), 'recipients' => $recipients);
				
				//$result = $this->Mymodel->update($data, 'email_template', array('id' => @$userData['templateId']));
				$result = $this->Mymodel->add('compose_email', $data);
				if(!empty($result)){
					$this->response([
						'status' => "1",
						'message' => "Save successfully!"
					], 200);
				}else{
					$this->response([
						'status' => "0",
						'error' => "some error occure.please try again.!"
					], 400);
				}
			}
		}
	}
	
	function sendList_get(){
		if(!empty(@$_GET['userId'])){
			$userId = @$_GET['userId'];
			$list = $this->Mymodel->get_multiple_row_info('*', 'compose_email', 'type = "send" and user_id = '.$userId.'', 'id DESC', '');
			if(!empty($list)){
				foreach($list as $k => $v){
					
					if(empty(@$v->created_date) || @$v->created_date == '0000-00-00 00:00:00'){
						$date = '';
					} else{
						$date = @$v->created_date;
					}
					
					if(!empty($v->recipients)){
						$recipients = $v->recipients;
						
					}
						
					$array[] = [
					    'id' => @$v->id,
					    'subject' => @$v->subject,
					    'recipients' => [@$recipients],
						 'date' => @$date,
					];
				}
				$array = $this->arrcheck($array);

				$this->response([
					'status'=>"1",
					'list'=>$array,
				], 200);
			}else{
				$array = [];
				$this->response([
					'status' => "0",
					'error' => "No list found.",
					'list' => $array
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => "userId is required."
			], 400);
		}
		
	}
	
	function deleteSendList_get(){
		if(!empty(@$_GET['sendTemplateId'])){
			$delete = $this->db->query("delete from compose_email where id = ".@$_GET['sendTemplateId']."");
			if(!empty(@$delete)){
				$this->response([
					'status' => "1",
					'message' => "send template deleted successfully."
				], 400);
			}else{
				$this->response([
					'status' => "0",
					'error' => "Some error occured, Please try again."
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => "sendTemplateId is required."
			], 400);
		}
	}
	
	function editDraft_post(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			
			$userData['subject'] = $this->post('subject');
			$userData['body'] = $this->post('body');
			$userData['eventId'] = $this->post('eventId');
			$userData['type'] = $this->post('type');
			$userData['guestEmail'] = $this->post('guestEmail');
			$userData['userId'] = $this->post('userId');
			$userData['templateId'] = $this->post('templateId');
		}
		
		$this->form_validation->set_rules('userId', 'userId', 'required|trim'); 
		$this->form_validation->set_rules('subject', 'subject', 'required|trim');
		$this->form_validation->set_rules('body', 'body', 'required|trim');
		$this->form_validation->set_rules('eventId', 'eventId', 'required|trim');
		$this->form_validation->set_rules('type', 'type', 'required|trim');
		$this->form_validation->set_rules('templateId', 'templateId', 'required|trim');

		
		if ($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
			
            if(form_error('subject')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('subject'))
				], 400);
			}
			if(form_error('body')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('body'))
				], 400);
			}
			if(form_error('eventId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('eventId'))
				], 400);
			}
			if(form_error('type')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('type'))
				], 400);
			}
			
			if(form_error('templateId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('templateId'))
				], 400);
			}
			

		} else {
			
			if($_FILES['attachment']['name'] != '') {
				$src = $_FILES['attachment']['tmp_name'];
				$filEnc = time();
				$avatar ='mail'.'_'.rand(11111, 99999)."_".$_FILES['attachment']['name'];
				$avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
				$dest = getcwd() . '/uploads/email/' . $avatar1;
				if (move_uploaded_file($src, $dest)) {
					$attachment  = $avatar1;
				}
			} else {
				$email_attach = $this->Mymodel->get_single_row_info('attachment', 'email_template', 'id = '.@$userData['templateId'].'', '', 1);
				if(!empty(@$email_attach)){
					$attachment = $email_attach->attachment;
				}else{
					$attachment = '';
				}
				//$attachment ='';
			}
			//print_r($userData['guestEmail']);die;
			if($userData['type'] == 'sent'){
				
				$to=[];
			   
				foreach ($userData['guestEmail'] as $value){
					$to[] = $value;
				}
				//print_r($to);die;
				$recipients = implode(',', $to);
				$email_data = array('body' => @$userData['body'], 'attachment' => @$attachment);
				$msg = $this->load->view('account/email_management/email_template',$email_data,TRUE);
				$result = $this->Mymodel->mail_send_management('info@madetosplit.com', 'info@madetosplit.com', $to, $msg, @$userData['subject'], 'info@madetosplit.com', 'M@d32spl1t'); 
				
				if(!empty($result)){
					
					$data = array('subject' => @$userData['subject'], 'body' => @$userData['body'], 'event_id' => @$userData['eventId'], 'attachment' => $attachment, 'user_id' => @$userData['userId'], 'type' => 'send', 'status' => '1', 'created_date' => date('Y-m-d H:i:s'), 'recipients' => $recipients);
					$this->Mymodel->add('compose_email', $data);
					//$this->Mymodel->update('email_template', $data);
					//$this->Mymodel->update($data, 'email_template', array('id' => @$userData['templateId']));
					// $this->session->set_flashdata('msg', 'Sent successfully !!');
				    // redirect(base_url('mailer/list_send_mail'));
					$this->response([
						'status' => "1",
						'message' => "Sent successfully!"
					], 200);
				}else{
					$this->response([
						'status' => "0",
						'error' => "some error occure.please try again.!"
					], 400);
				}
			}else{
				$to=[];
			   
				foreach ($userData['guestEmail'] as $value){
					$to[] = $value;
				}
				$recipients = implode(',', $to);
				
				$data = array('subject' => @$userData['subject'], 'body' => @$userData['body'], 'event_id' => @$userData['eventId'], 'attachment' => $attachment, 'user_id' => @$userData['userId'], 'type' => 'draft', 'status' => '1', 'created_date' => date('Y-m-d H:i:s'), 'recipients' => $recipients);
				
				//$result = $this->Mymodel->update($data, 'email_template', array('id' => @$userData['templateId']));
				$result = $this->Mymodel->add('compose_email', $data);
				if(!empty($result)){
					$this->response([
						'status' => "1",
						'message' => "Save successfully!"
					], 200);
				}else{
					$this->response([
						'status' => "0",
						'error' => "some error occure.please try again.!"
					], 400);
				}
			}
		}
	}
	
    function stripeConnect_post(){
		
		//require_once(APPPATH.'libraries/stripe-php/init.php');
		require_once APPPATH.'third_party/stripe/vendor/autoload.php';
		$json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        if (is_array($obj))
        {
            $_POST = (array) $obj;
            $userData = $_POST;
        } else {
            $userData['userId'] = $this->post('userId');
        }
		
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
        
        if ($this->form_validation->run() === false)
        {
            if(form_error('userId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('userId'))
                ], 400);
            }
        }else{
			$userId = $userData['userId'];
			$userInfo = $this->Apimodel->get_cond('users', "id=".$userId."");
			//echo STRIPE_API_KEY;die;
			if(!empty($userInfo))
            {
				
				$stripe = new \Stripe\StripeClient('sk_test_51MPhgSIuZrwn6gWgucZ3pq3OGKnLaQMxviXsKtZb4F7tenDBs25KovJkAB4tii3db6CMW1tdWSk2CB9thQ8yOYdX00iUs05KRN');
				
				try {  
					$account = $stripe->accounts->create(
						[
							'country' => 'US',
							'type' => 'express',
							'email' => ''.@$userInfo->email.'',
							'capabilities' => [
								'card_payments' => ['requested' => true],
								'transfers' => ['requested' => true],
							],
						]
					);
					
					$stripe_acc_id = $account['id'];
				
					$link = $stripe->accountLinks->create(
						[
							'account' => $stripe_acc_id,
							'refresh_url' => base_url('payment/stripeReturn?userId='.$userId.''),
							'return_url' => base_url('payment/stripeReturn?userId='.$userId.''),
							'type' => 'account_onboarding',
						]
					);
					
				} catch(Exception $e) {  
					$api_error = $e->getMessage();  
				} 
					
				//echo $api_error;die;
			    if(empty($api_error)){
					
					
					$mydata = array(
						'user_id' => $userId,
						'stripe_acc_id' => $stripe_acc_id,
						'expires_at' => $link['expires_at'],
						'url' => $link['url']
					);
					$result = $this->Apimodel->update_data('stripe_connected_acc', '*', 'user_id = '.$userId.'', $mydata);
					//echo $result;die;
					if(!empty($result)){
						
						$this->response([ 
							'status'=>"1", 
							'stripeUrl' => $link['url'],
							'returnUrl' => base_url('payment/stripeReturn?userId='.$userId.''),
						], 200);
						
					}else{
						$this->response([
							'status'=>"0",
							'error' => 'Something went wrong!',
						], 200);
					}
				}else{
					$this->response([
						'status'=>"0",
						'error' => $api_error,
					], 200);
				}
				
			
			}else{
				$this->response([
                    'status' => "0",
                    'error' => 'User not found.'
                ], 400);
			}
		}
	}
	
	function userStripeInfo_post(){
		require_once APPPATH.'third_party/stripe/vendor/autoload.php';
		$json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        if (is_array($obj))
        {
            $_POST = (array) $obj;
            $userData = $_POST;
        } else {
            $userData['userId'] = $this->post('userId');
        }
		
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
        
        if ($this->form_validation->run() === false)
        {
            if(form_error('userId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('userId'))
                ], 400);
            }
        }else{
			$userId = $userData['userId'];
			$userInfo = $this->Apimodel->get_cond('users', "id=".$userId."");
			//echo STRIPE_API_KEY;die;
			if(!empty($userInfo))
            {
				$guideInfo = $this->Apimodel->get_cond('stripe_connected_acc', "user_id='".$userId."'");
				if($guideInfo){
					$stripeAccId = $guideInfo->stripe_acc_id;
					$stripeStatus = $this->get_stripe_info($stripeAccId);
					if($stripeStatus == 1){
						
						$url = 'https://api.stripe.com/v1/accounts/'.@$stripeAccId.'';
						$skey = 'sk_test_51MPhgSIuZrwn6gWgucZ3pq3OGKnLaQMxviXsKtZb4F7tenDBs25KovJkAB4tii3db6CMW1tdWSk2CB9thQ8yOYdX00iUs05KRN';
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, "".$url."");
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_request_body));
						curl_setopt($ch, CURLOPT_POST, 1);
						$headers = array();
						$headers[] = "Content-Type: application/x-www-form-urlencoded";
						$headers[] = "Authorization: Bearer ".$skey."";
						//$headers[] = "client_secret: ".STRIPE_SECRET_KEY."";
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						$result = curl_exec($ch);
						//print_r($result);
						$get_data = json_decode($result);
						$arr= array(
							'stripeId' => @$get_data->id,
							'name' => @$get_data->business_profile->name,
							'phone' => @$get_data->business_profile->support_phone,
							'email' => @$get_data->email,
							'website' => @$get_data->business_profile->url,
							'capabilities' => [
							    'card_payments' => @$get_data->capabilities->card_payments,
							    'transfers' => @$get_data->capabilities->transfers
							],
							'charges_enabled' => @$get_data->charges_enabled,
							'country' => @$get_data->country,
							'created' => @$get_data->created,
							'default_currency' => @$get_data->default_currency,
							'external_accounts' => [
							    'brand' => @$get_data->external_accounts->data[0]->brand,
							    'country' => @$get_data->external_accounts->data[0]->country,
							    'cvc_check' => @$get_data->external_accounts->data[0]->cvc_check,
							    'cvc_check' => @$get_data->external_accounts->data[0]->cvc_check,
							    'exp_month' => @$get_data->external_accounts->data[0]->exp_month,
							    'exp_year' => @$get_data->external_accounts->data[0]->exp_year,
							    'last4' => @$get_data->external_accounts->data[0]->last4,
							    'fingerprint' => @$get_data->external_accounts->data[0]->fingerprint,
							    'funding' => @$get_data->external_accounts->data[0]->funding,
							],
							'payouts_enabled' => @$get_data->payouts_enabled,
							'type' => @$get_data->type,
						);
						$arr = $this->arrcheck($arr);
						$this->response([
							'status'=>"1",
							'stripeInfo'=>$arr
						], 200);
					
					}else{
						$this->response([
							'status' => "0",
							'error' => 'stripe not connected..'
						], 400);
					}
				}else{
					$this->response([
						'status' => "0",
						'error' => 'stripe not found.'
					], 400);
				}
			}else{
				$this->response([
                    'status' => "0",
                    'error' => 'User not found.'
                ], 400);
			}
		}
	}
	
	function get_stripe_info($stripe_acc_id = ''){
		$url = 'https://api.stripe.com/v1/accounts/'.@$stripe_acc_id.'';
		$skey = 'sk_test_51MPhgSIuZrwn6gWgucZ3pq3OGKnLaQMxviXsKtZb4F7tenDBs25KovJkAB4tii3db6CMW1tdWSk2CB9thQ8yOYdX00iUs05KRN';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "".$url."");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_request_body));
		curl_setopt($ch, CURLOPT_POST, 1);
		$headers = array();
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Authorization: Bearer ".$skey."";
		//$headers[] = "client_secret: ".STRIPE_SECRET_KEY."";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		//print_r($result);
		$get_data = json_decode($result);
		if(!empty($get_data->payouts_enabled) AND !empty($get_data->charges_enabled) AND $get_data->payouts_enabled == 1 AND $get_data->charges_enabled == 1){
			$status = '1';
		}else{
			$status = '0';
		}
		return $status;
	}

	function sendMail($email = '', $event_name = '', $from = '', $amount = '', $subject = '', $date = ''){
		require_once APPPATH.'third_party/email/vendor/autoload.php';
		$from_email = "info@madetosplit.com"; 
		$imagePath = base_url() . 'uploads/logos/logo.png';
		$imagebackPath = '';
		$mesg = "<!Doctype html>
		<html>
			<head>
				<meta charset='utf-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1'>
				<title>Invite People</title>
				<link href='https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap' rel='stylesheet'>
				</head>
			<body>
				<div style='max-width:600px;
				margin:auto;
				border:1px solid #eee;
				box-shadow:0 0 10px rgba(0, 0, 0, .15);
				line-height:17px;
				font-size:13px;
				box-sizing:border-box; -webkit-print-color-adjust: exact;font-family: Poppins, sans-serif; background:url(".$imagebackPath.")'>
					<div style='padding:20px; box-sizing: border-box;text-align: center; background: #fff;'>
					    <a href='#'><img src='".$imagePath."' style='width: 350px; height80px;'></a>
					</div>
					<div style='width: 400px; margin:50px auto;background: #ffffffd1;padding: 50px;text-align: center;'>
						<h1 style='font-size: 30px; line-height: 32px; color: #0b0b0b; margin: 30px 0;'>Dear User</h1>
						<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'>You have invited for <strong>".$event_name."</strong> event from <strong>".@$from." </strong></p>
						
						<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'>Event date : <strong>".$date."</strong></p>
						
						<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'>Event Price <strong>$".$amount."</strong>/Person</p>
						<a href='".base_url('login')."' >Register</a>
					</div>
					
					<div style='background: #000;
					text-align: left;
					box-sizing: border-box;
					width: 100%;
					padding: 20px 50px;
					color: #fff;'>
						<p style='margin: 5px 0;font-size: 12px;'>Warm Regards,</p>
						<p style='margin: 5px 0;font-size: 12px;'>Made to Split</p>
						<p style='margin: 5px 0;font-size: 12px;'><strong>Email:</strong> <a href='#' style='color: #78daff;'>info@madetosplit.com</a></p>
						<br/>
						<p style='margin: 5px 0;font-size: 11px;'>This is an automated response, please do not reply.</p>
					</div>
				</div>
			</body>
		</html>";

		$mail = new PHPMailer();
		$mail->SMTPDebug = 0;                               // Enable verbose debug output
		$mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
		$mail->IsSMTP();
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'info@madetosplit.com';                
		$mail->Password = 'M@d32spl1t';
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to
		$mail->setFrom('info@madetosplit.com');
		$mail->addAddress($email);
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = @$subject;
		$mail->Body    = $mesg;
		return $mail->send();
	}
	
	
	
	function paypalConnect_post(){
		
		//require_once(APPPATH.'libraries/stripe-php/init.php');
		require_once APPPATH.'third_party/stripe/vendor/autoload.php';
		$json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        if (is_array($obj))
        {
            $_POST = (array) $obj;
            $userData = $_POST;
        } else {
            $userData['userId'] = $this->post('userId');
        }
		
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
        
        if ($this->form_validation->run() === false)
        {
            if(form_error('userId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('userId'))
                ], 400);
            }
        }else{
			$userId = $userData['userId'];
			$userInfo = $this->Apimodel->get_cond('users', "id=".$userId."");
			//echo STRIPE_API_KEY;die;
			if(!empty($userInfo))
            {
				
				$return_url = base_url('paypalReturn');
				$client_id = 'AaGztJn1WXb-6YV20wy2ccDOg5rl8561u-ype_05_o2rMqmwAxpw2Pt5U_Jp9Oh7XGOQVhrkVeNLGOGh';
				//$this->session->set_userdata('userid_paypal_connect', $userData['userId']);
				//$_SESSION['userid_paypal_connect'] = $userData['userId'];
				
				//echo $this->session->userdata('userid_paypal_connect');die;
				//setcookie('userid_paypal_connect', $userData['userId']); // 86400 = 1 day

				$url ='https://www.sandbox.paypal.com/connect/?flowEntry=static&client_id='.$client_id.'&scope=email&redirect_uri='.$return_url.'&state='.$userId.'';
				$this->response([ 
					'status'=>"1", 
					'paypalUrl' => $url,
				], 200);
			}else{
				$this->response([
                    'status' => "0",
                    'error' => 'User not found.'
                ], 400);
			}
		}
	}
	
	function paypalReturn_get(){
	    //echo $_COOKIE['userid_paypal_connect'];die;
	   //$userId = $this->session->userdata('userid_paypal_connect');
		if(!empty(@$_GET['code']) AND $_GET['scope'] == 'email'){
			$code =  @$_GET['code'];
			$scope = @$_GET['scope'];
			$userId = @$_GET['state'];
			$client_id = 'AaGztJn1WXb-6YV20wy2ccDOg5rl8561u-ype_05_o2rMqmwAxpw2Pt5U_Jp9Oh7XGOQVhrkVeNLGOGh';
		    $secrete_id = 'EN796nVhXcmAZXL7yfDKugynBrrXoTTYIAfPL-R4yM-7yMcsPf0WWYj1JN0NPd7V4L60uNBwHg9vlCL9';
			$token = $this->get_access_token($client_id, $secrete_id, $code);
			$data = json_decode($token,true);
		
			if(!empty($data['access_token'])){
				
				
				$access_token =  $data['access_token'];
				$host_identity = $this->event_host_identity($access_token);
				$data = json_decode($host_identity,true);
				
				$store = array('email' => $data['email'], 'user_id' => $userId, 'email_verified' => $data['email_verified'], 'verified' => $data['verified'], 'created_at' => date('Y-m-d H:i:s'), 'status' => '1');
			    $result = $this->Mymodel->update_data('paypal_payout_verified_email', '*', 'user_id = '.$userId.'', $store);
				if(!empty($result)){
					
					//$this->session->set_flashdata('paypal_login_success', 'Your PayPal login has been successfully completed. We will make the event payment based on your PayPal email.');
					//redirect(base_url('event/details?eId='.base64_encode($this->session->userdata('for_paypal_eventid')).''));
					
					$statusMsg = 'Your PayPal login has been successfully completed. We will make the event payment based on your PayPal email.';
					$status = 'success';
					$verifiedEmail = $data['email'];
					redirect(base_url("paypalConnectStatus?statusMsg=".$statusMsg."&status=".$status."&verifiedEmail=".$verifiedEmail."&userId=".$userId.""),'refresh'); 
				}
			}else{
				//$userId = $this->session->userdata('userid_paypal_connect');
				$statusMsg = 'access token is expired. please try go back on event details page and try again.';
				$status = 'fail';
				$verifiedEmail = '';
				redirect(base_url("paypalConnectStatus?statusMsg=".$statusMsg."&status=".$status."&verifiedEmail=".$verifiedEmail."&userId=".$userId.""),'refresh'); 
					
				//echo 'access token is expired. please try go back on event details page and try again.';
			}
			
		}else{
			$userId = @$_GET['state'];
			//$userId = $this->session->userdata('userid_paypal_connect');
			$statusMsg = 'Some error occured, Please try again.';
			$status = 'fail';
			$verifiedEmail = '';
			redirect(base_url("paypalConnectStatus?statusMsg=".$statusMsg."&status=".$status."&verifiedEmail=".$verifiedEmail."&userId=".$userId.""),'refresh'); 
		}
	}
	
	function event_host_identity($access_token = ''){
		$authorizationString = $access_token;
		$curl = curl_init();

		$data = array(
		CURLOPT_URL => "https://api-m.sandbox.paypal.com/v1/identity/openidconnect/userinfo?schema=openid",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_SSL_VERIFYPEER => false,

		CURLOPT_HTTPHEADER => array(
		"Authorization: Bearer ".$authorizationString,
		'Content-Type:application/x-www-form-urlencoded'
		)
		);
		curl_setopt_array($curl, $data);
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
	function get_access_token($client_id = '', $secret_id = '', $code = ''){
		
		if(!empty($client_id) AND !empty($secret_id)){
			$authorizationString = base64_encode($client_id . ':' . $secret_id);
		}else{
			$authorizationString = '';
		}
		
		$curl = curl_init();
		$data = array(
		CURLOPT_URL => "https://api-m.sandbox.paypal.com/v1/oauth2/token",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_POSTFIELDS => http_build_query(array(
		'grant_type'=>'authorization_code',
		'code'=> $code,
		)),
		CURLOPT_HTTPHEADER => array(
		"Authorization: Basic ".$authorizationString,
		)
		//CURLOPT_USERPWD => $base_token
		);
		curl_setopt_array($curl, $data);
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
	function paypalConnectStatus_get(){
		echo "<br>".@$_GET['statusMsg']."<br>";
        echo "Status : "."<br>".@$_GET['status']."<br>";
        echo "verifiedEmail : "."<br>".@$_GET['verifiedEmail']."<br>";
        echo "UserId :"."<br>".@$_GET['userId'];
	}
	
	
	function deleteAccount_get(){
		if(!empty(@$_GET['userId'])){
			$userId = @$_GET['userId'];
			$userInfo = $this->Apimodel->get_cond('users', "id=".$userId."");
			//echo STRIPE_API_KEY;die;
			if(!empty($userInfo))
            {
				$delete = $this->db->query("delete from users where id = '".$userId."'");
				if($delete){
					
					if(!empty($userInfo->image) && file_exists('uploads/profile/'.$userInfo->image.'')){
						$path = base_url('uploads/profile/'.$userInfo->image.'');
						unlink($path);
					}
					
					$userevent = $this->db->query("select * from event where user_id = '".$userId."'")->result();
					if(!empty($userevent)){
						foreach($userevent as $k => $v){
							$delete_event = $this->db->query("delete from event where user_id = '".$v->user_id."'");
							
						}
					}
					
					
					$this->response([
						'status' => "1",
						'message' => 'user deleted successfully.'
					], 200);
					
				}else{
					$this->response([
						'status' => "0",
						'error' => 'Some error occured, Please try again.'
					], 400);
				}
			}else{
				$this->response([
					'status' => "0",
					'error' => 'user not found.'
				], 400);
			}
		}else{
			$this->response([
				'status' => "0",
				'error' => 'userId is required.'
			], 400);
		}
	}
	
	function chatUser_post(){

		$json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        if (is_array($obj))
        {
            $_POST = (array) $obj;
            $userData = $_POST;
        } else {
            $userData['userId'] = $this->post('userId');
            $userData['eventId'] = $this->post('eventId');
        }
		
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('eventId', 'eventId', 'trim|required');
        
        if ($this->form_validation->run() === false)
        {
            if(form_error('userId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('userId'))
                ], 400);
            }
			
			if(form_error('eventId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('eventId'))
                ], 400);
            }
        }else{
			$userId = $userData['userId'];
			$eventId = $userData['eventId'];
			$user_email = $this->Mymodel->get_single_row_info('email', 'users', 'id='.$userId.'', '', 1);
			$getHost = $this->db->query("select user_id from event where event_id = '".$eventId."'")->row();
			$hostId = $getHost->user_id;
			$host_email = $this->Mymodel->get_single_row_info('email', 'users', 'id='.$hostId.'', '', 1);
			
			$get_invited_people = $this->db->query("select * from event_invited_people where event_id = ".@$eventId." and user_id = ".@$hostId." and email != '".@$user_email->email."'")->result();
			
			$check_event = $this->db->query("select * from event where event_id = ".$eventId." and user_id = ".$userId."")->num_rows();
			
			
			if(@$check_event > 0){
				
			}else{
				$check_email_inevent = 	$this->db->query("select * from event_invited_people where event_id = ".@$eventId." and email = '".@$host_email->email."'")->num_rows();
				if(@$check_email_inevent > 0){

				}else{			
					$get_invited_people[] =   (object)['id' => 0,
						'email' => @$host_email->email,
						'event_id' => '',
						'distributed_event_price'=>'',
						'user_id' => '',
						'status' => '',
						'transaction' => '',
						'created_at' => '',
						'updated_at' => ''
					];
				}
			}
			
			$get_co_host = $this->Mymodel->get_single_row_info('co_host_id', 'event', 'event_id='.@$eventId.'', '', 1);
			if(!empty(@$get_co_host->co_host_id)){
				if(@$userId == @$get_co_host->co_host_id){
				
			    }else{
					$co_host_email = $this->Mymodel->get_single_row_info('email', 'users', 'id='.@$get_co_host->co_host_id.'', '', 1);
					$check_cohost_invited = $this->db->query("select * from event_invited_people where event_id = ".@$eventId." and email = '".@$co_host_email->email."'")->num_rows();
					
					if(@$check_cohost_invited > 0){
						
					}else{
						$get_invited_people[] =   (object)['id' => 0,
							'email' => @$co_host_email->email,
							'event_id' => '',
							'distributed_event_price'=>'',
							'user_id' => '',
							'status' => '',
							'transaction' => '',
							'created_at' => '',
							'updated_at' => ''
						];
					}
				}
			}
			    if(!empty($get_invited_people)){
					foreach($get_invited_people as $k => $v){
						$get_register_user = $this->db->query("select id, fname, lname, email, image from users where (email = '".$v->email."' )  and status = '1'")->row();
						if(!empty(@$get_register_user)){
							$image = (!empty(@$get_register_user->image) ? base_url('uploads/profile/'.@$get_register_user->image.'') : base_url('uploads/unnamed.jpg'));
							$userName = @$get_register_user->fname.' '.@$get_register_user->lname;
							
							$arr[] = [
								'userId' => $get_register_user->id,
								'userName' => $userName,
								'email' => $get_register_user->email,
								'profilePic' => $image,
							];
						}
					}
					$arr = $this->arrcheck($arr);
					$this->response([
					'status'=>"1",
					'list'=>$arr
					], 200);
				}else{
					$arr = [];
					$this->response([
						'status'=>"0",
						'list'=>$arr,
						'error'=>'user not found.'
					], 400);
				}
		}
	}
	
	function userchats_post(){
		$json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        if (is_array($obj))
        {
            $_POST = (array) $obj;
            $userData = $_POST;
        } else {
            $userData['senderId'] = $this->post('senderId');
            $userData['receiverId'] = $this->post('receiverId');
            $userData['eventId'] = $this->post('eventId');
        }
		
		$this->form_validation->set_rules('senderId', 'senderId', 'trim|required');
		$this->form_validation->set_rules('receiverId', 'receiverId', 'trim|required');
		$this->form_validation->set_rules('eventId', 'eventId', 'trim|required');
        
        if ($this->form_validation->run() === false)
        {
            if(form_error('senderId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('senderId'))
                ], 400);
            }
			
			if(form_error('receiverId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('receiverId'))
                ], 400);
            }
			
			if(form_error('eventId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('eventId'))
                ], 400);
            }
        }else{
			$senderId = $userData['senderId'];
			$receiverId = $userData['receiverId'];
			$eventId = $userData['eventId'];
			
			$chat_query = $this->db->query("select * from chat where (sender_id = ".@$senderId." and receiver_id = ".@$receiverId." and event_id = ".$eventId." and group_msg IS NULL) OR (sender_id = ".@$receiverId." and receiver_id = ".@$senderId." and event_id = ".$eventId." and group_msg IS NULL) ");
		    $result = ($chat_query->num_rows() > 0) ? $chat_query->result() : '';
			
			$sender_user_info = $this->Mymodel->get_single_row_info('image, fname, lname', 'users', 'id='.@$senderId.'', '', 1);
		    $receiver_user_info = $this->Mymodel->get_single_row_info('image, fname, lname', 'users', 'id='.@$receiverId.'', '', 1);
			if(!empty($result)){
				foreach($result as $k => $v){
					
					if(@$v->sender_id == @$senderId){
						$senderName = $sender_user_info->fname.' '.$sender_user_info->lname;
						$senderImage = (!empty(@$sender_user_info->image) ? base_url('uploads/profile/'.@$sender_user_info->image.'') : base_url('uploads/unnamed.jpg'));
						$senderMsg = @$v->message;
						$created = date('Y-m-d H:i:s', strtotime(@$v->created_at));
						//$msgId = @$v->id;
						
						if(!empty(@$v->image) && file_exists('uploads/chat/'.@$v->image.'')){
							$explodeFile = explode('.', @$v->image);
							if($explodeFile[1] == 'jpg' OR $explodeFile[1] == 'jpeg' OR $explodeFile[1] == 'png'){
								$img = base_url('uploads/chat/'.@$v->image.'');
							}else{
								$img = base_url('uploads/chat/'.@$v->image.'');
							}
						}else{
							$img = "";
						}
						$arr[] = [
							'msgId' => @$v->id,
							'senderName' => $senderName,
							'senderImage' => $senderImage,
							'senderMsg' => $senderMsg,
							'chatFile' => $img,
							'msgDate' => $created,
						];
						
					
					}else{
						$receiverName = $receiver_user_info->fname.' '.$receiver_user_info->lname;
						$receiverImage = (!empty(@$receiver_user_info->image) ? base_url('uploads/profile/'.@$receiver_user_info->image.'') : base_url('uploads/unnamed.jpg'));
						$receiverMsg = @$v->message;
						//$msgId = @$v->id;
						$created = date('Y-m-d H:i:s', strtotime(@$v->created_at));
						if(!empty(@$v->image) && file_exists('uploads/chat/'.@$v->image.'')){
							$explodeFile = explode('.', @$v->image);
							if($explodeFile[1] == 'jpg' OR $explodeFile[1] == 'jpeg' OR $explodeFile[1] == 'png'){
								$img = base_url('uploads/chat/'.@$v->image.'');
							}else{
								$img = base_url('uploads/chat/'.@$v->image.'');
							}
						}else{
							$img = "";
						}
						$arr[] = [
							'msgId' => @$v->id,
							'receiverName' => $receiverName,
							'receiverImage' => $receiverImage,
							'receiverMsg' => $receiverMsg,
							'chatFile' => $img,
							'msgDate' => $created,
						];
					} 
					
					// $arr[] = [
					    // 'msgId' => @$v->id,
					    // 'senderName' => $senderName,
					    // 'senderImage' => $senderImage,
					    // 'senderMsg' => $senderMsg,
					    // 'receiverName' => $receiverName,
					    // 'receiverImage' => $receiverImage,
					    // 'receiverMsg' => $receiverMsg,
					// ];
				}
				
				$arr = $this->arrcheck($arr);
				$this->response([
					'status'=>"1",
					'list'=>$arr
				], 200);
			}else{
				$arr = [];
				$this->response([
					'status'=>"0",
					'error'=>"No data found",
					'list'=>$arr,
				], 400);
			}
		}
	}
	
	function addChat_post(){
		$json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        if (is_array($obj))
        {
            $_POST = (array) $obj;
            $userData = $_POST;
        } else {
            $userData['senderId'] = $this->post('senderId');
            $userData['receiverId'] = $this->post('receiverId');
            $userData['eventId'] = $this->post('eventId');
            $userData['message'] = $this->post('message');
        }
		
		$this->form_validation->set_rules('senderId', 'senderId', 'trim|required');
		$this->form_validation->set_rules('receiverId', 'receiverId', 'trim|required');
		$this->form_validation->set_rules('eventId', 'eventId', 'trim|required');
        
        if ($this->form_validation->run() === false)
        {
            if(form_error('senderId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('senderId'))
                ], 400);
            }
			
			if(form_error('receiverId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('receiverId'))
                ], 400);
            }
			
			if(form_error('eventId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('eventId'))
                ], 400);
            }
        }else{
			$senderId = $userData['senderId'];
			$receiverId = $userData['receiverId'];
			$eventId = $userData['eventId'];
			$message = $userData['message'];
			
			if(!empty($_FILES['image']['name'])){
				$config['upload_path'] = 'uploads/chat'; # check path is correct
				$config['allowed_types'] = 'pdf|jpg|png|jpeg|docx|xlsx|csv'; # add video extenstion on here
				$config['overwrite'] = FALSE;
				$config['remove_spaces'] = TRUE;
				$image_name = preg_replace("/\s+/", "_", $_FILES['image']['name']);
				$config['file_name'] = $image_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('image')) {
				$array = array('vali_error' => 1, 'product_image_err' => $this->upload->display_errors());
				echo json_encode($array);
				exit();
				}else {
					// $sender_id = $this->input->post('sender_id');
					// $receiver_id = $this->input->post('receiver_id');
					// $event_id = $this->input->post('event_id');
					// $message = $this->input->post('message');
					$data = array('sender_id' => $senderId, 'receiver_id' => $receiverId, 'event_id' => $eventId, 'message' => $message, 'status' => '1', 'header_noti_status' => '1', 'image' => $image_name, 'created_at' => date('Y-m-d H:i:s'));
					$result= $this->Mymodel->add('chat', $data);
					if(!empty($result)){
						$chat_id = $result;
						// $response['chat_id'] = $chat_id;
						// $response['status'] = 1;
						
						$chat_query = $this->db->query("select * from chat where sender_id = ".@$senderId." and receiver_id = ".@$receiverId." and event_id = ".@$eventId." and id = ".@$chat_id."")->row();
						
						$user_image = $this->Mymodel->get_single_row_info('image, fname, lname', 'users', 'id='.$chat_query->sender_id.'', '', 1);
						$senderName = $user_image->fname.' '.$user_image->lname;
						$sender_image = !empty($user_image->image) ? base_url('uploads/profile/'.@$user_image->image.'') : base_url('uploads/unnamed.jpg');
						$sender_message = $chat_query->message;
						$sender_date = date('M d Y', strtotime($chat_query->created_at));
						$sender_time = date('h:i A', strtotime($chat_query->created_at));
						//$sender_file = $image_name;
						$msgDate = date('Y-m-d H:i:s', strtotime($chat_query->created_at));
						
						if(!empty(@$chat_query->image) && file_exists('uploads/chat/'.@$chat_query->image.'')){
							$explodeFile = explode('.', @$chat_query->image);
							if($explodeFile[1] == 'jpg' OR $explodeFile[1] == 'jpeg' OR $explodeFile[1] == 'png'){
								$img = base_url('uploads/chat/'.@$chat_query->image.'');
							}else{
								$img = base_url('uploads/chat/'.@$chat_query->image.'');
							}
						}else{
							$img = "";
						}
						
						$arr = [
							'msgId' => @$chat_id,
							'senderName' => $senderName,
							'senderImage' => $sender_image,
							'senderMsg' => $sender_message,
							'chatFile' => $img,
							'msgDate' => $msgDate,
						];
						
						$arr = $this->arrcheck($arr);
						$this->response([
						'status'=>"1",
						'msgInfo'=>$arr
						], 200);
					}else{
						$arr = [];
						$this->response([
						'status'=>"0",
						'msgInfo'=>$arr,
						'error'=>'Some error occure, Please try again.',
						], 400);
					}
				}
			}else{
				$data = array('sender_id' => $senderId, 'receiver_id' => $receiverId, 'event_id' => $eventId, 'message' => $message, 'status' => '1', 'header_noti_status' => '1', 'created_at' => date('Y-m-d H:i:s'));
				$result= $this->Mymodel->add('chat', $data);
				if(!empty($result)){
					
					$chat_id = $result;
					$chat_query = $this->db->query("select * from chat where sender_id = ".@$senderId." and receiver_id = ".@$receiverId." and event_id = ".@$eventId." and id = ".@$chat_id."")->row();
					
					$user_image = $this->Mymodel->get_single_row_info('image, fname, lname', 'users', 'id='.$chat_query->sender_id.'', '', 1);
					$senderName = $user_image->fname.' '.$user_image->lname;
					$sender_image = !empty($user_image->image) ? base_url('uploads/profile/'.@$user_image->image.'') : base_url('uploads/unnamed.jpg');
					$sender_message = $chat_query->message;
					$sender_date = date('M d Y', strtotime($chat_query->created_at));
					$sender_time = date('h:i A', strtotime($chat_query->created_at));
					$msgDate = date('Y-m-d H:i:s', strtotime($chat_query->created_at));
					
					if(!empty(@$chat_query->image) && file_exists('uploads/chat/'.@$chat_query->image.'')){
						$explodeFile = explode('.', @$chat_query->image);
						if($explodeFile[1] == 'jpg' OR $explodeFile[1] == 'jpeg' OR $explodeFile[1] == 'png'){
							$img = base_url('uploads/chat/'.@$chat_query->image.'');
						}else{
							$img = base_url('uploads/chat/'.@$chat_query->image.'');
						}
					}else{
						$img = "";
					}
					
					$arr = [
						'msgId' => @$chat_id,
						'senderName' => $senderName,
						'senderImage' => $sender_image,
						'senderMsg' => $sender_message,
						'chatFile' => $img,
						'msgDate' => $msgDate,
					];
					
					$arr = $this->arrcheck($arr);
					$this->response([
						'status'=>"1",
						'msgInfo'=>$arr
					], 200);
				}else{
					$arr = [];
					$this->response([
						'status'=>"0",
						'msgInfo'=>$arr,
						'error'=>'Some error occure, Please try again.',
					], 400);
				}
			}
			
			
			$chat_query = $this->db->query("select * from chat where (sender_id = ".@$senderId." and receiver_id = ".@$receiverId." and event_id = ".$eventId." and group_msg IS NULL) OR (sender_id = ".@$receiverId." and receiver_id = ".@$senderId." and event_id = ".$eventId." and group_msg IS NULL) ");
		    $result = ($chat_query->num_rows() > 0) ? $chat_query->result() : '';
			
			$sender_user_info = $this->Mymodel->get_single_row_info('image, fname, lname', 'users', 'id='.@$senderId.'', '', 1);
		    $receiver_user_info = $this->Mymodel->get_single_row_info('image, fname, lname', 'users', 'id='.@$receiverId.'', '', 1);
			if(!empty($result)){
				foreach($result as $k => $v){
					
					if(@$v->sender_id == @$senderId){
						$senderName = $sender_user_info->fname.' '.$sender_user_info->lname;
						$senderImage = (!empty(@$sender_user_info->image) ? base_url('uploads/profile/'.@$sender_user_info->image.'') : base_url('uploads/unnamed.jpg'));
						$senderMsg = @$v->message;
						//$msgId = @$v->id;
						
						if(!empty(@$v->image) && file_exists('uploads/chat/'.@$v->image.'')){
							$explodeFile = explode('.', @$v->image);
							if($explodeFile[1] == 'jpg' OR $explodeFile[1] == 'jpeg' OR $explodeFile[1] == 'png'){
								$img = base_url('uploads/chat/'.@$v->image.'');
							}else{
								$img = base_url('uploads/chat/'.@$v->image.'');
							}
						}else{
							$img = "";
						}
						$arr[] = [
							'msgId' => @$v->id,
							'senderName' => $senderName,
							'senderImage' => $senderImage,
							'senderMsg' => $senderMsg,
							'chatFile' => $img,
						];
						
					
					}else{
						$receiverName = $receiver_user_info->fname.' '.$receiver_user_info->lname;
						$receiverImage = (!empty(@$receiver_user_info->image) ? base_url('uploads/profile/'.@$receiver_user_info->image.'') : base_url('uploads/unnamed.jpg'));
						$receiverMsg = @$v->message;
						//$msgId = @$v->id;
						
						if(!empty(@$v->image) && file_exists('uploads/chat/'.@$v->image.'')){
							$explodeFile = explode('.', @$v->image);
							if($explodeFile[1] == 'jpg' OR $explodeFile[1] == 'jpeg' OR $explodeFile[1] == 'png'){
								$img = base_url('uploads/chat/'.@$v->image.'');
							}else{
								$img = base_url('uploads/chat/'.@$v->image.'');
							}
						}else{
							$img = "";
						}
						$arr[] = [
							'msgId' => @$v->id,
							'receiverName' => $receiverName,
							'receiverImage' => $receiverImage,
							'receiverMsg' => $receiverMsg,
							'chatFile' => $img,
						];
					} 
					
					// $arr[] = [
					    // 'msgId' => @$v->id,
					    // 'senderName' => $senderName,
					    // 'senderImage' => $senderImage,
					    // 'senderMsg' => $senderMsg,
					    // 'receiverName' => $receiverName,
					    // 'receiverImage' => $receiverImage,
					    // 'receiverMsg' => $receiverMsg,
					// ];
				}
				
				$arr = $this->arrcheck($arr);
				$this->response([
					'status'=>"1",
					'list'=>$arr
				], 200);
			}else{
				$arr = [];
				$this->response([
					'status'=>"0",
					'error'=>"No data found",
					'list'=>$arr,
				], 400);
			}
		}
	}
	
	function addGroupchat_post(){
		$json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        if (is_array($obj))
        {
            $_POST = (array) $obj;
            $userData = $_POST;
        } else {
            $userData['senderId'] = $this->post('senderId');
            $userData['eventId'] = $this->post('eventId');
            $userData['message'] = $this->post('message');
            $userData['eventhostId'] = $this->post('eventhostId');
        }
		
		$this->form_validation->set_rules('senderId', 'senderId', 'trim|required');
		$this->form_validation->set_rules('eventhostId', 'eventhostId', 'trim|required');
		$this->form_validation->set_rules('eventId', 'eventId', 'trim|required');
        
        if ($this->form_validation->run() === false)
        {
            if(form_error('senderId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('senderId'))
                ], 400);
            }
			
			if(form_error('eventhostId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('eventhostId'))
                ], 400);
            }
			
			if(form_error('eventId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('eventId'))
                ], 400);
            }
        }else{
			$senderId = $userData['senderId'];
			$eventhostId = $userData['eventhostId'];
			$eventId = $userData['eventId'];
			$message = $userData['message'];
			
			
			
			if(!empty($_FILES['image']['name'])){
				$config['upload_path'] = 'uploads/chat'; # check path is correct
				$config['allowed_types'] = 'pdf|jpg|png|jpeg|docx|xlsx|csv'; # add video extenstion on here
				$config['overwrite'] = FALSE;
				$config['remove_spaces'] = TRUE;
				$image_name = preg_replace("/\s+/", "_", $_FILES['image']['name']);
				$config['file_name'] = $image_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('image')) {
				$array = array('vali_error' => 1, 'product_image_err' => $this->upload->display_errors());
				echo json_encode($array);
				exit();
				}else {
					
					$host_data = $this->Mymodel->get_single_row_info('id, email', 'users', 'id='.@$eventhostId.'', '', 1);
					$my_data = $this->Mymodel->get_single_row_info('id, email', 'users', 'id='.@$senderId.'', '', 1);
					$get_invited_people = $this->db->query("select * from event_invited_people where email != '".@$my_data->email."' and event_id = ".@$eventId."")->result();
					
					if(!empty($get_invited_people)){
						
						$check_host_exist = $this->db->query("select * from event_invited_people where email = '".@$host_data->email."' and event_id = ".@$eventId."")->num_rows();
						//echo $this->db->last_query();die;
						
						
						if($check_host_exist > 0){
							
						}else{
							$host_receiver_id = $this->Mymodel->get_single_row_info('id, email', 'users', 'email="'.@$host_data->email.'"', '', 1);
							$get_invited_people[] = (object)[
								'id' => 0,
								'email' => @$host_receiver_id->email,
								'event_id' => '',
								'distributed_event_price'=>'',
								'user_id' => '',
								'status' => '',
								'transaction' => '',
								'created_at' => '',
								'updated_at' => ''
							];
						}
						$receiver_id = [];
						foreach($get_invited_people as $k => $v){  
							$invited_people = $this->Mymodel->get_single_row_info('id', 'users', 'email="'.@$v->email.'"', '', 1);
							if(!empty($invited_people)){
								$receiver_id[] = $invited_people->id;
							}
						}
					}
					
					$data = array('sender_id' => $senderId, 'receiver_id' => implode(',', $receiver_id), 'event_id' => $eventId, 'message' => $message, 'status' => '1', 'image' => $image_name, 'header_noti_status' => '1', 'created_at' => date('Y-m-d H:i:s'), 'group_msg' => '1');
					$result= $this->Mymodel->add('chat', $data);
					
					if(!empty($result)){
						$chat_id = $result;
						$receiverId = implode(',', @$receiver_id);
						
						$chat_query = $this->db->query("select * from chat where sender_id = ".@$senderId." and receiver_id = '".@$receiverId."' and event_id = ".@$eventId." and id = ".@$chat_id."")->row();
						
						$user_image = $this->Mymodel->get_single_row_info('image, fname, lname', 'users', 'id='.$chat_query->sender_id.'', '', 1);
						$senderName = $user_image->fname.' '.$user_image->lname;
						$sender_image = !empty($user_image->image) ? base_url('uploads/profile/'.@$user_image->image.'') : base_url('uploads/unnamed.jpg');
						$sender_message = $chat_query->message;
						$sender_date = date('M d Y', strtotime($chat_query->created_at));
						$sender_time = date('h:i A', strtotime($chat_query->created_at));
						$msgDate = date('Y-m-d H:i:s', strtotime($chat_query->created_at));
						//$sender_file = $image_name;
						
						if(!empty(@$chat_query->image) && file_exists('uploads/chat/'.@$chat_query->image.'')){
							$explodeFile = explode('.', @$chat_query->image);
							if($explodeFile[1] == 'jpg' OR $explodeFile[1] == 'jpeg' OR $explodeFile[1] == 'png'){
								$img = base_url('uploads/chat/'.@$chat_query->image.'');
							}else{
								$img = base_url('uploads/chat/'.@$chat_query->image.'');
							}
						}else{
							$img = "";
						}
						
						$arr = [
							'msgId' => @$chat_id,
							'senderName' => $senderName,
							'senderImage' => $sender_image,
							'senderMsg' => $sender_message,
							'chatFile' => $img,
							'msgDate' => $msgDate,
						];
						
						$arr = $this->arrcheck($arr);
						$this->response([
						'status'=>"1",
						'msgInfo'=>$arr
						], 200);
					}else{
						$arr = [];
						$this->response([
						'status'=>"0",
						'msgInfo'=>$arr,
						'error'=>'Some error occure, Please try again.',
						], 400);
					}
				}
			}else{
				$host_data = $this->Mymodel->get_single_row_info('id, email', 'users', 'id='.@$eventhostId.'', '', 1);
				$my_data = $this->Mymodel->get_single_row_info('id, email', 'users', 'id='.@$senderId.'', '', 1);
				$get_invited_people = $this->db->query("select * from event_invited_people where email != '".@$my_data->email."' and event_id = ".@$eventId."")->result();
				
				if(!empty($get_invited_people)){
					$check_host_exist = $this->db->query("select * from event_invited_people where email = '".@$host_data->email."' and event_id = ".@$eventId."")->num_rows();
					
					if($check_host_exist > 0){
						
					}else{
						$host_receiver_id = $this->Mymodel->get_single_row_info('id, email', 'users', 'email="'.@$host_data->email.'"', '', 1);
						$get_invited_people[] = (object)[
							'id' => 0,
							'email' => @$host_receiver_id->email,
							'event_id' => '',
							'distributed_event_price'=>'',
							'user_id' => '',
							'status' => '',
							'transaction' => '',
							'created_at' => '',
							'updated_at' => ''
						];
					}
					$receiver_id = [];
					foreach($get_invited_people as $k => $v){  
						$invited_people = $this->Mymodel->get_single_row_info('id', 'users', 'email="'.@$v->email.'"', '', 1);
						if(!empty($invited_people)){
							$receiver_id[] = $invited_people->id;
						}
					}
				}
				
				$data = array('sender_id' => $senderId, 'receiver_id' => implode(',', $receiver_id), 'event_id' => $eventId, 'message' => $message, 'status' => '1', 'header_noti_status' => '1', 'created_at' => date('Y-m-d H:i:s'), 'group_msg' => '1');
				//print_r($data);die;
				$result= $this->Mymodel->add('chat', $data);
				
				if(!empty($result)){
					$chat_id = $result;
					$receiverId = implode(',', @$receiver_id);
					
					$chat_query = $this->db->query("select * from chat where sender_id = ".@$senderId." and receiver_id = '".@$receiverId."' and event_id = ".@$eventId." and id = ".@$chat_id."")->row();
					
					$user_image = $this->Mymodel->get_single_row_info('image, fname, lname', 'users', 'id='.$chat_query->sender_id.'', '', 1);
					$senderName = $user_image->fname.' '.$user_image->lname;
					$sender_image = !empty($user_image->image) ? base_url('uploads/profile/'.@$user_image->image.'') : base_url('uploads/unnamed.jpg');
					$sender_message = $chat_query->message;
					$sender_date = date('M d Y', strtotime($chat_query->created_at));
					$sender_time = date('h:i A', strtotime($chat_query->created_at));
					
					$msgDate = date('Y-m-d H:i:s', strtotime($chat_query->created_at));
					
					if(!empty(@$chat_query->image) && file_exists('uploads/chat/'.@$chat_query->image.'')){
						$explodeFile = explode('.', @$chat_query->image);
						if($explodeFile[1] == 'jpg' OR $explodeFile[1] == 'jpeg' OR $explodeFile[1] == 'png'){
							$img = base_url('uploads/chat/'.@$chat_query->image.'');
						}else{
							$img = base_url('uploads/chat/'.@$chat_query->image.'');
						}
					}else{
						$img = "";
					}
					
					$arr = [
						'msgId' => @$chat_id,
						'senderName' => $senderName,
						'senderImage' => $sender_image,
						'senderMsg' => $sender_message,
						'chatFile' => $img,
						'msgDate' => $msgDate,
					];
					
					$arr = $this->arrcheck($arr);
					$this->response([
						'status'=>"1",
						'msgInfo'=>$arr
					], 200);
				}else{
					$arr = [];
					$this->response([
						'status'=>"0",
						'msgInfo'=>$arr,
						'error'=>'Some error occure, Please try again.',
					], 400);
				}
				
			}
		}
	}
	
	
	function groupchats_post(){
		$json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        if (is_array($obj))
        {
            $_POST = (array) $obj;
            $userData = $_POST;
        } else {
            $userData['senderId'] = $this->post('senderId');
            $userData['eventhostId'] = $this->post('eventhostId');
            $userData['eventId'] = $this->post('eventId');
        }
		
		$this->form_validation->set_rules('senderId', 'senderId', 'trim|required');
		$this->form_validation->set_rules('eventhostId', 'eventhostId', 'trim|required');
		$this->form_validation->set_rules('eventId', 'eventId', 'trim|required');
        
        if ($this->form_validation->run() === false)
        {
            if(form_error('senderId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('senderId'))
                ], 400);
            }
			
			if(form_error('eventhostId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('eventhostId'))
                ], 400);
            }
			
			if(form_error('eventId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('eventId'))
                ], 400);
            }
        }else{
			$senderId = $userData['senderId'];
			$eventhostId = $userData['eventhostId'];
			$eventId = $userData['eventId'];
			
			$chat_query = $this->db->query("select * from chat where event_id = ".$eventId." and group_msg = '1'");
		    $result = ($chat_query->num_rows() > 0) ? $chat_query->result() : '';
			
			$sender_user_info = $this->Mymodel->get_single_row_info('image, fname, lname', 'users', 'id='.@$senderId.'', '', 1);
			

			if(!empty($result)){
				foreach($result as $k => $v){
					$receiver_user_info = $this->Mymodel->get_single_row_info('image', 'users', 'id='.@$v->sender_id.'', '', 1);
					
					if(@$v->sender_id == @$senderId){
						$senderName = $sender_user_info->fname.' '.$sender_user_info->lname;
						$senderImage = (!empty(@$sender_user_info->image) ? base_url('uploads/profile/'.@$sender_user_info->image.'') : base_url('uploads/unnamed.jpg'));
						$senderMsg = @$v->message;
						//$msgId = @$v->id;
						$msgDate = date('Y-m-d H:i:s', strtotime($v->created_at));
						
						if(!empty(@$v->image) && file_exists('uploads/chat/'.@$v->image.'')){
							$explodeFile = explode('.', @$v->image);
							if($explodeFile[1] == 'jpg' OR $explodeFile[1] == 'jpeg' OR $explodeFile[1] == 'png'){
								$img = base_url('uploads/chat/'.@$v->image.'');
							}else{
								$img = base_url('uploads/chat/'.@$v->image.'');
							}
						}else{
							$img = "";
						}
						$arr[] = [
							'msgId' => @$v->id,
							'senderName' => $senderName,
							'senderImage' => $senderImage,
							'senderMsg' => $senderMsg,
							'chatFile' => $img,
							'msgDate' => $msgDate,
						];
						
					
					}else{
						$receiverName = $receiver_user_info->fname.' '.$receiver_user_info->lname;
						$receiverImage = (!empty(@$receiver_user_info->image) ? base_url('uploads/profile/'.@$receiver_user_info->image.'') : base_url('uploads/unnamed.jpg'));
						$receiverMsg = @$v->message;
						//$msgId = @$v->id;
						$msgDate = date('Y-m-d H:i:s', strtotime($v->created_at));
						
						if(!empty(@$v->image) && file_exists('uploads/chat/'.@$v->image.'')){
							$explodeFile = explode('.', @$v->image);
							if($explodeFile[1] == 'jpg' OR $explodeFile[1] == 'jpeg' OR $explodeFile[1] == 'png'){
								$img = base_url('uploads/chat/'.@$v->image.'');
							}else{
								$img = base_url('uploads/chat/'.@$v->image.'');
							}
						}else{
							$img = "";
						}
						$arr[] = [
							'msgId' => @$v->id,
							'receiverName' => $receiverName,
							'receiverImage' => $receiverImage,
							'receiverMsg' => $receiverMsg,
							'chatFile' => $img,
							'msgDate' => $msgDate,
						];
					} 
					
					// $arr[] = [
					    // 'msgId' => @$v->id,
					    // 'senderName' => $senderName,
					    // 'senderImage' => $senderImage,
					    // 'senderMsg' => $senderMsg,
					    // 'receiverName' => $receiverName,
					    // 'receiverImage' => $receiverImage,
					    // 'receiverMsg' => $receiverMsg,
					// ];
				}
				
				$arr = $this->arrcheck($arr);
				$this->response([
					'status'=>"1",
					'list'=>$arr
				], 200);
			}else{
				$arr = [];
				$this->response([
					'status'=>"0",
					'error'=>"No data found",
					'list'=>$arr,
				], 400);
			}
		}
	}
	
	function disconnectPaypal_post(){
		$json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        if (is_array($obj))
        {
            $_POST = (array) $obj;
            $userData = $_POST;
        } else {
            $userData['userId'] = $this->post('userId');
           
        }
		
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		
        
        if ($this->form_validation->run() === false)
        {
            if(form_error('userId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('userId'))
                ], 400);
            }
			
			
        }else{
			$userId = $userData['userId'];
			$result = $this->db->query("update paypal_payout_verified_email set user_id = 'null' where user_id = ".$userId."");
			if($result){
				$this->response([
					'status'=>"1",
					'message'=>'Your paypal connection is disconnect successfully.'
				], 200);
			}else{
				$this->response([
					'status'=>"0",
					'error'=>'Some error occured, Please try again..'
				], 400);
			}
		}
	}
	
	
	function disconnectStripe_post(){
		$json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        if (is_array($obj))
        {
            $_POST = (array) $obj;
            $userData = $_POST;
        } else {
            $userData['userId'] = $this->post('userId');
           
        }
		
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		
        
        if ($this->form_validation->run() === false)
        {
            if(form_error('userId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('userId'))
                ], 400);
            }
			
			
        }else{
			$userId = $userData['userId'];
			$result = $this->db->query("update stripe_connected_acc set user_id = 'null' where user_id = ".$userId."");
			if($result){
				$this->response([
					'status'=>"1",
					'message'=>'Your stripe connection is disconnect successfully.'
				], 200);
			}else{
				$this->response([
					'status'=>"0",
					'error'=>'Some error occured, Please try again..'
				], 400);
			}
		}
	}
	
	function paypalInfo_get(){
		if(!empty(@$_GET['userId'])){
			
			$userId = @$_GET['userId'];
			$paypal = $this->db->query("select * from paypal_payout_verified_email where user_id = '".$userId."' AND verified = 'true'")->row();
			if($paypal){
				$user_info = $this->db->query("select fname, lname from users where id = '".$userId."'")->row();
				$arr= array(
				'userId' => @$userId,
				'name' => @$user_info->fname.' '.@$user_info->lname,
				'email' => @$paypal->email,
				'verified' => @$paypal->verified,

				);
				$arr = $this->arrcheck($arr);
				$this->response([
				'status'=>"1",
				'paypalInfo'=>$arr
				], 200);
			}else{
                $this->response([
				'status'=>"0",
				'error'=>'Some error occured, Please try again.'
				], 400);
			}
		}else{
			$this->response([
			'status'=>"0",
			'error'=>'userId is required.'
			], 400);
		}
	}
	
	function autoRenue_post(){
		$json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        if (is_array($obj))
        {
            $_POST = (array) $obj;
            $userData = $_POST;
        } else {
            $userData['userId'] = $this->post('userId');
            $userData['status'] = $this->post('status');
           
        }
		
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('status', 'status', 'trim|required');
		
        
        if ($this->form_validation->run() === false)
        {
            if(form_error('userId'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('userId'))
                ], 400);
            }
			
			if(form_error('status'))
            {
                $this->response([
                    'status' => "0",
                    'error' => strip_tags(form_error('status'))
                ], 400);
            }
			
			
        }else{
			require APPPATH . '/third_party/stripe/vendor/autoload.php';
			$stripe = new \Stripe\StripeClient('sk_test_51MPhgSIuZrwn6gWgucZ3pq3OGKnLaQMxviXsKtZb4F7tenDBs25KovJkAB4tii3db6CMW1tdWSk2CB9thQ8yOYdX00iUs05KRN');
			if ($userData['userId']) {
				$userId = $userData['userId'];
				$status = $userData['status'];
				if($status == '0'){
					$current_date = date("Y-m-d");
					$subscription = $this->db->query("select * from transaction where user_id = '".@$userId."' AND payment_type = '1' AND DATE(end_date) >= '".@$current_date."' AND auto_renew_status = '1'")->result();
                    if(!empty(@$subscription)){
						foreach($subscription as $k => $v){
							$subId = $v->tran_id;
							$id = $v->id;
							
							$subCancel = $stripe->subscriptions->cancel("$subId", []);
							$subsData = $subCancel->jsonSerialize();
							if($subsData['status'] == 'canceled'){
								$update[] = $this->db->query("update transaction set auto_renew_status = '0' where id = '".@$id."'");
								$this->db->query("update users set auto_renew_status = '0' where id = '".@$userId."'");
							}
					    }
						//$response['status'] = 1;
						//$response['message'] = 'Your auto renew subscription is canceled.';
						
						$this->response([
							'status' => "1",
							'message' => "Your auto renew subscription is canceled."
						], 200);
						
					}else{
						$this->db->query("update users set auto_renew_status = '".$status."' where id = '".@$userId."'");
						//$response['status'] = 1;
						//$response['message'] = 'Your auto renew subscription is canceled.';
						$this->response([
							'status' => "0",
							'error' => "Your auto renew subscription is canceled."
						], 400);
					}
					
				}else{
					$this->db->query("update users set auto_renew_status = '".$status."' where id = '".@$userId."'");
					//$response['status'] = 1;
					//$response['message'] = 'Your auto renew subscription is start.';
					$this->response([
						'status' => "1",
						'message' => "Your auto renew subscription is start."
					], 200);
				}
			}else{
				$this->response([
					'status' => "0",
					'error' => "userId is required."
				], 400);
			}
		}
	}
	
	public function get_currency_symbol($cc = 'USD')
    {
        $cc       = strtoupper($cc);
        $currency = array(
            "USD" => "$", //U.S. Dollar
            "AUD" => "A$", //Australian Dollar
            "BRL" => "R$", //Brazilian Real
            "CAD" => "C$", //Canadian Dollar
            "XCD" => "X$", //Caribbean island currency Dollar
            "CZK" => "Kč", //Czech Koruna
            "DKK" => "kr", //Danish Krone
            "EUR" => "€", //Euro
            "HKD" => "&#36", //Hong Kong Dollar
            "HUF" => "Ft", //Hungarian Forint
            "ILS" => "₪", //Israeli New Sheqel
            "INR" => "₹", //Indian Rupee
            "JPY" => "¥", //Japanese Yen
            "MYR" => "RM", //Malaysian Ringgit
            "MXN" => "&#36", //Mexican Peso
            "NOK" => "kr", //Norwegian Krone
            "NZD" => "&#36", //New Zealand Dollar
            "PHP" => "₱", //Philippine Peso
            "PLN" => "zł", //Polish Zloty
            "GBP" => "£", //Pound Sterling
            "SEK" => "kr", //Swedish Krona
            "CHF" => "Fr", //Swiss Franc
            "TWD" => "$", //Taiwan New Dollar
            "THB" => "฿", //Thai Baht
            "TRY" => "₺", //Turkish Lira
        );

        if (array_key_exists($cc, $currency)) {
            return $currency[$cc];
        }
    }

    public function testInput($data)
	{
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function generate_numbers($start, $count, $digits)
	{
		$result = array();
		for ($n = $start; $n < $start + $count; $n++) {
			$result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
		}
		return $result;
	}

	public function generate_otp($length)
	{
		$characters = '123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++)
		{
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function arrcheck($array)
	{
		array_walk_recursive($array, function (&$array, $key){
			$array = (null === $array)? '' : $array;
		});
		return $array;
	}

	public function removeNull($array)
    {
        array_walk_recursive($array, function (&$array, $key) {
            $array = (null === $array) ? '' : $array;
        });
        return $array;
    }

	public function hash($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}

	public function enc_password($password)
	{
		$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
		return $encrypted_password;
	}
	
	function testemail_get(){
		
			$this->Mymodel->send_mail('chetanbele1994@gmail.com', 'info@madetosplit.com', 'test', 'test', 'info@madetosplit.com', 'M@d32spl1t');
			
		/*$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('info@madetosplit.com','MadeToSplit');
		$this->email->to('chetanbele1994@gmail.com');
		$this->email->subject('Confirm MadeToSplit Registration');
		$this->email->message('test');
		$this->email->set_mailtype("html");
		$send = $this->email->send();
		print_r($send);*/
				
		/*require_once APPPATH.'third_party/email/vendor/autoload.php';
		$mail = new PHPMailer();
		$mail->SMTPDebug = 0; //Enable verbose debug output
		$mail->Host = 'smtp.office365.com'; // Specify main and backup SMTP servers
		$mail->IsSMTP();
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'info@madetosplit.com';                
		$mail->Password = 'M@d32spl1t';
		$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587; // TCP port to connect to
		//$mail->setFrom($from_email);
		$mail->From = 'test@gmail.com';
		$mail->addAddress('chetanbele1994@gmail.com');
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'Confirm MadeToSplit Registration';
		$mail->Body    = 'test';
		$send = $mail->send();
		print_r($send);*/
	}
	
	public function addUserOneSignal_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			$userData['playerId'] = $this->post('playerId');			
		}

		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('playerId', 'playerId', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
			if(form_error('playerId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('playerId'))
				], 400);
			}
		} else {

			$userInfo=$this->Apimodel->get_cond('onesignal_users', "user_id='".$userData['userId']."'");
			
			if($userInfo)
			{
				$mydata=array(
					'player_id'=>$userData['playerId'],
				);
				$res=$this->Apimodel->update_cond("onesignal_users","user_id='".$userData['userId']."'", $mydata);

			if($res)
			{
				$this->response([
					'status'=>"1", 
					'signalId'=>$userInfo->signal_id,
					'message'=>'Player Id is updated successfully'						
				], 200);
			} else {
				$this->response([
					'status' => "0",
					'error' => 'Something went wrong!'
				], 400);
			}

			}else{

				$mydata=array(
					'user_id'=>$userData['userId'],
					'player_id'=>$userData['playerId'],
					'created_at'=>date('Y-m-d H:i:s'),
				);	

				$result=$this->Apimodel->add_details("onesignal_users", $mydata);	

				if($result)
				{
					$this->response([
						'status'=>"1",
						'signalId'=>$result,
						'message'=>'Player Id is added successfully'						
					], 200);
				} else {
					$this->response([
						'status' => "0",
						'error' => 'Something went wrong!'
					], 400);
				}
			}	
		}
	}
	
	public function sendPushMsgOneSignal_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			$userData['message'] = $this->post('message');
		}

		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('message', 'message', 'trim|required');

		if($this->form_validation->run() === false)
		{
			if(form_error('userId'))
			{
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}

			if(form_error('message'))
			{
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('message'))
				], 400);
			}	


		} else {

			$checkUser = $this->Apimodel->get_cond('onesignal_users', "user_id='".$userData['userId']."'");

			if($checkUser)
			{
				$sendPushData = array(
					'playerId' => $checkUser->player_id,
					'msg' => $userData['message'],
				);

				$res= $this->Apimodel->sendPushMessage($sendPushData);
								
				$this->response([
					'status' => "1",
					'message' => 'Push Notification sent successfully!',				
				], 200);

			}else{

				$this->response([
					'status' => "0",
					'error' => 'No user found.'
				], 400);
			}

		}

	}
	
	public function googlelogin_post(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['firstName'] = $this->post('firstName');
			$userData['lastName'] = $this->post('lastName');
			$userData['email'] = $this->post('email');
			$userData['authProvide'] = $this->post('authProvide');
			$userData['authId'] = $this->post('authId');
			//$userData['userType'] = $this->post('userType');
			//$userData['password'] = $this->post('password');			
		}
		
		$this->form_validation->set_rules('firstName', 'firstName', 'trim|required');
		$this->form_validation->set_rules('lastName', 'lastName', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('authProvide', 'authProvide', 'trim|required');
		$this->form_validation->set_rules('authId', 'authId', 'trim|required');
		//$this->form_validation->set_rules('userType', 'userType', 'trim|required');

		if ($this->form_validation->run() === false) {
			
			if(form_error('firstName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('firstName'))
				], 200);
			}
			
			if(form_error('lastName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('lastName'))
				], 200);
			}
			
			if(form_error('email')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('email'))
				], 200);
			}
			
			if(form_error('authProvide')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('authProvide'))
				], 200);
			}
			
			if(form_error('authId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('authId'))
				], 200);
			}
			
			
		}else{
			 
			$data = array(
				'fname' =>$userData['firstName'],
				'lname' =>$userData['lastName'],
				'email' =>$userData['email'],
				'oauth_provider' =>$userData['authProvide'],
				'oauth_uid' =>$userData['authId'],
				'status'=>'1'
			);

			$insert = $this->Apimodel->Google_Login($data);
			$userId = $insert;
			if($insert){
				$user=$this->Apimodel->get_cond('users', "id='$userId'");
				if($user->image!="")
					{
					    $pic = base_url().'uploads/profile/'.$user->image;
					} else {
				    	$pic = base_url().'uploads/unnamed.jpg';
					}

					$array = [
						'status' =>"1",
						'personalInfo' => [
							'userId' => @$user->id,
							'fullName' => @$user->fname.' '.@$user->lname,
							'email' => @$user->email,
							'mobileNo' => @$user->phone,
							'address'=> @$user->address,
							// 'country'=> @$user->country,
							// 'state'=> @$user->state,
							// 'city'=> @$user->city,
							'profilePic' => @$pic,
							//'zipcode'=> @$user->zipcode,
							'bio'=> @$user->about,
					    ]
					];

					$array = $this->arrcheck($array);
					$this->response($array, 200);
				

			}else{

				$this->response([
					'status' =>"0",
					'error' => "Some problems occurred, please try again.!"
				], 400);	
			}			
		}
	}
	
	public function facebooklogin_post(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['firstName'] = $this->post('firstName');
			$userData['lastName'] = $this->post('lastName');
			$userData['email'] = $this->post('email');
			$userData['authProvide'] = $this->post('authProvide');
			$userData['authId'] = $this->post('authId');			
		}
		
		$this->form_validation->set_rules('firstName', 'firstName', 'trim|required');
		$this->form_validation->set_rules('lastName', 'lastName', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('authProvide', 'authProvide', 'trim|required');
		$this->form_validation->set_rules('authId', 'authId', 'trim|required');

		if ($this->form_validation->run() === false) {
			
			if(form_error('firstName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('firstName'))
				], 200);
			}
			
			if(form_error('lastName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('lastName'))
				], 200);
			}
			
			if(form_error('email')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('email'))
				], 200);
			}
			
			if(form_error('authProvide')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('authProvide'))
				], 200);
			}
			
			if(form_error('authId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('authId'))
				], 200);
			}
			
		}else{
			 
			$data = array(
				'fname' =>$userData['firstName'],
				'lname' =>$userData['lastName'],
				'email' =>$userData['email'],
				'oauth_provider' =>$userData['authProvide'],
				'oauth_uid' =>$userData['authId'],
				'status'=>'1'
			);

			$insert = $this->Apimodel->Facebook_Login($data);
			$userId = $insert;
			if($insert){
				$user=$this->Apimodel->get_cond('users', "id='$userId'");
				if($user->image!="")
				{
					$pic = base_url().'uploads/profile/'.$user->image;
				} else {
					$pic = base_url().'uploads/unnamed.jpg';
				}

				$array = [
					'status' =>"1",
					'personalInfo' => [
						'userId' => @$user->id,
						'fullName' => @$user->fname.' '.@$user->lname,
						'email' => @$user->email,
						'mobileNo' => @$user->phone,
						'address'=> @$user->address,
						// 'country'=> @$user->country,
						// 'state'=> @$user->state,
						// 'city'=> @$user->city,
						'profilePic' => @$pic,
						//'zipcode'=> @$user->zipcode,
						'bio'=> @$user->about,
					]
				];

				$array = $this->arrcheck($array);
				$this->response($array, 200);
			}else{

				$this->response([
					'status' =>"0",
					'error' => "Some problems occurred, please try again.!"
				], 400);	
			}			


		}
	}
}	