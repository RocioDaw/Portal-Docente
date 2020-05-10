<section class="mostrarTemarioSeleccionado">
    <?php
    if (isset($_GET['id'])){
        $idTemario = $_GET['id'];
        $temario=new Temarios();
        $temario->getTemarioPorId($idTemario);
        $res=$temario->get_rows();
        $resumen= nl2br($res[0]['resumen']); 
        $autor = $res[0]['autor_id'];
        $titulo=$res[0]['titulo'];
        $fecha=$res[0]['fecha'];
        $asignatura = $res[0]['asignatura'];
        $puntuacion = $res[0]['valoracion'];
        $contValoraciones = $res[0]['contador_valoraciones'];
        
        /*fichero*/
        $ficheroId=$res[0]['fichero_id'];
        

        $nivelEducacion = $res[0]['nivel_educacion'];
        if($nivelEducacion=='educacionInfantil'){
            $nivelEducacion = 'Educación Infantil';
        }else if ($nivelEducacion == 'educaciónPrimaria'){
            $nivelEducacion = 'Educación Primaria';
        }else if ($nivelEducacion == 'eso'){
            $nivelEducacion = 'Educación Secundaria Obligatoria';
        }else{
            $nivelEducacion = 'Educación Superior';
        }
        $descargas = $res[0]['descargas'];

        $autor = $res[0]['autor_id'];
        $usuario = new Usuario();
        $usuario->get($autor);
        $res=$usuario->get_rows();
        $nombreUsuario=$res[0]['nombre'];

               
    ?>
        <div class="contenidoTemario">
            <div>
                <p><i class="fas fa-user"></i><?=$nombreUsuario?></p>
                <p><i class="fas fa-download"></i><?=$descargas?></p>
                <?php
                    if($autor==$id_usuario){
                ?>
                <a class="enlaceBorrar" href="index.php?p=temarios&&idTemario=<?=$idTemario?>"><i class='fas fa-trash-alt'></a></i></a>
                <?php
                    }
                ?>
                

            </div>

            <div>
                <h1><?=$titulo?></h1>
                <p><?=$resumen?></p>
            </div>
            
            <div>
                <p><b>Nivel educativo:</b><?=$nivelEducacion?></p>
                <p><b>Asignatura:</b><?=$asignatura?></p>
            </div>

            <div>
                <a class="enlaceDescargar" href="descargaArchivo.php?id=<?=$ficheroId?>" target="_blank">DESCARGAR</a>
            </div>
             <label>Valora este temario:</label>
            <div class="valoracion">           
               
                <!-- Estrella 1 -->
                <button onClick="enviarValoracion(5, <?=$_GET['id']?>)" type="button">
                    <i class="fas fa-star"></i>
                </button>

                <!-- Estrella 2 -->
                <button onClick="enviarValoracion(4, <?=$_GET['id']?>)" type="button">
                    <i class="fas fa-star"></i>
                </button>

                <!-- Estrella 3 -->
                <button onClick="enviarValoracion(3, <?=$_GET['id']?>)" type="button">
                    <i class="fas fa-star"></i>
                </button>

                <!-- Estrella 4 -->
                <button onClick="enviarValoracion(2, <?=$_GET['id']?>)" type="button">
                    <i class="fas fa-star"></i>
                </button>

                <!-- Estrella 5 -->
                <button onClick="enviarValoracion(1, <?=$_GET['id']?>)" type="button">
                    <i class="fas fa-star"></i>
                </button>
                
            </div>
        </div>

        <?php
           
            if($puntuacion!=0 && $contValoraciones!=0){
                $valoracionMedia=round($puntuacion/$contValoraciones);
            }else{
                $valoracionMedia=0;
            }
           
            
           
        ?>
        <div class="puntuacionContainer">
            <p>Calificación media del contenido: </p>
            <p id="numeroMedia"><?=$valoracionMedia?></p>
            
        </div>
        

        <?php   


        
               
               
       
    }
    
?>

    <h3 class="volver"><a href='index.php?p=temarios'>VOLVER</a></h3>
</section>



<div>                        
   
</div> 