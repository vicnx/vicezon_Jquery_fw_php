<?php
class home_dao {
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

    public function select_data_carousel_home($db) {
        // return "dentro select";
        $sql = "SELECT * FROM tablets ORDER BY rating DESC LIMIT 10";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }
}