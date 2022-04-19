<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Ofertas.php';

class FormularioOfertas extends Form{

    public function __construct(){
        parent::__construct('formOfertas');
    }

    public function ofertas(){
        $ofertas = Ofertas::muestraOfertas();
        $ofertaString="";
        $i=1;
        foreach ($ofertas as $val){
            $tipo=$val->get_tipo();
            $codigo=$val->get_codigo();
            $descuento=$val->get_descuento();
              
            if($tipo != 3){
                $ofertaString = $ofertaString . '<form id="form" name="form" method="post" autocomplete="off">';
                $ofertaString = $ofertaString . '<h2>' . $codigo . '</h2>';
                $ofertaString = $ofertaString . '<input name="'.$i.'" type="submit" id="'.$i.'"value="Aplicar"/>';
                $ofertaString = $ofertaString . '</form>';
            }else{
                $ofertaString = $ofertaString . '<form id="form" name="form" method="post" autocomplete="off">';
                $ofertaString = $ofertaString . '<h2>Eliminar oferta</h2>';
                $ofertaString = $ofertaString . '<input name="'.$i.'" type="submit" id="'.$i.'"value="Aplicar"/>';
                $ofertaString = $ofertaString . '</form>';
            }

            ////////////////////////////
            $app = Aplicacion::getInstancia();
            $db = $app->conexionBd();

            if(isset($_SESSION['login'])){
                $co=$_SESSION['correo'];
           
                $query1="SELECT * FROM pedidos_bebidas";
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

                    $query4="INSERT INTO pedidos(ID_Pedido,Usuario,Oferta,Fecha,Estado) VALUES($row_cnt3+1,'$co',$i,0000-00-00,1)";
                    $resultado4=$db->query($query4);
                    $idPedido=$row_cnt3+1;
                }
                if(isset($_POST[$i])){
                    $query="UPDATE pedidos SET Oferta='$i' WHERE Usuario ='$co' AND ID_Pedido='$idPedido'";
                    $resultado=$db->query($query);
                }
            }

            $i++;
        }
        return $ofertaString;
    }
}