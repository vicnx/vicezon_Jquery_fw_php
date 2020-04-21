function changelang(lang) {
    lang = lang || localStorage.getItem('app-lang') || 'en';
    localStorage.setItem('app-lang', lang);
    $('#la').val(lang); //Para que lea el valor de lang y deje seleccionado el idioma en el selector
    var elems = document.querySelectorAll('[data-tr]');
    if(lang == "en"){ // si el lang es igual a en opciones por defecto
        for (var x = 0; x < elems.length; x++) {
                elems[x].innerHTML = elems[x].dataset.tr;
            }
    }else{//si no es en (pilla de un archivo json de traduccion)
        console.log("dentro else");
        $.ajax({ 
            type: 'POST', 
            url: 'module/client/view/json/'+lang+'.json', 
            dataType: 'json',
            success: function (data) { 
                for (var x = 0; x < elems.length; x++) {
                        elems[x].innerHTML = data["strings"][elems[x].dataset.tr];
                }


            }
        });
    }
  }

$(document).ready(function(){
    changelang();
    $("#la").on("change",function () {
        if($(this).val()=='es'){
            changelang('es');
        }
        if($(this).val()=='en'){
            changelang('en');
        }
        if($(this).val()=='de'){
            changelang('de');
        }
    });
});