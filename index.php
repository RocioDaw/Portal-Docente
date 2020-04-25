<?php
	require("header.php");
?>
<?php
		
	$opcion="inicio";
	
	if(isset($_GET['p'])){
        $opcion=$_GET['p'];
    }	   
	if($opcion=="inicio"){	
        include("inicio.php");	
	}
	if($opcion=="alta"){
		include("formularios/alta.php");
	}
	if($opcion=="noticias" ){	
		include("noticias.php");
	}
	if($opcion=="mostrarNoticia"){		
		include("mostrarNoticia.php");
	}
	if($opcion=="temarios"){	
		include("temarios.php");
	}
	if($opcion=="login"){
		include("formularios/login.php");
	}
			
?>
	
	
	

<?php
	require_once("footer.php");
?>