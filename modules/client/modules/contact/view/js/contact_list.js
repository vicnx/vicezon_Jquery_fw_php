function send_mail(){

    $('#send').on('click',function(){
        toastr.clear();
        console.log("lenght mensaje= "+$("#contact_msg").val().length);
        ok=true;

        var pname = /^[a-zA-Z]+[\-'\s]?[a-zA-Z]{2,51}$/;
        var pmessage = /^[0-9A-Za-z\s]{20,100}$/;
        var pmail = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    
        if ($("#contact_name").val() === "") {
            toastr.error("El nombre no puede estar vacio","Invalid Name");
            console.log("test");
            ok=false;
            return false;
        }else if (!pname.test($("#contact_name").val())) {
            toastr.error("Solo puedes utilizar letras (Minimo 3)","Invalid Name");
            ok=false;
            return false;
        }

        if ($("#contact_surname").val() === "") {
            toastr.error("El apellido no puede estar vacio","Invalid Surname");
            ok=false;
            return false;
        }else if (!pname.test($("#contact_surname").val())) {
            toastr.error("Solo puedes utilizar letras (Minimo 3)","Invalid Surname");
            ok=false;
            return false;
        }

        if ($("#contact_email").val() === "") {
            toastr.error("El correo no puede estar vacio","Invalid Email");
            ok=false;
            return false;
        }else if (!pmail.test($("#contact_email").val())) {
            toastr.error("El formato del correo es incorrecto!","Invalid Email");
            ok=false;
            return false;
        }
        if ($("#contact_msg").val() === "") {
            toastr.error("El mensaje no puede estar vacio!","Invalid MSG");
            ok=false;
            return false;
        }else if ($("#contact_msg").val().length <20) {
            toastr.error("Como minimo 20 caracteres!","Invalid MSG");
            ok=false;
            return false;
        }else if($("#contact_msg").val().length >100){
            toastr.error("Como maximo 100 caracteres!","Invalid MSG");
            ok=false;
            return false;
        }

        if(ok){
            $('#send').attr('disabled', true);
            var form_contact_serialized=$("#form_contact").serialize();
            // var mail = {"contact_name":$("#contact_name").val(),"contact_surname":$("#contact_surname").val(),"contact_email":$("#contact_email").val(),"contact_msg":$("#contact_msg").val()};
            console.log(form_contact_serialized);
            $.ajax({
				type : 'POST',
				url  : pretty("?module=contact&function=send_mail"),
				data : form_contact_serialized,
				success: function(response){			
                    console.log(response);
                    if(response=="done"){
                        toastr.success("El mensaje a sido enviado!","Mensaje enviado")
                    }else{
                        toastr.error("Se ha producido un error al enviar tu mensaje","Error mensaje")
                    }
				}
			});
        }
    })
}



$(document).ready(function(){
    console.log("contact_list.js cargado");
    send_mail();
})