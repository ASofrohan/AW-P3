<?php
require_once __DIR__.'/Aplicacion.php';

class Pizzas
{
    private $id_pizza;
    private $precio;
    private $personalizada;
    private $nombre;

    private function __construct($id_pizza, $precio, $personalizada, $nombre)
    {
        $this->$id_pizza = $id_pizza;
        $this->$precio = $precio;
        $this->$personalizada = $personalizada;
        $this->$nombre = $nombre;
    }

    public static function getTabla($nombre){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM $nombre";
        $resultado=$conn->query($query);

        return $resultado;
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

