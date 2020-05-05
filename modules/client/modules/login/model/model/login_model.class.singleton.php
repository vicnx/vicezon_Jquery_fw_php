<?php
class login_model {
    private $bll;
    static $_instance;

    private function __construct() {
        // return "dentro construct model";
        // return home_bll::getInstance();
        $this->bll = login_bll::getInstance();
        // include_once("/vicezon_fw_php/modules/client/modules/home/model/BLL/home_bll.class.singleton.php");
    }

    public static function getInstance() {

        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    //load brands
    public function load_brands(){
        // return "load brands search"; 
        return $this->bll->load_brands_BLL();
    }

    //autocomplete
    function autocomplete($data){
        return $this->bll->autocomplete($data);
    }
}