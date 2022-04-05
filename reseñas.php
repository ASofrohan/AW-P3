<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioMensaje.php';

$form = new FormularioMensaje();
if(!isset($_SESSION["login"])){
	$htmlFormMensaje="";
}
else{
	$htmlFormMensaje = $form->gestiona();
}

$tituloPagina = 'Reseñas';
$array=$form->mostrarForo();
//$com=$array[0]->getComentario();

$contenidoPrincipal =

<<<EOF
	<div  style="overflow: auto; width: 400px; height: 300px">
		$array
	</div>
		$htmlFormMensaje
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';