<?php
function loadView($pathview = '', $html_name = '', $arrPassValue = '') {
    $view_path = $pathview . $html_name;
    // $arrData = '';
    // echo $view_path;
    if (file_exists($view_path)) {
        // if (isset($arrPassValue))
        //     $arrData = $arrPassValue;
        include_once($view_path);
    } else {
        /*$result = response_code($rutaVista);
        $arrData = $result;
        require_once VIEW_PATH_INC_ERROR . "error.php";*/
        //die();
    }
}

function loadModel($model_path, $model_name, $function, $arrArgument = '',$arrArgument2 = ''){
    $model = $model_path . $model_name . '.class.singleton.php';
    if (file_exists($model)) {

        include_once($model);
        $modelClass = $model_name;

        if (!method_exists($modelClass, $function)){
            throw new Exception();
        }

        // $obj = $modelClass::getInstance();
        // return $obj;

        $obj = $modelClass::getInstance();
        // return $obj;

        if($arrArgument == ''){
            return call_user_func(array($obj, $function));
        }else{
            if($arrArgument2 == ''){
                return call_user_func(array($obj, $function),$arrArgument);
            }else{
                return call_user_func(array($obj, $function),$arrArgument,$arrArgument2);
            }
        }
        
    } else {
        throw new Exception();
    }
}

function loadError(){
    require(CLIENT_VIEW_PATH . "inc/client_top_page.php");
    require(CLIENT_LOGIN_VIEW_PATH . "inc/login_top_page.html");
    require(CLIENT_VIEW_PATH . "inc/client_menu.html");
    require(CLIENT_VIEW_PATH . "inc/client_header.html");
    loadView(INC_PATH,'404.html');
    require(CLIENT_VIEW_PATH . "inc/client_footer.html");
}