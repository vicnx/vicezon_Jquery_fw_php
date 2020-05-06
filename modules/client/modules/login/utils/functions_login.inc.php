<?php
function validate_username_registered(){
    $username= $_POST['username_register'];
    $first_name= $_POST['first_name_register'];
    $last_name= $_POST['last_name_register'];
    $email= $_POST['email_register'];
    $passwordd= $_POST['password_register'];
    $password_encrypt= password_hash($passwordd, PASSWORD_DEFAULT);
    
    $check_username= array( 'username'=>$username,'check_type'=>'username');
    $check_email= array( 'email'=>$email,'check_type'=>'email');
    // return $_POST['username_register'];
    $usernameok= loadModel(CLIENT_MODEL_LOGIN,'login_model','exists_check_local',$check_username);
    if($usernameok ==null){//si no encuentra el username
        // $emailok= loadModel(CLIENT_MODEL_LOGIN,'login_model','exists_check',"email");
        $emailok= loadModel(CLIENT_MODEL_LOGIN,'login_model','exists_check_local',$check_email);
        if($emailok == null){//no encuentra el mail
            $token_check=generate_token_check_secure(20);
            $token_recover=generate_token_check_secure(20);
            $register_type="local";
            $datos = array('username'=>$username,'first_name'=>$first_name,'last_name'=>$last_name,'email'=>$email,'password'=>$password_encrypt,'token_check'=>$token_check,'token_recover'=>$token_recover,'register_type'=>$register_type);
            return $return=array('exist'=>false,'datos'=>$datos);
            // return $emailok;
        }else{
            $error="este email ya existe";
            return $return=array('exist'=>true,'error'=>$error);
            // return $emailok;
        }
    }else{// si lo encuentra
        $error="este usuario ya existe";
        // return $usernameok;
        return $return=array('exist'=>true,'error'=>$error);
    }
}

function generate_token_check_secure($longitud){
    if ($longitud < 4) {
        $longitud = 4;
    }
    return bin2hex(openssl_random_pseudo_bytes(($longitud - ($longitud % 2)) / 2));
}

?>