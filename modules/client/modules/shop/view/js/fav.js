function check_likes_details(idproduct){
    if(localStorage.getItem('id_token') != null){
        var token=localStorage.getItem('id_token');
        var likes = function(url,idproduct,token) {
            return new Promise(function(resolve, reject) {
             $.ajax({ 
                      type: 'POST', 
                      url: url,
                      data:{idproduct:idproduct,token:token} 
                  })
                  .done(function( data) {
                      resolve(data);
                  })
                  .fail(function(textStatus) {
                        console.log("Error en la promesa" + textStatus);
                  });
            });
          }
          likes(pretty('?module=shop&function=check_like_on_click'),idproduct,token)
          .then(function(data){
              console.log(data);
                  if(data=="true"){//tiene like
                        $("#"+idproduct+'.infoproduct').find("#like").addClass("liked");
                  }else{//no tiene
                        $("#"+idproduct+'.infoproduct').find("#like").removeClass("liked");
                  }
          })
    }else{
        console.log("non login_detailscheck")
    }
}

function send_likes(){
    if(localStorage.getItem('id_token')!=null){
        var token=localStorage.getItem('id_token');
        $.ajax({ 
            type: 'POST',
            url: pretty('?module=shop&function=check_likes'), 
            dataType: 'json',
            data: {token: token}, 
        })
        .done(function( data) {
            console.log(data);
            data.forEach(element => {
                // $(".itemlist").is('#'+element.idproduct).find("#like").addClass("liked");
                id=$("#"+element.idproduct+'.itemlist').find("#like").addClass("liked");
                id_id=$("#"+element.idproduct+'.itemlist').attr("id");
                // console.log(id_id);
            });
        })
        .fail(function(textStatus) {
              console.log("SENDLIKESHOME: error");
        });
    }else{
        console.log("no-login_send_likes");
    }
}
function send_likes_home(){
    if(localStorage.getItem('id_token')!=null){
        var token=localStorage.getItem('id_token');
        $.ajax({ 
            type: 'POST',
            url: pretty('?module=shop&function=check_likes'), 
            dataType: 'json',
            data: {token: token}, 
        })
        .done(function( data) {
            console.log(data);
                data.forEach(element => {
                    // $(".itemlist").is('#'+element.idproduct).find("#like").addClass("liked");
                    id=$("#"+element.idproduct+'.item').find("#like").addClass("liked");
                });
    
        })
        .fail(function(textStatus) {
              console.log("SENDLIKESHOME: error");
        });
    }else{
        console.log("no-login_send_likes_home");
    }
}
function favs_control(element,idproduct){
    console.log(idproduct);
    // console.log(element);
    const boton= element;
    if(localStorage.getItem('id_token') != null){
        var token=localStorage.getItem('id_token');
        var likes = function(url,idproduct,token) {
            return new Promise(function(resolve, reject) {
             $.ajax({ 
                      type: 'POST', 
                      url: url,
                      data:{idproduct:idproduct,token:token} 
                  })
                  .done(function( data) {
                      resolve(data);
                  })
                  .fail(function(textStatus) {
                        console.log("Error en la promesa" + textStatus);
                  });
            });
          }
        likes(pretty('?module=shop&function=check_like_on_click'),idproduct,token)
        .then(function(data){
            console.log(data);
                if(data=="true"){//tiene like
                    console.log("dentro de si tiene like");
                    likes(pretty('?module=shop&function=remove_like'),idproduct,token)
                    .then(function(data){
                        boton.find("#like").removeClass("liked");
                    })
                }else{//no tiene
                    console.log("dentro NO TIENE LIKE else true");
                    likes(pretty('?module=shop&function=do_like'),idproduct,token)
                    .then(function(data){
                        boton.find("#like").addClass("liked");
                    })
                }
        })
    }else{
        toastr.error("Tienes que estar logeado para poder añadir productos a favoritos.","No Login");
        console.log("dentro else");
        setTimeout(function(){
            location.href = pretty('?module=login');
        }, 1000); 
    }
}