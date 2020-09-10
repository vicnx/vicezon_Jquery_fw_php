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

    public function insert_code_bd($db,$data) {
        $money=$data['money'];
        $code=$data['code'];
        $sql="INSERT INTO money_codes (code, value, state) VALUES ('$code','$money','1')";
        return $db->ejecutar($sql);
    }

    public function delete_all_codes($db) {
        $sql="TRUNCATE TABLE money_codes;";
        return $db->ejecutar($sql);
    }
    public function select_all_codes($db) {
        $sql="Select * FROM money_codes";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function check_code($db,$code) {
        $sql="Select * FROM money_codes Where code='$code' and state=1";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }
    public function code_inactive($db,$code) {
        $sql="UPDATE money_codes SET state=0 Where code='$code'";
        return $db->ejecutar($sql);
    }
    public function insert_money($db,$data) {
        $money=$data['money'];
        $token=$data['token'];
        $json = decode_token($token);
        $id=  json_decode($json)->name;
        $sql="UPDATE users SET saldo=saldo+'$money' where id='$id'";
        return $db->ejecutar($sql);
    }

    public function get_facturas($db,$token) {
        $json = decode_token($token);
        $id_user=  json_decode($json)->name;
        $sql="SELECT * FROM facturas Where id_user='$id_user'";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function more_facturas($db,$idfact) {
        // $json = decode_token($token);
        // $id_user=  json_decode($json)->name;
        $sql="SELECT * FROM factura_linea Where idfactura='$idfact'";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function product_info($db,$idproduct) {
        // $json = decode_token($token);
        // $id_user=  json_decode($json)->name;
        $sql="SELECT * FROM Tablets Where idproduct in ($idproduct) ORDER BY idproduct ASC";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    
}