var promise_stock = function(url,idproduct) {
    return new Promise(function(resolve, reject) {
        $.ajax({ 
              type: 'POST', 
              url: url,
              dataType: 'json',
              data:{idproduct:idproduct} 
          })
          .done(function( data) {
              resolve(data);
          })
          .fail(function(textStatus) {
                console.log("Error en la promesa" + textStatus);
          });
        });
    }
function save_product_on_cart(idproduct){
    // console.log("save_product_on_cart")
    for (var i in cart){
        //si el producto existe en local storage, suma 1 a la cantidad y sale de toda la funcion.
        if(cart[i].id==idproduct){
            promise_stock(pretty('?module=cart&function=check_stock'),idproduct)
            .then(function(product){
                console.log(product);
                console.log("stock: "+product[0].stock);
                if((cart[i].qty+1) > product[0].stock){//comprobamos que uno mas de lo que hay en local storage no será mayor que el stock.
                    console.log("maximo stock");
                    toastr.error("STOCK MAXIMO","ERROR!");
                    cart[i].qty=product[0].stock;//si es mayor ponemos el stock como cantidad
                }else{
                    console.log("se suma 1 stock");
                    toastr.success("Producto añádido a la cesta correctamente","Genial!");
                    cart[i].qty=cart[i].qty+1;//si no es mayor, se suma uno a cantidad
                }
            })
            .then(function(){
                save_cart_local();//se guarda el carrito
            })
            // cart[i].qty=cart[i].qty+1;
            // save_cart_local();
            return //se sale de la funcion
        }
    }
    //esto solo lo hace la primera vez que se añade al carrito ese producto.
    promise_stock(pretty('?module=cart&function=check_stock'),idproduct)
    .then(function(product){
        console.log(product);
        if(product[0].stock > 0){// si el stock es mayor a 0 lo añade
            var producto = {id: idproduct,qty: 1};
            cart.push(producto);
            console.log("CART: "+JSON.stringify(cart));
            toastr.success("Producto añádido a la cesta correctamente","Genial!");
        }else{
            toastr.error("Este producto no tiene stock","Error");
            console.log("no hay stock de este producto");
        }
    })
    .then(function(){
        save_cart_local();
    })

}
function save_cart_local(){
    localStorage.cart = JSON.stringify(cart);
    cart_count();//cargamos el count
}

function add_qty(idproduct){
    console.log("add_qty:"+idproduct);
    jsoncartadd=JSON.parse(localStorage.cart);//pasamos el local storage a json
    json_product=(jsoncartadd.find(x =>x.id===idproduct))
    console.log("qty: "+json_product.qty+1)
    promise_stock(pretty('?module=cart&function=check_stock'),idproduct)
    .then(function(product){
        if((json_product.qty+1) > product[0].stock){//comprobamos que uno mas de lo que hay en local storage no será mayor que el stock.
            console.log("maximo stock de "+json_product.id);
            json_product.qty=product[0].stock;//si es mayor ponemos el stock como cantidad
        }else{
            console.log("se suma 1 stock a "+json_product.id);
            json_product.qty=json_product.qty+1;//si no es mayor, se suma uno a cantidad
        }
    })
    .then(function(){
        localStorage.cart = JSON.stringify(jsoncartadd);//guardamos el nuevo carrito
        cart_count();//cargamos el count
    })
}

function rest_qty(idproduct){
    // console.log("id save_qty: "+idproduct)
    cart=JSON.parse(localStorage.cart);//pasamos el local storage a json
    for (var i in cart){//hacemos un bucle para buscar ese id
        //si el producto existe en local storage, suma 1 a la cantidad y sale de toda la funcion.
        if(cart[i].id==idproduct){//si el id es el proporcionado añadimos 1
            // console.log("dentro if save")
            if(cart[i].qty===1){
                console.log("CANTIDAD ES 1 AQUI SE BORRA "+cart[i].qty);
                delete_product(idproduct);
            }else{
                console.log("cantidad es mayor que uno "+cart[i].qty)
                cart[i].qty=cart[i].qty-1;
                localStorage.cart = JSON.stringify(cart);//guardamos el nuevo carrito
            }
        }
    }
    cart_count();
}

function delete_product(idproduct){
    //esta funcion borra todo el producto entero del carrito
    jsoncart=JSON.parse(localStorage.cart); //pasamos el carrito a json
    // console.log(jsoncart.find(x =>x.id===idproduct));
    index=jsoncart.indexOf(jsoncart.find(x =>x.id===idproduct));//cojemos el index con un find
    // console.log("indice: "+index);
    jsoncart.splice(index,1);//eliminamos ese index
    localStorage.cart = JSON.stringify(jsoncart);//guardamos el nuevo carrito
    cart_count();//cargamos el count

}
//promesa para guardar el carrito////
var insert_cart = function(carrito) {
    console.log(carrito);
    if(!carrito){
        json_cart="no-cart";
    }else{
        if(carrito=="[]"){//si el carrito esta vacio
            json_cart="no-cart";
        }else{
            json_cart=JSON.parse(carrito);
        }
    }
    return new Promise(function(resolve, reject) {
        if(localStorage.getItem('id_token')!=null){
            var token=localStorage.getItem('id_token');
            $.ajax({ 
                    type: 'POST', 
                    url: pretty('?module=cart&function=insert_cart_bd'),
                    data: {cart: json_cart,token:token},
                    dataType: 'json', 
                })
                .done(function( data) {
                    cart = []; //limpia el carrito de bd
                    save_cart_local();// y lo guarda vacio
                    resolve(data);
                })
                .fail(function(textStatus) {
                    console.log("Error en la promesa insert_cart" + textStatus);
                });
        }else{
            console.log("no-login_insert-cart");
        }

        });
    }
//promesa para coger_carrito_bd
var coger_carrito_bd = function(){
    return new Promise(function(resolve, reject) {
        if(localStorage.getItem('id_token')!=null){
            var token=localStorage.getItem('id_token');
            $.ajax({ 
                type: 'POST', 
                url: pretty('?module=cart&function=coger_cart_bd'),
                data:{token:token},
                dataType: 'json', 
            })
            .done(function( data) {
                cart = [];
                data.forEach(p =>{
                    var producto = {id: p.idproduct, qty: parseInt(p.qty)};
                    cart.push(producto);
                })
                save_cart_local();
                resolve(cart);
            })
            .fail(function(textStatus) {
                console.log("Error en la promesa coger_carrito" + textStatus);
            });
        }else{
            console.log("no login coger cart");
        }

    });
}

function cart_count(){
    if(localStorage.cart){
        carrito=JSON.parse(localStorage.cart);
        totalproductos=0;
        for (var i in carrito){//hacemos un bucle para buscar ese id
            totalproductos=totalproductos+parseInt(carrito[i].qty);
        }
        console.log("total_productos"+totalproductos);
        $('.counter_cart').html(totalproductos);
    }else{
        $('.counter_cart').html('0');
    }
}
$(document).ready(function() {
    if(localStorage.cart){
        cart=JSON.parse(localStorage.cart);
    }else{
        cart= [];
    }
    cart_count();
});