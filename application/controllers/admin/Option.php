<?php

class Option extends Admin_Controller
{
    var $global;

    function __construct()
    {
        parent::__construct();
        $this->data['active_tabs'] = 'media';
        $this->load->model('master_model');
        $this->load->model('Option_model');
        $this->data['title'] = 'Our Solution';
        $this->data['tab'] = 'option';
    }

    public function index()
    {
        $this->data['main'] = admin_view('setting/option');
        $this->data['options'] = $this->Option_model->all_options();
        $this->data['tab'] = 'option';
        if ($this->input->post('submit')) {
            $fields = $this->input->post('fields');
            $arr_fields = explode(',', $fields);
            if (is_array($arr_fields) AND count($arr_fields) > 0) {
                foreach ($arr_fields as $fname) {
                    $fname = trim($fname);
                    $s['option_name'] = $fname;
                    $s['option_value'] = $this->input->post($fname);
                    $this->Option_model->save_option($s);
                }
                $this->session->set_flashdata('success', 'Seo updated successfully');
            }
            redirect(admin_url('option'));
        } else {
            $this->load->view(admin_view('default'), $this->data);
        }
    }


    function seo_url($offset = 0)
    {
        $this->data['offset'] = $offset;
        $show_per_page = 40;
        $this->data['main'] = admin_view('setting/url-index');
        $data = $this->Option_model->seo_urls($offset, $show_per_page);
        $this->data['urls'] = $data['data'];
        $config['base_url'] = admin_url('settings/seo-url');
        $config['num_links'] = 4;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $data['total'];
        $config['per_page'] = $show_per_page;
        $config['full_tag_open'] = '<ul class="pagination pmagination-sm">';
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
        $this->pagination->initialize($config);
        $this->data['paginate'] = $this->pagination->create_links();
        $this->load->view(admin_view('default'), $this->data);
    }


    function seo_setting($id =false) {
        $this->data['page_title'] = "Seo Setting";
        $this->data['menu2'] = "Setting";
        $this->data['menu3'] = "Seo Setting";
        $this->data['main'] = admin_view('setting/seo_setting');

        $this->data['s'] = $this->Master_model->getNew('seo_url');


        if($id != '')
        {

            $this->data['s'] = $this->Master_model->getRow($id, 'seo_url');

        }

        if($this->input->post('frm[url]'))
        {
            $save = $this->input->post('frm');
            $save['id'] = $id;
            $id = $this->Master_model->save($save, 'seo_url');
            $this->session->set_flashdata('success', 'Data saved successfully');
            redirect(site_url('settings/seo-setting').$id);
        }
        //print_r($data);die;

        $this->load->view(admin_view('default'), $this->data);
    }

    function edit_url($id = false)
    {
        $this->data['main'] = admin_view('setting/add-url');
        $this->data['url'] = array('id' => $id, 'url' => '', 'seo_title' => '', 'seo_description' => '', 'seo_keywords' => '', 'h1_heading' => '', 'small_desc' => '');
        if ($id) {
            $this->data['url'] = $this->Option_model->url($id);
        }
        $this->form_validation->set_rules('url', 'URL', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view(admin_view('default'), $this->data);
        } else {
            $save['id'] = $id;
            $url = $this->input->post('url');
            $save['url'] = rtrim($url, '/');
            $save['seo_title'] = $this->input->post('seo_title');
            $save['seo_description'] = $this->input->post('seo_description');
            $save['seo_keywords'] = $this->input->post('seo_keywords');
            $save['h1_heading'] = $this->input->post('h1_heading');
            $save['small_desc'] = $this->input->post('small_desc');
            $id = $this->Option_model->save_url($save);
            $this->session->set_flashdata('success', 'SEO URL and details saved successfully');
            redirect(admin_url('settings/seo-url'));
        }
    }

    function delete_url($id = false)
    {
        if ($id) {
            $this->Option_model->url_delete($id);
            $this->session->set_flashdata('success', 'SEO URL and details deleted successfully');
        }
        redirect(admin_url('settings/seo-url'));
    }

    function restore()
    {
        $this->db->truncate('options');
        $this->session->set_flashdata('success', 'Global Setting reset to Default');
        redirect(admin_url('settings'));
    }

    function sql()
    {
        $this->data['main'] = admin_view('setting/sql');
        if ($this->input->post('sql')) {
            $sql = $this->input->post('sql');
            $this->db->query($sql);
            $this->session->set_flashdata("success", "SQL Executed");
            redirect(admin_url('settings/sql'));
        }
        $this->load->view(admin_view('default'), $this->data);
    }

    function mail()
     
    {
        $this->data['main'] = admin_view('setting/write-mail');
         if ($this->input->post('submit')) {
           
           echo $name = $this->input->post('name');
           echo $email = $this->input->post('email');
           echo $sub = $this->input->post('subject');
           echo $des = $this->input->post('message');

             $this->email->set_mailtype("html");
            $this->load->library('email');

            $txt = $this->email->from('webmail@igi.com','');
            $txt = $this->email->to($email);
            $txt = $this->email->subject($sub);
            $txt = $this->email->message('name: &nbsp;' . $name . '<br> email:&nbsp;' . $email . '<br> message: &nbsp;' . $des);
        
            $mail = $this->email->send();
            if($mail ==true){
            $this->session->set_flashdata('success', "Your Email Sent Successfully");

            }
            else{
                $this->session->set_flashdata('error', "Oops ! you cant send message.");
            }
           redirect(admin_view('settings/mail'));

        }
            $this->load->view(admin_view('default'), $this->data);
    
    }

    public function change_password()
    {


        $this->data['main'] = admin_view('admin/password');

        $this->form_validation->set_rules('old', 'Old Password', 'trim|required');
        $this->form_validation->set_rules('new', 'New Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[new]');
        if ($this->form_validation->run() == TRUE) {
           
          $old = md5($this->input->post('old'));
          $new = md5($this->input->post('new'));
           $user = $this->session->userdata('userid');
           $check = $this->db->get_where('admin',array('id'=>$user))->row();
          
          if ($old==$check->password) {
            $arr = array(
              'password'=>$new
            );
            $this->db->where('id', $user);
            $this->db->update('admin', $arr);
            $this->session->set_flashdata('success', 'Password changed');
          }else{
            $this->session->set_flashdata('error', 'Old password not matched');
          }
        }
        $this->load->view(admin_view('default'), $this->data);
    }

}