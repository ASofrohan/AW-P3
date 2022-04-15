
<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/Carrito.php';
require_once __DIR__.'/includes/src/Aplicacion.php';

$carrito= new Carrito();

$nombre=$carrito->inicio();
$tituloPagina = 'Carrito';
?>

<link rel="stylesheet" type="text/css" href="css/estilo.css" />

<div id="carrito">

		<?php
	if($nombre!=null){
		$arrayPyB= $carrito->consultaPedidosBebPiz();
		$precio=$carrito->consultaPrecio();
		$precioP=$carrito->precioPerso();
		$arrayPP=$carrito->consultaPersonalizada();
		$descuento=$carrito->consultaDescuento();
		$oferta=null;
		////
		if($arrayPyB!=null){
			$arrlength = count($arrayPyB);
			echo'<a>Pedidos por pagar por = '.$nombre.' </a>';
			echo'<br></br>';
			for($x = 0; $x < $arrlength-1; $x++) {
				echo $arrayPyB[$x].'  ';
				echo "<br>";
			}
		
			$oferta=$arrayPyB[$arrlength-1];
		}
		echo'<br></br>';
		if($arrayPP!=null){
			$arrlength = count($arrayPP);
			if($arrlength==0){
				echo 'No hay pizzas personalizadas';
				$sumTot=$precio;
			}
			else{
				echo 'Pizzas personalizadas <br>';
				for($x = 0; $x < $arrlength; $x++) {
					echo $arrayPP[$x].'  ';
					echo "<br>";
				}
				echo "<br>";
				$sumTot=$precio+$precioP;
			}
		}else{
			$sumTot=$precio;
			echo 'No hay pizzas personalizadas'.'<br>';
		}
		if($oferta!=null){
			if($oferta==4){
				echo'Precio Total a pagar '.$sumTot.' €';
				echo'<br></br>';
				echo'<a>Tienes ofertas ¡Usalas!</a>';
				echo'<a href=" oferta.php">Canjear  </a><br>';			
			}else{
				if($descuento!=0){
					echo '<strike>Precio Total a pagar '.$sumTot.'€</strike>';
					echo'<br>';
					echo'Precio nuevo a pagar '.$sumTot-$descuento.'€';
				}
			}
			echo'<br>';
				echo'<a>¿Quieres editar el pedido?</a><a href=procesarEdit.php><button>EDITAR</button></a><br>';
				echo'<a href=procesarCompra.php><button>Comprar</button></a>';
		}
		
	}
	else{
		echo'No estas registrado';
	}
		?>
</div>
