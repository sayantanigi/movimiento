<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Commonmodel');
        $this->load->model('mymodel');
    }

    public function index()
    {
        if ($this->session->has_userdata('p3_user_id') && $this->session->has_userdata('p3_users')):
            redirect(base_url('condo-list'),'refresh');
        endif;
        
              $data = array('page' => 'signin');
        if ($this->session->flashdata('msg')) {
            $data['msg'] = $this->session->flashdata('msg');
        }

        $f['id']=1;
        $data['data'] = $this->Commonmodel->GetData('about_us',$f);

        

        $this->load->view('p3-portal/login', $data);
    }

    public function activation()
    {
        $data = array('page' => 'activation');

        $encodeToken = $this->uri->segment(2);
        $token = base64_decode(urldecode( $encodeToken));
        $isTokenExistSql = "SELECT * FROM `users` WHERE `token` = '".$token."'";
		$isTokenExist = $this->db->query($isTokenExistSql)->num_rows();

        if($isTokenExist>0) {
            $usrData = $this->db->query($isTokenExistSql)->row();
            $email = $usrData->email;
            $user_id = $usrData->user_id;

            $data['user_id'] = $user_id;
            $data['email'] = $email;
            $data['token'] = $token;
        }

        $this->load->view('p3-portal/activation', $data);
    }

    public function activateUsr()
    {
        $email = $this->input->post('email');
        $user_id = $this->input->post('user_id');
        $token = $this->input->post('token');

        $password = $this->input->post('password');

        $isTokenExistSql = "SELECT * FROM `users` WHERE `token` = '".$token."' AND `email` = '".$email."' AND `user_id` = '".$user_id."'";
		$isTokenExist = $this->db->query($isTokenExistSql)->num_rows();

        if($isTokenExist>0) {
            $field_data = array(
                'token' => '',
                'password'=> md5($password),
                'status' => '1'
                );

            $where = array(
                'email' => $email,
                'user_id' => $user_id
                );

            $this->Commonmodel->edit_single_row('users', $field_data, $where);

            $this->session->set_userdata('p3_users', '1');
			$this->session->set_userdata('p3_user_id', @$user_id);

            $this->session->set_flashdata('success', 'Your Account is successfully activated!');
			redirect(base_url('condo-list'), 'refresh');
        
        } else {
            $this->session->set_flashdata('error', 'Sorry, You have not permission for activating the account!');
            redirect(base_url('account-activation/'.urlencode(base64_encode($token))), 'refresh');
        }
    }

    public function login_check()
    {

        $username = $this->input->post('username');

        if ($username) {
            $username = $this->input->post('username');
            echo $this->usermodel->emailExist($username);
             
        } else {
            echo "0";
        }
    }

    public function verify_user()
    {

        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $phone_number_full = $this->input->post('phone_number_full');
        $password = $this->input->post('password');
        $submit = $this->input->post('submit');

        if ($email || $mobile && $password && $submit) {

            if($submit=="emailLogin") {
                echo $this->usermodel->p3EmailLogin($email, $password);
            } else {
                echo $this->usermodel->p3PhoneLogin($mobile, $phone_number_full, $password);
            }
             
        } else {
            echo "0";
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('users');
        $msg = '<div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>
                        <i class="fa fa-check-circle-o"></i>
                    </strong>
                    You have successfully logout!
                </div>';
        $this->session->set_flashdata('msg', $msg);
        redirect(base_url('login'),'refresh');
    }


   



}
