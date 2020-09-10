
function load_menu(){
    var check = function(url,token) {
    return new Promise(function(resolve, reject) {
        $.ajax({ 
                    type: 'POST', 
                    url: url,
                    data: {token: token}, 
                })
                .done(function( data) {
                    resolve(data);
                })
                .fail(function(textStatus) {
                    console.log("Error en la promesa");
        });
    });
    }
    console.log("LOGIN: LOAD MENU LOADED");
    var token = localStorage.getItem("id_token");
    // console.log(token);
    // console.log(activity(token));
    if (token) {
        check(pretty("?module=login&function=activity_check_token"),token)
        .then(function(valid){
            console.log(valid);
            if(valid=="true"){
                console.log(token);
                check(pretty("?module=login&function=get_user"),token)
                .then(function(data){
                    data_parse=JSON.parse(data);
                    // data_parse=data_parse[0];
                    var data_user=data_parse['result']
                    data_user=data_user[0];
                    localStorage.setItem('id_token',data_parse['token']);
                    if(data_user['type']=="admin"){
                        $('#menu_li').html(
                            '<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"aria-haspopup="true" aria-expanded="false">'+
                                ' <img id="menu_avatar" class="menu_avatar" src="'+data_user['avatar']+'" alt=""><span id="username">'+data_user['username']+'</span>'+
                            '</a>'+
                            '<div id="menu_init" class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdownMenuLink-333">'+
                                '<a id="profile" class="dropdown-item">Perfil</a>'+
                                '<a id="admin_panel" class="dropdown-item">Panel Admin</a>'+
                                '<a id="logout" class="dropdown-item">Desconectar</a>'+
                            '</div>'
                            );
                        $('.saldo_div').html(
                            '<a id="add_saldo" href="#" class="button_profile">Añadir saldo</a>'+
                            '<a id="generate_gift_code" href="#" class="button_profile">Generate code</a>'
                        );
                    }else{
                        $('#menu_li').html(
                            '<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"aria-haspopup="true" aria-expanded="false">'+
                                ' <img id="menu_avatar" class="menu_avatar" src="'+data_user['avatar']+'" alt=""><span id="username">'+data_user['username']+'</span>'+
                            '</a>'+
                            '<div id="menu_init" class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdownMenuLink-333">'+
                                '<a id="profile" class="dropdown-item">Perfil</a>'+
                                '<a id="logout" class="dropdown-item">Desconectar</a>'+
                            '</div>'
                            );
                        $('.saldo_div').html(
                            '<a id="add_saldo" href="#" class="button_profile">Añadir saldo</a>'
                        );
                    }
                })
                .then(function(data){//load cliks
                    adminpanel();
                    menu_clicks();
                    $.getScript( "/vicezon_fw_php/modules/client/modules/profile/view/js/generate_code.js", function() {
                        saldo();
                    });
                    $.getScript( "/vicezon_fw_php/modules/client/modules/profile/view/js/cprofile.js", function() {
                        add_saldo();
                        profile();
                    });
                    
                })
            }else{
                logout();
                toastr.error("Invalid token, Re Login","Error");
                setTimeout(function () {
                    location.href = pretty('?module=login');
                }, 1000);
                
            }
        });
        // $.ajax({
        //     type: 'POST', 
        //     url: pretty("?module=login&function=get_user"),
        //     async:false, 
        //     data : {token: token},
        //     success: function (data) { 
        //         console.log(data);
        //         data_parse=JSON.parse(data);
        //         data_parse=data_parse[0];
        //         $('#menu_li').html(
        //             '<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"aria-haspopup="true" aria-expanded="false">'+
        //                 ' <img id="menu_avatar" class="menu_avatar" src="'+data_parse['avatar']+'" alt=""><span id="username">'+data_parse['username']+'</span>'+
        //             '</a>'+
        //             '<div id="menu_init" class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdownMenuLink-333">'+
        //                 '<a id="profile" class="dropdown-item">Perfil</a>'+
        //                 '<a id="logout" class="dropdown-item">Desconectar</a>'+
        //             '</div>'
        //             );
        //     },
        //     error: function(){
        //         console.log("ERROR INIT.JS");
        //     }
        // });
    }else{
        $('#menu_li').html(
        '<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"aria-haspopup="true" aria-expanded="false">'+
            '<i class="fas fa-user"></i><span>Login</span>'+
        '</a>'+
        '<div id="menu_init" class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdownMenuLink-333">'+
            '<a id="login" class="dropdown-item">Login</a>'+
            '<a id="register" class="dropdown-item">Register</a>'+
        '</div>'
        );
        // $.getScript( "/vicezon_fw_php/modules/client/modules/profile/view/js/cprofile.js", function() {
        //     profile();
        // });
        menu_clicks();
    }  
}

function logout(){
    console.log("LOGOUT!")
    carrito=localStorage.cart;
    console.log(carrito);
    insert_cart(carrito)
    .then(function(data){
        console.log(data);
        if(check_auth_state()){
            firebase.auth().signOut()
            .then(function(){
                console.log("LOGOUT DE SOCIAL (FIREBASE)");
                // console.log(check_auth_state());
            });
        }
        localStorage.removeItem("id_token");
    })
}
$(document).ready(function(){
    load_menu();
});
