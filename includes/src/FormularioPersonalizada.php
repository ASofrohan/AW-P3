<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Pizzas.php';
require_once __DIR__.'/Masas.php';
require_once __DIR__.'/Tamaños.php';
require_once __DIR__.'/Ingredientes.php';

class FormularioPersonalizada extends Form
{
    public function __construct() {
        parent::__construct('formPersonalizada');
    }

    public function pizzas(){
        $pizzas = Pizzas::muestraPizzas();
        $pizzaString="";

        foreach ($pizzas as $val) {
            $nombre=$val->get_nombre();
            $image=$val->get_image();
            $precio=$val->get_precio();

            $pizzaString = $pizzaString . '<h2>' . $nombre . '</h2>
            <a href="editorPizza.php"><img src="' . $image . '" WIDTH=250 HEIGHT=250></a>
            <p>Precio:</p> ' . $precio;
        }
        return $pizzaString;
    }

    public function formulario(){
        $masas = Ingredientes::muestraIngredientes();
        $html = '<h4>INGREDIENTES: </h4>';
        $html = $html . '<form action="#" method="post" id=ingredientes>';

        foreach ($masas as $val) {
            $nombre=$val->get_nombre();
            $precio=$val->get_precio();
            $id=$val->get_id();
            $image=$val->get_image();

            $html = $html . '<input type="checkbox" name="ingredientes[]" value="' . $precio . '" id="' . $id . '" onClick=recalcularPrecio(this) /> ' . $nombre;
            $html = $html . '<img src="' . $image . '"WIDTH=30 HEIGHT=30></br>';
        }
        $html = $html . '</form>';

        $masas = Masas::muestraMasas();
        $html= $html . '<h4>MASAS: </h4>';
        $html= $html . '<select name="masas">
        <option disabled selected>seleccione una opción</option>';

        foreach ($masas as $val) {
            $tipo=$val->get_tipo();

            $html = $html . '<option> ' . $tipo . ' </option>';
        }
        $html = $html . '</select></br>';

        $tamaños = Tamaños::muestraTamaños();
        $html= $html . '<h4>TAMAÑOS: </h4>';
        $html = $html . '<select name="tamaño">
        <option disabled selected>seleccione una opción</option>';

        foreach ($tamaños as $val) {
            $tamaño=$val->get_tamaño();

            $html = $html . '<option> ' . $tamaño . ' </option>';
        }
        $html = $html . '</select>';

        return $html;
    }
}
?>