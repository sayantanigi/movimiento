<?php
class Category_model extends CI_Model {
    private $category = 'sm_category';
    function __construct() {
        parent::__construct();
    }
    public function insert_category($data) {
        $this->load->database();
        $this->db->insert('sm_category', $data);
        if ($this->db->affected_rows() > 1) {
            return true;
        } else {
            return false;
        }
    }
    public function category_menu() {
        $query = $this->db->query("select id, category_name, parent_id from sm_category order by id");
        $cat = array(
            'items' => array(),
            'parents' => array()
        );
        foreach ($query->result() as $cats) {
            $cat['items'][$cats->id] = $cats;
            $cat['parents'][$cats->parent_id][] = $cats->id;
        }
        if ($cat) {
            $result = $this->build_category_menu(0, $cat);
            return $result;
        } else {
            return FALSE;
        }
    }
    function build_category_menu($parent, $menu) {
        $html = "";
        if (isset($menu['parents'][$parent])) {
            $html .= "<ul class='topul'>";
            foreach ($menu['parents'][$parent] as $itemId) {
                if (!isset($menu['parents'][$itemId])) {
                    $html .= "<li><input type='radio' class='catlist' name='pid' value=" . $menu['items'][$itemId]->id . " style='margin-left: -10px;'>" . $menu['items'][$itemId]->category_name . "</span></a></li>";
                }
                if (isset($menu['parents'][$itemId])) {
                    $html .= "<li><input type='radio' name='pid' class='catlist' value=" . $menu['items'][$itemId]->id . " style='margin-left: -10px;'><span>" . $menu['items'][$itemId]->category_name . "</span>";
                    $html .= $this->build_category_menu($itemId, $menu);
                    //$html .= "<hr>";
                    $html .= "</li>";
                }
            }
            $html .= "</ul>";
        }
        return $html;
    }
    public function category_menu_category() {
        $query = $this->db->query("select id, category_name, parent_id from " . $this->sm_category . " order by id");
        $cat = array(
            'items' => array(),
            'parents' => array()
        );
        foreach ($query->result() as $cats) {
            $cat['items'][$cats->id] = $cats;
            $cat['parents'][$cats->parent_id][] = $cats->id;
        }
        if ($cat) {
            $result = $this->build_category_category(0, $cat);
            return $result;
        } else {
            return FALSE;
        }
    }
    function build_category_category($parent, $menu) {
        $html = "";
        if (isset($menu['parents'][$parent])) {
            $html .= "<ul class='breadcrumb'>";
            foreach ($menu['parents'][$parent] as $itemId) {
                if (!isset($menu['parents'][$itemId])) {
                    $html .= "<li>" . $menu['items'][$itemId]->category_name . "</li>";
                }
                if (isset($menu['parents'][$itemId])) {
                    $html .= "<li>" . $menu['items'][$itemId]->category_name . "";
                    $html .= $this->build_category_category($itemId, $menu);
                    //$html .= "<hr>";
                    $html .= "</li>";
                }
            }
            $html .= "</ul>";
        }
        return $html;
    }
    public function category_listing() {
        $query = $this->db->query("select id, category_name, parent_id from " . $this->sm_category . " order by id");
        $cat = array(
            'items' => array(),
            'parents' => array()
        );
        foreach ($query->result() as $cats) {
            $cat['items'][$cats->id] = $cats;
            $cat['parents'][$cats->parent_id][] = $cats->id;
        }
        if ($cat) {
            $result = $this->build_category_listing(0, $cat);
            return $result;
        } else {
            return FALSE;
        }
    }
    function build_category_listing($parent, $menu) {
        $html = "";
        if (isset($menu['parents'][$parent])) {
            $html .= "<ul>";
            $html .= "<br><div style='display:inline-flex; width:100% !important;'>";
            foreach ($menu['parents'][$parent] as $itemId) {
                if (!isset($menu['parents'][$itemId])) {
                    $baseurl = 'http://localhost:81/nahidsproperty/admin';
                    $html .= "<li>" . $menu['items'][$itemId]->category_name . "</li>";
                }
                if (isset($menu['parents'][$itemId])) {
                    $html .= "<div style='display:inline-flex;'>" . "<li>" . $menu['items'][$itemId]->category_name . "</li>" . "</div>";
                    $html .= $this->build_category_listing($itemId, $menu);
                    $html .= "<div style='clear:both;'>&nbsp;</div>";
                }
            }
            $html .= "</div>";
            $html .= "</ul>";
        }
        return $html;
    }
    public function getCategories() {
        $query = $this->db->get_where('sm_category', array('parent_id' => 0));
        return $query->result();
    }
    function getSubcategories($cat_id) {
        $this->db->select('*');
        $this->db->from('sm_category');
        $this->db->where(array('parent_id' => $cat_id));
        $query = $this->db->get();
        return $query->result();
    }
    /*function show_category_main() {
        $sql ="select * from np_categorycategory_details WHERE pid=0";
        //$this->db->where('pid', 0);
        $query = $this->db->query($sql);
        return($query->num_rows() > 0) ? $query->result(): NULL;
    }
    function show_category_sub($id) {
        $sql ="select * from np_categorycategory_details";
        $this->db->where('pid', $id);
        $query = $this->db->query($sql);
        return($query->num_rows() > 0) ? $query->result(): NULL;
    }*/
    function show_category() {
        $user = $this->session->userdata('userid');
        $this->db->select('*');
        $this->db->from('sm_category');
        //$this->db->where('userid', $user);
        //$this->db->where();
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        $result = $query->result();
        return ($query->num_rows() > 0) ? $query->result() : NULL;
    }
    function show_category_id($id) {
        $this->db->select('*');
        $this->db->from('sm_category');
        $query = $this->db->get();
        $result = $query->result();
        //echo $this->db->last_query(); exit;
        return $result;
    }
    function category_edit($id, $datalist) {
        $this->db->where('id', $id);
        $this->db->update('sm_category', $datalist);
    }
    function updt($stat, $id) {
        $sql = "update np_news set news_status=$stat where id=$id ";
        $query = $this->db->query($sql);
        //return($query->num_rows() > 0) ? $query->result(): NULL;
    }
    function show_categorylist() {
        $this->db->select('*');
        $this->db->from('sm_category');
        $this->db->where('parent_id', 0);
        $query = $this->db->get();
        $result = $query->result();
        return ($query->num_rows() > 0) ? $query->result() : NULL;
    }
    function delete_category($id) {
        $query = $this->db->get_where('sm_category', array('id' => $id));
        if ($query->num_rows() < 1) {
            $this->db->where('id', $id);
            $this->db->delete('sm_category');
            echo $this->db->last_query(); exit;
            return true;
        } else {
            return false;
        }
    }
    /*function delete_mul($ids) {
        $ids = $ids;
        $count = 0;
        foreach ($ids as $id) {
            $did = intval($id).'<br>';
            $this->db->where('id', $did);
            unlink("news/".$news_image);
            $this->db->delete('np_news');  
            $count = $count+1;
        }     
        echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">'.$count.' Item deleted successfully</div>';
        $count = 0;		
    }*/
}
?>