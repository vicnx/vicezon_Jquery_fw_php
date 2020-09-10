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
		public function generator_BLL($data){
			return $this->dao->insert_code_bd($this->db,$data);
		}
		public function delete_all_codes_BLL(){
			return $this->dao->delete_all_codes($this->db);
		}
		public function select_all_codes_BLL(){
			return $this->dao->select_all_codes($this->db);
		}
		public function check_code_BLL($code){
			return $this->dao->check_code($this->db,$code);
		}
		public function code_inactive_BLL($code){
			return $this->dao->code_inactive($this->db,$code);
		}
		public function insert_money_BLL($data){
			return $this->dao->insert_money($this->db,$data);
		}
		public function get_facturas_BLL($token){
			return $this->dao->get_facturas($this->db,$token);
		}

		public function more_facturas_BLL($idfact){
			// return $idfact;
			return $this->dao->more_facturas($this->db,$idfact);
		}

		
		public function product_info_BLL($idproduct){
			// return $idfact;
			return $this->dao->product_info($this->db,$idproduct);
		}

		
		
	}