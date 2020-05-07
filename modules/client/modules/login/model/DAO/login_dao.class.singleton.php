<?php
class login_dao {
    static $_instance;

    private function __construct() {
        $_SESSION['c']='c';
    }

    public static function getInstance() {
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    //fin username
    public function findUsername_local($db,$username) {
        // return "dentro select";
        $sql = "SELECT username FROM users WHERE username='$username' AND register_type='local'";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    //find email
    public function findEmail_local($db,$email) {
        // return "dentro select";
        $sql="SELECT email FROM users WHERE email='$email' AND register_type='local'"; //solo busca en los que son locales
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function insert_user_local($db,$data) {
        $username=$data['username'];
        $first_name=$data['first_name'];
        $last_name=$data['last_name'];
        $email=$data['email'];
        $password=$data['password'];
        $typee='client';
        $token_check=$data['token_check'];
        $token_recover=$data['token_recover'];
        $register_type=$data['register_type'];
        $hashavatar = md5 (strtolower(trim($email)));
        $avatar="https://www.gravatar.com/avatar/$hashavatar?s=40&d=identicon";
        // return "dentro select";
        $sql="INSERT INTO users (id, username, first_name, last_name, email,password,type, avatar, token_check, token_recover,register_type)
        VALUES ('$username','$username','$first_name','$last_name','$email','$password' ,'$typee','$avatar','$token_check','$token_recover','$register_type')"; //solo busca en los que son locales
        return $db->ejecutar($sql);
    }

    public function active_user($db,$data) {
        // return "dentro select";
        $new_token=generate_token_check_secure(20);
        $sql="UPDATE users SET active=1,token_check='$new_token' where token_check='$data'";
        return $db->ejecutar($sql);
    }


    public function login($db,$data) {
        $username=$data['username'];
        $password=$data['password'];
        // return "dentro select";
        $sql="SELECT * FROM users where username='$username' AND register_type='local'";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function get_user($db,$data) {
        // return $data;
        $json = decode_token($data);
        $name=  json_decode($json)->name;
        // return $name;
        // return "dentro select";
        $sql="SELECT * FROM users where id='$name'";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }


}