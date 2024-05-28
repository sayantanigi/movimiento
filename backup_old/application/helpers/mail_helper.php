<?php
class AI_Mail{
    var $email_body;
    var $email_to, $email_to_name, $email_from, $email_subject;
    function onSignup($name, $email, $act_code){
        $m = new Mail_Template();
        $m -> setParam("name", $name);
        $m -> setParam("code", $act_code);
        $url = site_url('user/activate/?email=' . $email . '&actcode=' . $act_code);
        $str = "Dear {name} <br />Thank you for Signup with Sunburn Food. <br />Please activate your link by clicking on the link below. ";
        $str .= '<a href="'. $url .'">'. $url . '</a><br />Thanks<br />Sunburn Food';

        $this -> email_body = $m -> htmlRender($str);
        $this -> email_to = $email;
        $this -> email_to_name = $name;
        $this -> email_subject = "Sunburnfood Account Registration";
        return $this;
    }

    function sendMail(){
        //echo $this -> email_body;
        $CI =& get_instance();
        $CI -> email -> to($this -> email_to, $this -> email_to_name);
        $CI -> email -> from(SEND_EMAIL_FROM, SEND_EMAIL_FROM_NAME);
        $CI -> email -> subject($this -> email_subject);
        $CI -> email -> message($this -> email_body);
        $CI-> email -> send();

        //Reset Value;
        $this -> email_to = $this -> email_to_name = $this -> email_subject = $this -> email_body = $this ->email_from = '';
    }

    function onSuccessVerification($name, $email){
        $m = new Mail_Template();
        $m -> setParam("name", $name);
        $m -> setParam("email", $email);
        $str = "Dear {name}<br />Congratulation!! Your account has been activated successfully. You can now login with the details. <br />Thanks<br />Sunburn Food";

        $this -> email_body = $m -> htmlRender($str);
        $this -> email_body = $m -> htmlRender($str);
        $this -> email_to = $email;
        $this -> email_to_name = $name;
        $this -> email_subject = "Sunburn Food: Account Activated";
        return $this;
    }

    function onResetPassword($name, $email, $password){
        $m = new Mail_Template();
        $m -> setParam("name", $name);
        $m -> setParam("email", $email);
        $m -> setParam("password", $password);

        $text = "Dear {name}<br />You have asked for password Reset. Here is your login details: <br />Email: {email} <br />Password: {password}<br /><br />Thanks<br />Sunburn Food";

        $this -> email_body = $m -> htmlRender($text);
        $this -> email_to = $email;
        $this -> email_to_name = $name;
        $this -> email_subject = "Sunburn Food: Reset Password";
        return $this;
    }

    function onSuccessResetPassword($name, $email){
        $m = new Mail_Template();
        $m -> setParam("name", $name);
        $m -> setParam("email", $email);

        $text = "Dear {name}<br />Your password has been changed successfully. <br /><br />Thanks<br />Sunburn Food";

        $this -> email_body = $m -> htmlRender($text);
        $this -> email_to = $email;
        $this -> email_to_name = $name;
        $this -> email_subject = "Sunburn Food: Password Changed Successfully";
        return $this;
    }
}

class Mail_Template {

    var $arr;

    public function  __construct(){
        $this -> arr = array();
    }

    public function setParam($name, $value){
        $this -> arr[$name] = $value;
    }

    public function htmlRender($template){
        if(is_array($this -> arr) && count($this -> arr) > 0){
            foreach($this -> arr as $key => $val){
                $template = str_replace('{'.$key.'}', $val, $template);
            }
        }
        return $template;
    }

    function __destruct(){
        $this -> arr = array();
    }
}
