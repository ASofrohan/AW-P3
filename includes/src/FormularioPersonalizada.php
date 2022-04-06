<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Pizzas.php';

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
        $pizzas = Pizzas::getTabla('pizzas');
        echo'<div id=pizzas>';
        while($row = $pizzas->fetch_assoc()) {
                echo' <h2>'.$row["Nombre"].'</h2>';
				echo '<img src="images/pizzas/'.$row["Nombre"].'.jpg" WIDTH=250 HEIGHT=250>';
				echo '<p>'.$row["Precio"].'</p>';
                self::formulario($row["Personalizada"]);
                //echo '<a href="self::formulario('.$row["Personalizada"]')"><p>Mas info.</p>';
                echo'<a href="includes/src/FormularioPersonalizada.php">Mas Info.</a>';
		}
        echo'</div>';
    }

    public function formulario($personalizada){
        $formulario="";
        if($personalizada==1){
           $formulario = $formulario . self:: formularioIngredintes();
        }
        $formulario = $formulario . self:: formularioTamanio();
        $formulario = $formulario . self:: formularioMasa();
        //return 0;
        return $formulario;
    }
}
?>