<?php
class Fichero extends DBAbstractModel{
    private $id;
    private $nombre;
    private $tipo;
    private $fichero;

    function __construct() {
		$this->db_name = 'portal_docente';//añadir nombre de base de datos
		
    }

    public function set($data=array()) {
		//como el id es autoincrementable, nunca se repetirá, no hace falta comprobar si existe
		foreach ($data as $campo=>$valor):
			$$campo = $valor;
			endforeach;
			$this->query = "
			INSERT INTO ficheros
			(nombre,tipo,fichero)
			VALUES
			('$nombre', '$tipo','$fichero')
            ";
            $id = $this->execute_single_query();
			if($this->error==""){
                //si no hay error
                $this->msg = "Fichero guardado correctamente";
            }
			
			return $id; 
    }

    public function get(){

    }
    public function delete(){

    }
    public function edit(){
        
    }
    
}
?>