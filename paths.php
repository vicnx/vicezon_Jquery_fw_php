<?php
    // echo "Dentro de Paths aplicacion";
    //project
    define('PROJECT', '/vicezon_fw_php/'); 

    //PRETTYSD
    define('URL_PRETTY', TRUE);

    //SITE ROOT
    define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . PROJECT);

    //SITE_PATH
    define('SITE_PATH', 'http://' . $_SERVER['HTTP_HOST'] . PROJECT);

    //UTILS (SITE_ROOT)
    define('UTILS', SITE_ROOT . 'utils/');

    //JS APLICACION
    define('JS_PATH', SITE_PATH . 'view/js/');

    //ADMIN
    //SITE_PATH ADMIN (SITE_PATH)
    define('ADMIN_SITE_PATH', SITE_PATH . "modules/admin/");   
    //ADMIN_MODULES_PATH (SITE_ROOT)
    define('ADMIN_MODULES_PATH', SITE_ROOT . 'modules/admin/modules/');


    //CLIENT
    //SITE_PATH CLIENT (ruta cliente) (SITE_PATH)
    define('CLIENT_SITE_PATH', SITE_PATH . "modules/client/"); 
    //CLIENT_MODULES_PATH (ruta hastra modules) (SITE_ROOT)
    define('CLIENT_MODULES_PATH', SITE_ROOT. 'modules/client/modules/');
    //VIEW PATH CLIENT (ruta view del cliente) (SITE_ROOT)
    define('CLIENT_VIEW_PATH', SITE_ROOT . 'modules/client/view/');
    //VIEW PATH CSS CLIENT (SITE_PATH)
    define('CLIENT_VIEW_CSS', CLIENT_SITE_PATH . 'view/css/');
    //VIEW PATH JS CLIENT (SITE_PATH)
    define('CLIENT_VIEW_JS', CLIENT_SITE_PATH . 'view/js/');
    //LIBRARIES CLIENT (SITE_PATH)
    define('CLIENT_VIEW_LIBRARIES', CLIENT_SITE_PATH . 'view/libraries/');

        //MODULE CONTACT
        //VIEW PATH CONTACT (view del contact) (SITE_ROOT)
        define('CLIENT_CONTACT_VIEW_PATH', CLIENT_MODULES_PATH . 'contact/view/');
        //CONTACT PATH (SITE_PATH)
        define('CLIENT_CONTACT_PATH', CLIENT_SITE_PATH . 'modules/contact/');
        // CSS CONTACT (SITE_PATH)
        define('CLIENT_CONTACT_CSS', CLIENT_CONTACT_PATH . 'view/css/');
        //JS CONTACT (SITE_PATH)
        define('CLIENT_CONTACT_JS', CLIENT_CONTACT_PATH . 'view/js/');

?>
