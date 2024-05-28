<?php
class Dashboard extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['header'] = '';
        $this->admin_login();
    }
    public function index()
    {
        $this->data['main'] = admin_view('index');
        $this->data['title'] = 'Dashboard';
        $this->data['tab'] = 'dashboard';
        $this->data['course'] = $this->db->get_where('courses',array('status'=>'1'))->num_rows();
        $this->data['contacts'] = $this->db->get('contacts')->num_rows();
        $this->data['trans'] = $this->db->get('orders')->num_rows();
		$this->load->view(admin_view('default'),$this->data);
       
    }

}
