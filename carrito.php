
<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/Carrito.php';
//require_once __DIR__.'/includes/src/Aplicacion.php';

$carrito= new Carrito();
$nombre=$carrito->inicio();
$string=mostrar($nombre,$carrito);

$tituloPagina = 'Carrito';
$contenidoPrincipal=<<<EOF
	$string
EOF;
include __DIR__.'/includes/vistas/plantillas/plantilla.php';

function mostrar($nombre,$carrito){
	$carritoToString="";
	if($nombre!=null){
		$arrayPyB= $carrito->consultaPedidosBebPiz();
		$precio=$carrito->consultaPrecio();
		$precioP=$carrito->precioPerso();
		$arrayPP=$carrito->consultaPersonalizada();
		$descuento=$carrito->consultaDescuento();
		$oferta=null;
		
		
		if($arrayPyB!=null){
			$arrlength = count($arrayPyB);
			$carritoToString=$carritoToString.'Pedidos por pagar por = '.$nombre.' </a>'.'<br></br>';
			for($x = 0; $x < $arrlength-1; $x++) {
				$carritoToString=$carritoToString. $arrayPyB[$x].'  ';
				if($x%2==1)
				$carritoToString=$carritoToString.'<br>';
			}
		
			$oferta=$arrayPyB[$arrlength-1];
			$carritoToString=$carritoToString.'<br></br>';
		}else{
			$carritoToString=$carritoToString.'No hay pedidos';
			$carritoToString=$carritoToString.'<br>';
		}
		if($arrayPP!=null){
			$arrlength = count($arrayPP);
			if($arrlength==0){
				$carritoToString=$carritoToString.'No hay pizzas personalizadas';
				$sumTot=$precio;
			}
			else{
				$carritoToString=$carritoToString.'Pizzas personalizadas <br>';
				for($x = 0; $x < $arrlength; $x++) {
					$carritoToString=$carritoToString.$arrayPP[$x].'  ';
					if($x%2==1)
					$carritoToString=$carritoToString.'<br>';
				}
				$carritoToString=$carritoToString."<br>";
				$sumTot=$precio+$precioP;
			}
		}else{
			$sumTot=$precio;
			$carritoToString=$carritoToString.'No hay pizzas personalizadas'.'<br>';
		}
		if($oferta!=null){
			if($oferta==4){
				$carritoToString=$carritoToString.'Precio Total a pagar '.$sumTot.' €';
				$carritoToString=$carritoToString.'<br></br>';
				$carritoToString=$carritoToString.'<a>Tienes ofertas ¡Usalas!</a>';
				$carritoToString=$carritoToString.'<a href=" oferta.php">Canjear  </a><br>';			
			}else{
				if($descuento!=0){
					$carritoToString=$carritoToString. '<strike>Precio Total a pagar '.$sumTot.'€</strike>';
					$carritoToString=$carritoToString.'<br>';
					if($sumTot-$descuento>0)
					$carritoToString=$carritoToString.'Precio nuevo a pagar '.$sumTot-$descuento.'€';
					else
					$carritoToString=$carritoToString.'Precio nuevo a pagar 0 €';
				}
			}
			$carritoToString=$carritoToString.'<br>';
			
			$carritoToString=$carritoToString.'<a href=procesarCompra.php><button>Comprar</button></a>';
		}
		
	}
	else{
		$carritoToString=$carritoToString.'No estas registrado';
	}
	return $carritoToString;
}	
