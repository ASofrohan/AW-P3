<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioActualizarPerfil.php';

$form = new FormularioActualizarPerfil();
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Actualizar perfil';
$contenidoPrincipal = <<<EOF
		</br>
		<div class="center">
		<h1>Editar perfil</h1>
		</div>
		</br>
		<div class="container">
		<div class="card" style="width: 18rem;">
  		<div class="card-header">
		$htmlFormRegistro
		</div>
		</div>
		</div>
		</br>
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';