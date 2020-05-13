<?php

$conexion = new mysqli( 'localhost', 'root', '', 'portal_docente' );

$pagina = $_POST['pagina']-1;
$hilosPorPagina = 5;

$sql = "SELECT * FROM `hilo` ORDER BY id DESC LIMIT ".($pagina*$hilosPorPagina).",$hilosPorPagina";
$result = $conexion->query( $sql );

while ($fila = $result->fetch_assoc()) {
?>
    <div class="hilo">
        <div>
            <p><?=$fila['fecha']?></p>
            <p>Categoría: <?=$fila['categoria']?></p>
        </div>    
        <a href="index.php?p=mostrarHilo&id=<?=$fila['id']?>"><?=$fila['titulo']?></a>    
    </div>
<?php   
}
$conexion->close();
?>


