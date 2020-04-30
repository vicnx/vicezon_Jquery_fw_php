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

    //carousel
    public function select_data_carousel_home($db) {
        // return "dentro select";
        $sql = "SELECT * FROM tablets ORDER BY rating DESC LIMIT 10";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    //top_brands
    public function select_top_brands($db,$arrArgument) {
        $sql = "SELECT * FROM brands ORDER BY views DESC LIMIT 4 OFFSET $arrArgument";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function select_products_more_visited($db,$arrArgument) {
        $sql = "SELECT * FROM tablets ORDER BY views DESC LIMIT 4 OFFSET $arrArgument";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }
}