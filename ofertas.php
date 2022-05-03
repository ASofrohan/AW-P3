<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioOfertas.php';

$form = new FormularioOfertas();
$ofertas = $form->ofertas();
$tituloPagina = 'Ofertas';

$contenidoPrincipal =<<<EOF
		<h1>$tituloPagina</h1>
		<div class="ofertas">
			$ofertas
		</div>
EOF;
		
include __DIR__.'/includes/vistas/plantillas/plantilla.php';
		
