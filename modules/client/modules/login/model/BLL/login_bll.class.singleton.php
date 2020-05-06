<?php
	class login_bll{
	    private $dao;
	    private $db;
	    static $_instance;

	    private function __construct() {
	        $this->dao = login_dao::getInstance();
	        $this->db = db::getInstance();
	    }

	    public static function getInstance() {
            // return "bll dentro";
	        if (!(self::$_instance instanceof self)){
	            self::$_instance = new self();
	        }
	        return self::$_instance;
	    }

		//check if username exists
		public function exists_check_local_BLL($data){
			$type=$data['check_type'];
			if($type == "username"){
				$username=$data['username'];
				return $this->dao->findUsername_local($this->db,$username);
			}else{
				$email=$data['email'];
				return $this->dao->findEmail_local($this->db,$email);
			}
		}

		public function insert_user_local_BLL($data){
			return $this->dao->insert_user_local($this->db,$data);
		}
	}