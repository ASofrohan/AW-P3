<?php
//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/Aplicacion.php';
require_once __DIR__.'/includes/src/Pedidos.php';
require_once __DIR__.'/includes/src/Usuario.php';
require_once __DIR__.'/includes/src/Pizzas.php';
require_once __DIR__.'/includes/src/Bebidas.php';
require_once __DIR__.'/includes/src/Ofertas.php';

$tituloPagina = 'Administración';
$string=mostrar();
$stringUsuarios=mostrarUsuarios();
$stringPizzas=mostrarPizzas();
$stringBebidas=mostrarBebidas();
$stringOfertas=mostrarOfertas();
$contenidoPrincipal =<<<EOF
    </br>
    <div class="center">
    <h1>$tituloPagina</h1>
    </div>
    <div class="row">
    <div class="col-md-12">
	<div class="container"><div class="card" style="width: 59rem;"><div class="card-header">
    $string
    </div></div>
    <div class="col-md-12">
	<div class="container"><div class="card" style="width: 70rem;"><div class="card-header">
    $stringUsuarios
    </div></div>
    <div class="col-md-12">
	<div class="container"><div class="card" style="width: 40rem;"><div class="card-header">
    $stringPizzas
    </div></div>
    <div class="col-md-12">
	<div class="container"><div class="card" style="width: 30rem;"><div class="card-header">
    $stringBebidas
    </div></div>
    <div class="col-md-12">
	<div class="container"><div class="card" style="width: 50rem;"><div class="card-header">
    $stringOfertas
    </div></div>
    </div>
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
    $p=10;
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
       
        $string = $string . '<td><input class="btn btn-outline-danger" name="'.$q.'" type="submit" id="'.$q.'"value="Eliminar"/></td>';
        $string = $string .'&nbsp';
        $string = $string . '<td><input class="btn btn-outline-info" name="'.$p.'" type="submit" id="'.$p.'"value="Editar Estado"/>';
        $string = $string .'&nbsp';
        if($estado==0)$string=$string.'Pagado';else $string=$string.'Pendiente';
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

function mostrarUsuarios(){
    $string='';
    $app = Aplicacion::getInstancia();
    $db = $app->conexionBd();

    $usuarios = Usuario::muestraUsuarios();
    $string=$string.'<table>';
    $string=$string.'<tr>';
    $string=$string.'<th><center>Correo</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Nombre</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Apellidos</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Calle</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Ciudad</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Piso</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Codigo postal</th>';
    $string=$string.'<th></th>';
    $string=$string.'</tr>';
    $i=100;
    $j=1000;
    foreach($usuarios as $val){
        $correo =$val->getCorreo();
        $nombre=$val->getNombre();
        $apellidos=$val->getApellidos();
        $calle=$val->getCalle();
        $ciudad=$val->getCiudad();
        $piso=$val->getPiso();
        $codPostal=$val->getPostal();

        $query="SELECT * FROM usuarios WHERE Correo='$correo'";
        $resultado=$db->query($query);
        $row = $resultado->fetch_assoc();
        $admin=$row['Admin'];

        $string=$string.'<form id="form" name="form" method="post" autocomplete="off">';
        $string=$string.'<tr>';
        $string=$string.'<td><center>'.$correo.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$nombre .'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$apellidos.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$calle.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$ciudad.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$piso.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$codPostal.'</td>';
        $string=$string.'<td></td>';
        $string = $string . '<td><input class="btn btn-outline-danger" name="'.$j.'" type="submit" id="'.$j.'"value="Eliminar"/></td>';
        $string = $string .'&nbsp';
        $string = $string . '<td><input class="btn btn-outline-info" name="'.$i.'" type="submit" id="'.$i.'"value="Editar administrador"/>';
        $string = $string .'&nbsp';
            if($admin==0)$string=$string.'Cliente';else $string=$string.'Administrador';
        $string = $string .'</td>';
        $string=$string.'</form>';
        $string=$string.'</tr>';

        if(isset($_POST[$i])){
            if($admin==0){
                $query="UPDATE usuarios SET Admin=1 WHERE Correo='$correo'";
                $resultado=$db->query($query);
            }
            else{
                $query="UPDATE usuarios SET Admin=0 WHERE Correo='$correo'";
                $resultado=$db->query($query);
            }
            header("Location:administrar.php");
            
        }    
        $i++;

        if(isset($_POST[$j])){
            $query4="DELETE FROM pedidos_pizzas WHERE ID_Pedido='$pedido'";
            $resultado4=$db->query($query4);
            $query4="DELETE FROM pedidos_bebidas WHERE ID_Pedido='$pedido'";
            $resultado4=$db->query($query4);
            $query="DELETE FROM pedidos WHERE Usuario='$correo'";
            $resultado=$db->query($query);
            $query="SELECT * FROM usuarios WHERE Correo='$correo'";
            $resultado=$db->query($query);
            $row = $resultado->fetch_assoc();
            $id=$row['Domicilio'];
            $query="DELETE FROM usuarios WHERE Correo='$correo'";
            $resultado=$db->query($query);
            $query="DELETE FROM domicilios WHERE ID_Domicilio='$id'";
            $resultado=$db->query($query);
            header("Location:administrar.php");
            
        }
        $j++;
    }
    $string=$string.'</table>';
    return $string;
}

function mostrarPizzas(){
    $string='';
    $app = Aplicacion::getInstancia();
    $db = $app->conexionBd();

    $pizzas = Pizzas::muestraPizzas();
    $string=$string.'<table>';
    $string=$string.'<tr>';
    $string=$string.'<th><center>Id</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Nombre</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Personalizada</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Precio</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Imagen</th>';
    $string=$string.'<th></th>';
    $string=$string.'</tr>';
    $m=10000;
    foreach($pizzas as $val){
        $id =$val->get_id();
        $nombre=$val->get_nombre();
        $pers=$val->get_personalizada();
        $precio=$val->get_precio();
        $imagen=$val->get_image();

        $query="SELECT * FROM pizzas WHERE ID_Pizza='$id'";
        $resultado=$db->query($query);
        $row = $resultado->fetch_assoc();

        $string=$string.'<form id="form" name="form" method="post" autocomplete="off">';
        $string=$string.'<tr>';
        $string=$string.'<td><center>'.$id.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$nombre .'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$pers.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$precio.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$imagen.'</td>';
        $string=$string.'<td></td>';

        $string = $string . '<td><input class="btn btn-outline-danger" name="'.$m.'" type="submit" id="'.$m.'"value="Eliminar"/></td>';
        $string = $string .'&nbsp';
        $string=$string.'</form>';
        $string=$string.'</tr>';
 
        if(isset($_POST[$m])){
            
            $query="DELETE FROM pedidos_pizzas WHERE ID_Pizza=$id";
            $resultado=$db->query($query);
            
            $query="DELETE FROM pizzas WHERE ID_Pizza=$id";
            $resultado=$db->query($query);
            

            header("Location:administrar.php");
        }
        $m++;
    }
    $string=$string.'</table>';
    return $string;
}

function mostrarBebidas(){
    $string='';
    $app = Aplicacion::getInstancia();
    $db = $app->conexionBd();

    $bebidas = Bebidas::muestraBebidas();
    $string=$string.'<table>';
    $string=$string.'<tr>';
    $string=$string.'<th><center>Id</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Nombre</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Precio</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Imagen</th>';
    $string=$string.'<th></th>';
    $string=$string.'</tr>';
    $b=1;
    foreach($bebidas as $val){
        $id =$val->get_id();
        $nombre=$val->get_nombre();
        $precio=$val->get_precio();
        $imagen=$val->get_image();

        $query="SELECT * FROM bebidas WHERE ID_Bebida='$id'";
        $resultado=$db->query($query);
        $row = $resultado->fetch_assoc();

        $string=$string.'<form id="form" name="form" method="post" autocomplete="off">';
        $string=$string.'<tr>';
        $string=$string.'<td><center>'.$id.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$nombre .'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$precio.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$imagen.'</td>';
        $string=$string.'<td></td>';

        $string = $string . '<td><input class="btn btn-outline-danger" name="'.$b.'" type="submit" id="'.$b.'"value="Eliminar"/></td>';
        $string = $string .'&nbsp';
        $string=$string.'</form>';
        $string=$string.'</tr>';

        if(isset($_POST[$b])){
            $query="DELETE FROM pedidos_bebidas WHERE ID_Bebida=$b";
            $resultado=$db->query($query);
            
            $query="DELETE FROM bebidas WHERE ID_Bebida=$b";
            $resultado=$db->query($query);

            header("Location:administrar.php");
        }
        $b++;
    }
    $string=$string.'</table>';
    return $string;
}

function mostrarOfertas(){
    $string='';
    $app = Aplicacion::getInstancia();
    $db = $app->conexionBd();

    $ofertas = Ofertas::muestraOfertas();
    $string=$string.'<table>';
    $string=$string.'<tr>';
    $string=$string.'<th><center>Id</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Codigo</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Tipo</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Descuento</th>';
    $string=$string.'<th></th>';
    $string=$string.'<th><center>Info</th>';
    $string=$string.'<th></th>';
    $string=$string.'</tr>';
    $i=1;
    $j=0;
    foreach($ofertas as $val){
        $id =$val->get_id();
        $codigo=$val->get_codigo();
        $tipo=$val->get_tipo();
        $descuento=$val->get_descuento();
        $info=$val->get_info();

        $query="SELECT * FROM ofertas WHERE ID_Oferta='$id'";
        $resultado=$db->query($query);
        $row = $resultado->fetch_assoc();

        $string=$string.'<form id="form" name="form" method="post" autocomplete="off">';
        $string=$string.'<tr>';
        $string=$string.'<td><center>'.$id.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$codigo .'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$tipo.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$descuento.'</td>';
        $string=$string.'<td></td>';
        $string=$string.'<td><center>'.$info.'</td>';
        $string=$string.'<td></td>';

        $string = $string . '<td><input class="btn btn-outline-danger" name="'.$i.'" type="submit" id="'.$i.'"value="Eliminar"/></td>';
        $string = $string .'&nbsp';
        $string = $string .'</td>';
        $string=$string.'</form>';
        $string=$string.'</tr>';

        if(isset($_POST[$i])){
            
            $query="UPDATE pedidos SET Oferta='4' WHERE Oferta =$i";
            $resultado=$db->query($query);

            $query="DELETE FROM ofertas WHERE ID_Oferta=$i";
            $resultado=$db->query($query);

            header("Location:administrar.php");
        }
        $i++;
        $j++;
    }
    $string=$string.'</table>';
    return $string;
}


include __DIR__.'/includes/vistas/plantillas/plantilla.php';