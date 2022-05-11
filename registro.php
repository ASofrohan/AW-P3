<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioRegistro.php';

$form = new FormularioRegistro();
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Registro';
$contenidoPrincipal = <<<EOF
	<div class="registro">
		</br>
		<div class="center">
		<h1>Registro de usuario</h1>
		</div>
		</br>
		<div class="container">
		<div class="card" style="width: 18rem;">
  		<div class="card-header">
		$htmlFormRegistro
		</div></div></div></div>
		</br>
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';