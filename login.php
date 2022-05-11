<?php

//Inicio del procesamiento

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioLogin.php';

$form = new FormularioLogin();
$htmlFormLogin = $form->gestiona();
$tituloPagina = 'Login';

$contenidoPrincipal = <<<EOF
		</br>
		<div class="center">
		<h1>Acceso al sistema</h1>
		</div>
		</br>
		<div class="login">
		<div class="container">
		<div class="card" style="width: 18rem;">
  		<div class="card-header">
		$htmlFormLogin
		</div>
		</div>
		</div>
		</div>
		</br>
		
EOF;


include __DIR__.'/includes/vistas/plantillas/plantilla.php';