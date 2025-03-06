<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->data['header'] = '';
        $this->admin_login();
        $this->load->model('Product_model');
        $this->load->model('Cms_model');
        $this->load->model('Commonmodel');
        $config['upload_path'] = './uploads/products';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$this->load->library('upload', $config);
	}

	public function index($page=1) {
		if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Product List';
        $this->data['tab'] = 'products';
        $this->data['main'] = admin_view('product/index');
        $products = $this->Product_model->getAll($offset, $show_per_page);
        $this->data['products'] = $products['results'];
        $config['base_url'] = admin_url('products/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $products['total'];
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
    public function product_cat_list() {
        $this->data['title'] = 'Product Category List';
        $this->data['tab'] = 'product_cat_list';
        $this->data['main'] = admin_view('product/category_index');
        $this->data['product_cat_list'] = $this->db->query("SELECT * FROM product_category WHERE status = '1'")->result();
        $this->load->view(admin_view('default'), $this->data);
    }
    public function add_product_cat($id = false) {
        $this->data['title'] = 'Add Product Category';
        $this->data['tab'] = 'add_product_cat';
        $this->data['main'] = admin_view('product/add_product_cat');
        $this->data['product_cat_list'] = $this->Product_model->getNew('product_category');
        if ($id) {
            $this->data['product_cat_list'] = $product_cat_list = $this->Product_model->getRow($id, 'product_category');
            $this->data['title'] = 'Update Product Category';
            if (!isset($product_cat_list)) {
                show_404();
                exit();
            }
        }
        $this->form_validation->set_rules('frm[category_name]', 'Product Category title', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;
            $slug = $formdata['category_name'];
            if (empty($slug) || $slug == '') {
                $slug = $formdata['category_name'];
            }
            $slug = strtolower(url_title($slug));
            $formdata['category_link'] = $this->Cms_model->get_unique_url($slug, $id);
            $id = $this->Product_model->save($formdata, 'product_category');
            // /echo $this->db->last_query();die();
            $this->session->set_flashdata("success", "Product category updated");
            if ($id) {
                $msg = '["Product category added successfully!", "success", "#36A1EA"]';
            } else {
                $msg = '["Sorry, Record not saved!", "error", "#e50914"]';
            }
            $this->session->set_flashdata('msg', $msg);
            redirect(admin_url('products/product_cat_list'));
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    function delete_prod_category($id = false) {
        if ($id > 0) {
            $this->Course_model->delete($id, 'product_category');
            $this->session->set_flashdata('success', 'Product Category deleted successfully ');
        }
        $msg = '["Deleted successfully.", "success", "#36A1EA"]';
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('products/product_cat_list'));
    }
	public function add_product($id=false) {
        $this->data['title'] = 'Add Product';
        $this->data['tab'] = 'add_product';
		$this->data['main'] = admin_view('product/add');
        $this->data['product_cat'] = $this->db->get('product_category')->result();
		$this->data['product'] = $this->Product_model->getNew();
        if (@$id) {
            $this->data['product'] = $product = $this->Product_model->getRow($id);
            if(!isset($product)){
               show_404();
                exit();
            }
        }
		$this->form_validation->set_rules('product_name', 'Product title', 'required');
		if ($this->form_validation->run()) {
			$formdata = array(
                'categori_id' => $this->input->post('categori_id'),
                'product_name' => $this->input->post('product_name'),
                'overview' => $this->input->post('frmoverview'),
                'description' => $this->input->post('frmdescription'),
                'additional_information' => $this->input->post('additional_information'),
                'mrp' => $this->input->post('mrp'),
                'sale_price' => $this->input->post('sale_price'),
                'status' => $this->input->post('status'),
                'product_add_date' => date('Y-m-d H:i:s'),
			    'id' => $id
            );
			//$images = $this->input->post('image');
			if ($this->upload->do_upload('product_image')) {
				$data = $this->upload->data();
				$formdata['product_image'] = $data['file_name'];
			}
			$this->Product_model->save($formdata);
            $insert_id = $this->db->insert_id();
            $this->db->delete('product_details', array('product_id' => $id));
            for($i=0; $i<count($this->input->post('size')); $i++){ 
                if ($id) {
                    $datavalue = array(
                        'size' => $this->input->post("size[$i]"),
                        'quantity' => $this->input->post("quantity[$i]"),
                        'product_id' => $id
                    );
                } else {
                    $datavalue = array(
                        'size' => $this->input->post("size[$i]"),
                        'quantity' => $this->input->post("quantity[$i]"),
                        'product_id' => $insert_id
                    );
                }
                $this->Commonmodel->add_details('product_details', $datavalue);
            }
			$this->session->set_flashdata("success", "Product detail saved");
            redirect(admin_url('products'));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}
    public function changeStatus() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            if ($status == 1) {
                $msg = 'Product activated successfully!';
            } else {
                $msg = 'Product deactivated successfully!';
            }
            if ($this->Commonmodel->update_row('product', ['status' => $status], ['id' => $id])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }
	function deleteProduct($id){
		if ($id > 0) {
            $this->Product_model->delete($id);
            $this->session->set_flashdata('success', 'Product deleted successfully ');
        }
        redirect(admin_url('products'));
	}
    public function purchased_products($page=1) {
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Product Purchased List';
        $this->data['tab'] = 'purchased_products';
        $this->data['main'] = admin_view('product/purchased_product');
        $products = $this->Product_model->getAllproductpurchesed($offset, $show_per_page);
        $this->data['product_order_details'] = $this->db->query("SELECT * FROM product_order_details ORDER BY id DESC")->result_array();
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $products['total'];
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
}

/* End of file Products.php */
/* Location: ./application/controllers/admin/Products.php */