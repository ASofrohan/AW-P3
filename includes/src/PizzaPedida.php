<?php
require_once __DIR__.'/Aplicacion.php';
class PizzaPedida{
    private $id_pizzapedida;
    private $pedido;
    private $pizza;
    private $masa;
    private $tamaño;
    private function __construct($id_pizzapedida, $pedido, $pizza, $masa, $tamaño) {
        $this->id_pizzapedida = $id_pizzapedida;
        $this->pedido = $pedido;
        $this->pizza = $pizza;
        $this->masa = $masa;
        $this->tamaño = $tamaño;
    }

    public static function getPizzas(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        
        if(isset($_SESSION['login'])){
            $co=$_SESSION['correo'];
            $query1="SELECT ID_Pedido FROM pedidos WHERE Usuario='$co' AND Estado=1";
            $resultado1=$conn->query($query1);//tiene pedidos activos
                if(	$row = $resultado1->fetch_assoc())
                    $idPedido= $row['ID_Pedido'];
                    
            $query = "SELECT * FROM pedidos_pizzas p
                        JOIN pizzas a ON  p.ID_Pizza=a.ID_Pizza
                        WHERE ID_pedido='$idPedido' ORDER BY a.Nombre ASC";
            $resultado=$conn->query($query);

            return $resultado;
        }else return null;
    }

    public static function muestraPizzas(){
        $pizzas = self::getPizzas();
        $arrayPizzas = array();
        if($pizzas!=null){
            if(mysqli_num_rows($pizzas)>0){
                $i=0;
                while($row = mysqli_fetch_assoc($pizzas)) {
                    
                    $id_pizzapedida=$row['ID_PizzaPedida'];
                    $pedido=$row['ID_Pedido'];
                    $pizza=$row['ID_Pizza'];
                    $masa=$row['ID_Masa'];
                    $tamaño=$row['ID_Tamaño'];
                    $p = new PizzaPedida($id_pizzapedida, $pedido, $pizza, $masa,$tamaño);
                    $arrayPizzas[$i] = $p;
                    $i += 1;
                }
                return $arrayPizzas;
            }
        }
        else return null;
       
    }
    public function get_id(){ return $this->id_pizzapedida;}
    public function get_pedido(){ return $this->pedido;}
    public function get_idPizza(){ return $this->pizza;}
}