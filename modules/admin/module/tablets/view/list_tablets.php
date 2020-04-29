   <?php
    if(isset($_SESSION['mensaje'])){
        if($_SESSION['mensaje']!=""){
            print "<br><div class='alert alert-success'>".$_SESSION['mensaje']."</div>";
            }  
    }     
    ?>
    <div class="containertablets">
        <div>
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <a href="index.php?page=controller_tablets&op=dummies" class="btn btn-primary float-right" data-tr="Dummies"></a>
                    <a href="index.php?page=controller_tablets&op=create" class="btn btn-success float-right" data-tr="Create Tablet"></a>
                    <div class="form-inline">
                        <div class="form-group">
                            <input type="brandnew" class="form-control" id="brandnew_input">
                            <a id="brandnew_button" class="btn btn-secondary" data-tr="Create new brand"></a>
                            <span class="" id="notify_new_brand"><span>
                        </div>
                    </div>
                    <h2 class="pull-left" data-tr="Tablets"></h2>
                    <hr class="style1"></hr>                   					                      
                </div>
                <table id="Tablets" class='table  table-striped table-light table-bordered'>
                    <thead class='table-dark'>
                        <tr>
                            <td width=125><b>#</b></th>
                            <td width=125 data-tr="<b>Name</b>"></th>
                            <td width=125 data-tr="<b>Price</b>"></th>
                            <td width=125 data-tr="<b>Option</b>"></th>
                        </tr>
                    </thead>
                    
                    <?php
                            foreach ($fdaolist as $row){
                                echo "<tr>";
                                echo "<td>" . $row['idproduct'] . "</td>";
                                echo "<td>" . $row['nombre'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td class='ultima'>";
                                    echo "<a href='#' class='viewtablet negro' id='".$row['idproduct']."'><span class='fa fa-eye'></span></a>";
                                    // echo "<a href='index.php?page=controller_tablets&op=read&id=". $row['idproduct'] ."' title='Read Tablet' class='negro viewtablet'><span class='fa fa-eye'></span></a>";
                                    echo "<a href='index.php?page=controller_tablets&op=update&id=". $row['idproduct'] ."' title='Update Tablet' class='negro'><span class='fa fa-edit'></span></a>";
                                    echo "<a href= 'javascript:deleteone(\"{$row['nombre']}\",\"{$row['idproduct']}\")' title='Delete Tablet' class='negro'><span class='fa fa-trash'></span></a>";
                                echo "</td>";
                            echo "</tr>";
                            }
                    ?>
                </table>
                <a href="#" id="dall" class="btn btn-danger float-left">Delete All</a>
            </div>
        </div>
    </div>
<?php include("modules/admin/view/inc/modal.php"); ?> 