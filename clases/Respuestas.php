<?php
class Respuestas extends DBAbstractModel{
    private $id;
    private $usuario_id;
    private $hilo_id;
    private $respuesta;

 

    function __construct() {
        $this->db_name = 'portal_docente';
        

    }

    public function set( $data = array() ) {
        foreach ( $data as $campo=>$valor ):
        $$campo = $valor;
        endforeach;
        $this->query = "
			INSERT INTO respuestas
			(usuario_id,hilo_id,respuesta)
			VALUES
			('$usuario_id', '$hilo_id','$respuesta')
            ";
        $id = $this->execute_single_query();
        //echo $this->query;
        return $id;
     
    }

    public function get($idHilo = '' ) {
        $this->query = "
			select * from respuestas where hilo_id=$idHilo
            ";
        $this->get_results_from_query();
    }

    public function edit(){

    }

    public function delete(){
        
    }


}
?>