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
	if($opcion=="noticias" ){	
	  	$pagina="noticias.php";
	}
	if($opcion=="temarios"){	
		$pagina="temarios.php";
	}
			
?>
	
	
	

<?php
	require_once("footer.php");
?>