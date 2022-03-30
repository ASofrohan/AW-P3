<?php
session_start();

if(isset($_SESSION["login"])){
	$masa = isset($_POST['masas']) ? $_POST['masas'] : null;
	$tamaño = isset($_POST['tamaños']) ? $_POST['tamaños'] : null;
	$correo=$_SESSION['correo'];
	$conn = new \mysqli('localhost', 'root', '', 'PizzaGuay');
    //no existe pedido pendiente, hay que crearlo
    $query = "SELECT ID_Pedido FROM pedidos WHERE Usuario = '$correo' and Estado = '1'";
    $resultado = $conn->query($query);
    $row_cnt = mysqli_num_rows($resultado);
    if($row_cnt == 0){
        $queryInsert = sprintf("INSERT INTO pedidos(Usuario, Oferta, Fecha, Estado) 
        VALUES('%s','4', curdate(), '1')",
        $conn->real_escape_string($correo));
        );
    }
    $query = "SELECT ID_Pedido FROM pedidos WHERE Usuario = '$correo' and Estado = '1'";
    $resultado = $conn->query($query);
    $row = $resultado->fetch_assoc();
    $idPedido = $row['ID_Pedido'];
    //ya existe pedido pendiente
    $querymasa = "SELECT ID_Masa FROM masas WHERE Tipo = '$masa'";
    $resquerymasa = $conn->query($querymasa);
    $rowmasa = $resquerymasa->fetch_assoc();
    $idMasa = $rowmasa['Tipo'];
    
    $querytam = "SELECT ID_Tamaño FROM tamaños WHERE Tamaño = '$tamaño'";
    $resquerytam = $conn->query($querytam);
    $rowtam = $resquerytam->fetch_assoc();
    $idTam = $rowtam['Tamaño'];

    $queryInsert = "INSERT INTO pedidos_pizzas(ID_pedido, ID_pizza, ID_masa, ID_Tamaño)
                    VALUES ($idPedido, '3', $idMasa, $idTam)";
    $selectpizzaNueva = "SELECT TOP 1 ID_PizzaPedida FROM pedidos_pizzas ORDER BY ID_pizzaPedida DESC"
    $resultadoPizzaNueva = $conn->query($selectpizzaNueva);
    $idNuevaPizza = $resultadoPizzaNueva->fetch_assoc();
    //insert ingredientes
    $query = "SELECT ID_Ingrediente FROM Ingredientes";
    $resultado = $conn->query($query);
    while($row = $resultado->fetch_assoc()) {
        if(in_array($row['ID_Ingrediente'], $_POST['Ingredientes'])){
            $queryIngrediente = "INSERT INTO pizza_ingredientes(ID_PizzaPedida, ID_Ingrediente)
                                VALUES ($idNuevaPizza['ID_PizzaPedida'],$row['ID_Ingrediente'])";
        }
    }

if ( $conn->query($query) ) {
		header('Location: pizzas.php');
} else {
	echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
		exit();
}
}
else{
	echo "No estas registrado";
}
	
