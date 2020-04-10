////////////////////INICIO//////////////////
$(document).ready(function(){
    $(".who").on('click', function() {
        var ww = $(window).width();
        if (ww < 1024) {
          $(".tituloWho").toggle();
          $(".textoWho").toggle();
        }
      });
});