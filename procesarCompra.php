<?php
require_once __DIR__.'/includes/config.php';
$app = Aplicacion::getInstancia();
        $db = $app->conexionBd();
        
        $co=$_SESSION['correo'];

        $query="UPDATE pedidos
        SET Estado=0
        WHERE Usuario ='$co' AND Estado=1";//cambiar id pedido
        $resultado=$db->query($query);
       
 ?>
<script>
    alert('Compra realizada');
    window.location.href='carrito.php';
</script>