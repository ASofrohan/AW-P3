<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';

//Doble seguridad: unset + destroy
unset($_SESSION["login"]);
unset($_SESSION["esAdmin"]);
unset($_SESSION["nombre"]);


session_destroy();
session_start();
$tituloPagina = 'Logout';
$contenidoPrincipal = <<<EOF
		<div class="logout">
		<h2>¡Hasta pronto!</h2>
		<p>Gracias por visitar página nuestra web. Esperamos que haya disfutado de nuestras pizzas.</p>
		<a href=index.php><img src="images/pizza-saludo.jpg" class="img-fluid rounded" alt="Banner logout" width="700" height="300"></a>
		</div>
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';