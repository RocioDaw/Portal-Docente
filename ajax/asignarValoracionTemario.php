<?php

$conexion = new mysqli( 'localhost', 'root', '', 'portal_docente' );

$sql = 'UPDATE `temarios` SET valoracion = valoracion+'.$_POST['valoracion'].', contador_valoraciones=contador_valoraciones+1 WHERE id ='.$_POST['temarioId'];
$rs = $conexion->query( $sql );

$conexion->close();

$jsondata = array();
$jsondata['success'] = true;
$jsondata['message'] = 'valorado correctamente';

header( 'Content-type: application/json; charset=utf-8' );
echo json_encode( $jsondata );
?>