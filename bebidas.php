<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="bebidas.js"></script>
<title>Bebidas</title>
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
		include ("./inlcudes/comun/cabecera.php");
	?>

	<main>
    <h1 href="bebidas.php">Elige tu bebida</h1>

	<?php
	$query="SELECT * FROM Bebidas";
	$resultado=$conn->query($query);

	

	echo '<form action="#" method="post" id=bebidas_cb>';
	
	while($row = $resultado->fetch_assoc()) {
		
		echo '<input type="checkbox" name="bebidas[]" value="' . $row['Precio'] . '" id="' . $row['ID_Bebida'] . '" onClick=recalcularPrecio(this) /> ' . $row['Nombre'] . '</br>';
		//echo '<input type="button" name="bebidas[]" value="' . '"onClick=contador++;myFunction()' . '>Aumentar </button>' . $row['Precio'] .'" onClick=recalcularPrecio(this) /> ' . '<br>';
		
	}
	echo '<input type="button" "onclick="aumentar()">+</ br>';
	echo '<input type="button"onclick="disminuir()">-</ br>';
	echo '</form>';

	echo '<p>PRECIO: </p>';
	echo '<p id="precio"></p>';

	echo '<button onClick="añadir()">Añadir</button>';

	?>
			
	</main>
	
	<?php
		include ("./includes/comun/pie.php");
	?>

</div> <!-- Fin del contenedor -->

</body>
</html>