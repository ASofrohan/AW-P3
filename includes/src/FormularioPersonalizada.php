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
            $pers=$val->get_personalizada();
            $formulario=self::formularioPersonalizada();
           /* $pizzaString = $pizzaString . '<h2>'' . $nombre . </h2>
            <a href="editorPizza.php"><img src="' . $image . '" WIDTH=250 HEIGHT=250></a>
            <h3>Precio:</h3> ' . $precio;*/
            $pizzaString = $pizzaString . '<h2>' . $nombre . '</h2>';
            if($pers==1){
                $pizzaString = $pizzaString . '<a href="editorPizza.php"><img src="' . $image . '" WIDTH=250 HEIGHT=250></a>';
            }
            else{
                $pizzaString = $pizzaString . '<img src="' . $image . '" WIDTH=250 HEIGHT=250>';

            }

            $pizzaString = $pizzaString . $formulario;
            
            $pizzaString = $pizzaString . ' <h3>Precio:</h3> ' . $precio;
        }
        return $pizzaString;
    }

    public function formularioPersonalizada(){
        $masas = Masas::muestraMasas();
        $html= '<h4>MASAS: </h4>';
        $html= $html . '<select name="masas">
        <option disabled selected>seleccione una opción</option>';

        foreach ($masas as $val) {
            $tipo=$val->get_tipo();

            $html = $html . '<option> ' . $tipo . ' </option>';
        }
        $html = $html . '</select></br>';

        $tamaños = Tamaños::muestraTamaños();
        $html= $html . '<h4>TAMAÑOS: </h4>';
        $html = $html . '<select name="tamaño" onchange="precioTam(this)">
        <option disabled selected>seleccione una opción</option>';

        foreach ($tamaños as $val) {
            $tamaño=$val->get_tamaño();

            $html = $html . '<option> ' . $tamaño . ' </option>';
        }
        $html = $html . '</select>';

        return $html;
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
        $html = $html . '<select name="tamaño" onchange="precioTam(this)">
        <option disabled selected>seleccione una opción</option>';

        foreach ($tamaños as $val) {
            $tamaño=$val->get_tamaño();

            $html = $html . '<option> ' . $tamaño . ' </option>';
        }
        $html = $html . '</select>';

        $html = $html . '<h3>Precio: </h3>';
        $html = $html . '<p id= "precio"> 0 </p>';
        echo '<script> initPrecio(5) </script>';
        return $html;
    }
}
?>