<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioResponderMensaje.php';
require_once __DIR__.'/includes/src/Resenia.php';

if(!isset($_SESSION["respuesta"])){
	$id=$_GET["id"];
	$_SESSION["respuesta"]=$id;
}

$form = new FormularioResponderMensaje();
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
	</br>
	<div class="center">
	<h1>$tituloPagina</h1>
	</div>
	</br>
    <div class="container-fluid">
		<div class="row" >
		<div class="col-md-9">
		<div class="container"><div class="card" style="width: 50rem;"><div class="card-header">
			$array
		</div></div></div></div>
		<div class="col-md-3">
			$htmlFormMensaje
		</div></div>
		</div>
	</div>
	</br>
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';