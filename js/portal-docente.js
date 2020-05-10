////////////////////INICIO//////////////////
$(document).ready(function () {
  $(".who").on('click', function () {
    var ww = $(window).width();
    if (ww < 1024) { //si la ventana es menor a 1024(si la ventana es de móvil)
      $(".tituloWho").toggle();
      $(".textoWho").toggle();
    }
  });
});


function enviarValoracion(valoracion, temarioId) {
  $.ajax({
    data: {
      "valoracion": valoracion,
      "temarioId": temarioId
    },
    method: "POST",
    url: "ajax/asignarValoracionTemario.php",
    dataType: "json",
  }).done(function (resultado) {
    $('.valoracion').html('<div class="mensajeValoracion"><i style="color=green" class="far fa-thumbs-up"></i>¡Valorado correctamente con ' + valoracion + ' estrellas!</div>');
    if ($('#numeroMedia').html() == 0) {
      $('#numeroMedia').html(valoracion)
    }
  });
}