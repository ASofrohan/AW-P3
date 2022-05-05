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
 <div class="container-fluid">
		<div class="row" >
				<div class="col-5" id="prueba">
					$array
				</div>
			</div>
		</div>
	</div>
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';