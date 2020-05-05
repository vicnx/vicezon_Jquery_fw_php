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

    //all
    public function select_brands($db) {
        // return "dentro select";
        $sql = "Select * from brands order by namebrand ASC";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function autocomplete($db,$busqueda,$brand='') {
        if($brand == 0){
            $sql = "SELECT * FROM tablets where nombre LIKE '%$busqueda%' LIMIT 5";
        }else{
            $sql = "SELECT * FROM tablets where nombre LIKE '%$busqueda%' AND marca=$brand LIMIT 5";
        }
        // return "dentro select";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }


}