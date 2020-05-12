function ajaxForSearch(ruta,option,values,order,page){//le pasamos la ruta y la sentencia
    var get_products = function(url,option,values,order,page){
        if(values==undefined){
            values="nada";
        }
        if (page==undefined){
            page="nada";
        }
        if(order==undefined){
            order="nada";
        }

        return new Promise(function(resolve,reject){
            $.ajax({ 
                type: 'POST', 
                url: url,
                data: {option: option, values: values, page: page, order: order}, 
                dataType: 'json',
            })
            .done(function( data) {
                resolve(data);
            })
            .fail(function(textStatus) {
                  console.log("SHOP: ERROR PROMESA LIST");
            });
        })
    }

    get_products(ruta,option,values,order,page)
        .then(function(total_productos){
            console.log("PRODUCTOS CATGADOS: "+total_productos.length);
            var total_pages=Math.ceil(total_productos.length/5);
            // console.log(total_pages);
            var page = 0;
            get_products(ruta,option,values,order,page)
            .then(function(result){
                console.log(result);
                $('#list').empty();
                if(result == 0){
                    $('#list').append('<div class="itemlistempty">NO PRODUCTS</div>');
                    $('.pagination').hide();
                }else{
                    $('.pagination').show();
                    result.forEach(element =>
                        $('#list').append( 
                            '<div class="itemlist" id="'+element.idproduct+'">'+
                                '<div class="card">'+
                                    '<img class="card-img-top" src="'+element.imagen+'" alt="picture"">'+
                                    '<div class="card-body">'+
                                        '<h5 class="card-title">'+element.nombre+'</h5>'+
                                        '<p class="card-text">'+element.price+' €</p>'+
                                        '<p class="card-text">MARCA: '+element.marca+'</p>'+
                                        '<p class="card-text">id: '+element.idproduct+'</p>'+
                                        '<i id="shopping_cart_top_tablets" class="fas fa-shopping-cart"></i>'+
                                        '<i id="like" class="fas fa-heart"></i>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'
                        )                      
                    );
                }
            }).then(function(likes){
                send_likes();
            })
            $(".pagination").bootpag({
                total: total_pages,
                page: 1,
                maxVisible: 5,
                next: 'next',
                prev: 'prev'
            }).on("page", function (e, num) {
                var page = num-1;
                get_products(ruta,option,values,order,page)
                    .then(function(result){
                        $('#list').empty();
                        result.forEach(element =>
                            $('#list').append( 
                                '<div class="itemlist" id="'+element.idproduct+'">'+
                                    '<div class="card">'+
                                        '<img class="card-img-top" src="'+element.imagen+'" alt="picture"">'+
                                        '<div class="card-body">'+
                                            '<h5 class="card-title">'+element.nombre+'</h5>'+
                                            '<p class="card-text">'+element.price+' €</p>'+
                                            '<p class="card-text">MARCA: '+element.marca+'</p>'+
                                            '<p class="card-text">id: '+element.idproduct+'</p>'+
                                            '<i id="shopping_cart_top_tablets" class="fas fa-shopping-cart"></i>'+
                                            '<i id="like" class="fas fa-heart"></i>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                            )                      
                        );
                        send_likes();
                    })
            }); 
        })
}
//esto controla todos los list del shop
function controlador(){
    console.log("SHOP: controlador loaded");
    var brand_selected= localStorage.getItem('brands');
    var busqueda= sessionStorage.getItem('busqueda');
    var ok =true;
    if(busqueda === null){
        busqueda="";
        ok=false;
    }
    if(brand_selected==="0"){
        brand_selected=null;
        ok=false;
    }
    if(brand_selected != null && busqueda.length>0){
        var option = "busqueda_text_marca";
        var values = busqueda+","+brand_selected;
        // console.log("nada null");
        ok=true;
    }else if(brand_selected === null && (busqueda.length>0)){
        var option = "busqueda_text";
        var values = busqueda;
        // console.log("brand null busque NO");
        ok=true;
    }else if(brand_selected != null && busqueda.length===0){
        var option = "busqueda_marca";
        var values = "null,"+brand_selected;
        // console.log("brand NO busqueda NULL");
        ok=true;
    }else{
        if (localStorage.getItem("product")===null){
            check_default_checked();
            check_checkbox_click();
            controlador_filtros();//aqui se cargan las sentencias!
            order_by_price_change();
            }else{
                //si no es null cargamos ese producto
                details_shop();
            }
    }
    if(ok===true){
        ajaxForSearch(pretty('?module=shop&function=list_products'),option,values);
        check_default_checked();
        localStorage.removeItem('brand_selected');
        sessionStorage.removeItem('busqueda');
        order_by_price_change();
    }else{
    }
}

//envia las operaciones al controlador de shop con los valores apropiados.
function controlador_filtros(){
    console.log("SHOP: Controlador_filtros loaded");
    var order=$("#order_price :selected").val();
    var brands = localStorage.getItem("brand");
    var values;
    
    if(order == "disable"){
        if (brands != null){
            brands=brands.slice(0, -1);
            option="bybrand";
            values = brands;
            ajaxForSearch(pretty('?module=shop&function=list_products'),option,values);
        }else{
            ajaxForSearch(pretty('?module=shop&function=list_products'),"all","values");
        }
    }else{
        if (brands != null){
            brands=brands.slice(0, -1);
            values = brands;
            option = "bybrandsorder";
            ajaxForSearch(pretty('?module=shop&function=list_products'),option,values,order);
        }else{
            option="onlyorder";
            values-"values";
            ajaxForSearch(pretty('?module=shop&function=list_products'),option,values,order);
        }
    }
}

//change del order de precio
function order_by_price_change(){
    //cuando el select de price cambia vuelve a llamar a la funcion
    $("#order_price").on("change",function(){
        controlador_filtros();
    });
}

//marca los checkbox que deberian de estar marcados.
function check_default_checked(){
    console.log("SHOP: check_default_checked loaded");
        // esto es una especie de segundo controlador para que funcione correctamente
        if(localStorage.getItem("brand")=== null){
            check_filters();
        }else{
            //guardamos la string de local storage en una variable
            var brands = localStorage.getItem("brand");
            console.log("BRANDS "+brands);
            if(localStorage.getItem("brand").length>1){
                //le borramos el ultimo caracter si el tamaño de brands es mas de uno (ya que se separan por comas)
                brands=brands.slice(0, -1);
            }
            //le borramos las comas convirtiendola en un array
            brands=brands.split(",");
            //por cada posicion del array checkeamos en filter ese elemento
            brands.forEach(element => document.getElementById(element).checked = true);
            check_filters();
        }
}

//añade todas las marcas marcadas a localstorage
function check_filters(){
    console.log("SHOP: check_filters loaded");
    //elimina todas las marcas de localstorage para despues añadirlas
    localStorage.removeItem("brand");
    var checked="";
    var contador1=0;
    var sentencia="";
    checked="";
    contador1=0;
    $(".checkbox_filter:checkbox[name=brands]:checked").each(function() {
        checked=checked+$(this).attr("id")+",";
        //Añade todas las marcas checkeadas a local storage
        localStorage.setItem("brand", checked);
    }); 
}

//click del checkbox
function check_checkbox_click(){
    console.log("SHOP: check_checkbox_click loaded");
        //Onclick elemento del filters, carpa el checkboxfilters
    //lo cargo en una funciona aparte ya que si no sobrecargaba la pagina
    $('.checkbox_filter').on('click',function(){
        // console.log("CLICK!")
        check_filters();
        controlador_filtros();//cargamos solo el controlador de filtros (ya que no se usa el search al hacer clicl)
    });
}

//carga el menu de filtros
function filters(){

    // $('#filters_brand').html("");
    console.log("SHOP: load_filters loaded")
    //aqui introducimos las marcas de base de datos dinamicamente al div
    $.ajax({ 
        type: 'GET', 
        url: pretty('?module=shop&function=load_filters'),
        async:false, 
        dataType: 'json',
        success: function (data) { 
            // console.log(data);
            for (var i = 0; i < data.length; i++) {
                $('#filters_brand').append(
                    '<label class="custom-control-label">'+
                    '<input class="custom-control-input checkbox_filter" type="checkbox" value="" name="brands" id='+data[i].idbrand+'>'+
                    '<label class="custom-control-label brandtext">'+data[i].namebrand+'</label>'+
                    '</label>'
                )
             }
        },
        error: function(){
            console.log("SHOP: Load filters Error ajax");
        }
    });
}

function getdetails(){
    console.log("SHOP: get_details loaded");
    $('#list').on('click','.itemlist',function(event){
        // var idproduct= $(this).attr("id");
        // localStorage.setItem("product", idproduct);
        // details_shop();
        var idproductthis=$(this).closest('.itemlist').attr("id");
        if($(event.target).is('.fa-heart')){
            favs_control($(this),$(this).closest('.itemlist').attr("id"));
        }else{
            var idproduct= $(this).attr("id");
            localStorage.setItem("product", idproduct);
            details_shop();
        }

        // var idproductthis=$(this).closest('.itemlist').attr("id");
        // if($(event.target).is('.fa-heart')){
        //     favs_control($(this),$(this).closest('.itemlist').attr("id"));
        // }else if($(event.target).is('.fa-shopping-cart')){
        //     console.log(idproductthis,$(this));
        //     // save_product_on_cart("2");
        //     save_product_on_cart(idproductthis);
        // }else{
        //     var idproduct= $(this).attr("id");
        //     localStorage.setItem("product", idproduct);
        //     details_shop();
        // }
    })
}

function details_shop(){
    //se carga el producto desde localStorage.
    var idproduct=localStorage.getItem("product");
    $('#filters').hide();
    $('.pagination').hide();
    $("#list").html("");
    $.ajax({ 
        type: 'POST', 
        url: pretty('?module=shop&function=details'),
        async: false,
        dataType: 'json',
        data:{idproduct:idproduct},
        success: function (data) { 
            // console.log(data);
            $('#list').append(
                '<div class="details">'+
                    '<a id="btnvolver" class="btn btn-danger" href="#">Volver</a>'+
                    '<img class="details_img" src="'+data[0].imagen+'" alt="picture"">'+
                    '<div class="infoproduct" id="' +data[0].idproduct+'">'+
                        '<span>ID:' +data[0].idproduct+'</span>'+
                        '<span>NAME:'+data[0].nombre+ '</span>'+
                        '<span>Price:'+data[0].price+' </span>'+
                        '<i id="shopping_cart_top_tablets" class="fas fa-shopping-cart"></i>'+
                        '<i id="like" class="fas fa-heart"></i>'+
                    '</div>'+
                '</div>'
            )
        },
        error: function(){
            console.log("error");
        }
    });
    // console.log("carga details")
    clicks_details();
    check_likes_details(idproduct);
    //este boton lo que hace es borrar el localstorage y actualziar la pagina
    $('#btnvolver').on('click',function() {
        localStorage.removeItem("product");
        location.href = pretty('?module=shop');
    });
}

function clicks_details(){
    //click fav
    $('.infoproduct').on('click','#like',function(event){
        var idproduct=($(this).parent().attr('id'));
        favs_control($(this).closest('.infoproduct'),idproduct);
    })
    //click cart
    // $('.infoproduct').on('click','.fa-shopping-cart',function(event){
    //     var idproduct=($(this).parent().attr('id'));
    //     save_product_on_cart(idproduct);
    // })
}

$(document).ready(function() {
    filters();
    controlador();
    check_checkbox_click();
    getdetails();
});