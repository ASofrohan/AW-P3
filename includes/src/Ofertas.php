<?php
require_once __DIR__.'/Aplicacion.php';

class Ofertas{

    public function __construct(){
        if(isset($_SESSION["login"])){
           
            $nombre=$_SESSION["nombre"];
            self::mostrarOfertas();
       }else{
           echo'no esta registrado';
       }

    }

    public function mostrarOfertas(){
        $app = Aplicacion::getInstancia();
        $db = $app->conexionBd();

        $query = "SELECT * FROM Ofertas";


    }



}