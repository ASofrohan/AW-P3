<?php
require_once __DIR__.'/Aplicacion.php';

class Mensaje
{
    private $id;

    private $user;

    private $comentario;

    private $puntuacion;

    private function __construct($user, $comentario, $puntuacion)
    {
        $this->user= $user;
        $this->comentario= $comentario;
        $this->puntuacion=$puntuacion;

    }


    public static function crea($user,$comentario,$puntuacion)
    {
       /*$user = self::buscaUsuario($nombreUsuario);
        if ($user) {
            return false;
        }*/
        $mensaje = new Mensaje($user,$comentario,$puntuacion);
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
        $arrayForo=array();

        if($result){
            if(mysqli_num_rows($result)>0){
                $i=0;
                while($row = mysqli_fetch_assoc($result)) {
                    
                    $comentario=$row['Comentario'];
                    $user=$row['ID_Usuario'];
                    $puntuacion=$row['Puntuacion'];
                    $p = new Mensaje($user,$comentario,$puntuacion);
                    $arrayForo[$i] = $p;
                    $i += 1;
                }
            }
        }

        return $arrayForo;
    }


    public function getUser()
    {
        return $this->user;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function getPuntuacion()
    {
        return $this->puntuacion;
    }

}


