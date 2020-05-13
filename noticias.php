<div class=noticiasContainer>
    <div class="encabezadoNoticias">
        <h1 class="tituloPagina">Últimas Noticias</h1>
        <?php
            if($_SESSION['tipo']=='administrador'){
                echo "<a class='añadirNoticia' href='index.php?p=formNoticias'>Añadir nueva noticia</a>";
            }
        ?>
    </div>
    <hr> 
<?php
$comienzo=0;
if(isset($_GET['comienzo'])){
  $comienzo= $_GET['comienzo'];
}
$noticias=new Noticias();
$total=$noticias->getTotalNoticias();
$noticias=new Noticias();
$noticias->getVerNoticiasConLimite(5,$comienzo);
$cuantos=count($noticias->get_rows());
if($cuantos>0){
    for($cont=0;$cont<$cuantos;$cont++){
        $tituloNoticia = $noticias->get_rows()[$cont]['titulo'];
        $textoNoticia = $noticias->get_rows()[$cont]['texto'];
        $fecha = $noticias->get_rows()[$cont]['fecha'];
        $idNoticia = $noticias->get_rows()[$cont]['id'];

    
        $ruta='./images/imagenesNoticias/';
        $filehandle = opendir($ruta);
        //Recorremos los Archivos del Directorio
    while ($file = readdir($filehandle)){    
        if ($file != "." && $file != "..") {
            $posPunto= strpos($file, ".");
            if(substr($file,0,$posPunto)==$idNoticia){
            ?>
                <div class="noticia">
                    <a data-fancybox href="<?=$ruta.$file ?>"><img class="imagen" src="<?=$ruta.$file ?>"></a><br>
                    <div class="containerTexto">
                        <p class="titulo"><?=$tituloNoticia?></p>
                        <p class="fecha"><?=obtenerFechaEnLetra($fecha)?></p>
                        <p class="resumen"><?=substr($textoNoticia, 0, 250).'...'?></p>
                        <a class="button" href='index.php?p=mostrarNoticia&id=<?=$idNoticia?>&imagen=<?=$ruta.$file?>'>LEER ARTÍCULO</a>
                    </div>
                </div>
            <?php
            }
            
        }
           
    }   
    closedir($filehandle);
    }
    ?>
    <div class='enlaces'>
    <?php
    if ($total>5){
		if ($comienzo+5< $total){
			$comienzo=$comienzo+5;
            $verMas="<a href='index.php?p=noticias&comienzo=$comienzo'>VER MÁS NOTICIAS </a> <i class='fas fa-angle-double-right'></i>";
            if($comienzo==5){ 
                echo $verMas;
            }
                        
		}else{
            $verMas="";
        }		
			
    }
    if(isset($_GET['comienzo'])){ //que salga solo cuando se muestren más noticias
        echo '<div class="verAnteriores">';
        echo "<a href='index.php?p=noticias'>VOLVER AL PRINCIPIO </a> $verMas ";
        echo '</div>';
    }
     
    
}  
?>
</div>


