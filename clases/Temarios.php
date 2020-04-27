<?php
class Temarios extends DBAbstractModel{
    private $id;
    private $titulo;
    private $autor_id;
    private $resumen;
    private $fecha;
    private $fichero_id;
    private $nivel_educacion;
    private $descargas;

    function __construct() {
		$this->db_name = 'portal_docente';//nombre de base de datos
		
    }

    public function set($data=array()) {
		//como el id es autoincrementable, nunca se repetirá, no hace falta comprobar si existe
		foreach ($data as $campo=>$valor):
			$$campo = $valor;
			endforeach;
			$this->query = "
			INSERT INTO temarios
			(titulo,autor_id,resumen,fecha,fichero_id, nivel_educacion)
			VALUES
			('$titulo', '$autor_id','$resumen','$fecha','$fichero_id','$nivel_educacion')
            ";
            $id = $this->execute_single_query();
			if($this->error==""){
                //si no hay error
                $this->msg = "Noticia guardada correctamente";
            }
			
			return $id; //para devolver el id de la noticia insertada
    }

    public function get() {
		$this->query = "
			select * from temarios
			";
	        $this->get_results_from_query();
	}

    public function delete(){

    }
    public function edit(){
        
    }
}

?>