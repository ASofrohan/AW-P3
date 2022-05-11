<?php
    require_once __DIR__.'/includes/config.php';
    $app = Aplicacion::getInstancia();
    $db = $app->conexionBd();

    $co=$_SESSION['correo'];
    $oferta = isset($_POST['oferta']) ? $_POST['oferta'] : null;
/////
 
    $query1="SELECT ID_Pedido
    FROM pedidos 
    WHERE Estado=1 AND Usuario='$co'";
    
    $resultado1=$db->query($query1);
    if(	$row1 = $resultado1->fetch_assoc()){
    $user=$row1['ID_Pedido'];
    }
    $resultado1->free();
////////
    $query="SELECT ID_Oferta
            FROM ofertas 
            WHERE Codigo='$oferta'";
		
	$resultado=$db->query($query);
   
            if(	$row = $resultado->fetch_assoc()){//VER PORQUE NO FUNCIONA LAS OFERTAS
				 $of=$row['ID_Oferta'];
              
                $query3="UPDATE pedidos 
                SET Oferta=$of
                WHERE ID_Pedido=$user ";
                $resultado=$db->query($query3);
                header("Location:carrito.php");
			}else{
                echo 'Esa oferta no existe';
                header("Location:oferta.php");
            }
            $resultado->free();
?>