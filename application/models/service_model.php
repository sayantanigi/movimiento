<?php 
class Service_model extends CI_Model{
	private $category = 'sm_category';
	function __construct() {
        parent::__construct();
   }

	
	//=======================BUILDING OF MENU======================
		public function category_menu() {
        // Select all entries from the menu table
        $query = $this->db->query("select category_id, category_name,
            parent_id from " . $this->category . " order by category_id");

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
			if($parent==0){
				$clss="list-1";
				$claasspad='cccc';
			}else{
				$clss="list-3";
				$claasspad='innerlistyle';
			}
            $html .= "<ul class='".$clss."' id=".$parent.">";
            foreach ($menu['parents'][$parent] as $itemId) {
                if (!isset($menu['parents'][$itemId])) {
                    $html .= "<li class='kkk'><a href='information/".$itemId."'>". $menu['items'][$itemId]->category_name."</span></a></li>";
					
                }
                if (isset($menu['parents'][$itemId])) {
                    $html .= "<li class='".$claasspad."'><a href='information/".$itemId."'>" . $menu['items'][$itemId]->category_name."</span>";
                    $html .= $this->build_category_menu($itemId, $menu);
                    $html .= "</a></li>";
                }
            }
            $html .= "</ul>";
        }
        return $html;
    }

	}
?>