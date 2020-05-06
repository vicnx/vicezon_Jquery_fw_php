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

    //check user/email exists
    public function exists_check_local($option){
        return $this->bll->exists_check_local_BLL($option);
    }

    public function insert_user_local($option){
        return $this->bll->insert_user_local_BLL($option);
    }

    //autocomplete
    function autocomplete($data){
        return $this->bll->autocomplete($data);
    }
}