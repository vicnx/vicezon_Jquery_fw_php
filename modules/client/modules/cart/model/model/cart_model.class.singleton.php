<?php
class cart_model {
    private $bll;
    static $_instance;

    private function __construct() {
        // return "dentro construct model";
        // return home_bll::getInstance();
        $this->bll = cart_bll::getInstance();
        // include_once("/vicezon_fw_php/modules/client/modules/home/model/BLL/home_bll.class.singleton.php");
    }

    public static function getInstance() {

        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    //carousel
    public function check_stock($data){
        // return "carousel";
        return $this->bll->check_stock_BLL($data);
    }
    public function insert_cart_bd($data){
        // return "carousel";
        return $this->bll->insert_cart_bd_BLL($data);
    }

    public function only_delete_cart($data){
        // return "carousel";
        return $this->bll->only_delete_cart_BLL($data);
    }

    public function get_products_cart_local($ids){
        // return "carousel";
        return $this->bll->get_products_cart_local_BLL($ids);
    }
    public function coger_cart_bd($token){
        // return "carousel";
        return $this->bll->coger_cart_bd_BLL($token);
    }
    public function checkout_check_stock($cart){
        // return $cart;
        return $this->bll->checkout_check_stock_BLL($cart);
    }

    public function checkout_buy($data){
        // return $data;
        return $this->bll->checkout_buy_BLL($data);
    }
    
}