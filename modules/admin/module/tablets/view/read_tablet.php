<div id="contenido" class="wrapper">
	<div class='container'>
		<div class="row">
			<div class="col-md-12">
				<h2 class="pull-left">Informacion de <?php echo $tablet['nombre'];?></h2>
				<a href="index.php?page=controller_tablets&op=list" class="btn btn-dark pull-right"> Volver</a>
			</div>
			<table class='table table-stripe blacktable'>
				<tr class="table-primary">
					<td width=125 class="text-center"><b>Id Tablet</b></th>
					<td width=125 class="text-center"><b>Nombre</b></th>
					<td width=125 class="text-center"><b>Price</b></th>
					<td width=125 class="text-center"><b>Marca</b></th>
					<td width=125 class="text-center"><b>Fecha Publicacion</b></th>
					<td width=125 class="text-center"><b>Colores Disponibles</b></th>
					<td width=125 class="text-center"><b>Sim</b></th>
				</tr>
				<?php
				 echo "<tr>";
					echo "<td class='text-center'>" . $tablet['idproduct'] . "</td>";
					echo "<td class='text-center'>" . $tablet['nombre'] . "</td>";
					echo "<td class='text-center'>" . $tablet['price'] . "</td>";
					echo "<td class='text-center'>" . $tablet['marca'] . "</td>";
					echo "<td class='text-center'>" . $tablet['fpublic'] . "</td>";
					echo "<td class='text-center'>" . $tablet['colores'] . "</td>";
					echo "<td class='text-center'>" . $tablet['sim'] . "</td>";
				 echo "</tr>";
				?>

			</table>
		</div>
	</div>
<div>


