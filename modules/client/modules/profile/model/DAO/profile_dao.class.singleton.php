<?php
class profile_dao {
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