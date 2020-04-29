$(document).ready(function() {
    $("#login").on("click",function(){
        $.ajax({ 
            type: 'GET', 
            url: "modules/admin/module/tablets/controller/controller_tablets.php?op=vista_cliente",
            dataType: 'json',
            success: function (data) { 
                console.log(data);
                location.href = "index.php";
            },
            error: function(){
                console.log("errordawdawdwad");
            }
        });
    });
});