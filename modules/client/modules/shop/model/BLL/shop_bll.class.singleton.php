<?php
	class shop_bll{
	    private $dao;
	    private $db;
	    static $_instance;

	    private function __construct() {
	        $this->dao = shop_dao::getInstance();
	        $this->db = db::getInstance();
	    }

	    public static function getInstance() {
            // return "bll dentro";
	        if (!(self::$_instance instanceof self)){
	            self::$_instance = new self();
	        }
	        return self::$_instance;
	    }

		//all
	    public function all_products_BLL($arrArgument){
            $page=$arrArgument['page'];
            $values=$arrArgument['values'];

            if($page=="nada"){
                return $this->dao->select_all_products($this->db,$values);
            }else{
                if($page==0){
                    return $this->dao->select_all_products($this->db,$values,$page);
                }else{
                    return $this->dao->select_all_products($this->db,$values,$page*5);
                }
                
            }
			// return "BLL";
		}

		//load filters
		public function load_filters_BLL(){
			// return "load_filters bll";
			return $this->dao->select_all_brands($this->db);
		}

		//bybrand
		public function bybrand_products_BLL($arrArgument){
            $page=$arrArgument['page'];
            $values=$arrArgument['values'];
            if($page=="nada"){
                return $this->dao->select_products_by_brand($this->db,$values);
            }else{
                if($page==0){
                    return $this->dao->select_products_by_brand($this->db,$values,$page);
                }else{
                    return $this->dao->select_products_by_brand($this->db,$values,$page*5);
                }
                
            }
		}

		//bybrand order
		public function bybrandsorder_products_BLL($arrArgument){
			$page=$arrArgument['page'];
			$values=$arrArgument['values'];
			$order=$arrArgument['order'];
			// return $order;
			if($page=="nada"){
				return $this->dao->select_products_by_brand_and_order($this->db,$values,$order);
			}else{
				if($page==0){
					return $this->dao->select_products_by_brand_and_order($this->db,$values,$order,$page);
				}else{
					return $this->dao->select_products_by_brand_and_order($this->db,$values,$order,$page*5);
				}
			}
		}

		//only order
		public function onlyorder_products_BLL($arrArgument){
			$page=$arrArgument['page'];
			$values=$arrArgument['values'];
			$order=$arrArgument['order'];
			// return $order;
			if($page=="nada"){
				return $this->dao->select_products_order($this->db,$values,$order);
			}else{
				if($page==0){
					return $this->dao->select_products_order($this->db,$values,$order,$page);
				}else{
					return $this->dao->select_products_order($this->db,$values,$order,$page*5);
				}
			}
		}

		//load filters
		public function details_BLL($arrArgument){
			// return "detials BLL: ".$arrArgument;
			$this->dao->addview_product($this->db,$arrArgument);
			$this->dao->addview_brand($this->db,$arrArgument);
			return $this->dao->select_one_product($this->db,$arrArgument);
		}

		public function busqueda_text_marca_products_BLL($arrArgument){
			$page=$arrArgument['page'];
			$values=$arrArgument['values'];
			$order=$arrArgument['order'];

			$values=$arrArgument['values'];
			$datos= explode(",", $values);
			$texto=$datos[0];//cogemos el texto
			unset($datos[0]);//eliminamos el texto del array
			$marcas= implode(",",$datos);//juntamos el array en una string separada por comas (seran las marcas)
			if($page=="nada"){
				return $this->dao->select_products_text_marca_order_search($this->db,$texto,$marcas,$order);
			}else{
				if($page==0){
					return $this->dao->select_products_text_marca_order_search($this->db,$texto,$marcas,$order,$page);
				}else{
					return $this->dao->select_products_text_marca_order_search($this->db,$texto,$marcas,$order,$page*5);
				}
			}
		}

		public function busqueda_text_products_BLL($arrArgument){
			$page=$arrArgument['page'];
			$values=$arrArgument['values'];
			$order=$arrArgument['order'];

			$values=$arrArgument['values'];
			$datos= explode(",", $values);
			$texto=$datos[0];//cogemos el texto
			unset($datos[0]);//eliminamos el texto del array
			$marcas= implode(",",$datos);//juntamos el array en una string separada por comas (seran las marcas)
			if($page=="nada"){
				return $this->dao->select_products_text_order_search($this->db,$texto,$marcas,$order);
			}else{
				if($page==0){
					return $this->dao->select_products_text_order_search($this->db,$texto,$marcas,$order,$page);
				}else{
					return $this->dao->select_products_text_order_search($this->db,$texto,$marcas,$order,$page*5);
				}
			}
		}

		public function busqueda_marca_products_BLL($arrArgument){
			$page=$arrArgument['page'];
			$values=$arrArgument['values'];
			$order=$arrArgument['order'];

			$values=$arrArgument['values'];
			$datos= explode(",", $values);
			$texto=$datos[0];//cogemos el texto
			unset($datos[0]);//eliminamos el texto del array
			$marcas= implode(",",$datos);//juntamos el array en una string separada por comas (seran las marcas)
			// return $datos;
			if($page=="nada"){
				return $this->dao->select_products_marca_order_search($this->db,$marcas,$order);
			}else{
				if($page==0){
					return $this->dao->select_products_marca_order_search($this->db,$marcas,$order,$page);
				}else{
					return $this->dao->select_products_marca_order_search($this->db,$marcas,$order,$page*5);
				}
			}
		}
		public function check_like_on_click_BLL($data){
			// return $name;
			// $this->dao->addview_product($this->db,$data);
			return $this->dao->check_like_click($this->db,$data);
		}

		public function do_like_BLL($data){
			// return $name;
			// $this->dao->addview_product($this->db,$data);
			return $this->dao->do_like($this->db,$data);
		}
		public function remove_like_BLL($data){
			// return $name;
			// $this->dao->addview_product($this->db,$data);
			return $this->dao->remove_like($this->db,$data);
		}
		public function check_likes_BLL($data){
			// return $name;
			// $this->dao->addview_product($this->db,$data);
			return $this->dao->check_likes($this->db,$data);
		}
	}