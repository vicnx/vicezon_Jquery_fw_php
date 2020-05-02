<?php
	class controller_shop {
	    function __construct() {
	        $_SESSION['module'] = "SHOP";
	    }

		//cargamos el SHOP
	    function list_shop() {
            require(CLIENT_VIEW_PATH . "inc/client_top_page.php");
            require(CLIENT_SHOP_VIEW_PATH . "inc/shop_top_page.html");
            require(CLIENT_VIEW_PATH . "inc/client_menu.html");
            require(CLIENT_VIEW_PATH . "inc/client_header.html");
			loadView(CLIENT_SHOP_VIEW_PATH,'shop.html');
			require(CLIENT_VIEW_PATH . "inc/client_footer.html");
		}
		//list_default
		function list_products() {
			$data = array(
				'option' => $_POST['option'],
				'values' => $_POST['values'],
				'page' => $_POST['page'],
				'order' => $_POST['order']
			);
			// $values=$_POST['values'];
			// // $page=$_POST['page'];
			// echo json_encode($_POST['page']);
			$json = loadModel(CLIENT_MODEL_SHOP, "shop_model", "list_products",$data);
			echo json_encode($json);
		}

		//load filters
		function load_filters(){
			$json = loadModel(CLIENT_MODEL_SHOP, "shop_model", "load_filters");
			echo json_encode($json);
		}

		function details(){
			$idproduct= $_POST['idproduct'];
			// echo json_encode($idproduct);
			$json = loadModel(CLIENT_MODEL_SHOP, "shop_model", "details",$idproduct);
			echo json_encode($json);
		}
	}