function clics_varios(){
    $('#not_a_member').on('click', function(){
        location.href = "index.php?page=register";
    })
    $('#already_registered').on('click', function(){
        location.href = "index.php?page=login";
    })
}

$(document).ready(function(){
    clics_varios();
});