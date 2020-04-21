<?php
    // echo "Dentro de Paths aplicacion";
    //project
    define('PROJECT', '/vicezon_fw_php/'); 

    //SITE ROOT
    define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . PROJECT);

    //SITE_PATH
    define('SITE_PATH', 'http://' . $_SERVER['HTTP_HOST'] . PROJECT);

    //UTILS
    define('UTILS', SITE_ROOT . 'utils/');

    //ADMIN
    //SITE_PATH ADMIN
    define('ADMIN_SITE_PATH', SITE_PATH . "modules/admin/");   
    //ADMIN_MODULES_PATH
    define('ADMIN_MODULES_PATH', SITE_ROOT . 'modules/admin/modules/');


    //CLIENT
    //SITE_PATH CLIENT (ruta cliente)
    define('CLIENT_SITE_PATH', SITE_PATH . "modules/client/"); 
    //CLIENT_MODULES_PATH (ruta hastra modules)
    define('CLIENT_MODULES_PATH', SITE_ROOT . 'modules/client/modules/');
    //VIEW PATH CLIENT (ruta view del cliente)
    define('CLIENT_VIEW_PATH', SITE_ROOT . 'modules/client/view/');
    //VIEW PATH CONTACT (view del contact)
    define('CLIENT_CONTACT_VIEW_PATH', CLIENT_MODULES_PATH . 'contact/view/');


?>
