<?php
	class controller_profile {
	    function __construct() {
			$_SESSION['module'] = "PROFILE";
			//INcluimos las funciones para descifrar el token
			include(CLIENT_UTILS_LOGIN . "functions_login.inc.php");
			include(CLIENT_UTILS_PROFILE . "functions_profile.inc.php");
			
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

		function generator(){
			$code=generate_money_code();
			$data=array(
				'money'=>$_POST['money'],
				'code'=>$code,
			);
			$result=loadModel(CLIENT_MODEL_PROFILE, "profile_model", "generator", $data);
			echo json_encode($code);
		}

		function delete_all_codes(){
			$result=loadModel(CLIENT_MODEL_PROFILE, "profile_model", "delete_all_codes");
			echo json_encode("deleted");
		}
		function select_all_codes(){
			$result=loadModel(CLIENT_MODEL_PROFILE, "profile_model", "select_all_codes");
			echo json_encode($result);
		}

		function check_code(){
			$code=$_POST['code'];
			$result=loadModel(CLIENT_MODEL_PROFILE, "profile_model", "check_code",$code);
			if($result==null){
				echo json_encode("fail");
			}else{
				$code_inactive=loadModel(CLIENT_MODEL_PROFILE, "profile_model", "code_inactive",$code);
				$data=array(
					'money'=>$result[0]['value'],
					'token'=>$_POST['token'],
				);
				$result2=loadModel(CLIENT_MODEL_PROFILE, "profile_model", "insert_money",$data);
				echo json_encode($result[0]['value']);
			}
			// echo json_encode($data);
		}
		function get_facturas(){
			$token=$_POST['token'];
			$result=loadModel(CLIENT_MODEL_PROFILE, "profile_model", "get_facturas",$token);
			echo json_encode($result);
		}

		function more_facturas(){
			$idfact=$_POST['idfact'];
			$result=loadModel(CLIENT_MODEL_PROFILE, "profile_model", "more_facturas",$idfact);
			echo json_encode($result);
		}
		function product_info(){
			$idproduct=$_POST['idproduct'];
			$result=loadModel(CLIENT_MODEL_PROFILE, "profile_model", "product_info",$idproduct);
			echo json_encode($result);
		}
	}