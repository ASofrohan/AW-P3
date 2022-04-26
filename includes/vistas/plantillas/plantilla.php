<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
	rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
	crossorigin="anonymous">
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