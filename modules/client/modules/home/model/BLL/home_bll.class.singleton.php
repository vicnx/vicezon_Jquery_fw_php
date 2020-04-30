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

		//carousel
	    public function carousel_home_BLL(){
			// return "carousel bll a dao";
	      return $this->dao->select_data_carousel_home($this->db);
		}
		
		//carousel
		public function top_brands_BLL($arrArgument){
			return $this->dao->select_top_brands($this->db,$arrArgument);
		}

		//products_more_visited
		public function products_more_visited_BLL($arrArgument){
			// return "test";
			return $this->dao->select_products_more_visited($this->db,$arrArgument);
		}
	}