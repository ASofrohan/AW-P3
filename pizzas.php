<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/FormularioPersonalizada.php';

if(!class_exists('FormularioPersonalizada')){
	echo'<h1>No existe la clase</h1>';
	$tituloPagina = 'Pizza Personalizada';
	
	$contenidoPrincipal =<<<EOF
			<h1>$tituloPagina</h1>
	EOF;
}
else{
	$form = new FormularioPersonalizada();
	$seleccion = $form->formulario();
	$tituloPagina = 'Pizza Personalizada';
	
	$contenidoPrincipal =<<<EOF
			<h1>$tituloPagina</h1>
	EOF;
}

include __DIR__.'/includes/vistas/plantillas/plantilla.php';