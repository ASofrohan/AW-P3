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
            $id=$val->get_id();
            $nombre=$val->get_nombre();
            $image=$val->get_image();
            $precio=$val->get_precio();
            $pers=$val->get_personalizada();
            $formulario=self::formularioPersonalizada();

            $pizzaString = $pizzaString . '<h2>' . $nombre . '</h2>';
            $pizzaString = $pizzaString . '<form id="form" name="form" method="post" autocomplete="off">';
            if($pers==1 && isset($_SESSION['login'])){
                $pizzaString = $pizzaString . '<a href="editorPizza.php"><img src="' . $image . '" WIDTH=250 HEIGHT=250 class="img-fluid"></a>';
            }
            else{
                $pizzaString = $pizzaString . '<img src="' . $image . '" WIDTH=250 HEIGHT=250 class="img-fluid">';
                $pizzaString = $pizzaString . $formulario;
                //++$i;
            }

            $pizzaString = $pizzaString . ' <h3>Precio:</h3> 
            <p id="precio">  ' . $precio . '</p>';
            if(isset($_SESSION["esAdmin"])){
                $admin="admin".$i;
                $pizzaString = $pizzaString . '&nbsp;<input class="btn btn-outline-danger" name="'.$admin.'" type="submit" id="'.$i.'" value="Borrar"/>';
            }else $admin=null;
            /*$id_precio = "precio" . $val.get_id();
            $pizzaString = $pizzaString . ' <h3>Precio:</h3> 
            <p id="'.$id_precio.'">  ' . $precio . '</p>';*/

            if($pers!=1){
                $pizzaString = $pizzaString . '<input class="btn btn-outline-success" name="'.$i.'" type="submit" id="'.$i.'"value="A??adir"/>';
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
                $resultado1->free();

                $query2="SELECT ID_Pedido FROM pedidos WHERE Usuario='$co' AND Estado=1";
                $resultado2=$db->query($query2);
                $row_cnt2 = mysqli_num_rows($resultado2);
                if($row_cnt2!=0){//tiene pedidos activos
                    if(	$row = $resultado2->fetch_assoc())
                        $idPedido= $row['ID_Pedido']; 
                }else{//no tiene pedidos, hay que meterle
                    $obtencionIdPedido=array();

                    $query1="SELECT * FROM pedidos";
                    $resultado1=$db->query($query1);
                    $row_cnt = mysqli_num_rows($resultado1);
                    while($row = $resultado1->fetch_assoc()) {
                        array_push($obtencionIdPedido,$row['ID_Pedido']);
                    }
                    for($j=0;$j<$row_cnt;$j++){
                        $idpedido=$obtencionIdPedido[$j];}
                    $query4="INSERT INTO pedidos(ID_Pedido,Usuario,Oferta,Fecha,Estado,FechaC) VALUES($idpedido+1,'$co',4,CURDATE(),1, 0000-00-00)";
                    $resultado4=$db->query($query4);
                    $idPedido=$idpedido+1;

                    $resultado1->free();
                }
                $resultado2->free();


                if(isset($_POST[$i]) && $pers!=1){
                    //modificar esto, los valores de las masasa, tama??os
                    $masa = $_POST['masas'];
                    $tamanio = $_POST['tama??o'];
                    //echo'<p>'.$tamanio.'</p>';

                    $query_masa="SELECT ID_Masa FROM masas WHERE Tipo='$masa'";
                    $res_masa=$db->query($query_masa);
                    $row_masa=$res_masa->fetch_assoc();
                    $id_masa=$row_masa['ID_Masa'];
                    $res_masa->free();

                    $query_tam="SELECT ID_Tama??o FROM tama??os WHERE Precio='$tamanio'";
                    $res_tam=$db->query($query_tam);
                    $row_tam=$res_tam->fetch_assoc();
                    $id_tamanio=$row_tam['ID_Tama??o'];
                    $res_tam->free();
                    ////////////////
                    $query="INSERT INTO pedidos_pizzas(ID_PizzaPedida,ID_Pedido,ID_Pizza,ID_Masa,ID_Tama??o) VALUES($idPP+1, $idPedido, $id, $id_masa, $id_tamanio)";
                    $resultado=$db->query($query);
                }

                if(isset($_POST[$admin])){
                    $query="DELETE FROM pedidos_pizzas WHERE ID_Pizza=$id";
                    $resultado=$db->query($query);
                    
                    $query="DELETE FROM pizzas WHERE ID_Pizza=$id";
                    $resultado=$db->query($query);
                    header("Location:Pizzas.php");
                }

                ++$i;
            }
            $pizzaString = $pizzaString . '</div>';
        }
        if(isset($_SESSION["esAdmin"])){
            // $html=self::a??adirBebidaAdmin();
             $pizzaString = $pizzaString . '<div class="col-md-3">';
             /*$pizzaString = $pizzaString . '
             <form>
                 <label for="pizza">Nombre pizza:</label><br>
                 <input type="text" id="pizza" name="pizza"><br>
                 <label for="precio">Precio:</label><br>
                 <input type="number" step="any" id="precio" name="precio"><br>
                 <label for="imagen">Nombre imagen:</label><br>
                 <input type="text" id="imagen" name="imagen"><br><br>
                 <input name="add" type="submit" id="add" value="A??adir"/>
             </form>*/
             $pizzaString = $pizzaString . '
             <h2>A??adir Pizza</h2>
             <form action="" enctype="multipart/form-data" method="post">
                 <label for="pizza">Nombre pizza:</label><br>
                 <input type="text" id="pizza" name="pizza"><br>
                 <label for="precio">Precio:</label><br>
                 <input type="number" step="any" id="precio" name="precio"><br>
                 <label for="img">Nombre imagen:</label><br>
                 <input type="file" id="imagen" name="imagen"><br><br>
                 <input class="btn btn-outline-success" name="add" type="submit" id="add" value="A??adir"/>
             </form>
             ';
             $pizzaString = $pizzaString . '</div>';

             if(isset($_POST['add'])){
                /*$nombre = $_GET["pizza"];
                $precio = $_GET["precio"];
                $image = "images/pizzas/" . $_GET["imagen"];

                $query="INSERT INTO pizzas(ID_Pizza,Precio,Personalizada,Nombre,Imagen) VALUES ($i,'$precio', 0, '$nombre', '$image')";
                $resultado=$db->query($query);*/
                $errors= array();
                $file_name = $_FILES['imagen']['name'];
                $file_size = $_FILES['imagen']['size'];
                $file_tmp = $_FILES['imagen']['tmp_name'];
                $file_type = $_FILES['imagen']['type'];
                //$file_ext=strtolower(end(explode('.',$_FILES['imagen']['name'])));
                $file_ext=pathinfo($file_name, PATHINFO_EXTENSION);

                $extensions= array("jpeg","jpg","png");
                
                if(in_array($file_ext,$extensions) == false){
                    $errors[]="Extension de fichero no permitida. Solo jpeg,jpg y png.";
                }
                
                if($file_size > 2097152) {
                    $errors[]='Tama??o maximo de imagen superado';
                }
                
                if(empty($errors)==true) {
                    move_uploaded_file($file_tmp,"images/pizzas/".$file_name);
                }else{
                   // print_r($errors);
                   $pizzaString = $pizzaString . $errors;
                }

                $nombre = $_POST["pizza"];
                $precio = $_POST["precio"];
                $image = "images/pizzas/" . $file_name;

                $query="INSERT INTO pizzas(ID_Pizza,Precio,Personalizada,Nombre,Imagen) VALUES ($i,'$precio', 0, '$nombre', '$image')";
                $resultado=$db->query($query);
            }
        } 
        $pizzaString = $pizzaString . '</div>';
        return $pizzaString;
    }
public function procesarPedido(){

}
    public function formularioPersonalizada(){
        $masas = Masas::muestraMasas();
        $html= '<h4>MASAS: </h4>';
        $html= $html . '<select name="masas">';
        //<option disabled selected>seleccione una opci??n</option>';

        foreach ($masas as $val) {
            $tipo=$val->get_tipo();

            $html = $html . '<option>' . $tipo . ' </option>';
        }
        $html = $html . '</select></br>';

        $tama??os = Tama??os::muestraTama??os();
        $html= $html . '<h4>TAMA??OS: </h4>';
        $html = $html . '<select name="tama??o" onchange="precioTam(this)">';
        //<option disabled selected>seleccione una opci??n</option>';

        foreach ($tama??os as $val) {
            $tama??o=$val->get_tama??o();
            $precio=$val->get_precio();
            $html = $html . '<option value="'.$precio.'"> ' . $tama??o . ' </option>';
        }
        $html = $html . '</select>';
        $html = $html .'<br>';
        return $html;
    }

    public function procesarPedidoTama??o($tama??o,$tipo ){
        header("Location:carrito.php");
    }

    public function formulario(){
        $app = Aplicacion::getInstancia();
            $db = $app->conexionBd();
       
        //////////
        $html='<div class="row">';
            /////////
            $html=$html . '<div class="col-md-3">';
            $html = $html . '<img src="images/pizzas/pers.jpg" ALIGN=left WIDTH=300 HEIGHT=300>';
        $html=$html . '</div>';
            $html=$html . '<div class="col-md-3">';

                $masas = Masas::muestraMasas();
                $html= $html . '<h4>MASAS: </h4>';
                $html= $html . '<select name="masas">';
                //<option disabled selected>seleccione una opci??n</option>';

                foreach ($masas as $val) {
                    $tipo=$val->get_tipo();

                    $html = $html . '<option> ' . $tipo . ' </option>';
                }
                $html = $html . '</select></br>';

                $tama??os = Tama??os::muestraTama??os();
                $html= $html . '<h4>TAMA??OS: </h4>';
                $html = $html . '<select name="t_personalizada" onchange=precioTam(this)>';
                //<option disabled selected>seleccione una opci??n</option>';

                foreach ($tama??os as $val) {
                    $tama??o=$val->get_tama??o();
                    $precio=$val->get_precio();
                    $html = $html . '<option value="'.$precio.'"> ' . $tama??o . ' </option>';
                }
                $html = $html . '</select>';
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
            $resultado1->free();

            $query2="SELECT ID_Pedido FROM pedidos WHERE Usuario='$co' AND Estado=1";
            $resultado2=$db->query($query2);
            $row_cnt2 = mysqli_num_rows($resultado2);
            if($row_cnt2!=0){//tiene pedidos activos
                if(	$row = $resultado2->fetch_assoc())
                    $idPedido= $row['ID_Pedido']; 
            }else{//no tiene pedidos, hay que meterle
                $obtencionIdPedido=array();
                $query1="SELECT * FROM pedidos";
                $resultado1=$db->query($query1);
                $row_cnt = mysqli_num_rows($resultado1);
                while($row = $resultado1->fetch_assoc()) {
                    array_push($obtencionIdPedido,$row['ID_Pedido']);
                }
                for($j=0;$j<$row_cnt;$j++){
                    $idpedido=$obtencionIdPizzaPedida[$j];
                }
                $resultado1->free();

                $query4="INSERT INTO pedidos(ID_Pedido,Usuario,Oferta,Fecha,Estado,FechaC) VALUES($idpedido+1,'$co',4,CURDATE(),1,0000-00-00)";
                $resultado4=$db->query($query4);
                $idPedido=$idpedido+1;
            }
            $resultado2->free();
          
        }
        $html=$html.'</div>';
        $html=$html . '<div class="col-md-3">';
        $masas = Ingredientes::muestraIngredientes();
       
            $html = $html . '<h4>INGREDIENTES: </h4>';
            $html = $html . '<form action="#" method="post" id=ingredientes>';
            foreach ($masas as $val) {
                $nombre=$val->get_nombre();
                $precio=$val->get_precio();
                $id=$val->get_id();
                $image=$val->get_image();
                $html = $html . '<input type="checkbox" value="' . $precio . '"  id="' . $id . '" name="'.$nombre.'" onClick=recalcularPrecio(this) /> ' . $nombre;
                $html = $html . '<img src="' . $image . '"WIDTH=30 HEIGHT=30></br>';
                
            }
            
            
        $html=$html . '</div>';
        $html=$html . '<div class="col-md-3">';

        $html = $html . '<h3>Precio: </h3>';
        $html = $html . '<p id= "precio">4.99</p>';
        $html = $html . '<form id="form" name="form" method="post" autocomplete="off">';
        $html = $html . '<input class="btn btn-outline-success" name="PERS" type="submit" id="3"value="A??adir"/>';

        $html=$html.'</div>';
        $html=$html.'</div>';
      
            //modificar esto, los valores de las masasa, tama??o
            $arrayIngre=array();
            $lengt=count($masas);
            if(isset($_POST["PERS"])){
                $masa = $_GET['masas'] ?? null;
                $tamanio = $_GET['t_personalizada'] ?? null;
                echo'<p>'.$tamanio.'</p>';

               /* $query_masa="SELECT ID_Masa FROM masas WHERE Tipo='$masa'";
                $res_masa=$db->query($query_masa);
                $row_masa=$res_masa->fetch_assoc();
                $id_masa=$row_masa['ID_Masa'];

                $query_tam="SELECT ID_Tama??o FROM tama??os WHERE Precio='$tamanio'";
                $res_tam=$db->query($query_tam);
                $row_tam=$res_tam->fetch_assoc();
                $id_tamanio=$row_tam['ID_Tama??o'];*/

                $query="INSERT INTO pedidos_pizzas(ID_PizzaPedida,ID_Pedido,ID_Pizza,ID_Masa,ID_Tama??o) VALUES($idPP+1, $idPedido, 3, 1,1)";   
                $resultado=$db->query($query);
            }
            foreach ($masas as $val) {
                
                $nombre=$val->get_nombre();
                $id=$val->get_id();
                $obtencionIdPizzaPedida=array();
                $query1="SELECT * FROM pizza_ingredientes";
                $resultado1=$db->query($query1);
                $row_cnt = mysqli_num_rows($resultado1);
                while($row = $resultado1->fetch_assoc()) {
                    array_push($obtencionIdPizzaPedida,$row['ID_IngredientePizza']);
                }
                if($row_cnt==0)$idIP=0;
                else{
                    for($j=0;$j<$row_cnt;$j++){
                        $idIP=$obtencionIdPizzaPedida[$j];
                    }
                }
               //cuando se pulsa en la imagen personalizada , como llama a esta funcion, se mete una pizza y luego cuando elegimos un ingreiente, se mete otra vez, entonces se meten 2.
                   
                    if(isset($_POST["$nombre"])){
                       


                        ///
                        $query="INSERT INTO pizza_ingredientes(ID_IngredientePizza,ID_PizzaPedida,ID_Ingrediente) VALUES($idIP+1,$idPP+1, $id)";
                        $resultado=$db->query($query);

                    }
                   
                $resultado1->free();
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
                $obtencionIdPedido=array();
                $query1="SELECT * FROM pedidos";
                $resultado1=$db->query($query1);
                $row_cnt = mysqli_num_rows($resultado1);
                while($row = $resultado1->fetch_assoc()) {
                    array_push($obtencionIdPedido,$row['ID_Pedido']);
                }
                for($j=0;$j<$row_cnt;$j++){
                    $idpedido=$obtencionIdPizzaPedida[$j];
                }
             
                $query4="INSERT INTO pedidos(ID_Pedido,Usuario,Oferta,Fecha,Estado,FechaC) VALUES($idpedido+1,'$co',4,CURDATE() ,1,0000-00-00)";
                $resultado4=$db->query($query4);
                $idPedido=$idpedido+1;
            }
            //echo'<p>fuera</p>';
            

        }

        return $html;
    }
}
?>