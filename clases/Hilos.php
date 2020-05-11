<?php
class Hilo extends DBAbstractModel{
    private $id;
    private $usuario_id;
    private $titulo;
    private $fecha;
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
			(usuario_id,fecha,titulo,categoria,tema,respuestas)
			VALUES
			('$usuario_id', '$fecha','$titulo','$categoria','$tema','$respuestas')
            ";
        $id = $this->execute_single_query();
        
        return $id;
     
    }

    public function get() {
        $this->query = "
			select * from hilos
			";
        $this->get_results_from_query();
    }

    public function edit(){

    }

    public function delete(){

    }



}
?>