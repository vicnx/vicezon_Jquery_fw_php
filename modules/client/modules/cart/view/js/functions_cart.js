function load_cart_local(){
    //Si en local storage no hay nada, el carrito aparecerá vacio.
    if (!localStorage.cart || localStorage.cart === '[]') {
        $(".carrito").html('<span id="cart_empty">The cart is empty</span>');
        localStorage.removeItem('cart');//borramos por si acaso
      return;
    }
    //esto solo lo hace si hay algo en el carrito
    var cart_promise = function(url,ids) {
        return new Promise(function(resolve, reject) {
            $.ajax({ 
                  type: 'POST', 
                  url: url,
                  data:{ids:ids},
                  dataType: 'json', 

              })
              .done(function( data) {
                  resolve(data);
              })
              .fail(function(textStatus) {
                    console.log("Error en la promesa" + textStatus);
              });
            });
        }
    cart=JSON.parse(localStorage.cart);
    // console.log(cart);
    // console.log(cart.find(x =>x.id==='3').qty);
    for (var i in cart){
        var producto=cart[i];
        if(!productos){
            var productos=producto.id;
        }else{
            var productos=producto.id+','+productos;
        }
    }
        cart_local_product_url=pretty('?module=cart&function=get_products_cart_local');
        cart_promise(cart_local_product_url,productos)
        .then(function(productos){
            console.log(productos);
            $("#cart_table > tbody").html(''); // se limpia la tabla para que se actualize al sumar o restar
            var number=0;
            total=0;
            console.log(productos)
            productos.forEach(p => {
                qtyproduct=cart.find(x =>x.id===p.idproduct).qty;
                totalproducto=(parseInt(p.price)*parseInt(qtyproduct));
                total=total+totalproducto;
                $('#cart_table > tbody').append(
                '<tr>'+
                    '<th scope="row">'+number+'</th>'+
                    '<td><img class="cimagen" src="'+p.imagen+'">IDPRODUCT: '+p.idproduct+'</td>'+
                    '<td>'+p.nombre+'</td>'+
                    '<td>'+p.price+'</td>'+
                    //lo siguiente sirve para obtener la cantidad del producto que esta actualmente en el bucle (buscando por su id en local storage)
                    '<td>'+
                    '<i id="'+p.idproduct+'" class="fas fa-minus-square fa-lg"></i>'+
                    '<span class="qty-text">'+qtyproduct+'</span>'+
                    '<i id="'+p.idproduct+'" class="fas fa-plus-square fa-lg" > </i>'+
                    '</td>'+
                    '<td>'+totalproducto+' €</td>'+
                    '<td><i id="'+p.idproduct+'" class="fas fa-trash-alt fa-lg"></i></td>'+
                '</tr>'
                )
                number=number+1;
            });
            $('.price_total_cart').html(
                'TOTAL = '+total+" €"
            )
            load_clicks();//cargamos los clicks al cargar todos los productos
        })
}

function load_clicks(){
    //click delete producto
    $('.fa-trash-alt').on('click',function(event){
        id=$(this).attr("id");
        delete_product(id);//pasamos la id de ese boton (que es la del producto)
        load_cart_local();//recarmamos el carrito
    })
    //add qty click
    $('.fa-plus-square').on('click',function(event){
        id=$(this).attr("id");
        console.log(id);
        add_qty(id);//le pasamos id al save_qty
        setTimeout(function(){ //hacemos un set time para que primero haga la promesa y seguidamente vuelva a cargar el carrito
            load_cart_local();//recargamos el carrito sin necesidad de actualziar la pagina
        }, 150);
        
    })
    //rest qyty click
    $('.fa-minus-square').on('click',function(event){
        console.log("rest");
        id=$(this).attr("id");
        rest_qty(id);
        setTimeout(function(){ //hacemos un set time para que primero haga la promesa y seguidamente vuelva a cargar el carrito
            load_cart_local();//recargamos el carrito sin necesidad de actualziar la pagina
        }, 150);
    })
}
//promesa para comprobar el stock de ese producto antes de hacer la compra.
var check_stock_buy_promise = function(carrito) {

    if(localStorage.getItem('id_token')!=null){
        if(!carrito){
            json_cart="no-cart";
        }else{
            json_cart=JSON.parse(carrito);
        }
        return new Promise(function(resolve, reject) {
            $.ajax({ 
                    type: 'POST', 
                    url: pretty('?module=cart&function=checkout_check_stock'),
                    data: {cart: json_cart},
                    dataType: 'json', 
                })
                .done(function( data) {
                    resolve(data);
                })
                .fail(function(textStatus) {
                    console.log("Error en la promesa checkout_check_stock" + textStatus);
                });
            });
    }else{
        console.log("no-login promese checkout");
    }

    }

function checkout(){
        var checkout_promise_buy = function(total,carrito_buy) {
            if(localStorage.getItem('id_token')!=null){
                var token=localStorage.getItem('id_token');
                json_cart=JSON.parse(carrito_buy);
                return new Promise(function(resolve, reject) {
                    $.ajax({ 
                        type: 'POST', 
                        url: pretty('?module=cart&function=checkout_buy'),
                        data: {cart:json_cart,total:total,token:token},
                        dataType: 'json', 
                    })
                    .done(function( data) {
                        resolve(data);
                    })
                    .fail(function(textStatus) {
                        console.log("Error en la promesa checkout_promise_buy" + textStatus);
                    });
                });
            }else{
                console.log("no-login-checkout_promise_buy");
            }
        }
        if(localStorage.getItem('id_token')!=null){
            carrito= localStorage.cart;
            console.log(carrito);
            //primero comprobamos el stock de cada producto, si uno no tiene stock no se realiza la compra.
            check_stock_buy_promise(carrito)
            .then(function(data){
                console.log(data);
                if(data==true){
                    carrito2=localStorage.cart;
                    checkout_promise_buy(total,carrito2)
                    .then(function(se_puede){
                        console.log("checkoutpromisebuy:"+se_puede);
                        if(se_puede==="se_puede"){//si es mayor, se resta el salario y se actualiza el user. Se redirecciona al home
                            // console.log(se_puede);
                            $(".carrito").html('<span id="cart_empty">Compra realizado con exito</span>');
                            setTimeout(function () {
                                location.href = pretty('?module=home');
                            }, 1000);
                            localStorage.removeItem('cart');//borramos el carrito
                        }else{// si es menor, se redirecciona al profile (donde se podra añadir saldo)
                            console.log(se_puede);
                            $(".carrito").html('<span id="cart_empty">Hay un problema con la compra, añade más saldo!</span>');
                            setTimeout(function () {
                                location.href = pretty('?module=profile');
                            }, 1000);
                        }
                    })
                }else{
                    $(".carrito").html('<span id="cart_empty">Revisa el carrito, hay algun producto sin stock!</span>');
                    setTimeout(function () {
                        location.href = pretty('?module=home');
                    }, 1000);
                }
            })
        }else{
            localStorage.setItem('last_page', "carrito");
            toastr.error("Haz el login primero!","Error");
            setTimeout(function () {
                location.href = pretty('?module=login');
            }, 1000);
        }
}

$(document).ready(function() {
    load_cart_local();
    //click checkout
    $('#checkout').on('click',function(event){
        console.log("compra");
        checkout();//cargamos la funcion checkout
    })
});