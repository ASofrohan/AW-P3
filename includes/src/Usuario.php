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
        $usuario = self::buscaUsuario($correo);
        if ($usuario) {
            return $usuario;
        }
        return false;
    }

    public static function buscaUsuario($correo)
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Usuarios U WHERE U.Correo = '%s'", $conn->real_escape_string($correo));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $dom=$fila['Domicilio'];
                $query = sprintf("SELECT * FROM Domicilios WHERE ID_Domicilio = '$dom'");
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
        $user = new Usuario($correo, $nombre, $apellidos, $contraseña, $calle,$ciudad,$piso,$postal);
        return self::inserta($user);
    }

    private static function inserta($usuario)
    {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Domicilios(Calle, Ciudad, Piso, CodigoPostal) VALUES('%s', '%s', '%s', '%s')"
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
            $query = "SELECT * FROM Domicilios WHERE Calle = '$calle' and Ciudad='$ciudad' and Piso='$piso' and CodigoPostal='$postal'";
             $resultado=$conn->query($query);
             $row = $resultado->fetch_assoc();
             $id = $row["ID_Domicilio"];
             $query = sprintf("INSERT INTO Usuarios (Correo, Nombre, Apellidos,Contraseña, Admin, Domicilio) VALUES ('%s','%s','%s','%s','0','$id')"
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

    public function getNombre()
    {
        return $this->nombre;
    }

}


