<?php
class cart_dao {
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
    public function select_product($db,$idproduct) {
        // return "dentro select";
        $sql = "SELECT * FROM Tablets Where idproduct in ($idproduct) ORDER BY idproduct ASC";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    //top_brands
    public function insert_cart_bd($db,$idproduct,$qty,$token) {
        $json= decode_token($token);
        $id_user=  json_decode($json)->name;
        $sql = "INSERT INTO cart (id_user, idproduct, qty) VALUES ('$id_user','$idproduct','$qty')";
        // return $sql;
        return $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function only_delete_cart($db,$data) {
        $token=$data['token'];
        $json= decode_token($token);
        $id_user=  json_decode($json)->name;
        $sql = "DELETE FROM cart where id_user='$id_user'";
        return $db->ejecutar($sql);
    }

    public function coger_cart_bd($db,$token) {
        // return "dentro select";
        $json= decode_token($token);
        $id_user=  json_decode($json)->name;
        $sql = "SELECT * FROM cart Where id_user='$id_user'";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }
    public function check_saldo($db,$token) {
        // return "dentro select";
        $json= decode_token($token);
        $id_user=  json_decode($json)->name;
        $sql = "SELECT saldo FROM `users` WHERE id='$id_user'";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function update_saldo($db,$token,$new_user_saldo) {
        // return "dentro select";
        $json= decode_token($token);
        $id_user=  json_decode($json)->name;
        $sql = "UPDATE users SET saldo='$new_user_saldo' where id='$id_user'";
        return $db->ejecutar($sql);
    }

    public function add_factura($db,$token,$total_gastado,$fecha) {
        // return "dentro select";
        $json= decode_token($token);
        $id_user=  json_decode($json)->name;
        $sql = "INSERT INTO facturas (id_user,total_factura,fecha) VALUES ('$id_user','$total_gastado','$fecha')";
        // return $sql;
        return $db->ejecutar($sql);
    }
    public function get_id_factura($db,$token,$fecha) {
        // return "dentro select";
        $json= decode_token($token);
        $id_user=  json_decode($json)->name;
        $sql = "SELECT idfactura FROM `facturas` WHERE id_user='$id_user' AND fecha='$fecha'";
        // return $sql;
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function get_price_product($db,$idproduct) {
        // return "dentro select";
        $sql = "SELECT price FROM `tablets` WHERE idproduct='$idproduct'";
        // return $sql;
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function update_bd_stock_product($db,$idproduct,$new_stock) {
        // return "dentro select";
        $sql = "UPDATE tablets SET stock='$new_stock' where idproduct='$idproduct'";
        return $db->ejecutar($sql);
    }

    public function add_line_fact($db,$factura_id,$idproduct,$qty,$cost) {
        // return "dentro select";
        $sql = "INSERT INTO factura_linea (idfactura,idproduct,qty,cost) VALUES ('$factura_id','$idproduct','$qty','$cost')";
        return $db->ejecutar($sql);
    }


    
}