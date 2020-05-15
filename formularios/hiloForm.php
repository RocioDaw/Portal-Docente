<div class="paginaFormulario">

<p>Introduce los datos para crear un nuevo hilo</p>

<form action="index.php?p=hiloForm" method="post" name="formHilo" enctype="multipart/form-data">
    <label for="titulo">TITULO:</label> <input type="text" name="titulo" id="titulo"  placeholder="INTRODUCE UN TÍTULO"  autofocus required>  
    <label for="tema">TEMA A TRATAR</label> <textarea name="tema" id="resumen" placeholder="INTRODUCE EL TEMA A TRATAR" required></textarea>
    <label for="categoria">CATEGORÍA:</label><select name="categoria">
            <option value="Dudas">Dudas</option>
            <option value="Propuestas">Propuestas</option>
            <option value="Ayuda">Ayuda</option>
            <option value="Información">Información</option>
            <option value="Otros">Otros</option>
        </select>
    <label for="permitirRespuesta">¿Quieres que tu hilo permita respuestas?</label>
    <label><input type="checkbox" name="permitirRespuestas" id="permitirRespuestas" value=1> </label>   
        
    <button type="submit" id="crear" name="crear" value="crear">CREAR HILO</button>

</form>

</div>
<?php
    $usuarioId="";
    $titulo="";
    $tema="";
    $categoria="";
    $respuestas="";

    if(isset($_POST['crear'])){
        $titulo=$_POST['titulo'];
        $tema=$_POST['tema'];
        $categoria=$_POST['categoria'];
      
        if(isset($_POST['permitirRespuestas'])){
            $respuestas=1;
        }else{
            $respuestas=0;
        }
        $hiloArray = array("titulo"=>$titulo, "usuario_id"=>$id_usuario, "tema"=>$tema,"categoria"=>$categoria,"respuestas"=>$respuestas);
        $hilo=new Hilos();
        $hilo->set($hiloArray);
        ?>
        <script>
            window.location.href = "/index.php?p=foro";
        </script>
        <?php
    }

?>




        
