<?php
$msg = '';
if ( isset( $_POST['entrar'] ) ) {
    $usr = new Usuario();
    $usr->buscarUsuarioPass( $_POST['email'], $_POST['password'] );
    $res = $usr->get_rows();

    if ( $res == NULL ) {
        $msg = 'LOGIN INCORRECTO';
    } else {
        $_SESSION['id'] = $res[0]['id'];
        $_SESSION['email'] = $res[0]['email'];
        $_SESSION['password'] = $res[0]['password'];
        $_SESSION['apellidos'] = $res[0]['apellidos'];
        $_SESSION['nombre'] = $res[0]['nombre'];
        $_SESSION['tipo'] = $res[0]['tipo'];
        $_SESSION['avatar'] = $res[0]['avatar'];
        //identificamos al usuario y redireccionamos a inicio
        ?>
        <script>
            window.location.href = "/";
        </script>
        <?php
    }

}
?>
<div class="paginaFormulario">



<form action="index.php?p=login" method="post" name="altaUsuario">
<h3>Introduce tu email y contraseña para iniciar sesión</h3>
<label for="email">EMAIL:</label>  <input type="email" name="email" id="email" placeholder="ESCRIBE TU EMAIL" required autofocus > 
<label for="password">CONTRASEÑA: </label> <input type="password" name="password" placeholder="ESCRIBE TU CONTRASEÑA" required>

<p class = 'mensaje'><?php echo $msg?></p>
<button type="submit" id="entrar" name="entrar" value="entrar">ENTRAR</button>
<p>Si no tienes cuenta haz click <a href="index.php?p=alta">aqui</a> para registrarte</p>
</form>

</div>
