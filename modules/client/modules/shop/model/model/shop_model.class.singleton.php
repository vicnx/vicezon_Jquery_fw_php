<?php
class shop_model {
    private $bll;
    static $_instance;

    private function __construct() {
        // return "dentro construct model";
        // return home_bll::getInstance();
        $this->bll = shop_bll::getInstance();
        // include_once("/vicezon_fw_php/modules/client/modules/home/model/BLL/home_bll.class.singleton.php");
    }

    public static function getInstance() {

        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    //list
    public function list_products($arrArgument){
        //esto lo que hace es hacer como un controlador entre las diferentes opciones!
        if($arrArgument['option'] == "all"){//sin filtros
            return $this->bll->all_products_BLL($arrArgument);
        }
        if($arrArgument['option'] == "bybrand"){//fioltrar solo con marca
            // return "FUNCIONA bybrand";
            return $this->bll->bybrand_products_BLL($arrArgument);
        }
        if($arrArgument['option'] == "bybrandsorder"){//filtrar con order y marca
            // return "FUNCIONA bybrandorder";
            return $this->bll->bybrandsorder_products_BLL($arrArgument);
        }

        if($arrArgument['option'] == "onlyorder"){//filtrar con order y marca
            // return "FUNCIONA bybrandorder";
            return $this->bll->onlyorder_products_BLL($arrArgument);
        }

        if($arrArgument['option'] == "busqueda_text_marca"){//filtrar con busqueda de text y marca
            // return $arrArgument;
            return $this->bll->busqueda_text_marca_products_BLL($arrArgument);
        }
        if($arrArgument['option'] == "busqueda_text"){//filtrar con busqueda de text (marca null)
            // return $arrArgument;
            return $this->bll->busqueda_text_products_BLL($arrArgument);
        }

        if($arrArgument['option'] == "busqueda_marca"){//filtrar con busqueda solo con marca
            // return $arrArgument;
            return $this->bll->busqueda_marca_products_BLL($arrArgument);
        }
        // return $arrArgument["option"]; 
    }

    //load filters
    public function load_filters(){
        // return "load filters"; 
        return $this->bll->load_filters_BLL();
    }

    //details
    public function details($arrArgument){
        return $this->bll->details_BLL($arrArgument);
    }
}