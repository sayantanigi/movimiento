<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Members extends AI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Commonmodel');
        $this->data['title'] = 'Members';
        $this->data['tab'] = 'members';
        $config['upload_path'] = './assets/images/profile';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);
    }
    public function index($page = 1) {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $show_per_page = 10000000;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Members';
        $this->data['tab'] = 'members';
        $this->data['main'] = admin_view('members/index');
        $members = $this->Master_model->getAll_members($offset, $show_per_page, 'users');
        $this->data['members'] = $members['results'];
        $config['base_url'] = admin_url('members/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $members['total'];
        $config['per_page'] = $show_per_page;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['use_page_numbers'] = true;
        $config['use_page_numbers'] = true;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'page';
        $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);
        $this->data['paginate'] = $this->pagination->create_links();
        $this->load->view(admin_view('default'), $this->data);
    }
    public function changeStatus() {
        if ($this->input->post('user_id')) {
            $userId = $this->input->post('user_id');
            $status = $this->input->post('status');
            if ($status == 1) {
                $msg = 'User account activated successfully!';
            } else {
                $msg = 'User account deactivated successfully!';
            }
            if ($this->Commonmodel->update_row('users', ['status' => $status], ['id' => $userId])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }
    public function changeUseremailverified() {
        if ($this->input->post('user_id')) {
            $userId = $this->input->post('user_id');
            $email_verified = $this->input->post('email_verified');
            if ($email_verified == 1) {
                $msg = 'Email verified';
            } else {
                $msg = 'Email unverified';
            }
            if ($this->Commonmodel->update_row('users', ['email_verified' => $email_verified], ['id' => $userId])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }
    function member_reply($id = false) {
        $this->data['detl'] = $detl = $this->db->get_where('users', array('id' => $id))->row();
        if ($cmnts = $this->input->post('cmnts')) {
            $arr = array(
                'rply_text' => $cmnts,
                'rply_status' => 1,
                'rply_date' => date("Y-m-d h:i:s")
            );
            $htmlContent = "<table align='center' style='width:650px; text-align:center; background:#8e88881f;'><tbody><tr style='height:50px;background-color:#ffeabf;'><td valign='middle' style='color:white;'><h2 class='start'>CCRC</h2></td></tr><tr><td valign='top' align='center' colspan='2'><table align='center' style='height:380px; color:#000; width:600px;'><tbody><tr><td style='width:8px;'>&nbsp;</td><td align='center' style='font-size:28px;border-top:1px dashed #ccc;' colspan='3'>Hello, " . $detl->fname . "</td></tr><tr><td valign='top' align='center' colspan='2'><p>" . $cmnts . "</p><br>Best Regards,<br>Makutano <br><br>This is an automated response, please DO NOT reply.</td></tr></tbody></table></td></tr></tbody></table>";
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from('Makutano Team');
            $this->email->to($detl->email);
            $this->email->subject('Cerificate Verification From Makutano');
            $this->email->message($htmlContent);
            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'Contact Successfully');
                $this->db->update('users', $arr, array('id' => $id));
                redirect(admin_url('members'));
            }
        }
    }

    public function add($id = false) {
        $this->data['tab'] = 'add_member';
        $this->data['main'] = admin_view('members/add');
        $this->data['member'] = $this->User_model->getNew();
        if ($id) {
            $this->data['title'] = 'Edit Member';
            $this->data['member'] = $pages = $this->User_model->getRow($id);

            if (!isset($pages)) {
                redirect(site_url('error_404'));
                exit();
            }
        } else {
            $this->data['title'] = 'Add Member';
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('full_name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
        }
        if ($this->form_validation->run()) {
            $email = $this->testInput($this->input->post('email'));
            $password = $this->testInput($this->input->post('password'));
            $status = $this->input->post('status');
            $userType = $this->input->post('userType');
            $currency = "USD";
            $currency_symbol = "$";
            $token = $this->generate_otp(6);
            $mydata = array(
                'currency' => @$currency,
                'currency_symbol' => @$currency_symbol,
                'full_name' => $this->testInput($this->input->post('full_name')),
                'email' => $this->testInput($this->input->post('email')),
                'phone' => $this->testInput($this->input->post('phone')),
                'token' => '',
                'created_at' => date("Y-m-d h:i:s"),
                'email_verified' => $status,
                'status' => $status,
                'userType' => $userType
            );
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
                    $fileData = $this->upload->data();
                    $mydata['image'] = $fileData['file_name'];
                }
            }
            if ($this->input->post('password') && $this->input->post('password') != '') {
                $mydata['password'] = base64_encode($this->input->post('password'));
            }
            $gn_user_id = $this->Commonmodel->add_details('users', $mydata);
            if ($gn_user_id) {
                $subject = 'Login Credential for Movimiento Latino University';
                $getOptionsSql = "SELECT * FROM `options`";
                $optionsList = $this->db->query($getOptionsSql)->result();
                $admEmail = $optionsList[8]->option_value;
                $address = $optionsList[6]->option_value;
                $message = "
                <body>
                    <div style='width: 600px; margin: 0 auto; background: #fff; border: 1px solid #e6e6e6'>
                        <div style='padding: 30px 30px 15px 30px; box-sizing: border-box'>
                            <img src='cid:Logo' style='width: 220px; float: right; margin-top: 0'>
                            <h3 style='padding-top: 45px;line-height: 20px;'>Greetings from<span style='font-weight: 900;font-size: 25px;color: #F44C0D;display: block'> Movimiento Latino University</span></h3>
                            <p style='font-size: 14px;'>Dear " . $this->testInput($this->input->post('full_name')) . ",</p>
                            <p style='font-size: 14px;'>You have successfully registered on <strong style='font-weight:bold;'>Movimiento Latino University</strong> by admin.</p>
                            <p style='font-size: 14px;margin: 0 0 18px 0;'>Please find the below login credential.</p>
                            <p style='font-size: 14px; margin: 0px;'>Email Address: <b>". $this->testInput($this->input->post('email'))."</b></p>
                            <p style='font-size: 14px; margin: 0px;'>Password: <b>".$this->input->post('password')."</b></p>
                            <p style='font-size:40px;'></p>
                            <p style='font-size: 14px;margin: 0;list-style: none'>Sincerly</p>
                            <p style='font-size: 12px; margin: 0px; list-style: none'><b>Movimiento Latino University</b></p>
                            <p style='font-size: 12px; margin: 0px; list-style: none'><b>Visit us:</b> <span>$address</span></p>
                            <p style='font-size: 12px; margin: 0px; list-style: none'><b>Email us:</b> <span>$admEmail</span></p>
                        </div>
                        <table style='width: 100%;'>
                            <tr>
                                <td style='height:30px;width:100%; background: red;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy;".date('Y')." Movimiento Latino University. All rights reserved.</td>
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
                    $mail->AddEmbeddedImage('uploads/logo/logo.PNG', 'Logo');
                    $mail->Body = $message;
                    $mail->IsSMTP();
                    //Send mail using GMAIL server
                    $mail->SMTPAuth   = true;
                    $mail->Host = 'localhost';
                    $mail->SMTPAuth = false;
                    $mail->SMTPAutoTLS = false;
                    $mail->Port = 25;
                    if (!$mail->send()) {
                        $msg = "Error sending: " . $mail->ErrorInfo;
                    } else {
                        $msg = '["New User added successfully!", "success", "#36A1EA"]';
                    }
                } catch (Exception $e) {
                    $msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                $msg = '["User with same role exist!", "error", "#e50914"]';
            }
            $this->session->set_flashdata('msg', $msg);
            // $this->session->set_flashdata("success", "New User added successfully!");
            redirect(admin_url('members'), 'refresh');
            // redirect(admin_url('members/add/' . $id));
        }
        $this->load->view(admin_view('default'), $this->data);
    }

    public function userUpdate($id = false) {
        $this->data['member'] = $pages = $this->User_model->getRow($id);
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
        if ($this->form_validation->run()) {
            $old_image = $this->input->post('old_image');
            $email = $this->testInput($this->input->post('email'));
            $password = $this->testInput($this->input->post('password'));
            $status = $this->input->post('status');
            $where = array('id' => $id);
            $mydata = array(
                'full_name' => $this->testInput($this->input->post('full_name')),
                'email' => $this->testInput($this->input->post('email')),
                'phone' => $this->testInput($this->input->post('phone')),
                'email_verified' => $status,
                'status' => $status
            );
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
            if ($this->input->post('usr_password') && $this->input->post('usr_password') != '') {
                $mydata['password'] = base64_encode($this->input->post('usr_password'));
            }
            $gn_user_id = $this->Commonmodel->update_row('users', $mydata, $where);
            if ($old_image && $_FILES['profile_image']['name'] != '') {
                if (file_exists('./uploads/profile_pictures/' . $old_image)) {
                    @unlink('./uploads/profile_pictures/' . $old_image);
                }
            }
            if ($gn_user_id) {
                $msg = '["User updated successfully!", "success", "#36A1EA"]';
            } else {
                $msg = '["User not updated"!, "error", "#e50914"]';
            }
        }
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('members'), 'refresh');
    }

    function activate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('members');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->User_model->save($c);
            $this->session->set_flashdata("success", "User activated successfully!");
        }
        redirect($redirect);
    }

    function deactivate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('members');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->User_model->save($c);
            $this->session->set_flashdata("success", "User deactivated successfully!");
        }
        redirect($redirect);
    }

    function delete($id) {
        if ($id > 0) {
            $this->User_model->delete($id);
            $this->session->set_flashdata('success', 'User deleted successfully ');
        }
        redirect(admin_url('members'));
    }

    public function deleteUsers($id = false) {
        $data = $this->User_model->getRow($id);
        if (@$data->image && file_exists('./uploads/profile_pictures/' . @$data->image)) {
            @unlink('./uploads/profile_pictures/' . @$data->image);
        }
        $this->User_model->delete($id);
        $msg = '["Deleted successfully.", "success", "#36A1EA"]';
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('members'));
    }

    function exportmember() {
        $resall = $this->db->get('users')->result();
        if (is_array($resall) && count($resall)) {
            foreach ($resall as $r) {
                if ($r->status == 1) {
                    $status = "Active";
                } else {
                    $status = "InActive";
                }
                $arr[] = array(
                    'full_name' => $r->full_name,
                    'email' => $r->email,
                    'phone' => $r->phone,
                    'status' => $status,
                    'created_at' => date('d-m-Y', strtotime($r->created_at))
                );
            }
        }
        $this->load->library("Excel");
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $table_columns = array("Full Name", "Email", "Phone No", "Status", "Created Date");
        $column = 0;
        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        $excel_row = 2;
        if (is_array($arr) && count($arr) > 0) {
            foreach ($arr as $row) {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['full_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['email']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['phone']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['status']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['created_at']);
                $excel_row++;
            }
        }
        $file = "exportmember.xls";
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $file);
        $object_writer->save('php://output');
    }
}