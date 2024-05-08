<?php
class User_model extends Master_model
{

    function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }

    function emailExists($email){
        $r = $this -> db -> get_where($this -> table, array('email_id' => $email));
        if($r -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function createAccount($u){
        $this -> db -> insert($this -> table, $u);
        return $this -> db -> insert_id();
    }

    function validateEmail($email, $act_code){
        $r = $this -> db -> get_where($this -> table, array('email_id' => $email, 'act_code' => $act_code, 'status' => 0));
        if($r -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function loginCheck($email, $pass){
        $r = $this -> db -> get_where($this -> table, array('email_id' => $email, 'pass' => $pass));
        if($r -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function usrLoginCheck($email, $password){
        $result = $this->db->get_where($this->table, array('email' => $email, 'password' => $password, 'status' => '1', 'email_verified' => '1'));

        if($result->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function getUsrDetails($email){
        $row = $this->db->get_where($this->table, array('email' => $email, 'status' => '1'))->row();

        return $row;
    }

    function getUser($email_id){
        $rest = $this -> db -> get_where($this -> table, array('email_id' => $email_id));
        if($rest -> num_rows() > 0){
            return $rest -> row();
        }else{
            return FALSE;
        }
    }

    function getUserById($id){
        $r = $this -> db -> get_where($this -> table, array('id' => $id)) -> first_row();
        return $r;
    }

    function saveAddress($ua){
        $this -> db -> insert('users_address', $ua);
        return $this -> db -> insert_id();
    }

    function makeDefaultAddress($adid, $user_id){
        $s = array();
        $s['default_address'] = $adid;
        $this -> db -> update($this -> table, $s, array('id' => $user_id));
    }

    function getDefaultAddress($user_id){
        $ad = $this -> db -> get_where('users_address', array('user_id' => $user_id)) -> row();
        if(is_object($ad)){
            return $ad;
        }else{
            return false;
        }
    }

    function getAddress($adid){
        $ad = $this -> db -> get_where('users_address', array('id' => $adid)) -> first_row();
        return $ad;
    }

    function getUserAddresses($user_id){
        return $this -> db -> get_where('users_address', array('user_id' => $user_id)) -> result();
    }

    function myWishlistItems($user_id){
        $this -> db -> order_by('id', "DESC");
        $data = $this -> db -> get_where('wishlists', array('user_id' => $user_id)) -> result();
        return $data;
    }

    function addWishlistItem($data){
        $c = $this -> db -> get_where('wishlists', array('product_id' => $data['product_id'], 'user_id' => $data['user_id'])) -> num_rows();
        if($c == 0){
            $this -> db -> insert('wishlists', $data);
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function itemWishlist($id){
        return $this -> db -> get_where('wishlists', array('id' => $id)) -> row();
    }

    function reset_check($email){
        return $this -> db -> get_where('users', array('email_id' => $email)) -> num_rows();
    }

    function check_user($email,$pass){
        $this->db->where('email_id', $email);
        $this->db->where('pass', md5($pass));
        $this->db->where('status', 1);
        $data = $this->db->get('users');
        return $data;
    }

    function check_type($user,$type){
        $this->db->where('userId',$user);
        $this->db->where('user_type',$type);
        $query = $this->db->get('member')->num_rows();
        return $query;

    }

    public function check_value()
    {
       $this->db->where('userId',userId());
       $this->db->where('user_type', userType());
       $query = $this->db->get('member');
       return $query->num_rows();
    }

    public function deleteFile($id){
        $this->db->where('id',$id);
        $this->db->delete('member');

    }

}