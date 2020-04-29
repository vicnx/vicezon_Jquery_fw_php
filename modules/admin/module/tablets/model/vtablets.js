function validate_nombre(nombre){
	if(nombre.length >=4 && nombre.length <=20){
		return true;
	}
	return false;
}


function validate_price(price){
	if(price.length > 0 && price.length <=5){
		var regexp =/^[0-9]+$/;
		return regexp.test(price);
	}
	return false;
}
function validate_color(array){
    var check=false;
    for ( var i = 0, l = array.options.length, o; i < l; i++ ){
        o = array.options[i];
        if ( o.selected ){
            return true;
        }
    }
    return false;
}
// function validate_date(date) {
// 	if(date == null){
// 		return false;
// 	}
//     if (date.length > 0) {
//         var regexp = /\d{2}.\/d{2}.\/d{4}$/;
//         return regexp.test(date);
//     }
//     return false;
// }

function validate_tablet_js(op){
	var result =true;
	var nombre = document.getElementById('nombre').value;
	var price = document.getElementById('price').value;
	var color = document.getElementById('colores[]');
	var v_nombre = validate_nombre(nombre);
	var v_price = validate_price(price);
	var v_color = validate_color(color);
	if(!v_nombre){
		document.getElementById('e_nombre').innerHTML = "<strong>Error!</strong> Introduce un nombre entre 4 y 20 caracteres";
		document.formtablets.nombre.focus();
		var elementonombre = document.getElementById("e_nombre");
		elementonombre.className = "alert alert-danger";
		result= false;
	}else{
		document.getElementById('e_nombre').innerHTML = "";
		var elementonombre = document.getElementById("e_nombre");
		elementonombre.className = "none";
	}
	if(!v_price){
		document.getElementById('e_price').innerHTML = "<strong>Error!</strong> Introduce un precio entre 0 y 99999";
		document.formtablets.price.focus();
		var elementonombre = document.getElementById("e_price");
		elementonombre.className = "alert alert-danger";
		result= false;
	}else{
		document.getElementById('e_price').innerHTML = "";
		var elementonombre = document.getElementById("e_price");
		elementonombre.className = "none";
	}

	document.getElementById('e_fpublic').innerHTML = "";
	if (document.formtablets.fpublic.value.length == 0) {
		document.getElementById('e_fpublic').innerHTML = "<strong>Error!</strong> Tienes que seleccionar una fecha";
		var elementonombre = document.getElementById("e_fpublic");
		elementonombre.className = "alert alert-danger";
		result= false;
	}else{
		document.getElementById('e_fpublic').innerHTML = "";
		var elementonombre = document.getElementById("e_fpublic");
		elementonombre.className = "none";
	}
	if(!v_color){
		document.getElementById('e_color').innerHTML = "<strong>Error!</strong> No has seleccionado ningun color";
		var elementocolor = document.getElementById("e_color");
		elementocolor.className = "alert alert-danger";
		result= false;
    }else{
		document.getElementById('e_color').innerHTML = "";
		var elementocolor = document.getElementById("e_color");
		elementocolor.className = "none";
    }

	if(result !=false){
		if(op==='create'){
			document.formtablets.submit();
			document.formtablets.action = "index.php?page=controller_tablets&op=create";
		}
		if(op==='update'){
			document.formtablets.submit();
			document.formtablets.action = "index.php?page=controller_tablets&op=update";
		}

	}
	
}


	// if (document.formtablets.fpublic.value.length == 0) {
	// 	document.getElementById('e_fpublic').innerHTML = "<strong>Error!</strong> Tienes que seleccionar una fecha<br>";
	// 	var elementonombre = document.getElementById("e_fpublic");
	// 	elementonombre.className = "alert alert-danger";
	// 	return false;
	// }else{
	// 	document.getElementById('e_fpublic').innerHTML = "";
	// 	var elementonombre = document.getElementById("e_fpublic");
	// 	elementonombre.className = "none";
	// }

function deleteone(name,id) {
	var r = confirm("Seguro que quieres eliminar " + name + "\nSu id: "+id);
	if (r == true) {
		window.location.href = "index.php?page=controller_tablets&op=delete&id="+id;
	}
}

// <!-- SCRIPT PARA ELIMINAR TODA LA TABLA -->
$(document).on('click', '#dall', function(){
	var r = confirm("Seguro que quieres vaciar toda la tabla?");
	if (r == true) {
		window.location.href = "index.php?page=controller_tablets&op=deleteall";
	}
});

// MODAL
// $(document).ready(function() {
// 	$('.viewtablet').on('click',function(){
// 		var id = this.getAttribute('id');
// 		console.log(id);
// 		$.ajax({ 
//             type: 'GET', 
//             url: '/Web_Tienda/module/tablets/controller/controllertest.php?op=test', 
// 			dataType: 'json',
// 			data:{'idproduct':id},//idproduct es lo que guardamos para coger en el get LUEGO EL GET TIENE QUE SER ASI ($_GET['idproduct']); y el id ES EL ATRIBUTO
//             success: function (data) { 
// 				$("#idproduct").html(data.idproduct);
// 				$("#nombre").html(data.nombre);
// 				$("#price").html(data.price);
// 				$("#marca").html(data.marca);
// 				$("#fpublic").html(data.fpublic);
// 				$("#colores").html(data.colores);
// 				$("#sim").html(data.sim);
// 				console.log(data);
// 			},
// 			error: function(){
// 				window.location.href='index.php?page=503';
// 			}
//         });

// 		var details_userArray = $("#details_user");
// 		var details = details_userArray[0];
// 		details.style.display= "";
// 		$("#user_modal").dialog({
// 			width: 850,
// 			height: 500,
// 			resizable: "false",
// 			modal: "true",
// 			dialogClass: "custom",
// 			buttons: {
// 				Ok: function () {
// 					$(this).dialog("close");
// 				}
// 			},
// 			show: {
// 				effect: "blind",
// 				duration: 1000
// 			},
// 			hide: {
// 				effect: "explode",
// 				duration: 1000
// 			}

// 		});

// 	});
// });

// NEW MODAL
$(document).ready(function() {
	$('.viewtablet').on('click',function(){
		event.preventDefault();
		this.blur();
		var id = this.getAttribute('id');
		console.log(id);
		$.ajax({ 
            type: 'GET', 
			url: '/vicezon/module/admin/module/tablets/controller/controller_tablets.php?op=readmodal', 
			dataType: 'json',
			data:{'idproduct':id},//idproduct es lo que guardamos para coger en el get LUEGO EL GET TIENE QUE SER ASI ($_GET['idproduct']); y el id ES EL ATRIBUTO
            success: function (data) { 
				if(data=="error"){
					window.location.href='index.php?page=503';
				}else{
					console.log(data)
					$("#details").html(
						'<h2>DETAILS OF '+data.tablet.nombre +'</h2><hr class="style1"></hr><label>ID: <label id="idproduct">'+data.tablet.idproduct+'</label> </label></br><label>Name: <label id="nombre">'+data.tablet.nombre+'</label> </label></br><label>Price: <label id="price">'+data.tablet.price+'</label> </label></br><label>Brand: <label id="marca">'+data.brand+'</label> </label></br><label>Data publish: <label id="fpublic">'+data.tablet.fpublic+'</label> </label></br><label>Colours: <label id="colores">'+data.tablet.colores+'</label> </label></br><label>Have Sim?: <label id="sim">'+data.tablet.sim+'</label> </label></br><label>Rating: <label id="rating">'+data.tablet.rating+'</label> </label></br><hr class="style1"></hr><a class="btn btn-danger" href="#" rel="modal:close">Close</a>'
					);

					var details_userArray = $("#details");
					var details = details_userArray[0];
					details.style.display= "";
					$("#details").modal("show");
					$("#details").modal({
						escapeClose: true,
						clickClose: false,
						showClose: true
					  });
				}
			},
			error: function(){
				window.location.href='index.php?page=503';
			}
        });		  
	});
		$.ajax({ 
            type: 'GET', 
			url: '/vicezon/module/admin/module/tablets/controller/controller_tablets.php?op=brands', 
			async:false, 
			dataType: 'json',
			data:{},//idproduct es lo que guardamos para coger en el get LUEGO EL GET TIENE QUE SER ASI ($_GET['idproduct']); y el id ES EL ATRIBUTO
            success: function (data) { 
				for (var x = 0; x < data.length; x++) {
					console.log(data[x].namebrand);
					$("#marca").append(
						'<option value="'+data[x].idbrand+'">'+data[x].namebrand+'</option>'
					);	
				}
			},
			error: function(){
				console.log("error");
			}
		});	
		$('#brandnew_button').on('click',function(){
			var fullbrand = $("#brandnew_input").val();
			$.ajax({ 
				type: 'POST', 
				url: '/vicezon/module/admin/module/tablets/controller/controller_tablets.php?op=createbrand', 
				async: false,
				data: {fullbrand: fullbrand},
				success: function (data) { 
					console.log("Ha sido ejecutada la acción."+data);
					$('#notify_new_brand').html("Se ha añadido la nueva marca: "+data);
					$("#brandnew_input").val("");
					$('#notify_new_brand').addClass("alert alert-success");
				},
				error: function(){
					console.log("error");
				}
			});		  
		});  
});

