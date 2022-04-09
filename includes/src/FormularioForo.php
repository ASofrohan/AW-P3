<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Mensaje.php';
require_once __DIR__.'/Usuario.php';

class FormularioForo extends Form
{
    public function __construct() {
        parent::__construct('formEnviarMensaje');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);

          $html = <<<EOF
            <div id="foro">
            <fieldset>
                $htmlErroresGlobales
                <div>
                <a href="borrarMensajeForo.php"><input type="button" value="Borrar mensaje"></a>
                </div>
                <div>
                <a href="enviarMensajeForo.php"><input type="button" value="Enviar mensaje"></a>
                </div>
                <div>
                <a href="actualizarMensajeForo.php"><input type="button" value="Editar mensaje"></a>
                </div>
                <div>
                <a href="responderMensajeForo.php"><input type="button" value="Responder mensaje"></a>
                </div>
            </fieldset>
            </div>
        EOF;
        return $html;
    }

}