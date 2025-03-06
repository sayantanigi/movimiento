<?php 
class Servicedetails_model extends CI_Model{
	private $category = 'sm_category';
	function __construct() {
        parent::__construct();
   }
public function insert_servicedetails($data) {
		$this->load->database();
	    $this->db->insert('sm_servicedetails', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	
	function show_servicedetails()
		{
			$sql ="select * from sm_np_servicedetails ORDER BY id DESC";
			$query = $this->db->query($sql);
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
	function show_servicedetailsjoin()
		{
			$this->load->database();
			$this->db->select('sm_servicedetails.*,sm_category.*');
			$this->db->from('sm_servicedetails');
			$this->db->join('sm_category', 'sm_category.category_id = sm_servicedetails.pid order by sm_servicedetails.serv_id DESC'); 
			$query = $this->db->get();
			return $query->result();
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
	
	
		//=======================BUILDING OF MENU======================
		public function category_menu() {
        // Select all entries from the menu table
        $query = $this->db->query("select category_id, category_name,
            parent_id from " . $this->sm_category . " order by category_id");

        // Create a multidimensional array to contain a list of items and parents
        $cat = array(
            'items' => array(),
            'parents' => array()
        );
        // Builds the array lists with data from the menu table
        foreach ($query->result() as $cats) {
            // Creates entry into items array with current menu item id ie. $menu['items'][1]
            $cat['items'][$cats->category_id] = $cats;
            // Creates entry into parents array. Parents array contains a list of all items with children
            $cat['parents'][$cats->parent_id][] = $cats->category_id;
        }

        if ($cat) {
            $result = $this->build_category_menu(0, $cat);
            return $result;
        } else {
            return FALSE;
        }
    }
    	// Menu builder function, parentId 0 is the root
    	function build_category_menu($parent, $menu) {
        $html = "";
        if (isset($menu['parents'][$parent])) {
            $html .= "<ul class='topul'>";
            foreach ($menu['parents'][$parent] as $itemId) {
                if (!isset($menu['parents'][$itemId])) {
                    $html .= "<li><input type='radio' class='catlist' name='pid' value=".$menu['items'][$itemId]->category_id." style='margin-left: -10px;'>". $menu['items'][$itemId]->category_name."</span></a></li>";
                }
                if (isset($menu['parents'][$itemId])) {
                    $html .= "<li><input type='radio' name='pid' class='catlist' value=".$menu['items'][$itemId]->category_id." style='margin-left: -10px;'><span>" . $menu['items'][$itemId]->category_name . "</span>";
                    $html .= $this->build_category_menu($itemId, $menu);
					$html .= "<hr>";
                    $html .= "</li>";
                }
            }
            $html .= "</ul>";
        }
        return $html;
    }

	//=======================BUILDING OF MENU======================
	
	function show_id($id){
			$this->db->select('*');
			$this->db->from('sm_servicedetails');
			$this->db->where('serv_id', $id);
			$query = $this->db->get();
			$result = $query->result();
			return $result;
		}
	function servicedetails_edit($id, $datalist){
		
			$this->db->where('serv_id', $id);
			$this->db->update('sm_servicedetails',$datalist);
		}
	function updt($stat,$id){
		 
			$sql ="update sm_servicedetails set status=$stat where serv_id=$id ";
			$query = $this->db->query($sql);
			//return($query->num_rows() > 0) ? $query->result(): NULL;
		}
	function servicedetails_view($id){
		$this->db->select('*');
		$this->db->from('sm_np_servicedetails');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return($query->num_rows() > 0) ? $query->result(): NULL;
		
	}
	
	function servicedetails_viewjoin($id){
	$this->load->database();
	$this->db->select ( '*' ); 
	$this->db->from('sm_np_servicedetails');
	$this->db->join('sm_category', 'sm_np_servicedetails.pid = sm_category.category_id');
	//$this->db->join('multi_img', 'multi_img.servicedetails_id = np_servicedetails.id');
	$this->db->where('np_servicedetails.id', $id);

	/*$this->db->select('np_servicedetails.*,category.*,multi_img.*');    
	$this->db->from('np_servicedetails');
	$this->db->join('category', 'np_servicedetails.pid = category.category_id');
	$this->db->join('multi_img', 'np_servicedetails.id = multi_img.servicedetails_id');
	$this->db->where('np_servicedetails.id', $id);*/
	$query = $this->db->get();
	//$query = $this->db->get();
	return $query->result();
	return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	function delete_servicedetails($id){
	  $this->db->where('serv_id', $id);
      $this->db->delete('sm_servicedetails'); 
	}
	
	function delete_servicedetails_img($id,$apartment_image){
	  $this->db->where('id', $id);
	  @unlink("servicedetails_img/".$apartment_image);
      $this->db->delete('multi_img'); 
	}
	function show_servicedetailslist()
		{
			$sql ="select * from sm_servicedetails ORDER BY serv_id DESC";
			$query = $this->db->query($sql);
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
}
?>