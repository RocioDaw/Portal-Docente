
<div class="paginaFormulario">


<form action="index.php?p=alta" method="post" name="altaUsuario">

<label for="nombre">NOMBRE:</label> <input type="text" name="nombre" id="nombre" placeholder="ESCRIBE TU NOMBRE"  autofocus required>  
<label for="apellidos"> APELLIDOS:</label>  <input type="text" name="apellidos" id="apellidos" placeholder="ESCRIBE TUS APELLIDOS" required> 
<label for="email">EMAIL:</label>  <input type="email" name="email" id="email" placeholder="ESCRIBE TU EMAIL" required> 
<label for="password">CONTRASEÑA: </label> <input type="password" name="password" placeholder="ESCRIBE TU CONTRASEÑA" required>
<label for="password2">REPETIR CONTRASEÑA: </label> <input type="password" name="password2" placeholder="VUELVE A ESCRIBIR TU CONTRASEÑA" required>
<select name="tipo">
    <option value="administrador">Administrador</option>
    <option value="usuario">Usuario</option>
</select>
<button type="submit" id="registro" name="registro" value="registro">REGISTRARSE</button>

</form>

</div>




<?php
    $nombre="";
    $apellidos="";
	$email="";
	$password="";
    $password2="";
    $tipo="";
	$msg="";
	if(isset($_POST['registro'])){
        $nombre=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$password2=$_POST['password2'];
		$tipo=$_POST['tipo'];
					
		if($password==$password2){
            $usr=new Usuario();
            $usr->set($_POST);
			            
		}else{
            $msg="Los password no coinciden";
        }
	}
        echo $msg;
        
        
?>
    

   

