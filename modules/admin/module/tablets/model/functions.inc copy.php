<?php
    include_once("module/tablets/model/TabletsDAO.php");

    function validate_tablet_php(){
        //echo "dentro";
        $error="";
        $nombre=$_POST['nombre'];
        $price=$_POST['price'];
        $marca=$_POST['marca'];
        $fpublic=$_POST['fpublic'];
        $sim=$_POST['sim'];
        //echo $nombre;
        if(FindNameTablet($nombre)){
            //echo"Nombre encontrado";
            $error="This tablet already exists!";
            $return=array('valid'=>false,'error'=>$error);
            return $return;
        }else{
            //echo "nombre no encontrado";
            $datos = array('nombre'=>$nombre,'price'=>$price,'marca'=>$marca,'fpublic'=>$fpublic,'sim'=>$sim);
            $return=array('valid'=>true,'error'=>$error,'datos'=>$datos);
            return $return;
        }
    }



    function debugear($array){
		echo "<pre>";
		print_r($array);
		echo "</pre><br>";
	}
?>
