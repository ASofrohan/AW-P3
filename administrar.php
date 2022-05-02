<?php
//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Administracion';

$contenidoPrincipal =
<<<EOF
	Hola administrador!!.<Br>
    A continuacion te mostramos lo que puedes hacer:<Br>
    <Br>
    (Poned descripcion de lo que puede hacer el admin en cada funcionalidad que un usuario normal no pueda)<Br>
    -Editar o borrar cualquier mensaje en el foro a parte de lo que podria hacer un usuario normal.<Br>
    -Borrar ,añadir pedidos y modificar el estado del pedido.
EOF;

include __DIR__.'/includes/vistas/plantillas/plantilla.php';