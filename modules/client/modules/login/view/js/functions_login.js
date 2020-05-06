function clics_varios(){
    $('#not_a_member').on('click', function(){
        location.href = pretty('?module=login&function=create_account');
    })
    $('#already_registered').on('click', function(){
        location.href = pretty('?module=login');
    })
}

$(document).ready(function(){
    clics_varios();
});