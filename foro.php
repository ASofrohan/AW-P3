<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/Resenia.php';

$reseña=new Reseña();
$array=$reseña->mostrarReseñas();
$tituloPagina = 'Reseñas';

//$com=$array[0]->getComentario();

$contenidoPrincipal =
<<<EOF
</br>
<div class="center">
<h1>$tituloPagina</h1>
</div>
</br>
<div class="container-fluid">
			<div class="row" >
				<div class="container"><div class="card" style="width: 50rem;"><div class="card-header">
					$array
				</div></div></div>
			</div>
</div>
</br>
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';