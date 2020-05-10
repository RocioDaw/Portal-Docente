<div class="paginaFormulario">
<p>Añade un nuevo temario para que otros profesionales puedan descargarlo</p>
<form action="index.php?p=añadirTemario" method="post" name="formNoticias" enctype="multipart/form-data">

    <label for="titulo">TÍTULO:</label> <input type="text" name="titulo" id="titulo" placeholder="ESCRIBE EL TÍTULO DE TU CONTENIDO"  autofocus required>  
    <label for="resumen">RESUMEN DEL CONTENIDO:</label> <textarea name="resumen" id="resumen" required></textarea>
    <label for="asignatura">ASIGNATURA:</label><input type="text" name="asignatura" id="asignatura" placeholder="ESCRIBE LA ASIGNATURA CORRESPONDIENTE"  required>  
    <label for="nivelEducacion">NIVEL:</label><select name="nivelEducacion">
        <option value="educacionInfantil">Educación infantil</option>
        <option value="educaciónPrimaria">Educación primaria</option>
        <option value="eso">Educación secundaria obligatoria (E.S.O)</option>
        <option value="educaciónSuperior">Educación superior</option>
    </select>
    <label for="temario">FICHERO:</label><input class="fichero" type="file" name="temario" />
    <button type="submit" id="publicar" name="publicar" value="publicar">PUBLICAR CONTENIDO</button>
    <button type="submit" id="volver" name="volver" value="volver" onclick="location='index.php?p=temarios'"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>VOLVER </button>
</form>
</div>

<?php

    $titulo="";
    $resumen="";
    $nivel="";
    $fichero="";
    //$id_usuario
    if(isset($_POST['publicar'])){
        $titulo=$_POST['titulo'];
        $resumen=$_POST['resumen'];
        $nivel=$_POST['nivelEducacion'];
        $asignatura=$_POST['asignatura'];
        if(isset($_FILES["temario"])){           
            $extension = $_FILES["temario"]["type"];            
            $fichero=$_FILES["temario"]["tmp_name"];
            $tamanio = $_FILES["temario"]["size"];
            $nombreFichero = $_FILES["temario"]["name"];
           
            $fp = fopen($fichero, "rb");
            $contenido = fread($fp, $tamanio);
            $contenido = addslashes($contenido);
            fclose($fp); 
            //guardar fichero en la base de datos
			$ficheroArray=array("nombre"=>$nombreFichero,"tipo"=>$extension,"fichero"=>$contenido);
            $file= new Fichero();
            $idFichero = $file->set($ficheroArray);
            //guardar temario en la base de datos
            $temarioArray = array("titulo"=>$titulo, "autor_id"=>$id_usuario, "resumen"=>$resumen,"fecha"=>date('Y-m-d'),"fichero_id"=>$idFichero,"nivel_educacion"=>$nivel,"descargas"=>0,"asignatura"=>$asignatura);
            $temario= new Temarios();
            $temario->set($temarioArray);

        }
      
    }


   


?>