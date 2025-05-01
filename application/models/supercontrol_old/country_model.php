<?php 
class Country_model extends CI_Model{
	private $country = 'sm_country';
	function __construct() {
        parent::__construct();
   }
public function insert_country($data) {
		$this->load->database();
	    $this->db->insert('sm_countrys', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
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
function show_country()
	{
		$user = $this->session->userdata('userid');
		$this->db->select('*');
		$this->db->where('userid',$user);
		$this->db->from('sm_countrys');
		//$this->db->where('parent_id',0);
		$query = $this->db->get();
		$result = $query->result();
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_country_id($id){
		$this->db->select('*');
		$this->db->from('sm_countrys');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function category_edit($id, $datalist){
	
		$this->db->where('id', $id);
		$this->db->update('sm_countrys',$datalist);
	}
function updt($stat,$id){
	 
		$sql ="update sm_np_news set news_status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_categorylist()
	{
		$this->db->select('*');
		$this->db->from('sm_countrys');
		$query = $this->db->get();
		$result = $query->result();
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function delete_country($id){
		//=================******************=================
		$query = $this->db->get_where('sm_countrys');
		
			$this->db->where('id', $id);
	    	
	    	$this->db->delete('sm_countrys');	
	    		return true;
    	
     }
		
	}
?>