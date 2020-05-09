var compras = function(url){
    return new Promise(function(resolve, reject) {
        $.ajax({ 
                 type: 'POST', 
                 url: url,
                 dataType: 'json', 
             })
             .done(function( data) {
                 resolve(data);
             })
             .fail(function(textStatus) {
                   console.log("Error en la promesa");
        });
    });
}
var ver_mas = function(url,idfac){
    return new Promise(function(resolve, reject) {
        $.ajax({ 
                 type: 'POST', 
                 url: url,
                 data:{idfac: idfac},
                 dataType: 'json', 
             })
             .done(function( data) {
                 resolve(data);
             })
             .fail(function(textStatus) {
                   console.log("Error en la promesa");
        });
    });
}

function profile(){
    var datos = function(url){
        if(localStorage.getItem('id_token')){
            var token=localStorage.getItem('id_token');
        }else{
            var token="none";
        }
        return new Promise(function(resolve, reject) {
            $.ajax({ 
                     type: 'POST', 
                     url: url,
                     data: {token:token},
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
    var datos_coger = pretty("?module=profile&function=user_data");
    datos(datos_coger)//despues de coger los datos realiza lod e abajo
    .then(function(data){
        console.log(data);
        if(data[0]=="fail"){// si no hay usuario o los datos hay errores envia al login
            location.href = pretty("?module=login");
        }else{// si todo va bien pinta en profile.
            $('#profile_avatar').attr('src',data[0].avatar);
            $('#profile_name').html(data[0].first_name+" "+data[0].last_name);
            $('#profile_id').html("<b>ID: </b> "+data[0].id);
            $('#profile_username').html("<b>Username: </b> "+data[0].username);
            $('#profile_email').html("<b>Email: </b> "+data[0].email);
            $('#profile_saldo').html("<b>Saldo: </b> "+data[0].saldo);
            //DESCOMENTAR CON EL CARRITO REALIZADO
            // compras('module/client/module/profile/controller/cprofile.php?&op=facturas')
            // .then(function(data){
            //     // console.log(data);
            //     data.forEach(factura => {
            //         $('.compras').append(
            //         "<tr>"+
            //             '<th>'+factura.idfactura+'</th>'+
            //             '<td>'+factura.total_factura+'</td>'+
            //             '<td>'+factura.fecha+'</td>'+
            //             '<td>'+
            //                 '<i id="'+factura.idfactura+'" class="fas fa-eye fa-lg modal-toogle ver-mas"> </i>'+
            //             '</td>'+
            //         '</tr>'
            //         );
            //     });
            //     // clicks();
            // })
        }
        
    })
}
//DESCOMENTAR CON CART REALZIADO
// function clicks(){
//     $('.ver-mas').on('click', function(e) {
//         idfact=$(this).attr("id");
//         $('.modal-heading').html("Factura "+idfact);
//         console.log(idfact);
//         ver_mas('module/client/module/profile/controller/cprofile.php?&op=more_facturas',idfact)
//         .then(function(lines){
//             console.log(lines);
//             $('.line_table').html("");
//             lines.forEach(product =>{
//                 var nombre_producto="NOMBRE POR DEFECTO";
//                 var img_product="https://www.brdtex.com/wp-content/uploads/2019/09/no-image.png" //imagen que no tiene imagen dispoible
//                 $.ajax({ //este ajax lo que hace es coger la info de cada producto.
//                     type: 'POST', 
//                     url: 'module/client/module/profile/controller/cprofile.php?&op=product_data',
//                     data:{idproduct: product.idproduct},
//                     dataType: 'json', 
//                 })
//                 .done(function( product_info) {
//                     console.log(product_info[0]);//guarda la informacion en variables para despues pintarla
//                     nombre_producto=product_info[0].nombre;
//                     img_product=product_info[0].imagen;
//                     console.log(nombre_producto);
//                     $('.line_table').append(
//                         "<tr>"+
//                             '<th>'+product.idlinea+'</th>'+
//                             '<td><img class="cimagen" src="'+img_product+'">IDPRODUCT: '+product.idproduct+'</td>'+
//                             '<td>'+nombre_producto+'</td>'+
//                             '<td>'+product.qty+'</td>'+
//                             '<td>'+product.cost+'</td>'+
//                         '</tr>'
//                     );
//                 })
//                 .fail(function(textStatus) {
//                       console.log("Error en la promesa");
//                 });
//             })
//         })
//         e.preventDefault();
//         $('#modal_factura').toggleClass('is-visible');
//       });
//       $('.exit_modal').on('click', function(e) {
//         e.preventDefault();
//         $('#modal_factura').toggleClass('is-visible');
//       });
// }

function saldo(){
    $('#generate_gift_code').on('click', function(e) {
        e.preventDefault();
        $('#open-modal-generate').css("display","block");
    });
    $('#modal-close-generate').on('click', function(e) {
        e.preventDefault();
        $('#open-modal-generate').css("display","none");
    });
}

$(document).ready(function() {
    profile();
    saldo();
})