<?php
//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/src/Aplicacion.php';
require_once __DIR__.'/includes/src/Pedidos.php';
require_once __DIR__.'/includes/src/Usuario.php';
require_once __DIR__.'/includes/src/Pizzas.php';
require_once __DIR__.'/includes/src/Bebidas.php';

$tituloPagina = 'Administracion';
$string=mostrar();
$stringUsuarios=mostrarUsuarios();
$stringPizzas=mostrarPizzas();
$stringBebidas=mostrarBebidas();
$contenidoPrincipal =<<<EOF
    $string
    $stringUsuarios
    $stringPizzas
    $stringBebidas
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
    $i=0;
    $j=0;
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
        $string = $string . '<td><input class="btn btn-outline-danger" name="'.$i.'" type="submit" id="'.$i.'"value="Eliminar"/></td>';
        $string = $string .'&nbsp';
        $string = $string . '<td><input class="btn btn-outline-info" name="'.$j.'" type="submit" id="'.$j.'"value="Editar administrador"/>';
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
    $i=0;
    $j=0;
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

        $string = $string . '<td><input class="btn btn-outline-danger" name="'.$i.'" type="submit" id="'.$i.'"value="Eliminar"/></td>';
        $string = $string .'&nbsp';
        //$string = $string . '<td><input class="btn btn-outline-info" name="'.$j.'" type="submit" id="'.$j.'"value="Editar Pizza"/>';
        //$string = $string .'&nbsp';
            if($pers==0)$string=$string.'Normal';else $string=$string.'Personalizada';
        $string = $string .'</td>';
        $string=$string.'</form>';
        $string=$string.'</tr>';

        /*if(isset($_POST[$i])){
            if($admin==0){
                $query="UPDATE usuarios SET Admin=1 WHERE Correo='$correo'";
                $resultado=$db->query($query);
            }
            else{
                $query="UPDATE usuarios SET Admin=0 WHERE Correo='$correo'";
                $resultado=$db->query($query);
            }
            header("Location:administrar.php");
            
        }  */  
        if(isset($_POST[$i])){
            $query="DELETE FROM pedidos_pizzas WHERE ID_Pizza=$i";
            $resultado=$db->query($query);
            
            $query="DELETE FROM pizzas WHERE ID_Pizza=$i";
            $resultado=$db->query($query);

            header("Location:administrar.php");
        }
        $i++;
        $j++;
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
    $i=0;
    $j=0;
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

        $string = $string . '<td><input class="btn btn-outline-danger" name="'.$i.'" type="submit" id="'.$i.'"value="Eliminar"/></td>';
        $string = $string .'&nbsp';
        //$string = $string . '<td><input class="btn btn-outline-info" name="'.$j.'" type="submit" id="'.$j.'"value="Editar Pizza"/>';
        //$string = $string .'&nbsp';
           // if($pers==0)$string=$string.'Normal';else $string=$string.'Personalizada';
        $string = $string .'</td>';
        $string=$string.'</form>';
        $string=$string.'</tr>';

        /*if(isset($_POST[$i])){
            if($admin==0){
                $query="UPDATE usuarios SET Admin=1 WHERE Correo='$correo'";
                $resultado=$db->query($query);
            }
            else{
                $query="UPDATE usuarios SET Admin=0 WHERE Correo='$correo'";
                $resultado=$db->query($query);
            }
            header("Location:administrar.php");
            
        }  */  
        if(isset($_POST[$i])){
            $query="DELETE FROM pedidos_bebidas WHERE ID_Bebida=$i";
            $resultado=$db->query($query);
            
            $query="DELETE FROM bebidas WHERE ID_Bebida=$i";
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