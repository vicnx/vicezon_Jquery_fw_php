<body>
    <div class="wrapper">
        <?php
            if($_SESSION['mensaje']!=""){
                print "<br><div class='alert alert-success'>".$_SESSION['mensaje']."<a href='index.php?page=result_tablet1' class='alert-link'> click here to view the tablet</a></div>";
            }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Tablets</h2>
                        <a href="index.php?page=controller_tablets" class="btn btn-dark pull-right">Create Tablet</a>
                    </div>
                    <?php
                    include("model/ConnectionBD.php");
                    // Include config file
                    //require_once "config.php";
                    $conn = new connection();
                    // Attempt select query execution
                    $sql = "SELECT * FROM Tablets";
                    if($result = $conn->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='table table-bordered table-stripe'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID Tablet</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Precio</th>";
                                        echo "<th>Marca</th>";
                                        echo "<th>Fecha Publicación</th>";
                                        echo "<th>Sim</th>";
                                        echo "<th>CRUD</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['idproduct'] . "</td>";
                                        echo "<td>" . $row['nombre'] . "</td>";
                                        echo "<td>" . $row['price'] . "</td>";
                                        echo "<td>" . $row['marca'] . "</td>";
                                        echo "<td>" . $row['fpublic'] . "</td>";
                                        echo "<td>" . $row['sim'] . "</td>";
                                        echo "<td class='ultima'>";
                                            echo "<a href='read.php?id=". $row['idproduct'] ."' title='Read Tablet' data-toggle='tooltip' onclick='alerta_js()'class='negro'><span class='fa fa-eye'></span></a>";
                                            echo "<a href='update.php?id=". $row['idproduct'] ."' title='Update Tablet' data-toggle='tooltip'><span class='fa fa-edit text-primary'></span></a>";
                                            echo "<a href='delete.php?id=". $row['idproduct'] ."' title='Delete Tablet' ><span class='fa fa-trash text-primary'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                    $conn = null;
                    ?>
                    <script language="Javascript">
                        function alerta_js() {
                            alert("Hola");
                        }
                    </script>
                </div>
            </div>        
        </div>
    </div>
</body>