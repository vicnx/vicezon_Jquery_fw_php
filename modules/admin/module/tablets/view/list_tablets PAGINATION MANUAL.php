<div id="contenido" class="wrapper">
    <?php
        if($_SESSION['mensaje']!=""){
            print "<br><div class='alert alert-success'>".$_SESSION['mensaje']."</div>";
            }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                        <h2 class="pull-left">Tablets</h2>
                        <a href="index.php?page=controller_tablets&op=create" class="btn btn-dark pull-right">Create Tablet</a>
                </div>
                <table id="Tablets"class='table table-striped table-light table-bordered'>
                    <thead class='table-primary'>
                        <tr>
                            <th width=125><b>Idproduct</b></th>
                            <th width=125><b>Nombre</b></th>
                            <th width=125><b>price</b></th>
                            <th width=125><b>CRUD</b></th>
                        </tr>
                    </thead>
                    
                    <?php

                        if($fdaolist->rowCount() ==0){
                            echo '<tr>';
                            echo '<td align="center"  colspan="3">NO HAY NINGUNA tablet</td>';
                            echo '</tr>';
                        }else{
                            foreach ($fdaolist as $row){
                                echo "<tr>";
                                echo "<td>" . $row['idproduct'] . "</td>";
                                echo "<td>" . $row['nombre'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td class='ultima'>";
                                    echo "<a href='index.php?page=controller_tablets&op=read&id=". $row['idproduct'] ."' title='Read Tablet' class='negro'><span class='fa fa-eye'></span></a>";
                                    echo "<a href='index.php?page=controller_tablets&op=update&id=". $row['idproduct'] ."' title='Update Tablet' class='negro'><span class='fa fa-edit'></span></a>";
                                    echo "<a href= 'javascript:myFunction(\"{$row['nombre']}\",\"{$row['idproduct']}\")' title='Delete Tablet' class='negro'><span class='fa fa-trash'></span></a>";
                                echo "</td>";
                            echo "</tr>";
                            }
                        }
                    ?>
                    	<script>
                            $(document).ready(function() {
                            $('#Tablets').dataTable({
                                "bPaginate": false,
                                "bLengthChange": false,
                                "bFilter": true,
                                "bInfo": false,
                                "bAutoWidth": false });
                            });
                        </script>
                    <script>
                        function myFunction(name,id) {
                        var r = confirm("Seguro que quieres eliminar " + name + "\nSu id: "+id);
                        if (r == true) {
                            window.location.href = "index.php?page=controller_tablets&op=delete&id="+id;
                        }
                        }
                    </script>
                </table>
                <?php //Paginator! Utiliza variables de la function select_all_tablets
                        echo"Total Tablets: ";
                      if($total_pages <= (1+($adjacents * 2))) {
                        $start = 1;
                        $end   = $total_pages;
                      } else {
                        if(($page - $adjacents) > 1) { 
                          if(($page + $adjacents) < $total_pages) { 
                            $start = ($page - $adjacents);            
                            $end   = ($page + $adjacents);         
                          } else {             
                            $start = ($total_pages - (1+($adjacents*2)));  
                            $end   = $total_pages;               
                          }
                        } else {               
                          $start = 1;                                
                          $end   = (1+($adjacents * 2));             
                        }
                      }
                
                    if($total_pages > 1) { ?>
                    <ul class="pagination pagination-sm">
                        <!-- Para ir a la primera pagina -->
                        <li class='page-item <?php ($pages <= 1 ? print 'disabled' : '')?>'>
                        <a class='page-link' href='index.php?page=controller_tablets&op=list&pages=1'><<</a>
                        </li>
                        <!-- Para ir a la pagina anterior -->
                        <li class='page-item <?php ($pages <= 1 ? print 'disabled' : '')?>'>
                        <a class='page-link' href='index.php?page=controller_tablets&op=list&pages=<?php ($pages>1 ? print($pages-1) : print 1)?>'><</a>
                        </li>
                        <!-- Usamos un bucle para mostrar las paginas con su numero -->
                        <?php 
                            for($i=$start; $i<=$end; $i++) { 
                        ?>
                        <li class='page-item <?php ($i == $pages ? print 'active' : '')?>'>
                        <a class='page-link' href='index.php?page=controller_tablets&op=list&pages=<?php echo $i;?>'><?php echo $i;?></a>
                        </li>
                        <?php 
                            } 
                        ?>
                        <!-- Para ir a la pagina siguiente -->
                        <li class='page-item <?php ($pages >= $total_pages ? print 'disabled' : '')?>'>
                        <a class='page-link' href='index.php?page=controller_tablets&op=list&pages=<?php ($pages < $total_pages ? print($pages+1) : print $total_pages)?>'>></a>
                        </li>
                        <!-- Para ir a la ultima pagina -->
                        <li class='page-item <?php ($pages >= $total_pages ? print 'disabled' : '')?>'>
                        <a class='page-link' href='index.php?page=controller_tablets&op=list&pages=<?php echo $total_pages;?>'>>>                      
                        </a>
                        </li>
                    </ul>
                <?php 
                    } 
                ?>
                <?php 
                    $conn=null; 
                ?>
            </div>
        </div>
    </div>

</div>