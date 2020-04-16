<?php
class Noticias extends DBAbstractModel{
    private $id;
    private $autor_id; 
    private $fecha;
	private $titulo;	
	private $texto;
	

    function __construct() {
		$this->db_name = 'portal_docente';//añadir nombre de base de datos
		
    }
    
    public function set($data=array()) {
		//como el id es autoincrementable, nunca se repetirá, no hace falta comprobar si existe
		foreach ($data as $campo=>$valor):
			$$campo = $valor;
			endforeach;
			$this->query = "
			INSERT INTO noticias
			(autor_id,fecha,titulo,texto)
			VALUES
			('$autor_id', '$fecha','$titulo','$texto')
            ";
            echo $this->query;
            $this->execute_single_query();
			if($this->error==""){
                //si no hay error
                $this->msg = "Noticia guardada correctamente";
            }
				
    }
    
   public function get() {
		$this->query = "
			select * from comentarios
			";
	        $this->get_results_from_query();
	}
    
    public function getTotalNoticias() { //cuenta el número de noticias
		$total=0;
			$this->query = "
			select count('id') as 'total' from noticias
			";
			$this->get_results_from_query();
			
		
		if(count($this->rows) == 1){
			$total=$this->rows[0]['total'];

		}
		return $total;
		
    }
    
    public function delete($id='') {
		$this->query = "delete from noticias where id=$id";
		$this->execute_single_query();
	}

    public function edit(){

    }
    
}
?>