<?php
require_once __DIR__.'/Aplicacion.php';

class Pizzas
{
    private $id_pizza;
    private $precio;
    private $personalizada;
    private $nombre;
    private $image;

    public function __construct($id_pizza, $precio, $personalizada, $nombre, $image)
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
                $image=$row['Imagen'];
                $p = new Pizzas($id_pizza, $precio, $personalizada, $nombre, $image);
                $arrayPizzas[$i] = $p;
                $i += 1;
            }
        }

        $pizzas->free();

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
    public function get_personalizada()
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
}

