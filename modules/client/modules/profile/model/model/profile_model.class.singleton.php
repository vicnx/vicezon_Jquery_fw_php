<?php
class profile_model {
    private $bll;
    static $_instance;

    private function __construct() {
        // return "dentro construct model";
        // return home_bll::getInstance();
        $this->bll = profile_bll::getInstance();
        // include_once("/vicezon_fw_php/modules/client/modules/home/model/BLL/home_bll.class.singleton.php");
    }

    public static function getInstance() {

        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    //check user/email exists
    public function user_data($data){
        return $this->bll->user_data_BLL($data);
    }
}