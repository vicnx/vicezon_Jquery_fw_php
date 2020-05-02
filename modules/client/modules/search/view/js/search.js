function insert_brands_drop(){
    $.ajax({ 
        type: 'GET', 
        url: pretty('?module=search&function=load_brands'),
        dataType: 'json',
        success: function (data) { 
            // console.log(data);
            $.each(data, function(i, item) {
                $("#drop_brands_search").append(
                    '<option value="'+item.idbrand+'">' +item.namebrand + '</option>'
                )
            });
        },
        error: function(){
            console.log("error");
        }
    });
}
function give_val_search(){
    var busqueda = $('#search_bar').val();
    var brand_selected = $('#drop_brands_search').val();
    console.log(busqueda);
    sessionStorage.setItem('busqueda', busqueda);
    window.location.href =pretty('?module=shop');
    localStorage.setItem('brand', brand_selected);
}

//BOTON SEARCH
function btn_search(){
    $('#button-search').on('click', function(){
        var busqueda = $('#search_bar').val();
        var brand_selected = $('#drop_brands_search').val();
        if((brand_selected == 0)&&(busqueda==="")){
            console.log("Selecciona una marca o escribe algo");
        }else{
            console.log(brand_selected);
            give_val_search();
        }
        // sessionStorage.setItem('brand_search', brand_selected);
    })
}


//AUTOCOMPLETE
function autocomplete_control(){
    function click_auto_element(){
        $('#autocomplete').on('click',"div", function(){
            console.log("click");
            var idproduct= $(this).attr("id");
            localStorage.setItem("product", idproduct);
            window.location.href ='index.php?page=shop';
        }
    )}
    function autocomplete(){
        $('#search_bar').on('keyup', function(){
            give_values_autocomplete();
        })
        click_auto_element();
    }
    function give_values_autocomplete(){
        var busqueda = $('#search_bar').val();
        var brand_selected = $('#drop_brands_search').val();
        if(busqueda===""){
            $("#autocomplete").empty();
        }else{
            $.ajax({
                type: 'POST', 
                url: pretty('?module=search&function=autocomplete'),
                data: {busqueda: busqueda, brand_selected: brand_selected},
                async: false,
                dataType: 'json', 
                success: function (data) { 
                    console.log(data);
                    $("#autocomplete").empty();
                    for (i = 0; i < data.length; i++) {
                        $("#autocomplete").append(
                            '<div class="auto_element" data="'+data[i].marca+'" id="'+data[i].idproduct+'">'+
                            '<img class="img_auto" src="'+data[i].imagen+'" alt="picture"">'+
                            '<span>'+data[i].nombre+'</span>'+
                            '<span class="price_auto">'+data[i].price+' €</span>'+
                            '</div>'
                        )
                    }
                },
                error: function(){
                    console.log("error ");
                }
            })
        }
    }
    function onchange_brand_search(){
        $('#drop_brands_search').on('change', function(){
            // console.log("onchange oN");
            give_values_autocomplete();
        })
    }
    onchange_brand_search();
    autocomplete();
    click_auto_element();
    
}

$(document).ready(function (){
    insert_brands_drop();
    btn_search();
    autocomplete_control();
});