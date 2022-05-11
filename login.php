<?php

//Inicio del procesamiento

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioLogin.php';

$form = new FormularioLogin();
$htmlFormLogin = $form->gestiona();
$tituloPagina = 'Login';

$contenidoPrincipal = <<<EOF
		<div class="row">
		<div class="col-md-10 mx-auto">
		<h1>Acceso al sistema</h1>
		</div>
		</div>
		<div class="login">
		$htmlFormLogin
		</div>
		
EOF;


include __DIR__.'/includes/vistas/plantillas/plantilla.php';