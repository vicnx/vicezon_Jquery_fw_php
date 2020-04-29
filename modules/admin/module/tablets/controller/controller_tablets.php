<?php
    $path2 = $_SERVER['DOCUMENT_ROOT'] . '/vicezon_fw_php/';
   include($path2 . "modules/admin/module/tablets/model/TabletsDAO.php");
   include($path2 . "modules/admin/model/AdminDAO.php");
   include($path2 . "modules/admin/model/Browser.class.php");
   include($path2 . "modules/admin/module/tablets/model/dummiestablets.php");
    // session_start();
    switch($_GET['op']){
        case 'vista_cliente';
        session_start();
            $_SESSION['vista']='cliente';
            echo json_encode("done");
            break;
        case 'createbrand';
            $fullbrand=$_POST['fullbrand'];
            echo json_encode($fullbrand);
            savebrand($fullbrand);
            break;
        case 'brands';
            $brands = selectbrands();
            echo json_encode($brands);
            exit;
            break;
        case'changerank':
            $rank=changerank();
            echo json_encode("success");
            break;
        case 'readmodal';
                $tabletdao = new TabletsDAO();
                $fdaoread = $tabletdao->select_one_tablet($_GET['idproduct']);
                $tablet=get_object_vars($fdaoread);
                $brand = selectbrandbyid($tablet["marca"]);
                $arraytablets = array(
                    "tablet" => $tablet,
                    "brand" => $brand
                );
            if(!$fdaoread){
                echo json_encode("error");
                exit;
            }else{
                echo json_encode($arraytablets);
                exit;
            }
            break;
        case 'dummies';
            try{
                dummies();
                $callback="index.php?page=controller_tablets&op=list";
                Browser::redirect($callback);
                die;
            }catch (Exception $e){
                $callback="index.php?page=503";
                Browser::redirect($callback);
                die;
            }
            break;
        case 'list';
            try{
                $tabletdao = new TabletsDAO();
                $fdaolist = $tabletdao->select_all_tablets();
            }catch (Exception $e){
                $callback="index.php?page=503";
                Browser::redirect($callback);
                die;
            }

            if(!$fdaolist){
                $callback="index.php?page=503";
                Browser::redirect($callback);
                die;
            }else{
                include("modules/admin/module/tablets/view/list_tablets.php");
            }
            break;
        case 'create';
            include("modules/admin/module/tablets/model/vtabletsphp.php");
            $valid=true;
            if(!empty($_POST)){ //Para que no cree una linea vacia
                if(isset($_POST)){
                    $valid=validate_tablet_php("create");
                    if(!$valid['check']){
                        $_SESSION['tablet']=$_POST;
                        try{
                            $tabletdao= new TabletsDAO();
                            $fdaocreate = $tabletdao->save($_POST);
                            $findid = $tabletdao->select_id_tablet_by_nombre($_POST['nombre']); //utilizo esta funcion para encontrar la id
                            //$idproduct = $_GET['id'];
                            // print_r("hole2");
                        }catch (Exception $e){
                            $callback="index.php?page=503";
                            Browser::redirect($callback);
                            die;
                        }
                        if($fdaocreate){
                            $_SESSION['mensaje']="* The tablet is created succsefully <a href='index.php?page=controller_tablets&op=read&id=". $findid ."' class='alert-link'> click here to view the tablet</a>";
                            $callback="index.php?page=controller_tablets&op=list";
                            Browser::redirect($callback);
                            die;
                        }else{
                            print_r("NANAI");
                        }
                    }else{
                        $error = "The tablet already exists";
                    }
                }
            }
            include("modules/admin/module/tablets/view/create_tablet.php");
            break;
        case 'read';
            try{
                $tabletdao = new TabletsDAO();
                $fdaoread = $tabletdao->select_one_tablet($_GET['id']);
                $tablet=get_object_vars($fdaoread);
            }catch (Exception $e){
                $callback="index.php?page=503";
                Browser::redirect($callback);
                die;
            }
            if(!$fdaoread){
                $callback="index.php?page=503";
                Browser::redirect($callback);
                die;
            }else{
                include("modules/admin/module/tablets/view/read_tablet.php");
            }
            break;
        case 'delete';
            try{
                $tabletdao = new TabletsDAO;
                $fdaodelete = $tabletdao->delete_tablet($_GET['id']);
            }catch (Exception $e) {
                $callback="index.php?page=503";
                Browser::redirect($callback);
                die;
            }
            if($fdaodelete){
                $callback="index.php?page=503";
                Browser::redirect($callback);
                die;
            }else{
                $_SESSION['mensaje']="- The tablet has been successfuly <b>DELETED</b>";
                $callback="index.php?page=controller_tablets&op=list";
                Browser::redirect($callback);
                die;
            }
            break;
        case 'deleteall';
            try{
                $tabletdao = new TabletsDAO;
                $fdaodelete = $tabletdao->deleteall();
            }catch (Exception $e) {
                echo "Error al borrar";
            }
            if($fdaodelete){
                $error = "Error emptying the table";
            }else{
                $_SESSION['mensaje']="- The table has been successfuly <b>EMPTYING</b>";
                $callback="index.php?page=controller_tablets&op=list";
                Browser::redirect($callback);
                die;
            }
            break;
        case'update';
            include("modules/admin/module/tablets/model/vtabletsphp.php");
            if(!empty($_POST)){
                if(isset($_POST)){
                    $valid=validate_tablet_php("update");
                    if(!$valid['check']){
                        try{
                            $tabletdao = new TabletsDAO();
                            $fdaoupdate = $tabletdao->update_tablet($_POST);
                            $idproduct = $_GET['id'];
                            var_dump($fdaoupdate);
                        }catch(Exception $e){
                            echo "Error Update";
                        }
                        if(!$fdaoupdate){
                            echo "Error actualizar";
                        }else{
                            $_SESSION['mensaje']="* The tablet is updated succsefully <a href='index.php?page=controller_tablets&op=read&id=". $idproduct ."' class='alert-link'> click here to view the tablet</a>";
                            $callback="index.php?page=controller_tablets&op=list";
                            Browser::redirect($callback);
                            die;                        }
                    }
                }else{
                    $error = "This name already exists";
                }
            }

            try{
                $tabletdao = new TabletsDAO();
                $fdaoupdate = $tabletdao->select_one_tablet($_GET['id']);
                $tablet=get_object_vars($fdaoupdate);
            }catch(Exception $e){
                $callback="index.php?page=503";
                Browser::redirect($callback);
                die;
            }

            if(!$fdaoupdate){
                $callback="index.php?page=503";
                Browser::redirect($callback);
                die;
            }else{
                include("modules/admin/module/tablets/view/update_tablet.php");
            }
            break;

    }
?>