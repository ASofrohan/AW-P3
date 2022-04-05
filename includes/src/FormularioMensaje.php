<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Mensaje.php';
require_once __DIR__.'/Usuario.php';

class FormularioMensaje extends Form
{
    public function __construct() {
        parent::__construct('formMensaje');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
        $comentario = $datos['mensaje'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorComentario = self::createMensajeError($errores, 'comentario', 'span', array('class' => 'error'));
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);

        $html = <<<EOF
            <fieldset>
                $htmlErroresGlobales
                <div class="grupo-control">
                <label>Mensaje:
                <br>
                <textarea name='mensaje'></textarea>$errorComentario
                <br>
                </div>
                <div class="grupo-control">
                <label>Estrellas:</label>
                <select name="estrellas">
                  <option value="1">*</option>
                  <option value="2">**</option>
                  <option value="3">***</option>
                  <option value="4">****</option>
                  <option value="5" selected>*****</option>
                </select>
                </div>
                <div class="grupo-control"><button type="submit" name="Enviar">Enviar</button>
                </div>
            </fieldset>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();

        $user = $_SESSION['correo'];
        $puntuacion = $datos['estrellas'] ?? null;
        
        $mensaje = $datos['mensaje'] ?? null;
        if ( empty($mensaje)) {
            $result['comentario'] = "El mensaje no puede estar vacio.";
        }
        

        
        if (count($result) === 0) {
            $mensaje = Mensaje::crea($user,$mensaje,$puntuacion);
            $result = 'reseñas.php';
        }
        return $result;
    }

    public function mostrarForo(){
        $foro=Mensaje::mostrarForo();
        $foroToString="";
        foreach ($foro as $val) {
            $correo=$val->getUser();
            $user = Usuario::buscaUsuario($correo);
            $foroToString=$foroToString . "Usuario: " . $user->getNombre() . 
            $user->getApellidos() . "<br>Comentario: " . $val->getComentario() .
            "<br>Puntuacion: " . $val->getPuntuacion() . "<br><br>";
        }
        return $foroToString;
    }

}