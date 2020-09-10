$(document).ready(function() {
    // menu=menu || localStorage.getItem('menu') || 'open';
    // if(menu=='open'){
    //     $(".sidebar").className="sidebar cerrar-menu";
    //     $(".menu-btn").className="menu-btn cerrar-btn";
    //     $(".top-bar").className="top-bar top-bar-open";
    //     $("#iconmenui").className="fa fa-arrow-left";
    // }else{
    //     $(".contenido").className="contenido";
    //     $(".page").className="page";
    //     $(".top-bar").className="top-bar";
    //     $("#iconmenui").className="fa fa-arrow-left rot";
    // }
    $(document).on('click','.menu-btn',function(){
        $(".sidebar").toggleClass("cerrar-menu");
        $(".top-bar").toggleClass("top-bar-open");
        $(".menu-btn").toggleClass("cerrar-btn");
        $("#iconmenui").toggleClass("rot");
    });
});
