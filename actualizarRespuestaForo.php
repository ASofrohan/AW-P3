<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioActualizarRespuesta.php';
require_once __DIR__.'/includes/src/Resenia.php';

if(!isset($_SESSION["editarRespuesta"])){
	$id=$_GET["id"];
	$_SESSION["editarRespuesta"]=$id;
}
$form = new FormularioActualizarRespuesta();
$reseña=new Reseña();
if(!isset($_SESSION["login"])){
	$htmlFormMensaje="";
}
else{
	$htmlFormMensaje = $form->gestiona();
}

$tituloPagina = 'Editar respuesta foro';
$array=$reseña->mostrarReseñas();
//$com=$array[0]->getComentario();

$contenidoPrincipal =
<<<EOF
   <div class="container-fluid">
		<div class="row" >
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
