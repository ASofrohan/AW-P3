<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioOfertas.php';

$form = new FormularioOfertas();
$ofertas = $form->ofertas();
$tituloPagina = 'Ofertas';

$contenidoPrincipal =<<<EOF
		</br>
		<div class="center">
		<h1>$tituloPagina</h1>
		</br>
		</div>
		<div class="ofertas">
			$ofertas
		</div>
EOF;
		
include __DIR__.'/includes/vistas/plantillas/plantilla.php';
		
