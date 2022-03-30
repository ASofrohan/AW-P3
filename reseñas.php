<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioMensaje.php';

$form = new FormularioMensaje();
$htmlFormMensaje = $form->gestiona();

$tituloPagina = 'Reseñas';
$array=$form->mostrarForo();
$contenidoPrincipal =<<<EOF
		$htmlFormMensaje
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';