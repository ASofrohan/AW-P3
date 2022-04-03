<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/Carrito.php';
require_once __DIR__.'/includes/src/Aplicacion.php';

$carrito= new Carrito();
	
	$tituloPagina = 'Carrito';
		$contenidoPrincipal =$carrito->inicio();
		
include __DIR__.'/includes/vistas/plantillas/plantilla.php';
		
