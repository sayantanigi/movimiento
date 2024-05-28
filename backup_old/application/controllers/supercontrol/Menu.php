<?php
class Cms extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->model('getmenu_model');
		}
		//============Constructor to call Model====================
		function index(){
		if($this->session->userdata('is_logged_in')){
			redirect('showcmslist');
        }else{
        	$this->load->view('login');	
        }
	}
	
function get_menu() {
    $ci = & get_instance();
    $ci->load->model("getmenu_model");
    $menu['menu'] = $ci->getmenu_model->get_menu();
    $echo = echoMenu($menu['menu']);

    //$echo.= "<li><a href=" . site_url('loose_diamond').">Loose Diamonds</a></li>";
    $menu['print_menu']=$echo; 
    print_r($menu);
    //return $menu;
}

function echoMenu($arr) {
    $ci = & get_instance();
    $echo = "";
    //$echo.="<ul>";
    foreach ($arr as $subArr) {
        if (!empty($subArr['sub_menu'])) {
            $echo.= "<li>";
            $echo.= "<a href=" . site_url('product_display/index') . "/" . $subArr['id'] . ">" . $subArr['name'] . "</a>";
            if ($subArr['sub_menu']) {
                $echo.= "<ul>";
                $echo .=echoMenu($subArr['sub_menu']);
                $echo.= "</ul>";
            }
            $echo.= "</li>";
        } else {
            $echo.= "<li><a href=" . site_url('product_display/index') . "/" . $subArr['id'] . ">" . $subArr['name'] . "</a></li>";
        }
    }

    //$echo.= "</ul>";       
    return $echo;
}
}

?>

