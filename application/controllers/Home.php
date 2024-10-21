<?php defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Apimodel');
        $this->load->model('Commonmodel');
        $this->load->model('User_model');
        $this->load->library('session');
        require 'vendor/autoload.php';
    }
    public function index() {
        $data = array('title' => 'Home', 'page' => 'home');
        $getCategotyListSql = "SELECT * from `sm_category` ORDER BY `id` DESC";
        $data['category_list'] = $this->db->query($getCategotyListSql)->result_array();
        //$getcourselistsql = "SELECT * from `courses` WHERE `status` = '1' AND assigned_instrustor IS NOT NULL ORDER BY `id` DESC limit 12";
        $getcourselistsql = "SELECT * from `courses` WHERE (user_id != '' OR assigned_instrustor != '') AND `status` = '1' ORDER BY `id` DESC limit 12";
        $data['course_list'] = $this->Commonmodel->fetch_all_join($getcourselistsql);
        $this->load->view('header', $data);
        $this->load->view('home');
        $this->load->view('footer');
    }
    public function register() {
        $data = array(
            'title' => 'Student Registration',
            'page' => 'register',
        );
        $this->load->view('header', $data);
        $this->load->view('register');
        $this->load->view('footer');
    }
    public function studentRegistration() {
        $email = $this->input->post('email');
        $full_name = $this->testInput($this->input->post('full_name'));
        $userType = $this->input->post('user_type');
        //$subscriptionType = $this->input->post('subscription_type');
        $check_email = $this->db->get_where('users', array('email' => $email))->num_rows();
        if ($check_email > 0) {
            $this->session->set_flashdata('error', 'The email id you are trying to use is already registered. Please login, or create a new account using a unique email address!');
            redirect(base_url('register'), 'refresh');
        }
        $otp = $this->generate_otp(6);
        if ($check_email == 0) {
            $data = array(
                'currency' => 'USD',
                'currency_symbol' => '$',
                'full_name' => $full_name,
                'email' => $email,
                'password' => base64_encode($this->input->post('password')),
                'otp' => $otp,
                'email_verified' => '0',
                'status' => '0',
                'userType' => $userType,
                'is_reset' => '1',
                //'subscription_type' => $subscriptionType,
                'created_at' => date('Y-m-d H:i:s')
            );
            //insert code
            $lastId = $this->db->insert('users', $data);
            $userid = $this->db->insert_id();
            if ($userid) {
                $subject = 'Verify Your Email Address From Movimiento';
                $activationURL = base_url() . "email-verification/" . urlencode(base64_encode($otp));
                $getOptionsSql = "SELECT * FROM `options`";
                $optionsList = $this->db->query($getOptionsSql)->result();
                $admEmail = $optionsList[8]->option_value;
                $address = $optionsList[6]->option_value;
                //$imagePath = base_url().'uploads/logo/Logo-movimiento-inblock.png';
                $message = "
                <body>
                    <div style='width: 600px; margin: 0 auto; background: #fff; border: 1px solid #e6e6e6'>
                        <div style='padding: 30px 30px 15px 30px; box-sizing: border-box'>
                            <img src='cid:Logo' style='width: 220px; float: right; margin-top: 0'>
                            <h3 style='padding-top: 45px;line-height: 20px;'>Greetings from<span style='font-weight: 900;font-size: 25px;color: #F44C0D;display: block'> Movimiento</span></h3>
                            <p style='font-size: 14px;'>Dear " . $full_name . ",</p>
                            <p style='font-size: 14px;'>Thank you for registration on <strong style='font-weight:bold;'>Movimiento</strong>.</p>
                            <p style='font-size: 14px;margin: 0 0 18px 0;'>Please click on the below activation link to verify your email address.</p>
                            <p style='font-size: 14px; margin: 0px;'><a href=" . $activationURL . " target='_blank' style='background:#232323;color:#fff;padding:10px;text-decoration:none;line-height:24px;'>click here</a></p>
                            <p style='font-size:40px;'></p>
                            <p style='font-size: 14px;margin: 0;list-style: none'>Sincerly</p>
                            <p style='font-size: 12px; margin: 0px; list-style: none'><b>movimiento</b></p>
                            <p style='font-size: 12px; margin: 0px; list-style: none'><b>Visit us:</b> <span>$address</span></p>
                            <p style='font-size: 12px; margin: 0px; list-style: none'><b>Email us:</b> <span>$admEmail</span></p>
                        </div>
                        <table style='width: 100%;'>
                            <tr>
                                <td style='height:30px;width:100%; background: red;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy; <?=date('Y')?> Movimiento. All rights reserved.</td>
                            </tr>
                        </table>
                    </div>
                </body>";
                require 'vendor/autoload.php';
                $mail = new PHPMailer(true);
                try {
                    $mail->CharSet = 'UTF-8';
                    $mail->SetFrom('support@movimientolatinouniversity.com', 'Movimiento Latino University');
                    $mail->AddAddress($email);
                    $mail->IsHTML(true);
                    $mail->Subject = $subject;
                    $mail->AddEmbeddedImage('uploads/logo/Logo-Makutano-inblock.png', 'Logo');
                    $mail->Body = $message;
                    $mail->IsSMTP();
                    //Send mail using GMAIL server
                    $mail->Host = 'localhost';
                    $mail->SMTPAuth = false;
                    $mail->SMTPAutoTLS = false;
                    $mail->Port = 25;
                    if (!$mail->send()) {
                        $msg = "Error sending: " . $mail->ErrorInfo;
                    } else {
                        $msg = "An email has been sent to your email address containing an activation link. Please click on the link to activate your account. If you do not click the link your account will remain inactive and you will not receive further emails. If you do not receive the email within a few minutes, please check your spam folder.";
                    }
                    $this->session->set_flashdata('success', $msg);
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                }
            } else {
                $this->session->set_flashdata('error', 'Opps, Try again!');
            }
            redirect(base_url('register'), 'refresh');
        }
    }
    public function login($course_id = null) {
        if ($this->session->has_userdata('isLoggedIn') && $this->session->has_userdata('user_id')) :
            redirect(base_url('student-dashboard'), 'refresh');
        endif;
        $data = array(
            'title' => 'Sign In',
            'page' => 'Login',
            'course_id' => @$course_id,
        );
        $this->load->view('header', $data);
        $this->load->view('login');
        $this->load->view('footer');
    }
    public function forgotPassword() {
        $data = array(
            'title' => 'Forgot Password',
            'page' => 'forgotpassword',
        );
        $this->load->view('header', $data);
        $this->load->view('forgot-password');
        $this->load->view('footer');
    }
    public function studentPasswordReset()
    {
        $email = $this->input->post('email');
        $check_email = $this->db->get_where('users', array('email' => $email, 'status' => 1))->num_rows();
        if ($check_email == 0) {
            $this->session->set_flashdata('error', 'Email not exist!');
            redirect(base_url('home/forgotPassword'), 'refresh');
        }
        $otp = $this->generate_otp(6);
        if ($check_email > 0) {
            $usr = $this->User_model->getUsrDetails($email);
            $full_name = $usr->full_name;
            $user_id = $usr->id;
            $data = array(
                'otp' => $otp
            );
            $where = array(
                'id' => $user_id
            );
            //$this->db->update('users', $data, $where);
            $this->db->query("UPDATE users SET otp = '" . $otp . "' WHERE id = '" . $user_id . "'");
            $subject = 'Password reset from Movimiento';
            $url = base_url() . "otp-verification/" . base64_encode($otp);
            $getOptionsSql = "SELECT * FROM `options`";
            $optionsList = $this->db->query($getOptionsSql)->result();
            $address = $optionsList[6]->option_value;
            $admEmail = $optionsList[8]->option_value;
            $message = "
            <body>
                <div style='width: 600px; margin: 0 auto; background: #fff; border: 1px solid #e6e6e6'>
                    <div style='padding: 30px 30px 15px 30px; box-sizing: border-box'>
                        <img src='cid:Logo' style='width: 220px; float: right; margin-top: 0'>
                        <h3 style='padding-top: 45px;line-height: 20px;'>Greetings from<span style='font-weight: 900;font-size: 25px;color: #F44C0D;display: block'> Movimiento</span></h3>
                        <p style='font-size: 14px;'>Dear " . $full_name . ",</p>
                        <p style='font-size: 18px;'></p>
                        <p style='font-size: 18px; margin: 30px 0;'>Please click on below link to reset your password.</p>
                        <p style='font-size: 18px; margin: 0px;'><a href=" . $url . " target='_blank' style='background:#232323;color:#fff;padding:10px;text-decoration:none;line-height:24px;'>click here</a></p>
                        <p style='font-size:20px;'></p>
                        <p style='font-size: 18px; margin: 0px; list-style: none'>Sincerly</p>
                        <p style='font-size: 12px; margin: 0px; list-style: none'><b>Movimiento</b></p>
                        <p style='font-size: 12px; margin: 0px; list-style: none'><b>Visit us:</b> <span>$address</span></p>
                        <p style='font-size: 12px; margin: 0px; list-style: none'><b>Email us:</b> <span>$admEmail</span></p>
                    </div>
                    <table style='width: 100%;'>
                        <tr>
                            <td style='height:30px;width:100%; background: red;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy; <?=date('Y')?> Movimiento. All rights reserved.</td>
                        </tr>
                    </table>
                </div>
            </body>";
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom('support@movimientolatinouniversity.com', 'Movimiento Latino University');
                $mail->AddAddress($email);
                $mail->IsHTML(true);
                $mail->AddEmbeddedImage('uploads/logo/Logo-Makutano-inblock.png', 'Logo');
                $mail->Subject = $subject;
                $mail->Body = $message;
                $mail->IsSMTP();
                $mail->Host = 'localhost';
                $mail->SMTPAuth = false;
                $mail->SMTPAutoTLS = false;
                $mail->Port = 25;
                if (!$mail->send()) {
                    $msg = "Error sending: " . $mail->ErrorInfo;
                } else {
                    $msg = "An email has been sent to your email address containing an reset password link. Please click on the link to change your account. If you do not receive the email within a few minutes, please check your spam folder.";
                }
                $this->session->set_flashdata('success', $msg);
            } catch (Exception $e) {
                $this->session->set_flashdata('error_message', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            }
        } else {
            $this->session->set_flashdata('error', 'Opps, Try again!');
        }
        redirect(base_url('home/forgotPassword'), 'refresh');
    }
    public function verifyOtp($otp = null) {
        if (empty($otp)) {
            $this->session->set_flashdata('error', 'You have not permission to access this page!');
            redirect(base_url('reset-password'), 'refresh');
        }
        // $otp = $this->uri->segment(3);
        $givenotp = base64_decode($otp);
        $sql = "SELECT * FROM `users` WHERE `otp` = '" . $givenotp . "'";
        $check = $this->db->query($sql)->num_rows();
        $data = array(
            'title' => 'Password reset ',
            'otp' => $givenotp,
        );
        if ($check > 0) {
            $usr = $this->db->query($sql)->row();
            $data['user_id'] = $usr->id;
            $this->load->view('header', $data);
            $this->load->view('reset-password');
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('error', 'Sorry! Password reset link is expired!');
            $this->load->view('header', $data);
            $this->load->view('reset-password');
            $this->load->view('footer');
        }
    }
    public function resetPwdCust() {
        $user_id = $this->input->post('user_id');
        $otp = base64_decode($this->input->post('otp'));
        $password = $this->input->post('password');
        $sql = "SELECT * FROM `users` WHERE `otp` = '" . $otp . "' AND `id` = '" . $user_id . "'";
        $check = $this->db->query($sql)->num_rows();
        $data = array(
            'title' => 'Password reset',
            'otp' => $otp,
        );
        if ($check > 0) {
            $usr = $this->db->query($sql)->row();
            $field_data = array(
                'password' => base64_encode($password),
                'otp' => ''
            );
            $where = array(
                'id' => $user_id
            );
            $result = $this->Commonmodel->update_row('users', $field_data, $where);
            if ($result) {
                $this->session->set_flashdata('success', 'Your Password is successfully Updated. You can now login.');
                $this->load->view('header', $data);
                $this->load->view('reset-password');
                $this->load->view('footer');
            } else {
                $this->session->set_flashdata('error', 'Sorry! There is error verifying!');
                $this->load->view('header', $data);
                $this->load->view('reset-password');
                $this->load->view('footer');
            }
        } else {
            $this->session->set_flashdata('error', 'Sorry! Password reset link is expired!');
            $this->load->view('header', $data);
            $this->load->view('reset-password');
            $this->load->view('footer');
        }
    }
    public function community() {
        $data['community_cat'] = $this->db->query("SELECT * FROM community_cat WHERE status = '1' AND is_delete = '1'")->result_array();
        $data['community'] = $this->db->query("SELECT * FROM community WHERE status = '1' AND is_delete = '1' ORDER BY id DESC")->result_array();
        $this->load->view('header');
        $this->load->view('community', $data);
        $this->load->view('footer');
    }
    public function community_details($slug) {
        $data['community_data'] = $this->db->query("SELECT * FROM community WHERE slug LIKE '%" . $slug . "%'")->row();
        $this->load->view('header', $data);
        $this->load->view('community-details', $data);
        $this->load->view('footer');
    }
    public function contact() {
        $data = array(
            'title' => 'Contact Us',
            'page' => 'contact',
        );
        $this->load->view('header', $data);
        $this->load->view('contact');
        $this->load->view('footer');
    }
    public function contactFormSubmit()
    {
        $fname = $this->input->post("name");
        $email = $this->input->post("email");
        $sub = $this->input->post("subject");
        $msg = $this->input->post("message");
        $contactFormData = array(
            'fname' => $fname,
            'email' => $email,
            'subject' => $sub,
            'message' => $msg
        );
        $result = $this->Commonmodel->add_details('contacts', $contactFormData);
        $insert_id = $this->db->insert_id();
        if (!empty($insert_id)) {
            $subject = $sub;
            $getOptionsSql = "SELECT * FROM `options`";
            $optionsList = $this->db->query($getOptionsSql)->result();
            //$imagePath = base_url().'uploads/logo/Logo-Makutano-inblock.png';
            $admEmail = $optionsList[8]->option_value;
            $address = $optionsList[6]->option_value;
            $message = "
            <body>
                <div style='width:600px;margin: 0 auto;background: #fff; border: 1px solid #e6e6e6;'>
                    <div style='padding: 30px 30px 15px 30px;box-sizing: border-box;'>
                        <img src='cid:Logo' style='width:100px;float: right;margin-top: 0 auto;'>
                        <h3 style='padding-top:40px; line-height: 30px;'>Greetings from<span style='font-weight: 900;font-size: 35px;color: #F44C0D; display: block;'>Makutano</span></h3>
                        <p style='font-size: 18px;'> Dear Admin,</p>
                        <p style='font-size: 18px;'>Please find the below details for contact query.</p>
                        <p style='font-size: 18px; margin: 0px;'>Name: $fname</p>
                        <p style='font-size: 18px; margin: 0px;'>Email: $email</p>
                        <p style='font-size: 18px; margin: 0px;'>Message: $msg</p>
                        <p style='font-size: 20px;'></p>
                        <p style='font-size: 18px; margin: 0px; list-style: none'>Sincerly</p>
                        <p style='font-size: 12px; margin: 0px; list-style: none'><b>Makutano</b></p>
                        <p style='font-size: 12px; margin: 0px; list-style: none'><b>Visit us:</b> <span>$address</span></p>
                        <p style='font-size: 12px; margin: 0px; list-style: none'><b>Email us:</b> <span>$admEmail</span></p>
                    </div>
                    <table style='width: 100%;'>
                        <tr>
                            <td style='height:30px;width:100%; background: red;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy; <?=date('Y')?> Makutano. All rights reserved.</td>
                        </tr>
                    </table>
                </div>
            </body>";
            $mail = new PHPMailer(true);
            try {
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom('support@movimientolatinouniversity.com', 'Movimiento Latino University');
                $mail->IsHTML(true);
                $mail->AddEmbeddedImage('uploads/logo/Logo-Makutano-inblock.png', 'Logo');
                $mail->Subject = $subject;
                $mail->Body = $message;
                $mail->IsSMTP();
                //Send mail using GMAIL server
                $mail->Host = 'localhost';
                $mail->SMTPAuth = false;
                $mail->SMTPAutoTLS = false;
                $mail->Port = 25;
                $mail->send();
                echo $msg = "Thank You for Contacting Us";
            } catch (Exception $e) {
                echo $msg = "Message could not be sent. Mailer Error: $mail->ErrorInfo";
            }
        } else {
            echo $msg = "Oops, Try again!";
        }
    }
    public function studentLoginCheck() {
        $email = $this->input->post('email');
        $password = base64_encode($this->input->post('password'));
        $course_id = $this->input->post('course_id');
        $userValid = $this->User_model->usrLoginCheck($email, $password);
        if ($userValid) {
            $user = $this->User_model->getUsrDetails($email);
            $this->session->set_userdata('isLoggedIn', TRUE);
            $this->session->set_userdata('user_id', @$user->id);
            $this->session->set_userdata('first_name', @$user->fname);
            $this->session->set_userdata('userType', @$user->userType);
            //echo $user->is_reset; die();
            if (@$user->userType == '1') {
                if (@$course_id != 'login') {
                    $this->session->set_flashdata('success', 'Logged in successfully.');
                    redirect(base_url('course-detail/' . @$course_id), 'refresh');
                } else {
                    if($user->is_reset == '0') {
                        redirect(base_url('reset_password'));
                    } else {
                        $checkSudscriptionData = $this->db->query("SELECT * FROM user_subscription WHERE employer_id = '".$user->id."' AND status = '1'")->row();
                        if (!empty($checkSudscriptionData)) {
                            //$this->session->set_flashdata('success', 'Great! You have logged in successfully.');
                            redirect(base_url('student-dashboard'), 'refresh');
                        } else {
                            //$this->session->set_flashdata('success', 'Great! You have logged in successfully.');
                            redirect(base_url('edit-profile'), 'refresh');
                        }
                    }
                }
            } else {
                $checkSudscriptionData = $this->db->query("SELECT * FROM user_subscription WHERE employer_id = '".$user->id."' AND status = '1'")->row();
                if (!empty($checkSudscriptionData)) {
                    $this->session->set_flashdata('success', 'Great! You have logged in successfully.');
                    redirect(base_url('consultant-dashboard'), 'refresh');
                } else {
                    $this->session->set_flashdata('success', 'Great! You have logged in successfully.');
                    redirect(base_url('supercontrol/subscription'), 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid email/password, Please try again!');
            redirect(base_url('login/'.@$course_id), 'refresh');
            $data = array(
                'title' => 'Sign In',
                'page' => 'login',
                'course_id' => @$course_id,
            );
            $this->load->view('header', $data);
            $this->load->view('login');
            $this->load->view('footer');
        }
    }
    public function subscription() {
        $subscription_list =  $this->db->query("SELECT * FROM subscription WHERE subscription_user_type = '".$_SESSION['userType']."' AND status = '1'")->result_array();
        $data = array(
            'title' => 'Subscription',
            'page' => 'Subscription',
            'subscription_list' => @$subscription_list,
        );
        $this->load->view('header', $data);
        $this->load->view('subscription');
        $this->load->view('footer');
    }
    public function reset_password(){
        $data = array('title' => 'Password Reset Page');
        $this->load->view('header', $data);
        $this->load->view('password_reset');
        $this->load->view('footer');
    }
    public function changePassword() {
        $old_password = $this->input->post('old_password');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');
        $getUserDetailss = $this->db->query("SELECT * FROM users WHERE id = '".$this->session->userdata('user_id')."'")->row();
        $existingPass = base64_decode($getUserDetailss->password);
        if($existingPass != $old_password) {
            $this->session->set_flashdata('error', 'Old password is incorrect.');
            redirect(base_url('reset_password'), 'refresh');
        } else {
            $this->db->query("UPDATE users SET is_reset = '1', password = '".base64_encode($password)."' WHERE id = '".$this->session->userdata('user_id')."'");
            $this->session->set_flashdata('success', 'Great! You have logged in successfully.');
            redirect(base_url('student-dashboard'), 'refresh');
        }

    }
    public function courseDetail($id) {
        $data = array('title' => 'Course Details', 'page' => 'course');
        $where = array('id' => $id);
        $data['detail'] = $this->Commonmodel->fetch_row('courses', $where);
        $data['course_id'] = $id;
        $this->load->view('header', $data);
        $this->load->view('course-detail');
        $this->load->view('footer');
    }
    public function searchData() {
        $keyword = $this->input->post('search_data');
        $data['search_result'] = $this->db->query("SELECT * FROM courses WHERE (title LIKE '%" . $keyword . "%' OR heading_1 LIKE '%" . $keyword . "%' OR heading_2 LIKE '%" . $keyword . "%' OR description LIKE '%" . $keyword . "%' OR program_overview LIKE '%" . $keyword . "%' OR objectives LIKE '%" . $keyword . "%' OR curriculam LIKE '%" . $keyword . "%' OR career_paths LIKE '%" . $keyword . "%') AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('search_page', $data);
        $this->load->view('footer', $data);
    }
    public function categoryWisesearchData($slug) {
        $getcategoryId = $this->db->query("SELECT * FROM sm_category WHERE category_link like '%".$slug."%'")->row();
        $id = $getcategoryId->id;
        $data['search_result'] = $this->db->query("SELECT * FROM courses WHERE cat_id = '".$id."'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('search_page', $data);
        $this->load->view('footer', $data);
    }
    public function getcatwiseData() {
        if($_POST['cat_id']) {
            $cat_id = $_POST['cat_id'];
            $search_result = $this->db->query("SELECT * FROM courses WHERE cat_id = '".$cat_id."' AND  status = '1' AND assigned_instrustor IS NOT NULL")->result_array();
        } else if ($_POST['rate_id']) {
            $rate_id = $_POST['rate_id'];
            $getcourseid = $this->db->query("SELECT group_concat(course_id) as course_id FROM course_reviews WHERE rating = '".$rate_id."'")->row();
            $courseID = $getcourseid->course_id;
            if(!empty($courseID)){
                $search_result = $this->db->query("SELECT * FROM courses WHERE id IN (".$courseID.") AND  status = '1' AND assigned_instrustor IS NOT NULL")->result_array();
            } else {
                $search_result = $this->db->query("SELECT * FROM courses WHERE id IN (0) AND  status = '1' AND assigned_instrustor IS NOT NULL")->result_array();
            }
        } else {

        }
        $html = '';
        if (!empty($search_result)) {
            foreach ($search_result as $value) {
                $course_url = base_url('course-detail/' . @$value['id']);
                $catname = $this->db->query("SELECT * FROM sm_category WHERE id = '" . $value['cat_id']."'")->row();
                if (!empty($value['image'])) {
                    $img = base_url().'assets/images/courses/'.$value['image'];
                } else {
                    $img = base_url().'assets/images/no-image.png';
                }
                $module = $this->db->query("SELECT count(id) as total_module FROM course_modules WHERE course_id = '" .  @$value['id'] . "'")->row();
                if (!empty($module)) {
                    $count = $module->total_module;
                } else {
                    $count = '0';
                }
                if (!empty($value['user_id'])) {
                    $user_details = $this->db->query("SELECT id, full_name, image FROM users WHERE id = '" . $value['user_id'] . "' AND email_verified = '1' AND status = '1'")->row();
                    $full_name = $user_details->full_name;
                    if (!empty($user_details->image)) {
                        $uimg = base_url().'uploads/users/'.$user_details->image;
                    } else {
                        $uimg = base_url().'images/no-user.png';
                    }
                } else {
                    $full_name = 'Admin';
                    $uimg = base_url().'assets/img/favicon.png';
                }
                if ($value['course_fees'] == 'free') {
                    $fees = ucwords($value['course_fees']);
                } else {
                    $fees = ucwords($value['price']);
                }
                $rating = $this->db->query("SELECT * FROM course_reviews WHERE course_id = '" . @$value['id'] . "'")->result_array();
                $totalrate = $this->db->query("SELECT SUM(rating) as total FROM course_reviews WHERE course_id = '" . @$value['id'] . "'")->row();
                $html .= '
                <div class="col-md-4 col-sm-12 grid-item cat1 cat2 cat4">
                    <div class="course__item white-bg mb-30 fix">
                        <div class="course__thumb w-img p-relative fix">
                            <a href="'.$course_url.'">
                                <img src='.$img.' alt="" style="width: 282px; height: 190px;">
                            </a>
                            <div class="course__tag">
                                <a href="javascript:void(0)">'.$catname->category_name.'</a>
                            </div>
                        </div>
                        <div class="course__content">
                            <div class="course__meta d-flex align-items-center justify-content-between">
                                <div class="course__lesson">
                                    <span><i class="far fa-book-alt"></i>'.$count.' Lesson</span>
                                </div>
                                <div class="course__rating">';
                                if (!empty($rating)) {
                                    $rate = round($totalrate->total / count($rating), 0);
                                    foreach (range(1, 5) as $i) {
                                        if ($rate > 0) {
                                            $html .= '<span class="active"><i class="fas fa-star"></i></span>';
                                        } else {
                                            $html .= '<span><i class="fas fa-star zero"></i></span>';
                                        }
                                        $rate--;
                                    }
                                    $html .= "(" . round($totalrate->total / count($rating), 0) . ")";
                                } else {
                                    $html .= '<span><i class="fas fa-star zero"></i></span>';
                                    $html .= '<span><i class="fas fa-star zero"></i></span>';
                                    $html .= '<span><i class="fas fa-star zero"></i></span>';
                                    $html .= '<span><i class="fas fa-star zero"></i></span>';
                                    $html .= '<span><i class="fas fa-star zero"></i></span>';
                                    $html .= "(0)";
                                }
                                $html .= '</div></div><h3 class="course__title">
                                    <a href="'.$course_url.'">'.@$value['title'].'</a>
                                </h3>
                                <div class="course__teacher d-flex align-items-center">
                                    <div class="course__teacher-thumb mr-15">
                                        <img src="'.$uimg.'" alt="">
                                    </div>
                                    <h6><a href="javascript:void(0)">'.$full_name.'</a></h6>
                                </div>
                            </div>
                            <div class="course__more d-flex justify-content-between align-items-center">
                                <div class="course__status">
                                    <span>'.$fees.'</span>
                                </div>
                                <div class="course__btn">
                                    <a href="'.$course_url.'" class="link-btn">Know Details<i class="far fa-arrow-right"></i><i class="far fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            $html = '<div class="col-lg-12 col-md-12 col-sm-12 mb-40" style="text-align : center;"><div class="courses-item">No Data found!</div></div>';
        }
        echo $html;

    }
    public function reviewSave()
    {
        $user_id = $this->session->userdata('user_id');
        $course_id = $this->input->post('course_id');
        $rating = $this->input->post('rating');
        $message = $this->input->post('message');
        $isExistMaterialSql = "SELECT * FROM `course_reviews` WHERE `user_id` = '" . $user_id . "' AND `course_id` = '" . $course_id . "'";
        $isExist = $this->db->query($isExistMaterialSql)->num_rows();
        if ($isExist == 0) {
            $reviewData = array('course_id' => @$course_id, 'user_id' => @$user_id, 'rating' => @$rating, 'review_message' => @$message, 'review_status' => 1);
            $this->Commonmodel->add_details('course_reviews', $reviewData);
            $getAllReviewSql = "SELECT rev.*, usr.full_name from `course_reviews` as rev LEFT JOIN `users` as usr ON usr.id = rev.user_id WHERE `course_id` = '" . $course_id . "' ORDER BY `review_date` DESC";
            echo $this->db->query($getAllReviewSql)->num_rows();
        } else {
            echo "0";
        }
    }
    public function getAllReviews()
    {
        $user_id = $this->session->userdata('user_id');
        $course_id = $this->input->post('course_id');
        $getAllReviewSql = "SELECT rev.*, usr.full_name from `course_reviews` as rev LEFT JOIN `users` as usr ON usr.id = rev.user_id WHERE `course_id` = '" . $course_id . "' ORDER BY `review_date` DESC";
        $data['reviewList'] = $this->db->query($getAllReviewSql)->result();
        $this->load->view('ajax-reviews', $data);
    }
    public function postComment()
    {
        if (!empty($_POST['comment_id'])) {
            $commentData = array(
                'user_id' => @$this->session->userdata('user_id'),
                'community_id' => $_POST['community_id'],
                'comment_id' => $_POST['comment_id'],
                'full_name' => $_POST['full_name'],
                'email' => $_POST['email'],
                'website' => $_POST['website'],
                'comment' => $_POST['comment'],
                'created_at' => date('Y-m-d h:i:s'),
            );
            $this->Commonmodel->add_details('community_comment_rply', $commentData);
        } else {
            $commentData = array(
                'user_id' => @$this->session->userdata('user_id'),
                'community_id' => $_POST['community_id'],
                'full_name' => $_POST['full_name'],
                'email' => $_POST['email'],
                'website' => $_POST['website'],
                'comment' => $_POST['comment'],
                'created_at' => date('Y-m-d h:i:s'),
            );
            $this->Commonmodel->add_details('community_comment', $commentData);
        }
        $insert_id = $this->db->insert_id();
        if ($insert_id > 0) {
            echo "Post comment successfully.";
        } else {
            echo "Error while posting comment.";
        }
    }
    public function postCommentRply()
    {
        $commentData = array(
            'user_id' => @$this->session->userdata('user_id'),
            'community_id' => $_POST['community_id'],
            'comment_id' => $_POST['comment_id'],
            'full_name' => $_POST['full_name'],
            'email' => $_POST['email'],
            'website' => $_POST['website'],
            'comment' => $_POST['comment'],
            'created_at' => date('Y-m-d h:i:s'),
        );
        $this->Commonmodel->add_details('community_comment_rply', $commentData);
        $insert_id = $this->db->insert_id();
        if ($insert_id > 0) {
            echo "Post comment successfully.";
        } else {
            echo "Error while posting comment.";
        }
    }
    public function likecommunity()
    {
        $likeData = array(
            'user_id' => @$this->session->userdata('user_id'),
            'community_id' => $_POST['community_id'],
            'is_liked' => 1
        );
        $isExistLikedSql = "SELECT * FROM community_like WHERE user_id = '" . $this->session->userdata('user_id') . "' AND community_id = '" . $_POST['community_id'] . "'";
        $isExist = $this->db->query($isExistLikedSql)->num_rows();
        if ($isExist == 0) {
            $this->Commonmodel->add_details('community_like', $likeData);
            $insert_id = $this->db->insert_id();
            if ($insert_id > 0) {
                echo "Liked";
            } else {
                echo "Error";
            }
        } else {
            $checkisLiked = $this->db->query("SELECT * FROM community_like WHERE user_id = '" . $this->session->userdata('user_id') . "' AND community_id = '" . $_POST['community_id'] . "'")->row();
            if ($checkisLiked->isliked == '1') {
                $this->db->query("UPDATE community_like SET is_liked = '0' WHERE user_id = '" . $this->session->userdata('user_id') . "' AND community_id = '" . $_POST['community_id'] . "'");
            } else {
                $this->db->query("UPDATE community_like SET is_liked = '1' WHERE user_id = '" . $this->session->userdata('user_id') . "' AND community_id = '" . $_POST['community_id'] . "'");
            }
            echo "liked";
        }
    }
    public function dislikecommunity()
    {
        $this->db->query("UPDATE community_like SET is_liked = '0' WHERE user_id = '" . $this->session->userdata('user_id') . "' AND community_id = '" . $_POST['community_id'] . "'");
    }
    public function about()
    {
        $data = array('title' => 'About Us', 'page' => 'about');
        $getAboutDataSql = "SELECT * FROM `cms` WHERE `id` = 1";
        $about_data = $this->db->query($getAboutDataSql);
        $data['aboutData'] = $about_data->result_array();
        /*$getReviewSql = "SELECT `courses`.`id`, `courses`.`title`, `users`.`id`,`users`.`fname`, `users`.`lname`, `users`.`email`, `users`.`image`, `course_reviews`.`review_id`, `course_reviews`.`review_message` FROM `course_reviews` JOIN `courses` ON `courses`.`id` = `course_reviews`.`course_id` JOIN `users` ON `users`.`id` = `course_reviews`.`user_id` GROUP BY `users`.`id` ORDER BY `course_reviews`.`review_date` DESC";
        $data['student_review'] = $this->db->query($getReviewSql)->result();*/
        $this->load->view('header', $data);
        $this->load->view('about');
        $this->load->view('footer');
    }
    public function term_conditions()
    {
        $data = array('title' => 'Terms & Condition', 'page' => 'terms');
        $getAboutDataSql = "SELECT * FROM `cms` WHERE `id` = 12";
        $about_data = $this->db->query($getAboutDataSql);
        $data['termsData'] = $about_data->result_array();
        $this->load->view('header', $data);
        $this->load->view('terms');
        $this->load->view('footer');
    }
    public function consulting() {
        $data = array('title' => 'Consulting', 'page' => 'consulting');
        $getConsultDataSql = "SELECT * FROM `cms` WHERE `id` = 21";
        $consult_data = $this->db->query($getConsultDataSql);
        $data['consultData'] = $consult_data->result_array();
        $this->load->view('header', $data);
        $this->load->view('consulting');
        $this->load->view('footer');
    }
    public function privacy_policy() {
        $data = array('title' => 'Privacy Policy', 'page' => 'terms');
        $getAboutDataSql = "SELECT * FROM `cms` WHERE `id` = 2";
        $about_data = $this->db->query($getAboutDataSql);
        $data['privacyData'] = $about_data->result_array();
        $this->load->view('header', $data);
        $this->load->view('privacy');
        $this->load->view('footer');
    }
    public function refund_policy() {
        $data = array('title' => 'Refund Policy', 'page' => 'terms');
        $getAboutDataSql = "SELECT * FROM `cms` WHERE `id` = 22";
        $about_data = $this->db->query($getAboutDataSql);
        $data['refundData'] = $about_data->result_array();
        $this->load->view('header', $data);
        $this->load->view('refund');
        $this->load->view('footer');
    }
    public function courseList() {
        $data = array('title' => 'Course List', 'page' => 'course');
        $getCourseListSql = "SELECT * from `courses` WHERE `status` = '1' ORDER BY `id` DESC";
        $data['list'] = $this->Commonmodel->fetch_all_join($getCourseListSql);
        $data['course_cat'] = $this->db->get('sm_category')->result_array();
        $this->load->view('header', $data);
        $this->load->view('course-list');
        $this->load->view('footer');
    }
    public function searchByInputValue() {
        $input_data = $this->input->post('input_data');
        $getfilteredCourseListSql = "SELECT * from `courses` WHERE `title` like '%" . $input_data . "%'";
        $filteredCourseList = $this->Commonmodel->fetch_all_join($getfilteredCourseListSql);
        $html = '';
        if (!empty($filteredCourseList)) {
            foreach ($filteredCourseList as $row) {
                if (@$row->image && file_exists('./assets/images/courses/' . @$row->image)) {
                    $image = base_url('assets/images/courses/' . @$row->image);
                } else {
                    $image = base_url('./images/noimage.jpg');
                }
                $getAverageRatingSql = "SELECT ROUND(AVG(rating),1) as averageRating FROM `course_reviews` where `course_id` = '" . @$row->id . "'";
                $ratingRow = $this->db->query($getAverageRatingSql)->row();
                $averageRating = @$ratingRow->averageRating;
                $rating = @$ratingRow->averageRating;
                $totalEnrolledSql = "SELECT * FROM `course_enrollment` WHERE `course_id` = '" . @$row->id . "' AND `payment_status` = 'COMPLETED'";
                $totalEnrolledUsr = $this->db->query($totalEnrolledSql)->num_rows();
                $html .= '<div class="col-lg-6 col-md-6 col-sm-6 mb-40"><div class="courses-item"><div class="img-part">';
                $html .= '<img src="' . @$image . '" alt="Course Image..."></div><div class="content-part"><h3 class="title truncate2 m-0">';
                $html .= '<a href="' . base_url('course-detail/' . @$row->id) . '">' . strip_tags($row->title) . '</a></h3>';
                $html .= '<ul class="meta-part m-0"><li class="user"><img src="' . base_url('user_assets/images/C2C_Home/Tag_Blue.png') . '"></li><li><span class="price">$' . number_format($row->price, 2) . '</span></li></ul>';
                $html .= '<div class="bottom-part"><div class="info-meta"><ul><li class="ratings"><span class="stars">';
                for ($i = 1; $i <= 5; $i++) {
                    if (round($rating - .25) >= $i) {
                        $html .= '<i class="fa fa-star"></i>';
                    } elseif (round($rating + .25) >= $i) {
                        $html .= '<i class="fa fa-star-half-o"></i>';
                    } else {
                        $html .= '<i class="fa fa-star-o"></i>';
                    }
                }
                $html .= '</span>(' . @$averageRating . ')</li></ul></div><div class="btn-part"><a href="' . base_url('course-detail/' . @$row->id) . '"><span>View Details</span></a></div></div></div></div></div>';
            }
        } else {
            $html = '<div class="col-lg-12 col-md-12 col-sm-12 mb-40" style="text-align : center;"><div class="courses-item">No Data found!</div></div>';
        }
        echo $html;
    }
    public function searchUsingSortBy() {
        if ($this->input->post('sortBy_data') == 'new_first') {
            $getfilteredCourseListSql = "SELECT * FROM `courses` where status = 1 ORDER BY `id` DESC";
            $filteredCourseList = $this->Commonmodel->fetch_all_join($getfilteredCourseListSql);
        } elseif ($this->input->post('sortBy_data') == 'old_first') {
            $getfilteredCourseListSql = "SELECT * FROM `courses` where status = 1 ORDER BY `id` ASC";
            $filteredCourseList = $this->Commonmodel->fetch_all_join($getfilteredCourseListSql);
        } elseif ($this->input->post('sortBy_data') == 'most_relevant') {
            $getfilteredCourseListSql = "SELECT COUNT(courses.id) AS total, courses.*, course_enrollment.enrollment_date FROM course_enrollment RIGHT JOIN courses ON course_enrollment.course_id = courses.id WHERE courses.status = 1 GROUP BY courses.id ORDER BY `course_enrollment`.`enrollment_date` ASC";
            $filteredCourseList = $this->Commonmodel->fetch_all_join($getfilteredCourseListSql);
        } elseif ($this->input->post('sortBy_data') == 'most_popular') {
            $getfilteredCourseListSql = "SELECT COUNT(courses.id) AS total, courses.* FROM course_enrollment JOIN courses ON course_enrollment.course_id = courses.id JOIN course_enrollment_status ON course_enrollment_status.course_id = courses.id WHERE courses.status = 1 GROUP BY courses.id ORDER BY total DESC";
            $filteredCourseList = $this->Commonmodel->fetch_all_join($getfilteredCourseListSql);
        } elseif ($this->input->post('sortBy_data') == 'top_rated_first') {
            $getfilteredCourseListSql = "SELECT COUNT(courses.id) AS total, SUM(course_reviews.rating), courses.* FROM course_reviews JOIN courses ON course_reviews.course_id = courses.id WHERE courses.status = 1 GROUP BY courses.id ORDER BY `SUM(course_reviews.rating)` DESC";
            $filteredCourseList = $this->Commonmodel->fetch_all_join($getfilteredCourseListSql);
        } elseif ($this->input->post('sortBy_data') == 'price_high_to_low') {
            $getfilteredCourseListSql = "SELECT * FROM `courses` where status = 1 ORDER BY `price` DeSC";
            $filteredCourseList = $this->Commonmodel->fetch_all_join($getfilteredCourseListSql);
        } elseif ($this->input->post('sortBy_data') == 'price_low_to_high') {
            $getfilteredCourseListSql = "SELECT * FROM `courses` where status = 1 ORDER BY `price` ASC";
            $filteredCourseList = $this->Commonmodel->fetch_all_join($getfilteredCourseListSql);
        } else {
            $getfilteredCourseListSql = "SELECT * FROM `courses` where status = 1";
            $filteredCourseList = $this->Commonmodel->fetch_all_join($getfilteredCourseListSql);
        }
        $html = '';
        if (!empty($filteredCourseList)) {
            foreach ($filteredCourseList as $row) {
                if (@$row->image && file_exists('./assets/images/courses/' . @$row->image)) {
                    $image = base_url('assets/images/courses/' . @$row->image);
                } else {
                    $image = base_url('./images/noimage.jpg');
                }
                $getAverageRatingSql = "SELECT ROUND(AVG(rating),1) as averageRating FROM `course_reviews` where `course_id` = '" . @$row->id . "'";
                $ratingRow = $this->db->query($getAverageRatingSql)->row();
                $averageRating = @$ratingRow->averageRating;
                $rating = @$ratingRow->averageRating;
                $totalEnrolledSql = "SELECT * FROM `course_enrollment` WHERE `course_id` = '" . @$row->id . "' AND `payment_status` = 'COMPLETED'";
                $totalEnrolledUsr = $this->db->query($totalEnrolledSql)->num_rows();
                $html .= '<div class="col-lg-6 col-md-6 col-sm-6 mb-40"><div class="courses-item"><div class="img-part">';
                $html .= '<img src="' . @$image . '" alt="Course Image..."></div><div class="content-part"><h3 class="title truncate2 m-0">';
                $html .= '<a href="' . base_url('course-detail/' . @$row->id) . '">' . strip_tags($row->title) . '</a></h3>';
                $html .= '<ul class="meta-part m-0"><li class="user"><img src="' . base_url('user_assets/images/C2C_Home/Tag_Blue.png') . '"></li><li><span class="price">$' . number_format($row->price, 2) . '</span></li></ul>';
                $html .= '<div class="bottom-part"><div class="info-meta"><ul><li class="ratings"><span class="stars">';
                for ($i = 1; $i <= 5; $i++) {
                    if (round($rating - .25) >= $i) {
                        $html .= '<i class="fa fa-star"></i>';
                    } elseif (round($rating + .25) >= $i) {
                        $html .= '<i class="fa fa-star-half-o"></i>';
                    } else {
                        $html .= '<i class="fa fa-star-o"></i>';
                    }
                }
                $html .= '</span>(' . @$averageRating . ')</li></ul></div><div class="btn-part"><a href="' . base_url('course-detail/' . @$row->id) . '"><span>View Details</span></a></div></div></div></div></div>';
            }
        } else {
            $html = '<div class="col-lg-12 col-md-12 col-sm-12 mb-40" style="text-align : center;"><div class="courses-item">No Data found!</div></div>';
        }
        echo $html;
    }
    public function searchUsingFilterBy() {
        $cat_id = $this->input->post('filterBy_data');
        $getfilteredCourseListSql = "SELECT * FROM `courses` where `cat_id`= $cat_id AND status = 1 ORDER BY `price` ASC";
        $filteredCourseList = $this->Commonmodel->fetch_all_join($getfilteredCourseListSql);
        $html = '';
        if (!empty($filteredCourseList)) {
            foreach ($filteredCourseList as $row) {
                if (@$row->image && file_exists('./assets/images/courses/' . @$row->image)) {
                    $image = base_url('assets/images/courses/' . @$row->image);
                } else {
                    $image = base_url('./images/noimage.jpg');
                }
                $getAverageRatingSql = "SELECT ROUND(AVG(rating),1) as averageRating FROM `course_reviews` where `course_id` = '" . @$row->id . "'";
                $ratingRow = $this->db->query($getAverageRatingSql)->row();
                $averageRating = @$ratingRow->averageRating;
                $rating = @$ratingRow->averageRating;
                $totalEnrolledSql = "SELECT * FROM `course_enrollment` WHERE `course_id` = '" . @$row->id . "' AND `payment_status` = 'COMPLETED'";
                $totalEnrolledUsr = $this->db->query($totalEnrolledSql)->num_rows();
                $html .= '<div class="col-lg-6 col-md-6 col-sm-6 mb-40"><div class="courses-item"><div class="img-part">';
                $html .= '<img src="' . @$image . '" alt="Course Image..."></div><div class="content-part"><h3 class="title truncate2 m-0">';
                $html .= '<a href="' . base_url('course-detail/' . @$row->id) . '">' . strip_tags($row->title) . '</a></h3>';
                $html .= '<ul class="meta-part m-0"><li class="user"><img src="' . base_url('user_assets/images/C2C_Home/Tag_Blue.png') . '"></li><li><span class="price">$' . number_format($row->price, 2) . '</span></li></ul>';
                $html .= '<div class="bottom-part"><div class="info-meta"><ul><li class="ratings"><span class="stars">';
                for ($i = 1; $i <= 5; $i++) {
                    if (round($rating - .25) >= $i) {
                        $html .= '<i class="fa fa-star"></i>';
                    } elseif (round($rating + .25) >= $i) {
                        $html .= '<i class="fa fa-star-half-o"></i>';
                    } else {
                        $html .= '<i class="fa fa-star-o"></i>';
                    }
                }
                $html .= '</span>(' . @$averageRating . ')</li></ul></div><div class="btn-part"><a href="' . base_url('course-detail/' . @$row->id) . '"><span>View Details</span></a></div></div></div></div></div>';
            }
        } else {
            $html = '<div class="col-lg-12 col-md-12 col-sm-12 mb-40" style="text-align : center;"><div class="courses-item">No Data found!</div></div>';
        }
        echo $html;
    }
    public function courseEnrollment($course_id = null) {
        $user_id = $this->session->userdata('user_id');
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        $data = array(
            'title' => 'Course Enrollment',
            'page' => 'course',
        );
        $where = array(
            'id' => $course_id
        );
        $getUserSql = "SELECT * FROM `users` WHERE `id` = '" . $user_id . "'";
        $count = $this->db->query($getUserSql)->num_rows();
        $data['usr'] = $this->db->query($getUserSql)->row();
        $data['course'] = $this->Commonmodel->fetch_row('courses', $where);
        $data['course_id'] = @$course_id;
        $this->load->view('header', $data);
        $this->load->view('payment');
        $this->load->view('footer');
    }
    public function checkout() {
        $data['user_id'] = $this->input->post('user_id');
        $data['price_key'] = $this->input->post('enrollment');
        $this->session->set_userdata('course_id', $this->input->post('course_id'));
        $this->load->view('header', $data);
		$this->load->view('checkout');
		$this->load->view('footer');
    }
    public function success($id) {
        $data['p_id'] = $id;
        $this->load->view('header');
        $this->load->view('success', $data);
        $this->load->view('footer');
    }
    public function email_unsubscribe() {
        $id = $this->uri->segment(2);
        $data = array(
            'title' => 'Email Unsubscribe Page',
            'page' => 'Email Unsubscribe',
            'id' => $id
        );
        $this->load->view('header', $data);
        $this->load->view('email_unsubscibe');
        $this->load->view('footer');
    }
    public function EmailUnsubcribeSubmit() {
        $email = $this->input->post("email");
        $date = date('Y-m-d h:i:s');
        $isExitSql = "SELECT * FROM `email_unsubscribe_list` WHERE `email_id` = '" . $email . "'";
        $isExist = $this->db->query($isExitSql)->num_rows();
        if ($isExist == 0) {
            $contactFormData = array('email_id' => $email, 'status' => '0', 'created_at' => $date);
            $result = $this->Commonmodel->add_details('email_unsubscribe_list', $contactFormData);
            $insert_id = $this->db->insert_id();
            if (!empty($insert_id)) {
                echo $msg = "Email unsubscribe successfully done";
            } else {
                echo $msg = "Opps, Try again!";
            }
        } else {
            echo $msg = "0";
        }
    }
    public function emailVerification($otp = null) {
        if (empty($otp)) {
            $this->session->set_flashdata('error', 'You have not permission to access this page!');
            redirect(base_url('register'), 'refresh');
        }
        $otp = $this->uri->segment(2);
        $givenotp = base64_decode(urldecode($otp));
        $sql = "SELECT * FROM `users` WHERE otp = '" . $givenotp . "' AND status = '0' AND `email_verified` = '0'";
        $check = $this->db->query($sql)->num_rows();
        $data = array(
            'title' => 'Account Activation',
        );
        if ($check > 0) {
            $usr = $this->db->query($sql)->row();
            $field_data = array(
                'email_verified' => '1',
                'otp' => '',
                'status' => '1'
            );
            $where = array(
                'id' => $usr->id
            );
            $result = $this->Commonmodel->update_row('users', $field_data, $where);
            if ($result) {
                $this->session->set_flashdata('success', 'Your Email Address is successfully verified! Your account has been activated successfully. You can now login.');
                // $this->load->view('email-activation', $data);
                redirect(base_url('login'), 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Sorry! There is error verifying your Email Address!');
                redirect(base_url('login'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', 'Sorry! Activation link is expired!');
            redirect(base_url('login'), 'refresh');
        }
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
    public function testInput($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function passwordReset($email) {
        $data = array(
            'title' => 'Password Reset Page',
        );
        $deCodeEmail = base64_decode($email);
        $sql = "SELECT * FROM `users` WHERE email = '$deCodeEmail'";
        $check = $this->db->query($sql)->num_rows();
        if ($check > 0) {
            $udetail = $this->db->get_where('users', array('email' => $deCodeEmail))->row();
            $userId = @$udetail->userId;
            $data['userId'] = @$udetail->userId;
            // $this->session->set_flashdata('suscess', 'Reset your password!');
        } else {
            $this->session->set_flashdata('error', 'Sorry! There is error verifying your details!');
        }
        $this->load->view('header', $data);
        $this->load->view('password-reset');
        $this->load->view('footer');
    }
    public function savereSetPassword() {
        $this->form_validation->set_rules('userId', 'user Id', 'trim|required');
        if ($this->form_validation->run() == false) {
            echo validation_errors();
        } else {
            $userId = $this->input->post('userId');
            $password = $this->input->post('gpassword');
            $sql = "SELECT * FROM `users` WHERE (userId = '$userId') AND status = '1'";
            $check = $this->db->query($sql)->num_rows();
            if ($check > 0) {
                $udetail = $this->db->get_where('users', array('userId' => $userId))->row();
                if (@$udetail->token == "") {
                    echo "4";
                } else {
                    if ($password != '') {
                        $where = "userId = '$userId'";
                        $updatedata = array(
                            'password' => md5($password),
                            'token' => '',
                        );
                        $this->Apimodel->update_cond("users", $where, $updatedata);
                        echo 1;
                    } else {
                        echo 3;
                    }
                }
            } else {
                echo 2;
            }
        }
    }
    public function purchaseCourse()
    {
        $user_id = $this->input->post('user_id');
        $course_id = $this->input->post('course_id');
        $enrollment_price = '0';
        $price_cents = '0.00';
        $currency = 'USD';
        $currency_symbol = '$';
        $transaction_id    = 'txn_' . rand();
        $this->db->query("INSERT INTO course_enrollment (`course_id`, `user_id`, `enrollment_price`, `price_cents`, `currency`, `currency_symbol`, `payment_status`, `transaction_id`) VALUES ('$course_id', '$user_id', '$enrollment_price', '$price_cents', '$currency', '$currency_symbol', 'COMPLETED', '$transaction_id')");
        if ($this->db->insert_id()) {
            echo '1';
        }
    }
    public function purchaseMCourse()
    {
        $user_id = $this->input->post('user_id');
        $course_id = $this->input->post('course_id');
        $enrollment_price = '0';
        $price_cents = $this->input->post('price');
        $currency = 'USD';
        $currency_symbol = '$';
        $transaction_id    = $this->input->post('txnR');
        $this->db->query("INSERT INTO course_enrollment (`course_id`, `user_id`, `enrollment_price`, `price_cents`, `currency`, `currency_symbol`, `payment_status`, `transaction_id`) VALUES ('$course_id', '$user_id', '$enrollment_price', '$price_cents', '$currency', '$currency_symbol', 'COMPLETED', '$transaction_id')");
        if ($this->db->insert_id()) {
            echo '1';
        }
    }
    public function faqs()
    {
        $data['faqs'] = $this->db->query("SELECT * FROM faqs")->result_array();
        $this->load->view('header');
        $this->load->view('faqs', $data);
        $this->load->view('footer');
    }
    public function search_query()
    {
        $search_input = $this->input->post('search_input');
        $data['searchData'] = $this->db->query("SELECT * FROM courses WHERE (title LIKE '%$search_input%' OR heading_1 LIKE '%$search_input%' OR heading_2 LIKE '%$search_input%' OR description LIKE '%$search_input%' OR program_overview LIKE '%$search_input%' OR objectives LIKE '%$search_input%' OR curriculam LIKE '%$search_input%' OR career_paths LIKE '%$search_input%' OR course_type LIKE '%$search_input%' OR course_certificate LIKE '%$search_input%' OR requirement LIKE '%$search_input%') AND status = '1'")->result();
        $this->load->view('header');
        $this->load->view('search-data', $data);
        $this->load->view('footer');
    }
    public function deleteReview($id)
    {
        $this->db->query("DELETE FROM course_reviews WHERE review_id = '" . $id . "'");
        redirect(base_url('reviews'), 'refresh');
    }
    public function event()
    {
        $data['eventList'] = $this->db->query("SELECT * FROM event WHERE status = '1' AND is_delete = '1'")->result_array();
        $data['admineventList'] = $this->db->query("SELECT COUNT(id) AS count FROM event WHERE (user_id IS NULL OR user_id = '') AND status = '1' AND is_delete = '1'")->row();
        $data['instruatoreventList'] = $this->db->query("SELECT COUNT(id) AS count FROM event WHERE (user_id IS NOT NULL OR user_id != '') AND status = '1' AND is_delete = '1' GROUP BY user_id")->row();
        $this->load->view('header');
        $this->load->view('event', $data);
        $this->load->view('footer');
    }
    public function event_details($slug)
    {
        $data['eventDetails'] = $this->db->query("SELECT * FROM event WHERE event_slug = '" . $slug . "' AND status = '1' AND is_delete = '1'")->row();
        $this->load->view('header');
        $this->load->view('event_details', $data);
        $this->load->view('footer');
    }
    public function search_event()
    {
        $keyword = $_POST['keyword'];
        $course = $_POST['course'];
        $user = $_POST['user'];
        if (!empty($keyword) && !empty($course) && !empty($user)) {
            $searchData = $this->db->query("SELECT * FROM event WHERE (event_name LIKE '%" . $keyword . "%' OR event_desc LIKE '%" . $keyword . "%') AND course_id IN ('" . $course . "') AND user_id IN ('" . $user . "') AND status = '1' AND is_delete = '1'")->result_array();
        } else if (!empty($keyword) || !empty($course) || !empty($user)) { {
                if (!empty($keyword)) {
                    $kid = explode(',', $keyword);
                    if (count($kid) > 1) {
                        $searchData = $this->db->query("SELECT * FROM event WHERE status = '1' AND is_delete = '1'")->result_array();
                    } else {
                        if ($kid[0] == '1') {
                            $searchData = $this->db->query("SELECT * FROM event WHERE (user_id IS NULL OR user_id = '') AND status = '1' AND is_delete = '1'")->result_array();
                        } else if ($kid[0] == '2') {
                            $searchData = $this->db->query("SELECT * FROM event WHERE (user_id IS NOT NULL OR user_id != '') AND status = '1' AND is_delete = '1'")->result_array();
                        } else {
                            $searchData = $this->db->query("SELECT * FROM event WHERE (event_name LIKE '%" . $keyword . "%' OR event_desc LIKE '%" . $keyword . "%') AND status = '1' AND is_delete = '1'")->result_array();
                        }
                    }
                } else if (!empty($course)) {
                    $searchData = $this->db->query("SELECT * FROM event WHERE course_id IN ('" . $course . "') AND status = '1' AND is_delete = '1'")->result_array();
                } else if (!empty($user)) {
                    $searchData = $this->db->query("SELECT * FROM event WHERE user_id IN ('" . $user . "') AND status = '1' AND is_delete = '1'")->result_array();
                } else
                    $searchData = $this->db->query("SELECT * FROM event WHERE status = '1' AND is_delete = '1'")->result_array();
            }
        } else {
            $searchData = $this->db->query("SELECT * FROM event WHERE status = '1' AND is_delete = '1'")->result_array();
        }
        $html = "";
        if (!empty($searchData)) {
            foreach ($searchData as $sData) {
                if (!empty($sData['user_id'])) {
                    $userdetails = $this->db->query("SELECT * FROM users WHERE id = '" . $sData['user_id'] . "'")->row();
                    $name = $userdetails->fname . " " . $userdetails->lname;
                } else {
                    $name = "Admin";
                }
                $html .= '<div class="card eventlist mb-2 bg-dark shadow-lg rounded-lg"><div class="card-body p-4"><span class="page__title-pre">Posted By: ' . $name . '</span><h3><a href="' . base_url() . 'event/' . $sData['event_slug'] . '">' . $sData['event_name'] . '</a></h3><span class="evntdate">' . date('d M Y', strtotime($sData['event_dt'])) . '</span><span class="evnttime">' . date('h:i A', strtotime($sData['from_time'])) . " - " . date('h:i A', strtotime($sData['to_time'])) . '</span><p>' . $sData['event_desc'] . '</p><a href="' . base_url() . 'event/' . $sData['event_slug'] . '">More info <i class="fas fa-arrow-right"></i></a></div></div>';
            }
        } else {
            $html = "<div class='card eventlist mb-2 bg-dark shadow-lg rounded-lg' style='text-align: center;padding: 40px;'>No data found</div>";
        }
        echo $html;
    }
    public function purchaseEvent()
    {
        $event_id = $this->input->post('event_id');
        $user_id = $this->input->post('user_id');
        $price = $this->input->post('price');
        //$enrollment_price = '0';
        $price_cents = '0.00';
        $currency = 'USD';
        $currency_symbol = '$';
        $transaction_id    = $this->input->post('txnR');
        $this->db->query("INSERT INTO event_booked (`event_id`, `user_id`, `event_price`, `price_cents`, `currency`, `currency_symbol`, `payment_status`, `transaction_id`)
        VALUES ('$event_id', '$user_id', '$price', '$price_cents', '$currency', '$currency_symbol', 'COMPLETED', '$transaction_id')");
        if ($this->db->insert_id()) {
            echo '1';
        }
    }
    public function purchaseMEvent()
    {
        $event_id = $this->input->post('event_id');
        $user_id = $this->input->post('user_id');
        $price = $this->input->post('price');
        $price_cents = '0.00';
        $currency = 'USD';
        $currency_symbol = '$';
        $transaction_id    = 'txn_' . rand();
        $this->db->query("INSERT INTO event_booked (`event_id`, `user_id`, `event_price`, `price_cents`, `currency`, `currency_symbol`, `payment_status`, `transaction_id`)
        VALUES ('$event_id', '$user_id', '$price', '$price_cents', '$currency', '$currency_symbol', 'COMPLETED', '$transaction_id')");
        if ($this->db->insert_id()) {
            echo '1';
        }
    }
    public function checkCompletedEvent()
    {
        $nowdate = date('m/d/Y');
        $countEvent = $this->db->query("SELECT * FROM event WHERE status = '1' AND is_delete = '1'")->num_rows();
        if ($countEvent > 0) {
            $this->db->query("UPDATE event SET event_level = 'Complete' WHERE event_dt < '" . $nowdate . "'");
            echo "Data updated";
        } else {
            echo "No data to update";
        }
    }
    public function youth()
    {
        $data['youth_activity'] = $this->db->query("SELECT * FROM youth_activity WHERE status = '1'")->result_array();
        $data['youth_portfolio'] = $this->db->query("SELECT * FROM portfolio WHERE portfolioId = '4' AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('youth', $data);
        $this->load->view('footer');
    }

    public function blog()
    {
        $data['blogList'] = $this->db->query("SELECT * FROM blogs WHERE status = '1' ORDER BY id DESC")->result_array();
        $this->load->view('header', $data);
        $this->load->view('blog', $data);
        $this->load->view('footer');
    }
    public function blog_details($slug)
    {
        $data['blog_details'] = $this->db->query("SELECT * FROM blogs WHERE slug LIKE '%" . $slug . "%' ORDER BY id DESC")->row();
        $this->load->view('header', $data);
        $this->load->view('blog_details', $data);
        $this->load->view('footer');
    }
    public function store()
    {
        $data = array('title' => 'Store', 'page' => 'product');
        $data['bestSale'] = $this->db->query("SELECT * FROM product WHERE categori_id = '1' AND `status` = '1' ORDER BY id DESC LIMIT 4")->result_array();
        $data['premiumBag'] = $this->db->query("SELECT * FROM product WHERE categori_id = '3' AND `status` = '1' ORDER BY id DESC LIMIT 2")->result_array();
        $data['hat'] = $this->db->query("SELECT * FROM product WHERE categori_id = '2' AND `status` = '1' ORDER BY id DESC LIMIT 5")->result_array();
        $data['product'] = $this->db->query("SELECT * FROM product WHERE `status` = '1' ORDER BY RAND() LIMIT 2")->result_array();
        $this->load->view('header', $data);
        $this->load->view('store', $data);
        $this->load->view('footer');
    }
    public function product_list()
    {
        $data = array('title' => 'Store', 'page' => 'product');
        $data['productData'] = $this->db->query("SELECT * FROM product WHERE `status` = '1' ORDER BY id DESC")->result_array();
        $this->load->view('header', $data);
        $this->load->view('product_list', $data);
        $this->load->view('footer');
    }
    public function product_details($id)
    {
        $data = array('title' => 'Product Details', 'page' => 'product');
        $data['productDetails'] = $this->db->query("SELECT * FROM product WHERE id = '" . $id . "' AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('product_details', $data);
        $this->load->view('footer');
    }
    public function getQuantityBySize()
    {
        $pId = $_POST['pId'];
        $size = $_POST['size'];
        $getQuantity = $this->db->query("SELECT * FROM product_details WHERE product_id = '" . $pId . "' AND size = '" . $size . "'")->row();
        echo $getQuantity->quantity;
    }
    public function cart()
    {
        $data['cartItems'] = $this->db->query("SELECT * FROM cart WHERE user_id = '" . @$this->session->userdata('user_id') . "'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('cart', $data);
        $this->load->view('footer');
    }
    // public function checkout()
    // {
    //     $data['cartItems'] = $this->db->query("SELECT * FROM cart WHERE user_id = '" . @$this->session->userdata('user_id') . "'")->result_array();
    //     $this->load->view('header', $data);
    //     $this->load->view('checkout', $data);
    //     $this->load->view('footer');
    // }
    public function portfolio9()
    {
        $data['portfolio9'] = $this->db->query("SELECT * FROM portfolio WHERE portfolioId = '1' AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('portfolio9', $data);
        $this->load->view('footer');
    }
    public function portfolio8()
    {
        $data['portfolio8'] = $this->db->query("SELECT * FROM portfolio WHERE portfolioId = '2' AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('portfolio8', $data);
        $this->load->view('footer');
    }
    public function portfolio7()
    {
        $data['portfolio7'] = $this->db->query("SELECT * FROM portfolio WHERE portfolioId = '3' AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('portfolio7', $data);
        $this->load->view('footer');
    }
    public function unsubscribe($id)
    {
        $this->db->query("UPDATE email_subscription SET status = '0' WHERE id = '" . $id . "'");
        redirect('home', 'refresh');
    }
    public function institute()
    {
        $this->load->view('header');
        $this->load->view('institute');
        $this->load->view('footer');
    }
    public function programmeForum()
    {
        $data['programme'] = $this->db->query("SELECT * FROM programme WHERE programme_for = 'mak_09' AND status = '1' LIMIT 2")->result_array();
        $this->load->view('header', $data);
        $this->load->view('programme_forum', $data);
        $this->load->view('footer');
    }
    public function mak_zeronine()
    {
        $data['mak_zeronine'] = $this->db->query("SELECT * FROM mak_zeronine WHERE presentation_for = 'mak_09' AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('mak_09', $data);
        $this->load->view('footer');
    }
    public function programme_sejour()
    {
        $data['programme_sejour'] = $this->db->query("SELECT * FROM programme_sejour WHERE programme_for = 'mak_09' AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('programme_sejour', $data);
        $this->load->view('footer');
    }
    public function conferences()
    {
        $data['title'] = 'Conference';
        $data['conferences'] = $this->db->query("SELECT * FROM conference WHERE status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('conference', $data);
        $this->load->view('footer');
    }
    public function makutano_analytics()
    {
        $data['title'] = 'Makutano Analytics';
        $data['conferences'] = $this->db->query("SELECT * FROM conference WHERE category = 'Analyses Makutano' AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('conference', $data);
        $this->load->view('footer');
    }
    public function work_documents()
    {
        $data['title'] = 'Work Documents';
        $data['conferences'] = $this->db->query("SELECT * FROM conference WHERE category = 'Working Papers' AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('conference', $data);
        $this->load->view('footer');
    }
    public function raba_arbi()
    {
        $data['title'] = 'Raba/Arbi';
        $data['conferences'] = $this->db->query("SELECT * FROM conference WHERE category = 'RABA/ARBI' AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('conference', $data);
        $this->load->view('footer');
    }
    public function conference_details($slug = "")
    {
        $data['conference_details'] = $this->db->query("SELECT * FROM conference WHERE slug LIKE '%$slug%' AND status = '1'")->row();
        $this->load->view('header', $data);
        $this->load->view('conference_detail', $data);
        $this->load->view('footer');
    }
    public function statuts()
    {
        $this->load->view('header');
        $this->load->view('statuts');
        $this->load->view('footer');
    }
    public function categoryWiseList($category)
    {
        $data['categoryWiseList'] = $this->db->query("SELECT * FROM conference WHERE category = '" . $category . "'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('category_list', $data);
        $this->load->view('footer');
    }
    public function sponsorship()
    {
        $this->load->view('header');
        $this->load->view('sponsorship');
        $this->load->view('footer');
    }
    public function others_info()
    {
        $this->load->view('header');
        $this->load->view('others_info');
        $this->load->view('footer');
    }
    public function mak_eight()
    {
        $data['mak_zeroeight'] = $this->db->query("SELECT * FROM mak_zeronine WHERE presentation_for = 'mak_08' AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('mak_08', $data);
        $this->load->view('footer');
    }
    public function programme_mak8()
    {
        $data['tab'] = 'programme_mak8';
        $data['programme'] = $this->db->query("SELECT * FROM programme_sejour WHERE programme_for = 'mak_08' AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('programme_forum', $data);
        $this->load->view('footer');
    }
    public function network()
    {
        $data['title'] = 'Conference';
        $data['network'] = $this->db->query("SELECT * FROM conference WHERE category = 'network' AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('network', $data);
        $this->load->view('footer');
    }
    public function foundation()
    {
        $data['title'] = 'Foundation';
        $data['network'] = $this->db->query("SELECT * FROM conference WHERE category = 'foundation' AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('foundation', $data);
        $this->load->view('footer');
    }
    public function business_women()
    {
        $data['title'] = 'Women In Business';
        $data['business_women'] = $this->db->query("SELECT * FROM portfolio WHERE portfolioId = '5' AND status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('business_women', $data);
        $this->load->view('footer');
    }
    public function newsletter()
    {
        $data['newsletter'] = $this->db->query("SELECT * FROM newsletter WHERE status= '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('newsletter', $data);
        $this->load->view('footer');
    }
    public function partenaires_07()
    {
        $data['tab'] = "partenaires_07";
        $this->load->view('header', $data);
        $this->load->view('partenaires', $data);
        $this->load->view('footer');
    }
    public function partenaires_08()
    {
        $data['tab'] = "partenaires_08";
        $this->load->view('header', $data);
        $this->load->view('partenaires', $data);
        $this->load->view('footer');
    }
    public function intervenants()
    {
        $data['tab'] = "intervenants";
        $data['intervenants'] = $this->db->query("SELECT * FROM intervenants WHERE status = '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('intervenants', $data);
        $this->load->view('footer');
    }
    public function livre_blanc()
    {
        $data['tab'] = "livre_blanc";
        $data['livre_blanc'] = $this->db->query("SELECT * FROM cms WHERE id = '23'")->row();
        $this->load->view('header', $data);
        $this->load->view('livre_blanc', $data);
        $this->load->view('footer');
    }
    public function program()
    {
        $data['tab'] = "program";
        $data['program'] = $this->db->query("SELECT * FROM cms WHERE id = '24'")->row();
        $this->load->view('header', $data);
        $this->load->view('program', $data);
        $this->load->view('footer');
    }
    public function thematiques()
    {
        $data['thematiques_desc'] = $this->db->query("SELECT * FROM cms WHERE id= '25'")->row();
        $data['thematiques'] = $this->db->query("SELECT * FROM thematiques WHERE status= '1'")->result_array();
        $this->load->view('header', $data);
        $this->load->view('thematiques', $data);
        $this->load->view('footer');
    }
    public function communique_de_presse_bilan()
    {
        $data['communique'] = $this->db->query("SELECT * FROM cms WHERE id= '26'")->row();
        $this->load->view('header', $data);
        $this->load->view('communique', $data);
        $this->load->view('footer');
    }
    public function course_list(){
        $getCategotyListSql = "SELECT * from `sm_category` ORDER BY `id` DESC";
        $data['category_list'] = $this->db->query($getCategotyListSql)->result_array();
        $getcourselistsql = "SELECT * from `courses` WHERE `status` = '1' AND assigned_instrustor IS NOT NULL";
        $data['course_list'] = $this->Commonmodel->fetch_all_join($getcourselistsql);
        $this->load->view('header', $data);
        $this->load->view('course_list_page');
        $this->load->view('footer');
    }
    public function dateWisefilter() {
        $date = $_POST['date'];
        $comm_id = $_POST['comm_id'];
        $date = DateTime::createFromFormat('d/m/Y', $date);
        $date = $date->format('Y-m-d');
        $getEventData = $this->db->query("SELECT * FROM events WHERE community_id = '".$comm_id."' AND event_from_date = '".$date."'")->result_array();
        if(!empty($getEventData)) {
            $html = '';
            foreach ($getEventData as $event) {
                $from_date = date('d-m-Y h:i a', strtotime($event['event_from_date']." ".$event['event_from_time']));
                $to_date = date('d-m-Y h:i a', strtotime($event['event_to_date']." ".$event['event_to_time']));
                $date = $from_date." to ".$to_date." (".$event['event_repeat'].")";
                if($event['uploaded_by'] != '0') {
                    $user_details = $this->db->query("SELECT * FROM users WHERE id = '".$event['uploaded_by']."'")->row();
                    $full_name = $user_details->full_name;
                } else {
                    $full_name = "Admin";
                }
                $html .= '<li><p>Event Title: <span>'.$event['event_title'].'</span></p><p>Event Date: <span>'.$date.'</span></p>
                <p>Organized By: <span>'.$full_name.'</span>
                </p>
            </li>';
            }
        } else {
            $html = '<li>No Data found!</li>';
        }
        echo $html;
    }
}
