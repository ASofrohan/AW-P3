<?php
require_once __DIR__.'/Aplicacion.php';
class BebidaPedida{
    private $id_bebidapedida;
    private $pedido;
    private $bebida;
    private function __construct($id_bebidapedida, $pedido, $bebida) {
        $this->id_bebidapedida = $id_bebidapedida;
        $this->pedido = $pedido;
        $this->bebida = $bebida;
    }

    public static function getBebidas(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        if(isset($_SESSION['login'])){
            $co=$_SESSION['correo'];
            $idPedido=null;
            $query1="SELECT ID_Pedido FROM pedidos WHERE Usuario='$co' AND Estado=1";
            $resultado1=$conn->query($query1);//tiene pedidos activos
                if(	$row = $resultado1->fetch_assoc())
                    $idPedido= $row['ID_Pedido'];
                    
                if($idPedido==null){ 
                     return null;
                }else{
                    $query = "SELECT * FROM pedidos_bebidas p
                    JOIN bebidas a ON  p.ID_Bebida=a.ID_Bebida
                    WHERE ID_pedido='$idPedido' ORDER BY a.Nombre ASC";
                
                    $resultado=$conn->query($query);
                    return $resultado;
                }
        }else return  null;
    }

    public static function muestraBebidas(){
        $bebidas = self::getBebidas();
        $arrayBebidas = array();
        if ($bebidas!=null){
            if(mysqli_num_rows($bebidas)>0){
                $i=0;
                while($row = mysqli_fetch_assoc($bebidas)) {
                    
                    $id_bebidapedida=$row['ID_BebidaPedida'];
                    $pedido=$row['ID_Pedido'];
                    $bebida=$row['ID_Bebida'];
                    $p = new BebidaPedida($id_bebidapedida, $pedido, $bebida);
                    $arrayBebidas[$i] = $p;
                    $i += 1;
                }
            }
            return $arrayBebidas;
        }else return null;
        
    }
    public function get_id(){ return $this->id_bebidapedida;}
    public function get_pedido(){ return $this->pedido;}
    public function get_idBebida(){ return $this->bebida;}
}