<?php
session_start();
require_once( 'clases/db_abstract_model.php' );
require_once( 'clases/Usuario.php' );
require_once( 'clases/Noticias.php' );
require_once( 'lib/fechas.php' );
require_once( 'clases/Fichero.php' );
require_once( 'clases/Temarios.php' );
require_once( 'clases/Hilos.php' );
require_once( 'clases/Respuestas.php' );


if ( isset( $_SESSION['id'] ) ) {
    $id_usuario = $_SESSION['id'];
}

if ( isset( $_GET['a'] ) ) {
    $accion = $_GET['a'];
    if ( $accion == 'logout' ) {
        unset( $_SESSION['email'] );
        unset( $_SESSION['nombre'] );
        unset( $_SESSION['apellidos'] );
         unset( $_SESSION['password'] );
        unset( $_SESSION['id'] );
        unset( $_SESSION['tipo'] );
        unset( $_SESSION['avatar'] );
        unset( $id_usuario );

    }
}

?>

<!DOCTYPE html>
<html lang = 'en'>

<head>
<meta charset = 'UTF-8'>
<title>Portal Docente</title>
<script src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha256-yt2kYMy0w8AbtF89WXb2P1rfjcP/HTHLT7097U8Y5b8=" crossorigin="anonymous"></script>
<script src = 'js/jquery.toast.min.js'></script>
<script src = 'js/portal-docente.js'></script>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1'>
<link href = 'css/fontawesome-free-5.0.1/css/fontawesome-all.css' rel = 'stylesheet' type = 'text/css'>
<link href = 'https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap' rel = 'stylesheet'>
<link href = 'https://fonts.googleapis.com/css?family=Lobster&display=swap' rel = 'stylesheet'>
<link href = 'https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap' rel = 'stylesheet'>
<link href = 'https://fonts.googleapis.com/css2?family=Baloo+Paaji+2:wght@500&display=swap' rel = 'stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha256-Vzbj7sDDS/woiFS3uNKo8eIuni59rjyNGtXfstRzStA=" crossorigin="anonymous" />
<link rel = 'stylesheet' href = 'css/style.css'>
<link rel = 'stylesheet' href = 'css/jquery.toast.min.css'>

<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">

<script>
    <?php
        if (isset( $_GET['p'] ) && $_GET['p'] == 'foro') {
    ?>
            $(document).ready(function () {
                $('#paginacion span.numero[data-info="1"').click(); //lanzamos el click de la primera pagina
            });
    <?php 
        } 
    ?>
</script>

</head>
<body>

<div class = 'super_container'>

<!-- Header -->
<header class = 'header'>
<div class = 'iniSesion'>

<?php if ( !isset( $id_usuario ) ) {
    
    ?>

    <button class = 'botonHeader' type = 'submit' onclick = "location='index.php?p=login'">Iniciar sesión</button>
    <?php } else {
        ?>
        <div class="sessionIniciada">
            <?php
            if($_SESSION['avatar']!=""){
            ?>
            <img class="imagenIniSesion" src="<?=$_SESSION['avatar']?>" width="30">
            <?php
            }
            ?>
            <a href="index.php?p=alta&e=editar">Hola <?php echo ucfirst(strtolower($_SESSION['nombre']));?></a>
            <button class = 'botonHeader' type = 'submit' onclick = "location='index.php?a=logout'">Cerrar sesión</button>
            
        </div>

        <?php 
        }
       
        ?>
        
        </div>
        <nav>

        <!-- Logo -->
        <div class = 'logo'>
        <img src = 'images/logo.png' alt = ''>
        </div>
        <!-- Main Navigation -->
        <div class = 'menu'>
        <input type = 'checkbox' id = 'btn-menu'>
        <label for = 'btn-menu' class = 'fas fa-bars'></label> <!--icono para menu-->
        <ul class = 'menuLista'>        
        <li><a href = 'index.php?p=inicio'>INICIO</a></li>
        <hr>
        <?php
        if(isset($id_usuario)){
        ?>
        <li><a href = 'index.php?p=temarios'>TEMARIOS</a></li>
        <hr>
        <li><a href = 'index.php?p=noticias'>NOTICIAS</a></li>
        <hr>
        <li><a href = 'index.php?p=foro'>FORO</a></li>
        <hr>
        <?php
        }
        
        if(!isset($id_usuario)){
        ?>
        <li><a href = 'index.php?p=alta'>REGISTRARSE</a></li>
        <?php
        }
        ?>
        </ul>
        </div>

        </nav>
        </header>

        </div> <!--final div super_container-->

        </body>
        </html>

