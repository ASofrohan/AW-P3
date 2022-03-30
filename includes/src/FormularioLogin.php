<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Usuario.php';

class FormularioLogin extends Form
{
    public function __construct() {
        parent::__construct('formLogin');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $nombreUsuario =$datos['user'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorNombreUsuario = self::createMensajeError($errores, 'user', 'span', array('class' => 'error'));
        $errorPassword = self::createMensajeError($errores, 'pass', 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        <fieldset>
            <legend>Usuario y contraseña</legend>
            $htmlErroresGlobales
            <p><label>Nombre de usuario:</label> <input type="text" name="user" value="$nombreUsuario"/>$errorNombreUsuario</p>
            <p><label>Password:</label> <input type="password" name="pass" />$errorPassword</p>
            <button type="submit" name="login">Entrar</button>
        </fieldset>
        <p style="text-align:center">¿No estás registado? <a href='registro.php'>Regístrate.</a></p> 
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        
        $nombreUsuario =$datos['user'] ?? null;
        $nombre = $datos['name'] ?? null;
                
        if ( empty($nombreUsuario) ) {
            $result['user'] = "El nombre de usuario no puede estar vacío";
        }
        
        $password = $datos['pass'] ?? null;
        if ( empty($password) ) {
            $result['pass'] = "El password no puede estar vacío.";
        }
        
        if (count($result) === 0) {
            $usuario = Usuario::login($nombreUsuario, $password);
            if ( ! $usuario ) {
                // No se da pistas a un posible atacante
                $result[] = "El usuario o el password no coinciden";
            } else {
                $_SESSION['login'] = true;
                $_SESSION['nombre'] = $usuario->getNombre();
               // $_SESSION['esAdmin'] = strcmp($usuario->getRol(), 'admin') == 0 ? true : false;
                $result = 'index.php';
            }
        }
        return $result;
    }
}