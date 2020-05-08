function pretty(url) {
    var link="";
    url = url.replace("?", "");
    url = url.split("&");
    cont = 0;
    for (var i=0;i<url.length;i++) {
    	cont++;
        var aux = url[i].split("=");
        if (cont == 2) {
        	link +=  "/"+aux[1]+"/";	
        }else{
        	link +=  "/"+aux[1];
        }
        
    }
    return "http://localhost/vicezon_fw_php" + link;
}

function get_token_actual_url(url){
    $url_split=url.split("/");
    // for (var i=0;i<url_split.length;i++) {
    // 	cont++;
    //     var aux = url[i].split("=");
    //     if (cont == 2) {
    //     	link +=  "/"+aux[1]+"/";	
    //     }else{
    //     	link +=  "/"+aux[1];
    //     }
        
    // }
    return $url_split[6];
}

console.log("utils js cargados")