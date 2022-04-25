<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/Carrito.php';
require_once __DIR__.'/includes/src/PizzaPedida.php';
require_once __DIR__.'/includes/src/BebidaPedida.php';
require_once __DIR__.'/includes/src/Aplicacion.php';
require_once __DIR__.'/includes/src/Form.php';
$carrito= new Carrito();
$nombre=$carrito->inicio();
$string=mostrar($nombre,$carrito);

$tituloPagina = 'Carrito';
$contenidoPrincipal=<<<EOF
	$string
EOF;
include __DIR__.'/includes/vistas/plantillas/plantilla.php';

function mostrar($nombre,$carrito){
	$pizzaPedida = PizzaPedida::muestraPizzas();
	$bebidaPedida = BebidaPedida::muestraBebidas();
	$carritoToString="";
	if($nombre!=null){
		$arrayPyB= $carrito->consultaPedidosBebPiz();
		$precio=$carrito->consultaPrecio();
		$precioP=$carrito->precioPerso();
		$arrayPP=$carrito->consultaPersonalizada();
		$descuento=$carrito->consultaDescuento();
		$oferta=null;
		$i=0;
		
		if($arrayPyB!=null){
			$arrlength = count($arrayPyB);
			$carritoToString=$carritoToString.'Pedidos por pagar por = '.$nombre.' </a>'.'<br></br>';
			$x = 0;
			foreach($pizzaPedida as $pizza) {
				$pedido=$pizza->get_pedido();
				$idPizza=$pizza->get_id();
				
				$carritoToString=$carritoToString.'<form id="form" name="form" method="post" autocomplete="off">';
				$carritoToString=$carritoToString. $arrayPyB[$x].'  ';
				$x++;
				$carritoToString=$carritoToString. $arrayPyB[$x].'  ';
				if($x%2==1){
					$carritoToString = $carritoToString . '<input name="'.$i.'" type="submit" id="'.$i.'"value="basura"/>';
					$carritoToString=$carritoToString.$idPizza;
					$carritoToString=$carritoToString.'<br>';
				}
				$carritoToString=$carritoToString.'</form>';
				if(isset($_POST[$i])){
					$app = Aplicacion::getInstancia();
					$db = $app->conexionBd();
					$query="DELETE FROM pedidos_pizzas WHERE ID_Pedido='$pedido' AND ID_PizzaPedida='$idPizza'";
					$resultado=$db->query($query);
					header("Location:carrito.php");
				}
				$i++;
				$x++;
			
			}
			foreach($bebidaPedida as $bebida) {
				$pedido=$bebida->get_pedido();
				$idBebida=$bebida->get_id();
				$carritoToString=$carritoToString.'<form id="form" name="form" method="post" autocomplete="off">';
				$carritoToString=$carritoToString. $arrayPyB[$x].'  ';
				$x++;
				$carritoToString=$carritoToString. $arrayPyB[$x].'  ';
				if($x%2==1){
					$carritoToString = $carritoToString . '<input name="'.$i.'" type="submit" id="'.$i.'"value="basura"/>';
					$carritoToString=$carritoToString.$idBebida;
					$carritoToString=$carritoToString.'<br>';
				}
				$carritoToString=$carritoToString.'</form>';
				if(isset($_POST[$i])){
					$app = Aplicacion::getInstancia();
					$db = $app->conexionBd();
					$query="DELETE FROM pedidos_bebidas WHERE ID_Pedido='$pedido' AND ID_BebidaPedida='$idBebida'";
					$resultado=$db->query($query);
					header("Location:carrito.php");
				}
				$i++;
				$x++;
				
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
					$carritoToString = $carritoToString .'  ';
					if($x%2==1){
						$carritoToString = $carritoToString . '<input name="'.$x.'" type="submit" id="'.$x.'"value="basura"/>';
						$carritoToString=$carritoToString.'<br>';
					}
					if(isset($_POST[$x])){
						//modificar esto, los valores de las masasa, tamaños
						
					}
				
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
