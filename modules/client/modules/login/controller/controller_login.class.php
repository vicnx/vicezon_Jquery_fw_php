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
			// echo json_encode($data);
			$ok = validate_username_registered();
			// echo json_encode($ok);
			if($ok['exist']==false){
				$data=$ok['datos'];
				$result=loadModel(CLIENT_MODEL_LOGIN,'login_model','insert_user_local',$data);
				if($result){
					$mail['type'] = 'check';
					$mail['inputEmail'] = $data['email'];
					$mail['token']= $data['token_check'];
					enviar_email($mail);
				}
				// $token_check= $ok['token_check'];
				echo "Registrado correctamente";
			}else{
				echo $ok['error'];
			}
		}

		function active_user(){
			if (isset($_GET['param'])) {
	    		loadModel(CLIENT_MODEL_LOGIN, "login_model", "active_user",$_GET['param']);
	    	}	
		}

		function login(){
			$data = array(
				'username' => $_POST['login_username'],
				'password' => $_POST['login_password']
			);
			$result=loadModel(CLIENT_MODEL_LOGIN, "login_model", "login",$data);
			if(!$result){
				echo "user no existe";
			}else{
				if(password_verify($data['password'],$result[0]['password'])){
					$token_jwt=generate_token_JWT($data['username']);
					$response = array(
						'response' => "datos_validos",
						'token_jwt' => $token_jwt
					);
					echo json_encode($response);
				}else{
					echo "contraseña incorrecta";
				}
			}
			// echo json_encode($result[0]['username']);
		}

		function get_user(){
			$data=$_POST['token'];
			$result=loadModel(CLIENT_MODEL_LOGIN, "login_model", "get_user",$data);
			echo json_encode($result);
		}
	}