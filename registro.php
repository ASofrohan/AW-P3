<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioRegistro.php';

$form = new FormularioRegistro();
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Registro';
$contenidoPrincipal = <<<EOF
	<div class="registro">
		<h1>Registro de usuario</h1>
		$htmlFormRegistro
		</div>
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';