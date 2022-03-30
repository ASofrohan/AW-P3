<?php
session_start();
if(isset($_SESSION["login"])){
    $co=$_SESSION["correo"];
    $oferta = isset($_POST['oferta']) ? $_POST['oferta'] : null;
/////
    $conn = new \mysqli('localhost', 'root', '', 'PizzaGuay');
    $query1="SELECT ID_Pedido
    FROM pedidos 
    WHERE Estado=1 AND Usuario='$co'";
    
    $resultado1=$conn->query($query1);
    if(	$row1 = $resultado1->fetch_assoc()){
    $user=$row1['ID_Pedido'];
    }

////////
    $query="SELECT ID_Oferta
            FROM ofertas 
            WHERE Codigo='$oferta'";
		
	$resultado=$conn->query($query);
   
            if(	$row = $resultado->fetch_assoc()){//VER PORQUE NO FUNCIONA LAS OFERTAS
				 $of=$row['ID_Oferta'];
                echo $of;
                $query3="UPDATE pedidos 
                SET Oferta=$of
                WHERE ID_Pedido=$user ";
                $resultado=$conn->query($query3);
                header("Location:carrito.php");
			}else{
                echo 'Esa oferta no existe';
                header("Location:oferta.php");
            }
    
}
else{
    echo'No puedes canjear ofertas porque no estas registrado';
}

?>