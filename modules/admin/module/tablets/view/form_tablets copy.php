<div class="d-flex justify-content-center">
	<form method="post" name="formtablets" id="formtablets"autocomplete="off">
		<?php

		if($mensaje!=""){
			print "<br><div class='alert alert-success'>".$mensaje."<a href='index.php?page=result_tablet1' class='alert-link'> click here to view the tablet</a></div>";
		}
		if($error!=""){
			print "<br><p class='alert alert-danger'>".$error."</p>";
		}
		?>
			<!-- Input Nombre-->
			<span class="errorphp"></span>
			<br>
			<div class="form-row">
				<div class="form_group col-md-12">
					<label for="nombre">Nombre</label>
					<input name="nombre" id="nombre" type="text" placeholder="Introduce el nombre de la Tablet" value="<?php echo $_POST?$_POST['nombre']:""; ?>" class="form-control" />						
				</div>
			</div>
			<p id="e_nombre" class="none"></p>
			<!-- FIN Input Nombre -->

			<!-- INput Date -->
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="fpublic">Fecha Publicacion</label>
					<input id="datepiker" type="text" name="fpublic"value="<?php echo $_POST?$_POST['fpublic']:""; ?>" class="form-control" placeholder="mm/dd/yyyy">
				</div>

			</div>
			<p id="e_fpublic" class="styerror"></p>
			<!-- FIN INput Date -->

			<!-- Input Price y Marca-->
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="price">Precio</label>
					<input name="price" id="price" type="number" placeholder="Precio del producto" value="<?php echo $_POST?$_POST['price']:""; ?>" class="form-control"/>
				</div>
				<div class="form-group col-md-6">
					<label for="marca">Marca</label>
					<select name="marca" id="marca" class="form-control">
						<option value="Samsung">Samsung</option> 
						<option value="Xiaomi">Xiaomi</option> 
						<option value="Honor">Honor</option>
						<option value="Iphone">Iphone</option> 
						<option value="Sony">Sony</option> 
					</select>
				</div>
			</div>
			<p id="e_price" class="none"></p>

			<!-- FIN Input Price y marca -->
			<!-- Input Sim -->
				<div class="form-group">
						<label >Have Sim? </label>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="sim" value="Yes">
						<label class="form-check-label" for="exampleRadios1">Yes</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="sim" value="No" checked>
						<label class="form-check-label" for="exampleRadios2">No</label>
					</div>
				</div>
				<!-- Input Sim -->
			<input class="btn btn-primary" name="Submit" type="button" id="create" value="Crear" onclick="validate_tablet_js()" />
	</form>
</div>	