<?php
ob_start();
error_reporting(0);
class Community extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library(array('form_validation', 'session'));
		if ($this->session->userdata('isLoggedIn') != 1) {
			redirect('login', 'refresh');
		}
		$this->load->model('Community_model');
		$this->load->library('form_validation');
		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->library('image_lib');

	}
	public function index() {
		$user = $this->session->userdata('user_id');
		$data['community'] = $this->db->get_where('community', array('uploaded_by' => $user, 'is_delete' => '1'))->result();
		$data['title'] = "Community List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/community/community_list', $data);
		$this->load->view('supercontrol/footer');
	}
    public function add_community($id = false) {
		if ($id) {
            $data['title'] = 'Update Community';
            $data['community'] = $community_v = $this->Community_model->getRow($id);
            if (!isset($community_v)) {
                show_404();
                exit();
            }
        }
        $this->form_validation->set_rules('frm[title]', 'Title title', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $slug = $this->input->post('frm[title]');
            if (empty($slug) || $slug == '') {
                $slug = $this->input->post('title');
            }
            $formdata['slug'] = strtolower(url_title($slug));
            $formdata['id'] = $id;
            $formdata['uploaded_by'] = $this->session->userdata('user_id');
            /*if(!empty($this->input->post('cat_id',TRUE))){
                $formdata['cat_id'] = implode(", ",$this->input->post('cat_id',TRUE));
            } else {
                $formdata['cat_id'] = '';
            }*/
            $id = $this->Community_model->save($formdata);
            $this->session->set_flashdata("success", "Community saved successfully");
            redirect(base_url('supercontrol/community'));
        }
		$data['community_cat'] = $this->db->query("SELECT * FROM community_cat WHERE status = '1' AND is_delete = '1'")->result_array();
        $data['course_list'] = $this->db->query("SELECT * FROM courses WHERE status = '1' AND (assigned_instrustor IS NOT NULL OR user_id != '')")->result_array();
        $data['title'] = 'Community Category List';
        $data['tab'] = 'add_comm';
        $this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/community/add_community', $data);
		$this->load->view('supercontrol/footer');
    }
    public function community_cat_list($id = false){
        $data['categories'] = $this->db->query("SELECT * FROM community_cat WHERE status = '1' AND is_delete = '1'")->result();
        $data['title'] = 'Community Category List';
        $data['tab'] = 'add_comm';
        $this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/community/category_list', $data);
		$this->load->view('supercontrol/footer');
    }
    public function add_community_cat($id = false){
        $my_date = date("Y-m-d", time());
        if(!empty($this->input->post())) {
            $data = array(
				'category_name' => $this->input->post('category_name'),
				'category_subtitle' => $this->input->post('category_subtitle')
			);
			$result = $this->db->insert('community_cat', $data);
			if($result) {
                $data['success_msg'] = '<div class="alert alert-success text-center">Data Added Successfully!</div>';
                redirect('supercontrol/community/community_cat_list', 'refresh');
            }
        }
        $data['title'] = 'Add Community Category';
        $data['tab'] = 'add_comm';
        $this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/community/add_category', $data);
		$this->load->view('supercontrol/footer');
    }
    function show_community_cat_id($id) {
		$data['title'] = "Edit Community";
		$data['eallcat'] = $this->db->query("SELECT * FROM community_cat WHERE id = '".$id."'")->row();
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/community/edit_category', $data);
		$this->load->view('supercontrol/footer');
	}

    function edit_community_cat($id = false) {
		$datalist = array(
			'category_name' => $this->input->post('category_name')
		);
		$data['title'] = "Category Edit";
		$this->db->where('id', $id);
        $query = $this->db->update('community_cat', $datalist);
		$data1['message'] = 'Updated Successfully';
		$this->session->set_flashdata('success', 'Data Updated Successfully !!!');
		redirect('supercontrol/community/community_cat_list', $data1);
	}
    function delete_cominity_cat($id) {
		$query = $this->db->query("SELECT * FROM community_cat WHERE id = '".$id."'")->num_rows();
		if ($query > 0) {
			$this->db->query("DELETE FROM community_cat WHERE id = '".$id."'");
			$data2['message'] = 'Deleted Successfully';
			$data['title'] = "Category Page List";
			$data['eloca'] = $query;
			$data['title'] = "Category Page List";
			$this->session->set_flashdata('success', 'Data Deleted !!!!');
			redirect('supercontrol/community/community_cat_list', TRUE);
		} else {
			$this->session->set_flashdata('success', 'You Can Not Delete A Parent Category');
			redirect('supercontrol/community/community_cat_list', TRUE);
		}
	}
    function activate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : base_url('supercontrol/community/');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Community_model->save($c);
            $this->session->set_flashdata("success", "Community activated");
        }
        redirect($redirect);
    }
    function deactivate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : base_url('supercontrol/community/');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Community_model->save($c);
            $this->session->set_flashdata("success", "Community deactivated");
        }
        redirect($redirect);
    }
	function delete($id) {
        if ($id > 0) {
            $this->Community_model->delete($id);
            $this->session->set_flashdata('success', 'Community deleted successfully ');
        }
        redirect(base_url('supercontrol/community'));
    }
	public function Logout() {
		$this->session->sess_destroy();
		redirect('supercontrol/login');
	}
    public function add_event($com_id = false, $id = false) {
        $this->data['title'] = 'Add Community Event';
        $this->data['tab'] = 'add_comm_evnt';
        $this->data['main'] = admin_view('community/add_event');
        if ($id) {
            $this->data['title'] = 'Update Community Event';
            $this->data['event'] = $event_v = $this->db->query("SELECT * FROM events WHERE id = '".$id."'")->row();
            if (!isset($event_v)) {
                show_404();
                exit();
            }
        }
        $this->form_validation->set_rules('frm[event_title]', 'Title title', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $slug = $this->input->post('frm[event_title]');
            if (empty($slug) || $slug == '') {
                $slug = $this->input->post('event_title');
            }
            $formdata['slug'] = strtolower(url_title($slug));
            $formdata['uploaded_by'] = $this->session->userdata('user_id');
            $formdata['created_at'] = date('Y-m-d h:i s');
            if ($id) {
                //print_r($formdata); die();
                $this->db->where('id', $id);
                $id = $this->db->update('events',$formdata);
                $this->session->set_flashdata("success", "Event updated successfully");
            } else {
                //print_r($formdata); die();
                $id = $this->db->insert('events',$formdata);
                $this->session->set_flashdata("success", "Event saved successfully");
            }
            redirect(base_url('supercontrol/community/event_list/'.$com_id));
        }
        $this->load->view('supercontrol/header', $this->data);
		$this->load->view('supercontrol/community/add_event', $this->data);
		$this->load->view('supercontrol/footer');
    }
    public function event_list($comm_id){
        $this->data['title'] = 'Community Event List';
        $this->data['tab'] = 'community';
        $this->data['main'] = admin_view('community/event_index');
        $this->data['event_list'] = $this->db->query("SELECT * FROM events WHERE community_id = '".$comm_id."'")->result_array();
        $this->load->view('supercontrol/header', $this->data);
		$this->load->view('supercontrol/community/event_list', $this->data);
		$this->load->view('supercontrol/footer');
    }
    function eventactivate($com_id = false, $id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : base_url('supercontrol/community/event_list/'.$com_id);
        if ($id) {
            $c['event_status'] = 1;
            $this->db->where('id', $id);
            $this->db->update('events', $c);
            $this->session->set_flashdata("success", "Event activated");
        }
        redirect($redirect);
    }
    function eventdeactivate($com_id = false, $id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : base_url('supercontrol/community/event_list/'.$com_id);
        if ($id) {
            $c['event_status'] = 2;
            $this->db->where('id', $id);
            $this->db->update('events', $c);
            $this->session->set_flashdata("success", "Event deactivated");
        }
        redirect($redirect);
    }
    function eventdelete($com_id, $id) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : base_url('supercontrol/community/event_list/'.$com_id);
        if ($id > 0) {
            $c['id'] = $id;
            $this->db->delete('events', $c);
            $this->session->set_flashdata('success', 'Event deleted successfully ');
        }
        redirect($redirect);
    }
    public function view_community_comment($community_id) {
        $data['title'] = "Community List";
        $data['community_comment_list'] = $this->db->query("SELECT * FROM community_comment WHERE community_id = '".$community_id."'order by created_at DESC")->result_array();
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/community/community_details', $data);
		$this->load->view('supercontrol/footer');
    }
    public function getCatwisecommentData(){
        $cat_id = $_POST['cat_id'];
        $comm_id = $_POST['comm_id'];
        if($cat_id != '0') {
            $getcommunity_comment = $this->db->query("SELECT * FROM community_comment WHERE instr(concat(',', cat_id, ','), ',$cat_id,') AND community_id = '".$comm_id."' ORDER BY created_at DESC")->result_array();
        } else {
            $getcommunity_comment = $this->db->query("SELECT * FROM community_comment WHERE community_id = '".$comm_id."' ORDER BY created_at DESC")->result_array();
        }
        ?>
        <ul style="padding: 0px !important;">
        <?php
        if (!empty($getcommunity_comment)) {
            foreach ($getcommunity_comment as $value) {
            $userData = $this->db->query("SELECT * FROM users WHERE id = '" . $value['user_id'] . "'")->row(); ?>
            <li>
                <div class="comments-box grey-bg" style="padding: 15px !important;">
                    <div class="comments-info d-flex">
                        <div class="comments-avatar mr-10">
                        <?php if (!empty($userData->image)) { ?>
                            <img src="<?= base_url() ?>uploads/profile_pictures/<?= $userData->image ?>" />
                        <?php } else { ?>
                            <img src="<?= base_url() ?>images/no-user.png" />
                        <?php } ?>
                        </div>
                        <div class="avatar-name" style="margin-left: 10px;">
                            <h3 style="margin-top: 0px;font-weight: bold;margin-bottom: 0px;font-size: 16px;"><?= ucwords($value['full_name']) ?></h3>
                            <span class="post-meta" style="font-size: 12px;"><?= date('M j, Y', strtotime($value['created_at'])) ?> in
                            <?php
                            $cat_data = $this->db->query("SELECT * FROM community_cat WHERE status = '1' AND is_delete = '1'")->result();
                            $cat_map = [];
                            foreach ($cat_data as $cat) {
                                $cat_map[$cat->id] = $cat->category_name;
                            }
                            if (!empty($value['cat_id'])) {
                                $category_id = explode(',', $value['cat_id']);
                                $category_name = array_map(function($id) use ($cat_map) {
                                    return isset($cat_map[trim($id)]) ? $cat_map[trim($id)] : null;
                                }, $category_id);
                                $category_name = array_filter($category_name);
                                $category_name_display = implode(', ', $category_name);
                                echo "<b>".$category_name_display."</b>";
                            }
                            ?>
                            </span>
                        </div>
                    </div>
                    <?php
                    $checkPinedStatus = $this->db->query("SELECT * FROM pin_comment WHERE comment_id = '".$value['id']."' AND user_id = '0'")->row();
                    if(@$checkPinedStatus->pinned == '1'){ ?>
                    <img src="<?= base_url('assets/img/push-unpin-icon.png')?>" style="width: 20px;height: 20px;display: inline-block;float: right;position: relative;top: -55px;bottom: 0;" onclick="pinComment('<?= $value['id'] ?>', '0')">
                    <?php } else { ?>
                    <img src="<?= base_url('assets/img/push-pin-icon.png')?>" style="width: 20px;height: 20px;display: inline-block;float: right;position: relative;top: -55px;bottom: 0;" onclick="pinComment('<?= $value['id'] ?>', '1')">
                    <?php } ?>

                    <div class="comments-text ml-65" style="display: inline-block;margin-top: 0px;margin-left: 35px;">
                        <p style="margin-bottom: 0 !important;"><?= $value['comment'] ?></p>
                        <div class="comments-replay" style="margin-top: 2px !important;">
                            <a href="javascript:void(0)" class="btn btn-info" onclick="replyComment(<?= $value['id'] ?>)">Reply</a>
                        </div>
                    </div>
                </div>
            </li>
            <?php
            $commentRply = $this->db->query("SELECT * FROM community_comment_rply WHERE community_id = '" . $comm_id . "' AND comment_id = '" . $value['id'] . "'")->result_array();
            if (!empty($commentRply)) {
                foreach ($commentRply as $data) {
                $userData1 = $this->db->query("SELECT * FROM users WHERE id = '" . $data['user_id'] . "'")->row(); ?>
            <li class="children">
                <div class="comments-box grey-bg">
                    <div class="comments-info d-flex">
                        <div class="comments-avatar mr-20" style="margin-right: 10px !important;">
                            <?php if (!empty($userData1->image)) { ?>
                            <img src="<?= base_url() ?>uploads/profile_pictures/<?= $userData1->image ?>" />
                            <?php } else { ?>
                            <img src="<?= base_url() ?>images/no-user.png" />
                            <?php } ?>
                        </div>
                        <div class="avatar-name">
                            <h5><?= $data['full_name'] ?></h5>
                            <span class="post-meta"><?= date('M j, Y', strtotime($data['created_at'])) ?></span>
                        </div>
                    </div>
                    <div class="comments-text ml-65" style="margin-left: 35px !important;">
                        <p><?= $data['comment'] ?></p>
                    </div>
                </div>
            </li>
            <?php } } } } else { ?>
            <li>No comment yet</li>
            <?php } ?>
        </ul>
        <input type="hidden" name="comm_id" id="comm_id" value="<?= @$comm_id ?>">
        <?php
    }
}
?>