<?php
	class controller_profile {
	    function __construct() {
			$_SESSION['module'] = "PROFILE";
			//INcluimos las funciones para descifrar el token
			include(CLIENT_UTILS_LOGIN . "functions_login.inc.php");
			
	    }
		//profile
		function list_profile(){
            require(CLIENT_VIEW_PATH . "inc/client_top_page.php");
            require(CLIENT_PROFILE_VIEW_PATH . "inc/profile_top_page.html");
            require(CLIENT_VIEW_PATH . "inc/client_menu.html");
            require(CLIENT_VIEW_PATH . "inc/client_header.html");
			loadView(CLIENT_PROFILE_VIEW_PATH,'profile.html');
			require(CLIENT_VIEW_PATH . "inc/client_footer.html");
		}

		function user_data(){
			$data=$_POST['token'];
			$result=loadModel(CLIENT_MODEL_PROFILE, "profile_model", "user_data", $data);
			echo json_encode($result);
		}
	}