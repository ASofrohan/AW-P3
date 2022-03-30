
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Portada</title>
</head>

<body>
<?php
	session_start();
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
<?php
		include ("./includes/comun/cabecera.php");
	?>
<div id="carrito">

	
	<main>
	<?php
	if(isset($_SESSION["login"])){
		$co=$_SESSION["correo"];
		echo 'Pedidos por pagar por = '.$_SESSION["nombre"].' con mail '.$co.'</br>';
		//SENTENCIA PRECIO PIIZAS NOEMALES
			$query="SELECT a.Nombre,a.Precio,s.Oferta  FROM Pizzas a
				JOIN Pedidos_Pizzas p ON p.ID_PizzaPedida=a.ID_Pizza
				JOIN Pedidos s ON p.ID_Pedido=s.ID_Pedido
				WHERE s.Estado=1 AND s.Usuario='$co'
				UNION
				SELECT b.Nombre,b.Precio,i.Oferta FROM Bebidas b
				JOIN Pedidos_Bebidas q ON q.ID_BebidaPedida=b.ID_Bebida
				JOIN Pedidos i ON i.ID_Pedido=q.ID_Pedido
				WHERE i.Estado=1 AND i.Usuario='$co'
			";
			
			$resultado=$conn->query($query);
			$row_cnt = mysqli_num_rows($resultado);
			if ($row_cnt==0){
				echo 'No hay ningun pedido';
			}else{
				while($row = $resultado->fetch_assoc()) {
					echo $row['Nombre'].' '.$row['Precio'].' '.'</br>';
					$oferta=$row['Oferta'];
				}
			
			}
			echo'</br>';
			//////////////////// SENTENCIAS SUMAR PRECIO TOTAL
			$query1="SELECT SUM(a.Precio) as Precio1 FROM Pizzas a
					JOIN Pedidos_Pizzas p ON p.ID_PizzaPedida=a.ID_Pizza
					JOIN Pedidos s ON p.ID_Pedido=s.ID_Pedido
					WHERE s.Estado=1 AND s.Usuario='$co'";
					
					$resultado1=$conn->query($query1);
					if(	$row1 = $resultado1->fetch_assoc())
						$sum1=$row1['Precio1'];

			$query2="SELECT SUM(b.Precio) AS Precio2 FROM Bebidas b
					JOIN Pedidos_Bebidas q ON q.ID_BebidaPedida=b.ID_Bebida
					JOIN Pedidos i ON i.ID_Pedido=q.ID_Pedido
					WHERE i.Estado=1 AND i.Usuario='$co'";
					$resultado2=$conn->query($query2);
					if(	$row2 = $resultado2->fetch_assoc())
						$sum2=$row2['Precio2'];

			$sumTot=$sum1+$sum2;
		
			////////////////////
		//SENTENCIA PIZZA PERSONALIZADA
		$query="SELECT i.Nombre ,i.Precio FROM Ingredientes i
				JOIN Pizza_Ingredientes p ON i.ID_Ingrediente=p.ID_Ingrediente
				JOIN Pedidos_Pizzas a ON a.ID_PizzaPedida= p.ID_PizzaPedida
				JOIN Pedidos o ON a.ID_Pedido=o.ID_Pedido
				WHERE o.Estado=1 AND a.ID_Pizza=3 AND o.Usuario='$co'
				";
		$resultado2=$conn->query($query);
		$row_cnt = mysqli_num_rows($resultado2);
		if ($row_cnt==0){
			echo 'No hay pizzas personalizadas';
		}else{
			echo 'Pizzas personalizadas </br>';
			while($row = $resultado2->fetch_assoc()) {
					echo $row['Nombre'].' '.$row['Precio'].' '.'</br>';
					
				$sumTot+=$row['Precio'];
			}
			$sumTot+=4.99;
		}
		echo'</br>';
		if($oferta==4){
			echo 'Precio Total a pagar '.$sumTot;
			echo'</br>';
			echo '<a>Tienes ofertas ¡Usalas!</a>';
			echo'<a href=" oferta.php">Canjear</a>';
		}else{
			$query1="SELECT Descuento
					FROM ofertas
					WHERE ID_Oferta='$oferta'";
			
			$resultado1=$conn->query($query1);
			if(	$row1 = $resultado1->fetch_assoc()){
				echo '<strike>Precio Total a pagar '.$sumTot.'</strike>';
				echo'</br>';
				echo'Precio nuevo a pagar '.$sumTot-$row1['Descuento'];
			}
		}
		
	}else{
		echo'no esta registrado';
}
	?>
	</main>
	
</div>
</body>
</html>

