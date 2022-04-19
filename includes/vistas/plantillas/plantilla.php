<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?= $tituloPagina ?></title>
<script type="text/javascript" src="js/pizzas.js"></script>
</head>

<body>

<div id="contenedor">

<?php
	require("includes/vistas/comun/cabecera.php");
?>
	<main>
			<?= $contenidoPrincipal ?>
	</main>
<?php

	require("includes/vistas/comun/pie.php");

?>
</div>

</body>
</html>