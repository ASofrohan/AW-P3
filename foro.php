<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioForo.php';
require_once __DIR__.'/includes/src/Reseña.php';

$form = new FormularioForo();
$reseña=new Reseña();
if(!isset($_SESSION["login"])){
	$htmlFormMensaje="";
}
else{
	$htmlFormMensaje = $form->gestiona();
}

$tituloPagina = 'Foro';
$array=$reseña->mostrarReseñas();
//$com=$array[0]->getComentario();

$contenidoPrincipal =
<<<EOF
	<div  style="overflow: auto; width: 600px; height: 400px">
		$array
	</div>
		$htmlFormMensaje
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';