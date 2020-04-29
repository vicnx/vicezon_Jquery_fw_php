<?php
//Lo que hace este script es crear una tabla dentro de la BD "Tienda"(Creada previamente)
//Lo utilizo como copia de seguridad
$servername = "localhost";
$username = "vicnx";
$password = "12345678";

try {
    $conn = new PDO("mysql:host=$servername;dbname=Tienda", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    $sql2="CREATE TABLE Tablets (
        idproduct INT(255) AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL UNIQUE,
        price VARCHAR(255) NOT NULL,
        marca VARCHAR(255),
        fpublic VARCHAR(255),
        sim VARCHAR(255))";
    $conn->exec($sql2);
    echo "Si la base de datos no existia, se acaba de crear.";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
<!--  -->








