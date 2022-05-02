<header>
		<?php 
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
								<a class="nav-link active" aria-current="page" href="index.php">INICIO</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="pizzas.php">PIZZAS</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="ofertas.php">OFERTAS</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="bebidas.php">BEBIDAS</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="foro.php">RESEÑAS</a>
							</li>';
							if (isset($_SESSION["esAdmin"])) {
								echo'<li class="nav-item"> <a class="nav-link" href="administrar.php">ADMINISTRAR</a> </li>';
							}
		echo'
					</ul>
				</div>
			</div>
		</nav>
		';
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