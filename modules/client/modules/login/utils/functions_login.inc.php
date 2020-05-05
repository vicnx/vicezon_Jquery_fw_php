<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/vicezon/';
include_once($path . "module/login/model/loginDAO.php");

function validate_username_registered(){
    $username= $_POST['username_register'];
    $first_name= $_POST['first_name_register'];
    $last_name= $_POST['last_name_register'];
    $email= $_POST['email_register'];
    $passwordd= $_POST['password_register'];
    $password_encrypt= password_hash($passwordd, PASSWORD_DEFAULT);

    if(findUsername($username)==false){
        if(findEmail($email)==false){
            $datos = array('username'=>$username,'first_name'=>$first_name,'last_name'=>$last_name,'email'=>$email,'password'=>$password_encrypt);
            return $return=array('exist'=>false,'datos'=>$datos);
        }else{
            $error="este email ya existe";
            return $return=array('exist'=>true,'error'=>$error);
        }
    }else{
        $error="este usuario ya existe";
        return $return=array('exist'=>true,'error'=>$error);
    }
}

?>