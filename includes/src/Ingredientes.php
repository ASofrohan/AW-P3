<?php
require_once __DIR__.'/Aplicacion.php';

class Ingredientes
{
    private $id_ingrediente;
    private $nombre;
    private $precio;
    private $image;


    public function __construct($id_ingrediente, $nombre, $precio, $image)
    {
        $this->id_ingrediente = $id_ingrediente;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->image = $image;
    }

    public static function getIngredientes(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM ingredientes";
        $resultado=$conn->query($query);

        return $resultado;
    }

    public static function muestraIngredientes(){
        $ingredientes = self::getIngredientes();
        $arrayIngredientes = array();

        if(mysqli_num_rows($ingredientes)>0){
            $i=0;
            while($row = mysqli_fetch_assoc($ingredientes)) {
                
                $id_ingrediente=$row['ID_Ingrediente'];
                $nombre=$row['Nombre'];
                $precio=$row['Precio'];
                $image=$row['Image'];
                $p = new Ingredientes($id_ingrediente, $nombre, $precio, $image);
                $arrayIngredientes[$i] = $p;
                $i += 1;
            }
        }

        $ingredientes->free();
        
        return $arrayIngredientes;
    }

    public function get_id()
    {
        return $this->id_ingrediente;
    }
    public function get_nombre()
    {
        return $this->nombre;
    }
    public function get_precio()
    {
        return $this->precio;
    }
    public function get_image()
    {
        return $this->image;
    }
}

