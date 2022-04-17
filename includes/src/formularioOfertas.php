<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Ofertas.php';

class FormularioOfertas extends Form{

    public function __construct(){
        parent::__construct('formOfertas');
    }

    public function ofertas(){
        $ofertas = Ofertas::muestraOfertas();
        $ofertaString="";

        foreach ($ofertas as $val){
            $tipo=$val->get_tipo();
            $codigo=$val->get_codigo();
            $descuento=$val->get_descuento();

            if($tipo != 3){
                $ofertaString = $ofertaString . '<h2>' . $codigo . '</h2>';
                $pizzaString = $pizzaString . ' <button>Aplicar</button>';
            }
        }
        return $ofertaString;
    }

    public function ofertaAñadida(){
        $mensaje = "<p>Oferta aplicada</p>";
        return $mensaje;
    }
}