<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Login extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Commonmodel');
        $this->load->model('mymodel');
        require 'vendor/autoload.php';
    }
    public function index() {
        if ($this->session->has_userdata('user_id') && $this->session->has_userdata('users')){
            redirect(base_url('condos'), 'refresh');
        }
        $data = array('page' => 'login');
        if ($this->input->post('username')) {
            $this->form_validation->set_rules('username', 'Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run() == false) {
                $msg = '';
                if (form_error('username')) {
                    $msg .= strip_tags(form_error('username'));
                }
                if (form_error('password')) {
                    $msg .= strip_tags(form_error('password'));
                }
                $data['msg'] = '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-check-circle-o"></i></strong>'.$msg.'</div>';
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $data['msg'] = '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-check-circle-o"></i></strong>' . $this->usermodel->userLogin($username, $password) . '</div>';
                if ($this->session->has_userdata('user_id') && $this->session->has_userdata('users')) {
                    if ($this->input->get('redirectto')) {
                        redirect(urldecode($this->input->get('redirectto')), 'refresh');
                    } else {
                        redirect(base_url('condos'), 'refresh');
                    }
                }
            }
        }
        if ($this->session->flashdata('msg')) {
            $data['msg'] = $this->session->flashdata('msg');
        }
        $this->load->view('login', $data);
    }
    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('users');
        $msg = '<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong> <i class="fa fa-check-circle-o"></i> </strong> You have successfully logout! </div>';
        $this->session->set_flashdata('msg', $msg);
        redirect(base_url('login'), 'refresh');
    }
    public function sendOtp($portal = "p3") {
        $email = $username = $this->input->post('email_id');
        if ($portal == "p2") {
            $f = $this->usermodel->emailExistP2($username);
        } else {
            $f = $this->usermodel->emailExist($username);
        }
        if ($f == 0) {
            echo '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-check-circle-o"></i></strong>Invalid EmailId</div>';
        } elseif ($f == 2) {
            echo '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-check-circle-o"></i></strong>Your account has been deactivated. Please contact master admin for details.</div>';
        } elseif ($f == 3) {
            echo '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-check-circle-o"></i></strong>Permission denied. Please contact master admin!</div>';
        } elseif ($f == 1) {
            $otp = $this->generate_otp(7);
            $mydata = array(
                'otp' => $otp,
            );
            $where = array(
                'email' => $email
            );
            $update = $this->Commonmodel->edit_single_row('users', $mydata, $where);
            if ($update) {
                $mail = new PHPMailer(true);
                $subject = "OTP from condoadmin";
                $msg = "<b>$otp</b> is your One Time Password to change your account password.";
                $message = "$otp use otp for changing condoadmin password";
                $message = '<body style="background:#2a2a2a;font-family: sans-serif;"><div style="text-align: center;width: 45%; margin: 0 auto; background: #fff;"><img src="' . base_url('images/logo-black.png') . '" alt="" style="width: 100px;margin-top: 10px;"><div style="margin-top: 30px;"><h2>Welcome to <a style="color: #39b54a;">Condo Admin!</a></h2></div><div style="margin-top: 30px;"><p> ' . $msg . '</p></div><div style="margin-top: 30px;"><h3 style="color: #3a3a3a;font-weight: 500;font-size: 22px;">Please <a href="' . base_url() . '" style="color: #39b54a;text-decoration: none;">login</a> to your acoount</h3></div><div style="width: 50%;border-bottom: 2px solid #39b54a;padding: 40px 0px;margin: 0 auto;"><p style="margin: 0;font-weight: 600;color: #3a3a3a;">Sincerly,</p><p style="margin: 0;margin-top: 5px;font-weight: 600;color: #3a3a3a;">The CondoAdmin Team</p></div><div style="margin-top: 40px;"><h2><a style="color: #39b54a;">Condo Living</a> Made Easy</h2></div><div style="margin-top: 20px; padding-bottom: 20px;"><p style="font-size:15px;">© 2022 CondoAdmin Canada | <a href="" style="color: #000;text-decoration: none;">Terms and Conditions</a> | <a href="" style="color: #000;text-decoration: none;">Privacy Policy</a></p></div></div></body>';
                try {
                    //Server settings
                    $mail->CharSet = 'UTF-8';
                    $mail->SetFrom('support@makutano.com', 'makutano');
                    $mail->AddAddress($email);
                    $mail->IsHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body = $message;
                    //Send email via SMTP
                    $mail->IsSMTP();
                    $mail->send();
                } catch (Exception $e) {
                    $this->session->set_flashdata('error_message', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                }
                echo '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-check-circle-o"></i></strong>OTP sent to email id.</div>';
            }
        }
    }
    public function editusrPassword() {
        if ($this->input->post('otp')) {
            $email = $this->input->post('email');
            $otp = $this->input->post('otp');
            $user_data = $this->mymodel->get('users', true, 'email', $email);
            if (!empty($user_data) && $user_data->otp == $otp) {
                $where = array(
                    'user_id' => @$user_data->user_id
                );
                $mydata = array(
                    'otp' => "",
                    'password' => md5($this->input->post('password'))
                );
                $this->Commonmodel->edit_single_row('users', $mydata, $where);
                $msg = '["Password updated successfully!", "success", "#36A1EA"]';
                $msg = '1';
            } else {
                $msg = '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-check-circle-o"></i></strong>Plese insert valid OTP and Email Id.</div>';
            }
        } else {
            $msg = '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-check-circle-o"></i></strong>Some error occured, Please try again!</div>';
        }
        echo $msg;
    }
}
