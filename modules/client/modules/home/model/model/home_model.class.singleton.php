<?php
class home_model {
    private $bll;
    static $_instance;

    private function __construct() {
        // return "dentro construct model";
        // return home_bll::getInstance();
        $this->bll = home_bll::getInstance();
        // include_once("/vicezon_fw_php/modules/client/modules/home/model/BLL/home_bll.class.singleton.php");
    }

    public static function getInstance() {

        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    //carousel
    public function carousel_home(){
        // return "carousel";
        return $this->bll->carousel_home_BLL();
    }

    //top_brands
    public function top_brands($arrArgument){
        // return $arrArgument;
        return $this->bll->top_brands_BLL($arrArgument);
    }

    //products_more_visited
    public function products_more_visited($arrArgument){
        // return $arrArgument;
        return $this->bll->products_more_visited_BLL($arrArgument);
    }
}