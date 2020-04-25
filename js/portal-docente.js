////////////////////INICIO//////////////////
$(document).ready(function(){
    $(".who").on('click', function() {
        var ww = $(window).width();
        if (ww < 1024) { //si la ventana es menor a 1024(si la ventana es de móvil)
          $(".tituloWho").toggle();
          $(".textoWho").toggle();
        }
      });
});






