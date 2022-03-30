<header>
		<h1>PizzaGuay</h1>
		<?php
		if (!isset($_SESSION["esAdmin"])) {
			
				echo '<a href="index.php">INICIO</a>
				<a href="pizzas.php">PIZZAS</a>                    
				<a href="ofertas.php">OFERTAS</a>
				<a href="bebidas.php">BEBIDAS</a>
				<a href="reseñas.php">RESEÑAS</a>';
		} else{
			echo '<a href="index.php">INICIO</a>
			<a href="pizzas.php">PIZZAS</a>                    
			<a href="ofertas.php">OFERTAS</a>
			<a href="bebidas.php">BEBIDAS</a>
			<a href="reseñas.php">RESEÑAS</a>
			<a href="administrar.php">ADMINISTRAR</a>';
		}
		?>
		<?php
		mostrarSaludo();
		?>
</header>

<?php

function mostrarSaludo(){
	if(!isset($_SESSION["login"])){
		echo '<div class="saludo">Usuario desconocido<a href="login.php">Login</a>
		<a href="carrito.php">CARRITO</a></div>';
	}
	else{
		if(!$_SESSION["login"]){
			echo '<div class="saludo">Usuario desconocido<a href="login.php">Login</a>
			<a href="carrito.php">CARRITO</a></div>';
		}
		else{
			echo '<div class="saludo">Hola ' . $_SESSION["nombre"] .' <a href="logout.php">(salir)</a>
			<a href="carrito.php">CARRITO</a></div>';
		}
	}
}
?>