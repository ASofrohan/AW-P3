<?php
require_once __DIR__.'/Aplicacion.php';

class Mensaje
{

    private $user;

    private $comentario;

    private $puntuacion;

    private function __construct($user, $comentario, $puntuacion)
    {
        $this->user= $user;
        $this->comentario= $comentario;
        $this->puntuacion=$puntuacion;

    }


    public static function crea($user,$mensaje,$puntuacion)
    {
       /*$user = self::buscaUsuario($nombreUsuario);
        if ($user) {
            return false;
        }*/
        $mensaje = new Mensaje($user,$mensaje,$puntuacion);
        return self::inserta($mensaje);
    }

    private static function inserta($mensaje)
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $estrellas=$mensaje->puntuacion;
        $query=sprintf("INSERT INTO Foro(ID_Usuario,Comentario,Puntuacion) VALUES('%s','%s', '%s')"
	    , $conn->real_escape_string($mensaje->user)
	    , $conn->real_escape_string($mensaje->comentario)
        , $conn->real_escape_string($mensaje->puntuacion));
        if ( !$conn->query($query) ) {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        } 
        
        return $mensaje;
    }

    public static function mostrarForo()
    {

        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("SELECT * FROM Foro");
        $result = $conn->query($query);
        //echo "<div  style='overflow: auto; width: 400px; height: 300px'>";
        $array=array();
        while ($reg = mysqli_fetch_array($result, MYSQLI_ASSOC)  ){
            $array[]=$reg['ID_Comentario'] . ". Usuario: " . $reg['ID_Usuario'] . " Puntuacion: " . $reg['Puntuacion'];
            /*echo" <p><strong>{$reg['ID_Comentario']}
            </strong>{$reg['ID_Usuario']}<Br>{$reg['Comentario']}<Br>
            Puntuacion: {$reg['Puntuacion']}</p>";*/
        }
        
        $result->free();

        return $array;
    }

}


