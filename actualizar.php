<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioActualizarPerfil.php';

$form = new FormularioActualizarPerfil();
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Actualizar perfil';
$contenidoPrincipal = <<<EOF
		<h1>Editar perfil</h1>
		$htmlFormRegistro
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';