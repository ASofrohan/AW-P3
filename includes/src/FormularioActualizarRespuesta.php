<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Mensaje_respuesta.php';
require_once __DIR__.'/Usuario.php';

class FormularioActualizarRespuesta extends Form
{
    public function __construct() {
        parent::__construct('formActualizarRespuesta');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
        $comentario = $datos['mensaje'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorComentario = self::createMensajeError($errores, 'comentario', 'span', array('class' => 'error'));
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);

        $html = <<<EOF
        <div id="foro">
            <fieldset>
                $htmlErroresGlobales
                <div class="grupo-control">
                <label>Mensaje:</label>
                <br>
                <textarea name='mensaje'></textarea>$errorComentario
                <br>
                </div>
                </div>
                <div class="grupo-control"><button type="submit" name="Enviar">Enviar</button>
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
        
        $mensaje = $datos['mensaje'] ?? null;
        if ( empty($mensaje)) {
            $result['comentario'] = "La respuesta no puede estar vacio.";
        }

        $id = $_SESSION["editarRespuesta"];

        if ( empty($id) ) {
            $result['id'] = "Selecciona un Id valido.";
        }

        $respuesta = Mensaje_respuesta::edita($id,$user,$mensaje);

        if($respuesta==null){
            $result['id'] = "El Id no corresponde a ninguna respuesta enviada por ti.";
        }
        if (count($result) === 0) {
            unset($_SESSION["editarRespuesta"]);
            $result = 'foro.php';
        }
        
        return $result;
    }

}