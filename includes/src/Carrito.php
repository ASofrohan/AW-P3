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
    public  function sesionCarrito($nombre){
    
        echo 'Pedidos por pagar por = '.$nombre.'<br>';
        echo'<br>';
        $oferta= self::consultaPedidosBebPiz();
            echo'</br>';
    
        echo'</br>';
        if($oferta!=null){
            if($oferta==4){
                echo 'Precio Total a pagar '.$sumTot.' €';
                echo'</br>';
                echo '<a>Tienes ofertas ¡Usalas!</a>';
                echo'<a href=" oferta.php">Canjear  </a><br>';
                echo'<a>¿Quieres editar el pedido?</a><a href=procesarEdit.php><button>EDITAR</button></a><br>';
                echo '<a href=procesarCompra.php><button>Comprar</button></a>';
            }else{
                self::consultaDescuento();
            }
        }
    }
        
    public function consultaPedidosBebPiz(){
        $nombre=$_SESSION["nombre"];
        $app = Aplicacion::getInstancia();
       
        $db = $app->conexionBd();

        $array=array();

        $co=$_SESSION['correo'];
        $query="SELECT p.ID_PizzaPedida as id ,a.Nombre,a.Precio,s.Oferta FROM pizzas a
                JOIN pedidos_pizzas p ON p.ID_Pizza=a.ID_Pizza
                JOIN pedidos s ON p.ID_Pedido=s.ID_Pedido
                WHERE s.Estado=1 AND s.Usuario='$co'
                UNION
                SELECT q.ID_BebidaPedida AS id,b.Nombre,b.Precio,i.Oferta FROM bebidas b
                JOIN pedidos_bebidas q ON q.ID_Bebida=b.ID_Bebida
                JOIN pedidos i ON i.ID_Pedido=q.ID_Pedido
                WHERE i.Estado=1 AND i.Usuario='$co'
                    ";
        $resultado = mysqli_query($db,$query);	
        $resultado=$db->query($query);
        $row_cnt = mysqli_num_rows($resultado);
        if ($row_cnt==0){
           
            return null;
        }else{
            while($row = $resultado->fetch_assoc()) {
                $id=$row['id'];
                array_push($array,$row['Nombre'],$row['Precio']);
               // echo $row['Nombre'].' '.$row['Precio'].' '
                //.'<a href=procesarEdit.php:eliminar($id)><button>basura</button></a>'.''.'</br>';
                ////'<a href=procesarEdit.php?func=funcion eliminar('$row['id']')><button>basura</button></a>'
                                
                $oferta= $row['Oferta'];
            }
            array_push($array,$oferta);
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

        $sumTot=$sum1+$sum2;
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
            $row_cnt = mysqli_num_rows($resultado2);
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
            $row_cnt = mysqli_num_rows($resultado2);
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