<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Pizzas.php';

class FormularioPesonalizada extends Form
{
    public function __construct() {
        parent::__construct('formPersonalizada');
    }
    
    public function formulario(){
        $ingredientes = Pizzas::getIngredientes();
        $masas = Pizzas::getMasas();
        $tamnios = Pizzas::getTamanios();

        echo '<p>INGREDIENTES: </p>';
        echo '<form action="#" method="post" id=ingredientes_cb>';
        while($row = $ingredientes->fetch_assoc()) {
            echo '<input type="checkbox" name="ingredientes[]" value="' . $row['Precio'] . '" id="' . $row['ID_Ingrediente'] . '" onClick=recalcularPrecio(this) /> ' . $row['Nombre'] . '</br>';
        }
        echo '</form>';
    }
}
?>