<?php

class Temarios extends DBAbstractModel {
    private $id;
    private $titulo;
    private $autor_id;
    private $resumen;
    private $fecha;
    private $fichero_id;
    private $nivel_educacion;
    private $descargas;
    private $asignatura;

    function __construct() {
        $this->db_name = 'portal_docente';
        //nombre de base de datos

    }

    public function set( $data = array() ) {
        //como el id es autoincrementable, nunca se repetirá, no hace falta comprobar si existe
        foreach ( $data as $campo=>$valor ):
        $$campo = $valor;
        endforeach;
        $this->query = "
			INSERT INTO temarios
			(titulo,autor_id,resumen,fecha,fichero_id, nivel_educacion,descargas,asignatura)
			VALUES
			('$titulo', '$autor_id','$resumen','$fecha','$fichero_id','$nivel_educacion','$descargas','$asignatura')
			";
        //echo $this->query;
        $id = $this->execute_single_query();
        if ( $this->error == '' ) {
            //si no hay error
            $this->msg = 'Temario guardado correctamente';
        }

        return $id;
        //para devolver el id del temario insertado
    }

    public function get() {
        $this->query = "
			select * from temarios
			";
        $this->get_results_from_query();
    }

    public function getTotalTemarios() {
        //cuenta el número de temarios
        $total = 0;
        $this->query = "
			select count('id') as 'total' from temarios
			";
        $this->get_results_from_query();

        if ( count( $this->rows ) == 1 ) {
            $total = $this->rows[0]['total'];

        }
        return $total;

    }

    public function getVerTemariosConLimite( $cuantos, $comienzo ) {
        $this->query = "
			select * from temarios order by fecha desc limit $comienzo, $cuantos 
			";
        $this->get_results_from_query();

    }

    public function getVerTemariosConFiltro( $nivelEducacion, $cuantos, $comienzo ) {
        $this->query = "
			select * from temarios where nivel_educacion='$nivelEducacion' order by fecha desc limit $comienzo, $cuantos 
			";
        $this->get_results_from_query();
    }

    public function getVerTemariosEncontrados( $palabraAbuscar, $cuantos, $comienzo ) {
        $this->query = "
			select * from temarios where resumen LIKE '%$palabraAbuscar%' OR titulo LIKE '%$palabraAbuscar%' order by fecha desc limit $comienzo, $cuantos 
			";
        $this->get_results_from_query();
    }

    public function getTemarioPorId( $id = '' ) {
        //buscar temario por su id
        if ( $id != '' ) {
            $this->query = "
			SELECT *
			FROM temarios
			WHERE id = '$id'
			";
            $this->get_results_from_query();
        }
        if ( count( $this->rows ) == 1 ):
        foreach ( $this->rows[0] as $propiedad=>$valor ):
        $this->$propiedad = $valor;
        endforeach;
        endif;
    }

    public function editDescargas( $idFichero ) {
        $this->query = "
			UPDATE temarios
			SET descargas=descargas+1
			WHERE fichero_id = $idFichero
			";
        echo $this->query;
        $this->execute_single_query();

    }

    public function delete( $id = '' ) {

        $this->query = "
			DELETE FROM temarios
			WHERE id = '$id' 
			";

        $this->execute_single_query();
    }

    public function edit() {

    }
}

?>