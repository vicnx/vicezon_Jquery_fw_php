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

	}