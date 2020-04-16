<div class="paginaFormulario">


<form action="index.php?p=noticias" method="post" name="formNoticias" enctype="multipart/form-data">

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
		if(isset($_FILES["imagen"])){
            $tiposValidos=array("image/gif","image/jpeg","image/png","image/jpg");
            if (in_array($_FILES["imagen"]["type"],$tiposValidos)){
                if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
                    move_uploaded_file($_FILES['imagen']['tmp_name'],$destino.$_FILES['imagen']['name']);
                }
            }    
           
        }
    
        $noticia=new Noticias();
        $autor_id=3;
        $fecha= date('Y-m-d');
        echo $fecha;
        $noticiaArray=array("autor_id"=>$autor_id,"fecha"=>$fecha,"titulo"=>$titulo,"texto"=>$texto);
        $noticia->set($noticiaArray);
			            
		
	}
        echo $msg;
        
        
?>
    