<?php
    class controller_contact {
        function __construct(){
            $_SESSION['module']= "contact";
        }

        function list_contact(){//carga la vista(el top_page y el footer)
            require(CLIENT_VIEW_PATH . "/inc/client_top_page.html");
            require(CLIENT_CONTACT_VIEW_PATH . "/inc/contact_top_page.html");
            require(CLIENT_VIEW_PATH . "/inc/client_menu.html");
            require(CLIENT_VIEW_PATH . "/inc/client_header.html");
			loadView(CLIENT_CONTACT_VIEW_PATH,'contact.html');
			require(CLIENT_VIEW_PATH . "/inc/client_footer.html");
        }
    }