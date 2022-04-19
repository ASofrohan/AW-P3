<?php
require_once __DIR__.'/Aplicacion.php';

class Tamaños
{
    private $id_tamaño;
    private $tamaño;
    private $precio;

    private function __construct($id_tamaño, $tamaño, $precio)
    {
        $this->id_tamaño = $id_tamaño;
        $this->tamaño = $tamaño;
        $this->precio = $precio;
    }

    public static function getTamaño(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM tamaños";
        $resultado=$conn->query($query);

        return $resultado;
    }

    public static function muestraTamaños(){
        $tamanio = self::getTamaño();
        $arrayTamaño = array();

        if(mysqli_num_rows($tamanio)>0){
            $i=0;
            while($row = mysqli_fetch_assoc($tamanio)) {
                
                $id_tamaño=$row['ID_Tamaño'];
                $tamaño=$row['Tamaño'];
                $precio=$row['Precio'];
                $p = new Tamaños($id_tamaño, $tamaño, $precio);
                $arrayTamaño[$i] = $p;
                $i += 1;
            }
        }

        return $arrayTamaño;
    }

    public function get_id()
    {
        return $this->id_tamaño;
    }
    public function get_tamaño()
    {
        return $this->tamaño;
    }
    public function get_precio()
    {
        return $this->precio;
    }
}