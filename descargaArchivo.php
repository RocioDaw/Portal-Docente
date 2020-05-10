 <?php
 require_once( 'clases/db_abstract_model.php' );
 require_once( 'clases/Temarios.php' );
 require_once( 'clases/Fichero.php' );
 if (isset($_GET['id'])){

    $temario=new Temarios();
    $temario->editDescargas($_GET['id']);/*aumentar el número de descargas*/

    $fichero=new Fichero();
    $fichero->getFicheroPorId($_GET['id']);
    $result=$fichero->get_rows();
    $nombreFichero = $result[0]['nombre'];
    $tipo = $result[0]['tipo'];
    $fichero = $result[0]['fichero'];

 
header("Content-type: $tipo");
header("Content-Disposition: attachment; filename=$nombreFichero");
echo $fichero;


}


?>