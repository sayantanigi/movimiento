<?php
class Event extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library(array('form_validation', 'session'));
		// if ($this->session->userdata('is_logged_in') != 1) {
		// 	redirect('supercontrol/home', 'refresh');
		// }
		$this->load->model('supercontrol/event_model');
		$this->load->model('Cms_model');
		$this->load->database();
		$this->load->library('image_lib');
		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
	}
	function index() {
		$data['title'] = "Event List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/eventlist', $data);
		$this->load->view('supercontrol/footer');
	}
	function addeventview() {
		$data['title'] = "Add Event";
		$data['course_list'] = $this->db->query("SELECT * FROM courses WHERE user_id = '".$this->session->userdata('user_id')."'")->result_array();
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/eventadd_view', $data);
		$this->load->view('supercontrol/footer');
	}
	function add_event($id = false) {
		$config = array(
			'upload_path' => "uploads/event/",
			'upload_url' => base_url() . "uploads/event/",
			'allowed_types' => "gif|jpg|png|jpeg"
		);
		$this->load->library('upload', $config);
		$this->form_validation->set_rules('event_name', 'Event name', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('supercontrol/header');
			$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/eventadd_view', $data);
			$this->load->view('supercontrol/footer');
		} else {
			$slug = $this->input->post('event_name');
            if (empty($slug) || $slug == '') {
                $slug = $this->input->post('event_name');
            }
            $slug = strtolower(url_title($slug));
			if (!$this->upload->do_upload('userfile')) {
				$data = array(
					'user_id' => $this->session->userdata('user_id'),
					'course_id' => $this->input->post('course_id'),
					'event_name' => $this->input->post('event_name'),
					'event_slug' => $this->Cms_model->get_unique_url($slug, $id),
					'event_desc' => $this->input->post('event_desc'),
					'event_dt' => $this->input->post('event_dt'),
					'from_time' => $this->input->post('from_time'),
					'to_time' => $this->input->post('to_time'),
					'event_link' => $this->input->post('event_link'),
					'event_type' => $this->input->post('event_type'),
					'event_price' => $this->input->post('event_price'),
					'price_key' => $this->input->post('price_key'),
					'created_at' => date('Y-m-d H:i:s'),
					'status' => 1
				);
				$this->event_model->insert_event($data);
				$upload_data = $this->upload->data();
				$this->session->set_flashdata('success_add', 'Event Added Successfully !!!!');
				redirect('supercontrol/event/showevent');
			} else {
				$data['userfile'] = $this->upload->data();
				$filename = $data['userfile']['file_name'];
				if (!empty($_FILES['videos_file']['name'])) {
					$src = $_FILES['videos_file']['tmp_name'];
					$filEnc = time();
					$avatar = rand(0000, 9999) . "_" . $_FILES['videos_file']['name'];
					$avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
					$dest = getcwd() . '/uploads/event/videos_file/' . $avatar1;
					if (move_uploaded_file($src, $dest)) {
						$file  = $avatar1;
						@unlink('uploads/event/videos_file/' . $_POST['old_video']);
					}
					if(!empty($file)) {
						$video_file = $file;
					} else {
						$link = "";
					}
				}
				$data = array(
					'user_id' => $this->session->userdata('user_id'),
					'course_id' => $this->input->post('course_id'),
					'event_name' => $this->input->post('event_name'),
					'event_slug' => $this->Cms_model->get_unique_url($slug, $id),
					'event_desc' => $this->input->post('event_desc'),
					'event_dt' => $this->input->post('event_dt'),
					'from_time' => $this->input->post('from_time'),
					'to_time' => $this->input->post('to_time'),
					'event_link' => $this->input->post('event_link'),
					'event_type' => $this->input->post('event_type'),
					'event_price' => $this->input->post('event_price'),
					'price_key' => $this->input->post('price_key'),
					'event_img' => $filename,
					'video_file' => $video_file,
					'created_at' => date('Y-m-d H:i:s'),
					'status' => 1
				);
				$this->event_model->insert_event($data);
				$upload_data = $this->upload->data();
				$this->session->set_flashdata('success_add', 'Event  Added Successfully !!!!');
				redirect('supercontrol/event/showevent');

			}
		}
	}
	function showevent() {
		$data['title'] = "Event Type List";
		//$query = $this->event_model->show_event();
		$data['event'] = $this->db->query("SELECT * FROM event WHERE user_id = '".$this->session->userdata('user_id')."'")->result();
		$data['title'] = "Event List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/eventlist', $data);
		$this->load->view('supercontrol/footer');
	}
	function edit_event($id = false) {
		$event_img = $this->input->post('event_image');
		$config = array(
			'upload_path' => "uploads/event/",
			'upload_url' => base_url() . "uploads/event/",
			'allowed_types' => "gif|jpg|png|jpeg"
		);
		$this->load->library('upload', $config);
		$slug = $this->input->post('event_name');
		if (empty($slug) || $slug == '') {
			$slug = $this->input->post('event_name');
		}
		$slug = strtolower(url_title($slug));
		if ($this->upload->do_upload("userfile")) {
			@unlink("uploads/event/" . $event_img);
			$data['event_img'] = $this->upload->data();
			$filename = $data['event_img']['file_name'];
			if (!empty($_FILES['videos_file']['name'])) {
                $src = $_FILES['videos_file']['tmp_name'];
                $filEnc = time();
                $avatar = rand(0000, 9999) . "_" . $_FILES['videos_file']['name'];
                $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
                $dest = getcwd() . '/uploads/event/videos_file/' . $avatar1;
                if (move_uploaded_file($src, $dest)) {
                    $file  = $avatar1;
                    @unlink('uploads/event/videos_file/' . $_POST['old_video']);
                }
                if(!empty($file)) {
                    $video_file = $file;
                } else {
                    $link = "";
                }
            }
			$datalist = array(
				'user_id' => $this->session->userdata('user_id'),
				'course_id' => $this->input->post('course_id'),
				'event_name' => $this->input->post('event_name'),
				'event_slug' => $this->Cms_model->get_unique_url($slug, $id),
				'event_desc' => $this->input->post('event_desc'),
				'event_dt' => $this->input->post('event_dt'),
				'from_time' => $this->input->post('from_time'),
				'to_time' => $this->input->post('to_time'),
				'event_link' => $this->input->post('event_link'),
				'event_type' => $this->input->post('event_type'),
                'event_price' => $this->input->post('event_price'),
                'price_key' => $this->input->post('price_key'),
				'event_img' => $filename,
				'video_file' => $video_file,
				'created_at' => date('Y-m-d H:i:s'),
				'status' => 1
			);
			$event_img = $this->input->post('event_image');
			$id = $this->input->post('event_id');
			$data['title'] = "Edit Event";
			$this->load->database();
			$this->load->model('supercontrol/event_model');
			$query = $this->event_model->event_edit($id, $datalist);
			$data1['message'] = 'Data Update Successfully';
			$query = $this->event_model->show_event();
			$data['eevent'] = $query;
			$data['title'] = "Event Page List";
			$this->session->set_flashdata('success_update', 'Event Updated Successfully !!!!');
			redirect('supercontrol/event/showevent', TRUE);
		} else {
			
			$datalist = array(
				'user_id' => $this->session->userdata('user_id'),
				'course_id' => $this->input->post('course_id'),
				'event_name' => $this->input->post('event_name'),
				'event_slug' => $this->Cms_model->get_unique_url($slug, $id),
				'event_desc' => $this->input->post('event_desc'),
				'event_dt' => $this->input->post('event_dt'),
				'from_time' => $this->input->post('from_time'),
				'to_time' => $this->input->post('to_time'),
				'event_link' => $this->input->post('event_link'),
				'event_type' => $this->input->post('event_type'),
                'event_price' => $this->input->post('event_price'),
                'price_key' => $this->input->post('price_key'),
				'created_at' => date('Y-m-d H:i:s'),
				'status' => $this->input->post('status')
			);
			//print_r($datalist);
			//exit();
			$event_img = $this->input->post('event_img');
			$id = $this->input->post('event_id');
			$data['title'] = "Event Edit";
			$this->load->database();
			$this->load->model('supercontrol/event_model');
			$query = $this->event_model->event_edit($id, $datalist);
			$data1['message'] = 'Data Update Successfully';
			$query = $this->event_model->show_event();
			$data['eevent'] = $query;
			$data['title'] = "Event Page List";
			$this->session->set_flashdata('success_update', 'Event Updated Successfully !!!!');
			redirect('supercontrol/event/showevent', TRUE);
		}
	}
	function show_event_id($id) {
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Event Type";
		$query = $this->event_model->show_event_id($id);
		$data['eevent'] = $query;
		$data['course_list'] = $this->db->query("SELECT * FROM courses WHERE user_id = '".$this->session->userdata('user_id')."'")->result_array();
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/event_edit', $data);
		$this->load->view('supercontrol/footer');
	}
	public function fileUpload() {
        $event_id = $_POST['event_id'];
        if (!empty($_FILES['videos_file']['name'])) {
            $src = $_FILES['videos_file']['tmp_name'];
            $filEnc = time();
            $avatar = rand(0000, 9999) . "_" . $_FILES['videos_file']['name'];
            $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
            $dest = getcwd() . '/uploads/event/videos_file/' . $avatar1;
            if (move_uploaded_file($src, $dest)) {
                $file  = $avatar1;
                @unlink('uploads/event/videos_file/' . $_POST['old_video']);
            }
            if(!empty($file)) {
                $mydata['video_file'] = $file;
            } else {
                $link = "";
            }
			$this->load->model('supercontrol/event_model');
			$query = $this->event_model->event_edit($event_id, $mydata);
			$msg = 'success';
        }
        echo $msg;
    }
	function delete_event($id) {
		//$id = $this->uri->segment(4);
		$result = $this->event_model->delete_event($id);
		$this->session->set_flashdata('success_delete', 'Event Deleted Successfully !!!!');
		redirect('supercontrol/event/showevent');
	}
}
?>