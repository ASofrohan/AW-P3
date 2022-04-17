<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioOfertas.php';

$form = new FormularioOfertas();
$ofertas = $form->ofertas();
$tituloPagina = 'Ofertas';

$contenidoPrincipal =<<<EOF
		<h1>$tituloPagina</h1>
		<div  style="overflow: auto; width: 100%; height: 300px">
			$ofertas
		</div>
EOF;
		
include __DIR__.'/includes/vistas/plantillas/plantilla.php';
		
