<?php
    include_once("module/admin/module/tablets/model/TabletsDAO.php");

    function validate_tablet_php($op){
        $error="";
        $nombre=$_POST['nombre'];
        $price=$_POST['price'];
        $marca=$_POST['marca'];
        $fpublic=$_POST['fpublic'];
        $sim=$_POST['sim'];
        $rating=['rating'];
       if($op =="create"){
        //echo $nombre;
        if(FindNameTablet($nombre)){
            //echo"Nombre encontrado";
            $error="This tablet already exists!";
            return $return=array('check'=>true,'error'=>$error);
            $check=true;
            var_dump($check);
            // $return $check;
        }else{
            //echo "nombre no encontrado";
            $datos = array('nombre'=>$nombre,'price'=>$price,'marca'=>$marca,'fpublic'=>$fpublic,'sim'=>$sim);
            return $return=array('check'=>false,'error'=>$error,'datos'=>$datos);
            $check=false;
            print_r("el check es: ".$check."<br>");
            // return $check;
        }
       }
       if($op == "update"){
        $tabletdataupdate = new TabletsDAO();
        $fdaoupdatetablet = $tabletdataupdate->select_one_tablet($_GET['id']);
        $tablet=get_object_vars($fdaoupdatetablet);
           if($nombre==$tablet['nombre']){
                $datos = array('nombre'=>$nombre,'price'=>$price,'marca'=>$marca,'fpublic'=>$fpublic,'sim'=>$sim,'rating'=>$rating);
                return $return=array('check'=>false,'error'=>$error,'datos'=>$datos);
           }else if(FindNameTablet($nombre)){
                $error="This tablet already exists!";
                return $return=array('check'=>true,'error'=>$error);
           }else{
                $datos = array('nombre'=>$nombre,'price'=>$price,'marca'=>$marca,'fpublic'=>$fpublic,'sim'=>$sim,'rating'=>$rating);
                return $return=array('check'=>false,'error'=>$error,'datos'=>$datos);
           }
       }

    }


    function debugear($array){
		echo "<pre>";
		print_r($array);
		echo "</pre><br>";
	}
?>
