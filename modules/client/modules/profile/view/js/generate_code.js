var generator = function(url,money='null'){
    return new Promise(function(resolve, reject) {
        $.ajax({ 
                 type: 'POST', 
                 url: url,
                 data:{money: money},
                 async:false,
                 dataType: 'json', 
             })
             .done(function( data) {
                 resolve(data);
             })
             .fail(function(textStatus) {
                   console.log("Error en la promesa");
        });
    });
}
function saldo(){
    $('#generate_gift_code').on('click', function(e) {
        $('#open-modal-generate').html(
            '<div class="modal-generate-content">'+
                '<span id="modal-close-generate" class="close">&times;</span>'+
                    '<div class="titulo_generator">'+
                    '<h3>Selecciona la cantidad</h3>'+
                    '<a href="#" class="clear_codes rojo" >DELETE ALL CODES</a>'+
                '</div>'+
                '<p><i>This function is only for <b>ADMINS</b></i> </p>'+
                '<div class="botones_saldo">'+
                    '<div id="money_bar" class="d-flex justify-content-center my-4">'+
                        '<input type="range" class="custom-range" id="money_bar_input" min="50" max="10000">'+
                        '<span class="font-weight-bold text-primary ml-2 value_money_bar"></span>'+
                    '</div>'+
                    '<div class="buttons_area_generator">'+
                        '<a href="#" class="button_profile generate_code azul" >GENERATE</a>'+
                        '<a href="#" class="button_profile list_codes verde" >LIST CODES</a>'+
                    '</div>'+
                    '<input type="text" id="generated_code" class="form-control" disabled>'+
                '</div>'+
            '</div>'
            
        );
        money_bar();
        clicks_butoons();
        $('#modal-close-generate').on('click', function(e) {
            e.preventDefault();
            $('#open-modal-generate').css("display","none");
        });
        e.preventDefault();
        $('#open-modal-generate').css("display","block");
    });
}

function clicks_butoons(){
    $('.generate_code').on('click', function(e) {
        $.confirm({
            icon: 'fas fa-check-circle',
            title: 'Generate new code',
            content: 'Seguro que quieres generar un nuevo codigo?',
            type: 'green',
            typeAnimated: true,
            buttons: {
                Generar: {
                    text: 'Generar',
                    btnClass: 'btn-green',
                    action: function(){
                        $money_selected = $('#money_bar_input').val();
                        console.log($money_selected);
                        $code=generate_code($money_selected);
                    }
                },
                close: function () {
                }
            }
        });
        // console.log($code);
    });
    $('.clear_codes').on('click', function(e) {
        $.confirm({
            icon: 'fas fa-exclamation-triangle',
            title: 'DELETE ALL CODES',
            content: 'Estas apunto de eliminar todos los codigos de la BD, estas seguro?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                BORRAR: {
                    text: 'BORRAR',
                    btnClass: 'btn-red',
                    action: function(){
                        clear_codes();
                    }
                },
                close: function () {
                }
            }
        });
    });
    $('.list_codes').on('click', function(e) {
        select_all_codes();
    });
}

function money_bar(){
    $valueSpan = $('.value_money_bar');
    $value = $('#money_bar_input');
    $valueSpan.html($value.val()+' $');
    $value.on('input change', () => {
      $valueSpan.html($value.val()+' $');
    });
}

function generate_code($money){
    generator(pretty("?module=profile&function=generator"),$money)
    .then(function(data){
        $('#generated_code').val(data);
    })
}

function clear_codes(){
    generator(pretty("?module=profile&function=delete_all_codes"))
    .then(function(data){
        $('#generated_code').val("ALL CODES DELETED!");
    })
}
function select_all_codes(){
    generator(pretty("?module=profile&function=select_all_codes"))
    .then(function(data){
        var codes='<table class="table">'+
        '<thead class="black white-text">'+
          '<tr>'+
            '<th scope="col">#</th>'+
            '<th scope="col">CODE</th>'+
            '<th scope="col">VALUE</th>'+
            '<th scope="col">STATE</th>'+
          '</tr>'+
        '</thead>'+
        '<tbody>';
        data.forEach(function(code){
            console.log(codes);
            codes+=
            
            '<tr>'+
            '  <td>'+code['id']+'</td>'+
            '  <td>'+code['code']+'</td>'+
            '  <td>'+code['value']+'</td>'+
            '  <td>'+code['state']+'</td>'+
            '</tr>'
        })
        $.dialog({
            title: 'Gift codes VICEZON',
            content: codes+'</tbody>'+
            '</table>',
            type: 'blue',
            columnClass: 'col-md-6 col-md-offset-3',
        });
    })
}

