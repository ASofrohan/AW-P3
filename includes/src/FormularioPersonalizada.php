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
            /*if($pers==1)
                $formulario=self::formulario();
            else
                $formulario=self::formularioPersonalizada();*/

            $pizzaString = $pizzaString . '<h2>' . $nombre . '</h2>';
            if($pers==1){
                $pizzaString = $pizzaString . '<a href="editorPizza.php"><img src="' . $image . '" WIDTH=250 HEIGHT=250></a>';
            }
            else{
                $pizzaString = $pizzaString . '<img src="' . $image . '" WIDTH=250 HEIGHT=250>';
                $pizzaString = $pizzaString . $formulario;
            }

            $pizzaString = $pizzaString . ' <h3>Precio:</h3> 
            <p id="precio">  ' . $precio . '</p>';
            $pizzaString = $pizzaString . ' <button>Añadir</button>';
            
            /*if($pers!=1)
            $pizzaString = $pizzaString . ' <h3>Precio:</h3> ' . $precio;
            $pizzaString = $pizzaString . $formulario;
            $pizzaString = $pizzaString . $nombre;*/
            ////////////////////////////////////INSERCION DE PIZZAS 
            $app = Aplicacion::getInstancia();
            $db = $app->conexionBd();
            if($_SESSION['login']==true){//resolver esto, que sale un mensaje arriba
                //basicamente que si no esta registrado vea las pizzas pero lo de pedir no funcione
                $co=$_SESSION['correo'];
           
                $query1="SELECT * FROM pedidos_pizzas";
                $resultado1=$db->query($query1);
                $row_cnt = mysqli_num_rows($resultado1);
                
                $query2="SELECT ID_Pedido FROM pedidos WHERE Usuario='$co' AND Estado=1";
                $resultado2=$db->query($query2);
                $row_cnt2 = mysqli_num_rows($resultado2);
                if($row_cnt2!=0){//tiene pedidos activos
                    if(	$row = $resultado2->fetch_assoc())
                        $idPedido= $row['ID_Pedido']; 
                }else{//no tiene pedidos, hay que meterle
                    $query3="SELECT * FROM pedidos ";
                    $resultado3=$db->query($query3);
                    $row_cnt3 = mysqli_num_rows($resultado3);

                    $query4="INSERT INTO pedidos(ID_Pedido,Usuario,Oferta,Fecha,Estado) VALUES($row_cnt3+1,'$co',4,0000-00-00,1)";
                    $resultado4=$db->query($query4);
                    $idPedido=$row_cnt3+1;
                }
                //modificar esto, los valores de las masasa, tamaños
                $query="INSERT INTO pedidos_pizzas(ID_PizzaPedida,ID_Pedido,ID_Pizza,ID_Masa,ID_Tamaño) VALUES($row_cnt+1, $idPedido, 1, 1,1)";
                $resultado=$db->query($query);
            }
        }
        return $pizzaString;
    }
public function procesarPedido(){

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
            $precio=$val->get_precio();
            $html = $html . '<option value="'.$precio.'"> ' . $tamaño . ' </option>';
        }
        $html = $html . '</select>';
        $html = $html .'<br>';
        return $html;
    }

    public function procesarPedidoTamaño($tamaño,$tipo ){
        header("Location:carrito.php");
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
        $html = $html . '<select name="tamaño" onchange=precioTam(this)>
        <option disabled selected>seleccione una opción</option>';

        foreach ($tamaños as $val) {
            $tamaño=$val->get_tamaño();
            $precio=$val->get_precio();
            $html = $html . '<option value="'.$precio.'"> ' . $tamaño . ' </option>';
        }
        $html = $html . '</select>';

        $html = $html . '<h3>Precio: </h3>';
        $html = $html . '<p id= "precio"> 0 </p>';
        echo '<script> initPrecio(5) </script>';
        return $html;
    }
}
?>