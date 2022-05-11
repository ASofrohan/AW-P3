<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Mensaje_respuesta.php';
require_once __DIR__.'/Usuario.php';

class FormularioBorrarRespuesta extends Form
{
    public function __construct() {
        parent::__construct('formBorrarRespuesta');
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
                <div class="container"><div class="card" style="width: 8rem;"><div class="card-header">
                <div class="grupo-control"><button class="btn btn-outline-danger" type="submit" name="Enviar">Aceptar</button>
                </div></div></div></div>
            </fieldset>
            <div>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {

        $result = array();

        $id = $_SESSION["borrarRespuesta"];

        if ( empty($id) ) {
            $result['id'] = "Selecciona un Id valido.";
        }

        
        if (count($result) === 0) {
            $respuesta = Mensaje_respuesta::borra($id);
            if($respuesta==null){
                unset($_SESSION["borrarRespuesta"]);
                $result['id'] = "El Id no corresponde a ninguna respuesta enviado por ti.";
                return $result;
            }
            unset($_SESSION["borrarRespuesta"]);
        }
        $result = 'foro.php';
        return $result;
    }

}