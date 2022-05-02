<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/Resenia.php';

$reseña=new Reseña();
$array=$reseña->mostrarReseñas();
$tituloPagina = 'Foro';

//$com=$array[0]->getComentario();

$contenidoPrincipal =
<<<EOF
	<div class="foro">
		$array
	</div>
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';