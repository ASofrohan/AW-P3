<header>
		<?php 
		echo'
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
				<a class="navbar-brand" href="index.php"><img src="images/logo.jpeg" alt="Logo" style="width: 100px;"></a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-between" id="navbarNav">
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
						<ul class="navbar-nav">';
		mostrarSaludo();
		echo'
						</ul>
					</div>
				</div>
			</nav>
		';
		?>
</header>

<?php

function mostrarSaludo(){
	if(!isset($_SESSION["login"])){
		echo '
			<li class="nav-item">
				<a class="nav-link" href="#">Usuario desconocido</a>
			</li>
			<li class="nav-item">
				<button class="btn btn-outline-secondary" onclick="location.href=\'carrito.php\'" type="button">Carrito</button>
			</li>&nbsp;
			<li class="nav-item">
				<button class="btn btn-outline-success" onclick="location.href=\'login.php\'" type="button">LOGIN</button>
			</li>';
	}
	else{
		echo '
			<li class="nav-item">
				<a class="nav-link" href="#">Hola ' . $_SESSION["nombre"] . '</a>
			</li>&nbsp;
			<li class="nav-item">
				<button class="btn btn-outline-secondary" onclick="location.href=\'carrito.php\'" type="button">Carrito</button>
			</li>&nbsp;
			<li class="nav-item">
				<button class="btn btn-outline-info" onclick="location.href=\'actualizar.php\'" type="button">Editar perfil</button>
			</li>&nbsp;
			<li class="nav-item">
				<button class="btn btn-outline-danger" onclick="location.href=\'logout.php\'" type="button">Cerrar sesión</button>
			</li>';
	}
}
?>