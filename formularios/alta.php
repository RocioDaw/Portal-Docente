
<div class="paginaFormulario">

<form action="index.php?p=alta" onsubmit="return comprobarCamposRegistro()" method="post" name="altaUsuario" enctype="multipart/form-data">
<?php
    $nombre="";
    $apellidos="";
	$email="";
	$password="";
    $tipo=""; 
    
    if(isset($_SESSION['id'])){
        echo "<h1>EDITAR</h1>";
        $nombre=$_SESSION['nombre'];
        $apellidos=$_SESSION['apellidos'];        
        $email=$_SESSION['email'];
        $password=$_SESSION['password'];
        $tipo=$_SESSION['tipo'];
        
    }else{
        echo "<h1>ALTA</h1>";
    }

?>
<label for="nombre">NOMBRE:</label> <input type="text" name="nombre" id="nombre" value="<?=$nombre?>" placeholder="ESCRIBE TU NOMBRE"  autofocus>  
<label for="apellidos"> APELLIDOS:</label>  <input type="text" name="apellidos" value="<?=$apellidos?>" id="apellidos" placeholder="ESCRIBE TUS APELLIDOS"> 
<label for="email">EMAIL:</label>  <input type="text" name="email" id="email" value="<?=$email?>" placeholder="ESCRIBE TU EMAIL"> 
<label for="password">CONTRASEÑA: </label> <input type="password" name="password" value="<?=$password?>" placeholder="ESCRIBE TU CONTRASEÑA">
<label for="password2">REPETIR CONTRASEÑA: </label> <input type="password" value="<?=$password?>" name="password2" placeholder="VUELVE A ESCRIBIR TU CONTRASEÑA">
<label for="tipo">TIPO DE USUARIO: </label>
<select name="tipo">
    <option value="administrador" <?php if($tipo=="administrador") echo'selected="selected"';?>>Administrador</option>
    <option value="usuario" <?php if($tipo=="usuario") echo'selected="selected"';?> >Usuario</option>
</select>
<label for="avatar">AVATAR: </label> <?php if(isset($_SESSION['avatar'])){echo "<div class='imagenActual'><p>Avatar Actual:</p><img src='".$_SESSION['avatar']."' width=50></div>";}?>






<input  type="file" name="avatar" >
<?php
    if(isset($_SESSION['id'])){
        echo '<button type="submit" id="editar" name="editar" value="editar">EDITAR DATOS</button>';
    }else{
        echo '<button type="submit" id="registro" name="registro" value="registro">REGISTRARSE</button>';
    }
?>


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
    $avatar="";
    $destino="./images/avatars/";
	if(isset($_POST['registro'])){
        $nombre=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$password2=$_POST['password2'];
        $tipo=$_POST['tipo'];    
        
              
		if($password==$password2){
            $usr=new Usuario(); 
            $usrArray=array("nombre"=>$nombre,"apellidos"=>$apellidos,"email"=>$email,"password"=>$password,"tipo"=>$tipo,"avatar"=>$avatar);
            $id=$usr->set($usrArray);    
            if(isset($_FILES["avatar"])){  
                    $tiposValidos=array("image/gif","image/jpeg","image/png","image/jpg");
                    $extension = substr($_FILES["avatar"]["type"], strrpos($_FILES["avatar"]["type"], '/')+1);             
                    if(is_uploaded_file($_FILES['avatar']['tmp_name'])){
                        $avatar= $destino.$id.".".$extension;
                        move_uploaded_file($_FILES['avatar']['tmp_name'],$avatar);
                    }else{
                        $avatar = $destino."avatar.png";
                    }
                    $usuario=new Usuario();
                    $usuario->editAvatar($id,$avatar);
            }
                        
        
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['apellidos'] = $apellidos;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['tipo'] = $tipo;
            $_SESSION['avatar'] = $avatar;

            //redireccionamos al usuario identificado hacia inicio
            header("Location:index.php");
            
            
			            
		}else{
            $msg="Los password no coinciden";
        }
    }
    
    if(isset($_POST['editar'])){
        $nombre=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$password2=$_POST['password2'];
        $tipo=$_POST['tipo'];   
        if($password==$password2){
            if($_FILES['avatar']['name']==""){
                $avatar=$_SESSION['avatar'];
            }else{
                $tiposValidos=array("image/gif","image/jpeg","image/png","image/jpg");
                $extension = substr($_FILES["avatar"]["type"], strrpos($_FILES["avatar"]["type"], '/')+1);             
                if(is_uploaded_file($_FILES['avatar']['tmp_name'])){
                    $avatar= $destino.$_SESSION['id'].".".$extension;
                    move_uploaded_file($_FILES['avatar']['tmp_name'],$avatar);
                }
            }
            $usuario=new Usuario(); 
            $usrArray=array("id"=>$_SESSION['id'],"nombre"=>$nombre,"apellidos"=>$apellidos,"email"=>$email,"password"=>$password,"tipo"=>$tipo,"avatar"=>$avatar);
            $usuario->edit($usrArray);     
           
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['apellidos'] = $apellidos;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['tipo'] = $tipo;
            $_SESSION['avatar'] = $avatar;
            ?>
            <script>
                mostrarToastSuccess("Datos editados correctamente")
            </script>
            <?php
        }else{
            $msg="Los password no coinciden";
        }
       
           
    }
        echo $msg;
          
  
?>
    

   

