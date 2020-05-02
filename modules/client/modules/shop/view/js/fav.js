function check_likes_details(idproduct){
    $.ajax({ 
        type: 'GET', 
        url: 'module/client/module/shop/controller/controller_shop.php?op=check_likes_details&idproduct='+idproduct, 
    })
    .done(function( data) {
        console.log("check_likes_details"+data);
        if(data=="no-login"){
            console.log("no-login");
        }else{
            if(data=="true"){
                console.log("dentro data true")
                $("#"+idproduct+'.infoproduct').find("#like").addClass("liked");
            }else{
                $("#"+idproduct+'.infoproduct').find("#like").removeClass("liked");
            } 
        }

    })
    .fail(function(textStatus) {
          console.log("Error");
    });
}

function send_likes(){
    $.ajax({ 
        type: 'GET', 
        url: 'module/client/module/shop/controller/controller_shop.php?op=check_likes', 
        dataType: 'json',
    })
    .done(function( data) {
        if(data=="no-login"){
            console.log("no-login");
        }else{
            data.forEach(element => {
                // $(".itemlist").is('#'+element.idproduct).find("#like").addClass("liked");
                id=$("#"+element.idproduct+'.itemlist').find("#like").addClass("liked");
                id_id=$("#"+element.idproduct+'.itemlist').attr("id");
                console.log(id_id);
            });
        }

    })
    .fail(function(textStatus) {
          console.log("Error");
    });
}
function send_likes_home(){
    $.ajax({ 
        type: 'GET', 
        url: 'module/client/module/shop/controller/controller_shop.php?op=check_likes', 
        dataType: 'json',
    })
    .done(function( data) {
        if(data=="no-login"){
            console.log("no-login");
        }else{
            data.forEach(element => {
                // $(".itemlist").is('#'+element.idproduct).find("#like").addClass("liked");
                id=$("#"+element.idproduct+'.item').find("#like").addClass("liked");
            });
        }

    })
    .fail(function(textStatus) {
          console.log("Error");
    });
}
function favs_control(element,idproduct){
    console.log(element);
    const boton= element;
    var likes = function(url) {
        return new Promise(function(resolve, reject) {
         $.ajax({ 
                  type: 'GET', 
                  url: url, 
              })
              .done(function( data) {
                  resolve(data);
              })
              .fail(function(textStatus) {
                    console.log("Error en la promesa" + textStatus);
              });
        });
      }
    likes('module/client/module/shop/controller/controller_shop.php?op=get_product&idproduct='+idproduct)
    .then(function(data){
        console.log(data);
        if(data=="no-login"){
            console.log("dentro no-login");
            location.href = "index.php?page=login";
        }else{
            console.log("dentro no-login else");
            console.log(data);
            if(data==="true"){
                console.log("dentro no-login else true");
                likes('module/client/module/shop/controller/controller_shop.php?op=delete_like&idproduct='+idproduct)
                .then(function(data){
                    if(data=="deleted"){
                        boton.find("#like").removeClass("liked");
                    }else{
                        console.log(data);
                    }
                })
            }else{
                likes('module/client/module/shop/controller/controller_shop.php?op=do_like&idproduct='+idproduct)
                .then(function(){
                    boton.find("#like").addClass("liked");
                })
            }
        }
    })
}