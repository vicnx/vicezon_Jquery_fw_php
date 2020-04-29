function changelang(lang) {
    lang = lang || localStorage.getItem('app-lang') || 'en';
    var dtable = $('#Tablets').dataTable(); //ID DE LA TABLA
    localStorage.setItem('app-lang', lang);
    $('#la').val(lang); //Para que lea el valor de lang y deje seleccionado el idioma en el selector
    var elems = document.querySelectorAll('[data-tr]');
    if(lang == "en"){ // si el lang es igual a en opciones por defecto
        for (var x = 0; x < elems.length; x++) {
                elems[x].innerHTML = elems[x].dataset.tr;
            }
            //Si el lang es null, destuye la tabla y la vuelve a crear (por defecto esta en ingles)
            dtable.fnDestroy();
            dtable = null;
            dtable = $('#Tablets').dataTable();
    }else{//si no es en (pilla de un archivo json de traduccion)
        console.log("dentro else");
        $.ajax({ 
            type: 'POST', 
            url: 'module/admin/view/json/'+lang+'.json', 
            dataType: 'json',
            success: function (data) { 
                for (var x = 0; x < elems.length; x++) {
                        elems[x].innerHTML = data["strings"][elems[x].dataset.tr];
                }
            //destruye la tabla y la crea con el idioma establecido
            dtable.fnDestroy();
            dtable = null;
            dtable = $('#Tablets').dataTable( {"oLanguage": data["strings"]} );

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