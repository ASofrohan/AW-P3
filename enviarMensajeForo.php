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
    <div  style="overflow: auto; width: 800px; height: 400px">
		$array
	</div>
		$htmlFormMensaje
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';
