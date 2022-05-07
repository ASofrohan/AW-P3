<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Usuario.php';

class FormularioRegistro extends Form
{
    public function __construct() {
        parent::__construct('formRegistro');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
        $nombreUsuario = $datos['nombreUsuario'] ?? '';
        $nombre = $datos['nombre'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorNombre = self::createMensajeError($errores, 'nombre', 'span', array('class' => 'error'));
        $errorApellidos = self::createMensajeError($errores, 'apellidos', 'span', array('class' => 'error'));
        $errorCorreo = self::createMensajeError($errores, 'correo', 'span', array('class' => 'error'));
        $errorPassword1 = self::createMensajeError($errores, 'password1', 'span', array('class' => 'error'));
        $errorPassword2 = self::createMensajeError($errores, 'password2', 'span', array('class' => 'error'));
        $errorCalle = self::createMensajeError($errores, 'calle', 'span', array('class' => 'error'));
        $errorCiudad = self::createMensajeError($errores, 'ciudad', 'span', array('class' => 'error'));
        $errorPiso = self::createMensajeError($errores, 'piso', 'span', array('class' => 'error'));
        $errorPostal = self::createMensajeError($errores, 'postal', 'span', array('class' => 'error'));
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);

        $html = <<<EOF
            <fieldset>
                $htmlErroresGlobales
                <div class="grupo-control">
                    <label>Correo electronico:</label> <input class="control" type="text" name="correo" />$errorCorreo
                </div>
                <div class="grupo-control">
                    <label>Nombre completo:</label> <input class="control" type="text" name="nombre" value="$nombre" />$errorNombre
                </div>
                <div class="grupo-control">
                    <label>Apellidos:</label> <input class="control" type="text" name="apellidos" />$errorApellidos
                </div>
                <div class="grupo-control">
                    <label>Password:</label> <input class="control" type="password" name="password1" />$errorPassword1
                </div>
                <div class="grupo-control">
                    <label>Vuelve a introducir el Password:</label> <input class="control" type="password" name="password2" />$errorPassword2
                </div>
                <div class="grupo-control">
                    <label>Calle:</label> <input class="control" type="text" name="calle" />$errorCalle
                </div>
                <div class="grupo-control">
                    <label>Ciudad:</label> <input class="control" type="text" name="ciudad" />$errorCiudad
                </div>
                <div class="grupo-control">
                    <label>Piso:</label> <input class="control" type="text" name="piso" />$errorPiso
                </div>
                <div class="grupo-control">
                    <label>Codigo postal:</label> <input class="control" type="text" name="postal" />$errorPostal
                </div>
                <div class="grupo-control"><button class="btn btn-primary btn-sm" type="submit" name="registro">Registrar</button></div>
            </fieldset>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        
        $nombreUsuario = $datos['correo'] ?? null;
        
        if ( empty($nombreUsuario) || mb_strlen($nombreUsuario) < 5 ) {
            $result['correo'] = "El nombre de usuario tiene que tener una longitud de al menos 5 caracteres.";
        }
        
        $nombre = $datos['nombre'] ?? null;
        if ( empty($nombre) || mb_strlen($nombre) < 5 ) {
            $result['nombre'] = "El nombre tiene que tener una longitud de al menos 5 caracteres.";
        }
        
        $password1 = $datos['password1'] ?? null;
        if ( empty($password1) || mb_strlen($password1) < 5 ) {
            $result['password1'] = "El password tiene que tener una longitud de al menos 5 caracteres.";
        }
        $password2 = $datos['password2'] ?? null;
        if ( empty($password2) || strcmp($password1, $password2) !== 0 ) {
            $result['password2'] = "Los passwords deben coincidir";
        }


        $apellidos = $datos['apellidos'] ?? null;
        $calle = $datos['calle'] ?? null;
        $ciudad = $datos['ciudad'] ?? null;
        $piso = $datos['piso'] ?? null;
        $postal = $datos['postal'] ?? null;
        
        if (count($result) === 0) {
            $user = Usuario::crea($nombreUsuario, $nombre, $apellidos, $password2, $calle,$ciudad,$piso,$postal);
            if ( ! $user ) {
                $result[] = "El usuario ya existe";
            } else {
                $_SESSION['login'] = true;
                $_SESSION['nombre'] = $nombre;
                $_SESSION['correo']=$nombreUsuario;
                $result = 'index.php';
            }
        }
        return $result;
    }
}