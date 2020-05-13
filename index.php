<?php
require( 'header.php' );
?>
<?php

$opcion = 'inicio';

if ( isset( $_GET['p'] ) ) {
    $opcion = $_GET['p'];
}

if ( $opcion == 'inicio' ) {
    include( 'inicio.php' );
}

if ( $opcion == 'alta' ) {
    include( 'formularios/alta.php' );
}

if ( $opcion == 'noticias' ) {
    include( 'noticias.php' );
}

if ( $opcion == 'formNoticias' ) {
    include( 'formularios/formNoticias.php' );
}

if ( $opcion == 'mostrarNoticia' ) {
    include( 'mostrarNoticia.php' );
}

if ( $opcion == 'temarios' ) {
    include( 'temarios.php' );
}

if ( $opcion == 'añadirTemario' ) {
    include( 'formularios/añadirTemario.php' );
}

if ( $opcion == 'mostrarTemario' ) {
    include( 'mostrarTemario.php' );
}

if ( $opcion == 'login' ) {
    include( 'formularios/login.php' );
}
if ( $opcion == 'hiloForm' ) {
    include( 'formularios/hiloForm.php' );
}
if ( $opcion == 'foro') {
    include( 'foro.php');
}
if ( $opcion == 'mostrarHilo') {
    include( 'mostrarHilo.php');
}

?>

<?php
require_once( 'footer.php' );
?>