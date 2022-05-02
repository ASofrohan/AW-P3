<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Pizzas.php';
require_once __DIR__.'/Masas.php';
require_once __DIR__.'/Tamanios.php';
require_once __DIR__.'/Ingredientes.php';

class FormularioPersonalizada extends Form
{
    public function __construct() {
        parent::__construct('formPersonalizada');
    }

    public function pizzas(){
        $pizzas = Pizzas::muestraPizzas();
        $pizzaString="";
        $i=1;
        $pizzaString = $pizzaString . '<div class="row">';
        foreach ($pizzas as $val) {
            $pizzaString = $pizzaString . '<div class="col-md-3">';
            $nombre=$val->get_nombre();
            $image=$val->get_image();
            $precio=$val->get_precio();
            $pers=$val->get_personalizada();
            $formulario=self::formularioPersonalizada();

            $pizzaString = $pizzaString . '<h2>' . $nombre . '</h2>';
            $pizzaString = $pizzaString . '<form id="form" name="form" method="post" autocomplete="off">';
            if($pers==1){
                $pizzaString = $pizzaString . '<a href="editorPizza.php"><img src="' . $image . '" WIDTH=250 HEIGHT=250 class="img-fluid"></a>';
            }
            else{
                $pizzaString = $pizzaString . '<img src="' . $image . '" WIDTH=250 HEIGHT=250 class="img-fluid">';
                $pizzaString = $pizzaString . $formulario;
                //++$i;
            }

            $pizzaString = $pizzaString . ' <h3>Precio:</h3> 
            <p id="precio">  ' . $precio . '</p>';
            /*$id_precio = "precio" . $val.get_id();
            $pizzaString = $pizzaString . ' <h3>Precio:</h3> 
            <p id="'.$id_precio.'">  ' . $precio . '</p>';*/

            if($pers!=1){
                $pizzaString = $pizzaString . '<input name="'.$i.'" type="submit" id="'.$i.'"value="Añadir"/>';
            }
            
            $pizzaString = $pizzaString . '</form>';

            ////////////////////////////////////INSERCION DE PIZZAS 
            $app = Aplicacion::getInstancia();
            $db = $app->conexionBd();
            if(isset($_SESSION['login'])){//resolver esto, que sale un mensaje arriba
                //basicamente que si no esta registrado vea las pizzas pero lo de pedir no funcione
                $co=$_SESSION['correo'];
           
                $obtencionIdPizzaPedida=array();

                $query1="SELECT * FROM pedidos_pizzas";
                $resultado1=$db->query($query1);
                $row_cnt = mysqli_num_rows($resultado1);
                while($row = $resultado1->fetch_assoc()) {
                    array_push($obtencionIdPizzaPedida,$row['ID_PizzaPedida']);
                }
                for($j=0;$j<$row_cnt;$j++){
                    $idPP=$obtencionIdPizzaPedida[$j];
                }
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

                if(isset($_POST[$i]) && $pers!=1){
                    //modificar esto, los valores de las masasa, tamaños
                    $masa = $_POST['masas'];
                    $tamanio = $_POST['tamaño'];
                    //echo'<p>'.$tamanio.'</p>';

                    $query_masa="SELECT ID_Masa FROM masas WHERE Tipo='$masa'";
                    $res_masa=$db->query($query_masa);
                    $row_masa=$res_masa->fetch_assoc();
                    $id_masa=$row_masa['ID_Masa'];

                    $query_tam="SELECT ID_Tamaño FROM tamaños WHERE Precio='$tamanio'";
                    $res_tam=$db->query($query_tam);
                    $row_tam=$res_tam->fetch_assoc();
                    $id_tamanio=$row_tam['ID_Tamaño'];

                    ////////////////
                    $query="INSERT INTO pedidos_pizzas(ID_PizzaPedida,ID_Pedido,ID_Pizza,ID_Masa,ID_Tamaño) VALUES($idPP+1, $idPedido, $i, $id_masa, $id_tamanio)";
                    $resultado=$db->query($query);
                }
                ++$i;
            }
            $pizzaString = $pizzaString . '</div>';
        }
        if(isset($_SESSION["esAdmin"])){
            // $html=self::añadirBebidaAdmin();
             $pizzaString = $pizzaString . '<div class="col-md-3">';
             $pizzaString = $pizzaString . '
             <form>
                 <label for="pizza">Nombre pizza:</label><br>
                 <input type="text" id="bebida" name="bebida"><br>
                 <label for="precio">Precio:</label><br>
                 <input type="number" step="any" id="precio" name="precio"><br>
                 <label for="imagen">Nombre imagen:</label><br>
                 <input type="text" id="imagen" name="imagen"><br><br>
                 <input name="add" type="submit" id="add" value="Añadir"/>
             </form>
             ';
             $pizzaString = $pizzaString . '</div>';
        } 
        $pizzaString = $pizzaString . '</div>';
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

            $html = $html . '<option>' . $tipo . ' </option>';
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
        $app = Aplicacion::getInstancia();
            $db = $app->conexionBd();
        $masas = Ingredientes::muestraIngredientes();
        $html = '<img src="images/pizzas/pers.jpg" ALIGN=left WIDTH=300 HEIGHT=300>';
        $html = $html . '<h4>INGREDIENTES: </h4>';
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
        $html = $html . '<select name="t_personalizada" onchange=precioTam(this)>
        <option disabled selected>seleccione una opción</option>';

        foreach ($tamaños as $val) {
            $tamaño=$val->get_tamaño();
            $precio=$val->get_precio();
            $html = $html . '<option value="'.$precio.'"> ' . $tamaño . ' </option>';
        }
        $html = $html . '</select>';

        $html = $html . '<h3>Precio: </h3>';
        $html = $html . '<p id= "precio">4.99</p>';
        $html=$html.'<form id="form" name="form" method="post" autocomplete="off">';
        $html = $html . '<input name="pers" type="submit" id="3"value="Añadir"/>';
        /////////////////////////////////////////////////////////
        if(isset($_SESSION['login'])){//resolver esto, que sale un mensaje arriba
            //basicamente que si no esta registrado vea las pizzas pero lo de pedir no funcione
            $co=$_SESSION['correo'];
       
            $obtencionIdPizzaPedida=array();

            $query1="SELECT * FROM pedidos_pizzas";
            $resultado1=$db->query($query1);
            $row_cnt = mysqli_num_rows($resultado1);
            while($row = $resultado1->fetch_assoc()) {
                array_push($obtencionIdPizzaPedida,$row['ID_PizzaPedida']);
            }
            for($j=0;$j<$row_cnt;$j++){
                $idPP=$obtencionIdPizzaPedida[$j];
            }
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
        }
        if(isset($_POST['pers'])){
            //modificar esto, los valores de las masasa, tamaños
            $query="INSERT INTO pedidos_pizzas(ID_PizzaPedida,ID_Pedido,ID_Pizza,ID_Masa,ID_Tamaño) VALUES($idPP+1, $idPedido, 3, 1,1)";
            $resultado=$db->query($query);
        }

        $app = Aplicacion::getInstancia();
        $db = $app->conexionBd();
        if(isset($_SESSION['login'])){//resolver esto, que sale un mensaje arriba
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
            //echo'<p>fuera</p>';
            

        }

        return $html;
    }
}
?>