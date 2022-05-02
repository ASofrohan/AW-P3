<header>
		<!--<a href="index.php"><img id="logo" src="images/logo.jpeg" ALIGN=left WIDTH=80 HEIGHT=80></a>
		<h1>PizzaGuay</h1>-->
		<?php
		/*if (!isset($_SESSION["esAdmin"])) {
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
		}*/
		if (!isset($_SESSION["esAdmin"])) {
			echo'
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
				<a class="navbar-brand" href="index.php"><img src="images/logo.jpeg" alt="Logo" style="width: 100px;"></a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="pizzas.php">Pizzas</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="ofertas.php">Ofertas</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="bebidas.php">Bebidas</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="foro.php">Reseñas</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			';
		}else{
			echo'
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
					<a class="navbar-brand" href="index.php"><img src="images/logo.jpeg" alt="Logo" style="width: 100px;"></a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="pizzas.php">Pizzas</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="ofertas.php">Ofertas</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="bebidas.php">Bebidas</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="foro.php">Reseñas</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="administrar.php">Administar</a>
							</li>
						</ul>
					</div>
				</div>
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