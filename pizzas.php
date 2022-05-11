<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioPersonalizada.php';

$form = new FormularioPersonalizada();
$pizzas = $form->pizzas();
$tituloPagina = 'Pizzas';

$contenidoPrincipal =<<<EOF
</br>
<div class="center">
<h1>$tituloPagina</h1>
</br>
</div>
		<div class="pizzas">
			$pizzas
		</div>
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';