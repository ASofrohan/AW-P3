<?php
require_once __DIR__.'/includes/src/Carrito.php';
require_once __DIR__.'/includes/config.php';
/*$editar=true;
$carrito= new Carrito();
if($carrito->getEdit())echo'trueeeee';
 else echo 'falseee';
   $carrito->setEdit();
 if($carrito->getEdit())echo'trueeeee';
 else echo 'falseee';*/
 
 function eliminar($id){
    $app = Aplicacion::getInstancia();
    $db = $app->conexionBd();
    echo $id;
    $co=$_SESSION['correo'];
    $query="DELETE a.ID_PizzaPedida
            FROM pedidos_pizzas a
            JOIN pedidos p ON a.ID_Pedido=p.ID_Pedido
            WHERE p.Usuario ='$co' AND p.ID_Pedido=1 AND a.ID_PizzaPedida='$id'";//cambiar id pedido
    $resultado=$db->query($query);
 }
?>
<script>
   // location.href='Carrito.php';
</script>