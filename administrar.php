<?php
//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Administracion';
$string="";
$contenidoPrincipal =

$string=$string.'Hola administrador!!'.'<Br>';
$string=$string. 'A continuacion te mostramos lo que puedes hacer:'.'<Br>';
$string=$string. '<Br>';
$string=$string. '(Poned descripcion de lo que puede hacer el admin en cada funcionalidad que un usuario normal no pueda)'.'<Br>';
$string=$string.  '-Editar o borrar cualquier mensaje en el foro a parte de lo que podria hacer un usuario normal.'.'<Br>';
$string=$string.  '-Borrar ,añadir pedidos y modificar el estado del pedido.';
$string=$string.  mostrarGestion();


include __DIR__.'/includes/vistas/plantillas/plantilla.php';