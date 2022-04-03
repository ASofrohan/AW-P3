<?php
require_once __DIR__.'/Aplicacion.php';

class Carrito{
   
    private $oferta1;
    public static function inicio(){
        
        
        if(isset($_SESSION["login"])){
           
             $nombre=$_SESSION["nombre"];
             self::sesionCarrito($nombre);
        }else{
            echo'no esta registrado';
          
        }
    }
    public static function sesionCarrito($nombre){
    
        echo 'Pedidos por pagar por = '.$nombre.'</br>';
        $oferta= self::consultaPedidosBebPiz();
            echo'</br>';
        
        $sumTot=4.99+ self::consultaPrecio()+ self::consultaPersonalizada();
        
        echo'</br>';
        if($oferta==4){
            echo 'Precio Total a pagar '.$sumTot;
            echo'</br>';
            echo '<a>Tienes ofertas ¡Usalas!</a>';
            echo'<a href=" oferta.php">Canjear</a>';
        }else{
            self::consultaDescuento();
        }
          
    }

    public static function consultaPedidosBebPiz(){
        $nombre=$_SESSION["nombre"];
        $app = Aplicacion::getInstancia();
       
        $db = $app->conexionBd();
//
        $query1="SELECT Correo
                FROM Usuarios WHERE Nombre='$nombre'";
        $resultado=$db->query($query1);
        $row = $resultado->fetch_assoc();
        $co=$row['Correo'];
/////
        $query="SELECT a.Nombre,a.Precio,s.Oferta  FROM Pizzas a
                        JOIN Pedidos_Pizzas p ON p.ID_PizzaPedida=a.ID_Pizza
                        JOIN Pedidos s ON p.ID_Pedido=s.ID_Pedido
                        WHERE s.Estado=1 AND s.Usuario='$co'
                        UNION
                        SELECT b.Nombre,b.Precio,i.Oferta FROM Bebidas b
                        JOIN Pedidos_Bebidas q ON q.ID_BebidaPedida=b.ID_Bebida
                        JOIN Pedidos i ON i.ID_Pedido=q.ID_Pedido
                        WHERE i.Estado=1 AND i.Usuario='$co'
                    ";
        $resultado = mysqli_query($db,$query);	
                    $resultado=$db->query($query);
                    $row_cnt = mysqli_num_rows($resultado);
                    if ($row_cnt==0){
                        echo 'No hay ningun pedido';
                    }else{
                        while($row = $resultado->fetch_assoc()) {
                            echo $row['Nombre'].' '.$row['Precio'].' '.'</br>';
                            $oferta=$row['Oferta'];
                        }
                    
                    }
                    $oferta1=$oferta;
                 return $oferta;
    }
    public static function consultaPrecio(){
        $app = Aplicacion::getInstancia();
        $db = $app->conexionBd();
        ////
        $nombre=$_SESSION["nombre"];
            $query1="SELECT Correo
            FROM Usuarios WHERE Nombre='$nombre'";
         $resultado=$db->query($query1);
            $row = $resultado->fetch_assoc();
            $co=$row['Correo'];
    ////
        $query1="SELECT SUM(a.Precio) as Precio1 FROM Pizzas a
        JOIN Pedidos_Pizzas p ON p.ID_PizzaPedida=a.ID_Pizza
        JOIN Pedidos s ON p.ID_Pedido=s.ID_Pedido
        WHERE s.Estado=1 AND s.Usuario='$co'";

        $resultado1=$db->query($query1);
        if(	$row1 = $resultado1->fetch_assoc())
            $sum1=$row1['Precio1'];

        $query2="SELECT SUM(b.Precio) AS Precio2 FROM Bebidas b
        JOIN Pedidos_Bebidas q ON q.ID_BebidaPedida=b.ID_Bebida
        JOIN Pedidos i ON i.ID_Pedido=q.ID_Pedido
        WHERE i.Estado=1 AND i.Usuario='$co'";
        $resultado2=$db->query($query2);
        if(	$row2 = $resultado2->fetch_assoc())
            $sum2=$row2['Precio2'];

        $sumTot=$sum1+$sum2;
        return $sumTot;
    }
    public static function consultaPersonalizada(){
        $app = Aplicacion::getInstancia();
        $db = $app->conexionBd();
          ////
          $nombre=$_SESSION["nombre"];
          $query1="SELECT Correo
          FROM Usuarios WHERE Nombre='$nombre'";
            $resultado=$db->query($query1);
            $row = $resultado->fetch_assoc();
            $co=$row['Correo'];
  ////
                $query="SELECT i.Nombre ,i.Precio FROM Ingredientes i
                        JOIN Pizza_Ingredientes p ON i.ID_Ingrediente=p.ID_Ingrediente
                        JOIN Pedidos_Pizzas a ON a.ID_PizzaPedida= p.ID_PizzaPedida
                        JOIN Pedidos o ON a.ID_Pedido=o.ID_Pedido
                        WHERE o.Estado=1 AND a.ID_Pizza=3 AND o.Usuario='$co'
                        ";
                $resultado2=$db->query($query);
                $row_cnt = mysqli_num_rows($resultado2);
                if ($row_cnt==0){
                    echo 'No hay pizzas personalizadas';
                    return 0;
                }else{
                    echo 'Pizzas personalizadas </br>';
                    while($row = $resultado2->fetch_assoc()) {
                            echo $row['Nombre'].' '.$row['Precio'].' '.'</br>';
                            
                        $sumTot=$row['Precio'];
                    }
                    return $sumTot;
                }
    }
    public static function consultaDescuento(){
        $app = Aplicacion::getInstancia();
        $db = $app->conexionBd();
       $query1="SELECT Descuento
                FROM ofertas
                WHERE ID_Oferta='$oferta1'";
                    
            $resultado1=$db->query($query1);
            if(	$row1 = $resultado1->fetch_assoc()){
                echo '<strike>Precio Total a pagar '.$sumTot.'</strike>';
                echo'</br>';
                echo'Precio nuevo a pagar '.$sumTot-$row1['Descuento'];
            }
    }
}
?>