<?php
    function enviar_email($mail) {
        $subject = 'Correo de contacto (esto es lo que recive el cliente)';
        $return = '';
        $address= '';
        $msg=$mail['inputMessage']; 
        switch ($mail['type']) {                
            case 'contact':
                try{
                    $address = $mail['inputEmail'];
                    $subject= "Gracias por contactar con Vicezon.";
                    $msg = "Tu duda será respondida en 24 horas. Gracias!"; 
                } catch (Exception $e) {
                    $return = 0;
                }
                $result = send_mailgun('contact@vicezon.com', $address, $subject, $msg);
                return $result;
                break;
    
            case 'admin':
                $address = 'andanivicente@gmail.com';
                $subject = $mail['inputSubject'];
                $msg = 'inputName: ' . $mail['inputName']. '<br>' .
                'inputEmail: ' . $mail['inputEmail']. '<br>' .
                'inputSubject: ' . $mail['inputSubject']. '<br>' .
                'inputMessage: ' . $mail['inputMessage'];
                $result = send_mailgun('admin@vicezon.com', $address, $subject, $msg);
                return $mail;
                break;
   
        }
    }

function send_mailgun($from, $address, $subject, $msg){
    // $from="test";
    // $address="test";
    // $subject="test";
    // $msg="this is a test";

    $data = file_get_contents("view/js/apis_app.json"); //obtengo el contenido de apis.json
    $apis= json_decode($data,true); //lo convierto en array
    $api_mailgun=$apis[0]['api_mailgun'];//obtengo el campo api_mailgun
    $api_mailgun_url=$apis[0]['api_mailgun_url'];//obtengo el campo api_mailgun_url

    $config = array();
    $config['api_key'] =$api_mailgun; //API Key
    $config['api_url'] =$api_mailgun_url; //API Base URL`

   $message = array();
   $message['from'] = $from;
   $message['to'] =  $address;
   $message['h:Reply-To'] = $from;
   $message['subject'] = $subject;
   $message['html'] = $msg;

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $config['api_url']);
   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   curl_setopt($ch, CURLOPT_USERPWD, "api:{$config['api_key']}");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS,$message);
   $result = curl_exec($ch);
   curl_close($ch);
    return $result;
 }
