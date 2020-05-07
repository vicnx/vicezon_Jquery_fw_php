<?php
require_once("paths.php");
require 'autoload.php';

function handlerRouter() {
    // echo "HandleRouter CLient";
    if (!empty($_GET['module'])) {
        $URI_module = $_GET['module'];
    } else {
        // $URI_module = 'home';
        $URI_module = 'home';
        /////PREGUNTAR
        echo'<script>window.location.href = "./home";</script>';
        /////PREGUNTAR
    }

    if (!empty($_GET['function'])) {
        $URI_function = $_GET['function'];
    } else {
        $URI_function = 'default';//si no hay nada lo pone en default para despues declararla
        // $URI_function = 'list_home';
    }
    handlerModule($URI_module, $URI_function);
}

function handlerModule($URI_module, $URI_function) {
    $modules = simplexml_load_file(CLIENT_SITE_PATH.'/resources/modules.xml');
    $exist = false;
    // echo "<br>";
    // print_r($modules);
    
    foreach ($modules->module as $module) {
        if (($URI_module === (String) $module->uri)) {
            $exist = true;
            $default_function= (String) $module->default_function;//cojo la function default
            $path = CLIENT_MODULES_PATH . $URI_module . "/controller/controller_" . $URI_module . ".class.php";
            if (file_exists($path)) {
                require_once($path);
                $controllerClass = "controller_" . $URI_module;
                $obj = new $controllerClass;
            } else {
                // //die($URI_module . ' - Controlador no encontrado');
                // require_once(VIEW_PATH_INC . "header.php");
                // require_once(VIEW_PATH_INC . "menu.php");
                // require_once(VIEW_PATH_INC . "404.php");
                // require_once(VIEW_PATH_INC . "footer.html");
            }
            if($URI_function== "default"){
                $URI_function=$default_function;//si la funcion es default se lee l;a default del xml de modules
                // var_dump($URI_function[0]);
            }
            handlerfunction(((String) $module->name), $obj, $URI_function);
            break;
        }
    }
    if (!$exist) {
        loadError();
    }
}

function handlerfunction($module, $obj, $URI_function) {
    $functions = simplexml_load_file(CLIENT_MODULES_PATH . $module . "/resources/function.xml");
    $exist = false;
    // var_dump($functions);
    foreach ($functions->function as $function) {
        if (($URI_function === (String) $function->uri)) {
            $exist = true;
            $event = (String) $function->name;
            break;
        }
    }
    if (!$exist) {
        loadError();
    } else {
        call_user_func(array($obj, $event));
    }
}

handlerRouter();