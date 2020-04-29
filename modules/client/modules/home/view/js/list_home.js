function carousel(){
    $.ajax({ 
        type: 'GET', 
        url: pretty('?module=home&function=carousel_home'),
        async:false, 
        dataType: 'json',
        data:{},//idproduct es lo que guardamos para coger en el get LUEGO EL GET TIENE QUE SER ASI ($_GET['idproduct']); y el id ES EL ATRIBUTO
        success: function (data) { 
            console.log(data);
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
                    // '<div class="item">'+
                    //     '<img src="'+data[i].imagen+'" alt="Smiley face"">'+
                    //     '<div class="footer_top_tablets">'+
                    //         '<span id="rating_top_tablets"><i class="fas fa-star"></i> '+data[i].rating+'</span>'+
                    //         '<span id="number_top_tablets">'+(i+1)+'</span>'+
                    //         '<span id="name_top_tablets">'+data[i].nombre+'</span>'+
                    //     '</div>'+
                    // '</div>'
                )
             }
        },
        error: function(){
            console.log("Error ajax js");
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

function onclick_item(){
    $('.item').on('click',function(event){
        var idproductthis=$(this).attr("id");
        console.log(idproductthis);
        if($(event.target).is('.fa-heart')){
            favs_control($(this),$(this).closest('.itemlist').attr("id"));
        }else if($(event.target).is('.fa-shopping-cart')){
            console.log(idproductthis,$(this));
            // save_product_on_cart("2");
            save_product_on_cart(idproductthis);
        }else{
            var idproduct= $(this).attr("id");
            localStorage.setItem("product", idproduct);
            window.location.href = "index.php?page=shop";
        }
    })
    // $('.item').on('click',function() {
    //     var idproduct= $(this).attr("id");
    //     console.log("product id= "+idproduct);
    //     localStorage.setItem("product", idproduct);
    //     window.location.href = "index.php?page=shop";
    // });
}
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
var clicks_loadmoreview = 1;
var clicks_more_brands = 0;
function get_products_views(offset = 0){
    console.log(offset);
    $.ajax({ 
        type: 'GET', 
        url: '/vicezon/module/client/module/home/controller/controller_home.php?op=view_top&offset='+offset,
        async:false, 
        dataType: 'json',
        data:{},
        success: function (data) { 
            console.log(data);
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
            console.log("error");
        }
    });
    onclick_item();
    // send_likes_home();
}
function loadmoreview(){
    $('.loadmorebutton').on('click', function(){
        off = clicks_loadmoreview * 4
        get_products_views(off)
        clicks_loadmoreview++;
    })
}

function get_brands_views(offset = 0){
    console.log(clicks_more_brands);
    $.ajax({ 
        type: 'GET', 
        url: '/vicezon/module/client/module/home/controller/controller_home.php?op=view_top_brands&offset='+offset,
        async:false, 
        dataType: 'json',
        data:{},
        success: function (data) {
            console.log("data lenght: "+data.length); 
            if(data.length==0){
                clicks_more_brands=0;
                off = clicks_more_brands * 4;
                get_brands_views(off);
            }else{
                console.log("dentro fro")
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
            console.log("error");
        }
    });
    onclick_brand_views();
}

function onclick_brand_views(){
    $('.brand-card').on('click',function() {
        var idbrand= $(this).attr("id");
        console.log(idbrand);
        localStorage.setItem("brand", idbrand);
        window.location.href = "index.php?page=shop";
    });
}
function more_brands(){
    $('.more_brands').on('click', function(){
        clicks_more_brands++;
        off = clicks_more_brands * 4
        get_brands_views(off)
    })
}
var clicks_more_news=1;
function news_home(for_lenght = 4){
    $("#news_home_content").empty();
    $.ajax({
        url: Apis.news,
        success(json) {
            console.log(json.articles)
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
$(document).ready(function() {
    menu();
    carousel();
    // get_products_views();
    // loadmoreview();
    // get_brands_views();
    // more_brands();
    // news_home();
    // clicks_news_home();
})