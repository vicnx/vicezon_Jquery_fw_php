<?php
	class cart_bll{
	    private $dao;
	    private $db;
	    static $_instance;

	    private function __construct() {
	        $this->dao = cart_dao::getInstance();
	        $this->db = db::getInstance();
	    }

	    public static function getInstance() {
            // return "bll dentro";
	        if (!(self::$_instance instanceof self)){
	            self::$_instance = new self();
	        }
	        return self::$_instance;
	    }

	    public function check_stock_BLL($data){
			// return "test";
	      return $this->dao->select_product($this->db,$data);
		}
		public function insert_cart_bd_BLL($data){
			$cart=$data['cart'];
			$token=$data['token'];
			foreach ($cart as $product){
				$idproduct=$product['id'];
				$qty=$product['qty'];
				$insert=$this->dao->insert_cart_bd($this->db,$idproduct,$qty,$token);
			}
	      	return $insert;
		}
		public function only_delete_cart_BLL($data){
			// return "test";
	      return $this->dao->only_delete_cart($this->db,$data);
		}

		public function get_products_cart_local_BLL($data){
			// return "test";
	      return $this->dao->select_product($this->db,$data);
		}

		public function coger_cart_bd_BLL($token){
			// return "test";
	      return $this->dao->coger_cart_bd($this->db,$token);
		}

		public function checkout_check_stock_BLL($cart){
			foreach ($cart as $product){
				$idproduct=$product['id'];
				$qty=$product['qty'];
				$check=$this->dao->select_product($this->db,$idproduct);
				if($qty > $check[0]['stock']){
					return false;
				}else{
					return true;
				}
			}
		}
		
		public function checkout_buy_BLL($data){
			$token=$data['token'];
			$user_saldo=$this->dao->check_saldo($this->db,$token);
			$total_gastado=$data['total'];
			$carrito=$_POST['cart'];
			$user_saldo=$user_saldo[0];
			if($user_saldo['saldo'] > $total_gastado){
				$new_user_saldo=($user_saldo['saldo']-$total_gastado);
				$fecha=date("Y-m-d H:i:s");
				$update_saldo=$this->dao->update_saldo($this->db,$token,$new_user_saldo);
				$factura=$this->dao->add_factura($this->db,$token,$total_gastado,$fecha);
				$factura_id=$this->dao->get_id_factura($this->db,$token,$fecha);
				$factura_id=$factura_id[0]['idfactura'];
				foreach($carrito as $product){
                    $idproduct=$product['id'];
                    $qty=$product['qty'];
					$price_product=$this->dao->get_price_product($this->db,$idproduct);
					$price_product=$price_product[0]['price'];
                    $cost=$price_product*$qty;
					$check_stock=$this->dao->select_product($this->db,$idproduct);
					$check_stock=$check_stock[0]['stock'];
					$new_stock=($check_stock-$qty);
					$update_bd_stock_product=$this->dao->update_bd_stock_product($this->db,$idproduct,$new_stock);
					$test=$this->dao->add_line_fact($this->db,$factura_id,$idproduct,$qty,$cost);
				}
				return "se_puede";
			}else{
				return "no_se_puede";
			}
	      	
		}
	}