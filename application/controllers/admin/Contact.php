<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Contact extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->Adminmodel->loggedIn();
    }
    public function index() {
        $data = array(
            'title' => 'Manage Contact',
            'page' => 'Contact List',
            'subpage' => 'contact'
        );
        $data['contact_list'] = $this->Adminmodel->get_all_record('*', 'contact', '', array('id', 'DESC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/contact/contact_list');
        $this->load->view('admin/footer');
    }
    function reply_contact() {
        $contact_id = $_POST["contact_id"];
        $recipient = $_POST["recipient"];
        $message = $_POST["message"];
        $data = array(
            'reply_text' => $message,
            'reply_status' => '1'
        );
        $result = $this->Adminmodel->update($data, 'contact', array('id' => $contact_id));
        if ($result) {
            $get_setting = $this->db->query("SELECT * FROM settings WHERE settingId = '1'")->row();
            if(!empty($get_setting->smtp_host)) {
                $message = "<body>
                    <div style='width:600px;margin: 0 auto;background: #fff; border: 1px solid #e6e6e6;'>
                        <div style='padding: 30px 30px 15px 30px;box-sizing: border-box;'>
                            <img src='cid:Logo' style='width:100px;float: right;margin-top: 0 auto;'>
                            <h3 style='padding-top:40px; line-height: 30px;'>Greetings from <span style='font-weight: 900;font-size: 35px, color: #2892ff; display: block;'>$get_setting->title</span></h3><p style='font-size: 15px;'>Hello Admin,</p>
                            <p style='font-size: 15px;'>Hope you are doing well.</p>
                            <p style='font-size: 15px; padding: 0; margin: 0;'>".$message."</p>
                            <p style='font-size: 15px; padding: 0; margin: 18px 0 0 0;'>Thank you!</p>
                            <p style='font-size:20px;list-style: none;'>Sincerly</p>
                            <p style='list-style: none;'><b>$get_setting->title</b></p>
                            <p style='list-style:none;'><b>Visit us:</b> <span>$get_setting->address</span></p>
                            <p style='list-style:none'><b>Email us:</b> <span>$get_setting->email</span></p>
                        </div>
                        <table style='width: 100%;'>
                            <tr>
                                <td style='height:30px;width:100%; background: #2892ff;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy; <?=date('Y')?> $get_setting->title. All rights reserved.</td>
                            </tr>
                        </table>
                    </div>
                </body>";
                require 'vendor/autoload.php';
                $mail = new PHPMailer(true);
                try {
                    $mail->CharSet = 'UTF-8';
                    $mail->SetFrom($get_setting->email, $get_setting->title);
                    $mail->AddAddress($recipient);
                    $mail->IsHTML(true);
                    $mail->Subject = 'New Message from '. $get_setting->title;
                    $mail->AddEmbeddedImage('uploads/logo/'.$get_setting->logo, $get_setting->title);
                    $mail->Body = $message;
                    $mail->IsSMTP();
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Host = $get_setting->smtp_host;
                    $mail->Port = $get_setting->smtp_port; //587 465
                    $mail->Username = $get_setting->smtp_email;
                    $mail->Password = $get_setting->smtp_pass;
                    if(!$mail->send()) {
                        $data = array('status' => 'success', 'data' => "Replied successfully.");
                    } else {
                        $data = array('status' => 'success', 'data' => "Your message could not be sent. Please, try again later.");
                    }
                } catch (Exception $e) {
                    $data = array('status' => 'error', 'data' => "Something went wrong. Please try again later!");
                }
            } else {
                $data = array('status' => 'success', 'data' => "Replied successfully.");
            }
            $data = array('status' => 'success', 'message' => "Replied successfully.");
        } else {
            $data = array('status' => 'error', 'message' => "Some error occured, Please try again!");
        }
        echo json_encode($data);
    }
    function delete($id) {
        if (empty($id)) {
            return false;
        }
        $result = $this->db->query('delete from faq where id = ' . $id . '');
        if ($result) {
            $msg = '["faq deleted successfully.", "success", "#A5DC86"]';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/faq'), 'refresh');
        } else {
            $msg = 'error';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/faq'), 'refresh');
        }
    }
}
