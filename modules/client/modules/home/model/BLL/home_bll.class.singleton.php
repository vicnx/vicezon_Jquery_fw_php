<?php
	class home_bll{
	    private $dao;
	    private $db;
	    static $_instance;

	    private function __construct() {
	        $this->dao = home_dao::getInstance();
	        $this->db = db::getInstance();
	    }

	    public static function getInstance() {
            // return "bll dentro";
	        if (!(self::$_instance instanceof self)){
	            self::$_instance = new self();
	        }
	        return self::$_instance;
	    }

	    public function carousel_home_BLL(){
			// return "carousel bll a dao";
	      return $this->dao->select_data_carousel_home($this->db);
	    }
	}