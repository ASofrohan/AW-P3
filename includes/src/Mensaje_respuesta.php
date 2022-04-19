<?php
require_once __DIR__.'/Aplicacion.php';

class Mensaje_respuesta
{
    private $id;

    private $id_comentario;

    private $user;

    private $respuesta;

    private $fecha;

    private function __construct($id,$id_comentario, $user, $respuesta,$fecha)
    {
        $this->id= $id;
        $this->id_comentario= $id_comentario;
        $this->user= $user;
        $this->respuesta=$respuesta;
        $this->fecha=$fecha;
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
                    $p = new Mensaje_respuesta($id,$id_comentario,$user,$respuesta,$fecha);
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
        $respuesta = new Mensaje_respuesta($id,$id_comentario,$user,$comentario,$fecha);
        return self::inserta($respuesta);
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
}