<?php
if ( isset( $_GET['idTemario'] ) ) {
    $idTemarioABorrar = $_GET['idTemario'];
    $temarioABorrar = new Temarios();
    $temarioABorrar->delete( $idTemarioABorrar );
}

?>

<div class = 'temariosContainer'>
<section class = 'añadirTemarioContainer'>
    <div>
    <p>¡Aporta tu contenido a esta comunidad!</p>
    <button type = 'submit' onclick = "location='index.php?p=añadirTemario'">Añadir contenido</button>
    </div>
</section>
<section class = 'buscarContainer'>
    <img src = 'images/imagenBuscar.jpg'>
    <form class = 'buscarFormulario' action = 'index.php?p=temarios' method = 'post' name = 'buscarFormulario'>
    <input type = 'inputBuscar' name = 'inputBuscar' placeholder = 'BUSCAR' required>
    <button type = 'submit' id = 'buscar' name = 'buscar' value = 'buscar'><i class = 'fas fa-search'></i></button>
    </form>
</section>
<section class = 'filtro'>
    <form class = 'filtrarFormulario' action = 'index.php?p=temarios' method = 'post' name = 'filtrarFormulario'>
        <label for = 'filtro'>FILTRAR POR:</label><select name = 'filtro'>
            <option value = 'educacionInfantil'>Educación infantil</option>
            <option value = 'educaciónPrimaria'>Educación primaria</option>
            <option value = 'eso'>Educación secundaria obligatoria ( E.S.O )</option>
            <option value = 'educaciónSuperior'>Educación superior</option>
        </select>
        <button type = 'submit' id = 'filtrar' name = 'filtrar' value = 'filtrar'>FILTRAR</button>
    </form>
</section>
<section class = 'mostrarTemariosContainer'>
    <h1>Temarios</h1>
    <?php
    $comienzo = 0;
    $numAMostrar = 3;
    if ( isset( $_GET['comienzo'] ) ) {
        $comienzo = $_GET['comienzo'];
    }
    $imagen = '';
    $color = '';
    $nivelTemarios = 'educacionInfantil';
    if ( isset( $_POST['buscar'] ) ) {
        $palabraABuscar = $_POST['inputBuscar'];
        $temarios = new Temarios();
        $temarios->getVerTemariosEncontrados( $palabraABuscar, $numAMostrar, $comienzo );
        $total = count( $temarios->get_rows() );

    } else if ( isset( $_POST['filtrar'] ) ) {
        $nivelTemarios = $_POST['filtro'];
        $temarios = new Temarios();
        $temarios->getVerTemariosConFiltro( $nivelTemarios, $numAMostrar, $comienzo );

        $total = count( $temarios->get_rows() );

    } else {
        $temarios = new Temarios();
        $total = $temarios->getTotalTemarios();
        $temarios = new Temarios();
        $temarios->getVerTemariosConLimite( $numAMostrar, $comienzo );

    }
    $cuantos = count( $temarios->get_rows() );
    if ( $cuantos>0 ) {
        for ( $cont = 0; $cont<$cuantos; $cont++ ) {
            $idTemario = $temarios->get_rows()[$cont]['id'];
            $tituloTemario = $temarios->get_rows()[$cont]['titulo'];
            $autor = $temarios->get_rows()[$cont]['autor_id'];
            $resumen = $temarios->get_rows()[$cont]['resumen'];
            $nivelEducacion = $temarios->get_rows()[$cont]['nivel_educacion'];
            $fecha = $temarios->get_rows()[$cont]['fecha'];
            $asignatura = $temarios->get_rows()[$cont]['asignatura'];

            ?>
            <div class = 'temario'>
            <?php
            if ( $nivelEducacion == 'educacionInfantil' ) {
                $imagen = 'images/educacionInfantil.png';
                $color = '#FA1212';
            } else if ( $nivelEducacion == 'educaciónPrimaria' ) {
                $imagen = 'images/educacionPrimaria.png';
                $color = '#EF8726';
            } else if ( $nivelEducacion == 'eso' ) {
                $imagen = 'images/educacionSecundariaObligatoria.png';
                $color = '#60D137';
            } else {
                $imagen = 'images/educacionSuperior.png';
                $color = '#4C96E6';
            }
            ?>
            <img class = 'imagen' src = "<?=$imagen?>">
            <div>
            <h3><?= $tituloTemario?></h3>
            <p><?= substr( $resumen, 0, 100 ).'...'?></p>

            </div>
            <div>
            <?php
            //Nombre de usuario que ha subido el temario
            $usuario = new Usuario();
            $usuario->get( $autor );
            $res = $usuario->get_rows();
            $nombreUsuario = $res[0]['nombre'];
            ?>
            <p><i class = 'fas fa-user'></i><?= $nombreUsuario?></p>
            <p><?= $fecha?></p>
            </div>
            <div>
            <p><b>Asignatura: </b> <?= $asignatura?></p>
            </div>

            <button style = "background-color:<?=$color?>" type = 'submit' onclick = "location='index.php?p=mostrarTemario&id=<?=$idTemario?>'">Más detalles...</button>

            </div>
            <?php
        }
        ?>
        <div class = 'enlacesTemarios'>
        <?php
        if ( $total>$numAMostrar ) {
            if ( $comienzo+$numAMostrar< $total ) {
                $comienzo = $comienzo+$numAMostrar;
                $verMas = "<a href='index.php?p=temarios&comienzo=$comienzo'>VER MÁS <i class='fas fa-angle-double-right'></i> </a> ";
                if ( $comienzo == $numAMostrar ) {

                    echo $verMas;
                }

            } else {
                $verMas = '';
            }

        }
        if ( isset( $_GET['comienzo'] ) ) {
            //que salga solo cuando se muestren más temarios
            echo '<div class="verAnteriores">';
            echo "<a href='index.php?p=temarios'>VOLVER AL PRINCIPIO </a> $verMas ";
            echo '</div>';
        }

    }

    ?>
</section>
</div>