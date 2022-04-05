<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioPersonalizada.php';

$form = new FormularioPersonalizada();
$seleccion = $form->formulario();
$tituloPagina = 'Pizza Personalizada';

$contenidoPrincipal =<<<EOF
		<h1>$tituloPagina</h1>
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';