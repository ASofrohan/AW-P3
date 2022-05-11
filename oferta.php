<?php 
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'ProcesarOfertaCarrito';
$contenidoPrincipal=<<<EOF
<html>
<div id="oferta">
</br>
<div class="container">
<div class="card" style="width: 18rem;">
  <div class="card-header">
  <form action="procesarOferta.php" method="post"><!--he puesto un 2 en oferta para que me funcione en carrito-->
      <fieldset name="oferta">
      </br>
      <div class="center">
      <h1>Introduce tu código de descuento</h1>
      
      </br>
              <br> 
              <input type="text" name="oferta" required>
              <br><br>
              <button class="btn btn-outline-success" type="submit" name="Enviar">Aplicar</button>
              </div>
      </fieldset>
      </form>
</div></div></div>
<br>	
</html>
EOF;
include __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>
