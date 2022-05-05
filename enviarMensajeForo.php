<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioEnviarMensaje.php';
require_once __DIR__.'/includes/src/Resenia.php';

$form = new FormularioEnviarMensaje();
$reseña=new Reseña();
if(!isset($_SESSION["login"])){
	$htmlFormMensaje="";
}
else{
	$htmlFormMensaje = $form->gestiona();
}

$tituloPagina = 'Enviar mensaje foro';
$array=$reseña->mostrarReseñas();
//$com=$array[0]->getComentario();

$contenidoPrincipal =

<<<EOF
<div class="container-fluid">
<div class="row" id="prueba2">
		<div class="col-5">
			$array
		</div>
		<div class="col align-self-center">

			$htmlFormMensaje
		</div>
	</div>
</div>
</div>


	
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';
