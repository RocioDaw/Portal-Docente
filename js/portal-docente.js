////////////////////INICIO//////////////////
$(document).ready(function () {
  $(".who").on('click', function () {
    var ww = $(window).width();
    if (ww < 1024) { //si la ventana es menor a 1024(si la ventana es de móvil)
      $(".tituloWho").toggle();
      $(".textoWho").toggle();
    }
  });
  //tratamiento para paginacion por ajax
  $('#paginacion span').on('click', cargarHilos);
});

/*Valoración temarios*/

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

function cargarHilos(event) {
  $('#paginacion span.numero.selected').removeClass("selected"); //borramos la seleccion anterior
  let paginaDestino = $(event.currentTarget).data('info');
  let totalPaginas = $('#paginacion').data('total-paginas');
  $('#paginacion span.numero[data-info="' + paginaDestino + '"]').addClass("selected");
  $('#paginacion span.atras, #paginacion span.adelante').removeClass('hidden');

  $('#paginacion span.atras').data('info', parseInt(paginaDestino - 1));
  $('#paginacion span.adelante').data('info', parseInt(paginaDestino + 1));
  if (paginaDestino == 1) {
    $('#paginacion span.atras').addClass('hidden');
  }
  if (paginaDestino == totalPaginas) {
    $('#paginacion span.adelante').addClass('hidden');
  }

  $.ajax({
    data: {
      "pagina": paginaDestino
    },
    method: "POST",
    url: "ajax/recuperaHilosForos.php",
    dataType: "html",
  }).done((resultado) => {
    $('#hilos').html(resultado);
  });

}