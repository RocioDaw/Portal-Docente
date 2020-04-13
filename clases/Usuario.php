<?php
class Usuario extends DBAbstractModel{
	
	private $id; 
	private $nombre;
	private $apellidos;
	private $email;
	private $password; 
	private $tipo;

	function __construct() {
		$this->db_name = 'portal_docente';
		
	}//AÑADIR NOMBRE DE BASE DE DATOS

	
	public function set($data=array()) { 
		foreach ($data as $campo=>$valor):
			$$campo = $valor;
		endforeach;
		$this->query = "
		INSERT INTO usuarios 
		(nombre,apellidos,email,password,tipo)
		VALUES
		('$nombre','$apellidos','$email','$password','$tipo')
		";
		$this->execute_single_query();
		
				if($this->error=="")//si no hay error
					$this->msg = $email.' guardado correctamente';
				else{
					$this->msg="Error al guardar usuario en la  BD";
				}

	}
	public function edit($data=array()) {//editar usuario
		foreach ($data as $campo=>$valor):
			$$campo = $valor;
		endforeach;
		$this->query = "
			UPDATE usuarios
			SET nombre='$nombre',
			apellidos='$apellidos',
			email='$email',
			pass='$password',
			tipo='$tipo'
			WHERE id_usr = '$id'
		";
		//echo $this->query;
		$this->execute_single_query();
		if($this->error==""){//si no hay error
			$this->msg = "Usuario $this->nombre modificado correctamente";
		}else{
			$this->msg=$this->error;
		}
	}
		
	public function get($id='') { //buscar usuario por su id
		if($email != ''){
			$this->query = "
			SELECT *
			FROM usuarios
			WHERE email = '$email'
			";
			$this->get_results_from_query();
		}else{
			$this->query = "
			SELECT id_usr,nombre,email,pass,tipo
			FROM usuarios";
			$this->get_results_from_query();
		}
		if(count($this->rows) == 1):
			foreach ($this->rows[0] as $propiedad=>$valor):
				$this->$propiedad = $valor;
			endforeach;
		endif;
	}

	
	public function buscarUsuarioPass($email='',$password='') { //SUSTITUIR BUSCARUSUARIOPASS POR GET
	 	$this->query = "
			SELECT *
			FROM usuarios
			WHERE email = '$email' and password= '$password'
			";
			$this->get_results_from_query();
	
		if(count($this->rows) == 1):
			foreach ($this->rows[0] as $propiedad=>$valor):
				$this->$propiedad = $valor;
			endforeach;
		endif;
	}	

	public function delete($email= '') {
		$this->query = "
		DELETE FROM usuarios
		WHERE email = '$email'
		";
		$this->execute_single_query();
		if($this->error==""){//si no hay error
			$this->msg = 'Usuario eliminado exitosamente';
		}else{
			$this->msg=$this->error;
		}
	}
	
	
	

}
?>
