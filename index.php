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
		include("alta.php");
	}
	if($opcion=="noticias" ){	
		include("noticias.php");
	}
	if($opcion=="temarios"){	
		include("temarios.php");
	}
	if($opcion=="login"){
		include("login.php");
	}
			
?>
	
	
	

<?php
	require_once("footer.php");
?>