
function load_menu(){
    console.log("LOGIN: LOAD MENU LOADED");
    var token = localStorage.getItem("id_token");
    if (token) {
        // console.log(token);
        $.ajax({
            type: 'POST', 
            url: pretty("?module=login&function=get_user"),
            async:false, 
            data : {token: token},
            success: function (data) { 
                data_parse=JSON.parse(data);
                data_parse=data_parse[0];
                $('#menu_li').html(
                    '<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"aria-haspopup="true" aria-expanded="false">'+
                        ' <img id="menu_avatar" class="menu_avatar" src="'+data_parse['avatar']+'" alt=""><span id="username">'+data_parse['username']+'</span>'+
                    '</a>'+
                    '<div id="menu_init" class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdownMenuLink-333">'+
                        '<a id="profile" class="dropdown-item">Perfil</a>'+
                        '<a id="logout" class="dropdown-item">Desconectar</a>'+
                    '</div>'
                    );
            },
            error: function(){
                console.log("ERROR INIT.JS");
            }
        });
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
