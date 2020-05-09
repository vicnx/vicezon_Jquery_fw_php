<?php
	class profile_bll {
	    private $dao;
	    private $db;
	    static $_instance;

	    private function __construct() {
	        $this->dao = profile_dao::getInstance();
	        $this->db = db::getInstance();
	    }

	    public static function getInstance() {
            // return "bll dentro";
	        if (!(self::$_instance instanceof self)){
	            self::$_instance = new self();
	        }
	        return self::$_instance;
	    }

		public function user_data_BLL($data){
			return $this->dao->get_user($this->db,$data);
		}
	}