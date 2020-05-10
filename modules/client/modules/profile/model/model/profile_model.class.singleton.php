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
    public function generator($data){
        return $this->bll->generator_BLL($data);
    }
    public function delete_all_codes(){
        return $this->bll->delete_all_codes_BLL();
    }
    public function select_all_codes(){
        return $this->bll->select_all_codes_BLL();
    }
    public function check_code($code){
        return $this->bll->check_code_BLL($code);
    }
    public function code_inactive($code){
        return $this->bll->code_inactive_BLL($code);
    }
    public function insert_money($data){
        return $this->bll->insert_money_BLL($data);
    }
}