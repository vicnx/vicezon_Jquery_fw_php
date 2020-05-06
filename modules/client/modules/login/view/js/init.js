
function load_menu(){
    console.log("LOGIN: LOAD MENU LOADED");
    var token = localStorage.getItem("id_token");
    if (token) {
        console.log(token);
        $.ajax({ 
            type: 'POST', 
            url: pretty("?module=login&function=get_user"),
            data : {token: token},
            success: function (data) { 
                console.log(data);
            },
            error: function(){
                console.log("ERROR INIT.JS");
            }
        });
        // $.post('../../login/typeuser/',{'token':token},function(data){
        //     if (data != 'false') {
        //         var type = JSON.parse(data);
        //         if (type[0].type === 'admin') {
        //             $('#print_menu').before('<li class="nav-item" ><a class="nav-link" href="' + amigable('?module=dogs&funciton=create_dogs') + '">Perros</a></li>');
        //             $('#print_menu').before('<li class="nav-item" ><a class="nav-link" href="' + amigable('?module=ubication&funciton=list_ubication') + '">Ubicacion</a></li>');
        //             $('#print_menu').before('<li class="nav-item" ><a class="nav-link" href="' + amigable('?module=login&funciton=profile_list') + '">Profile</a></li>');
        //         }
        //         if (type[0].type === 'user') {
        //             $('#print_menu').before('<li class="nav-item" ><a class="nav-link" href="' + amigable('?module=dogs&funciton=create_dogs') + '">Perros</a></li>');
        //             $('#print_menu').before('<li class="nav-item" ><a class="nav-link" href="' + amigable('?module=ubication&funciton=list_ubication') + '">Ubicacion</a></li>');
        //             $('#print_menu').before('<li class="nav-item" ><a class="nav-link" href="' + amigable('?module=login&funciton=profile_list') + '">Profile</a></li>');
        //         }
        //     }else{
        //         $('#print_menu').before('<li class="nav-item" ><a class="nav-link" href="' + amigable('?module=login&funciton=list_login') + '">Iniciar Sesion</a></li>');        
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
            '<a id="admin_panel" class="nav-link">Admin Panel</a>'+
        '</div>'
        );
    }  
}
$(document).ready(function(){
    load_menu();
});
