//MENU AL DESPLAZAR ANIMACION
function menu(){
    $(function() {
        var menu = $("#menunav");
        $(window).scroll(function() {    
            var scroll = $(window).scrollTop();
        
            if (scroll >= 200) {
                menu.removeClass('transparent').addClass("bg-dark");
            } else {
                menu.removeClass("bg-dark").addClass('transparent');
            }
        });
    });
}

//CAROUSEL
function carousel(){
    console.log("HOME: carousel loaded");
    $.ajax({ 
        type: 'GET', 
        url: pretty('?module=home&function=carousel_home'),
        async:false, 
        dataType: 'json',
        data:{},//idproduct es lo que guardamos para coger en el get LUEGO EL GET TIENE QUE SER ASI ($_GET['idproduct']); y el id ES EL ATRIBUTO
        success: function (data) { 
            // console.log(data);
            for (var i = 0; i < 10; i++) {
                $('#top-tablets').append(
                    '<div class="item" id='+data[i].idproduct+'>'+
                        '<div class="card">'+
                            '<img class="card-img-top" src="'+data[i].imagen+'" alt="picture"">'+
                            '<div class="card-body">'+
                                '<h5 class="card-title">'+data[i].nombre+'</h5>'+
                                '<p class="card-text">'+data[i].price+' €</p>'+
                                '<i id="shopping_cart_top_tablets" class="fas fa-shopping-cart"></i>'+
                                '<i id="like" class="fas fa-heart"></i>'+
                            '</div>'+
                        '</div>'+
                    '</div>'
                )
             }
        },
        error: function(){
            console.log("HOME: Error carousel ajax js");
        }
    });
    $('.owl-carousel').owlCarousel({
        stagePadding:40,
        loop:false,
        margin:50,
        nav:false,
        responsive:{
            400:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:5,
            }
        }
    })
    // onclick_item();
}

//clcik de items
function onclick_item(){
    $('.item').on('click',function(event){
        event.preventDefault();
        event.stopImmediatePropagation();//esto evita que se realice 2 veces al hacer CLICK!
        var idproductthis=$(this).attr("id");
        if($(event.target).is('.fa-heart')){
            favs_control($(this),idproductthis);
        }else{
            var idproduct= $(this).attr("id");
            localStorage.setItem("product", idproduct);
            window.location.href = pretty('?module=shop');
        }
    })
    
    console.log("HOME: onclick_item loaded");
    // $('.item').on('click',function(e){
    //     e.preventDefault();
    //     e.stopImmediatePropagation();//esto evita que se realice 2 veces al hacer CLICK!
    //     var idproduct= $(this).attr("id");
    //     localStorage.setItem("product", idproduct);
    //     window.location.href = pretty('?module=shop');
    //     var idproductthis=$(this).attr("id");
    //     console.log(idproductthis);
    //     if($(event.target).is('.fa-heart')){
    //         console.log(event.target);
    //         favs_control($(this),$(this).closest('.itemlist').attr("id"));
    //     }else{
    //         var idproduct= $(this).attr("id");
    //         localStorage.setItem("product", idproduct);
    //         // window.location.href = "index.php?page=shop";
    //     }
        // DESCOMENTAR CON  CART
        // var idproductthis=$(this).attr("id");
        // console.log(idproductthis);
        // if($(event.target).is('.fa-heart')){
        //     favs_control($(this),$(this).closest('.itemlist').attr("id"));
        // }else if($(event.target).is('.fa-shopping-cart')){
        //     console.log(idproductthis,$(this));
        //     // save_product_on_cart("2");
        //     save_product_on_cart(idproductthis);
        // }else{
        //     var idproduct= $(this).attr("id");
        //     localStorage.setItem("product", idproduct);
        //     window.location.href = "index.php?page=shop";
        // }
    // })
};


//TOP BRANDS!
function top_brands(){
    console.log("HOME: top_brands loaded");
    function get_brands_views(offset = 0){
        // console.log(clicks_more_brands);
        // console.log("dentro de top brands!");
        $.ajax({ 
            type: 'POST', 
            url: pretty('?module=home&function=top_brands'),
            data: {offset_brands: offset},
            async: false,
            dataType: 'json', 
            success: function (data) {
                // console.log(data); 
                if(data.length==0){
                    clicks_more_brands=0;
                    off = clicks_more_brands * 4;
                    get_brands_views(off);
                }else{
                    $('.more_brands').prop("hidden",false);
                    $('#brands-cards-homepage').empty();
                    for (var i = 0; i < data.length; i++) {
                        $('#brands-cards-homepage').append(
                            '<div class="brand-card" id='+data[i].idbrand+'>'+
                            '<span>'+data[i].namebrand+'</span>'+
                            '</br>'+
                            '<span>'+data[i].views+'</span>'+
                            '</div>'
                        )
                    }
                }
            },
            error: function(){
                console.log("HOME: get_brands_view js error");
            }
        });
        onclick_brand_views();
    }

    function onclick_brand_views(){
        $('.brand-card').on('click',function() {
            // var idbrand= $(this).attr("id");
            // console.log(idbrand);
            var idbrand= $(this).attr("id");
            console.log(idbrand);
            localStorage.setItem("brand", idbrand);
            window.location.href = pretty('?module=shop');
        });
    }
    function more_brands(){
        $('.more_brands').on('click', function(){
            clicks_more_brands++;
            off = clicks_more_brands * 4
            get_brands_views(off)
        })
    }
    //cargamos las funciones al cargar la funcion madre
    var clicks_more_brands = 0;
    get_brands_views();
    more_brands();
}

//Products more visited
function product_more_visited(){
    console.log("HOME: product_more_visited loaded");
    var clicks_loadmoreview = 1;
    function get_products_views(offset = 0){
        $.ajax({ 
            type: 'POST', 
            url: pretty('?module=home&function=products_more_visited'),
            data: {offset_products: offset},
            async: false,
            dataType: 'json', 
            success: function (data) { 
                // console.log(data);
                for (var i = 0; i < data.length; i++) {
                    $('#products_more_visited').append(
                        '<div class="item" id='+data[i].idproduct+'>'+
                            '<div class="card">'+
                                '<img class="card-img-top" src="'+data[i].imagen+'" alt="picture"">'+
                                '<div class="card-body">'+
                                    '<h5 class="card-title">'+data[i].nombre+'</h5>'+
                                    '<p class="card-text">'+data[i].price+' €</p>'+
                                    '<p class="card-text">Visitas: '+data[i].views+'</p>'+
                                    '<i id="shopping_cart_top_tablets" class="fas fa-shopping-cart"></i>'+
                                    '<i id="like" class="fas fa-heart"></i>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                        )
                    }
            },
            error: function(){
                console.log("HOME: get_products_view js error");
            }
        });
        onclick_item();
        send_likes_home();
    }
    function loadmoreview(){
        $('.loadmorebutton').on('click', function(){
            off = clicks_loadmoreview * 4
            get_products_views(off)
            clicks_loadmoreview++;
        })
    }
    get_products_views();
    loadmoreview();
}

//NEWS_TABLETS (API)
function news_tablets(){
    console.log("HOME: news_tablets loaded");   
    var clicks_more_news=1;
    function news_home(for_lenght = 4){
        $("#news_home_content").empty();
        $.ajax({
            url: Apis.news,
            success(json) {
                // console.log(json.articles)
                for (var i = 0; i < for_lenght; i++) {
                    $("#news_home_content").append(
                        "<div class='news_tablet'>"+
                            "<div class='img_news_tablet'>"+
                                "<img src='" + json.articles[i].urlToImage + "'>"+
                            "</div>"+
                            "<div class='content_news_text'>"+
                                "<div class='title_news_tablet'>"+
                                    "<h6> " + json.articles[i].title + "</h6>"+
                                "</div>"+
                                "<div class='description_news_tablet'>"+
                                    "<p> " + json.articles[i].description +"</p>"+
                                "</div>" +
                                "<div class='data_news_tablet'>"+
                                    "<p>" + json.articles[i].publishedAt + "</p>"+
                                "</div>"+
                            "</div>"+
                            "<a href='"+json.articles[i].url+"' class='view_more_news' target='_blank'>VIEW MORE</a>"+
                        "</div>"
                    );
                };
            }
        })
    }
    function clicks_news_home(){
        $('.load_more_news').on('click',function(){
            clicks_more_news++;
            for_lenght=clicks_more_news*4;
            news_home(for_lenght);
        })
        $('.reset_news').on('click', function(){
            clicks_more_news=1;
            news_home();
        })
    }
    news_home();
    clicks_news_home();
}

//READY
$(document).ready(function() {
    menu();
    carousel();
    top_brands();
    product_more_visited();
    news_tablets();
    onclick_item();
    // get_products_views();
    // loadmoreview();
    // get_brands_views();
    // more_brands();
})