<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

        $this->load->model('Course_model');
        $this->load->model('Cms_model');
        $this->load->model('Commonmodel');
        
		$this->data['header'] = '';
        $this->admin_login();
	}

        public function index($page=1)
    {
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Questions List';
        $this->data['tab'] = 'ques_list';
        $this->data['main'] = admin_view('question/index');
        $this->data['courselist'] = $this->db->get_where('courses',array('status'=>1))->result();        
        $this->load->view(admin_view('default'),$this->data);
    }

   
    public function add($id=false)
    {
        $this->data['title'] = 'Add Question';
        $this->data['tab'] = 'add_qz_bank';
        $this->data['main'] = admin_view('question/add_ques');
        $this->data['courses'] = $this->db->get_where('courses',array('status'=>1))->result();
        //$this->data['course'] = $this->Course_model->getNew('courses');

        $this->form_validation->set_rules('course_id', 'Course', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $crsid=$this->input->post('course_id');

                $ques= $this->input->post('ques');
                $ans1 = $this->input->post('ans1');
                $ans2 = $this->input->post('ans2');
                $ans3 = $this->input->post('ans3');
                $ans4 = $this->input->post('ans4');
                $cor_ans = $this->input->post('cor_ans');
            for($k=0; $k < count($ques); $k++) {
                $basicdata[] = array(
                'course_id'=>$crsid,
                'ques'=>$ques[$k],
                'ans1'=>$ans1[$k],
                'ans2'=>$ans2[$k],
                'ans3'=>$ans3[$k],
                'ans4'=>$ans4[$k],
                'cor_ans'=>$cor_ans[$k],
                'status'=>1,
                );

            }
            $this->db->insert_batch('quiz_bank', $basicdata); 
            $this->session->set_flashdata("success", "Question details added");
            redirect(admin_url('question/add'));
        }       
        $this->load->view(admin_view('default'),$this->data);
    }
   
    function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('question');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Course_model->save($c,'quiz_bank');
            $this->session->set_flashdata("success", "Question activated");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('question');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Course_model->save($c,'quiz_bank');
            $this->session->set_flashdata("success", "Question deactivated");
        }
        redirect($redirect);
    }

     function delete_quesr($id){
        if ($id > 0) {
            $this->Course_model->delete($id,'quiz_bank');
            $this->session->set_flashdata('success', 'Question deleted successfully ');
        }
        redirect(admin_url('question'));
    }
  
   
    public function edit_question($qid=false){

        $this->data['title'] = 'Update Question';
        $this->data['tab'] = 'ed_ques';
        $this->data['main'] = admin_view('question/edit_ques');
        $this->data['quiz_q'] = $this->db->get_where('quiz_bank',array('id'=>$qid,'status'=>1))->row();
        $this->data['courses'] = $this->db->get_where('courses',array('status'=>1))->result();
        $this->form_validation->set_rules('frm[ques]', 'Question', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            //print_r($_POST);die;
            
            $this->db->update('quiz_bank',$formdata,array('id'=>$qid));
            //echo $this->db->last_query();die();
            $this->session->set_flashdata("success", "Question detail updated");
            redirect(admin_url('question'));
        }       
        $this->load->view(admin_view('default'),$this->data);

    }

     public function set_exam(){

        $this->data['title'] = 'Set Exam List';
        $this->data['tab'] = 'ex_set';
        $this->data['main'] = admin_view('question/exam_index');
        $this->data['courses'] = $this->db->get_where('courses',array('status'=>1))->result();
       $this->form_validation->set_rules('course_id', 'Course', 'required');
        if ($this->form_validation->run()) {
            $courseid= $this->input->post('course_id');
            $quesn=$this->input->post('ques_no');
            if($courseid){
                $qrow=$this->db->get_where('quiz_bank',array('course_id'=>$courseid))->num_rows();
            //print_r($qrow);die;
                if($qrow < $quesn){
                  $this->session->set_flashdata("error", "Insufficient questions in your question bank.Pls try below than $qrow");
                if($qrow==0){
                $this->session->set_flashdata("error", "There are no questions in selected course...");  
                }  
                }
              
                else{
                $totques=$this->db->query("SELECT * FROM `quiz_bank` WHERE `course_id`='$courseid' ORDER BY id limit $quesn")->result();
                foreach($totques as $ttq){
                $basicdata = array(
                'courseid'=>$ttq->course_id,
                'quesid'=>$ttq->id,
                'status'=>1,
                );
               
             $qid= $this->db->get_where('set_exam_test',array('quesid'=>$ttq->id))->num_rows();
             
             if($qid>0){
                $this->session->set_flashdata("error", "Duplicate Entry in exam set...Pls try another.");
             } else{
             $this->db->insert('set_exam_test',$basicdata);
            $this->session->set_flashdata("success", "Quiz Questions have been set successfully.");
            }
        }      
                }
            }
        }
       
        $this->load->view(admin_view('default'),$this->data);
    }
     public function set_exam_list($page=1)
    {
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Final Test Quiz List';
        $this->data['tab'] = 'ex_set_list';
        $this->data['main'] = admin_view('question/exam_list_all');
        $this->data['courselist'] = $this->db->get_where('courses',array('status'=>1))->result();
        

        $course = $this->Course_model->getAll($offset, $show_per_page,'quiz_bank');
        $this->data['course'] = $course['results'];
        $config['base_url'] = admin_url('question/set_exam_list');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $course['total'];
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
      public function addbulkquestions(){
        $this->data['title'] = 'Question Bulk upload';
        $this->data['tab'] = 'add_blk_ques';
        $this->data['main'] = admin_view('question/add_bulkques');
        $course_id= $this->input->post('course_id');
        $csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv','text/xls','text/xlsx');
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                
                //open uploaded csv file with read only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                
                // skip first line
                // if your csv file have no heading, just comment the next line
                fgetcsv($csvFile);
                
                //parse data from csv file line by line
                while(($line = fgetcsv($csvFile)) !== FALSE){ 
                    //check whether member already exists in database with same email
         
                //insert member data into database
                $this->db->insert("quiz_bank", array("course_id"=>$course_id,"ques"=>$line[0],"ans1"=>$line[1], "ans2"=>$line[2], "ans3"=>$line[3], "ans4"=>$line[4], "cor_ans"=>$line[5], "status"=>1));
                //echo $this->db->last_query();die;
                   
                }
                
                //close opened csv file
                fclose($csvFile);
                $this->session->set_flashdata("success", "CSV Uploaded");
                redirect(admin_url('question'));
            }else{
                $this->session->set_flashdata("error", "Some Error Occured");
            }
        }
        $this->load->view(admin_view('default'),$this->data);
    }
    function getcourse(){
    $id = $this->input->post('id');

    $option = $this->db->get_where('courses',array('cat_id'=>$id))->result();
    //echo $this->db->last_query();die;
    $ht = '';
    if(is_array($option) && count($option)>0){
        foreach ($option as $op) {
            $ht .= '<option value="'.$op->id.'">'.$op->title.'</option>';
        }
    }else{
        $ht .= '<option value="">No data found</option>';
    }
    echo $ht;
}
}

/* End of file Products.php */
/* Location: ./application/controllers/admin/Products.php */