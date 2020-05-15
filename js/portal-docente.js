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

  //meto la fecha actual en la cabecera
  //para coger la fecha uso el new Date(Date.now()) y con el toLocaleString la parseo al formato de españa
  //luego separo con un split de espacio (' ') la fecha de la hora, ya que la hora no quiero ponerla.
  $('#fechaActual').html(new Date(Date.now()).toLocaleString().split(' ')[0]);
});
//para comprobar el formulario de alta.php
function comprobarCamposRegistro() {
  let error = false
  let mensaje;
  if ($('form[name="altaUsuario"] input[name="nombre"]').val() == '') {
    error = true;
    mensaje = "Debe introducir un nombre";
  } else if ($('form[name="altaUsuario"] input[name="apellidos"]').val() == '') {
    error = true;
    mensaje = "Debe introducir sus apellidos";
  } else if ($('form[name="altaUsuario"] input[name="email"]').val() == '') {
    error = true;
    mensaje = "Debe introducir un email";
  } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($('input[name="email"]').val())) {
    error = true;
    mensaje = "Email no válido. Por favor introduce un email válido";
  } else if ($('form[name="altaUsuario"] input[name="password"]').val() == '') {
    error = true;
    mensaje = "Debe introducir una contraseña";
  } else if ($('input[name="password"]').val() != $('input[name="password2"]').val()) {
    error = true;
    mensaje = "Las dos contraseña no coinciden";
  }
  //con mostrarToastError generamos el toast con la plantilla de error y el mensaje que quiero que aparezca
  mostrarToastError(mensaje)
  return !error;
}
//validar el formulario de añadirTemario.php
function validarInsertarTemario() {
  let error = false
  let mensaje;
  if ($('input[name="titulo"]').val() == '') {
    error = true;
    mensaje = "Debe introducir un titulo";
  } else if ($('textarea[name="resumen"]').val() == '') {
    error = true;
    mensaje = "Debe introducir un resumen para el nuevo temario";
  } else if ($('input[name="asignatura"]').val() == '') {
    error = true;
    mensaje = "Debe introducir la asignatura a la que pertenece el temario";
  } else if ($('input[type="file"][name="temario"]').val() == '') {
    error = true;
    mensaje = "Debe introducir un archivo";
  }

  mostrarToastError(mensaje)
  return !error;
}
//comprueba el fichero del formulario formNoticias.php
function comprobarFichero() {
  let error = false
  if ($('input[type="file"][name="imagen"]').val() == '') {
    error = true;
    mostrarToastError("<h3>Imagen no insertada</h3><br>La imagen en la noticia es obligatoria.")
  }
  return !error;
}
//para facilitar la llamada al toasSuccess genero esta funcion que recibe el mensaje y agrega el tipo de toast y el icono del toast de success
function mostrarToastSuccess(mensaje) {
  mostrarToast('Success', 'success', mensaje)
}
//para facilitar la llamada al toasError genero esta funcion que recibe el mensaje y agrega el tipo de toast y el icono del toast de error
function mostrarToastError(mensaje) {
  mostrarToast('Error', 'error', mensaje)
}
//He metido en una funcion generica que recibe el tipo, el icono y el mensaje, crear el toast. Con esto consigo tener en un solo punto la configuracion del toast
function mostrarToast(tipo, icono, mensaje) {
  $.toast({
    heading: tipo,
    text: mensaje,
    showHideTransition: 'fade',
    icon: icono,
    hideAfter: 5000
  })
}


//se hace un control de páginas para la paginación
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

/*Valoración temarios por ajax (controlar el tipo de valor que tiene cada estrella)*/
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
