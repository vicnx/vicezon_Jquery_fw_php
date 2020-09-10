<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/vicezon/';
include_once($path . "model/ConnectionBD.php");

function changerank(){
    $conn = new connection();
    $sql="UPDATE loginusers SET rankuser='client' WHERE iduser=1";
    $query = $conn->query($sql);
    $conn = null;
    return $query;
}
?>