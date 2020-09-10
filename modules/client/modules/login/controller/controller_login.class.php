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

		function list_recover_password(){
            require(CLIENT_VIEW_PATH . "inc/client_top_page.php");
            require(CLIENT_LOGIN_VIEW_PATH . "inc/register_top_page.html");
            require(CLIENT_VIEW_PATH . "inc/client_menu.html");
            require(CLIENT_VIEW_PATH . "inc/client_header.html");
			loadView(CLIENT_LOGIN_VIEW_PATH,'change_password.html');
			require(CLIENT_VIEW_PATH . "inc/client_footer.html");
		}

		function list_recover_send_mail(){
            require(CLIENT_VIEW_PATH . "inc/client_top_page.php");
            require(CLIENT_LOGIN_VIEW_PATH . "inc/register_top_page.html");
            require(CLIENT_VIEW_PATH . "inc/client_menu.html");
            require(CLIENT_VIEW_PATH . "inc/client_header.html");
			loadView(CLIENT_LOGIN_VIEW_PATH,'request_password.html');
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
			if ($result){
				$new_token_JWT=generate_token_JWT($result[0]['id']);
			}
			$arresult= array(
				"token" => $new_token_JWT,
				"result" => $result
			);
			echo json_encode($arresult);
		}

		function recover_send_mail(){
			$ok = validate_email_exists_local();

			if ($ok['exist']==true){
				$data=$ok['data'];
				$result=loadModel(CLIENT_MODEL_LOGIN, "login_model", "update_recover_token",$data);
				$mail['type'] = 'recover';
				$mail['inputEmail'] = $data['email'];
				$mail['token']= $data['token_recover'];
				enviar_email($mail);
				echo json_encode("done");
			}else{
				echo json_encode("fail");
			}
			
		}

		function recover_password(){
			$data= array(
				'password' => $_POST['password'],
				'token_recover' => $_POST['token']
			);
			$result=loadModel(CLIENT_MODEL_LOGIN, "login_model", "check_token",$data);
			if($result == null){
				echo json_encode("fail");
			}else{
				loadModel(CLIENT_MODEL_LOGIN, "login_model", "recover_password",$data);
				echo json_encode("done");
			}
			// echo json_encode($result);
		}

		function social_login(){
			$data=$_POST['datos'];
			$result=loadModel(CLIENT_MODEL_LOGIN, "login_model", "check_social",$data);
			if ($result == null){//NO ESTA REGISTRADO AUN
				$insert=loadModel(CLIENT_MODEL_LOGIN, "login_model", "register_social",$data);
				// echo json_encode("registered")
			}
			$token_jwt=generate_token_JWT($data['uid']);
			echo $token_jwt;
			// echo json_encode($insert);
			// echo json_encode($result);
		}

		function activity_check_token(){
			$data=$_POST['token'];
			activity($data);
			echo json_encode(activity($data)['success']); 
		}
	}