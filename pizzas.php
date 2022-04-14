<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioPersonalizada.php';

$form = new FormularioPersonalizada();
$pizzas = $form->pizzas();
$tituloPagina = 'Pizzas';

$contenidoPrincipal =<<<EOF
		<h1>$tituloPagina</h1>
		<div  style="overflow: auto; width: 100%; height: 300px">
			$pizzas
		</div>
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';