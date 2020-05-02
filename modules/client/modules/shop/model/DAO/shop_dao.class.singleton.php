<?php
class shop_dao {
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
    public function select_all_products($db,$values='',$page='') {
        // return "dentro select";
        if($page ==""){
            $sql = "SELECT * FROM tablets ORDER BY nombre ASC";
        }else{
            $sql = "SELECT * FROM tablets ORDER BY nombre ASC LIMIT 5 OFFSET $page";
        }

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function select_products_by_brand($db,$values='',$page='') {
        // $sql = "SELECT * FROM tablets WHERE marca IN( $values )ORDER BY nombre ASC";

        // return $sql;
        if($page ==""){
            $sql = "SELECT * FROM tablets WHERE marca IN( $values ) ORDER BY nombre ASC";
        }else{
            $sql = "SELECT * FROM tablets WHERE marca IN( $values ) ORDER BY nombre ASC LIMIT 5 OFFSET $page";
        }

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function select_products_by_brand_and_order($db,$values='',$order='',$page=''){
        if($page ==""){
            $sql = "SELECT * FROM tablets WHERE marca IN( $values ) ORDER BY price $order";
        }else{
            $sql = "SELECT * FROM tablets WHERE marca IN( $values ) ORDER BY price $order LIMIT 5 OFFSET $page";
        }

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function select_products_order($db,$values='',$order='',$page=''){
        if($page ==""){
            $sql = "SELECT * FROM tablets ORDER BY price $order";
        }else{
            $sql = "SELECT * FROM tablets ORDER BY price $order LIMIT 5 OFFSET $page";
        }

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }


    public function select_all_brands($db) {
        // return "dentro select";
        $sql = "SELECT * FROM brands ORDER BY namebrand ASC";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function select_one_product($db,$idproduct){
        $sql = "SELECT * FROM Tablets Where idproduct=$idproduct";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function addview_product($db,$idproduct){
        $sql = "UPDATE tablets SET views=views+1 WHERE idproduct=$idproduct";
        return $db->ejecutar($sql);
    }

    public function addview_brand($db,$idproduct){
        $sql = "Update brands b
        inner join Tablets t
        on marca=idbrand
        Set b.views=b.views+1
        where idproduct = $idproduct";
        return $db->ejecutar($sql);
    }

    public function select_products_text_marca_order_search($db,$texto,$marcas,$order,$page='') {
        if($page ==""){
            $sql = "SELECT * FROM tablets WHERE nombre LIKE '%$texto%' AND marca IN( $marcas ) ORDER BY nombre ASC";
        }else{
            $sql = "SELECT * FROM tablets WHERE nombre LIKE '%$texto%' AND marca IN( $marcas ) ORDER BY nombre ASC LIMIT 5 OFFSET $page";
        }
        // return $sql;
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function select_products_text_order_search($db,$texto,$marcas,$order,$page='') {
        if($page ==""){
            $sql = "SELECT * FROM tablets WHERE nombre LIKE '%$texto%' ORDER BY nombre ASC";
        }else{
            $sql = "SELECT * FROM tablets WHERE nombre LIKE '%$texto%' ORDER BY nombre ASC LIMIT 5 OFFSET $page";
        }
        // return $sql;
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function select_products_marca_order_search($db,$marcas,$order,$page='') {
        if($page ==""){
            $sql = "SELECT * FROM tablets WHERE marca IN( $marcas ) ORDER BY nombre ASC";
        }else{
            $sql = "SELECT * FROM tablets WHERE marca IN( $marcas ) ORDER BY nombre ASC LIMIT 5 OFFSET $page";
        }
        // return $sql;
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }


}