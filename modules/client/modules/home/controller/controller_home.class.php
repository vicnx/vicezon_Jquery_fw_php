<?php
	class controller_home {
	    function __construct() {
	        $_SESSION['module'] = "home";
	    }

		//cargamos el home
	    function list_home() {
            require(CLIENT_VIEW_PATH . "inc/client_top_page.php");
            require(CLIENT_HOME_VIEW_PATH . "inc/home_top_page.html");
            require(CLIENT_VIEW_PATH . "inc/client_menu.html");
            require(CLIENT_VIEW_PATH . "inc/client_header.html");
			loadView(CLIENT_HOME_VIEW_PATH,'home.html');
			require(CLIENT_VIEW_PATH . "inc/client_footer.html");
		}

		//carousel
		function carousel_home() {
			// echo json_encode(MODEL_HOME);
			// $hola = home_model::getInstance();
			// $json = array();
			// $included= get_included_files();
			$json = loadModel(CLIENT_MODEL_HOME, "home_model", "carousel_home");
			echo json_encode($json);
		}

		//top brands
		function top_brands() {
			// echo json_encode($_POST['offset']);
			$json = loadModel(CLIENT_MODEL_HOME, "home_model", "top_brands",$_POST['offset_brands']);
			echo json_encode($json);
		}
		
		//products_more_visited
		function products_more_visited(){
			// echo json_encode($_POST['offset_products']);
			$json = loadModel(CLIENT_MODEL_HOME, "home_model", "products_more_visited",$_POST['offset_products']);
			echo json_encode($json);
		}

		//vista admin
		function vista_admin(){
			$_SESSION['vista'] = "admin";
			echo json_encode("done");
		}

	}