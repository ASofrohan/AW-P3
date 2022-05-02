<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioBebidas.php';

$form = new FormularioBebidas();
$bebidas = $form->bebidas();
$tituloPagina = 'Bebidas';

$contenidoPrincipal =<<<EOF
		<h1>$tituloPagina</h1>
		<div class="bebidas">
			$bebidas
		</div>
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';
