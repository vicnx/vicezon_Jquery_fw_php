function time_activity(){
    console.log("time_activity load");
    var checks = function(url) {
        return new Promise(function(resolve, reject) {
            $.ajax({ 
                     type: 'GET', 
                     url: url, 
                 })
                 .done(function( data) {
                     resolve(data);
                 })
                 .fail(function(textStatus) {
                       console.log("Error en la promesa");
            });
        });
    }


    var check_bd_type='module/login/controller/clogin.php?&op=check_bd_type';
    var actividad_url='module/login/controller/clogin.php?&op=actividad';
    var destroy_session='module/login/controller/clogin.php?&op=logout';
    var regenerate = 'module/login/controller/clogin.php?&op=regenerar_id';
    checks(check_bd_type)
    .then(function(type_check){
        console.log("check_bd_type load");
        if(type_check != 'nada'){
            if(type_check != 'typeok'){
                checks(destroy_session)
                .then(function(data){
                    console.log('destroyed sesssion beacuse you are not the correct type');
                    location.href = "index.php?page=login";
                })
            }else{
                checks(actividad_url)
                .then(function(response){
                    console.log("actividad_url load");
                    if(response=="off"){
                        alert("Se ha cerrado la session por estar más de 15 minutos inactivo");
                        carrito=localStorage.cart;
                        //primero inserta el carrito y despues cierra la session
                        insert_cart(carrito)
                        .then(function(data){
                            checks(destroy_session)
                            .then(function(data){
                                console.log(data);
                                location.href = "index.php?page=login";
                            })
                        })
                    }else{
                        checks(regenerate)
                        .then(function(ids){
                            console.log("regenerate load");
                            console.log(ids);
                        })
                    }
                })
            }
        }else{
            console.log('nadie logeado');
        }
    })
}

$(document).ready(function(){
    time_activity();
});