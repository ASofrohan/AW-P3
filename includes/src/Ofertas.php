<?php
require_once __DIR__.'/Aplicacion.php';

class Ofertas{

    private $id_Oferta;
    private $codigo;
    private $tipo;
    private $descuento;
    private $info;

    public function __construct($id_Oferta, $codigo, $tipo, $descuento, $info){
        $this->id_Oferta = $id_Oferta;
        $this->codigo = $codigo;
        $this->tipo = $tipo;
        $this->descuento = $descuento;
        $this->info = $info;
    }

    public static function getOfertas(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();

        $query = "SELECT * FROM ofertas";
        $resultado = $conn->query($query);

        return $resultado;
    }

    public static function muestraOfertas(){
        $ofertas = self::getOfertas();
        $arrayOfertas = array();

        if(mysqli_num_rows($ofertas)>0){
            $i=0;
            while($row = mysqli_fetch_assoc($ofertas)){
                $id_Oferta = $row['ID_Oferta'];
                $codigo = $row['Codigo'];
                $tipo = $row['Tipo'];
                $descuento = $row['Descuento'];
                $info = $row['Info'];
                $of = new Ofertas($id_Oferta, $codigo, $tipo, $descuento, $info);
                $arrayOfertas[$i] = $of;
                $i++;
            }
        }
        return $arrayOfertas;
    }

    public function get_codigo(){
        return $this->codigo;
    }
    public function get_id(){
        return $this->id_Oferta;
    }
    public function get_tipo(){
        return $this->tipo;
    }
    public function get_descuento(){
        return $this->descuento;
    }
    public function get_info(){
        return $this->info;
    }


}