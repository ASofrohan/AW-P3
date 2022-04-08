<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Pizzas.php';
require_once __DIR__.'/Masas.php';
require_once __DIR__.'/Tamaños.php';

class FormularioPersonalizada extends Form
{
    public function __construct() {
        parent::__construct('formPersonalizada');
    }
    
    public function formularioIngredintes(){
        //$ingredientes = Pizzas::getIngredientes();
        $ingredientes = Pizzas::getTabla('ingredientes');
        echo '<p>INGREDIENTES: </p>';
        echo '<form action="#" method="post" id=ingredientes_cb>';
        while($row = $ingredientes->fetch_assoc()) {
            echo '<input type="checkbox" name="ingredientes[]" value="' . $row['Precio'] . '" id="' . $row['ID_Ingrediente'] . '" onClick=recalcularPrecio(this) /> ' . $row['Nombre'] . '</br>';
        }
        echo '</form>';
    }

    public function formularioTamanio(){
       // $tamanio = Pizzas::getTamanio();
       $tamanio = Pizzas::getTabla('tamaños');

        echo '<p>TAMAÑO: </p>';
        echo '<select name="tamaños" onchange=precioTam(this)>';
        echo'<option disabled selected>seleccione una opción</option>';
        while($row = $tamanio->fetch_assoc()) {
            echo '<option value="' . $row["Precio"] .'" onClick=precioTam(this)> ' . $row["Tamaño"] . ' </option>';
        }
        echo '</select>';
    } 

    public function formularioMasa(){
        //$tamanio = Pizzas::getMasas();
        $masas = Pizzas::getTabla('masas');

        echo '<p>MASA: </p>';
        echo '<select name="masas">';
        echo'<option disabled selected>seleccione una opción</option>';
        while($row = $masas->fetch_assoc()) {
            echo '<option value="' . $precioIn .'" > ' . $row["Tipo"] . ' </option>';
        }
        echo '</select>';
    } 

    public function pizzas(){
        $pizzas = Pizzas::muestraPizzas();
        $pizzaString="";

        foreach ($pizzas as $val) {
            $nombre=$val->get_nombre();
            $image=$val->get_image();
            $precio=$val->get_precio();

            $pizzaString=$pizzaString . '<h2>' . $nombre . '</h2>
            <a href="editorPizza.php"><img src="' . $image . '" WIDTH=250 HEIGHT=250></a>
            <p>Precio:</p> ' . $precio;
        }
        return $pizzaString;
    }

    public function formulario(){
        $masas = Masas::muestraMasas();
        $html='<select name="masas">
        <option disabled selected>seleccione una opción</option>';

        foreach ($masas as $val) {
            $tipo=$val->get_tipo();

            $html = $html . '<option> ' . $tipo . ' </option>';
        }
        $html = $html . '</select></br>';

        $tamaños = Tamaños::muestraTamaños();
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