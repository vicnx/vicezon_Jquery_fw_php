<?php
	class controller_cart {
	    function __construct() {
	        $_SESSION['module'] = "cart";
	    }

	    function list_cart() {
            require(CLIENT_VIEW_PATH . "inc/client_top_page.php");
            require(CLIENT_CART_VIEW_PATH . "inc/cart_top_page.html");
            require(CLIENT_VIEW_PATH . "inc/client_menu.html");
            require(CLIENT_VIEW_PATH . "inc/client_header.html");
			loadView(CLIENT_CART_VIEW_PATH,'cart.html');
			require(CLIENT_VIEW_PATH . "inc/client_footer.html");
		}

		function check_stock() {
			$idproduct=$_POST['idproduct'];
			$json = loadModel(CLIENT_MODEL_CART, "cart_model", "check_stock",$idproduct);
			echo json_encode($json);
		}

		function insert_cart_bd() {
			$cart=$_POST['cart'];
			$data=array(
				'cart'=>$_POST['cart'],
				'token'=>$_POST['token']
			);
			if($cart=="no-cart"){
				$json = loadModel(CLIENT_MODEL_CART, "cart_model", "only_delete_cart",$data);
				echo json_encode($json);
			}else{
				$json2 = loadModel(CLIENT_MODEL_CART, "cart_model", "only_delete_cart",$data);
				$json = loadModel(CLIENT_MODEL_CART, "cart_model", "insert_cart_bd",$data);
				echo json_encode($json);
			}
		}

		function get_products_cart_local() {
			$ids=$_POST['ids'];
			$json = loadModel(CLIENT_MODEL_CART, "cart_model", "get_products_cart_local",$ids);
			echo json_encode($json);
		}

		function coger_cart_bd() {
			$token=$_POST['token'];
			$json = loadModel(CLIENT_MODEL_CART, "cart_model", "coger_cart_bd",$token);
			echo json_encode($json);
		}

		function checkout_check_stock() {
			$cart=$_POST['cart'];
			$json = loadModel(CLIENT_MODEL_CART, "cart_model", "checkout_check_stock",$cart);
			echo json_encode($json);
		}
		function checkout_buy() {
			$data=array(
				'cart'=>$_POST['cart'],
				'total'=>$_POST['total'],
				'token'=>$_POST['token']
			);
			$json = loadModel(CLIENT_MODEL_CART, "cart_model", "checkout_buy",$data);
			echo json_encode($json);
		}

	}