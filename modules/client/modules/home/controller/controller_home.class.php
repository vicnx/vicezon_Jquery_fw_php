<?php
	class controller_home {
	    function __construct() {
	        $_SESSION['module'] = "home";
	    }

	    function list_home() {
            require(CLIENT_VIEW_PATH . "inc/client_top_page.php");
            require(CLIENT_HOME_VIEW_PATH . "inc/home_top_page.html");
            require(CLIENT_VIEW_PATH . "inc/client_menu.html");
            require(CLIENT_VIEW_PATH . "inc/client_header.html");
			loadView(CLIENT_HOME_VIEW_PATH,'home.html');
			require(CLIENT_VIEW_PATH . "inc/client_footer.html");
		}
		
		function carousel_home() {
			// echo json_encode(MODEL_HOME);
			// $hola = home_model::getInstance();
			// $json = array();
			// $included= get_included_files();
			$json = loadModel(CLIENT_MODEL_HOME, "home_model", "carousel_home");
			echo json_encode($json);
		}
		
		function vista_admin(){
			$_SESSION['vista'] = "admin";
			echo json_encode("done");
		}

	}