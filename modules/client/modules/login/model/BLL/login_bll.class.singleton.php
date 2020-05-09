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
		public function active_user_BLL($data){
			return $this->dao->active_user($this->db,$data);
		}

		public function login_BLL($data){
			return $this->dao->login($this->db,$data);
		}

		public function get_user_BLL($data){
			// return $data;
			return $this->dao->get_user($this->db,$data);
		}

		public function recover_password_BLL($data){
			// return $data;
			$this->dao->change_password($this->db,$data);
			return $this->dao->delete_token_recover($this->db,$data);
		}

		public function check_token_BLL($data){
			// return $data;
			return $this->dao->check_token($this->db,$data);
		}

		public function update_recover_token_BLL($data){
			// return $data;
			return $this->dao->update_recover_token($this->db,$data);
		}
		public function register_social_BLL($data){
			// return $data;
			return $this->dao->register_social($this->db,$data);
		}

		public function check_social_BLL($data){
			// return $data;
			return $this->dao->check_social($this->db,$data);
		}
	}