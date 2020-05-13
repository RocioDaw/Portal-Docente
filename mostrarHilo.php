<?php
    if(isset($_GET['id'])){
        $idHilo = $_GET['id'];
        $hilo = new Hilos();
        $hilo -> getHiloPorId($idHilo);
        $res=$hilo->get_rows();

        $fecha = $res[0]['fecha'];
        $titulo= $res[0]['titulo']; 
        $tema = $res[0]['tema'];
        $respuestas = $res[0]['respuestas'];
        $usuarioId = $res[0]['usuario_id'];
        
        $usuario = new Usuario();
        $usuario -> get($usuarioId);
        $result=$usuario->get_rows();
        $nombre = $result[0]['nombre'];
        $avatar = $result[0]['avatar'];
        
        ?>
        <div class="hiloContainer">
            <div>
                <img src="<?=$avatar?>">
                <p><?=$nombre?></p>
                <p><?=$fecha?></p>
           </div> 
            <div>
                <h3><?=$titulo?></h3>
                <p><?=$tema?></p>
            </div>
            
           
        </div>
<?php
    
    if ($respuestas == true){
     ?>
     <div class="paginaFormulario"> 
     <form action="index.php?p=mostrarHilo&&id=<?=$_GET['id']?>" method="post" name="formHilo" enctype="multipart/form-data">
        <label for="respuesta">Deja aquí tu respuesta:</label> <textarea name="respuesta" id="respuesta" placeholder="Respuesta..." required></textarea>
        <button type="submit" id="publicar" name="publicar" value="publicar">PUBLICAR</button>

    </form>
    </div> 
     <?php 
    }

    
    if(isset($_POST['publicar'])){
        $respuesta = $_POST['respuesta'];       
        $usuario = $_SESSION['id'];
       
        $resp = new Respuestas();
        $respuestaArray = array("usuario_id"=>$usuario, "hilo_id"=>$idHilo, "respuesta"=>$respuesta);
        $resp -> set($respuestaArray);
    }
    ?>
    <section class="respuestasHilo">
        <hr>
        <h1>Respuestas:</h1>
        <?php 
            $resp = new Respuestas();
            $resp -> get($_GET['id']);
            $cuantos=count($resp->get_rows());
            
            if($cuantos>0){
                for($cont=0;$cont<$cuantos;$cont++){
                    $fechaRespuesta= $resp->get_rows()[$cont]['fecha'];
                    $textoRespuesta = $resp->get_rows()[$cont]['respuesta'];
                    $idUsuarioRespuesta = $resp->get_rows()[$cont]['usuario_id'];
                   

                    $user = new Usuario();
                    $user -> get($idUsuarioRespuesta);
                    $rs=$user->get_rows();
                    $nombreUsRespuesta = $rs[0]['nombre'];
                    $avatarUsRespuesta = $rs[0]['avatar'];
                    ?>
                    <div class="impresionRespuesta">
                        <div>
                            <img class="imagenUsuario" src=<?=$avatarUsRespuesta?>>
                            <p><?=$nombreUsRespuesta?></p>
                            <p><?= $fechaRespuesta?></p>
                        </div>
                        <div>
                            <p><?=$textoRespuesta?></p>
                        </div>

                    </div>
                    <?php
                }
            }
        ?>
    </section>
    <?php
    
    }
    ?>