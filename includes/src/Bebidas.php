<?php
require_once __DIR__.'/Aplicacion.php';

class Bebidas
{

    private $id_bebida;

    private $nombre;

    private $precio;

    private function __construct($id_bebida, $nombre, $precio)
    {
        $this->id_bebida= $id_bebida;
        $this->nombre = $nombre;
        $this->precio = $precio;

    }

}


