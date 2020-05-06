function menu_clicks(){
    //boton cart
    $("#cart_menu").on("click",function(){
        location.href = "index.php?page=cart";
    })
    //boton profile\
    $("#profile").on("click",function(){
        location.href = "index.php?page=profile";
    })
    //boton logout va al controlador del login
    $("#logout").on("click",function(){
        carrito=localStorage.cart;
        console.log(carrito);
        insert_cart(carrito)
        .then(function(data){
            $.ajax({ 
                type: 'GET', 
                url: 'module/login/controller/clogin.php?op=logout',
                success: function (data) { 
                    location.href = "index.php";
                },
                error: function(){
                    console.log("error");
                }
            });
        })

    })
    $("#login").on("click",function(){
        location.href = pretty('?module=login');
    })
    $("#register").on("click",function(){
        location.href = pretty('?module=login&function=create_account');
    })
    // FUNCTIONES MENU
    $('#contact').on("click",function(){
        location.href = pretty("?module=contact");
    })
    $('#home').on("click",function(){
        location.href = pretty("?module=home");
        // localStorage.removeItem("brand");
        // localStorage.removeItem("producto");
    })
    $('#products').on("click",function(){
        localStorage.removeItem("brand");
        localStorage.removeItem("producto");
        location.href = pretty('?module=shop');
    })
}
function adminpanel(){
    $("#admin_panel").on("click",function(){
        console.log("admin panel");
        $.ajax({ 
            type: 'GET', 
            url: pretty("?module=home&function=vista_admin"),
            async:false, 
            dataType: 'json',
            data:{},
            success: function (data) { 
                location.href = "index.php";
            },
            error: function(){
                console.log("error");
            }
        });
    });
}

function client_check(){
    $.ajax({ 
        type: 'GET', 
        url: 'module/login/controller/clogin.php?op=check_login',
        success: function (data) { 
            $("#username").html(data);
            $("#type").html(data);
        },
        error: function(){
            console.log("error");
        }
    });
}

function set_avatar(){
    var datos = function(url){
        return new Promise(function(resolve, reject) {
            $.ajax({ 
                     type: 'GET', 
                     url: url,
                     dataType: 'json'
                 })
                 .done(function( data) {
                     resolve(data);
                 })
                 .fail(function(textStatus) {
                       console.log("Error en la promesa");
            });
        });
    }

    var datos_coger = 'module/client/module/profile/controller/cprofile.php?&op=datos_coger';
    datos(datos_coger)
    .then(function(data){
        console.log("avatar?="+data.avatar);
        if(data=="fail"){// si no hay usuario
            console.log('no data');
        }else{// si todo va bien pinta el avatar en el menu.
            if(!data.avatar){// si ese usuario por algun motivo no tiene avatar le inserta uno por defecto (en el caso de no estar logeado no se mostrara nunca)
                $('#menu_avatar').attr('src','https://us.123rf.com/450wm/triken/triken1608/triken160800029/61320775-hombre-imagen-de-perfil-avatar-avatar-por-defecto-del-usuario-avatar-de-invitados-basta-con-cabeza-h.jpg?ver=6');
            }else{
                $('#menu_avatar').attr('src',data.avatar);
            }
        }
    })
}
$(document).ready(function() {
    // client_check();
    adminpanel();
    menu_clicks();
    // set_avatar();
});