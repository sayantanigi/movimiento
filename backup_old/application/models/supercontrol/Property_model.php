<?php 
class Property_model extends CI_Model{
	private $category = 'sm_category';
	function __construct() {
        parent::__construct();
   }
public function insert_property($data) {
		$this->load->database();
	    $this->db->insert('sm_property', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	function show_country(){
		$this->db->select('*');
		$this->db->from('sm_country');
		$this->db->order_by('country_name','asc'); 
		$query=$this->db->get();
		return $query; 
	}
	function show_cntry_id($country_id){
		$this->db->select('country_name');
		$this->db->from('sm_countries');
		$this->db->where('country_id', $country_id); 
		$this->db->order_by('country_id', 'asc');
		$this->db->limit('1,0');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function show_property_multi_image($id){
		$sql ="select * from sm_multi_img where property_id = '".$id."'";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
		
	}
	
	function show_property_multi_img($id){
		$sql ="select * from sm_multi_img where id = '".$id."'";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
		
	}
	
function show_property()
	{
		$sql ="select * from sm_property ORDER BY id DESC";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	function show_propertyjoin()
	{
		$this->load->database();
		
$this->db->select('sm_property.*,sm_property_type.*');
$this->db->from('sm_property');
$this->db->join('sm_property_type', 'sm_property_type.property_type_id = sm_property.pid order by sm_property.id DESC'); 
$query = $this->db->get();
return $query->result();
return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	function show_property_type(){
		$this->db->select('*');
		$this->db->from('sm_property_type');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function show_cntry(){
		$this->db->select('*');
		$this->db->from('sm_countries');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
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
		$this->db->from('sm_property');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function property_edit($id, $data){
	
		$this->db->where('id', $id);
		//@unlink("property/".$old_file);
		$this->db->update('sm_property',$data);
	}
function updt($stat,$id){
	 
		$sql ="update sm_property set property_status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	function property_view($id){
		$this->db->select('*');
		$this->db->from('sm_property');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return($query->num_rows() > 0) ? $query->result(): NULL;
		
	}
	
	function multi_img($id){
		$this->db->select('*');
		$this->db->from('sm_multi_img');
		$this->db->where('property_id', $id);
		$query = $this->db->get();
		return($query->num_rows() > 0) ? $query->result(): NULL;
		
	}
	
	function property_viewjoin($id){
	$this->load->database();
	$this->db->select ( '*' ); 
	$this->db->from('sm_property');
	$this->db->join('sm_property_type', 'sm_property.pid = sm_property_type.property_type_id');
	//$this->db->join('multi_img', 'multi_img.property_id = property.id');
	$this->db->where('property.id', $id);
$query = $this->db->get();
//$query = $this->db->get();
return $query->result();
return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	function delete_property($id){
	  $this->db->where('id', $id);
	 // unlink("property/".$property_image);
      $this->db->delete('sm_property'); 
	}
	
	function delete_property_img($id,$apartment_image){
	  $this->db->where('id', $id);
	  @unlink("property_img/".$apartment_image);
      $this->db->delete('sm_multi_img'); 
	}
function show_propertylist()
	{
		$sql ="select * from sm_property ORDER BY id DESC";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
}
?>