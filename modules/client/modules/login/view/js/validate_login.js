//validar login
function validate_login(){
    var result = true;
    //form variables
    var username=$("#login_username");
    var e_username=$("#e_username");
    var password=$("#login_password");
    var e_password=$("#e_password");
    //Username login Validate
    if(!username.val()){
        username.focus();
        e_username.html("Ingresa tu usuario");
        e_username.attr("hidden", false);
        result=false;
    }else{
        e_username.attr("hidden", true);
    }
    //Password login validate
    if(!password.val()){
        password.focus();
        e_password.html("Ingresa tu contraseña");
        e_password.attr("hidden", false);
        result=false;
    }else{
        e_password.attr("hidden", true);
    }
    return result;
}
// VALIDAR REGISTRO
function validate_register(){
    // FORM VARIABLES
    var first_name=$("#first_name_register");
    var e_first_name=$("#e_first_name");

    var last_name=$("#last_name_register");
    var e_last_name=$("#e_last_name");

    var username=$("#username_register");
    var e_username=$("#e_username");

    var email=$("#email_register");
    var e_email=$("#e_email");

    var password=$("#password_register");
    var e_password=$("#e_password");

    var confirm_password=$("#confirm_password_register");
    var e_confirm_password=$("#e_confirm_password");
    //RESULT
    var result= true;
    //PATTERNS
    var pemail = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;

    //First Name Validate
    if(!first_name.val()){
        first_name.focus();
        e_first_name.html("El nombre no puede estar vacio");
        e_first_name.attr("hidden", false);
        result=false;
    }else if(first_name.val().length < 4){
        first_name.focus();
        e_first_name.html("Tiene que tener mas de 4 caracteres");
        e_first_name.attr("hidden", false);
        result=false;
    }else{
        e_first_name.attr("hidden", true);
    }
    //Last Name Validate
    if(!last_name.val()){
        last_name.focus();
        e_last_name.html("El last name no puede estar vacio");
        e_last_name.attr("hidden", false);
        result=false;
    }else if(last_name.val().length < 4){
        last_name.focus();
        e_last_name.html("Tiene que tener mas de 4 caracteres");
        e_last_name.attr("hidden", false);
        result=false;
    }else{
        e_last_name.attr("hidden", true);
    }
   //Username Validate
    if(!username.val()){
        username.focus();
        e_username.html("El USERNAME no puede estar vacio");
        e_username.attr("hidden", false);
        result=false;
    }else if(username.val().length < 4){
        username.focus();
        e_username.html("Tiene que tener mas de 4 caracteres");
        e_username.attr("hidden", false);
        result=false;
    }else{
        e_username.attr("hidden", true);
    }
    //EMAIL Validate
    if(!email.val()){
        email.focus();
        e_email.html("El Email no puede estar vacio");
        e_email.attr("hidden", false);
        result=false;
    }else if (!pemail.test(email.val())){
        email.focus();
        e_email.html("El Email no tiene formato valido");
        e_email.attr("hidden", false);
        result=false;
    }else{
        e_email.attr("hidden", true);
    }
    //Password validate
    if(!password.val()){
        password.focus();
        e_password.html("El password no puede estar vacio");
        e_password.attr("hidden", false);
        result=false;
    }else if (password.val().length < 8){
        password.focus();
        e_password.html("El password minimo 8 caracteres");
        e_password.attr("hidden", false);
        result=false;
    }else{
        e_password.attr("hidden", true);
    }
    // Confirm password
    if(!confirm_password.val()){
        confirm_password.focus();
        e_confirm_password.html("El confirm_password no puede estar vacio");
        e_confirm_password.attr("hidden", false);
        result=false;
    }else if (confirm_password.val() != password.val()){
        confirm_password.focus();
        e_confirm_password.html("Las contraseñas no coinciden");
        e_confirm_password.attr("hidden", false);
        result=false;
    }else{
        e_confirm_password.attr("hidden", true);
    }

    return result;
}

function validate_recover(){

    var password=$("#password_recover");
    var e_password=$("#e_password");

    var confirm_password=$("#confirm_password_recover");
    var e_confirm_password=$("#e_confirm_password");
    var result= true;
    //Password validate
    if(!password.val()){
        password.focus();
        e_password.html("El password no puede estar vacio");
        e_password.attr("hidden", false);
        result=false;
    }else if (password.val().length < 8){
        password.focus();
        e_password.html("El password minimo 8 caracteres");
        e_password.attr("hidden", false);
        result=false;
    }else{
        e_password.attr("hidden", true);
    }
    // Confirm password
    if(!confirm_password.val()){
        confirm_password.focus();
        e_confirm_password.html("El confirm_password no puede estar vacio");
        e_confirm_password.attr("hidden", false);
        result=false;
    }else if (confirm_password.val() != password.val()){
        confirm_password.focus();
        e_confirm_password.html("Las contraseñas no coinciden");
        e_confirm_password.attr("hidden", false);
        result=false;
    }else{
        e_confirm_password.attr("hidden", true);
    }
    return result;
}

function valdiate_mail(){
    var email=$("#email_send_mail");
    var e_email=$("#e_email");
    var result =true;
        //PATTERNS
        var pemail = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        //EMAIL Validate
        if(!email.val()){
            email.focus();
            e_email.html("El Email no puede estar vacio");
            e_email.attr("hidden", false);
            result=false;
        }else if (!pemail.test(email.val())){
            email.focus();
            e_email.html("El Email no tiene formato valido");
            e_email.attr("hidden", false);
            result=false;
        }else{
            e_email.attr("hidden", true);
        }
        return result;
}
function form_register_submit(){
    $("#form_register").submit(function(e){
        e.preventDefault();
        var register_serialized = $("#form_register").serialize();
        if(validate_register()){
            $.ajax({
				type : 'POST',
				url  : pretty('?module=login&function=register'),
				data : register_serialized,
				success: function(response){			
			   		console.log(response)		
					if(response=="Registrado correctamente"){					
						$("#register_msg").html('<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span>'+response+'<br>SE HA ENVIADO UN EMAIL DE VERIFICACION</div>');
                        setTimeout(' window.location.href = pretty("?module=login");',1000);
                        console.log(response);
					}else{					
						$("#register_msg").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span>'+response+'</div>');
					}
				}
			});
        }
        
    });
}
function form_login_submit(){
    $("#form_login").submit(function(e){
        e.preventDefault();
        // console.log(validate_login());
        var login_serialized = $("#form_login").serialize();
        // console.log(login_serialized);
        if(validate_login()){
            $.ajax({
				type : 'POST',
				url  : pretty('?module=login&function=login'),
				data : login_serialized,
				success: function(response){
                    console.log(response);
                    response_json= JSON.parse(response);
                    // console.log(response_json['response']);
                    localStorage.setItem('id_token',response_json['token_jwt']);
                    if(response_json['response']=="datos_validos"){
                        $("#login_msg").html('<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span>LOGEADO CORRECTAMENTE</div>');
                        if(localStorage.getItem('last_page')!=null){
                            console.log("dwwdadaw");
                            page=localStorage.getItem('last_page');
                            if(page=='carrito'){
                                setTimeout(' window.location.href = pretty("?module=cart");',1000);
                                localStorage.removeItem('last_page');
                            }
                        }else{
                            setTimeout(' window.location.href = pretty("?module=home");',1000);
                        }
                        console.log(response);
                        coger_carrito_bd();
                    }else{
                        $("#login_msg").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span>COMPRUEBA LOS DATOS INTRODUCIDOS</div>');
                    }
				}
			});
        }
        
    });
}

function form_send_mail(){
    $("#form_send_mail").submit(function(e){
        e.preventDefault();
        var mail_serialized = $("#form_send_mail").serialize();
        if(valdiate_mail()){
            $.ajax({
				type : 'POST',
				url  : pretty('?module=login&function=recover_send_mail'),
				data : mail_serialized,
				success: function(data){			
					if(data=="fail"){					
                        toastr.error("Este correo no esta registrado o esta vinculado a una red social.","Invalid Email");
					}else{					
                        toastr.success("Revisa tu correo","Done");
                        setTimeout(' window.location.href = pretty("?module=home");',1000);
					}
				}
			});
        }
        
    });
}
function form_recover_submit(){
    $("#form_recover").submit(function(e){
        var token=get_token_actual_url(window.location.href);//esto coge el token de la url actual.
        // console.log(url.searchParams.get("param"));
        e.preventDefault();
        var password = $("#password_recover").val()
        var recover_serialized = $("#form_recover").serialize();
        if(validate_recover()){
            $.ajax({
				type : 'POST',
				url  : pretty('?module=login&function=recover_password'),
				data : {password:password,token: token},
				success: function(data){			
					if(data=="fail"){					
                        toastr.error("Token invalido","Invalid Token");
					}else{					
                        toastr.success("Contraseñá cambaida con exito","Done");
                        setTimeout(' window.location.href = pretty("?module=login");',1000);
					}
				}
			});
        }
        
    });
}

//READY
$(document).ready(function(){
    form_register_submit();
    form_login_submit();
    form_send_mail();
    form_recover_submit();
});
