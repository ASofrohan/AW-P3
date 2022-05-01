<?php
require_once __DIR__.'/Aplicacion.php';

class Mensaje_respuesta
{
    private $id;

    private $id_comentario;

    private $user;

    private $respuesta;

    private $fecha;

    private $editado;

    private function __construct($id,$id_comentario, $user, $respuesta,$fecha,$editado)
    {
        $this->id= $id;
        $this->id_comentario= $id_comentario;
        $this->user= $user;
        $this->respuesta=$respuesta;
        $this->fecha=$fecha;
        $this->editado=$editado;
    }

    public static function mostrarRespuestas($id_comentario)
    {

        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("SELECT * FROM foro_respuestas where ID_Comentario=$id_comentario");
        $result = $conn->query($query);

        //$correo=$_SESSION['correo'];
        $arrayRespuestas=array();

        if($result){
            if(mysqli_num_rows($result)>0){
                $i=0;
                while($row = mysqli_fetch_assoc($result)) {
                    $id=$row['ID_Respuesta'];
                    $user=$row['ID_Usuario'];
                    $respuesta=$row['Respuesta'];
                    $fecha=$row['Fecha'];
                    $editado=$row['Editado'];
                    $p = new Mensaje_respuesta($id,$id_comentario,$user,$respuesta,$fecha,$editado);
                    $arrayRespuestas[$i] = $p;
                    $i += 1;
                }
            }
        }

        return $arrayRespuestas;
    }

    private static function inserta($respuesta)
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO foro_respuestas(ID_Usuario,Respuesta,ID_Comentario) VALUES('%s','%s', '%s')"
	    , $conn->real_escape_string($respuesta->user)
	    , $conn->real_escape_string($respuesta->respuesta)
        , $conn->real_escape_string($respuesta->id_comentario));
        if ( !$conn->query($query) ) {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        } 
        else{
            $respuestas=true;
            $query=sprintf("UPDATE foro SET Respuestas=$respuestas WHERE ID_Comentario=$respuesta->id_comentario");
            if ( !$conn->query($query) ) {
                echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
                exit();
            }   
        }
        
        return $respuesta;
    }

    public static function crea($user,$comentario,$id_comentario)
    {
        $id=null;
        $fecha=null;
        $editado=null;
        $respuesta = new Mensaje_respuesta($id,$id_comentario,$user,$comentario,$fecha,$editado);
        return self::inserta($respuesta);
    }

    public static function borra($id)
    {   
        $id_comentario=null;
        $user=null;
        $respuesta=null;
        $fecha=null;
        $editado=null;
        $respuesta = new Mensaje_respuesta($id,$id_comentario,$user,$respuesta,$fecha,$editado);
        return self::elimina($respuesta);
    }

    public static function edita($id,$user,$contenido)
    {
        $id_comentario=null;
        $user=null;
        $fecha=null;
        $editado=null;
        $respuesta = new Mensaje_respuesta($id,$id_comentario,$user,$contenido,$fecha,$editado);
        return self::modifica($respuesta);
    }

    private static function elimina($respuesta)
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $id=$respuesta->id;
        $correo=$_SESSION['correo'];

        $query=sprintf("SELECT * FROM foro_respuestas WHERE ID_Respuesta=$id");
        $resultado=$conn->query($query);
        $row = $resultado->fetch_assoc();
        $user=$row['ID_Usuario'];
        if($user==$correo||isset($_SESSION["esAdmin"])){
            $query=sprintf("DELETE FROM foro_respuestas where ID_Respuesta=$id");
            if ( !$conn->query($query) ) {
                echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
                exit();
            } 
        }
        else{
            $respuesta=null;
        }

        return $respuesta;
    }

    private static function modifica($respuesta)
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $id=$respuesta->id;
        $correo=$_SESSION['correo'];

        $query=sprintf("SELECT * FROM foro_respuestas WHERE ID_Respuesta=$id");
        $resultado=$conn->query($query);
        $row = $resultado->fetch_assoc();
        $user=$row['ID_Usuario'];
        if($user==$correo || isset($_SESSION["esAdmin"])){
            $editado=true;
            $query=sprintf("UPDATE foro_respuestas SET Respuesta='%s',Editado=$editado where 
            ID_Respuesta=$id", $conn->real_escape_string($respuesta->respuesta));
            if ( !$conn->query($query) ) {
                echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
                exit();
            } 
        }
        else{
            $respuesta=null;
        }

        return $respuesta;
    }

    public function respuestaPerteneceUsuario($id){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("SELECT * FROM foro_respuestas where ID_Respuesta=$id");
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

    public function getRespuesta()
    {
        return $this->respuesta;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getEditado()
    {
        return $this->editado;
    }
}