<?php
require_once __DIR__.'/Aplicacion.php';

class Pizzas
{
    private $id_pizza;
    private $precio;
    private $personalizada;
    private $nombre;
    private $image;

    private function __construct($id_pizza, $precio, $personalizada, $nombre, $image)
    {
        $this->id_pizza = $id_pizza;
        $this->precio = $precio;
        $this->personalizada = $personalizada;
        $this->nombre = $nombre;
        $this->image = $image;
    }

    public static function getPizzas(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM pizzas";
        $resultado=$conn->query($query);

        return $resultado;
    }

    public static function muestraPizzas(){
        $pizzas = self::getPizzas();
        $arrayPizzas = array();

        if(mysqli_num_rows($pizzas)>0){
            $i=0;
            while($row = mysqli_fetch_assoc($pizzas)) {
                
                $id_pizza=$row['ID_Pizza'];
                $precio=$row['Precio'];
                $personalizada=$row['Personalizada'];
                $nombre=$row['Nombre'];
                $image=$row['Image'];
                $p = new Pizzas($id_pizza, $precio, $personalizada, $nombre, $image);
                $arrayPizzas[$i] = $p;
                $i += 1;
            }
        }

        return $arrayPizzas;
    }

    public function get_id()
    {
        return $this->id_pizza;
    }
    public function get_precio()
    {
        return $this->precio;
    }
    public function get_presonalizada()
    {
        return $this->personalizada;
    }
    public function get_nombre()
    {
        return $this->nombre;
    }
    public function get_image()
    {
        return $this->image;
    }

   /* public static function getIngredientes(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM ingredientes";
        $resultado=$conn->query($query);

        return $resultado;
    }

    public static function getMasas(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM masas";
        $resultado=$conn->query($query);

        return $resultado;
    }

    public static function getTamanio(){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM tamaños";
        $resultado=$conn->query($query);

        return $resultado;
    }*/
}

