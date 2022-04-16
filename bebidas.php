<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="pizzas.js"></script>
<title>Pedidos</title>
</head>

<body>

<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "PizzaGuay";
	// Crear conexion	
	$conn = new mysqli($servername, $username, $password, $db);
	// Comprobar conexion
	if (mysqli_connect_error()) {
		die("Database connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";
?>

<div id="contenedor">

	<?php
		include ("cabecera.php");
	?>

	<main>
    <h1 href="bebidas.php">Elige tu bebida</h1>

	<?php
	$query="SELECT * FROM bebidas";
	$resultado=$conn->query($query);

	echo '<div id="bebidas">';
		$bebida=0;
		while($row = $resultado->fetch_assoc()) {
			echo '<input type="number" name="bebidas" id="bebidas[]"
                min="0" max="120" step="1" value="0">';
			echo $row['Nombre'];
			echo '</br>';
		}
		echo'<p>PRECIO: </p>';
		echo '<p id="precio">0</p>';
	echo '</div>'
	?>

	</main>
	
	<?php
		include ("pie.php");
	?>

</div> <!-- Fin del contenedor -->

</body>
</html>