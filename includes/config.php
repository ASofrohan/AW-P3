<?php
require_once __DIR__.'/src/Aplicacion.php';

/**
 * Parámetros de conexión a la BD
 */
define('BD_HOST', 'vm15.db.swarm.test');
define('BD_NAME', 'pizzaguay');
define('BD_USER', 'pizzaguay');
define('BD_PASS', 'pizzaguay');

/**
 * Configuracion del soporte UTF-8, localizacion (idioma y pais)
 */
ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');

date_default_timezone_set('Europe/Madrid');


// Inicializa la aplicacion
$app = Aplicacion::getInstancia();
$app->init(array('host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS));

/**
 * @see http://php.net/manual/en/function.register-shutdown-function.php
 * @see http://php.net/manual/en/language.types.callable.php
 */
register_shutdown_function(array($app, 'shutdown'));