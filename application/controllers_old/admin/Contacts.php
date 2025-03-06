<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->admin_login();
		require 'vendor/autoload.php';
    }

	public function index($page=1) {
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		$show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Contact User Lists';
        $this->data['tab'] = 'contacts';
        $this->data['main'] = admin_view('contact/index');
        $contact = $this->Master_model->getAll($offset, $show_per_page,'contacts');

        $this->data['contacts'] = $contact['results'];
        $config['base_url'] = admin_url('contact/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $contact['total'];
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
		$this->load->view(admin_view('default'),$this->data);

	}

    function delete($id){
        if ($id > 0) {
            $this->Master_model->delete($id,'contacts');
            $this->session->set_flashdata('success', 'row deleted successfully.');
        }
        redirect(admin_url('contacts'));
    }

    public function certificate_apply($page=1) {
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Students Applied For certificate';
        $this->data['tab'] = 'cert_apply';
        $this->data['main'] = admin_view('contact/cert_applied');
        $contact = $this->Master_model->getAll($offset, $show_per_page,'cert_payments');

        $this->data['contacts'] = $contact['results'];
        $config['base_url'] = admin_url('contact/certificate_apply');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $contact['total'];
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
        $this->load->view(admin_view('default'),$this->data);

    }

    function contacts_reply($id=false){
        $this->data['detl']= $detl=$this->db->get_where('contacts',array('id'=>$id))->row();
        if($cmnts=$this->input->post('cmnts')){
            $arr=array('rply_text'=>$cmnts,'rply_status'=>1,'rply_date'=>date("Y-m-d h:i:s"));
            $getOptionsSql = "SELECT * FROM `options`";
            $optionsList = $this->db->query($getOptionsSql)->result();
            $address = $optionsList[6]->option_value;
            $admEmail = $optionsList[8]->option_value;
            $imagePath = base_url().'uploads/logo/'.$optionsList[0]->option_value;
            $htmlContent = "<table style='width=100%;border=0;align=center;cellpadding=0;cellspacing=0'><tbody><tr><td><table class='col-600' style='margin-left:20px;margin-right:20px;border-left:1px solid #dbd9d9;border-right:1px solid #dbd9d9;border-top:2px solid #232323;width=600px;border=0;align=center;cellpadding=0;cellspacing=0'><tbody><tr><td align='left' style='padding:5px 10px;font-family:Raleway,sans-serif;font-size:16px;font-weight:700;color:#2a3a4b'><img src='".$imagePath."' style='max-height: 40px;'></td></tr></tbody></table></td></tr><tr><td align='center'><table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px;margin-right:20px;border-left:1px solid #dbd9d9;border-right:1px solid #dbd9d9;border-bottom:2px solid #232323'><tbody><tr><td align='left' style='padding:5px 10px;font-family:Lato,sans-serif;font-size:16px;color:#444;line-height:24px;font-weight:400'></td></tr><tr><td align='center' style='font-size:28px;border-top:1px dashed #ccc;' colspan='3'>Hello, ".$detl->fname."</td></tr><tr><td align='left' style='padding:5px 10px;font-family:Lato,sans-serif;font-size:16px;color:#444;line-height:24px;font-weight:400'><p style='background:#232323;color:#fff;padding:10px;text-decoration:none;line-height:24px'>".$cmnts."</p></td></tr><tr><td height='30'></td></tr><tr><td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:16px; color:#232323; line-height:24px; font-weight: 700;'>Thank you!</td></tr><tr><td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>Sincerely</td></tr><tr><td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>Movimiento</td></tr></tbody></table></td></tr></tbody></table>";
            $htmlContent = "<body>
                <div style='width: 600px; margin: 0 auto; background: #fff; border: 1px solid #e6e6e6'>
                    <div style='padding: 30px 30px 15px 30px; box-sizing: border-box'>
                        <img src='cid:Logo' style='width: 220px; float: right; margin-top: 0'>
                        <h3 style='padding-top: 45px;line-height: 20px;'>Greetings from<span style='font-weight: 900;font-size: 25px;color: #F44C0D;display: block'> Movimiento Latino University</span></h3>
                        <p style='font-size: 14px;'>Dear ".$detl->fname.",</p>
                        <p style='font-size: 18px;'></p>
                        <div style='font-size: 18px; margin: 30px 0;'>".$cmnts."</div>
                        <p style='font-size: 18px; margin: 0px; list-style: none'>Sincerly</p>
                        <p style='font-size: 12px; margin: 0px; list-style: none'><b>Movimiento</b></p>
                        <p style='font-size: 12px; margin: 0px; list-style: none'><b>Visit us:</b> <span>$address</span></p>
                        <p style='font-size: 12px; margin: 0px; list-style: none'><b>Email us:</b> <span>$admEmail</span></p>
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
                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom('support@movimientolatinouniversity.com', 'Movimiento Latino University');
                $mail->AddAddress($detl->email);
                $mail->IsHTML(true);
                $mail->AddEmbeddedImage('uploads/logo/'.$optionsList[0]->option_value, 'Logo');
                $mail->Subject = 'Reply Message From Movimiento Latino University';
                $mail->Body = $htmlContent;
                $mail->IsSMTP();
                /*$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->SMTPOptions = array(
                        'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 587; //587 465
                $mail->Username = 'support@movimientolatinouniversity.com';
                $mail->Password = 'hwulwujqxokpilbi';*/
                $mail->Host = 'localhost';
                $mail->SMTPAuth = false;
                $mail->SMTPAutoTLS = false;
                $mail->Port = 25;
                $mail->send();
                // echo 'Message has been sent';
            } catch (Exception $e) {
                $this->session->set_flashdata('error_message', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            }
            $this->session->set_flashdata('success', 'Replied Successfully');
            $this->db->update('contacts',$arr,array('id'=>$id));
            redirect(admin_url('contacts'));
        }
    }

    public function view_review($page=1) {
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Rating User Lists';
        $this->data['tab'] = 'rv_cont';
        $this->data['main'] = admin_view('contact/review_index');
        $contact = $this->Master_model->getAll($offset, $show_per_page,'review');

        $this->data['contacts'] = $contact['results'];
        $config['base_url'] = admin_url('contact/view_review');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $contact['total'];
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
        $this->load->view(admin_view('default'),$this->data);

    }

    function review_reply($id=false){
        $this->data['detl']= $detl=$this->db->get_where('review',array('id'=>$id))->row();
        $userd= $this->db->get_where('users',array('id'=>$detl->userid))->row();
        if($cmnts=$this->input->post('cmnts')){
            $arr=array('rply_text'=>$cmnts, 'rply_status'=>1, 'rply_date'=>date("Y-m-d h:i:s"));
            $getOptionsSql = "SELECT * FROM `options`";
            $optionsList = $this->db->query($getOptionsSql)->result();
            $imagePath = base_url().'uploads/logo/'.$optionsList[0]->option_value;
            $htmlContent = "<table style='width=100%;border=0;align=center;cellpadding=0;cellspacing=0'><tbody><tr><td><table class='col-600' style='margin-left:20px;margin-right:20px;border-left:1px solid #dbd9d9;border-right:1px solid #dbd9d9;border-top:2px solid #232323;width=600px;border=0;align=center;cellpadding=0;cellspacing=0'><tbody><tr><td align='left' style='padding:5px 10px;font-family:Raleway,sans-serif;font-size:16px;font-weight:700;color:#2a3a4b'><img src='".$imagePath."' style='max-height: 40px;'></td></tr></tbody></table></td></tr><tr><td align='center'><table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px;margin-right:20px;border-left:1px solid #dbd9d9;border-right:1px solid #dbd9d9;border-bottom:2px solid #232323'><tbody><tr><td align='left' style='padding:5px 10px;font-family:Lato,sans-serif;font-size:16px;color:#444;line-height:24px;font-weight:400'></td></tr><tr><td align='center' style='font-size:28px;border-top:1px dashed #ccc;' colspan='3'>Hello, ".$userd->fname."</td></tr><tr><td align='left' style='padding:5px 10px;font-family:Lato,sans-serif;font-size:16px;color:#444;line-height:24px;font-weight:400'><p style='background:#232323;color:#fff;padding:10px;text-decoration:none;line-height:24px'>".$cmnts."</p></td></tr><tr><td height='30'></td></tr><tr><td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:16px; color:#232323; line-height:24px; font-weight: 700;'>Thank you!</td></tr><tr><td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>Sincerely</td></tr><tr><td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>Movimiento Latino University</td></tr></tbody></table></td></tr></tbody></table>";
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom('support@movimientolatinouniversity.com', 'Movimiento Latino University');
                $mail->AddAddress($userd->email);
                $mail->IsHTML(true);
                $mail->Subject = "Reply Message From Movimiento Latino University";
                $mail->Body = $htmlContent;
                //Send email via SMTP
                $mail->IsSMTP();
                /*$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->SMTPOptions = array(
                        'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 587; //587 465
                $mail->Username = 'support@movimientolatinouniversity.com';
                $mail->Password = 'hwulwujqxokpilbi';*/
                $mail->Host = 'localhost';
                $mail->SMTPAuth = false;
                $mail->SMTPAutoTLS = false;
                $mail->Port = 25;
                $mail->send();
                // echo 'Message has been sent';
            } catch (Exception $e) {
                $this->session->set_flashdata('error_message', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            }
            $this->session->set_flashdata('success', 'Thanks! Your enrollment is successfull.');
        }
    }

    public function certificate_review($page=1) {
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Certificate Verification User Lists';
        $this->data['tab'] = 'cert_contacts';
        $this->data['main'] = admin_view('contact/cert_verification');
        $contact = $this->Master_model->getAll($offset, $show_per_page,'cert_verify');

        $this->data['contacts'] = $contact['results'];
        $config['base_url'] = admin_url('contact/certificate_review');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $contact['total'];
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
        $this->load->view(admin_view('default'),$this->data);
    }

    public function stay_with_us($page=1) {
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Stay in Touch User Lists';
        $this->data['tab'] = 'contacts_stay';
        $this->data['main'] = admin_view('contact/stay_index');
        $contact = $this->Master_model->getAll($offset, $show_per_page,'consulting_form');

        $this->data['contacts'] = $contact['results'];
        $config['base_url'] = admin_url('contact/stay_with_us');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $contact['total'];
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
        $this->load->view(admin_view('default'),$this->data);

    }

    function stay_delete($id){
       if ($id > 0) {
            $this->Master_model->delete($id,'consulting_form');
            $this->session->set_flashdata('success', 'row deleted successfully.');
        }
        redirect(admin_url('contacts/stay_with_us'));
    }
}

/* End of file Contacts.php */
/* Location: ./application/controllers/admin/Contacts.php */