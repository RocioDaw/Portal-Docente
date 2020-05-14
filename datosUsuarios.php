<section class="datos">
    <div>
    <button type = 'submit' onclick = "location='exportarDatos.php'">Exportar datos de Usuarios</button>
    </div>
</section>

<section class="buscarUsuario">
    <div class="paginaFormulario">
    <form class = 'buscarUsuarioFormulario' action = 'index.php?p=datosUsuarios' method = 'post' name = 'buscarUsuarioFormulario'>
        <input type = 'inputBuscarUsuario' name = 'inputBuscarUsuario' placeholder = 'Busca un usuario'>
        <button type = 'submit' id = 'buscarUsuario' name = 'buscarUsuario' value = 'buscarUsuario'><i class = 'fas fa-search'></i></button>
    </form>
    </div>
</section>


<?php

$palabraABuscar = '';
if ( isset( $_POST['buscarUsuario'] ) ) {
    $palabraABuscar = $_POST['inputBuscarUsuario'];
}
    
    $usuario = new Usuario();
    $usuario->getVerUsuariosEncontrados( $palabraABuscar);
    $cuantos=count($usuario->get_rows());
   if($cuantos>0){
        for($cont=0;$cont<$cuantos;$cont++){
            $idUsuario= $usuario->get_rows()[$cont]['id'];
            $nombre = $usuario->get_rows()[$cont]['nombre'];
            $apellidos = $usuario->get_rows()[$cont]['apellidos'];
            $email = $usuario->get_rows()[$cont]['email'];
            $avatar = $usuario->get_rows()[$cont]['avatar'];
            $tipo = $usuario->get_rows()[$cont]['tipo'];
            ?>
            <div class="usuarioEncontrado">
                <div>
                    <img src=<?=$avatar?>>
                    <?php
                   
                        if($_SESSION['id'] != $idUsuario && $tipo == 'usuario' ){
                        ?>
                        <a href="index.php?p=datosUsuarios&b=<?=$idUsuario?>>">BORRAR</a>
                        <?php
                        }
                        
                        
                    ?>
                    
                </div>
                <div>
                    <p>Nombre: <?=$nombre?></p>
                    <p>Apellidos: <?=$apellidos?></p>
                    <p>Email: <?=$email?></p>
                    <p>Tipo: <?=$tipo?></p>
                </div>
            </div>
            <?php
        }
    }

if(isset($_GET['b'])){
    $idUsuario = $_GET['b'];
    $usuario = new Usuario();
    $usuario -> delete($idUsuario);
}

?>