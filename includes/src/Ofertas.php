<?php
require_once __DIR__.'/Aplicacion.php';

class Oferta{

    __construct(){
        if(isset($_SESSION["login"])){
           
            $nombre=$_SESSION["nombre"];
            self::mostrarOfertas();
       }else{
           echo'no esta registrado';
       }

    }

    mostrarOfertas(){
        
    }



}