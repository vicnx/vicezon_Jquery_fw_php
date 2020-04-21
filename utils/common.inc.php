<?php
function loadView($pathview = '', $html_name = '', $arrPassValue = '') {
    $view_path = $pathview . $html_name;
    // $arrData = '';
    echo $view_path;
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