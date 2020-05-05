<?php
	class controller_login {
	    function __construct() {
			$_SESSION['module'] = "LOGIN";
			include(CLIENT_UTILS_LOGIN . "functions_login.inc.php");
			
	    }
		//login 
		function list_login(){
            require(CLIENT_VIEW_PATH . "inc/client_top_page.php");
            require(CLIENT_LOGIN_VIEW_PATH . "inc/login_top_page.html");
            require(CLIENT_VIEW_PATH . "inc/client_menu.html");
            require(CLIENT_VIEW_PATH . "inc/client_header.html");
			loadView(CLIENT_LOGIN_VIEW_PATH,'login.html');
			require(CLIENT_VIEW_PATH . "inc/client_footer.html");
		}

		function list_register(){
            require(CLIENT_VIEW_PATH . "inc/client_top_page.php");
            require(CLIENT_LOGIN_VIEW_PATH . "inc/register_top_page.html");
            require(CLIENT_VIEW_PATH . "inc/client_menu.html");
            require(CLIENT_VIEW_PATH . "inc/client_header.html");
			loadView(CLIENT_LOGIN_VIEW_PATH,'register.html');
			require(CLIENT_VIEW_PATH . "inc/client_footer.html");
		}

		function register(){
			echo json_encode("register");
			// $info_data = json_decode($_POST['total_data'],true);
			// $response = validate_data($info_data,'register');

			// if ($response['result']) {
			// 	$result['token'] = loadModel(MODEL_LOGIN,'login_model','insert_userp',$info_data);
			// 	if ($result) {
			// 		$result['type'] = 'alta';
			// 		$result['inputEmail'] = $info_data['remail'];
			// 		$result['inputMessage'] = 'Para activar tu cuenta en ohana dogs pulse en el siguiente enlace';
			// 		enviar_email($result);
			// 	}
			// 	echo json_encode($result);
			// }else{
			// 	$jsondata['success'] = false;
		 	// 	$jsondata['error'] = $response['error'];
 			// 	header('HTTP/1.0 400 Bad error');
			// 	echo json_encode($jsondata);
			// }
		}
	}