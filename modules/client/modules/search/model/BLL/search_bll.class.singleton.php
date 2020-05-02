<?php
	class search_bll{
	    private $dao;
	    private $db;
	    static $_instance;

	    private function __construct() {
	        $this->dao = search_dao::getInstance();
	        $this->db = db::getInstance();
	    }

	    public static function getInstance() {
            // return "bll dentro";
	        if (!(self::$_instance instanceof self)){
	            self::$_instance = new self();
	        }
	        return self::$_instance;
	    }

		//load brands
		public function load_brands_BLL(){
			// return "test";
			// $this->dao->addview_product($this->db,$arrArgument);
			// $this->dao->addview_brand($this->db,$arrArgument);
			return $this->dao->select_brands($this->db);
		}
		public function autocomplete($data){
			return $this->dao->autocomplete($this->db,$data['busqueda'],$data['brand_selected']);
		}
	}