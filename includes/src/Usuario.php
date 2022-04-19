<?php
require_once __DIR__.'/Aplicacion.php';

class Usuario
{

    private $correo;

    private $nombre;

    private $apellidos;

    private $contraseña;

    private $calle;

    private $ciudad;

    private $piso;

    private $postal;

    private function __construct($correo, $nombre, $apellidos, $contraseña, $calle,$ciudad,$piso,$postal)
    {
        $this->correo= $correo;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->contraseña = $contraseña;
        $this->calle = $calle;
        $this->ciudad = $ciudad;
        $this->piso = $piso;
        $this->postal = $postal;

    }

    public static function login($correo, $contraseña)
    {
        $user = self::buscaUsuario($correo);
        if ($user->compruebaPassword($contraseña)) {
            return $user;
        }
        return false;
    }

    public static function buscaUsuario($correo)
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM usuarios U WHERE U.Correo = '%s'", $conn->real_escape_string($correo));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $dom=$fila['Domicilio'];
                $query = sprintf("SELECT * FROM domicilios WHERE ID_Domicilio = '$dom'");
             $resultado=$conn->query($query);
             $row = $resultado->fetch_assoc();
                $user = new Usuario($fila['Correo'], $fila['Nombre'], $fila['Apellidos'], $fila['Contraseña'], $row['Calle'],$row['Ciudad'],$row['Piso'],$row['CodigoPostal']);
                $result = $user;
                $resultado->free();
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function crea($correo, $nombre, $apellidos, $contraseña, $calle,$ciudad,$piso,$postal)
    {
       $user = self::buscaUsuario($correo);
        if ($user) {
            return false;
        }
        $user = new Usuario($correo, $nombre, $apellidos, self::hashPassword($contraseña), $calle,$ciudad,$piso,$postal);
        return self::inserta($user);
    }

    public static function edita($correo, $nombre, $apellidos, $contraseña, $calle,$ciudad,$piso,$postal)
    {
        $user = new Usuario($correo, $nombre, $apellidos, self::hashPassword($contraseña), $calle,$ciudad,$piso,$postal);
        return self::actualiza($user);
    }

    private static function inserta($usuario)
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO domicilios(Calle, Ciudad, Piso, CodigoPostal) VALUES('%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($usuario->calle)
            , $conn->real_escape_string($usuario->ciudad)
            , $conn->real_escape_string($usuario->piso)
            , $conn->real_escape_string($usuario->postal));
        if ( !$conn->query($query) ) {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        } else{
            $calle=$usuario->calle;
            $ciudad=$usuario->ciudad;
            $piso=$usuario->piso;
            $postal=$usuario->postal;
            $query = "SELECT * FROM domicilios WHERE Calle = '$calle' and Ciudad='$ciudad' and Piso='$piso' and CodigoPostal='$postal'";
             $resultado=$conn->query($query);
             $row = $resultado->fetch_assoc();
             $id = $row["ID_Domicilio"];
             $query = sprintf("INSERT INTO usuarios (Correo, Nombre, Apellidos,Contraseña, Admin, Domicilio) VALUES ('%s','%s','%s','%s','0','$id')"
             , $conn->real_escape_string($usuario->correo)
             , $conn->real_escape_string($usuario->nombre)
             , $conn->real_escape_string($usuario->apellidos)
             , $conn->real_escape_string($usuario->contraseña));
       
             if ( !$conn->query($query) ) {
               echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
               exit();
            }
        }
        
        return $usuario;
    }

    private static function actualiza($usuario)
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $correo=$_SESSION['correo'];
        $query=sprintf("SELECT * FROM usuarios where Correo='$correo'");
        if ( !$conn->query($query) ) {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        } else{
            $resultado=$conn->query($query);
            $row = $resultado->fetch_assoc();
            $id = $row["Domicilio"];
            $query = sprintf("UPDATE usuarios SET Correo='%s',Nombre='%s',Apellidos='%s',Contraseña='%s' where 
            Correo='$correo'"
            ,$conn->real_escape_string($usuario->correo)
            , $conn->real_escape_string($usuario->nombre)
            ,$conn->real_escape_string($usuario->apellidos)
            ,$conn->real_escape_string($usuario->contraseña));
            if ( !$conn->query($query) ) {
                echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
                exit();
            } else{
             $query = sprintf("UPDATE domicilios SET Calle='%s',Ciudad='%s',Piso='%s',CodigoPostal='%s' where 
             ID_Domicilio='$id'"
             , $conn->real_escape_string($usuario->calle)
             , $conn->real_escape_string($usuario->ciudad)
             , $conn->real_escape_string($usuario->piso)
             , $conn->real_escape_string($usuario->postal));
       
             if ( !$conn->query($query) ) {
               echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
               exit();
            }
          }
        }
        
        return $usuario;
    }


    public function getNombre()
    {
        return $this->nombre;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function compruebaPassword($password)
    {
        return password_verify($password, $this->contraseña);
    }
}


