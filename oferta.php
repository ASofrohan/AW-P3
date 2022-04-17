<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'ProcesarOfertaCarrito';
$contenidoPrincipal=<<<EOF
<html>
<div id="oferta">
  
  <form action="procesarOferta.php" method="post"><!--he puesto un 2 en oferta para que me funcione en carrito-->
      <fieldset name="oferta">
              Oferta:
              <br> 
              <input type="text" name="oferta" required>
              <br>
      <input type="submit">
      </fieldset>
      </form>
</div>	
</html>
EOF;
include __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>
