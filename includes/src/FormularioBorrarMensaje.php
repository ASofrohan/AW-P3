<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Mensaje.php';
require_once __DIR__.'/Usuario.php';

class FormularioBorrarMensaje extends Form
{
    public function __construct() {
        parent::__construct('formBorrarMensaje');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorId = self::createMensajeError($errores, 'id', 'span', array('class' => 'error'));
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);

        $html = <<<EOF
        <div id="foro">
            <fieldset>
                $htmlErroresGlobales
                <div class="grupo-control">
                <label>Id: </label><input class="control" type="text" name="id"/>$errorId
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

        $id = $datos['id'] ?? null;

        if ( empty($id) ) {
            $result['id'] = "Selecciona un Id valido.";
        }

        
        if (count($result) === 0) {
            $mensaje = Mensaje::borra($id);
            if($mensaje==null){
                $result['id'] = "El Id no corresponde a ningun mensaje enviado por ti o el mensaje ha sido respondido 
                y no puede ser eliminado.";
                return $result;
            }
            $result = 'foro.php';
        }
        return $result;
    }

}