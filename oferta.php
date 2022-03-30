<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta charset="utf-8">
	<title>Mensaje</title>
</head>

<body>
<?php
	include ("./includes/comun/cabecera.php");
?>
<div id="contenedor">	

        <main>
		
	<div id="oferta">
		
		<form action="procesarOferta.php" method="post">
        <fieldset name="oferta">
                Oferta:
                <br> 
                <input type="text" name="oferta" required>
                <br>
				<input type="submit">
        </fieldset>
    </form>
	</div>	
		</main>
		
	<?php
		include ("./includes/comun/pie.php");
	?>
</div> <!-- Fin del contenedor -->

</body>
</html>