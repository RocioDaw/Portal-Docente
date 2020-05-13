<section class="mostrarNoticiaContainer">
    <?php
    if (isset($_GET['id'])){
        $img=$_GET['imagen'];
        $noticia=new Noticias();
        $noticia->getNoticiaPorId($_GET['id']);
        $res=$noticia->get_rows();
        $texto= nl2br($res[0]['texto']); //nl2br para mostrar los saltos de línea de la noticia
        $titulo=$res[0]['titulo'];
        $fecha=$res[0]['fecha'];
        echo "<h1>$titulo</h1>";
        echo "<p>".obtenerFechaEnLetra($fecha)."</p>";
        echo "<img src='$img' width='90%'>";
        echo "<p>$texto</p>";
       
       
    }
    
?>

    <h3 class="volver"><a href='index.php?p=noticias'>VOLVER</a></h3>
</section>
