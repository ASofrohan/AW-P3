<?php
//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/Aplicacion.php';
require_once __DIR__.'/includes/src/Pedidos.php';

$tituloPagina = 'Administracion';
$string=mostrar();
$contenidoPrincipal =<<<EOF
    $string
EOF;

$string=$string.'Hola administrador!!'.'<Br>';
function mostrar(){
    $string='';
    $app = Aplicacion::getInstancia();
    $db = $app->conexionBd();

    $pedidos = Pedidos::muestraPedidos();
    $string=$string.'<table>';
    $string=$string.'<tr>';
    $string=$string.'<th><center>ID_Pedido</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Usuario</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Oferta</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Fecha</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Estado</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Fecha Compra</th>';
    $string=$string.'<th></th>';
    $string=$string.'</tr>';
    $q=0;
    $p=100;
    foreach($pedidos as $val){
        $pedido =$val->get_idPedido();
        $user=$val->get_usuario();
        $oferta=$val->get_oferta();
        $fecha=$val->get_fecha();
        $estado=$val->get_estado();
        $fechaC=$val->get_fechaC();
        $string=$string.'<form id="form" name="form" method="post" autocomplete="off">';
        $string=$string.'<tr>';
        $string=$string.'<td><center>'.$pedido.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$user .'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$oferta.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$fecha.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$estado.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$fechaC.'</td>';
        $string=$string.'<td></td>';
       
        $string = $string . '<td><input name="'.$q.'" type="submit" id="'.$q.'"value="Eliminar"/></td>';
        $string = $string .'&nbsp';
        $string = $string . '<td><input name="'.$p.'" type="submit" id="'.$p.'"value="Editar Estado"/>';
        $string = $string .'&nbsp';
        if($estado==0)$string=$string.'pagado';else $string=$string.'pendiente';
        $string = $string .'</td>';
        $string=$string.'</form>';
        $string=$string.'</tr>';
        if(isset($_POST[$q])){
            //FALTA METER UNA NUEVA CLASE PARA OBTENER LOS IDS DE LOS INGREDIENTES
            $query4="DELETE FROM pedidos_pizzas WHERE ID_Pedido='$pedido'";
            $resultado4=$db->query($query4);
            $query4="DELETE FROM pedidos_bebidas WHERE ID_Pedido='$pedido'";
            $resultado4=$db->query($query4);
            $query4="DELETE FROM pedidos WHERE ID_Pedido='$pedido'";
            $resultado4=$db->query($query4);
            header("Location:administrar.php");
            
        }
        $q++;
        if(isset($_POST[$p])){
            //FALTA METER UNA NUEVA CLASE PARA OBTENER LOS IDS DE LOS INGREDIENTES
            if($estado==1){
                $query4="UPDATE  pedidos SET Estado=0 WHERE Estado=1 AND ID_Pedido=$pedido";
                $resultado4=$db->query($query4);}
            else{
                $query4="UPDATE  pedidos SET Estado=1 WHERE Estado=0 AND ID_Pedido=$pedido";
                $resultado4=$db->query($query4);
            }
            header("Location:administrar.php");
            
        }
        $p++;
    }
    $string=$string.'</table>';
    return $string;
}


include __DIR__.'/includes/vistas/plantillas/plantilla.php';