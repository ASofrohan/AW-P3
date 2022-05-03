<?php
//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Portada';
$contenidoPrincipal = <<<EOS
<div class="inicio">
    <h1>Página principal</h1>
    <p> Bienvenido a nuestra página web.<br>
    Aqui podrás disfrutar de una gran selección de deliciosas pizzas. </p>

    <a href="pizzas.php"><img src="images/vegetales.jpg" class="img-fluid rounded" alt="Banner Inicio"></a>
    
</div>

EOS;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';
