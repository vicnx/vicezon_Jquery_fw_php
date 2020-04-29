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
					<label for="nombre">Nombre</label>
					<input name="nombre" id="nombre" type="text" placeholder="Introduce el nombre de la Tablet" value="<?php echo $tablet['nombre']; ?>" class="form-control" />						
				</div>
			</div>
			<p id="e_nombre" class="none"></p>
			<!-- FIN Input Nombre -->

			<!-- INput Date -->
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="fpublic">Fecha Publicacion</label>
					<input id="datepiker" type="text" onkeydown="return false" name="fpublic"value="<?php echo $tablet['fpublic']; ?>" class="form-control" placeholder="mm/dd/yyyy">
				</div>

			</div>
			<p id="e_fpublic" class="styerror"></p>
			<!-- FIN INput Date -->

			<!-- Input Price y Marca-->
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="price">Precio</label>
					<input name="price" id="price" type="number" placeholder="Precio del producto" value="<?php echo $tablet['price']; ?>" class="form-control"/>
                </div>
                <?php
                    if($tablet['marca']==="Samsung"){
                ?>
				<div class="form-group col-md-6">
					<label for="marca">Marca</label>
					<select name="marca" id="marca" class="form-control">
						<option value="Samsung" selected="selected">Samsung</option> 
						<option value="Xiaomi">Xiaomi</option> 
						<option value="Honor">Honor</option>
						<option value="Iphone">Iphone</option> 
						<option value="Sony">Sony</option> 
					</select>
                </div>
                <?php
                    }elseif($tablet['marca']==="Xiaomi"){
                ?>
                <div class="form-group col-md-6">
					<label for="marca">Marca</label>
					<select name="marca" id="marca" class="form-control">
						<option value="Samsung">Samsung</option> 
						<option value="Xiaomi"selected="selected">Xiaomi</option> 
						<option value="Honor">Honor</option>
						<option value="Iphone">Iphone</option> 
						<option value="Sony">Sony</option> 
					</select>
                </div>
                <?php
                    }elseif($tablet['marca']==="Honor"){
                ?>
                <div class="form-group col-md-6">
					<label for="marca">Marca</label>
					<select name="marca" id="marca" class="form-control">
						<option value="Samsung">Samsung</option> 
						<option value="Xiaomi">Xiaomi</option> 
						<option value="Honor" selected="selected">Honor</option>
						<option value="Iphone">Iphone</option> 
						<option value="Sony">Sony</option> 
					</select>
                </div>
                <?php
                    }elseif($tablet['marca']==="Iphone"){
                ?>
                <div class="form-group col-md-6">
					<label for="marca">Marca</label>
					<select name="marca" id="marca" class="form-control">
						<option value="Samsung">Samsung</option> 
						<option value="Xiaomi">Xiaomi</option> 
						<option value="Honor" >Honor</option>
						<option value="Iphone" selected="selected">Iphone</option> 
						<option value="Sony">Sony</option> 
					</select>
                </div>
                <?php
                    }else{
                ?>
                <div class="form-group col-md-6">
					<label for="marca">Marca</label>
					<select name="marca" id="marca" class="form-control">
						<option value="Samsung">Samsung</option> 
						<option value="Xiaomi">Xiaomi</option> 
						<option value="Honor" >Honor</option>
						<option value="Iphone" >Iphone</option> 
						<option value="Sony" selected="selected">Sony</option> 
					</select>
                </div>
                <?php
                    };
                ?>
			</div>
			<p id="e_price" class="none"></p>

			<!-- FIN Input Price y marca -->
			<!-- Colores disponibles -->
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="color">Colores disponibles</label>
					<?php
					$col=explode(":", $tablet['colores']);
					?>
					<select multiple class="form-control" id="colores[]" name="colores[]">
						<?php
							$searcharray=in_array("Azul",$col);
							if($searcharray){
						?>
						<option value="Azul" selected>Azul</option>
						<?php
							}else{
						?>
						<option value="Azul">Azul</option>
						<?php
							}
						?>
						<?php
							$searcharray=in_array("Negro",$col);
							if($searcharray){
						?>
						<option value="Negro" selected>Negro</option>
						<?php
							}else{
						?>
						<option value="Negro">Negro</option>
						<?php
							}
						?>
						<?php
							$searcharray=in_array("Blanco",$col);
							if($searcharray){
						?>
						<option value="Blanco" selected>Blanco</option>
						<?php
							}else{
						?>
						<option value="Blanco">Blanco</option>
						<?php
							}
						?>
						<?php
							$searcharray=in_array("Rojo",$col);
							if($searcharray){
						?>
						<option value="Rojo" selected>Rojo</option>
						<?php
							}else{
						?>
						<option value="Rojo">Rojo</option>
						<?php
							}
						?>
					</select>
				</div>
			</div>
			<p id="e_color" class="none"></p>
			<!-- FIN COLORES DISPONIBLES -->
			<!-- Input Sim -->
				<div class="form-group">
                    <label >Have Sim? </label>
                    <?php
                        if($tablet['sim']==="Yes"){
                    ?>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="sim" value="Yes" checked>
						<label class="form-check-label">Yes</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="sim" value="No">
						<label class="form-check-label">No</label>
                    </div>
                    <?php
                        }else{
                    ?>
                    	<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="sim" value="Yes">
						<label class="form-check-label">Yes</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="sim" value="No" checked>
						<label class="form-check-label">No</label>
                    </div>
                    <?php
                        };
                    ?>
				</div>
                <!-- Input Sim -->
            <input class="btn btn-info name="update" type="button" id="update" value="Update" onclick="validate_tablet_js('update')" />
            <a href="index.php?page=controller_tablets&op=list" class="btn btn-dark pull-right"> Volver</a>
	</form>
</div>	