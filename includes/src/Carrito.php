<?php
require_once __DIR__.'/Aplicacion.php';

class Carrito{
   
    private $oferta1;
    private $suma;
    private $editar;
    
    public  function inicio(){
       
        if(isset($_SESSION["login"])){
             $nombre=$_SESSION["nombre"];
             
        }else{
           $nombre=null;
        }
        return $nombre;
    }
        
    public function consultaPedidosBebPiz(){
        $nombre=$_SESSION["nombre"];
        $app = Aplicacion::getInstancia();
       
        $db = $app->conexionBd();

        $array=array();

        $co=$_SESSION['correo'];
        $query="SELECT p.ID_PizzaPedida as id ,a.Nombre,m.Tipo,t.Tamaño ,a.Precio,t.Precio as precioT ,s.Oferta FROM pizzas a
                JOIN pedidos_pizzas p ON p.ID_Pizza=a.ID_Pizza
                JOIN pedidos s ON p.ID_Pedido=s.ID_Pedido
                JOIN masas m ON m.ID_Masa=p.ID_Masa
                JOIN tamaños t ON t.ID_Tamaño=p.ID_Tamaño
                WHERE s.Estado=1 AND s.Usuario='$co'ORDER BY a.Nombre ASC";
              $resultado=$db->query($query);
              $row_cnt = mysqli_num_rows($resultado);  
        $query2="SELECT q.ID_BebidaPedida AS id,b.Nombre,b.Precio,i.Oferta FROM bebidas b
                JOIN pedidos_bebidas q ON q.ID_Bebida=b.ID_Bebida
                JOIN pedidos i ON i.ID_Pedido=q.ID_Pedido
                WHERE i.Estado=1 AND i.Usuario='$co' 
                ORDER BY b.Nombre ASC";
                    
        //$resultado = mysqli_query($db,$query);	
        
        $resultado2=$db->query($query2);
        $row_cnt2 = mysqli_num_rows($resultado2);
        if ($row_cnt+$row_cnt2==0){
            return null;
        }else{
            if ($row_cnt!=0){
                while($row = $resultado->fetch_assoc()) {
                    $id=$row['id'];
                    array_push($array,$row['Nombre'],$row['Tipo'],$row['Tamaño'],$row['Precio'],$row['precioT']);      
                    $oferta= $row['Oferta'];
                }
                array_push($array,$oferta);
            }
            if ($row_cnt2!=0){
                while($row = $resultado2->fetch_assoc()) {
                    $id=$row['id'];
                    array_push($array,$row['Nombre'],$row['Precio']);      
                    $oferta= $row['Oferta'];
                }
                array_push($array,$oferta);
            }
            
             return $array;
        }        
    }
    public  function consultaPrecio(){
        $app = Aplicacion::getInstancia();
        $db = $app->conexionBd();
      
        $co=$_SESSION['correo'];
        $query1="SELECT SUM(a.Precio) as Precio1 FROM pizzas a
        JOIN pedidos_pizzas p ON p.ID_Pizza=a.ID_Pizza
        JOIN pedidos s ON p.ID_Pedido=s.ID_Pedido
        WHERE s.Estado=1 AND s.Usuario='$co'";

        $resultado1=$db->query($query1);
        if(	$row1 = $resultado1->fetch_assoc())
            $sum1=$row1['Precio1'];

        $query2="SELECT SUM(b.Precio) AS Precio2 FROM bebidas b
        JOIN pedidos_bebidas q ON q.ID_Bebida=b.ID_Bebida
        JOIN pedidos i ON i.ID_Pedido=q.ID_Pedido
        WHERE i.Estado=1 AND i.Usuario='$co'";
        $resultado2=$db->query($query2);
        if(	$row2 = $resultado2->fetch_assoc())
            $sum2=$row2['Precio2'];
       
        $query="SELECT SUM(t.Precio) as Precio1 FROM pizzas a
        JOIN pedidos_pizzas p ON p.ID_Pizza=a.ID_Pizza
        JOIN pedidos s ON p.ID_Pedido=s.ID_Pedido
        JOIN tamaños t ON t.ID_Tamaño=p.ID_Tamaño
        WHERE s.Estado=1 AND s.Usuario='$co'";
        $resultado=$db->query($query);
        if(	$row3 = $resultado->fetch_assoc())
            $sum3=$row3['Precio1'];
        $sumTot=$sum1+$sum2+$sum3;
        return $sumTot;
    }
    public  function consultaPersonalizada(){
        $app = Aplicacion::getInstancia();
        $db = $app->conexionBd();
        $array2=array();
        $co=$_SESSION['correo'];
            $query="SELECT i.Nombre ,i.Precio FROM ingredientes i
                    JOIN pizza_ingredientes p ON i.ID_Ingrediente=p.ID_Ingrediente
                    JOIN pedidos_Pizzas a ON a.ID_PizzaPedida= p.ID_PizzaPedida
                    JOIN pedidos o ON a.ID_Pedido=o.ID_Pedido
                    WHERE o.Estado=1 AND a.ID_Pizza=3 AND o.Usuario='$co'
                    ";
            $resultado2=$db->query($query);
            if($resultado2==null){$row_cnt=0;
            }else {
                $row_cnt = mysqli_num_rows($resultado2);
            }
            if ($row_cnt==0){
                
                return null;
            }else{
               
                while($row = $resultado2->fetch_assoc()) {
                    array_push($array2,$row['Nombre'],$row['Precio']);
                }
                return $array2;
            }
    }
    public function precioPerso(){
        $app = Aplicacion::getInstancia();
        $db = $app->conexionBd();
        $precio=0;
        $co=$_SESSION['correo'];
            $query="SELECT i.Precio FROM ingredientes i
                    JOIN pizza_ingredientes p ON i.ID_Ingrediente=p.ID_Ingrediente
                    JOIN pedidos_pizzas a ON a.ID_PizzaPedida= p.ID_PizzaPedida
                    JOIN pedidos o ON a.ID_Pedido=o.ID_Pedido
                    WHERE o.Estado=1 AND a.ID_Pizza=3 AND o.Usuario='$co'
                    ";
            $resultado2=$db->query($query);
            if($resultado2==null){$row_cnt=0;
            }else {
            $row_cnt = mysqli_num_rows($resultado2);
            }
            if ($row_cnt==0){
                return 0;
            }else{
                while($row = $resultado2->fetch_assoc()) {
                   $precio+=$row['Precio'];
                }
                return $precio;
            }
    }
    public  function consultaDescuento(){
        $app = Aplicacion::getInstancia();
        $db = $app->conexionBd();
        $co=$_SESSION['correo'];
        $oferta=null;
        $query="SELECT Oferta
        FROM pedidos
        WHERE Usuario ='$co'";
        $resultado=$db->query($query);
      if(  $row = $resultado->fetch_assoc())
        $oferta= $row['Oferta'];
        $query1="SELECT Descuento
                FROM ofertas
                WHERE ID_Oferta='$oferta'";
                    
            $resultado1=$db->query($query1);
            if(	$row1 = $resultado1->fetch_assoc())
                return $row1['Descuento'];
            else return 0;
    }
    private  function setSuma($valor){
        $this->suma= $valor; 
    }
    private static function getSuma(){
        return $this->suma;
    }
    public function setEdit(){
        $this->editar=! $this->editar;
    }
    public function getEdit(){
        return $this->editar;
    }
}