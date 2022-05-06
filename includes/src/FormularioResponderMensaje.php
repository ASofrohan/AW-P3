<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Mensaje.php';
require_once __DIR__.'/Usuario.php';

class FormularioResponderMensaje extends Form
{
    public function __construct() {
        parent::__construct('formResponderMensaje');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
        $comentario = $datos['respuesta'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorRespuesta = self::createMensajeError($errores, 'respuesta', 'span', array('class' => 'error'));
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);

        $html = <<<EOF
        <div id="foro">
            <fieldset>
                $htmlErroresGlobales
                <div class="grupo-control">
                <label>Respuesta:</label>
                <br>
                <textarea name='respuesta'></textarea>$errorRespuesta
                <br>
                </div>
                <div class="grupo-control"><button class="btn btn-outline-success" type="submit" name="Enviar">Enviar</button>
                </div>
            </fieldset>
            <div>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();

        $user = $_SESSION['correo'];
        
        $respuesta = $datos['respuesta'] ?? null;
        if ( empty($respuesta)) {
            $result['respuesta'] = "La respuesta no puede estar vacia.";
        }

        $id = $_SESSION["respuesta"];

        if ( empty($id) ) {
            $result['id'] = "Selecciona un Id valido.";
        }

        
        if (count($result) === 0) {
            $mensaje = Mensaje_respuesta::crea($user,$respuesta,$id);
            unset($_SESSION["respuesta"]);
            $result = 'foro.php';
        }
        return $result;
    }

}