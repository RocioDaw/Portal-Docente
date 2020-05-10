<?php

class Fichero extends DBAbstractModel {
    private $id;
    private $nombre;
    private $tipo;
    private $fichero;

    function __construct() {
        $this->db_name = 'portal_docente';
        //añadir nombre de base de datos

    }

    public function set( $data = array() ) {
        //como el id es autoincrementable, nunca se repetirá, no hace falta comprobar si existe
        foreach ( $data as $campo=>$valor ):
        $$campo = $valor;
        endforeach;
        $this->query = "
			INSERT INTO ficheros
			(nombre,tipo,fichero)
			VALUES
			('$nombre', '$tipo','$fichero')
            ";
        //echo $this->query;
        $id = $this->execute_single_query();
        if ( $this->error == '' ) {
            //si no hay error
            $this->msg = 'Fichero guardado correctamente';
        }

        return $id;

    }

    public function getFicheroPorId( $id = '' ) {
        //buscar fichero por su id
        if ( $id != '' ) {
            $this->query = "
		  	SELECT * FROM ficheros	WHERE id = '$id'
			  ";
            $this->get_results_from_query();
        }
        if ( count( $this->rows ) == 1 ):
        foreach ( $this->rows[0] as $propiedad=>$valor ):
        $this->$propiedad = $valor;
        endforeach;
        endif;
    }

    public function get() {
        $this->query = "
			select * from ficheros
			";
        $this->get_results_from_query();
    }

    public function delete() {

    }

    public function edit() {

    }

}
?>