<?php
require_once __DIR__.'/Aplicacion.php';

class Ofertas{

    private $codigo;
    private $tipo;
    private $descuento;

    public function __construct($codigo, $tipo, $descuento){
        $this->codigo = $codigo;
        $this->tipo = $tipo;
        $this->descuento = $descuento;
    }

    public static function getOfertas(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $query = "SELECT * FROM Ofertas";
        $resultado = $conn->query($query);

        return $resultado;
    }

    public static function muestraOfertas(){
        $ofertas = self::getOfertas();
        $arrayOfertas = array();

        if(mysqli_num_rows($ofertas)>0){
            $i=0;
            while($row = mysqli_fetch_assoc($ofertas)){
                $codigo = $row['Codigo'];
                $tipo = $row['Tipo'];
                $descuento = $row['Descuento'];
                $of = new Ofertas($codigo, $tipo, $descuento);
                $arrayOfertas[$i] = $of;
                $i++;
            }
        }
        return $arrayOfertas;
    }

    public function get_codigo(){
        return $this->codigo;
    }
    public function get_tipo(){
        return $this->tipo;
    }
    public function get_descuento(){
        return $this->descuento;
    }


}