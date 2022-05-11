<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioPersonalizada.php';

$form = new FormularioPersonalizada();
$formulario = $form->formulario();
$tituloPagina = 'Pizza Personalizada';

$contenidoPrincipal =<<<EOF
</br>
<div class="center">
<h1>$tituloPagina</h1>
</br>
</div>
		<div class="pizzapersonalizada">
		$formulario
		</div>
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';