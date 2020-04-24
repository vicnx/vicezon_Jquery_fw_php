<?php
    class controller_contact {
        function __construct(){
            $_SESSION['module']= "contact";
        }

        function list_contact(){//carga la vista(el top_page y el footer)
            require(CLIENT_VIEW_PATH . "/inc/client_top_page.php");
            require(CLIENT_CONTACT_VIEW_PATH . "/inc/contact_top_page.php");
            require(CLIENT_VIEW_PATH . "/inc/client_menu.html");
            require(CLIENT_VIEW_PATH . "/inc/client_header.html");
			loadView(CLIENT_CONTACT_VIEW_PATH,'contact.html');
			require(CLIENT_VIEW_PATH . "/inc/client_footer.html");
        }

        function send_mail(){
            $name=$_POST['contact_name'];
            $surname=$_POST['contact_surname'];
            $email=$_POST['contact_email'];
            $msg=$_POST['contact_msg'];
            $full_mail_contact = array(
				'type' => 'contact',
				'token' => '',
				'inputName' => "$name $surname",
				'inputEmail' => $email,
				'inputSubject' => "Ayuda $name $surname",
				'inputMessage' => $msg
			);
            $full_mail_admin = array(
				'type' => 'admin',
				'token' => '',
				'inputName' => "$name $surname",
				'inputEmail' => $email,
				'inputSubject' => "Copia de correo enviado a $name $surname",
				'inputMessage' => $msg
			);
            try{
                $enviar_email=enviar_email($full_mail_contact);
                $enviar_email_admin=enviar_email($full_mail_admin);
                echo "done";
			} catch (Exception $e) {
				echo "fail";
            }
        }
    }