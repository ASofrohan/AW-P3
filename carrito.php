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
	$app = Aplicacion::getInstancia();
	$db = $app->conexionBd();
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
		$boolPersonalizada=false;
		if($arrayPyB!=null){
			$arrlength = count($arrayPyB);
			$carritoToString=$carritoToString.'Pedidos por pagar por = '.$nombre.' </a>'.'<br></br>';
			$x = 0;
			if($pizzaPedida!=null){
				
				foreach($pizzaPedida as $pizza) {
					$pedido=$pizza->get_pedido();
					$idPizza=$pizza->get_id();
					$tipo=$pizza->get_idPizza();
					$carritoToString=$carritoToString.'<form id="form" name="form" method="post" autocomplete="off">';
					$carritoToString=$carritoToString. $arrayPyB[$x].'  ';
					if($arrayPyB[$x]=="Personalizada"){
						$boolPersonalizada=true;
						$x++;
						$carritoToString=$carritoToString. $arrayPyB[$x].'  ';
						if($x%2==1){
							$carritoToString = $carritoToString . '<input name="'.$i.'" type="submit" id="'.$i.'"value="basura"/>';
							$carritoToString=$carritoToString.$idPizza;
							$carritoToString=$carritoToString.'<br>';
						}
						
						if($arrayPP!=null){
							$arrlength1 = count($arrayPP);
							for($j = 0; $j < $arrlength1; $j++) {
								$carritoToString=$carritoToString.'<form id="form" name="form" method="post" autocomplete="off">';
								$carritoToString=$carritoToString.' &nbsp '.$arrayPP[$j].'  ';
								$carritoToString = $carritoToString .'  ';
								$j++;
								$carritoToString=$carritoToString.$arrayPP[$j].'  ';
								if($j%2==1){
									$carritoToString = $carritoToString . '<input name="'.$j.'" type="submit" id="'.$j.'"value="BASURA"/>';
									$carritoToString=$carritoToString.'<br>';
								}
								$carritoToString=$carritoToString.'</form>';
								if(isset($_POST[$j])){
									//FALTA METER UNA NUEVA CLASE PARA OBTENER LOS IDS DE LOS INGREDIENTES
									$query="DELETE FROM pizza_ingredientes WHERE ID_PizzaPedida='$idPizzaIngre'";
									$resultado=$db->query($query);
									header("Location:carrito.php");
									
								}
							
							}
							$carritoToString=$carritoToString."<br>";
							$sumTot=$precio+$precioP;
							$carritoToString=$carritoToString.'</form>';
						}else{$carritoToString=$carritoToString.'No has elegido ingredientes';}
						
					}else{
						$x++;
						$carritoToString=$carritoToString. $arrayPyB[$x].'  ';
						if($x%2==1){
							$carritoToString = $carritoToString . '<input name="'.$i.'" type="submit" id="'.$i.'"value="basura"/>';
							$carritoToString=$carritoToString.$idPizza;
							$carritoToString=$carritoToString.'<br>';
						}
						$carritoToString=$carritoToString.'</form>';
					}
					if(isset($_POST[$i])){
						if($tipo!=3){
							
							$query="DELETE FROM pedidos_pizzas WHERE ID_Pedido='$pedido' AND ID_PizzaPedida='$idPizza'";
							$resultado=$db->query($query);
							header("Location:carrito.php");
						}else{
							$query="DELETE FROM pizza_ingredientes WHERE  ID_PizzaPedida='$idPizza'";
							$resultado=$db->query($query);
							$query1="DELETE FROM pedidos_pizzas WHERE ID_Pedido='$pedido' AND ID_PizzaPedida='$idPizza'";
							$resultado1=$db->query($query1);
							header("Location:carrito.php");
						}
					}
					$i++;
					$x++;
				}
			}
			if($bebidaPedida!=null){
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
						$query="DELETE FROM pedidos_bebidas WHERE ID_Pedido='$pedido' AND ID_BebidaPedida='$idBebida'";
						$resultado=$db->query($query);
						header("Location:carrito.php");
					}
					$i++;
					$x++;
					
				}
			}
			$oferta=$arrayPyB[$arrlength-1];
			$carritoToString=$carritoToString.'<br>';
		}else{
			$carritoToString=$carritoToString.'No hay pedidos';
			$carritoToString=$carritoToString.'<br>';
		}
		if($boolPersonalizada==false)
			$carritoToString=$carritoToString.'No hay pizzas personalizadas'.'<br>';
		if($arrayPP==null){
			$sumTot=$precio;
		}
		if($oferta!=null){
			if($oferta==4){
				$carritoToString=$carritoToString.'Precio Total a pagar '.$sumTot.' €';
				$carritoToString=$carritoToString.'<br>';
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
