<?php
require_once __DIR__.'/Aplicacion.php';

class Pizzas
{
    private $id_pizza;
    private $precio;
    private $personalizada;
    private $nombre;
    private $image;

    public function __construct($id_pizza, $precio, $personalizada, $nombre, $image)
    {
        $this->id_pizza = $id_pizza;
        $this->precio = $precio;
        $this->personalizada = $personalizada;
        $this->nombre = $nombre;
        $this->image = $image;
    }

    public static function getPizzas(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM pizzas";
        $resultado=$conn->query($query);

        return $resultado;
    }

    public static function muestraPizzas(){
        $pizzas = self::getPizzas();
        $arrayPizzas = array();

        if(mysqli_num_rows($pizzas)>0){
            $i=0;
            while($row = mysqli_fetch_assoc($pizzas)) {
                
                $id_pizza=$row['ID_Pizza'];
                $precio=$row['Precio'];
                $personalizada=$row['Personalizada'];
                $nombre=$row['Nombre'];
                $image=$row['Image'];
                $p = new Pizzas($id_pizza, $precio, $personalizada, $nombre, $image);
                $arrayPizzas[$i] = $p;
                $i += 1;
            }
        }

        return $arrayPizzas;
    }

    public function inserta(){
        $app = Aplicacion::getInstancia();
        $db = $app->conexionBd();
        if(isset($_SESSION['login'])){//resolver esto, que sale un mensaje arriba
            //basicamente que si no esta registrado vea las pizzas pero lo de pedir no funcione
            $co=$_SESSION['correo'];
        
            $query1="SELECT * FROM pedidos_pizzas";
            $resultado1=$db->query($query1);
            $row_cnt = mysqli_num_rows($resultado1);
            
            $query2="SELECT ID_Pedido FROM pedidos WHERE Usuario='$co' AND Estado=1";
            $resultado2=$db->query($query2);
            $row_cnt2 = mysqli_num_rows($resultado2);
            if($row_cnt2!=0){//tiene pedidos activos
                if(	$row = $resultado2->fetch_assoc())
                    $idPedido= $row['ID_Pedido']; 
            }else{//no tiene pedidos, hay que meterle
                $query1="SELECT * FROM pedidos";
                $resultado1=$db->query($query1);
                $row_cnt = mysqli_num_rows($resultado1);
                while($row = $resultado1->fetch_assoc()) {
                    array_push($obtencionIdPedido,$row['ID_Pedido']);
                }
                for($j=0;$j<$row_cnt;$j++){
                    $idpedido=$obtencionIdPizzaPedida[$j];
                }
                $query4="INSERT INTO pedidos(ID_Pedido,Usuario,Oferta,Fecha,Estado,FechaC) VALUES($idpedido+1,'$co',4,CURDATE(),1,0000-00-00)";
                $resultado4=$db->query($query4);
                $idPedido=$idpedido+1;
            }
            //modificar esto, los valores de las masasa, tamaños
            $query="INSERT INTO pedidos_pizzas(ID_PizzaPedida,ID_Pedido,ID_Pizza,ID_Masa,ID_Tamaño) VALUES($row_cnt+1, $idPedido, 1, 1,1)";
            $resultado=$db->query($query);
        }
    }

    public function get_id()
    {
        return $this->id_pizza;
    }
    public function get_precio()
    {
        return $this->precio;
    }
    public function get_personalizada()
    {
        return $this->personalizada;
    }
    public function get_nombre()
    {
        return $this->nombre;
    }
    public function get_image()
    {
        return $this->image;
    }
}

