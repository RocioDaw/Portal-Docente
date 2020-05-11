<?php
class Usuario extends DBAbstractModel{
	
	private $id; 
	private $nombre;
	private $apellidos;
	private $email;
	private $password; 
	private $tipo;
	private $avatar;

	function __construct() {
		$this->db_name = 'portal_docente';
		
	}//NOMBRE DE BASE DE DATOS

	
	public function set($data=array()) { 
		foreach ($data as $campo=>$valor):
			$$campo = $valor;
		endforeach;
		$this->query = "
		INSERT INTO usuarios 
		(nombre,apellidos,email,password,tipo,avatar)
		VALUES
		('$nombre','$apellidos','$email','$password','$tipo','$avatar')
		";
		//echo $this->query;
		$id = $this->execute_single_query();
		
				if($this->error=="")//si no hay error
					$this->msg = $email.' guardado correctamente';
				else{
					$this->msg="Error al guardar usuario en la  BD";
				}
		return $id;
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
			password='$password',
			tipo='$tipo',
			avatar='$avatar'
			WHERE id = '$id'
		";
		echo $this->query;
		$this->execute_single_query();
		if($this->error==""){//si no hay error
			$this->msg = "Usuario $this->nombre modificado correctamente";
		}else{
			$this->msg=$this->error;
		}
		
	}
		
	public function get($id='') { //buscar usuario por su id
		if($id != ''){
			$this->query = "
			SELECT *
			FROM usuarios
			WHERE id = '$id'
			";
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
	public  function editAvatar($idUsuario,$avatar){
        $this->query = "
			UPDATE usuarios
			SET avatar='$avatar'
			WHERE id = $idUsuario
			";
        echo $this->query;
        $this->execute_single_query();
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
