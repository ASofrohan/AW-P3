<?php
require_once __DIR__.'/Aplicacion.php';
require_once __DIR__.'/Mensaje_Respuesta.php';
class Mensaje
{
    private $id;

    private $user;

    private $comentario;

    private $puntuacion;

    private $editado;

    private $fecha;

    private $respuestas;

    private function __construct($id,$user, $comentario, $puntuacion,$editado,$fecha,$respuestas)
    {
        $this->id= $id;
        $this->user= $user;
        $this->comentario= $comentario;
        $this->puntuacion=$puntuacion;
        $this->editado=$editado;
        $this->fecha=$fecha;
        $this->respuestas=$respuestas;

    }


    public static function crea($user,$comentario,$puntuacion)
    {
        $id=null;
        $editado=false;
        $fecha=null;
        $respuestas=null;
        $mensaje = new Mensaje($id,$user,$comentario,$puntuacion,$editado,$fecha,$respuestas);
        return self::inserta($mensaje);
    }

    public static function edita($id,$user,$comentario,$puntuacion)
    {
        $editado=false;
        $fecha=null;
        $respuestas=null;
        $mensaje = new Mensaje($id,$user,$comentario,$puntuacion,$editado,$fecha,$respuestas);
        return self::modifica($mensaje);
    }

    public static function borra($id)
    {   
        $user=null;
        $comentario=null;
        $puntuacion=null;
        $editado=true;
        $fecha=null;
        $respuestas=null;
        $mensaje = new Mensaje($id,$user,$comentario,$puntuacion,$editado,$fecha,$respuestas);
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
        if($user==$correo || isset($_SESSION["esAdmin"])){
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
        $array=Mensaje_respuesta::mostrarRespuestas($id);
        $correo=$_SESSION['correo'];
       $numRespuestas=count($array);
        $query=sprintf("SELECT * FROM foro WHERE ID_Comentario=$id");
        $resultado=$conn->query($query);
        $row = $resultado->fetch_assoc();
        $user=$row['ID_Usuario'];
        $respuestas=$row['Respuestas'];
       
        if($user==$correo||isset($_SESSION["esAdmin"])){ 
            if($numRespuestas!=0) $mensaje=null;  
            else
            $query=sprintf("DELETE FROM foro where ID_Comentario=$id");
            $resultado=$conn->query($query);
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
                    $respuestas=$row['Respuestas'];
                    $p = new Mensaje($id,$user,$comentario,$puntuacion,$editado,$fecha,$respuestas);
                    $arrayForo[$i] = $p;
                    $i += 1;
                }
            }
        }

        return $arrayForo;
    }

   public static function mensajePerteneceUsuario($id){
    $app = Aplicacion::getInstancia();
    $conn = $app->conexionBd();
    $query=sprintf("SELECT * FROM foro where ID_Comentario=$id");
    $result = $conn->query($query);
        if($result){
           if(mysqli_num_rows($result)>0){   
                $row = mysqli_fetch_assoc($result);
                $idUsuario=$row['ID_Usuario'];
                if($idUsuario==$_SESSION['correo']){
                    return true;
                }
            }
        }

    return false;
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

    public function getRespuestas()
    {
        return $this->respuestas;
    }
}


