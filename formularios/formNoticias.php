<div class="paginaFormulario">


<form action="index.php?p=noticias" method="post" name="formNoticias" enctype="multipart/form-data">
<p>Añade una nueva noticia</p>
<label for="titulo">TÍTULO:</label> <input type="text" name="titulo" id="titulo" placeholder="ESCRIBE EL TÍTULO DE LA NOTICIA"  autofocus required>  
<label for="texto">TEXTO DE LA NOTICIA:</label> <textarea name="texto" id="texto" required></textarea>
<input class="fichero" type="file" name="imagen" />
<button type="submit" id="publicar" name="publicar" value="publicar">PUBLICAR</button>

</form>

</div>




<?php

    $titulo="";
    $texto="";
	$imagen="";
    $msg="";
    $destino="./images/imagenesNoticias/"; 
	if(isset($_POST['publicar'])){
        $titulo=$_POST['titulo'];
        $texto=$_POST['texto'];
        $noticia=new Noticias();
        $autor_id=$id_usuario; //El autor de la noticia es el usuario activo
        $fecha= date('Y-m-d');
        $noticiaArray=array("autor_id"=>$autor_id,"fecha"=>$fecha,"titulo"=>$titulo,"texto"=>$texto);
        $id=$noticia->set($noticiaArray);

		if(isset($_FILES["imagen"])){
            $tiposValidos=array("image/gif","image/jpeg","image/png","image/jpg");
            $extension = substr($_FILES["imagen"]["type"], strrpos($_FILES["imagen"]["type"], '/')+1);
            
            if (in_array($_FILES["imagen"]["type"],$tiposValidos)){
                if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
                    //guarda la imagen con el id de la noticia como nombre
                    move_uploaded_file($_FILES['imagen']['tmp_name'],$destino.$id.".".$extension);
                }
            }    
           
        }
    
        
			            
		
	}
        echo $msg;
        
        
?>
    