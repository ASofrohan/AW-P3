<?php
require_once __DIR__.'/Aplicacion.php';

class Masas
{
    private $id_masa;
    private $tipo;

    private function __construct($id_masa, $tipo)
    {
        $this->id_masa = $id_masa;
        $this->tipo = $tipo;
    }

    public static function getMasas(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM masas";
        $resultado=$conn->query($query);

        return $resultado;
    }

    public static function muestraMasas(){
        $masas = self::getMasas();
        $arrayMasas = array();

        if(mysqli_num_rows($masas)>0){
            $i=0;
            while($row = mysqli_fetch_assoc($masas)) {
                
                $id_masa=$row['ID_Masa'];
                $tipo=$row['Tipo'];
                $p = new Masas($id_masa, $tipo);
                $arrayMasas[$i] = $p;
                $i += 1;
            }
        }

        return $arrayMasas;
    }

    public function get_id()
    {
        return $this->id_masa;
    }
    public function get_tipo()
    {
        return $this->tipo;
    }
}

