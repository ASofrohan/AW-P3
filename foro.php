<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/Resenia.php';

$reseña=new Reseña();

$tituloPagina = 'Foro';
$array=$reseña->mostrarReseñas();
//$com=$array[0]->getComentario();

$contenidoPrincipal =
<<<EOF
	<div  style="overflow: auto; width: 800px; height: 400px">
		$array
	</div>
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';