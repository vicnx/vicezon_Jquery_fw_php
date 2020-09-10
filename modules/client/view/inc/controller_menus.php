<?php
if(!isset($_SESSION['type'])){
    include("module/client/view/inc/client_menu.php");
}else{
    include("module/client/view/inc/client_menu_login.php");
}