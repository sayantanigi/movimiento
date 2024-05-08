<?php 
class City_model extends CI_Model{
	private $category = 'sm_category';
	function __construct() {
        parent::__construct();
   }
public function insert_city($data) {
		$this->load->database();
	    $this->db->insert('sm_city', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
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
					//$html .= "<hr>";
                    $html .= "</li>";
                }
            }
            $html .= "</ul>";
        }
        return $html;
    }

	//=======================BUILDING OF MENU======================
	
	//=======================BUILDING Category and sub category======================
		public function category_menu_category() {
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
            $result = $this->build_category_category(0, $cat);
            return $result;
        } else {
            return FALSE;
        }
    }
    	// Menu builder function, parentId 0 is the root
    	function build_category_category($parent, $menu) {
			
        $html = "";
        if (isset($menu['parents'][$parent])) {
            $html .= "<ul class='breadcrumb'>";
            foreach ($menu['parents'][$parent] as $itemId) {
                if (!isset($menu['parents'][$itemId])) {
                    $html .= "<li>".$menu['items'][$itemId]->category_name."</li>";
                }
                if (isset($menu['parents'][$itemId])) {
                    $html .= "<li>".$menu['items'][$itemId]->category_name."";
                    $html .= $this->build_category_category($itemId, $menu);
				  	//$html .= "<hr>";
                    $html .= "</li>";
                }
            }
            $html .= "</ul>";
        }
        return $html;
    
	   }

	//=======================BUILDING Category and sub category======================
	
	//=======================BUILDING Category and sub category======================
		public function category_listing() {
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
            $result = $this->build_category_listing(0, $cat);
            return $result;
        } else {
            return FALSE;
        }
    }
    	// Menu builder function, parentId 0 is the root
    	function build_category_listing($parent, $menu) {
        $html = "";
        if (isset($menu['parents'][$parent])) {
			
            $html .= "<ul>";
			$html .= "<br><div style='display:inline-flex; width:100% !important;'>";
            foreach ($menu['parents'][$parent] as $itemId) {
                if (!isset($menu['parents'][$itemId])) {
					$baseurl = 'http://localhost:81/nahidsproperty/admin';
					//echo $baseurl; exit();
                    $html .= "<li>". $menu['items'][$itemId]->category_name."</li>";
                }
                if (isset($menu['parents'][$itemId])) {
                    $html .= "<div style='display:inline-flex;'>"."<li>".$menu['items'][$itemId]->category_name."</li>"."</div>";
                    $html .= $this->build_category_listing($itemId, $menu);
					$html .= "<div style='clear:both;'>&nbsp;</div>";
					//$html .= "<br>";
                    
                }
            }
			
			$html .= "</div>";
            $html .= "</ul>";
        }
        return $html;
    }

	//=======================BUILDING Category and sub category======================
	
	
	public function getCategories() {
        $user = $this->session->userdata('userid');
        $query = $this->db->get_where('sm_countrys',array('userid'=>$user));
        return $query->result();
    }
    function getSubcategories($cat_id) {
        $this->db->select('*');
        $this->db->from('sm_category');
        $this->db->where(array('parent_id' => $cat_id));
        $query = $this->db->get();
        return $query->result();
    } 
	//================================***********************========================
	//===============================*************************=======================
	
/*function show_category_main(){
		$sql ="select * from np_categorycategory_details WHERE pid=0";
		//$this->db->where('pid', 0);
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_category_sub($id)
	{
		$sql ="select * from np_categorycategory_details";
		$this->db->where('pid', $id);
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}*/
	
	
	function get_country(){
        $query = $this->db->get('sm_countrys');
        //echo $this->db->get('countrys');die;
        return $query;  
    }
function show_city()
	{
        $user = $this->session->userdata('userid');
		$this->db->select('sm_city.*,sm_countrys.country_name');
        $this->db->where('sm_city.userid',$user);
		$this->db->from('sm_city');
		$this->db->join('sm_countrys', 'sm_countrys.id = sm_city.country_id');
		$query = $this->db->get();
		
		$result = $query->result();
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	
function show_city_id($id){
		$this->db->select('*');
		$this->db->from('sm_city');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function city_edit($id, $datalist){
	
		$this->db->where('id', $id);
		$this->db->update('sm_city',$datalist);
	}
function updt($stat,$id){
	 
		$sql ="update sm_np_news set news_status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_citylist()
	{
		$this->db->select('*');
		$this->db->from('sm_city');
		//$this->db->where('parent_id',0);
		$query = $this->db->get();
		$result = $query->result();
		return($query->num_rows() > 0) ? $query->result(): NULL;
		
	}
	
		function getAllGroups(){
    $query = $this->db->query('SELECT id,country_name FROM sm_countrys');
    return $query->result_array();
}
function delete_city($id){
		//=================******************=================
		$query = $this->db->get_where('sm_city');
			$this->db->where('id', $id);
	    	$this->db->delete('sm_city');	
	    		return true;

     }
		//=================******************=================
	

	}
?>