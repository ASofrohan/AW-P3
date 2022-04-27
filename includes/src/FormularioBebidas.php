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
            $nombre=$val->get_nombre();
            $image=$val->get_image();
            $precio=$val->get_precio();

            $bebidaString = $bebidaString . '<form id="form" name="form" method="post" autocomplete="off">';
                $bebidaString = $bebidaString . '<h2>' . $nombre . '</h2>';
                $bebidaString = $bebidaString . '<img src="' . $image . '" WIDTH=250 HEIGHT=250 class="img-fluid">';
                $bebidaString = $bebidaString . ' <h3>Precio:</h3> 
                <p id="precio">  ' . $precio . '</p>';
                $bebidaString = $bebidaString . '<input name="'.$i.'" type="submit" id="'.$i.'" value="Añadir"/>';
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
                if(isset($_POST[$i])){
                    $query="INSERT INTO pedidos_bebidas(ID_BebidaPedida,ID_Pedido,ID_Bebida) VALUES($idPP+1, $idPedido, $i)";
                    $resultado=$db->query($query);
                }
            }
            ++$i;
            $bebidaString = $bebidaString . '</div>';
        }
        $bebidaString = $bebidaString . '</div>';
        return $bebidaString;
    }
}
?>