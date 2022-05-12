<?php
require_once __DIR__.'/Aplicacion.php';

class Bebidas
{
    private $id_bebida;
    private $nombre;
    private $precio;
    private $image;

    public function __construct($id_bebida, $nombre, $precio, $image)
    {
        $this->id_bebida= $id_bebida;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->image = $image;
    }

    public static function getBebidas(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM bebidas";
        $resultado=$conn->query($query);

        return $resultado;
    }

    public static function muestraBebidas(){
        $bebidas = self::getBebidas();
        $arrayBebidas = array();

        if(mysqli_num_rows($bebidas)>0){
            $i=0;
            while($row = mysqli_fetch_assoc($bebidas)) {
                
                $id_bebida=$row['ID_Bebida'];
                $precio=$row['Precio'];
                $nombre=$row['Nombre'];
                $image=$row['Imagen'];
                $b = new Bebidas($id_bebida, $nombre, $precio, $image);
                $arrayBebidas[$i] = $b;
                $i += 1;
            }
        }
        $bebidas->free();
        
        return $arrayBebidas;
    }

    public function get_id()
    {
        return $this->id_bebida;
    }
    public function get_precio()
    {
        return $this->precio;
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
