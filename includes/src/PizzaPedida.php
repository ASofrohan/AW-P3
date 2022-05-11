<?php
require_once __DIR__.'/Aplicacion.php';
require_once __DIR__.'/Pizzas.php';
require_once __DIR__.'/Tamanios.php';
require_once __DIR__.'/Masas.php';
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
        $idPedido=null;
        if(isset($_SESSION['login'])){
            $co=$_SESSION['correo'];
            $query1="SELECT ID_Pedido FROM pedidos WHERE Usuario='$co' AND Estado=1";
            $resultado1=$conn->query($query1);//tiene pedidos activos
                if(	$row = $resultado1->fetch_assoc())
                    $idPedido= $row['ID_Pedido'];
            if($idPedido!=null){     
                $query = "SELECT * FROM pedidos_pizzas p
                            JOIN pizzas a ON  p.ID_Pizza=a.ID_Pizza
                            WHERE ID_pedido='$idPedido' ORDER BY a.Nombre ASC";
                $resultado=$conn->query($query);
                return $resultado;
            }else return null;
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
  
    public function get_precio(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query="SELECT * FROM pizzas WHERE ID_Pizza='$this->pizza'";
        $resultado=$conn->query($query);
        $row = $resultado->fetch_assoc();
        $name=$row['Nombre'];
        if($name=="Personalizada")
        $t=new Pizzas($this->pizza,$row['Precio'],1,$name,null);
        else
        $t=new Pizzas($this->pizza,$row['Precio'],0,$name,null);
        return $t->get_precio();
    } 
    public function get_nombre(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query="SELECT * FROM pizzas WHERE ID_Pizza='$this->pizza'";
        $resultado=$conn->query($query) or die($conn->error);
        $row = $resultado->fetch_assoc();
        $name=$row['Nombre'];
        if($name=="Personalizada")
        $t=new Pizzas($this->pizza,$row['Precio'],1,$name,null);
        else
        $t=new Pizzas($this->pizza,$row['Precio'],0,$name,null);
        return $t->get_nombre();
    }
    public function get_masa(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query="SELECT Tipo FROM masas WHERE ID_Masa='$this->masa'";
        $resultado=$conn->query($query);
        $row = $resultado->fetch_assoc();
           $m=new Masas($this->masa,$row['Tipo']);
           return $m->get_tipo();
    } 
    public function get_tamaño(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query="SELECT Tamaño,Precio FROM tamaños WHERE ID_Tamaño='$this->tamaño'";
        $resultado=$conn->query($query);
        $row = $resultado->fetch_assoc();
           $t=new Tamaños($this->tamaño,$row['Tamaño'],$row['Precio']);
           return $t->get_tamaño();
    }
    public function get_tamañoPrecio(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query="SELECT Tamaño,Precio FROM tamaños WHERE ID_Tamaño='$this->tamaño'";
        $resultado=$conn->query($query);
        $row = $resultado->fetch_assoc();
           $t=new Tamaños($this->tamaño,$row['Tamaño'],$row['Precio']);
           return $t->get_precio();
    }
    public function get_id(){ return $this->id_pizzapedida;}
    public function get_pedido(){ return $this->pedido;}
    public function get_idPizza(){ return $this->pizza;}
    public function get_idMasa(){ return $this->masa;}
    public function get_idTamaño(){ return $this->tamaño;}
}