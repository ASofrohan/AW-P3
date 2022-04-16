<?php
require_once __DIR__.'/Aplicacion.php';

class Mensaje
{
    private $id;

    private $user;

    private $comentario;

    private $puntuacion;

    private $editado;

    private $fecha;

    private function __construct($id,$user, $comentario, $puntuacion,$editado,$fecha)
    {
        $this->id= $id;
        $this->user= $user;
        $this->comentario= $comentario;
        $this->puntuacion=$puntuacion;
        $this->editado=$editado;
        $this->fecha=$fecha;

    }


    public static function crea($user,$comentario,$puntuacion)
    {
        $id=null;
        $editado=false;
        $fecha=null;
        $mensaje = new Mensaje($id,$user,$comentario,$puntuacion,$editado,$fecha);
        return self::inserta($mensaje);
    }

    public static function edita($id,$user,$comentario,$puntuacion)
    {
        $editado=false;
        $fecha=null;
        $mensaje = new Mensaje($id,$user,$comentario,$puntuacion,$editado,$fecha);
        return self::modifica($mensaje);
    }

    public static function borra($id)
    {   
        $user=null;
        $comentario=null;
        $puntuacion=null;
        $editado=true;
        $fecha=null;
        $mensaje = new Mensaje($id,$user,$comentario,$puntuacion,$editado,$fecha);
        return self::elimina($mensaje);
    }

    private static function inserta($mensaje)
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $estrellas=$mensaje->puntuacion;
        $query=sprintf("INSERT INTO foro(ID_Usuario,Comentario,Puntuacion) VALUES('%s','%s', '%s')"
	    , $conn->real_escape_string($mensaje->user)
	    , $conn->real_escape_string($mensaje->comentario)
        , $conn->real_escape_string($mensaje->puntuacion));
        if ( !$conn->query($query) ) {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        } 
        
        return $mensaje;
    }

    private static function modifica($mensaje)
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $estrellas=$mensaje->puntuacion;
        $id=$mensaje->id;
        $correo=$_SESSION['correo'];

        $query=sprintf("SELECT * FROM foro WHERE ID_Comentario=$id");
        $resultado=$conn->query($query);
        $row = $resultado->fetch_assoc();
        $user=$row['ID_Usuario'];
        if($user==$correo){
            $editado=true;
            $query=sprintf("UPDATE foro SET Comentario='%s',Puntuacion='%s',Editado=$editado where 
            ID_Comentario=$id", $conn->real_escape_string($mensaje->comentario)
            , $conn->real_escape_string($mensaje->puntuacion));
            if ( !$conn->query($query) ) {
                echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
                exit();
            } 
        }
        else{
            $mensaje=null;
        }

        return $mensaje;
    }

    private static function elimina($mensaje)
    {

        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $estrellas=$mensaje->puntuacion;
        $id=$mensaje->id;
        $correo=$_SESSION['correo'];

        $query=sprintf("SELECT * FROM foro WHERE ID_Comentario=$id");
        $resultado=$conn->query($query);
        $row = $resultado->fetch_assoc();
        $user=$row['ID_Usuario'];
        if($user==$correo){
            $query=sprintf("DELETE FROM foro where ID_Comentario=$id");
            if ( !$conn->query($query) ) {
                echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
                exit();
            } 
        }
        else{
            $mensaje=null;
        }

        return $mensaje;
    }

    public static function mostrarReseñas()
    {

        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("SELECT * FROM foro");
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
                    $id=$row['ID_Comentario'];
                    $editado=$row['Editado'];
                    $fecha=$row['Fecha'];
                    $p = new Mensaje($id,$user,$comentario,$puntuacion,$editado,$fecha);
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

    public function getId()
    {
        return $this->id;
    }

    public function getEditado()
    {
        return $this->editado;
    }

    public function getFecha()
    {
        return $this->fecha;
    }
}


