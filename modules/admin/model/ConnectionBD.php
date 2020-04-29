<?php
class connection_admin extends PDO{
    private $servername = "localhost";
    private $username = "vicnx";
    private $password = "12345678";
    
    public function __construct(){
        try {
            parent::__construct("mysql:dbname=Tienda;host={$this->servername};charset=utf8", $this->username, $this->password);
        }catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
    }  
}
//prueba2

// try {
//     $conn = new PDO("mysql:host=$servername;dbname=Tienda", $username, $password);
//     // set the PDO error mode to exception
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     //echo "Connected successfully";
//     }
// catch(PDOException $e)
//     {
//     echo "Connection failed: " . $e->getMessage();
//     }
?>