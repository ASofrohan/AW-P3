<?php
require_once __DIR__.'/Aplicacion.php';

class Pedidos
{
    private $id_pedido;
    private $usuario;
    private $oferta;
    private $fecha;
    private $fechaC;
    private $estado;

    public function __construct($id_pedido, $usuario,$oferta,$fecha,$estado,$fechaC)
    {
        $this->id_pedido = $id_pedido;
        $this->usuario = $usuario;
        $this->oferta = $oferta;
        $this->fecha = $fecha;
        $this->estado = $estado;
        $this->fechaC = $fechaC;
    }

    public static function getPedidos(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM pedidos";
        $resultado=$conn->query($query);

        return $resultado;
    }

    public static function muestraPedidos(){
        $pedidos = self::getPedidos();
        $arrayPedidos = array();

        if(mysqli_num_rows($pedidos)>0){
            $i=0;
            while($row = mysqli_fetch_assoc($pedidos)) {
                
                $id_pedido=$row['ID_Pedido'];
                $usuario=$row['Usuario'];
                $oferta=$row['Oferta'];
                $fecha=$row['Fecha'];
                $estado=$row['Estado'];
                $fechaC=$row['FechaC'];
                $p = new Pedidos($id_pedido, $usuario,$oferta,$fecha,$estado,$fechaC);
                $arrayPedidos[$i] = $p;
                $i += 1;
            }
        }

        return $arrayPedidos;
    }

    public function get_idPedido()
    {
        return $this->id_pedido;
    }
    public function get_usuario()
    {
        return $this->usuario;
    }
    public function get_oferta(){
        return $this->oferta;
    }
    public function get_fecha(){
        return $this->fecha;
    }
    public function get_estado(){
        return $this->estado;
    } 
    public function get_fechaC(){
        return $this->fechaC;
    }
}

