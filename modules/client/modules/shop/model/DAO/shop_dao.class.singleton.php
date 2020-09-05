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
        $sql = "SELECT * FROM tablets Where idproduct=$idproduct";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function addview_product($db,$idproduct){
        $sql = "UPDATE tablets SET views=views+1 WHERE idproduct=$idproduct";
        return $db->ejecutar($sql);
    }

    public function addview_brand($db,$idproduct){
        $sql = "Update brands b
        inner join tablets t
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

    public function check_like_click($db,$data) {
        $idproduct=$_POST['idproduct'];
        $token=$data['token'];
        $json= decode_token($token);
        $id_user=  json_decode($json)->name;
        $sql = "SELECT * FROM likes WHERE id_user='$id_user' and idproduct='$idproduct'";
        // return $sql;
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function do_like($db,$data) {
        $idproduct=$_POST['idproduct'];
        $token=$data['token'];
        $json= decode_token($token);
        $id_user=  json_decode($json)->name;
        $sql = "INSERT INTO likes (id_user,idproduct) values ('$id_user','$idproduct')";
        // return $sql;
        return $db->ejecutar($sql);
        // return $db->listar($stmt);
    }

    public function remove_like($db,$data) {
        $idproduct=$_POST['idproduct'];
        $token=$data['token'];
        $json= decode_token($token);
        $id_user=  json_decode($json)->name;
        $sql = "DELETE FROM likes where id_user='$id_user' and idproduct='$idproduct'";
        // return $sql;
        return $db->ejecutar($sql);
        // return $db->listar($stmt);
    }

    public function check_likes($db,$data) {
        $token=$data;
        $json= decode_token($token);
        $id_user=  json_decode($json)->name;
        $sql = "SELECT * FROM likes where id_user='$id_user'";
        // return $sql;
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }


}