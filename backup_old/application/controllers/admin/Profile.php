<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->admin_login();
		$this->data['title'] = 'Change Password';
        $this->data['tab'] = 'change_password';
	}

	public function index()
	{
		$aid= $this->session->userdata('userid');
		$this->data['rsid'] = $this->db->get_where('admin',array('id'=>$aid,'status'=>1))->row();
		$this->data['main'] = admin_view('users/change_password'); 
		$this->form_validation->set_rules('old_password', 'Old Password', 'required');
		$this->form_validation->set_rules('new_password', 'New Password', 'required');
		$this->form_validation->set_rules('retype_password', 'Re-type Password', 'required');
		if ($this->form_validation->run()) {
			$unm = $this->input->post('uname');
			$old = $this->input->post('old_password');
			$new = $this->input->post('new_password'); 
			$confirm = $this->input->post('retype_password');
			$check = $this->admin_model->checkpass($old);
			if($check > 0){
				if($new != $confirm){
					$this->session->set_flashdata('error', 'New Password and Confirm Password is not matched!');
					redirect(admin_url('profile'));
				}
				else{
					$new_password = md5($new);
					$this->db->where('id',$_SESSION['userid']);
					$this->db->update('admin',array('username'=>$unm,'password'=>$new_password));
					$this->session->set_flashdata('success', 'Password Changed Successfully!');
					redirect(admin_url('profile'));
				}
			}
			else{
				$this->session->set_flashdata('error', 'Old Password is not correct!');
				redirect(admin_url('profile'));	
			}
		} 
		$this->load->view(admin_view('default'),$this->data);
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/admin/Profile.php */