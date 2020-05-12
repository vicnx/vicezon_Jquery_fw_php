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

function validate_email_exists_local(){
    $email= $_POST['email_send_mail'];
    $check_email= array( 'email'=>$email,'check_type'=>'email');
    $emailok = loadModel(CLIENT_MODEL_LOGIN,'login_model','exists_check_local',$check_email);
    if($emailok==null){
        $error="este email no existe";
        return $return=array('exist'=>false,'error'=>$error);
    }else{
        $token_recover=generate_token_check_secure(20);
        $data= array(
            'email'=>$email,
            'token_recover'=>$token_recover
        );
        return $return=array('exist'=>true,'data'=>$data);
    }
}

function generate_token_check_secure($longitud){
    if ($longitud < 4) {
        $longitud = 4;
    }
    return bin2hex(openssl_random_pseudo_bytes(($longitud - ($longitud % 2)) / 2));
}

function activity($token){
    $arrayPayload = decode_token($token);
    $name=  json_decode($arrayPayload)->name;               //payload del token que viene de localStorage
    $cmpr_token = generate_token_JWT($name);    // con el nombre del token_user generamos un nuevo token
    $newPayload = decode_token($cmpr_token);            // decodificamos el nuevo token para comparar fechas

    if(  (json_decode($arrayPayload)->exp) > (json_decode($newPayload)->iat)  ){
        $result = array(
            'success' => true,
            'token' => $cmpr_token,
            'name' => json_decode($arrayPayload)->name
        );
    } else {
        $result = array(
            'error' => true,
            'name' => "token invalid"
        );
    }

    return $result;
}

?>