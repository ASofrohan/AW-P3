<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Bebidas.php';

class FormularioBebidas extends Form
{
    public function __construct() {
        parent::__construct('formBebidas');
    }

    public function bebidas(){
        $bebidas = Bebidas::muestraBebidas();
        $bebidaString="";
        $i=1;
        $bebidaString = $bebidaString . '<div class="row">';
        foreach ($bebidas as $val) {
            $bebidaString = $bebidaString . '<div class="col-md-3">';
            $id=$val->get_id();
            $nombre=$val->get_nombre();
            $image=$val->get_image();
            $precio=$val->get_precio();

            $bebidaString = $bebidaString . '<form id="form" name="form" method="post" autocomplete="off">';
                $bebidaString = $bebidaString . '<h2>' . $nombre . '</h2>';
                $bebidaString = $bebidaString . '<img src="' . $image . '" WIDTH=250 HEIGHT=250 class="img-fluid">';
                ////
                $bebidaString = $bebidaString . '<input type="number" name="'.$nombre.'" id="control" min="0" step="1" value="1">';
                ////
                $bebidaString = $bebidaString . ' <h3>Precio:</h3> 
                <p id="precio">  ' . $precio . '</p>';
                $bebidaString = $bebidaString . '<input class="btn btn-outline-success" name="'.$i.'" type="submit" id="'.$i.'" value="Añadir"/>';
                if(isset($_SESSION["esAdmin"])){
                    $admin="admin".$i;
                    $bebidaString = $bebidaString . '&nbsp;<input class="btn btn-outline-danger" name="'.$admin.'" type="submit" id="'.$i.'" value="Borrar"/>';
                }else $admin=null;
            $bebidaString = $bebidaString . '</form>';
            //++$i;
            

            ////////////////////////////77
            $app = Aplicacion::getInstancia();
            $db = $app->conexionBd();
            if(isset($_SESSION['login'])){//resolver esto, que sale un mensaje arriba
                //basicamente que si no esta registrado vea las pizzas pero lo de pedir no funcione
                $co=$_SESSION['correo'];
           
                $obtencionIdBebidaPedida=array();

                $query1="SELECT * FROM pedidos_bebidas";
                $resultado1=$db->query($query1);
                $row_cnt = mysqli_num_rows($resultado1);
                
                while($row = $resultado1->fetch_assoc()) {
                    array_push($obtencionIdBebidaPedida,$row['ID_BebidaPedida']);
                }
                for($j=0;$j<$row_cnt;$j++){
                    $idPP=$obtencionIdBebidaPedida[$j];
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
                    $obtencionIdPizzaPedida=array();
                    for($j=0;$j<$row_cnt;$j++){
                        $idpedido=$obtencionIdPedido[$j];
                    }
                    $resultado1->free();

                    $query4="INSERT INTO pedidos(ID_Pedido,Usuario,Oferta,Fecha,Estado,FechaC) VALUES($idpedido+1,'$co',4,CURDATE(),1,0000-00-00)";
                    $resultado4=$db->query($query4);
                    $idPedido=$idpedido+1;
                }
                $resultado2->free();
                
                //modificar esto, los valores de las masasa, tamaños
                if(isset($_POST[$i])){
                    for($j=1; $j<=$_POST[$nombre]; $j++){
                        $query="INSERT INTO pedidos_bebidas(ID_BebidaPedida,ID_Pedido,ID_Bebida) VALUES($idPP+$j, $idPedido, $id)";
                        $resultado=$db->query($query);
                    }
                }

                if(isset($_POST[$admin])){
                    $query="DELETE FROM pedidos_bebidas WHERE ID_Bebida=$id";
                    $resultado=$db->query($query);

                    $query="DELETE FROM bebidas WHERE ID_Bebida=$id";
                    $resultado=$db->query($query);
                    header("Location:Bebidas.php");
                }
            }
            ++$i;
            $bebidaString = $bebidaString . '</div>';
        }
        if(isset($_SESSION["esAdmin"])){
            // $html=self::añadirBebidaAdmin();
             $bebidaString = $bebidaString . '<div class="col-md-3">';
             /*$pizzaString = $pizzaString . '
             <form>
                 <label for="pizza">Nombre bebida:</label><br>
                 <input type="text" id="pizza" name="pizza"><br>
                 <label for="precio">Precio:</label><br>
                 <input type="number" step="any" id="precio" name="precio"><br>
                 <label for="imagen">Nombre imagen:</label><br>
                 <input type="text" id="imagen" name="imagen"><br><br>
                 <input name="add" type="submit" id="add" value="Añadir"/>
             </form>*/
             $bebidaString = $bebidaString . '
             <h2>Añadir Bebida</h2>
             <form action="" enctype="multipart/form-data" method="post">
                 <label for="bebida">Nombre bebida:</label><br>
                 <input type="text" id="bebida" name="bebida"><br>
                 <label for="precio">Precio:</label><br>
                 <input type="number" step="any" id="precio" name="precio"><br>
                 <label for="img">Imagen:</label><br>
                 <input type="file" id="imagen" name="imagen"><br><br>
                 <input class="btn btn-outline-success" name="add" type="submit" id="add" value="Añadir"/>
             </form>
             ';
             $bebidaString = $bebidaString . '</div>';

             if(isset($_POST['add'])){
                $errors= array();
                $file_name = $_FILES['imagen']['name'];
                $file_size = $_FILES['imagen']['size'];
                $file_tmp = $_FILES['imagen']['tmp_name'];
                $file_type = $_FILES['imagen']['type'];
               // $file_ext=strtolower(end(explode('.',$_FILES['imagen']['name'])));
                $file_ext=pathinfo($file_name, PATHINFO_EXTENSION);

                $extensions= array("jpeg","jpg","png");
                
                if(in_array($file_ext,$extensions)=== false){
                    $errors[]="Extension de fichero no permitida. Solo jpeg,jpg y png.";
                }
                
                if($file_size > 2097152) {
                    $errors[]='Tamaño maximo de imagen superado';
                }
                
                if(empty($errors)==true) {
                    move_uploaded_file($file_tmp,"images/bebidas/".$file_name);
                }else{
                    $pizzaString = $pizzaString . $errors;
                }

                $nombre = $_POST["bebida"];
                $precio = $_POST["precio"];
                $image = "images/bebidas/" . $file_name;

                $query="INSERT INTO bebidas(ID_Bebida,Nombre,Precio,Imagen) VALUES ($i,'$nombre','$precio', '$image')";
                $resultado=$db->query($query);
            }
        } 
        
        $bebidaString = $bebidaString . '</div>';
        return $bebidaString;
    }

    
   /* public static function añadirBebidaAdmin(){
        $formulario='<h2>Añadir nueva bebida</h2>';
        $formulario=$formulario.'
            <form>
                <label for="bebida">Nombre:</label><br>
                <input type="text" id="bebida" name="bebida"><br>
                <label for="precio">Precio:</label><br>
                <input type="number" step="any" id="precio" name="precio"><br>
                <label for="imagen">Nombre imagen:</label><br>
                <input type="text" id="imagen" name="imagen"><br><br>
                <input name="add" type="submit" id="add" value="Añadir"/>
            </form>
        ';
        return $formulario;
    }*/
}
?>