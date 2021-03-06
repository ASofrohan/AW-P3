<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/Carrito.php';
require_once __DIR__.'/includes/src/PizzaPedida.php';
require_once __DIR__.'/includes/src/PizzaIngrediente.php';
require_once __DIR__.'/includes/src/BebidaPedida.php';
require_once __DIR__.'/includes/src/Aplicacion.php';
require_once __DIR__.'/includes/src/Form.php';
$carrito= new Carrito();
$nombre=$carrito->inicio();
$string=mostrar($nombre,$carrito);

$tituloPagina = 'Carrito';
$contenidoPrincipal=<<<EOF
	</br>
	<div class="center">
	<h1>$tituloPagina</h1>
	</div>
	</br>
	<div class="container">
	<div class="card" style="width: 35rem;">
 	<div class="card-header">
	<div class="carrito">
	$string
	</div>
	</div>
	</div>
	</div>
	</br>
EOF;
include __DIR__.'/includes/vistas/plantillas/plantilla.php';

function mostrar($nombre,$carrito){
	$app = Aplicacion::getInstancia();
	$db = $app->conexionBd();
	$pizzaPedida = PizzaPedida::muestraPizzas();
	$bebidaPedida= BebidaPedida::muestraBebidas();
	if($pizzaPedida!=null){
		$arrpizzaaPedida=array();
		$query1="SELECT * FROM pedidos_pizzas";
                $resultado1=$db->query($query1);
                $row_cnt = mysqli_num_rows($resultado1);
                while($row = $resultado1->fetch_assoc()) {
                    array_push($arrpizzaaPedida,$row['ID_PizzaPedida']);
                }
		$length=count($arrpizzaaPedida);
		$resultado1->free();
	}
	else $length=0;
		$insert=0;
	for($Q=0;$Q<$length;$Q++){
		$insert=$arrpizzaaPedida[$Q];
		
	}
	if($bebidaPedida!=null){
		$arrbebidaPedida=array();
		$query1="SELECT * FROM pedidos_bebidas";
                $resultado1=$db->query($query1);
                $row_cnt = mysqli_num_rows($resultado1);
                while($row = $resultado1->fetch_assoc()) {
                    array_push($arrbebidaPedida,$row['ID_BebidaPedida']);
                }
		$length=count($arrbebidaPedida);
		$resultado1->free();
	}
	else $length=0;
		$insert2=0;
	for($Q=0;$Q<$length;$Q++){
		$insert2=$arrbebidaPedida[$Q];
		
	}
	$carritoToString="";
	if($nombre!=null){
		$precio=$carrito->consultaPrecio();
		$precioP=$carrito->precioPerso();
		$arrayPP=$carrito->consultaPersonalizada();
		$descuento=$carrito->consultaDescuento();
		$oferta=null;
		$i=2000;
		$j=1000;
		$boolPersonalizada=false;
		$boolRepetido=false;
		$repetidor=1;
		$controlmasa=null;
		$controlpiza=null;
		$controltama??o=null;
		$carritoToString=$carritoToString.'Pedidos por pagar por = '.$nombre.' </a>'.'<br></br>';
		if($pizzaPedida!=null){
			$controlmasa=null;
			$controlpiza=null;
			$controltama??o=null;
			foreach($pizzaPedida as $pizza) {
				$pedido=$pizza->get_pedido();
				$idPizzaPedida=$pizza->get_id();
				$idPizza=$pizza->get_idPizza();
				$idMasa=$pizza->get_idMasa();
				$idTama??o=$pizza->get_idTama??o();
				$nombre=$pizza->get_nombre();
				$tama??o=$pizza->get_tama??o();
				$masa=$pizza->get_masa();
				$precio1=$pizza->get_precio();
				$carritoToString=$carritoToString.'<form id="form" name="form" method="post" autocomplete="off">';
				if($idPizza==3){
					$boolPersonalizada=true;
					$carritoToString=$carritoToString. $nombre.'  ';
					$carritoToString=$carritoToString.' masa '. $masa.'  ';
					$carritoToString=$carritoToString.' tama??o '. $tama??o.'  ';
					if($precio1<0)$precio1=0;
					$carritoToString=$carritoToString. $pizza->get_tama??oPrecio()+$precio1.'  ';
						$carritoToString = $carritoToString . '<input name="'.$i.'" type="submit" id="'.$i.'"value="-"/>';
						//$carritoToString=$carritoToString.$idPizza;
						$carritoToString=$carritoToString.'<br>';
					
						$pizzaIngrediente = PizzaIngrediente::muestraIngredientes($idPizzaPedida);
						if($pizzaIngrediente!=null){
							$q=0;
							foreach($pizzaIngrediente as $ing) {
								$idPizzaIngre=$ing->get_idIngredientePizza();
								$nombreIng=$ing->get_nombreIng();
								$precioIng=$ing->get_precioIng();
								$carritoToString=$carritoToString.'<form id="form" name="form" method="post" autocomplete="off">';
								$carritoToString=$carritoToString.' &nbsp '.$nombreIng.'  ';
								$carritoToString = $carritoToString .'  ';
								$carritoToString=$carritoToString.$precioIng.'  ';
							
									$carritoToString = $carritoToString . '<input name="'.$q.'" type="submit" id="'.$q.'"value="-"/>';
									$carritoToString=$carritoToString.'<br>';
								
								$carritoToString=$carritoToString.'</form>';
								if(isset($_POST[$q])){
									//FALTA METER UNA NUEVA CLASE PARA OBTENER LOS IDS DE LOS INGREDIENTES
									
									$query4="DELETE FROM pizza_ingredientes WHERE ID_IngredientePizza='$idPizzaIngre'";
									$resultado4=$db->query($query4);
									header("Location:carrito.php");
									
								}
								$q++;
							}
						}
						else{
							$carritoToString=$carritoToString.'No has elegido ingredientes';
						}
					
						$carritoToString=$carritoToString."<br>";
						$sumTot=$precio+$precioP;
						$carritoToString=$carritoToString.'</form>';
				}else{
					$query=" SELECT * FROM pedidos_pizzas WHERE ID_Pizza='$idPizza' AND ID_Masa='$idMasa' AND ID_Tama??o='$idTama??o' AND ID_Pedido='$pedido'";
					$resultado=$db->query($query);
					$row_cnt = mysqli_num_rows($resultado);
					$repetidor=$row_cnt;
					$resultado->free();
					if($controlmasa!=$idMasa||$controlpiza!=$idPizza||$controltama??o!=$idTama??o){
						
						$controlmasa=null;
						$controlpiza=null;
						$controltama??o=null;
					}
					if(($controlmasa==$idMasa&&$controlpiza==$idPizza&&$controltama??o==$idTama??o&&$repetidor!=1&&$repetidor!=0&&$boolRepetido==false)
					||$controlmasa==null&&$controlpiza==null&&$controltama??o==null){
							$carritoToString=$carritoToString. $nombre.'  ';
							$carritoToString=$carritoToString.' masa '. $masa.'  ';
							$carritoToString=$carritoToString.' tama??o '. $tama??o.'  ';
							$carritoToString=$carritoToString. $row_cnt*($pizza->get_tama??oPrecio()+$precio1).'  ';
							$carritoToString=$carritoToString.' &nbsp '.' &nbsp '.'x'.$row_cnt;
								$carritoToString = $carritoToString . '<input name="'.$i.'" type="submit" id="borrar"value="-"/>';
								$carritoToString = $carritoToString . '<input name="'.$j.'" type="submit" id="'.$j.'"value="+"/>';
								//$carritoToString=$carritoToString.$idPizza;
								$carritoToString=$carritoToString.'<br>';
							
							$carritoToString=$carritoToString.'</form>';
							$boolRepetido=true;
					}
					$controlmasa=$idMasa;
					$controlpiza=$idPizza;
					$controltama??o=$idTama??o;
					
				}
				if(isset($_POST[$i])){
					if($idPizza!=3){
						$query="DELETE FROM pedidos_pizzas WHERE ID_Pedido='$pedido' AND ID_PizzaPedida='$idPizzaPedida'";
						$resultado=$db->query($query);
						header("Location:carrito.php");
					}else{
						$query="DELETE FROM pizza_ingredientes WHERE  ID_PizzaPedida='$idPizzaPedida'";
						$resultado=$db->query($query);
						$query1="DELETE FROM pedidos_pizzas WHERE ID_Pedido='$pedido' AND ID_PizzaPedida='$idPizzaPedida'";
						$resultado1=$db->query($query1);
						header("Location:carrito.php");
					}
				}
				
				if(isset($_POST[$j] )){
					
					$query="INSERT INTO pedidos_pizzas(ID_PizzaPedida,ID_Pedido,ID_Pizza,ID_Masa,ID_Tama??o) VALUES($insert+1, $pedido, $idPizza, $idMasa,$idTama??o)";
					$resultado=$db->query($query);
					header("Location:carrito.php");
				}
				$i++;
				$j--;
			}
		}
		else{
			$carritoToString=$carritoToString.'No hay pizzas';
			$carritoToString=$carritoToString.'<br>';
		}
		if($bebidaPedida!=null){
			$boolRepetido=false;
			$controlbebida=null;
			foreach($bebidaPedida as $bebida) {
				$pedido=$bebida->get_pedido();
				$idBebida=$bebida->get_id();
				$Bebida=$bebida->get_idBebida();
				$nombre=$bebida->get_nombre();
				$precioB=$bebida->get_precio();
				$query=" SELECT * FROM pedidos_bebidas WHERE ID_Bebida='$Bebida' AND ID_Pedido='$pedido'";
					$resultado=$db->query($query);
					$row_cnt = mysqli_num_rows($resultado);
					$repetidor=$row_cnt;
					$resultado->free();
						if($controlbebida!=$Bebida)	
						$controlbebida=null;		
					if(($controlbebida==null)||($controlbebida==$Bebida&&$repetidor!=1&&$repetidor!=0&&$boolRepetido==false)){
							
						$carritoToString=$carritoToString.'<form id="form" name="form" method="post" autocomplete="off">';
						$carritoToString=$carritoToString. $nombre.' &nbsp '.'x'.$row_cnt.'  ';
						$carritoToString=$carritoToString. $row_cnt*$precioB.'  ';
						
							$carritoToString = $carritoToString . '<input name="'.$i.'" type="submit" id="'.$i.'"value="-"/>';
							$carritoToString = $carritoToString . '<input name="'.$j.'" type="submit" id="'.$j.'"value="+"/>';
							//$carritoToString=$carritoToString.$idBebida;
							$carritoToString=$carritoToString.'<br>';
						
						$carritoToString=$carritoToString.'</form>';
						$boolRepetido=true;
					}
					$controlbebida=$Bebida;
				if(isset($_POST[$i])){
					$query="DELETE FROM pedidos_bebidas WHERE ID_Pedido='$pedido' AND ID_BebidaPedida='$idBebida'";
					$resultado=$db->query($query);
					header("Location:carrito.php");
				}
				
				if(isset($_POST[$j] )){
					$query="INSERT INTO pedidos_bebidas(ID_BebidaPedida,ID_Pedido,ID_Bebida) VALUES($insert2+1, $pedido, $Bebida)";
					$resultado=$db->query($query);
					$iter++;
					header("Location:carrito.php");
				}
				$i++;
				$j--;
			}
		}
		else{
			$carritoToString=$carritoToString.'No hay bebidas';
			$carritoToString=$carritoToString.'<br>';
		}
		$oferta=$carrito->consultaOferta();
		$carritoToString=$carritoToString.'<br>';
	
		if($boolPersonalizada==false)
			$carritoToString=$carritoToString.'No hay pizzas personalizadas'.'<br>';
		if($arrayPP==null){
			$sumTot=$precio;
		}
		if($oferta!=null){
			if($oferta==4){
				$carritoToString=$carritoToString.'Precio Total a pagar '.$sumTot.' ???';
				$carritoToString=$carritoToString.'<br>';
				$carritoToString=$carritoToString.'<a>Tienes ofertas ??Usalas!</a>';
				$carritoToString=$carritoToString.'<a href=" oferta.php">Canjear  </a><br>';			
			}else{
				if($descuento!=0){
					$carritoToString=$carritoToString. '<strike>Precio Total a pagar '.$sumTot.'???</strike>';
					$carritoToString=$carritoToString.'<br>';
					if($sumTot-$descuento>0)
					$carritoToString=$carritoToString.'Precio nuevo a pagar '.$sumTot-$descuento.'???';
					else
					$carritoToString=$carritoToString.'Precio nuevo a pagar 0 ???';
				}
			}
			$carritoToString=$carritoToString.'<br>';
			
			$carritoToString=$carritoToString.'<a href="procesarCompra.php"><button type="button" class="btn btn-primary btn-sm">Comprar</button></a>';
		}
		
	}
	else{
		$carritoToString=$carritoToString.'<p class ="mensaje">Debes <a href=login.php>iniciar sesi??n</a> para acceder al carrito.</p>';
	}
	return $carritoToString;
}	
