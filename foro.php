<div class="foroContainer">
    <section class="abrirHilo">
        <p>¡Crea tu propio hilo y comunícate con la comunidad de profesionales de Portal Docente!</p>
        <button type = 'submit' onclick = "location='index.php?p=hiloForm'">Crear hilo</button>

    </section>  
    
    <section id="hilos">
        
    </section>

    <?php
        $hilo = new Hilos();
        $totalHilos = $hilo->getTotalHilos();

        $numeroTotal= floor($totalHilos/5);
        if($totalHilos%5 != 0) {
            $numeroTotal++;
        }
    ?>

    <section id="paginacion" data-total-paginas='<?=$numeroTotal?>'>
        
        <span class="atras" data-info='1'><i class="fas fa-angle-double-left"></i></span>
        <?php
            for($i=1;$i<=$numeroTotal;$i++) {
                echo "<span data-info='$i' class='numero'>$i</span>";
            }
        ?>
        <span class="adelante" data-info='2'><i class="fas fa-angle-double-right"></i></span>
    </section>








</div>