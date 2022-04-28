<header>
		<a href="index.php"><img id="logo" src="images/logo.jpeg" ALIGN=left WIDTH=80 HEIGHT=80></a>
		<h1>PizzaGuay</h1>
		<?php
		if (!isset($_SESSION["esAdmin"])) {
			echo'
			<input type="checkbox" class="checkbox" id="menu-toogle"/>
			<label for="menu-toogle" class="menu-toogle"></label>
			<nav class="nav">
			  <a href="index.php" class="nav__item current">Inicio</a>
			  <a href="pizzas.php" class="nav__item">Pizzas</a>
			  <a href="ofertas.php" class="nav__item">Ofertas</a>
			  <a href="bebidas.php" class="nav__item">Bebidas</a>
			  <a href="foro.php" class="nav__item">Reseñas</a>
			</nav>
			';
		} else{
			echo'
			<input type="checkbox" class="checkbox" id="menu-toogle"/>
			<label for="menu-toogle" class="menu-toogle"></label>
			<nav class="nav">
			  <a href="index.php" class="nav__item current">Inicio</a>
			  <a href="pizzas.php" class="nav__item">Pizzas</a>
			  <a href="ofertas.php" class="nav__item">Ofertas</a>
			  <a href="bebidas.php" class="nav__item">Bebidas</a>
			  <a href="foro.php" class="nav__item">Reseñas</a>
			  <a href="administrar.php">Administar</a>
			</nav>
			';
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
		echo '<div class="saludo">Hola ' . $_SESSION["nombre"] .' <a href="logout.php">(salir)</a><a href="actualizar.php">Editar perfil</a>
		<a href="carrito.php">CARRITO</a></div>';
	}
}
?>