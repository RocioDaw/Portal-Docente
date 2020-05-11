<?php
class Respuesta extends DBAbstractModel{
    private $id;
    private $usuario_id;
    private $hilo_id;
    private $fecha;
    private $respuesta;
    private $likes;
 

    function __construct() {
        $this->db_name = 'portal_docente';
        

    }

    public function set( $data = array() ) {
        foreach ( $data as $campo=>$valor ):
        $$campo = $valor;
        endforeach;
        $this->query = "
			INSERT INTO respuesta
			(usuario_id,fecha,hilo_id,likes,respuesta)
			VALUES
			('$usuario_id', '$fecha','$hilo_id','$likes','$respuesta')
            ";
        $id = $this->execute_single_query();
        
        return $id;
     
    }

    public function get() {
        $this->query = "
			select * from respuesta
			";
        $this->get_results_from_query();
    }

    public function edit(){

    }

    public function delete(){
        
    }


}
?>