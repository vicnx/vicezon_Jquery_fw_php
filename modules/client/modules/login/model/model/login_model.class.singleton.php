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

    //create acc local
    public function insert_user_local($option){
        return $this->bll->insert_user_local_BLL($option);
    }

    //active acc local
    function active_user($data){
        return $this->bll->active_user_BLL($data);
    }

    //login lcoal
    function login($data){
        return $this->bll->login_BLL($data);
    }

    function get_user($data){
        // return $data;
        return $this->bll->get_user_BLL($data);
    }

    function recover_password($data){
        // return $data;
        return $this->bll->recover_password_BLL($data);
    }
    function check_token($data){
        // return $data;
        return $this->bll->check_token_BLL($data);
    }
    function update_recover_token($data){
        // return $data;
        return $this->bll->update_recover_token_BLL($data);
    }

    function register_social($data){
        // return $data;
        return $this->bll->register_social_BLL($data);
    }

    function check_social($data){
        return $this->bll->check_social_BLL($data);
    }
}