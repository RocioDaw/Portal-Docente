<?php
class Hilos extends DBAbstractModel{
    private $id;
    private $usuario_id;
    private $titulo;
    private $tema;
    private $categoría;
    private $respuestas;

    function __construct() {
        $this->db_name = 'portal_docente';
        

    }

    public function set( $data = array() ) {
        foreach ( $data as $campo=>$valor ):
        $$campo = $valor;
        endforeach;
        $this->query = "
			INSERT INTO hilo
			(usuario_id,titulo,categoria,tema,respuestas)
			VALUES
			('$usuario_id','$titulo','$categoria','$tema','$respuestas')
            ";
            //echo $this->query;
        $id = $this->execute_single_query();
        
        return $id;
     
    }

    public function get() {
        $this->query = "
			select * from hilos
			";
        $this->get_results_from_query();
    }


    public function getTotalHilos() {
        //cuenta el número de hilos
        $total = 0;
        $this->query = "
			select count('id') as 'total' from hilo
			";
        $this->get_results_from_query();

        if ( count( $this->rows ) == 1 ) {
            $total = $this->rows[0]['total'];

        }
        return $total;

    }

    public function getHiloPorId( $id = '' ) {
        if ( $id != '' ) {
            $this->query = "
			SELECT *
			FROM hilo
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


    public function delete( $id = '' ) {
        $this->query = "delete from hilo where id=$id";
        $this->execute_single_query();
    }

    public function edit(){

    }

    



}
?>