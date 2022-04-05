<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/Ofertas.php';
require_once __DIR__.'/includes/src/Aplicacion.php';

$ofertas= new Ofertas();
	
	$tituloPagina = 'Ofertas';
		$contenidoPrincipal =$ofertas->inicio();
		
include __DIR__.'/includes/vistas/plantillas/plantilla.php';
		
