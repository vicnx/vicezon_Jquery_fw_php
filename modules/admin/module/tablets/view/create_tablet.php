<div class="d-flex justify-content-center">
	<form method="post" name="formtablets" id="formtablets"autocomplete="off">
		<?php
		if($error!=""){
			print "<br><p class='alert alert-danger'>".$error."</p>";
		}
		?>
			<!-- Input Nombre-->
			<span class="errorphp"></span>
			<br>
			<div class="form-row">
				<div class="form_group col-md-12">
					<label for="nombre">Name</label>
					<input name="nombre" id="nombre" type="text" placeholder="Enter the name of the Tablet" value="<?php echo $_POST?$_POST['nombre']:""; ?>" class="form-control" />						
				</div>
			</div>
			<p id="e_nombre" class="none"></p>
			<!-- FIN Input Nombre -->

			<!-- INput Date -->
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="fpublic">Publication date</label>
					<input id="datepiker" type="text" onkeydown="return false" name="fpublic"value="<?php echo $_POST?$_POST['fpublic']:""; ?>" class="form-control" placeholder="mm/dd/yyyy">
				</div>

			</div>
			<p id="e_fpublic" class="styerror"></p>
			<!-- FIN INput Date -->

			<!-- Input Price y Marca-->
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="price">Price</label>
					<input name="price" id="price" type="number" placeholder="Price of the product" value="<?php echo $_POST?$_POST['price']:""; ?>" class="form-control"/>
				</div>
				<div class="form-group col-md-6">
					<label for="marca">Brand</label>
					<select name="marca" id="marca" class="form-control">
					</select>
				</div>
			</div>
			<p id="e_price" class="none"></p>
			<!-- FIN Input Price y marca -->
			<!-- Colores disponibles -->
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="color">Available colours</label>
					<select multiple class="form-control" id="colores[]" name="colores[]" multiple data-live-search="true">
						<option value="Azul">Blue</option>
						<option value="Negro">Black</option>
						<option value="Blanco">White</option>
						<option value="Rojo">Red</option>
					</select>
				</div>
			</div>
			<p id="e_color" class="none"></p>
			<!-- FIN COLORES DISPONIBLES -->
			
			<!-- Input Sim -->
				<div class="form-group">
						<label >Have Sim? </label>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="sim" value="Yes">
						<label class="form-check-label" for="sim">Yes</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="sim" value="No" checked>
						<label class="form-check-label" for="sim">No</label>
					</div>
				</div>
				<!-- Input Sim -->
				<!-- RATING -->
				<!-- <div id='jqxRating'>
				</div>
				<div style='float: left;' id='rate'>
       			</div>
				<script type="text/javascript">
					$(document).ready(function () {
						// Create jqxRating.
						$("#jqxRating").jqxRating({ width: 350, height: 35});
						// bind to jqxRating 'change' event.
						$("#jqxRating").bind('change', function (event) {
							$("#rate").html('<input type="hidden" name="rating" id="rating" value='+event.value'></input');
						});
					});
				</script> -->
				<!-- FIN RATING -->
			<input class="btn btn-primary" name="create" type="button" id="create" value="Crear" onclick="validate_tablet_js('create')" />
			<a href="index.php?page=controller_tablets&op=list" class="btn btn-dark pull-right"> Volver</a>
	</form>
</div>	