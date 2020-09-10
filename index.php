<?php
    // require_once 'modules/client/router/router.php';
    // require_once 'modules/admin/indexadmin.php';
    session_start();
    if(!isset($_SESSION['vista'])){
        require_once 'modules/client/router/router.php';
    }else{
        if($_SESSION['vista']=='admin'){
            require_once 'modules/admin/indexadmin.php';
        }else{
            require_once 'modules/client/router/router.php';
        }
        
    }